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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RentalController extends Controller
{
    public function index(Request $request)
    {
        $location = auth()->user()->location;
        $statusFilter = $request->query('status', 'all');
        $search = trim($request->query('search', ''));

        // Helper filter pencarian booking code, customer, atau armada
        $applySearch = function ($query) use ($search) {
            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('booking_code', 'like', "%{$search}%")
                      ->orWhereHas('user', function ($uq) use ($search) {
                          $uq->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%")
                             ->orWhere('phone', 'like', "%{$search}%");
                      })
                      ->orWhereHas('vehicle', function ($vq) use ($search) {
                          $vq->where('name', 'like', "%{$search}%")
                             ->orWhere('brand', 'like', "%{$search}%");
                      });
                });
            }
        };

        // Ringkasan hitungan badge per status
        $counts = [
            'all' => Cart::whereHas('vehicle', fn($q) => $q->where('location', $location))->count(),
            'paid' => Cart::where('status', 'paid')->whereHas('vehicle', fn($q) => $q->where('location', $location))->count(),
            'approved' => Cart::where('status', 'approved')->whereHas('vehicle', fn($q) => $q->where('location', $location))->count(),
            'active' => Cart::where('status', 'active')->whereHas('vehicle', fn($q) => $q->where('location', $location))->count(),
            'pending_return' => Cart::where('status', 'pending_return')->whereHas('vehicle', fn($q) => $q->where('location', $location))->count(),
            'pending_payment' => Cart::where('status', 'pending_payment')->whereHas('vehicle', fn($q) => $q->where('location', $location))->count(),
            'completed' => Cart::where('status', 'completed')->whereHas('vehicle', fn($q) => $q->where('location', $location))->count(),
            'cancelled' => Cart::where('status', 'cancelled')->whereHas('vehicle', fn($q) => $q->where('location', $location))->count(),
            'rejected' => Cart::where('status', 'rejected')->whereHas('vehicle', fn($q) => $q->where('location', $location))->count(),
        ];

        // 1. Menunggu Persetujuan Manager (Status: PAID)
        $pendingApprovalsQuery = Cart::where('status', 'paid')
            ->whereHas('vehicle', fn($q) => $q->where('location', $location))
            ->with(['vehicle', 'user'])
            ->orderBy('created_at', 'asc');
        $applySearch($pendingApprovalsQuery);
        $pendingApprovals = ($statusFilter === 'all' || $statusFilter === 'paid') ? $pendingApprovalsQuery->get() : collect();

        // 2. Disetujui / Armada OTW diantar (Status: APPROVED -> Menunggu Serah Terima & Foto KTP)
        $approvedRentalsQuery = Cart::where('status', 'approved')
            ->whereHas('vehicle', fn($q) => $q->where('location', $location))
            ->with(['vehicle', 'user'])
            ->orderBy('updated_at', 'desc');
        $applySearch($approvedRentalsQuery);
        $approvedRentals = ($statusFilter === 'all' || $statusFilter === 'approved') ? $approvedRentalsQuery->get() : collect();

        // 3. Sewa Aktif / Sedang Digunakan (Status: ACTIVE)
        $activeRentalsQuery = Cart::where('status', 'active')
            ->whereHas('vehicle', fn($q) => $q->where('location', $location))
            ->with(['vehicle', 'user'])
            ->orderBy('rental_start_date', 'desc');
        $applySearch($activeRentalsQuery);
        $activeRentals = ($statusFilter === 'all' || $statusFilter === 'active') ? $activeRentalsQuery->get() : collect();

        // 4. Menunggu Pengecekan Fisik Unit (Status: PENDING_RETURN)
        $pendingReturnsQuery = Cart::where('status', 'pending_return')
            ->whereHas('vehicle', fn($q) => $q->where('location', $location))
            ->with(['vehicle', 'user'])
            ->orderBy('updated_at', 'desc');
        $applySearch($pendingReturnsQuery);
        $pendingReturns = ($statusFilter === 'all' || $statusFilter === 'pending_return') ? $pendingReturnsQuery->get() : collect();

        // 5. Menunggu Pelunasan Denda / Reparasi (Status: PENDING_PAYMENT)
        $pendingPaymentsQuery = Cart::where('status', 'pending_payment')
            ->whereHas('vehicle', fn($q) => $q->where('location', $location))
            ->with(['vehicle', 'user', 'fine'])
            ->orderBy('updated_at', 'desc');
        $applySearch($pendingPaymentsQuery);
        $pendingPayments = ($statusFilter === 'all' || $statusFilter === 'pending_payment') ? $pendingPaymentsQuery->get() : collect();

        // 6. Riwayat Selesai (Completed)
        $completedRentalsQuery = Cart::where('status', 'completed')
            ->whereHas('vehicle', fn($q) => $q->where('location', $location))
            ->with(['vehicle', 'user'])
            ->orderBy('updated_at', 'desc');
        $applySearch($completedRentalsQuery);
        $completedRentals = ($statusFilter === 'all' || $statusFilter === 'completed')
            ? $completedRentalsQuery->paginate(10, ['*'], 'completed_page')->appends($request->all())
            : new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10, null, ['pageName' => 'completed_page']);

        // 7. Riwayat Dibatalkan & Ditolak (Cancelled & Rejected)
        $cancelledRentalsQuery = Cart::whereIn('status', ['cancelled', 'rejected'])
            ->whereHas('vehicle', fn($q) => $q->where('location', $location))
            ->with(['vehicle', 'user'])
            ->orderBy('updated_at', 'desc');
        $applySearch($cancelledRentalsQuery);
        $cancelledRentals = ($statusFilter === 'all' || in_array($statusFilter, ['cancelled', 'rejected']))
            ? $cancelledRentalsQuery->paginate(10, ['*'], 'cancelled_page')->appends($request->all())
            : new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10, null, ['pageName' => 'cancelled_page']);

        // Tambahkan kalkulasi keterlambatan & link WhatsApp untuk sewa aktif & pending return
        $activeRentals->each(function (Cart $rental) {
            $rental->late = LateFeeCalculator::calculate($rental);
            $rental->whatsapp_url = $this->whatsappUrl($rental);
        });

        $pendingReturns->each(function (Cart $rental) {
            $rental->late = LateFeeCalculator::calculate($rental);
            $rental->whatsapp_url = $this->whatsappUrl($rental);
        });

        return view('manager.rentals', compact(
            'pendingApprovals',
            'approvedRentals',
            'activeRentals',
            'pendingReturns',
            'pendingPayments',
            'completedRentals',
            'cancelledRentals',
            'statusFilter',
            'search',
            'counts'
        ));
    }

    /**
     * 1. Setujui Booking (Status: APPROVED)
     * Pada tahap ini stok kendaraan resmi berkurang, dan armada disiapkan untuk diantar.
     */
    public function approve($bookingCode)
    {
        $location = auth()->user()->location;
        $carts = Cart::where('booking_code', $bookingCode)
            ->where('status', 'paid')
            ->whereHas('vehicle', fn($q) => $q->where('location', $location))
            ->with('vehicle')
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('manager.rentals')
                ->with('error', 'Transaksi booking tidak ditemukan atau sudah diproses.');
        }

        DB::beginTransaction();
        try {
            foreach ($carts as $cart) {
                $vehicle = $cart->vehicle;
                if ($vehicle->available_stock < 1) {
                    throw new \Exception("Stok unit {$vehicle->name} tidak mencukupi untuk disetujui!");
                }

                // Kurangi stok unit saat disetujui (APPROVED)
                $vehicle->available_stock = max(0, $vehicle->available_stock - 1);
                $vehicle->save();

                $cart->status = 'approved';
                $cart->save();
            }

            // Update payment status ke success
            $carts->first()->payment()->update([
                'payment_status' => 'success',
                'paid_at' => now(),
            ]);

            DB::commit();

            return redirect()->route('manager.rentals')
                ->with('success', "Booking {$bookingCode} berhasil DISETUJUI! Stok armada telah berkurang. Status armada saat ini: Sedang Diantar / Menunggu Serah Terima.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('manager.rentals')
                ->with('error', 'Gagal menyetujui booking: ' . $e->getMessage());
        }
    }

    /**
     * Tolak Booking (Status: REJECTED)
     * Jika ditolak sebelum diserahkan, unit belum berkurang, dana otomatis dikembalikan.
     */
    public function reject(Request $request, $bookingCode)
    {
        $request->validate([
            'reject_reason' => 'required|string|max:500',
        ], [
            'reject_reason.required' => 'Wajib memberikan alasan penolakan booking!',
        ]);

        $location = auth()->user()->location;
        $carts = Cart::where('booking_code', $bookingCode)
            ->where('status', 'paid')
            ->whereHas('vehicle', fn($q) => $q->where('location', $location))
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('manager.rentals')
                ->with('error', 'Booking tidak ditemukan.');
        }

        foreach ($carts as $cart) {
            $cart->status = 'rejected';
            $cart->reject_reason = $request->reject_reason;
            $cart->save();
        }

        return redirect()->route('manager.rentals')
            ->with('success', "Booking {$bookingCode} telah DITOLAK. Pengembalian dana otomatis berhasil diproses.");
    }

    /**
     * 2. Serah Terima Unit & Upload Foto KTP (Status: ACTIVE)
     * Detik tombol ini ditekan, status berubah jadi ACTIVE dan timer sewa resmi dimulai.
     */
    public function handover(Request $request, $id)
    {
        $request->validate([
            'ktp_image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ], [
            'ktp_image.required' => 'Foto jaminan KTP pelanggan wajib diunggah sebelum serah terima!',
            'ktp_image.image' => 'File harus berupa gambar (JPG/PNG).',
            'ktp_image.max' => 'Ukuran file foto KTP maksimal 5MB.',
        ]);

        $location = auth()->user()->location;
        $cart = Cart::where('id', $id)
            ->where('status', 'approved')
            ->whereHas('vehicle', fn($q) => $q->where('location', $location))
            ->firstOrFail();

        $ktpPath = $request->file('ktp_image')->store('ktp_guarantees', 'public');

        $now = now();
        $totalDays = $cart->quantity_days ?? ($cart->period === 'weekly' ? 7 : 1);

        $cart->status = 'active';
        $cart->ktp_image = $ktpPath;
        $cart->handover_at = $now;
        $cart->rental_start_date = $now;
        $cart->rental_end_date = $now->copy()->addDays($totalDays);
        $cart->save();

        return redirect()->route('manager.rentals')
            ->with('success', "Kendaraan telah resmi diserahterimakan! Foto KTP tersimpan. Masa sewa resmi AKTIF dan timer dimulai sekarang.");
    }

    /**
     * 3. Pengecekan Fisik Unit & Pengembalian (Unit Aman vs Unit Rusak)
     */
    public function inspectReturn(Request $request, $id)
    {
        $request->validate([
            'condition' => 'required|in:safe,damaged',
            'damage_fee' => 'required_if:condition,damaged|nullable|numeric|min:0',
            'damage_note' => 'required_if:condition,damaged|nullable|string|max:1000',
        ], [
            'condition.required' => 'Pilih kondisi fisik unit kendaraan!',
            'damage_fee.required_if' => 'Nominal biaya reparasi wajib diisi jika unit dalam kondisi rusak!',
            'damage_note.required_if' => 'Keterangan bagian yang rusak wajib diisi!',
        ]);

        $location = auth()->user()->location;
        $cart = Cart::where('id', $id)
            ->whereIn('status', ['active', 'pending_return'])
            ->whereHas('vehicle', fn($q) => $q->where('location', $location))
            ->with(['vehicle', 'user'])
            ->firstOrFail();

        $now = now();
        $late = LateFeeCalculator::calculate($cart, $now);
        $isLate = $late['is_late'];
        $lateFine = (float) $late['fine_amount'];
        $lateMinutes = (int) $late['late_minutes'];

        $vehicle = $cart->vehicle;
        $condition = $request->condition;
        $damageFee = $condition === 'damaged' ? (float) $request->damage_fee : 0;
        $damageNote = $condition === 'damaged' ? $request->damage_note : null;

        $totalExtraCharge = $lateFine + $damageFee;

        DB::beginTransaction();
        try {
            $cart->returned_at = $now;
            $cart->is_late = $isLate;
            $cart->late_minutes = $lateMinutes;
            $cart->fine_amount = $lateFine;
            $cart->damage_fee = $damageFee;
            $cart->damage_note = $damageNote;

            if ($condition === 'damaged') {
                // Unit rusak: catat ke damaged_stock dan jangan kembalikan ke available_stock
                if ($vehicle) {
                    $vehicle->damaged_stock += 1;
                    $vehicle->save();
                }
            }

            if ($totalExtraCharge > 0) {
                // Ada tagihan (denda telat atau reparasi rusak) -> status PENDING_PAYMENT
                $cart->status = 'pending_payment';
                $cart->save();

                Fine::updateOrCreate(
                    ['cart_id' => $cart->id],
                    [
                        'id' => Str::uuid(),
                        'user_id' => $cart->user_id,
                        'vehicle_id' => $cart->vehicle_id,
                        'late_minutes' => $lateMinutes,
                        'fine_per_hour' => LateFeeCalculator::FINE_PER_HOUR,
                        'total_fine' => $totalExtraCharge,
                        'payment_status' => 'pending',
                    ]
                );

                DB::commit();

                $details = [];
                if ($damageFee > 0) $details[] = "Biaya Reparasi: Rp " . number_format($damageFee, 0, ',', '.');
                if ($lateFine > 0) $details[] = "Denda Telat: Rp " . number_format($lateFine, 0, ',', '.');

                return redirect()->route('manager.rentals')
                    ->with('warning', "Pengecekan fisik selesai! Diterbitkan tagihan ke User sebesar Rp " . number_format($totalExtraCharge, 0, ',', '.') . " (" . implode(', ', $details) . "). Status: Menunggu Pembayaran.");
            } else {
                // Unit aman & tidak telat -> Langsung COMPLETED
                $cart->status = 'completed';
                $cart->save();

                // Kembalikan unit ke stok tersedia
                if ($vehicle && $condition === 'safe') {
                    $vehicle->available_stock = min($vehicle->total_stock, $vehicle->available_stock + 1);
                    $vehicle->save();
                }

                RentalHistory::create([
                    'id' => Str::uuid(),
                    'cart_id' => $cart->id,
                    'user_id' => $cart->user_id,
                    'vehicle_id' => $cart->vehicle_id,
                    'vehicle_name' => $vehicle->name ?? 'Kendaraan',
                    'quantity' => $cart->quantity ?? 1,
                    'total_price' => $cart->subtotal,
                    'start_date' => $cart->rental_start_date,
                    'end_date' => $cart->rental_end_date,
                    'pickup_location' => $cart->pickup_location,
                    'status' => 'completed',
                    'returned_at' => $now,
                    'fine_amount' => 0,
                ]);

                DB::commit();

                return redirect()->route('manager.rentals')
                    ->with('success', "Unit AMAN dan tidak telat! Sewa resmi SELESAI (COMPLETED). Stok kendaraan telah kembali tersedia.");
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('manager.rentals')
                ->with('error', 'Gagal memproses pengembalian: ' . $e->getMessage());
        }
    }

    /**
     * Flag sewa (dispute/lost).
     */
    public function flag(Request $request, $id)
    {
        $data = $request->validate([
            'status' => 'required|in:dispute,lost',
            'note'   => 'required|string|max:1000',
        ]);

        $location = auth()->user()->location;
        $cart = Cart::where('id', $id)
            ->whereHas('vehicle', fn ($q) => $q->where('location', $location))
            ->with(['vehicle', 'user'])
            ->firstOrFail();

        DB::transaction(function () use ($cart, $data) {
            $cart->status = $data['status'];
            $cart->dispute_note = $data['note'];
            $cart->save();

            $user = $cart->user;
            if ($user) {
                $user->suspended_at = now();
                $user->suspended_reason = "Sewa {$cart->booking_code} ditandai {$data['status']}: {$data['note']}";
                $user->save();

                DB::table('sessions')->where('user_id', $user->id)->delete();
            }
        });

        return redirect()->route('manager.rentals')
            ->with('success', "Sewa {$cart->booking_code} ditandai " . strtoupper($data['status']) . " dan akun penyewa di-suspend.");
    }

    private function whatsappUrl(Cart $rental): ?string
    {
        $phone = preg_replace('/\D/', '', (string) $rental->user?->phone);
        if ($phone === '') return null;
        if (str_starts_with($phone, '0')) $phone = '62' . substr($phone, 1);

        $late = $rental->late ?? LateFeeCalculator::calculate($rental);
        $vehicle = $rental->vehicle->name ?? 'kendaraan';
        $name = $rental->user->name ?? 'Pelanggan';

        $message = $late['is_late']
            ? "Halo {$name}, kami dari GoAnywhere cabang " . auth()->user()->location . ". Sewa {$vehicle} (kode {$rental->booking_code}) telah melewati batas pengembalian selama {$late['duration_label']}. Denda berjalan saat ini " . LateFeeCalculator::rupiah($late['fine_amount']) . ". Mohon segera mengembalikan unit. Terima kasih."
            : "Halo {$name}, kami dari GoAnywhere cabang " . auth()->user()->location . ". Mengingatkan sewa {$vehicle} (kode {$rental->booking_code}) jatuh tempo pada " . $late['due_at']->translatedFormat('d M Y H:i') . ". Terima kasih.";

        return 'https://wa.me/' . $phone . '?text=' . rawurlencode($message);
    }
}
