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
    public function index(Request $request)
    {
        $userId = auth()->id();
        $statusFilter = $request->query('status', 'all');
        $search = trim($request->query('search', ''));

        // Helper filter pencarian booking code atau nama armada
        $applySearch = function ($query) use ($search) {
            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('booking_code', 'like', "%{$search}%")
                      ->orWhereHas('vehicle', function ($vq) use ($search) {
                          $vq->where('name', 'like', "%{$search}%")
                             ->orWhere('brand', 'like', "%{$search}%")
                             ->orWhere('location', 'like', "%{$search}%");
                      });
                });
            }
        };

        // Ringkasan hitungan badge per status
        $counts = [
            'all' => Cart::where('user_id', $userId)->whereIn('status', ['paid', 'approved', 'active', 'pending_return', 'pending_payment', 'completed', 'cancelled', 'rejected'])->count(),
            'paid' => Cart::where('user_id', $userId)->where('status', 'paid')->count(),
            'approved' => Cart::where('user_id', $userId)->where('status', 'approved')->count(),
            'active' => Cart::where('user_id', $userId)->where('status', 'active')->count(),
            'pending_return' => Cart::where('user_id', $userId)->where('status', 'pending_return')->count(),
            'pending_payment' => Cart::where('user_id', $userId)->where('status', 'pending_payment')->count(),
            'completed' => Cart::where('user_id', $userId)->where('status', 'completed')->count(),
            'cancelled' => Cart::where('user_id', $userId)->where('status', 'cancelled')->count(),
            'rejected' => Cart::where('user_id', $userId)->where('status', 'rejected')->count(),
        ];

        // 1. Menunggu Persetujuan Manager (Status: PAID)
        $pendingApprovalsQuery = Cart::where('user_id', $userId)
            ->where('status', 'paid')
            ->with('vehicle')
            ->orderBy('created_at', 'desc');
        $applySearch($pendingApprovalsQuery);
        $pendingApprovals = ($statusFilter === 'all' || $statusFilter === 'paid') ? $pendingApprovalsQuery->get() : collect();

        // 2. Disetujui / Armada Sedang OTW Diantar (Status: APPROVED)
        $approvedOtwQuery = Cart::where('user_id', $userId)
            ->where('status', 'approved')
            ->with('vehicle')
            ->orderBy('updated_at', 'desc');
        $applySearch($approvedOtwQuery);
        $approvedOtw = ($statusFilter === 'all' || $statusFilter === 'approved') ? $approvedOtwQuery->get() : collect();

        // 3. Sewa Aktif / Kendaraan Digunakan (Status: ACTIVE)
        $activeRentalsQuery = Cart::where('user_id', $userId)
            ->where('status', 'active')
            ->with('vehicle')
            ->orderBy('rental_start_date', 'desc');
        $applySearch($activeRentalsQuery);
        $activeRentals = ($statusFilter === 'all' || $statusFilter === 'active') ? $activeRentalsQuery->get() : collect();

        // 4. Menunggu Pengecekan Fisik Manager (Status: PENDING_RETURN)
        $pendingReturnsQuery = Cart::where('user_id', $userId)
            ->where('status', 'pending_return')
            ->with('vehicle')
            ->orderBy('updated_at', 'desc');
        $applySearch($pendingReturnsQuery);
        $pendingReturns = ($statusFilter === 'all' || $statusFilter === 'pending_return') ? $pendingReturnsQuery->get() : collect();

        // 5. Menunggu Pelunasan Tagihan Denda / Reparasi (Status: PENDING_PAYMENT)
        $pendingPaymentsQuery = Cart::where('user_id', $userId)
            ->where('status', 'pending_payment')
            ->with(['vehicle', 'fine'])
            ->orderBy('updated_at', 'desc');
        $applySearch($pendingPaymentsQuery);
        $pendingPayments = ($statusFilter === 'all' || $statusFilter === 'pending_payment') ? $pendingPaymentsQuery->get() : collect();

        // 6. Riwayat Selesai (Completed)
        $completedRentalsQuery = Cart::where('user_id', $userId)
            ->where('status', 'completed')
            ->with('vehicle')
            ->orderBy('created_at', 'desc');
        $applySearch($completedRentalsQuery);
        $completedRentals = ($statusFilter === 'all' || $statusFilter === 'completed')
            ? $completedRentalsQuery->paginate(10, ['*'], 'completed_page')->appends($request->all())
            : new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10, null, ['pageName' => 'completed_page']);

        // 7. Riwayat Dibatalkan & Ditolak (Cancelled & Rejected)
        $cancelledRentalsQuery = Cart::where('user_id', $userId)
            ->whereIn('status', ['cancelled', 'rejected'])
            ->with('vehicle')
            ->orderBy('created_at', 'desc');
        $applySearch($cancelledRentalsQuery);
        $cancelledRentals = ($statusFilter === 'all' || in_array($statusFilter, ['cancelled', 'rejected']))
            ? $cancelledRentalsQuery->paginate(10, ['*'], 'cancelled_page')->appends($request->all())
            : new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10, null, ['pageName' => 'cancelled_page']);

        // Kalkulasi keterlambatan untuk sewa aktif
        $activeRentals->each(function (Cart $rental) {
            $rental->late = LateFeeCalculator::calculate($rental);
        });

        // Statistik
        $totalRentals = $counts['completed'];
        $totalSpent = Cart::where('user_id', $userId)
            ->where('status', 'completed')
            ->sum('total_payment');
        if ($totalSpent == 0) {
            $totalSpent = Cart::where('user_id', $userId)
                ->where('status', 'completed')
                ->sum('subtotal');
        }

        return view('user.rental.index', compact(
            'pendingApprovals',
            'approvedOtw',
            'activeRentals',
            'pendingReturns',
            'pendingPayments',
            'completedRentals',
            'cancelledRentals',
            'statusFilter',
            'search',
            'counts',
            'totalRentals',
            'totalSpent'
        ));
    }

    /**
     * User Membatalkan Booking Sebelum Di-approve Manager.
     */
    public function cancelBooking($bookingCode)
    {
        $carts = Cart::where('user_id', auth()->id())
            ->where('booking_code', $bookingCode)
            ->where('status', 'paid')
            ->with('vehicle')
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('user.rental')
                ->with('error', 'Booking tidak dapat dibatalkan atau sudah disetujui manager.');
        }

        DB::transaction(function () use ($carts) {
            foreach ($carts as $cart) {
                $cart->status = 'cancelled';
                $cart->save();
            }

            $carts->first()->payment()->update([
                'payment_status' => 'failed',
            ]);
        });

        return redirect()->route('user.rental')
            ->with('just_cancelled', true)
            ->with('success', 'Booking berhasil dibatalkan. Pengembalian dana otomatis berhasil diproses ke akun Anda.');
    }

    /**
     * Tampilan Konfirmasi Pengembalian
     */
    public function return($id)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->where('id', $id)
            ->where('status', 'active')
            ->with('vehicle')
            ->firstOrFail();

        $late = LateFeeCalculator::calculate($cart, now());

        return view('user.rental.return', compact('cart', 'late'));
    }

    /**
     * Trigger User: User klik tombol "Kembalikan" di gerai.
     * Status berubah menjadi PENDING_RETURN (Menunggu Pengecekan Fisik Manager).
     */
    public function processReturn(Request $request, $id)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->where('id', $id)
            ->where('status', 'active')
            ->firstOrFail();

        $cart->status = 'pending_return';
        $cart->save();

        return redirect()->route('user.rental')
            ->with('success', 'Permintaan pengembalian telah dikirim! Silakan serahkan kunci dan unit kepada Manager untuk pengecekan fisik kendaraan.');
    }

    /**
     * Halaman Pembayaran Denda & Reparasi Rusak
     */
    public function fine($id)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->where('id', $id)
            ->with(['vehicle', 'fine'])
            ->firstOrFail();

        $fine = Fine::where('cart_id', $cart->id)->first();

        return view('user.rental.fine', compact('cart', 'fine'));
    }

    /**
     * User Membayar Denda / Biaya Reparasi
     */
    public function payFine(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|in:qris,bank_transfer,gopay,dana,ovo',
        ], [
            'payment_method.required' => 'Pilih salah satu metode pembayaran untuk melunasi denda.',
        ]);

        $cart = Cart::where('user_id', auth()->id())
            ->where('id', $id)
            ->with(['vehicle', 'fine'])
            ->firstOrFail();

        $fine = Fine::where('cart_id', $cart->id)->first();

        DB::beginTransaction();
        try {
            if ($fine) {
                $fine->payment_status = 'paid';
                $fine->payment_method = $request->payment_method;
                $fine->paid_at = now();
                $fine->save();
            }

            $cart->status = 'completed';
            $cart->save();

            // Jika unit aman (tidak rusak), pastikan stok kembali
            // Jika unit rusak, unit tetap di damaged_stock sampai manager mereparasi
            if ($cart->damage_fee <= 0 && $cart->vehicle) {
                $cart->vehicle->available_stock = min($cart->vehicle->total_stock, $cart->vehicle->available_stock + 1);
                $cart->vehicle->save();
            }

            RentalHistory::create([
                'id' => Str::uuid(),
                'cart_id' => $cart->id,
                'user_id' => auth()->id(),
                'vehicle_id' => $cart->vehicle_id,
                'vehicle_name' => $cart->vehicle->name ?? 'Kendaraan',
                'quantity' => $cart->quantity ?? 1,
                'total_price' => $cart->subtotal,
                'start_date' => $cart->rental_start_date,
                'end_date' => $cart->rental_end_date,
                'pickup_location' => $cart->pickup_location,
                'status' => 'completed',
                'returned_at' => now(),
                'fine_amount' => $fine->total_fine ?? ($cart->fine_amount + $cart->damage_fee),
            ]);

            DB::commit();

            return redirect()->route('user.rental')
                ->with('just_paid_fine', true)
                ->with('success', 'Denda dan biaya perbaikan berhasil dilunasi! Terima kasih.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses pembayaran denda: ' . $e->getMessage());
        }
    }
}
