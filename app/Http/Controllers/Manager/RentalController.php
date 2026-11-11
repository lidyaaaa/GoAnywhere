<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Fine;
use App\Models\RentalHistory;
use App\Models\Vehicle;
use App\Services\LateFeeCalculator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RentalController extends Controller
{
    public function approve($bookingCode)
    {
        $location = auth()->user()->location;
        $carts = Cart::where('booking_code', $bookingCode)
            ->where('status', 'paid')
            ->whereHas('vehicle', function ($query) use ($location) {
                $query->where('location', $location);
            })
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('manager.rentals')
                ->with('error', 'Transaksi tidak ditemukan atau sudah diproses.');
        }

        $approvedAt = now();

        foreach ($carts as $cart) {
            $startTime = $approvedAt->copy();
            $totalDays = $cart->quantity_days ?? 1;
            if ($cart->period === 'weekly') {
                $totalDays = 7;
            }

            $cart->status = 'active';
            $cart->rental_start_date = $startTime;
            $cart->rental_end_date = $startTime->copy()->addDays($totalDays);
            $cart->save();
        }

        $carts->first()->payment()->update([
            'payment_status' => 'success',
            'paid_at' => $approvedAt,
        ]);

        return redirect()->route('manager.rentals')
            ->with('success', 'Booking ' . $bookingCode . ' berhasil disetujui.');
    }

    public function index()
    {
        $location = auth()->user()->location;

        // 🔥 SEWA AKTIF - status 'active'
        $rentals = Cart::where('status', 'active')
            ->whereHas('vehicle', function($q) use ($location) {
                $q->where('location', $location);
            })
            ->with(['vehicle', 'user'])
            ->orderBy('rental_start_date', 'desc')
            ->get();

        // Transaksi yang sudah dibayar dan menunggu persetujuan manager.
        $pendingApprovals = Cart::where('status', 'paid')
            ->whereHas('vehicle', function($q) use ($location) {
                $q->where('location', $location);
            })
            ->with(['vehicle', 'user'])
            ->orderBy('updated_at', 'asc')
            ->get();

        // Riwayat transaksi yang sudah selesai.
        $history = Cart::where('status', 'completed')
            ->whereHas('vehicle', function($q) use ($location) {
                $q->where('location', $location);
            })
            ->with(['vehicle', 'user'])
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        // Hitung keterlambatan + link WhatsApp sekali di controller, bukan di Blade.
        $rentals->each(function (Cart $rental) {
            $rental->late = LateFeeCalculator::calculate($rental);
            $rental->whatsapp_url = $this->whatsappUrl($rental);
        });

        return view('manager.rentals', compact('rentals', 'pendingApprovals', 'history'));
    }

    /** Selesaikan sewa: hitung denda + biaya tambahan, status completed, stok kembali. */
    public function complete(Request $request, $id)
    {
        $data = $request->validate([
            'extra_charge'      => 'nullable|numeric|min:0|max:100000000',
            'extra_charge_note' => 'nullable|string|max:255|required_with:extra_charge',
        ]);

        $cart = $this->findActiveRental($id);
        $late = LateFeeCalculator::calculate($cart);
        $extra = (float) ($data['extra_charge'] ?? 0);

        DB::transaction(function () use ($cart, $late, $extra, $data) {
            if ($late['is_late']) {
                Fine::create([
                    'id' => Str::uuid(),
                    'cart_id' => $cart->id,
                    'user_id' => $cart->user_id,
                    'vehicle_id' => $cart->vehicle_id,
                    'late_minutes' => $late['late_minutes'],
                    'fine_per_hour' => $late['fine_per_hour'],
                    'total_fine' => $late['fine_amount'] + $extra,
                    'payment_status' => 'pending',
                ]);
            }

            $cart->status = 'completed';
            $cart->returned_at = $late['returned_at'];
            $cart->is_late = $late['is_late'];
            $cart->late_minutes = $late['late_minutes'];
            $cart->fine_amount = $late['fine_amount'];
            $cart->extra_charge = $extra;
            $cart->extra_charge_note = $extra > 0 ? $data['extra_charge_note'] : null;
            $cart->save();

            $this->restockVehicle($cart->vehicle);

            RentalHistory::create([
                'id' => Str::uuid(),
                'cart_id' => $cart->id,
                'user_id' => $cart->user_id,
                'vehicle_id' => $cart->vehicle_id,
                'vehicle_name' => $cart->vehicle->name,
                'quantity' => $cart->quantity,
                'total_price' => $cart->subtotal,
                'start_date' => $cart->rental_start_date,
                'end_date' => $cart->rental_end_date,
                'pickup_location' => $cart->pickup_location,
                'status' => 'completed',
                'returned_at' => $late['returned_at'],
                'fine_amount' => $late['fine_amount'] + $extra,
            ]);
        });

        $total = LateFeeCalculator::rupiah($late['fine_amount'] + $extra);

        return redirect()->route('manager.rentals')
            ->with('success', "Sewa {$cart->booking_code} selesai. Total tagihan tambahan: {$total}.");
    }

    /** Tandai sewa bermasalah/hilang dan suspend akun penyewa. */
    public function flag(Request $request, $id)
    {
        $data = $request->validate([
            'status' => 'required|in:dispute,lost',
            'note'   => 'required|string|max:1000',
        ]);

        $cart = $this->findActiveRental($id);

        DB::transaction(function () use ($cart, $data) {
            $cart->status = $data['status'];
            $cart->dispute_note = $data['note'];
            $cart->save();

            $user = $cart->user;
            $user->suspended_at = now();
            $user->suspended_reason = "Sewa {$cart->booking_code} ditandai {$data['status']}: {$data['note']}";
            $user->save();

            // Bersihkan sesi aktif agar penyewa langsung ter-logout.
            DB::table('sessions')->where('user_id', $user->id)->delete();
        });

        return redirect()->route('manager.rentals')
            ->with('success', "Sewa {$cart->booking_code} ditandai " . strtoupper($data['status']) . " dan akun {$cart->user->name} di-suspend.");
    }

    private function findActiveRental($id): Cart
    {
        $location = auth()->user()->location;

        return Cart::where('id', $id)
            ->where('status', 'active')
            ->whereHas('vehicle', fn ($q) => $q->where('location', $location))
            ->with(['vehicle', 'user'])
            ->firstOrFail();
    }

    private function restockVehicle(?Vehicle $vehicle): void
    {
        if (! $vehicle) return;

        $vehicle->available_stock = min($vehicle->available_stock + 1, max($vehicle->total_stock, 1));
        if ($vehicle->status === 'rented') {
            $vehicle->status = 'available';
        }
        $vehicle->save();
    }

    private function whatsappUrl(Cart $rental): ?string
    {
        $phone = preg_replace('/\D/', '', (string) $rental->user?->phone);
        if ($phone === '') return null;
        if (str_starts_with($phone, '0')) $phone = '62' . substr($phone, 1);

        $late = $rental->late;
        $vehicle = $rental->vehicle->name ?? 'kendaraan';
        $name = $rental->user->name;

        $message = $late['is_late']
            ? "Halo {$name}, kami dari GoAnywhere. Sewa {$vehicle} (kode {$rental->booking_code}) telah melewati batas pengembalian selama {$late['duration_label']}"
              . ($late['late_days'] > 0 ? " ({$late['late_days']} hari)" : '')
              . ". Denda berjalan saat ini " . LateFeeCalculator::rupiah($late['fine_amount'])
              . ". Mohon segera mengembalikan unit ke {$rental->pickup_location}. Terima kasih."
            : "Halo {$name}, kami dari GoAnywhere. Mengingatkan sewa {$vehicle} (kode {$rental->booking_code}) jatuh tempo pada "
              . $late['due_at']->translatedFormat('d M Y H:i') . ". Terima kasih.";

        return 'https://wa.me/' . $phone . '?text=' . rawurlencode($message);
    }
}