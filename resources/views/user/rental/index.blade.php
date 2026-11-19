<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Transaksi & Sewa Saya - GoAnywhere
                </h2>
                <p class="text-xs text-gray-500 mt-1">Pantau progres persetujuan, armada OTW diantar, masa aktif sewa, hingga riwayat selesai.</p>
            </div>
            <span class="px-3 py-1 bg-[#004B87]/10 text-[#004B87] dark:text-blue-300 font-bold text-xs rounded-full">
                📍 Domisili: {{ Auth::user()->location ?? 'Jabodetabek' }}
            </span>
        </div>
    </x-slot>

    <style>
        .transaksi-user-section {
            padding: 30px 0 60px;
            background: #F0F4F8;
            min-height: 100vh;
        }
        .dark .transaksi-user-section {
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
            margin-bottom: 6px;
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
            padding: 8px 16px;
            border-radius: 12px;
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
            text-decoration: none;
        }
        .btn-action-primary:hover {
            background: #002D55;
            transform: translateY(-1px);
        }
        .btn-action-danger {
            padding: 8px 14px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 700;
            color: #e11d48;
            background: #ffe4e6;
            border: 1px solid #fecdd3;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .btn-action-danger:hover {
            background: #f43f5e;
            color: #ffffff;
        }
        .btn-chat-link {
            padding: 8px 14px;
            border-radius: 12px;
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
            padding: 36px 20px;
            text-align: center;
            color: #94a3b8;
            font-size: 13px;
        }

        /* Stat cards */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }
        .stat-card-clean {
            background: #ffffff;
            border-radius: 18px;
            padding: 18px 22px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(15, 23, 42, 0.06);
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .dark .stat-card-clean {
            background: #0f172a;
            border-color: rgba(255, 255, 255, 0.06);
        }
        .stat-card-clean .icon-wrap {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }
        @media (max-width: 768px) {
            .stat-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="transaksi-user-section">
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

            {{-- STATISTIK SINGKAT --}}
            <div class="stat-grid">
                <div class="stat-card-clean">
                    <div class="icon-wrap bg-blue-50 text-blue-600 dark:bg-blue-950/60 dark:text-blue-300">
                        🚗
                    </div>
                    <div>
                        <div class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Sewa Berjalan</div>
                        <div class="text-2xl font-extrabold text-slate-900 dark:text-white mt-0.5">
                            {{ $counts['paid'] + $counts['approved'] + $counts['active'] + $counts['pending_return'] + $counts['pending_payment'] }}
                        </div>
                    </div>
                </div>

                <div class="stat-card-clean">
                    <div class="icon-wrap bg-emerald-50 text-emerald-600 dark:bg-emerald-950/60 dark:text-emerald-300">
                        ✅
                    </div>
                    <div>
                        <div class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Transaksi Selesai</div>
                        <div class="text-2xl font-extrabold text-slate-900 dark:text-white mt-0.5">
                            {{ $counts['completed'] }}
                        </div>
                    </div>
                </div>

                <div class="stat-card-clean">
                    <div class="icon-wrap bg-purple-50 text-purple-600 dark:bg-purple-950/60 dark:text-purple-300">
                        💰
                    </div>
                    <div>
                        <div class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Total Pengeluaran</div>
                        <div class="text-2xl font-extrabold text-slate-900 dark:text-white mt-0.5">
                            Rp {{ number_format($totalSpent, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- SEARCH & FILTER STATUS BAR --}}
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-5 mb-6 border border-slate-200 dark:border-slate-800 shadow-sm">
                <form action="{{ route('user.rental') }}" method="GET" class="flex flex-col sm:flex-row gap-3 items-center justify-between">
                    {{-- Search Input --}}
                    <div class="relative w-full flex-1">
                        <input type="text" name="search" value="{{ $search }}" placeholder="Cari Kode Booking (misal: BK-...), Nama Kendaraan, atau Gerai Cabang..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm focus:ring-2 focus:ring-[#004B87] focus:outline-none">
                        <input type="hidden" name="status" value="{{ $statusFilter }}">
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center gap-2 w-full sm:w-auto shrink-0">
                        <button type="submit" class="flex-1 sm:flex-initial px-6 py-2.5 bg-[#004B87] hover:bg-[#002D55] text-white rounded-xl text-sm font-bold shadow-sm transition">
                            Cari
                        </button>
                        @if(!empty($search) || $statusFilter !== 'all')
                            <a href="{{ route('user.rental') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-xl text-sm font-semibold transition" title="Reset filter">
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
                        <a href="{{ route('user.rental', ['search' => $search, 'status' => $tabKey]) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl whitespace-nowrap transition {{ $statusFilter === $tabKey ? 'bg-[#004B87] text-white shadow-sm' : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200' }}">
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
                <p class="text-xs text-slate-500 mb-4">Pembayaran Anda telah diterima. Manager armada sedang memverifikasi pesanan sebelum armada diberangkatkan.</p>

                @if(count($pendingApprovals) > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode Booking</th>
                                    <th>Kendaraan</th>
                                    <th>Durasi Sewa</th>
                                    <th>Titik Antar</th>
                                    <th>Total Bayar (+Ongkir)</th>
                                    <th>Aksi Pelanggan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingApprovals as $item)
                                    <tr>
                                        <td><span class="font-mono font-bold text-[#004B87] dark:text-blue-300">{{ $item->booking_code }}</span></td>
                                        <td>
                                            <div class="font-bold text-slate-900 dark:text-white">{{ $item->vehicle->name }}</div>
                                            <div class="text-xs text-slate-500">📍 Gerai {{ $item->vehicle->location }}</div>
                                        </td>
                                        <td>
                                            <span class="px-2 py-0.5 rounded text-xs font-semibold {{ $item->period === 'weekly' ? 'bg-purple-100 text-purple-800' : 'bg-slate-100 text-slate-800' }}">
                                                {{ $item->period === 'weekly' ? '🎁 Paket 7 Hari' : $item->quantity_days . ' Hari' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="text-xs text-slate-600 dark:text-slate-300 max-w-xs truncate" title="{{ $item->pickup_location }}">
                                                📍 {{ $item->pickup_location }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="font-bold text-slate-900 dark:text-white">
                                                Rp {{ number_format($item->total_payment > 0 ? $item->total_payment : $item->subtotal, 0, ',', '.') }}
                                            </div>
                                            <div class="text-[11px] text-emerald-600 font-medium">Termasuk Ongkir</div>
                                        </td>
                                        <td>
                                            <div class="flex items-center gap-2">
                                                <button type="button" 
                                                        class="btn-action-danger" 
                                                        onclick="openCancelModal('{{ $item->booking_code }}', '{{ addslashes($item->vehicle->name ?? 'Kendaraan') }}')">
                                                    <span>❌</span> Batalkan Pesanan
                                                </button>
                                                <a href="{{ route('user.chat.start', ['vehicle_id' => $item->vehicle_id]) }}" class="btn-chat-link">
                                                    💬 Chat Manager
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-box">Tidak ada booking yang sedang menunggu persetujuan manager.</div>
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
                        <span>🚚</span> Armada Disetujui & Sedang Diantar (OTW)
                    </h3>
                    <span class="text-xs font-bold px-2.5 py-1 bg-blue-100 dark:bg-blue-950 text-blue-800 dark:text-blue-200 rounded-full animate-pulse">
                        {{ count($approvedOtw) }} Unit OTW
                    </span>
                </div>
                <p class="text-xs text-slate-500 mb-4">Manager cabang telah menyetujui booking dan sedang dalam perjalanan mengantarkan kendaraan ke lokasi Anda. Harap siapkan <strong>KTP Fisik Asli</strong> untuk difoto saat serah terima.</p>

                @if(count($approvedOtw) > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode Booking</th>
                                    <th>Kendaraan</th>
                                    <th>Titik Antar</th>
                                    <th>Instruksi Serah Terima</th>
                                    <th>Kontak Manager</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($approvedOtw as $item)
                                    <tr>
                                        <td><span class="font-mono font-bold text-blue-700 dark:text-blue-300">{{ $item->booking_code }}</span></td>
                                        <td>
                                            <div class="font-bold text-slate-900 dark:text-white">{{ $item->vehicle->name }}</div>
                                            <div class="text-xs text-slate-500">{{ $item->vehicle->brand }}</div>
                                        </td>
                                        <td>
                                            <span class="text-xs font-semibold text-slate-700 dark:text-slate-300">
                                                📍 {{ $item->pickup_location }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-xs text-blue-800 dark:text-blue-300 bg-blue-50 dark:bg-blue-950/50 p-2 rounded-lg block font-medium">
                                                📸 Tunjukkan KTP Asli saat staff tiba. Masa aktif sewa dimulai dari waktu serah terima.
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('user.chat.start', ['vehicle_id' => $item->vehicle_id]) }}" class="btn-action-primary bg-blue-600 hover:bg-blue-700">
                                                💬 Hubungi Driver/Staff
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-box">Tidak ada armada yang sedang dalam perjalanan pengantaran saat ini.</div>
                @endif
            </div>
            @endif

            <!-- ======================================================== -->
            <!-- 3. SEWA AKTIF / MASA BERJALAN (STATUS: ACTIVE)           -->
            <!-- ======================================================== -->
            @if($statusFilter === 'all' || $statusFilter === 'active')
            <div class="section-card border-l-4 border-l-emerald-600">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="section-title text-emerald-800 dark:text-emerald-300">
                        <span>🚗</span> Sewa Aktif / Sedang Digunakan
                    </h3>
                    <span class="text-xs font-bold px-2.5 py-1 bg-emerald-100 text-emerald-800 rounded-full">
                        {{ count($activeRentals) }} Kendaraan Aktif
                    </span>
                </div>
                <p class="text-xs text-slate-500 mb-4">Kendaraan sedang dalam penggunaan Anda. Kembalikan kendaraan tepat waktu ke gerai cabang sebelum batas waktu pengembalian berakhir.</p>

                @if(count($activeRentals) > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode Booking</th>
                                    <th>Kendaraan</th>
                                    <th>Mulai Sewa (Handover)</th>
                                    <th>Batas Wajib Kembali</th>
                                    <th>Status Waktu</th>
                                    <th>Prosedur Pengembalian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activeRentals as $item)
                                    @php
                                        $late = $item->late ?? \App\Services\LateFeeCalculator::calculate($item);
                                    @endphp
                                    <tr>
                                        <td><span class="font-mono font-bold text-emerald-800 dark:text-emerald-300">{{ $item->booking_code }}</span></td>
                                        <td>
                                            <div class="font-bold text-slate-900 dark:text-white">{{ $item->vehicle->name }}</div>
                                            <div class="text-xs text-slate-500">📍 Gerai {{ $item->vehicle->location }}</div>
                                        </td>
                                        <td class="text-xs">
                                            {{ $item->handover_at ? \Carbon\Carbon::parse($item->handover_at)->format('d M Y, H:i') : \Carbon\Carbon::parse($item->rental_start_date)->format('d M Y, H:i') }}
                                        </td>
                                        <td class="text-xs font-bold text-slate-800 dark:text-slate-100">
                                            {{ \Carbon\Carbon::parse($item->rental_end_date)->format('d M Y, H:i') }}
                                        </td>
                                        <td>
                                            @if($late['is_late'])
                                                <span class="px-2.5 py-1 bg-rose-100 text-rose-800 text-xs font-bold rounded-lg inline-flex items-center gap-1">
                                                    ⚠️ Terlambat {{ $late['duration_label'] }}
                                                </span>
                                            @else
                                                <span class="px-2.5 py-1 bg-emerald-100 text-emerald-800 text-xs font-bold rounded-lg inline-flex items-center gap-1">
                                                    ⏱️ Masa Sewa Berjalan
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="flex flex-col gap-1.5 max-w-xs">
                                                <div class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold bg-emerald-50 dark:bg-emerald-950/60 text-emerald-800 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                                                    <span>🏢</span> Bawa ke Gerai {{ $item->vehicle->location }}
                                                </div>
                                                <div class="text-[11px] text-slate-500 leading-tight">
                                                    Serahkan unit & kunci ke petugas gerai untuk konfirmasi tiba & cek fisik.
                                                </div>
                                                <div class="mt-0.5">
                                                    <a href="{{ route('user.chat.start', ['vehicle_id' => $item->vehicle_id]) }}" class="btn-chat-link inline-flex">
                                                        💬 Chat Manager
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-box">Anda belum memiliki kendaraan yang sedang aktif disewa saat ini.</div>
                @endif
            </div>
            @endif

            <!-- ======================================================== -->
            <!-- 4. MENUNGGU CEK FISIK UNIT (STATUS: PENDING_RETURN)      -->
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
                <p class="text-xs text-slate-500 mb-4">Anda telah mengembalikan kendaraan ke gerai. Manager cabang sedang melakukan cek fisik unit secara real-time (Aman / Rusak).</p>

                @if(count($pendingReturns) > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode Booking</th>
                                    <th>Kendaraan</th>
                                    <th>Waktu Pengembalian</th>
                                    <th>Status Pemeriksaan</th>
                                    <th>Bantuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingReturns as $item)
                                    <tr>
                                        <td><span class="font-mono font-bold text-purple-700">{{ $item->booking_code }}</span></td>
                                        <td class="font-bold">{{ $item->vehicle->name }}</td>
                                        <td class="text-xs">
                                            {{ ($item->returned_at ?? $item->return_date) ? \Carbon\Carbon::parse($item->returned_at ?? $item->return_date)->format('d M Y, H:i') : '-' }}
                                        </td>
                                        <td>
                                            <span class="px-2.5 py-1 bg-purple-50 dark:bg-purple-950/60 text-purple-800 dark:text-purple-200 text-xs font-semibold rounded-lg inline-flex items-center gap-1.5">
                                                <span>⏳</span> Sedang diinspeksi oleh Manager di gerai cabang
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('user.chat.start', ['vehicle_id' => $item->vehicle_id]) }}" class="btn-chat-link">
                                                💬 Chat Manager
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-box">Tidak ada kendaraan yang sedang menunggu pengecekan fisik gerai.</div>
                @endif
            </div>
            @endif

            <!-- ======================================================== -->
            <!-- 5. MENUNGGU PEMBAYARAN DENDA (STATUS: PENDING_PAYMENT)   -->
            <!-- ======================================================== -->
            @if($statusFilter === 'all' || $statusFilter === 'pending_payment')
            @if(count($pendingPayments) > 0 || $statusFilter === 'pending_payment')
            <div class="section-card border-l-4 border-l-rose-500">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="section-title text-rose-700 dark:text-rose-400">
                        <span>💳</span> Menunggu Pembayaran Tagihan Denda / Reparasi
                    </h3>
                    <span class="text-xs font-bold px-2.5 py-1 bg-rose-100 text-rose-800 rounded-full animate-bounce">
                        {{ count($pendingPayments) }} Tagihan Belum Lunas
                    </span>
                </div>
                <p class="text-xs text-slate-500 mb-4">Pengecekan fisik kendaraan telah selesai. Silakan lunasi tagihan denda keterlambatan atau biaya reparasi unit untuk menyelesaikan transaksi sewa Anda.</p>

                @if(count($pendingPayments) > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode Booking</th>
                                    <th>Kendaraan</th>
                                    <th>Rincian Tagihan</th>
                                    <th>Total Yang Harus Dibayar</th>
                                    <th>Aksi Pelunasan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingPayments as $item)
                                    @php
                                        $totalBill = ($item->fine->total_fine ?? 0) > 0 ? $item->fine->total_fine : ($item->fine_amount + $item->damage_fee);
                                    @endphp
                                    <tr>
                                        <td><span class="font-mono font-bold text-rose-700">{{ $item->booking_code }}</span></td>
                                        <td class="font-bold">{{ $item->vehicle->name }}</td>
                                        <td class="text-xs space-y-1">
                                            @if($item->damage_fee > 0)
                                                <div class="text-rose-700 font-bold">🛠️ Reparasi: Rp {{ number_format($item->damage_fee, 0, ',', '.') }} ({{ $item->damage_note }})</div>
                                            @endif
                                            @if($item->fine_amount > 0)
                                                <div class="text-amber-700 font-semibold">⚠️ Denda Telat: Rp {{ number_format($item->fine_amount, 0, ',', '.') }}</div>
                                            @endif
                                        </td>
                                        <td class="font-extrabold text-base text-rose-600">
                                            Rp {{ number_format($totalBill, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <a href="{{ route('user.rental.fine', $item->id) }}" class="btn-action-primary bg-rose-600 hover:bg-rose-700 shadow-md shadow-rose-600/20">
                                                <span>💳</span> Bayar Denda Sekarang
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-box">Selamat! Anda tidak memiliki tagihan denda atau reparasi unit saat ini.</div>
                @endif
            </div>
            @endif
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
                <p class="text-xs text-slate-500 mb-4">Daftar transaksi rental yang telah selesai digunakan, dikembalikan ke gerai, dan lunas tanpa kendala.</p>

                @if(count($completedRentals) > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode Booking</th>
                                    <th>Kendaraan</th>
                                    <th>Tanggal Booking</th>
                                    <th>Durasi Sewa</th>
                                    <th>Total Pembayaran</th>
                                    <th>Denda / Reparasi</th>
                                    <th>Status Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($completedRentals as $item)
                                    <tr>
                                        <td><span class="font-mono text-xs font-bold text-slate-900 dark:text-white">{{ $item->booking_code }}</span></td>
                                        <td>
                                            <div class="font-bold text-slate-900 dark:text-white">{{ $item->vehicle->name ?? 'N/A' }}</div>
                                            <div class="text-xs text-slate-500">📍 Gerai {{ $item->vehicle->location ?? '-' }}</div>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                                        <td>
                                            <span class="px-2 py-0.5 rounded text-xs font-semibold {{ $item->period === 'weekly' ? 'bg-purple-100 text-purple-800' : 'bg-slate-100 text-slate-800' }}">
                                                {{ $item->period === 'weekly' ? '🎁 Paket 7 Hari' : ($item->quantity_days ?? 1) . ' Hari' }}
                                            </span>
                                        </td>
                                        <td class="font-bold text-[#004B87] dark:text-blue-300">
                                            Rp {{ number_format($item->total_payment > 0 ? $item->total_payment : $item->subtotal, 0, ',', '.') }}
                                        </td>
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
                <p class="text-xs text-slate-500 mb-4">Arsip transaksi rental kendaraan yang Anda batalkan sebelum masa sewa dimulai.</p>

                @if(count($cancelledRentals) > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode Booking</th>
                                    <th>Kendaraan</th>
                                    <th>Tanggal Booking</th>
                                    <th>Durasi Sewa</th>
                                    <th>Total Pembayaran</th>
                                    <th>Alasan Pembatalan</th>
                                    <th>Status Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cancelledRentals as $item)
                                    <tr>
                                        <td><span class="font-mono text-xs font-bold text-slate-900 dark:text-white">{{ $item->booking_code }}</span></td>
                                        <td>
                                            <div class="font-bold text-slate-900 dark:text-white">{{ $item->vehicle->name ?? 'N/A' }}</div>
                                            <div class="text-xs text-slate-500">📍 Gerai {{ $item->vehicle->location ?? '-' }}</div>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                                        <td>
                                            <span class="px-2 py-0.5 rounded text-xs font-semibold {{ $item->period === 'weekly' ? 'bg-purple-100 text-purple-800' : 'bg-slate-100 text-slate-800' }}">
                                                {{ $item->period === 'weekly' ? '🎁 Paket 7 Hari' : ($item->quantity_days ?? 1) . ' Hari' }}
                                            </span>
                                        </td>
                                        <td class="font-bold text-slate-700 dark:text-slate-300">
                                            Rp {{ number_format($item->total_payment > 0 ? $item->total_payment : $item->subtotal, 0, ',', '.') }}
                                        </td>
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
                    <div class="empty-box">Tidak ada transaksi yang Anda batalkan.</div>
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
                <p class="text-xs text-slate-500 mb-4">Arsip pengajuan rental kendaraan yang ditolak oleh Manager cabang beserta alasannya.</p>

                @if(count($rejectedRentals) > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode Booking</th>
                                    <th>Kendaraan</th>
                                    <th>Tanggal Booking</th>
                                    <th>Durasi Sewa</th>
                                    <th>Total Pembayaran</th>
                                    <th>Alasan Penolakan</th>
                                    <th>Status Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rejectedRentals as $item)
                                    <tr>
                                        <td><span class="font-mono text-xs font-bold text-slate-900 dark:text-white">{{ $item->booking_code }}</span></td>
                                        <td>
                                            <div class="font-bold text-slate-900 dark:text-white">{{ $item->vehicle->name ?? 'N/A' }}</div>
                                            <div class="text-xs text-slate-500">📍 Gerai {{ $item->vehicle->location ?? '-' }}</div>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                                        <td>
                                            <span class="px-2 py-0.5 rounded text-xs font-semibold {{ $item->period === 'weekly' ? 'bg-purple-100 text-purple-800' : 'bg-slate-100 text-slate-800' }}">
                                                {{ $item->period === 'weekly' ? '🎁 Paket 7 Hari' : ($item->quantity_days ?? 1) . ' Hari' }}
                                            </span>
                                        </td>
                                        <td class="font-bold text-slate-700 dark:text-slate-300">
                                            Rp {{ number_format($item->total_payment > 0 ? $item->total_payment : $item->subtotal, 0, ',', '.') }}
                                        </td>
                                        <td class="text-xs max-w-xs">
                                            <span class="text-rose-600 font-medium">{{ $item->reject_reason ?? 'Ditolak oleh Manager gerai' }}</span>
                                        </td>
                                        <td>
                                            <span class="px-2.5 py-1 bg-rose-100 text-rose-800 text-xs font-bold rounded-full" title="Alasan: {{ $item->reject_reason ?? 'Ditolak Manager' }}">🚫 Ditolak</span>
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
                    <div class="empty-box">Tidak ada pengajuan sewa yang ditolak oleh Manager.</div>
                @endif
            </div>
            @endif

        </div>
    </div>

    <!-- ======================================================== -->
    <!-- POPUP 1: DENDA LUNAS                                     -->
    <!-- ======================================================== -->
    @if(session('just_paid_fine'))
        <div id="modalPaidFine" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm animate-fade-in">
            <div class="bg-white dark:bg-slate-900 rounded-3xl max-w-md w-full p-6 text-center shadow-2xl border border-slate-200 dark:border-slate-800 transform animate-scale-up">
                <div class="w-16 h-16 bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4 shadow-inner">
                    ✅
                </div>
                <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mb-2">
                    Denda Lunas. Terima kasih!
                </h3>
                <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                    Pembayaran tagihan denda & biaya reparasi unit telah berhasil kami terima. Transaksi sewa Anda kini telah berstatus <strong>Selesai (Completed)</strong>.
                </p>
                <button type="button" onclick="document.getElementById('modalPaidFine').remove()" class="w-full py-3 px-4 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold text-sm transition shadow-lg shadow-emerald-600/30">
                    Tutup & Lanjutkan
                </button>
            </div>
        </div>
    @endif

    <!-- ======================================================== -->
    <!-- POPUP 2: TERIMA KASIH (SELESAI TANPA DENDA)             -->
    <!-- ======================================================== -->
    @if(session('just_completed_smooth'))
        <div id="modalSmoothComplete" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm animate-fade-in">
            <div class="bg-white dark:bg-slate-900 rounded-3xl max-w-md w-full p-6 text-center shadow-2xl border border-slate-200 dark:border-slate-800 transform animate-scale-up">
                <div class="w-16 h-16 bg-amber-100 dark:bg-amber-950/60 text-amber-500 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4 shadow-inner">
                    ⭐
                </div>
                <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mb-2">
                    Makasih ya udah percaya sama GoAnywhere! ⭐⭐⭐⭐⭐
                </h3>
                <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                    Unit kendaraan telah diperiksa dan diserahkan kembali dalam kondisi sangat baik tanpa denda. Sampai jumpa di perjalanan berikutnya!
                </p>
                <button type="button" onclick="document.getElementById('modalSmoothComplete').remove()" class="w-full py-3 px-4 bg-[#004B87] hover:bg-[#002D55] text-white rounded-xl font-bold text-sm transition shadow-lg shadow-blue-800/30">
                    Sama-Sama!
                </button>
            </div>
        </div>
    @endif

    <!-- ======================================================== -->
    <!-- POPUP 3: PEMBATALAN BERHASIL                             -->
    <!-- ======================================================== -->
    @if(session('just_cancelled'))
        <div id="modalCancelled" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm animate-fade-in">
            <div class="bg-white dark:bg-slate-900 rounded-3xl max-w-md w-full p-6 text-center shadow-2xl border border-slate-200 dark:border-slate-800 transform animate-scale-up">
                <div class="w-16 h-16 bg-rose-100 dark:bg-rose-950/60 text-rose-600 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4 shadow-inner">
                    ↩️
                </div>
                <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mb-2">
                    Pesanan Dibatalkan
                </h3>
                <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                    Booking Anda telah berhasil dibatalkan sebelum persetujuan manager. Pengembalian dana otomatis berhasil diproses ke rekening/metode pembayaran Anda.
                </p>
                <button type="button" onclick="document.getElementById('modalCancelled').remove()" class="w-full py-3 px-4 bg-slate-800 hover:bg-slate-900 text-white rounded-xl font-bold text-sm transition">
                    Mengerti
                </button>
            </div>
        </div>
    @endif

    <!-- ======================================================== -->
    <!-- MODAL: FORM ALASAN PEMBATALAN BOOKING OLEH USER          -->
    <!-- ======================================================== -->
    <div id="modalCancelBooking" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/60 backdrop-blur-sm animate-fade-in">
        <div class="bg-white dark:bg-slate-900 rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-200 dark:border-slate-800 transform animate-scale-up">
            <div class="w-14 h-14 bg-rose-100 dark:bg-rose-950/60 text-rose-600 rounded-2xl flex items-center justify-center text-2xl mx-auto mb-3 shadow-inner">
                ⚠️
            </div>
            <h3 class="text-lg font-bold text-slate-900 dark:text-white text-center mb-1">
                Batalkan Pesanan
            </h3>
            <p class="text-xs text-slate-500 text-center mb-4 leading-relaxed">
                Pesanan <span id="cancelVehicleName" class="font-bold text-slate-700 dark:text-slate-300"></span> (<span id="cancelBookingCodeDisplay" class="font-mono font-bold text-[#004B87]"></span>) akan dibatalkan dan dana Anda akan diproses untuk pengembalian dana penuh.
            </p>

            <form id="cancelBookingForm" method="POST" action="">
                @csrf
                <div class="mb-4 text-left">
                    <label for="cancel_reason" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                        Alasan Pembatalan <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="cancel_reason" 
                              id="cancel_reason" 
                              rows="3" 
                              required 
                              minlength="5"
                              maxlength="500"
                              placeholder="Tulis alasan pembatalan Anda di sini (misal: ada perubahan rencana, salah armada, dll)..." 
                              class="w-full text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white p-3 focus:ring-2 focus:ring-[#004B87] focus:outline-none resize-none"></textarea>
                    <span class="text-[10px] text-slate-400 mt-1 block">Minimal 5 karakter. Alasan ini akan tercatat untuk evaluasi pihak cabang.</span>
                </div>

                <div class="flex items-center gap-2">
                    <button type="button" 
                            onclick="closeCancelModal()" 
                            class="w-1/2 py-2.5 px-4 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 rounded-xl font-bold text-xs transition">
                        Kembali
                    </button>
                    <button type="submit" 
                            class="w-1/2 py-2.5 px-4 bg-rose-600 hover:bg-rose-700 text-white rounded-xl font-bold text-xs transition shadow-md hover:shadow-rose-500/25">
                        Ya, Batalkan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openCancelModal(bookingCode, vehicleName) {
            const modal = document.getElementById('modalCancelBooking');
            const form = document.getElementById('cancelBookingForm');
            const codeDisplay = document.getElementById('cancelBookingCodeDisplay');
            const vehicleDisplay = document.getElementById('cancelVehicleName');
            const textarea = document.getElementById('cancel_reason');

            if (modal && form) {
                form.action = "{{ url('/user/rental/cancel') }}/" + bookingCode;
                if (codeDisplay) codeDisplay.textContent = bookingCode;
                if (vehicleDisplay) vehicleDisplay.textContent = vehicleName;
                if (textarea) textarea.value = '';
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                setTimeout(() => { if (textarea) textarea.focus(); }, 100);
            }
        }

        function closeCancelModal() {
            const modal = document.getElementById('modalCancelBooking');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }
    </script>
</x-app-layout>
