<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Kelola Transaksi & Pengantaran - Cabang {{ Auth::user()->location }}
                </h2>
                <p class="text-xs text-gray-500 mt-1">Pantau pesanan baru, serah terima unit, cek fisik kendaraan, dan pembayaran denda.</p>
            </div>
            <span class="px-3 py-1 bg-[#004B87]/10 text-[#004B87] dark:text-blue-300 font-bold text-xs rounded-full">
                📍 Cabang {{ Auth::user()->location }}
            </span>
        </div>
    </x-slot>

    <style>
        .transaksi-section {
            padding: 30px 0 60px;
            background: #F0F4F8;
            min-height: 100vh;
        }
        .dark .transaksi-section {
            background: #001F3F;
        }
        .section-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 24px 28px;
            margin-bottom: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(15, 23, 42, 0.08);
            transition: all 0.3s ease;
        }
        .dark .section-card {
            background: #0f172a;
            border-color: rgba(255, 255, 255, 0.08);
            box-shadow: 0 8px 30px rgba(0,0,0,0.3);
        }
        .section-title {
            font-size: 17px;
            font-weight: 700;
            color: #002D55;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
        }
        .dark .section-title {
            color: #f8fafc;
        }
        .table-wrap {
            overflow-x: auto;
        }
        .table-wrap table {
            width: 100%;
            border-collapse: collapse;
        }
        .table-wrap thead th {
            padding: 12px 16px;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            color: #004B87;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: #F8FAFC;
        }
        .dark .table-wrap thead th {
            background: #1e293b;
            color: #93c5fd;
        }
        .table-wrap tbody td {
            padding: 14px 16px;
            font-size: 13px;
            color: #334155;
            border-top: 1px solid #f1f5f9;
        }
        .dark .table-wrap tbody td {
            color: #cbd5e1;
            border-top-color: #1e293b;
        }
        .table-wrap tbody tr:hover {
            background: rgba(106, 155, 209, 0.05);
        }
        .btn-action-primary {
            padding: 7px 14px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 700;
            color: #ffffff;
            background: #004B87;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
        }
        .btn-action-primary:hover {
            background: #002D55;
            transform: translateY(-1px);
        }
        .btn-action-danger {
            padding: 7px 12px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 700;
            color: #e11d48;
            background: #ffe4e6;
            border: 1px solid #fecdd3;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-action-danger:hover {
            background: #f43f5e;
            color: #ffffff;
        }
        .btn-chat-link {
            padding: 7px 12px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
            background: #f1f5f9;
            color: #334155;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-chat-link:hover {
            background: #e2e8f0;
            color: #0f172a;
        }
        .dark .btn-chat-link {
            background: #1e293b;
            color: #94a3b8;
        }
        .dark .btn-chat-link:hover {
            background: #334155;
            color: #f8fafc;
        }
        .empty-box {
            padding: 32px;
            text-align: center;
            color: #94a3b8;
            font-size: 13px;
        }
    </style>

    <div class="transaksi-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Flash Alerts --}}
            @if(session('success'))
                <div class="p-4 mb-5 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center gap-2">
                    <span>✅</span> {{ session('success') }}
                </div>
            @endif
            @if(session('warning'))
                <div class="p-4 mb-5 rounded-2xl bg-amber-50 border border-amber-200 text-amber-800 text-sm font-semibold flex items-center gap-2">
                    <span>⚠️</span> {{ session('warning') }}
                </div>
            @endif
            @if(session('error'))
                <div class="p-4 mb-5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-sm font-semibold flex items-center gap-2">
                    <span>❌</span> {{ session('error') }}
                </div>
            @endif

            {{-- SEARCH & FILTER BY STATUS BAR --}}
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-5 mb-6 border border-slate-200 dark:border-slate-800 shadow-sm">
                <form action="{{ route('manager.rentals') }}" method="GET" class="flex flex-col sm:flex-row gap-3 items-center justify-between">
                    {{-- Search Input --}}
                    <div class="relative w-full flex-1">
                        <input type="text" name="search" value="{{ $search }}" placeholder="Cari Kode Booking, Nama Customer, No. HP, atau Armada..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm focus:ring-2 focus:ring-[#004B87] focus:outline-none">
                        <input type="hidden" name="status" value="{{ $statusFilter }}">
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center gap-2 w-full sm:w-auto shrink-0">
                        <button type="submit" class="flex-1 sm:flex-initial px-6 py-2.5 bg-[#004B87] hover:bg-[#002D55] text-white rounded-xl text-sm font-bold shadow-sm transition">
                            Cari
                        </button>
                        @if(!empty($search) || $statusFilter !== 'all')
                            <a href="{{ route('manager.rentals') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-xl text-sm font-semibold transition" title="Reset filter">
                                ↺ Reset
                            </a>
                        @endif
                    </div>
                </form>

                {{-- Status Pills Tabs --}}
                <div class="flex items-center gap-2 overflow-x-auto pt-3.5 mt-3 border-t border-slate-100 dark:border-slate-800 text-xs font-semibold no-scrollbar">
                    @php
                        $filterTabs = [
                            'all' => ['label' => 'Semua', 'icon' => '📌', 'count' => $counts['all']],
                            'paid' => ['label' => 'Menunggu Approve', 'icon' => '⏳', 'count' => $counts['paid']],
                            'approved' => ['label' => 'Armada OTW', 'icon' => '🚚', 'count' => $counts['approved']],
                            'active' => ['label' => 'Sewa Aktif', 'icon' => '🚗', 'count' => $counts['active']],
                            'pending_return' => ['label' => 'Cek Fisik Unit', 'icon' => '🔍', 'count' => $counts['pending_return']],
                            'pending_payment' => ['label' => 'Menunggu Denda', 'icon' => '💳', 'count' => $counts['pending_payment']],
                            'completed' => ['label' => 'Selesai', 'icon' => '✅', 'count' => $counts['completed']],
                            'cancelled' => ['label' => 'Dibatalkan', 'icon' => '❌', 'count' => $counts['cancelled']],
                            'rejected' => ['label' => 'Ditolak', 'icon' => '🚫', 'count' => $counts['rejected']],
                        ];
                    @endphp
                    @foreach($filterTabs as $tabKey => $tab)
                        <a href="{{ route('manager.rentals', ['search' => $search, 'status' => $tabKey]) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl whitespace-nowrap transition {{ $statusFilter === $tabKey ? 'bg-[#004B87] text-white shadow-sm' : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200' }}">
                            <span>{{ $tab['icon'] }}</span>
                            <span>{{ $tab['label'] }}</span>
                            <span class="px-1.5 py-0.5 rounded-full text-[10px] {{ $statusFilter === $tabKey ? 'bg-white/20 text-white' : 'bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200' }} font-bold">{{ $tab['count'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- ======================================================== -->
            <!-- 1. MENUNGGU PERSETUJUAN (STATUS: PAID)                   -->
            <!-- ======================================================== -->
            @if($statusFilter === 'all' || $statusFilter === 'paid')
            <div class="section-card border-l-4 border-l-amber-500">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="section-title text-amber-700 dark:text-amber-400">
                        <span>⏳</span> Menunggu Persetujuan Booking (Paid)
                    </h3>
                    <span class="text-xs font-bold px-2.5 py-1 bg-amber-100 dark:bg-amber-950 text-amber-800 dark:text-amber-300 rounded-full">
                        {{ count($pendingApprovals) }} Booking Baru
                    </span>
                </div>
                <p class="text-xs text-slate-500 mb-4">Pelanggan telah melakukan pembayaran. Stok unit baru berkurang setelah Anda klik "Setujui Booking".</p>

                @if(count($pendingApprovals) > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode Booking</th>
                                    <th>Armada Kendaraan</th>
                                    <th>Pelanggan & Titik Antar</th>
                                    <th>Durasi Sewa</th>
                                    <th>Total Bayar (+Ongkir)</th>
                                    <th>Aksi Manager</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingApprovals as $item)
                                    <tr>
                                        <td><span class="font-mono font-bold text-[#004B87] dark:text-blue-300">{{ $item->booking_code }}</span></td>
                                        <td>
                                            <div class="font-bold text-slate-900 dark:text-white">{{ $item->vehicle->name }}</div>
                                            <div class="text-xs text-slate-500">{{ $item->vehicle->brand }} • Stok Tersedia: {{ $item->vehicle->available_stock }} unit</div>
                                        </td>
                                        <td>
                                            <div class="font-semibold text-slate-800 dark:text-slate-200">{{ $item->user->name }} ({{ $item->user->phone }})</div>
                                            <div class="text-xs text-slate-500 truncate max-w-xs" title="{{ $item->pickup_location }}">
                                                📍 {{ $item->pickup_location }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="px-2 py-0.5 rounded text-xs font-semibold {{ $item->period === 'weekly' ? 'bg-purple-100 text-purple-800' : 'bg-slate-100 text-slate-800' }}">
                                                {{ $item->period === 'weekly' ? '🎁 Paket 7 Hari' : $item->quantity_days . ' Hari' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="font-bold text-slate-900 dark:text-white">
                                                Rp {{ number_format($item->total_payment > 0 ? $item->total_payment : $item->subtotal, 0, ',', '.') }}
                                            </div>
                                            <div class="text-[11px] text-emerald-600 font-medium">Termasuk Ongkir Antar</div>
                                        </td>
                                        <td>
                                            <div class="flex items-center gap-2">
                                                <form action="{{ route('manager.rentals.approve', $item->booking_code) }}" method="POST" onsubmit="return confirm('Setujui booking ini? Stok kendaraan akan otomatis dipotong 1 unit dan status berubah menjadi armada OTW diantar.')">
                                                    @csrf
                                                    <button type="submit" class="btn-action-primary">
                                                        <span>✅</span> Setujui Booking
                                                    </button>
                                                </form>
                                                <button type="button" onclick="openRejectModal('{{ $item->booking_code }}', '{{ $item->vehicle->name }}', '{{ $item->user->name }}')" class="btn-action-danger">
                                                    Tolak
                                                </button>
                                                <a href="{{ route('manager.chat.start', ['user_id' => $item->user_id, 'vehicle_id' => $item->vehicle_id]) }}" class="btn-chat-link">
                                                    💬 Chat
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-box">Tidak ada booking baru yang menunggu persetujuan.</div>
                @endif
            </div>
            @endif

            <!-- ======================================================== -->
            <!-- 2. ARMADA DISETUJUI / OTW (STATUS: APPROVED)             -->
            <!-- ======================================================== -->
            @if($statusFilter === 'all' || $statusFilter === 'approved')
            <div class="section-card border-l-4 border-l-blue-600">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="section-title text-blue-800 dark:text-blue-300">
                        <span>🚚</span> Armada OTW & Serah Terima KTP (Approved)
                    </h3>
                    <span class="text-xs font-bold px-2.5 py-1 bg-blue-100 dark:bg-blue-950 text-blue-800 dark:text-blue-200 rounded-full">
                        {{ count($approvedRentals) }} Unit Sedang OTW
                    </span>
                </div>
                <p class="text-xs text-slate-500 mb-4">Armada sedang diantar ke alamat pelanggan. Saat bertemu pelanggan, wajib unggah foto jaminan (KTP) dan konfirmasi serah terima agar masa sewa resmi dimulai.</p>

                @if(count($approvedRentals) > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode Booking</th>
                                    <th>Kendaraan</th>
                                    <th>Pelanggan</th>
                                    <th>Alamat Pengantaran</th>
                                    <th>Aksi Serah Terima Unit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($approvedRentals as $item)
                                    <tr>
                                        <td><span class="font-mono font-bold text-blue-700 dark:text-blue-300">{{ $item->booking_code }}</span></td>
                                        <td class="font-bold text-slate-900 dark:text-white">{{ $item->vehicle->name }}</td>
                                        <td>
                                            <div class="font-semibold">{{ $item->user->name }}</div>
                                            <div class="text-xs text-slate-500">{{ $item->user->phone }}</div>
                                            @if($item->ktp_image)
                                                <button type="button" 
                                                        onclick="openViewKtpModal('{{ asset('storage/' . $item->ktp_image) }}', '{{ addslashes($item->user->name) }}', '{{ $item->booking_code }}', '{{ addslashes($item->vehicle->name) }}')"
                                                        class="mt-1 inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[11px] font-bold bg-sky-100 hover:bg-sky-200 text-sky-800 dark:bg-sky-950 dark:text-sky-300 transition shadow-sm">
                                                    <span>🪪</span> Lihat KTP
                                                </button>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="text-xs font-semibold text-slate-700 dark:text-slate-300">
                                                📍 {{ $item->pickup_location }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="flex items-center gap-2">
                                                <button type="button" onclick="openHandoverModal('{{ $item->id }}', '{{ $item->booking_code }}', '{{ $item->vehicle->name }}', '{{ $item->user->name }}')" class="btn-action-primary bg-emerald-600 hover:bg-emerald-700">
                                                    <span>📸</span> Serah Terima & Upload KTP
                                                </button>
                                                <a href="{{ route('manager.chat.start', ['user_id' => $item->user_id, 'vehicle_id' => $item->vehicle_id]) }}" class="btn-chat-link">
                                                    💬 Hubungi User
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-box">Tidak ada armada yang sedang dalam perjalanan serah terima.</div>
                @endif
            </div>
            @endif

            <!-- ======================================================== -->
            <!-- 3. MENUNGGU CEK FISIK UNIT (STATUS: PENDING_RETURN)      -->
            <!-- ======================================================== -->
            @if($statusFilter === 'all' || $statusFilter === 'pending_return')
            <div class="section-card border-l-4 border-l-purple-600">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="section-title text-purple-800 dark:text-purple-300">
                        <span>🔍</span> Menunggu Pengecekan Fisik Unit (Pending Return)
                    </h3>
                    <span class="text-xs font-bold px-2.5 py-1 bg-purple-100 dark:bg-purple-950 text-purple-800 dark:text-purple-200 rounded-full">
                        {{ count($pendingReturns) }} Menunggu Inspeksi
                    </span>
                </div>
                <p class="text-xs text-slate-500 mb-4">Pelanggan telah menyerahkan kunci/unit di gerai. Lakukan inspeksi fisik (Aman / Rusak) untuk menyelesaikan transaksi atau menerbitkan tagihan denda/reparasi.</p>

                @if(count($pendingReturns) > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode Booking</th>
                                    <th>Kendaraan</th>
                                    <th>Penyewa</th>
                                    <th>Status Jatuh Tempo</th>
                                    <th>Aksi Pengecekan Fisik</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingReturns as $item)
                                    @php
                                        $late = $item->late ?? \App\Services\LateFeeCalculator::calculate($item);
                                    @endphp
                                    <tr>
                                        <td><span class="font-mono font-bold">{{ $item->booking_code }}</span></td>
                                        <td class="font-bold">{{ $item->vehicle->name }}</td>
                                        <td>
                                            <div class="font-semibold">{{ $item->user->name }}</div>
                                            <div class="text-xs text-slate-500">{{ $item->user->phone }}</div>
                                            @if($item->ktp_image)
                                                <button type="button" 
                                                        onclick="openViewKtpModal('{{ asset('storage/' . $item->ktp_image) }}', '{{ addslashes($item->user->name) }}', '{{ $item->booking_code }}', '{{ addslashes($item->vehicle->name) }}')"
                                                        class="mt-1 inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[11px] font-bold bg-sky-100 hover:bg-sky-200 text-sky-800 dark:bg-sky-950 dark:text-sky-300 transition shadow-sm">
                                                    <span>🪪</span> Lihat KTP
                                                </button>
                                            @endif
                                        </td>
                                        <td>
                                            @if($late['is_late'])
                                                <span class="px-2.5 py-1 bg-rose-100 text-rose-800 text-xs font-bold rounded-lg inline-flex items-center gap-1">
                                                    ⚠️ Terlambat {{ $late['duration_label'] }} (Denda: Rp {{ number_format($late['fine_amount'], 0, ',', '.') }})
                                                </span>
                                            @else
                                                <span class="px-2.5 py-1 bg-emerald-100 text-emerald-800 text-xs font-bold rounded-lg inline-flex items-center gap-1">
                                                    ✅ Tepat Waktu
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" onclick="openInspectModal('{{ $item->id }}', '{{ $item->booking_code }}', '{{ $item->vehicle->name }}', '{{ $late['is_late'] ? $late['fine_amount'] : 0 }}', '{{ $late['duration_label'] }}')" class="btn-action-primary bg-purple-600 hover:bg-purple-700">
                                                <span>🔍</span> Periksa Fisik Kendaraan
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-box">Tidak ada unit yang sedang menunggu pengecekan fisik saat ini.</div>
                @endif
            </div>
            @endif

            <!-- ======================================================== -->
            <!-- 4. MENUNGGU PEMBAYARAN DENDA (STATUS: PENDING_PAYMENT)   -->
            <!-- ======================================================== -->
            @if($statusFilter === 'all' || $statusFilter === 'pending_payment')
            @if(count($pendingPayments) > 0 || $statusFilter === 'pending_payment')
                <div class="section-card border-l-4 border-l-rose-500">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="section-title text-rose-700 dark:text-rose-400">
                            <span>💸</span> Menunggu Pelunasan Denda / Reparasi User
                        </h3>
                        <span class="text-xs font-bold px-2.5 py-1 bg-rose-100 text-rose-800 rounded-full">
                            {{ count($pendingPayments) }} Tagihan Belum Lunas
                        </span>
                    </div>
                    @if(count($pendingPayments) > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode Booking</th>
                                    <th>Kendaraan</th>
                                    <th>Penyewa</th>
                                    <th>Rincian Tagihan</th>
                                    <th>Total Denda</th>
                                    <th>Status Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingPayments as $item)
                                    @php
                                        $totalBill = ($item->fine->total_fine ?? 0) > 0 ? $item->fine->total_fine : ($item->fine_amount + $item->damage_fee);
                                    @endphp
                                    <tr>
                                        <td><span class="font-mono font-bold">{{ $item->booking_code }}</span></td>
                                        <td class="font-bold">{{ $item->vehicle->name }}</td>
                                        <td>
                                            <div class="font-semibold">{{ $item->user->name }}</div>
                                            <div class="text-xs text-slate-500">{{ $item->user->phone }}</div>
                                            @if($item->ktp_image)
                                                <button type="button" 
                                                        onclick="openViewKtpModal('{{ asset('storage/' . $item->ktp_image) }}', '{{ addslashes($item->user->name) }}', '{{ $item->booking_code }}', '{{ addslashes($item->vehicle->name) }}')"
                                                        class="mt-1 inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[11px] font-bold bg-sky-100 hover:bg-sky-200 text-sky-800 dark:bg-sky-950 dark:text-sky-300 transition shadow-sm">
                                                    <span>🪪</span> Lihat KTP
                                                </button>
                                            @endif
                                        </td>
                                        <td class="text-xs">
                                            @if($item->damage_fee > 0)
                                                <div class="text-rose-700 font-semibold">Reparasi: Rp {{ number_format($item->damage_fee, 0, ',', '.') }} ({{ $item->damage_note }})</div>
                                            @endif
                                            @if($item->fine_amount > 0)
                                                <div class="text-amber-700 font-semibold">Denda Telat: Rp {{ number_format($item->fine_amount, 0, ',', '.') }}</div>
                                            @endif
                                        </td>
                                        <td class="font-bold text-rose-600">
                                            Rp {{ number_format($totalBill, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <span class="px-2.5 py-1 bg-rose-100 text-rose-800 text-xs font-bold rounded-full">
                                                Menunggu User Bayar
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <div class="empty-box">Tidak ada tagihan denda atau reparasi yang menunggu pembayaran.</div>
                    @endif
                </div>
            @endif
            @endif

            <!-- ======================================================== -->
            <!-- 5. SEWA SEDANG BERJALAN / AKTIF (STATUS: ACTIVE)         -->
            <!-- ======================================================== -->
            @if($statusFilter === 'all' || $statusFilter === 'active')
            <div class="section-card border-l-4 border-l-emerald-600">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="section-title text-emerald-800 dark:text-emerald-300">
                        <span>🚗</span> Sewa Aktif / Masa Sewa Berjalan
                    </h3>
                    <span class="text-xs font-bold px-2.5 py-1 bg-emerald-100 text-emerald-800 rounded-full">
                        {{ count($activeRentals) }} Unit Digunakan
                    </span>
                </div>
                <p class="text-xs text-slate-500 mb-4">Unit sedang digunakan oleh pelanggan. Pantau jatuh tempo sewa dan jika pelanggan telah tiba di gerai untuk mengembalikan kendaraan, klik <strong>Konfirmasi Tiba di Gerai</strong> untuk menghentikan timer denda keterlambatan dan melanjutkan ke cek fisik.</p>
                @if(count($activeRentals) > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode Booking</th>
                                    <th>Kendaraan</th>
                                    <th>Penyewa</th>
                                    <th>Mulai Sewa (Handover)</th>
                                    <th>Wajib Kembali</th>
                                    <th>Aksi Cepat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activeRentals as $item)
                                    @php
                                        $late = $item->late ?? \App\Services\LateFeeCalculator::calculate($item);
                                    @endphp
                                    <tr>
                                        <td><span class="font-mono font-bold">{{ $item->booking_code }}</span></td>
                                        <td class="font-bold">{{ $item->vehicle->name }}</td>
                                        <td>
                                            <div class="font-semibold">{{ $item->user->name }}</div>
                                            <div class="text-xs text-slate-500">{{ $item->user->phone }}</div>
                                            @if($item->ktp_image)
                                                <button type="button" 
                                                        onclick="openViewKtpModal('{{ asset('storage/' . $item->ktp_image) }}', '{{ addslashes($item->user->name) }}', '{{ $item->booking_code }}', '{{ addslashes($item->vehicle->name) }}')"
                                                        class="mt-1 inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[11px] font-bold bg-sky-100 hover:bg-sky-200 text-sky-800 dark:bg-sky-950 dark:text-sky-300 transition shadow-sm">
                                                    <span>🪪</span> Lihat KTP
                                                </button>
                                            @endif
                                        </td>
                                        <td class="text-xs">{{ \Carbon\Carbon::parse($item->rental_start_date)->format('d M Y H:i') }}</td>
                                        <td class="text-xs font-semibold {{ $late['is_late'] ? 'text-rose-600' : 'text-slate-700' }}">
                                            {{ \Carbon\Carbon::parse($item->rental_end_date)->format('d M Y H:i') }}
                                            @if($late['is_late'])
                                                <span class="block text-[11px] text-rose-600 font-bold">⚠️ Telat {{ $late['duration_label'] }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="flex items-center gap-2">
                                                <form method="POST" action="{{ route('manager.rentals.arrive', $item->id) }}" onsubmit="return confirm('Konfirmasi bahwa unit {{ addslashes($item->vehicle->name) }} (Booking #{{ $item->booking_code }}) telah tiba di gerai cabang? Status akan dipindahkan ke Menunggu Cek Fisik Unit.')">
                                                    @csrf
                                                    <button type="submit" class="btn-action-primary bg-indigo-600 hover:bg-indigo-700 shadow-md shadow-indigo-600/20">
                                                        <span>📥</span> Konfirmasi Tiba di Gerai
                                                    </button>
                                                </form>
                                                <a href="{{ route('manager.chat.start', ['user_id' => $item->user_id, 'vehicle_id' => $item->vehicle_id]) }}" class="btn-chat-link">
                                                    💬 Chat Customer
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-box">Tidak ada sewa yang sedang aktif saat ini.</div>
                @endif
            </div>
            @endif

            <!-- ======================================================== -->
            <!-- 6. RIWAYAT TRANSAKSI SELESAI (STATUS: COMPLETED)         -->
            <!-- ======================================================== -->
            @if($statusFilter === 'all' || $statusFilter === 'completed')
            <div class="section-card border-l-4 border-l-emerald-500">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="section-title text-emerald-800 dark:text-emerald-300">
                        <span>✅</span> Riwayat Transaksi Selesai
                    </h3>
                    <span class="text-xs font-bold px-2.5 py-1 bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-200 rounded-full">
                        {{ $completedRentals->total() ?? count($completedRentals) }} Transaksi Tuntas
                    </span>
                </div>
                <p class="text-xs text-slate-500 mb-4">Daftar transaksi sewa yang telah selesai, armada kembali ke cabang, dan seluruh pembayaran tuntas.</p>

                @if(count($completedRentals) > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode Booking</th>
                                    <th>Kendaraan</th>
                                    <th>Penyewa</th>
                                    <th>Total Bayar</th>
                                    <th>Denda/Reparasi</th>
                                    <th>Status Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($completedRentals as $item)
                                    <tr>
                                        <td><span class="font-mono text-xs font-bold">{{ $item->booking_code }}</span></td>
                                        <td>{{ $item->vehicle->name }}</td>
                                        <td>
                                            <div class="font-semibold">{{ $item->user->name }}</div>
                                            @if($item->ktp_image)
                                                <button type="button" 
                                                        onclick="openViewKtpModal('{{ asset('storage/' . $item->ktp_image) }}', '{{ addslashes($item->user->name) }}', '{{ $item->booking_code }}', '{{ addslashes($item->vehicle->name) }}')"
                                                        class="mt-1 inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[11px] font-bold bg-sky-100 hover:bg-sky-200 text-sky-800 dark:bg-sky-950 dark:text-sky-300 transition shadow-sm">
                                                    <span>🪪</span> Lihat KTP
                                                </button>
                                            @endif
                                        </td>
                                        <td>Rp {{ number_format($item->total_payment > 0 ? $item->total_payment : $item->subtotal, 0, ',', '.') }}</td>
                                        <td>
                                            @if(($item->damage_fee + $item->fine_amount) > 0)
                                                <span class="text-rose-600 font-bold text-xs">Rp {{ number_format($item->damage_fee + $item->fine_amount, 0, ',', '.') }}</span>
                                            @else
                                                <span class="text-slate-400 text-xs">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="px-2.5 py-1 bg-emerald-100 text-emerald-800 text-xs font-bold rounded-full">✅ Selesai</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $completedRentals->links() }}
                    </div>
                @else
                    <div class="empty-box">Belum ada riwayat transaksi yang berstatus selesai.</div>
                @endif
            </div>
            @endif

            <!-- ======================================================== -->
            <!-- 7. RIWAYAT DIBATALKAN (CANCELLED)                        -->
            <!-- ======================================================== -->
            @if($statusFilter === 'all' || $statusFilter === 'cancelled')
            <div class="section-card border-l-4 border-l-slate-400">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="section-title text-slate-800 dark:text-slate-200">
                        <span>❌</span> Riwayat Dibatalkan (Customer)
                    </h3>
                    <span class="text-xs font-bold px-2.5 py-1 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 rounded-full">
                        {{ $cancelledRentals->total() ?? count($cancelledRentals) }} Transaksi
                    </span>
                </div>
                <p class="text-xs text-slate-500 mb-4">Arsip transaksi yang dibatalkan langsung oleh pelanggan sebelum masa sewa dimulai.</p>

                @if(count($cancelledRentals) > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode Booking</th>
                                    <th>Kendaraan</th>
                                    <th>Penyewa</th>
                                    <th>Total Bayar</th>
                                    <th>Alasan Pembatalan</th>
                                    <th>Status Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cancelledRentals as $item)
                                    <tr>
                                        <td><span class="font-mono text-xs font-bold">{{ $item->booking_code }}</span></td>
                                        <td>{{ $item->vehicle->name }}</td>
                                        <td>
                                            <div class="font-semibold">{{ $item->user->name }}</div>
                                            @if($item->ktp_image)
                                                <button type="button" 
                                                        onclick="openViewKtpModal('{{ asset('storage/' . $item->ktp_image) }}', '{{ addslashes($item->user->name) }}', '{{ $item->booking_code }}', '{{ addslashes($item->vehicle->name) }}')"
                                                        class="mt-1 inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[11px] font-bold bg-sky-100 hover:bg-sky-200 text-sky-800 dark:bg-sky-950 dark:text-sky-300 transition shadow-sm">
                                                    <span>🪪</span> Lihat KTP
                                                </button>
                                            @endif
                                        </td>
                                        <td>Rp {{ number_format($item->total_payment > 0 ? $item->total_payment : $item->subtotal, 0, ',', '.') }}</td>
                                        <td class="text-xs max-w-xs">
                                            <span class="text-slate-700 dark:text-slate-300 font-medium">{{ $item->cancel_reason ?? 'Dibatalkan oleh Pelanggan' }}</span>
                                        </td>
                                        <td>
                                            <span class="px-2.5 py-1 bg-slate-100 text-slate-700 text-xs font-bold rounded-full">❌ Dibatalkan</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $cancelledRentals->links() }}
                    </div>
                @else
                    <div class="empty-box">Tidak ada transaksi yang dibatalkan oleh pelanggan.</div>
                @endif
            </div>
            @endif

            <!-- ======================================================== -->
            <!-- 8. RIWAYAT DITOLAK (REJECTED)                            -->
            <!-- ======================================================== -->
            @if($statusFilter === 'all' || $statusFilter === 'rejected')
            <div class="section-card border-l-4 border-l-rose-500">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="section-title text-slate-800 dark:text-slate-200">
                        <span>🚫</span> Riwayat Ditolak (Manager)
                    </h3>
                    <span class="text-xs font-bold px-2.5 py-1 bg-rose-100 dark:bg-rose-950 text-rose-800 dark:text-rose-200 rounded-full">
                        {{ $rejectedRentals->total() ?? count($rejectedRentals) }} Transaksi
                    </span>
                </div>
                <p class="text-xs text-slate-500 mb-4">Arsip pengajuan sewa/booking yang ditolak oleh pihak cabang beserta catatan alasannya.</p>

                @if(count($rejectedRentals) > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode Booking</th>
                                    <th>Kendaraan</th>
                                    <th>Penyewa</th>
                                    <th>Total Bayar</th>
                                    <th>Alasan Penolakan</th>
                                    <th>Status Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rejectedRentals as $item)
                                    <tr>
                                        <td><span class="font-mono text-xs font-bold">{{ $item->booking_code }}</span></td>
                                        <td>{{ $item->vehicle->name }}</td>
                                        <td>
                                            <div class="font-semibold">{{ $item->user->name }}</div>
                                            @if($item->ktp_image)
                                                <button type="button" 
                                                        onclick="openViewKtpModal('{{ asset('storage/' . $item->ktp_image) }}', '{{ addslashes($item->user->name) }}', '{{ $item->booking_code }}', '{{ addslashes($item->vehicle->name) }}')"
                                                        class="mt-1 inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[11px] font-bold bg-sky-100 hover:bg-sky-200 text-sky-800 dark:bg-sky-950 dark:text-sky-300 transition shadow-sm">
                                                    <span>🪪</span> Lihat KTP
                                                </button>
                                            @endif
                                        </td>
                                        <td>Rp {{ number_format($item->total_payment > 0 ? $item->total_payment : $item->subtotal, 0, ',', '.') }}</td>
                                        <td class="text-xs max-w-xs">
                                            <span class="text-rose-600 font-medium">{{ $item->reject_reason ?? 'Ditolak oleh Manager' }}</span>
                                        </td>
                                        <td>
                                            <span class="px-2.5 py-1 bg-rose-100 text-rose-800 text-xs font-bold rounded-full" title="Alasan: {{ $item->reject_reason }}">🚫 Ditolak</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $rejectedRentals->links() }}
                    </div>
                @else
                    <div class="empty-box">Tidak ada pengajuan sewa yang ditolak.</div>
                @endif
            </div>
            @endif

        </div>
    </div>

    <!-- ======================================================== -->
    <!-- MODAL 1: TOLAK BOOKING                                   -->
    <!-- ======================================================== -->
    <div id="modalReject" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div class="bg-white dark:bg-slate-900 rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-200 dark:border-slate-800">
            <h3 class="text-lg font-bold text-rose-700 mb-1 flex items-center gap-2">
                <span>❌</span> Tolak Booking Kendaraan
            </h3>
            <p id="rejectSubtitle" class="text-xs text-slate-500 mb-4"></p>

            <form id="formReject" method="POST" action="">
                @csrf
                <div class="mb-4">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">Alasan Penolakan (Wajib Diisi)</label>
                    <textarea name="reject_reason" rows="3" required placeholder="Contoh: Unit sedang dalam perbaikan mendadak atau alamat pengantaran di luar jangkauan cabang." class="w-full rounded-xl border border-slate-300 dark:border-slate-700 p-3 text-xs bg-slate-50 dark:bg-slate-800"></textarea>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeRejectModal()" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold text-white bg-rose-600 hover:bg-rose-700">Konfirmasi Tolak</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ======================================================== -->
    <!-- MODAL 2: SERAH TERIMA UNIT & UPLOAD KTP                  -->
    <!-- ======================================================== -->
    <div id="modalHandover" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div class="bg-white dark:bg-slate-900 rounded-3xl max-w-lg w-full p-6 shadow-2xl border border-slate-200 dark:border-slate-800">
            <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-2xl mb-3 shadow-inner">
                📸
            </div>
            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-1">
                Serah Terima Unit & Upload Foto Jaminan (KTP)
            </h3>
            <p id="handoverSubtitle" class="text-xs text-slate-500 mb-4"></p>

            <form id="formHandover" method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                        Upload Foto KTP Pelanggan (Wajib Jaminan)
                    </label>
                    <input type="file" name="ktp_image" accept="image/*" required class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 border rounded-xl p-2 bg-slate-50 dark:bg-slate-800">
                    <span class="text-[11px] text-slate-400 mt-1 block">Format JPG/PNG, maksimal 5MB. Foto KTP disimpan secara aman sebagai jaminan sewa.</span>
                </div>

                <div class="p-3 mb-4 rounded-xl bg-blue-50 dark:bg-blue-950/40 border border-blue-200 text-xs text-blue-800 dark:text-blue-300 leading-relaxed">
                    ⏱️ <strong>Masa Aktif Mulai:</strong> Detik Anda mengklik tombol di bawah, status sewa berubah menjadi <strong>ACTIVE</strong> dan timer masa sewa pelanggan resmi dimulai dari saat ini.
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeHandoverModal()" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200">Tutup</button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 shadow-lg shadow-emerald-600/30">
                        🤝 Kendaraan Telah Diserahkan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ======================================================== -->
    <!-- MODAL 3: PENGECEKAN FISIK KENDARAAN (AMAN vs RUSAK)      -->
    <!-- ======================================================== -->
    <div id="modalInspect" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div class="bg-white dark:bg-slate-900 rounded-3xl max-w-lg w-full p-6 shadow-2xl border border-slate-200 dark:border-slate-800">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-1 flex items-center gap-2">
                <span>🔍</span> Pengecekan Fisik & Pengembalian Unit
            </h3>
            <p id="inspectSubtitle" class="text-xs text-slate-500 mb-4"></p>

            <form id="formInspect" method="POST" action="">
                @csrf

                <!-- Pilihan Kondisi Fisik -->
                <div class="mb-4">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
                        Hasil Pengecekan Kondisi Fisik Unit:
                    </label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="cursor-pointer border-2 rounded-2xl p-3 text-center transition border-emerald-500 bg-emerald-50/50 dark:bg-emerald-950/20" id="optSafeLabel">
                            <input type="radio" name="condition" value="safe" checked class="sr-only" onchange="toggleCondition('safe')">
                            <div class="text-2xl mb-1">✨</div>
                            <div class="text-xs font-bold text-emerald-700 dark:text-emerald-400">Opsi A: Unit Aman</div>
                            <div class="text-[11px] text-slate-500">Mulus & Tanpa Kerusakan</div>
                        </label>
                        <label class="cursor-pointer border-2 rounded-2xl p-3 text-center transition border-slate-200 dark:border-slate-700 hover:border-rose-400" id="optDamagedLabel">
                            <input type="radio" name="condition" value="damaged" class="sr-only" onchange="toggleCondition('damaged')">
                            <div class="text-2xl mb-1">⚠️</div>
                            <div class="text-xs font-bold text-rose-600">Opsi B: Unit Rusak</div>
                            <div class="text-[11px] text-slate-500">Ada Baret / Lecet / Kerusakan</div>
                        </label>
                    </div>
                </div>

                <!-- Input Kerusakan (Disabled jika Unit Aman) -->
                <div id="damageFields" class="mb-4 p-3.5 rounded-2xl bg-rose-50/50 dark:bg-rose-950/30 border border-rose-200 dark:border-rose-900 space-y-3 opacity-50 pointer-events-none transition-all">
                    <div>
                        <label class="block text-xs font-bold text-rose-800 dark:text-rose-300 mb-1">Biaya Reparasi / Perbaikan (Rp)</label>
                        <input type="number" id="inputDamageFee" name="damage_fee" min="0" placeholder="Contoh: 250000" class="w-full rounded-xl border border-rose-300 p-2.5 text-xs bg-white dark:bg-slate-800" disabled>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-rose-800 dark:text-rose-300 mb-1">Keterangan Bagian yang Rusak</label>
                        <textarea id="inputDamageNote" name="damage_note" rows="2" placeholder="Contoh: Spion kiri retak, baret pada pintu depan kanan." class="w-full rounded-xl border border-rose-300 p-2.5 text-xs bg-white dark:bg-slate-800" disabled></textarea>
                    </div>
                    <span class="text-[11px] text-rose-600 block leading-tight">
                        *Unit yang dilaporkan rusak akan otomatis masuk ke daftar status RUSAK dan tidak dapat disewa sampai diperbaiki.
                    </span>
                </div>

                <!-- Info Denda Keterlambatan -->
                <div id="lateInfoBox" class="p-3 mb-4 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 text-xs space-y-1">
                    <div class="flex justify-between items-center text-slate-600 dark:text-slate-400">
                        <span>Denda Keterlambatan:</span>
                        <strong id="displayLateFine" class="font-bold text-slate-900 dark:text-white">Rp 0</strong>
                    </div>
                    <div id="lateDurationText" class="text-[11px] text-slate-500">Tidak ada keterlambatan.</div>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeInspectModal()" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200">Batal</button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-purple-600 hover:bg-purple-700 shadow-lg shadow-purple-600/30">
                        Selesaikan Pemeriksaan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ======================================================== -->
    <!-- JAVASCRIPT MODAL CONTROLS                                -->
    <!-- ======================================================== -->
    <script>
        function openRejectModal(code, vehicle, user) {
            document.getElementById('rejectSubtitle').innerText = `Booking #${code} • ${vehicle} (${user})`;
            document.getElementById('formReject').action = `/manager/rentals/${code}/reject`;
            const m = document.getElementById('modalReject');
            m.classList.remove('hidden');
            m.classList.add('flex');
        }
        function closeRejectModal() {
            const m = document.getElementById('modalReject');
            m.classList.add('hidden');
            m.classList.remove('flex');
        }

        function openHandoverModal(id, code, vehicle, user) {
            document.getElementById('handoverSubtitle').innerText = `Booking #${code} • ${vehicle} (${user})`;
            document.getElementById('formHandover').action = `/manager/rentals/${id}/handover`;
            const m = document.getElementById('modalHandover');
            m.classList.remove('hidden');
            m.classList.add('flex');
        }
        function closeHandoverModal() {
            const m = document.getElementById('modalHandover');
            m.classList.add('hidden');
            m.classList.remove('flex');
        }

        function openInspectModal(id, code, vehicle, lateFine, lateDuration) {
            document.getElementById('inspectSubtitle').innerText = `Booking #${code} • ${vehicle}`;
            document.getElementById('formInspect').action = `/manager/rentals/${id}/inspect`;

            const fineAmount = parseFloat(lateFine) || 0;
            document.getElementById('displayLateFine').innerText = 'Rp ' + fineAmount.toLocaleString('id-ID');
            document.getElementById('lateDurationText').innerText = fineAmount > 0 
                ? `Terlambat ${lateDuration} (dikenakan denda per jam).` 
                : 'Unit dikembalikan tepat waktu.';

            toggleCondition('safe');
            const m = document.getElementById('modalInspect');
            m.classList.remove('hidden');
            m.classList.add('flex');
        }
        function closeInspectModal() {
            const m = document.getElementById('modalInspect');
            m.classList.add('hidden');
            m.classList.remove('flex');
        }

        function toggleCondition(cond) {
            const safeLabel = document.getElementById('optSafeLabel');
            const damagedLabel = document.getElementById('optDamagedLabel');
            const damageFields = document.getElementById('damageFields');
            const feeInput = document.getElementById('inputDamageFee');
            const noteInput = document.getElementById('inputDamageNote');

            if (cond === 'damaged') {
                damagedLabel.classList.add('border-rose-500', 'bg-rose-50/50', 'dark:bg-rose-950/20');
                damagedLabel.classList.remove('border-slate-200');
                safeLabel.classList.remove('border-emerald-500', 'bg-emerald-50/50', 'dark:bg-emerald-950/20');
                safeLabel.classList.add('border-slate-200');

                damageFields.classList.remove('opacity-50', 'pointer-events-none');
                feeInput.disabled = false;
                feeInput.required = true;
                noteInput.disabled = false;
                noteInput.required = true;
            } else {
                safeLabel.classList.add('border-emerald-500', 'bg-emerald-50/50', 'dark:bg-emerald-950/20');
                safeLabel.classList.remove('border-slate-200');
                damagedLabel.classList.remove('border-rose-500', 'bg-rose-50/50', 'dark:bg-rose-950/20');
                damagedLabel.classList.add('border-slate-200');

                damageFields.classList.add('opacity-50', 'pointer-events-none');
                feeInput.disabled = true;
                feeInput.required = false;
                feeInput.value = '';
                noteInput.disabled = true;
                noteInput.required = false;
                noteInput.value = '';
            }
        }

        function openViewKtpModal(imageUrl, userName, bookingCode, vehicleName) {
            const modal = document.getElementById('modalViewKtp');
            const img = document.getElementById('viewKtpImage');
            const sub = document.getElementById('viewKtpSubtitle');
            const dl = document.getElementById('viewKtpDownload');
            if (modal && img) {
                img.src = imageUrl;
                if (dl) dl.href = imageUrl;
                if (sub) sub.textContent = userName + ' • ' + bookingCode + ' • ' + vehicleName;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }
        function closeViewKtpModal() {
            const modal = document.getElementById('modalViewKtp');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }
    </script>

    <!-- ======================================================== -->
    <!-- MODAL 4: PREVIEW KTP PELANGGAN                           -->
    <!-- ======================================================== -->
    <div id="modalViewKtp" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/75 backdrop-blur-md">
        <div class="bg-white dark:bg-slate-900 rounded-3xl max-w-2xl w-full p-6 shadow-2xl border border-slate-200 dark:border-slate-800">
            <div class="flex items-center justify-between pb-3 mb-3 border-b border-slate-100 dark:border-slate-800">
                <div class="flex items-center gap-2.5">
                    <div class="w-10 h-10 rounded-xl bg-sky-100 dark:bg-sky-950/60 text-sky-700 dark:text-sky-300 flex items-center justify-center text-xl">
                        🪪
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900 dark:text-white">Foto Jaminan KTP Pelanggan</h3>
                        <p id="viewKtpSubtitle" class="text-xs text-slate-500"></p>
                    </div>
                </div>
                <button type="button" onclick="closeViewKtpModal()" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 flex items-center justify-center text-sm font-bold transition">✕</button>
            </div>

            <div class="relative bg-slate-950/5 dark:bg-slate-950/50 rounded-2xl p-2 flex items-center justify-center min-h-[300px] max-h-[70vh] overflow-hidden">
                <img id="viewKtpImage" src="" alt="Foto KTP Jaminan" class="max-h-[65vh] w-auto max-w-full rounded-xl object-contain shadow-md transition-transform hover:scale-[1.02]">
            </div>

            <div class="mt-4 flex items-center justify-between gap-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                <a id="viewKtpDownload" href="" target="_blank" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold bg-[#004B87] hover:bg-[#003B6F] text-white transition shadow-sm">
                    <span>↗️</span> Buka Ukuran Penuh
                </a>
                <button type="button" onclick="closeViewKtpModal()" class="py-2 px-5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 rounded-xl font-bold text-xs transition">Tutup</button>
            </div>
        </div>
    </div>
</x-app-layout>
