<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Fine;
use App\Models\Vehicle;
use App\Models\RentalHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Services\LateFeeCalculator;
use Illuminate\Support\Facades\DB;

class RentalController extends Controller
{
    public function index()
    {
        // 🔥 KENDARAAN BELUM DIAMBIL (PAID)
        $pendingPickup = Cart::where('user_id', auth()->id())
            ->where('status', 'paid')
            ->with('vehicle')
            ->get();

        // Sewa aktif
        $activeRentals = Cart::where('user_id', auth()->id())
            ->where('status', 'active')
            ->with('vehicle')
            ->get();

        // Riwayat transaksi
        $history = Cart::where('user_id', auth()->id())
            ->whereIn('status', ['completed', 'cancelled'])
            ->with('vehicle')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        // Statistik
        $totalRentals = Cart::where('user_id', auth()->id())
            ->where('status', 'completed')
            ->count();

        $totalSpent = Cart::where('user_id', auth()->id())
            ->where('status', 'completed')
            ->sum('subtotal');

        return view('user.rental.index', compact(
            'pendingPickup', 
            'activeRentals', 
            'history', 
            'totalRentals', 
            'totalSpent'
        ));
    }

    public function return($id)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->where('id', $id)
            ->where('status', 'active')
            ->firstOrFail();

        $late = $this->calculateLateFee($cart, now());

        return view('user.rental.return', compact('cart', 'late'));
    }

    private const FINE_PER_HOUR = LateFeeCalculator::FINE_PER_HOUR;

    private function calculateLateFee(Cart $cart, Carbon $returnedAt): array
    {
        return LateFeeCalculator::calculate($cart, $returnedAt);
    }

    public static function rupiah(int|float $amount): string
    {
        return LateFeeCalculator::rupiah($amount);
    }

    public function cancelBooking($bookingCode)
    {
        $carts = Cart::where('user_id', auth()->id())
            ->where('booking_code', $bookingCode)
            ->where('status', 'paid')
            ->with('vehicle')
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('user.rental')
                ->with('error', 'Booking tidak dapat dibatalkan atau sudah dikonfirmasi manager.');
        }

        DB::transaction(function () use ($carts) {
            foreach ($carts as $cart) {
                $cart->status = 'cancelled';
                $cart->save();

                $vehicle = $cart->vehicle;
                if ($vehicle) {
                    $vehicle->available_stock += ($cart->quantity_vehicle ?? 1);
                    $vehicle->save();
                }
            }

            $carts->first()->payment()->update([
                'payment_status' => 'failed',
            ]);
        });

        return redirect()->route('user.rental')
            ->with('success', 'Booking berhasil dibatalkan.');
    }

    public function processReturn(Request $request, $id)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->where('id', $id)
            ->where('status', 'active')
            ->firstOrFail();

        $now = now();
        $late = $this->calculateLateFee($cart, $now);

        $isLate = $late['is_late'];
        $fineAmount = $late['fine_amount'];
        $lateMinutes = $late['late_minutes'];

        if ($isLate) {
            // Simpan denda
            Fine::create([
                'id' => Str::uuid(),
                'cart_id' => $cart->id,
                'user_id' => auth()->id(),
                'vehicle_id' => $cart->vehicle_id,
                'late_minutes' => $lateMinutes,
                'fine_per_hour' => self::FINE_PER_HOUR,
                'total_fine' => $fineAmount,
                'payment_status' => 'pending',
            ]);

            $cart->fine_amount = $fineAmount;
            $cart->is_late = true;
            $cart->late_minutes = $lateMinutes;
        }

        $cart->status = 'completed';
        $cart->returned_at = $now;
        $cart->save();

        // Kembalikan stok
        $vehicle = Vehicle::find($cart->vehicle_id);
        $vehicle->available_stock += 1;
        $vehicle->save();

        // Simpan ke rental history
        RentalHistory::create([
            'id' => Str::uuid(),
            'cart_id' => $cart->id,
            'user_id' => auth()->id(),
            'vehicle_id' => $cart->vehicle_id,
            'vehicle_name' => $vehicle->name,
            'quantity' => $cart->quantity,
            'total_price' => $cart->subtotal,
            'start_date' => $cart->rental_start_date,
            'end_date' => $cart->rental_end_date,
            'pickup_location' => $cart->pickup_location,
            'status' => 'completed',
            'returned_at' => $now,
            'fine_amount' => $fineAmount,
        ]);

        if ($isLate) {
            return redirect()->route('user.rental.fine', $cart->id)
                ->with('warning', 'Kendaraan terlambat dikembalikan! Silahkan bayar denda.');
        }

        return redirect()->route('user.rental')->with('success', 'Kendaraan berhasil dikembalikan tepat waktu!');
    }

    public function fine($id)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $fine = Fine::where('cart_id', $cart->id)->first();

        return view('user.rental.fine', compact('cart', 'fine'));
    }

    public function payFine(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|in:qris,bank_transfer,gopay,dana,ovo',
        ]);

        $cart = Cart::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $fine = Fine::where('cart_id', $cart->id)->first();
        if (!$fine || $fine->payment_status === 'paid') {
            return redirect()->route('user.rental');
        }

        $fine->payment_status = 'paid';
        $fine->payment_method = $request->payment_method;
        $fine->paid_at = now();
        $fine->save();

        return redirect()->route('user.rental')->with('success', 'Denda berhasil dibayar!');
    }

}
