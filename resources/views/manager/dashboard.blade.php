<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard Manager - {{ Auth::user()->location }}
        </h2>
    </x-slot>

    <style>

        .manager-section {
            padding: 40px 0 60px;
            background: #eef1f4;
            position: relative;
            min-height: 100vh;
        }

        /* ===== STATISTIK 2x3 ===== */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 24px 20px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15), 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e8e4de;
            transition: all 0.4s ease;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 55px rgba(0, 0, 0, 0.22), 0 12px 35px rgba(0, 0, 0, 0.12);
            border-color: #43637E;
        }

        .stat-card .icon {
            font-size: 36px;
            flex-shrink: 0;
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(67, 99, 126, 0.08);
            border-radius: 12px;
        }

        .stat-card .info {
            flex: 1;
        }

        .stat-card .info .number {
            font-size: 28px;
            font-weight: 700;
            font-family: 'Georgia', serif;
            color: #2c3e50;
            line-height: 1.2;
        }

        .stat-card .info .number.income {
            color: #4a7a5a;
        }

        .stat-card .info .number.blue {
            color: #43637E;
        }

        .stat-card .info .number.green {
            color: #4a7a5a;
        }

        .stat-card .info .number.orange {
            color: #b08a3a;
        }

        .stat-card .info .number.purple {
            color: #7a5a8a;
        }

        .stat-card .info .number.teal {
            color: #3a7a7a;
        }

        .stat-card .info .number.red {
            color: #b04a4a;
        }

        .stat-card .info .label {
            font-size: 13px;
            color: #7a8a9a;
            font-weight: 500;
            margin-top: 2px;
        }

        /* ===== SECTION CARD ===== */
        .section-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 24px 28px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15), 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e8e4de;
            transition: all 0.4s ease;
            margin-bottom: 24px;
        }

        .section-card:hover {
            box-shadow: 0 20px 55px rgba(0, 0, 0, 0.22), 0 12px 35px rgba(0, 0, 0, 0.12);
            border-color: #43637E;
        }

        .section-card .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
        }

        .section-card .section-title .icon {
            margin-right: 8px;
        }

        .section-card .table-wrap {
            overflow-x: auto;
            margin-top: 12px;
        }

        .section-card table {
            width: 100%;
            border-collapse: collapse;
        }

        .section-card thead {
            background: #eef1f4;
            border-radius: 10px;
        }

        .section-card thead th {
            padding: 12px 16px;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            color: #43637E;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .section-card tbody td {
            padding: 12px 16px;
            font-size: 14px;
            color: #5a6a7a;
            border-top: 1px solid #f0ede8;
        }

        .section-card tbody tr:hover {
            background: rgba(67, 99, 126, 0.02);
        }

        .section-card .status-badge {
            display: inline-block;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .section-card .status-badge.active {
            background: #e8f4ec;
            color: #4a7a5a;
        }

        .section-card .status-badge.warning {
            background: #fdf6e8;
            color: #b08a3a;
        }

        .section-card .status-badge.danger {
            background: #fce8e8;
            color: #b04a4a;
        }

        .section-card .status-badge.completed {
            background: #e8f4ec;
            color: #4a7a5a;
        }

        .section-card .view-all {
            color: #43637E;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .section-card .view-all:hover {
            color: #36546b;
            text-decoration: underline;
        }

        .empty-state {
            text-align: center;
            padding: 32px 20px;
            color: #7a8a9a;
        }

        .empty-state .icon {
            font-size: 40px;
            display: block;
            margin-bottom: 8px;
        }

        /* ===== DARK MODE ===== */
        .dark .manager-section { background: #1a2632; }
        .dark .stat-card { background: #1a2632; border-color: #2c3e50; box-shadow: 0 12px 40px rgba(0,0,0,0.4); }
        .dark .stat-card:hover { border-color: #43637E; }
        .dark .stat-card .info .number { color: #f0ede8; }
        .dark .stat-card .info .label { color: #b0bec5; }
        .dark .stat-card .icon { background: rgba(67,99,126,0.15); }
        .dark .section-card { background: #1a2632; border-color: #2c3e50; box-shadow: 0 12px 40px rgba(0,0,0,0.4); }
        .dark .section-card:hover { border-color: #43637E; }
        .dark .section-card .section-title { color: #f0ede8; }
        .dark .section-card thead { background: #0f1a24; }
        .dark .section-card thead th { color: #f0e6d0; }
        .dark .section-card tbody td { color: #b0bec5; border-top-color: #2c3e50; }
        .dark .section-card tbody tr:hover { background: rgba(67,99,126,0.05); }
        .dark .section-card .view-all { color: #f0e6d0; }
        .dark .section-card .view-all:hover { color: #ffffff; }
        .dark .empty-state { color: #b0bec5; }

        @media (max-width: 768px) {
            .stat-grid { gap: 12px; }
            .stat-card { padding: 16px 14px; }
            .stat-card .icon { font-size: 28px; width: 44px; height: 44px; }
            .stat-card .info .number { font-size: 22px; }
            .stat-card .info .label { font-size: 12px; }
            .section-card { padding: 18px 16px; }
        }

        @media (max-width: 480px) {
            .manager-section { padding: 24px 0 40px; }
            .stat-grid { gap: 10px; }
            .stat-card { padding: 12px 10px; }
            .stat-card .icon { font-size: 22px; width: 36px; height: 36px; }
            .stat-card .info .number { font-size: 18px; }
            .stat-card .info .label { font-size: 11px; }
            .section-card { padding: 14px 12px; }
            .section-card thead th, .section-card tbody td { padding: 8px 10px; font-size: 12px; }
        }

        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #f0ede8; }
        ::-webkit-scrollbar-thumb { background: #43637E; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #36546b; }
        .dark ::-webkit-scrollbar-track { background: #1a2632; }
        .dark ::-webkit-scrollbar-thumb { background: #43637E; }
    </style>

    <div class="manager-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- ===== STATISTIK 2x3 ===== -->
            <div class="stat-grid">
                    <!-- Total Income -->
                <div class="stat-card">
                    <div class="icon">💰</div>
                    <div class="info">
                        <div class="number income">Rp {{ number_format($totalIncome ?? 0, 0, ',', '.') }}</div>
                        <div class="label">Total Income</div>
                    </div>
                </div>

                <!-- Total Armada -->
                <div class="stat-card">
                    <div class="icon">🚗</div>
                    <div class="info">
                        <div class="number blue">{{ $totalVehicles ?? 0 }}</div>
                        <div class="label">Total Armada</div>
                    </div>
                </div>

                <!-- Sewa Aktif -->
                <div class="stat-card">
                    <div class="icon">📦</div>
                    <div class="info">
                        <div class="number green">{{ $totalActiveRentals ?? 0 }}</div>
                        <div class="label">Sewa Aktif</div>
                    </div>
                </div>

                <!-- Riwayat Transaksi -->
                <div class="stat-card">
                    <div class="icon">📜</div>
                    <div class="info">
                        <div class="number purple">{{ $totalHistory ?? 0 }}</div>
                        <div class="label">Riwayat Transaksi</div>
                    </div>
                </div>

                <!-- Mobil -->
                <div class="stat-card">
                    <div class="icon">🚘</div>
                    <div class="info">
                        <div class="number orange">{{ $totalCars ?? 0 }}</div>
                        <div class="label">Mobil</div>
                    </div>
                </div>

                <!-- Motor -->
                <div class="stat-card">
                    <div class="icon">🏍️</div>
                    <div class="info">
                        <div class="number teal">{{ $totalMotorcycles ?? 0 }}</div>
                        <div class="label">Motor</div>
                    </div>
                </div>

                <!-- Total Stok -->
                <div class="stat-card">
                    <div class="icon">📊</div>
                    <div class="info">
                        <div class="number blue">{{ $totalStock ?? 0 }}</div>
                        <div class="label">Total Stok</div>
                    </div>
                </div>

                <!-- Stok Tersedia -->
                <div class="stat-card">
                    <div class="icon">✅</div>
                    <div class="info">
                        <div class="number green">{{ $availableStock ?? 0 }}</div>
                        <div class="label">Stok Tersedia</div>
                    </div>
                </div>

                <!-- Unit Rusak/Servis -->
                <div class="stat-card">
                    <div class="icon">🛠️</div>
                    <div class="info">
                        <div class="number orange">{{ $totalDamagedStock ?? 0 }}</div>
                        <div class="label">Unit Rusak/Servis</div>
                    </div>
                </div>
            </div>

            <!-- ===== DAFTAR KENDARAAN RUSAK / PERBAIKAN ===== -->
            <div class="section-card {{ ($totalDamagedStock ?? 0) > 0 ? 'border-amber-300' : 'border-emerald-200' }}">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="section-title {{ ($totalDamagedStock ?? 0) > 0 ? 'text-amber-800' : 'text-slate-800' }} flex items-center gap-2">
                        <span class="text-xl">🛠️</span> <span>Daftar Kendaraan Rusak / Dalam Perbaikan</span>
                    </h3>
                    @if(($totalDamagedStock ?? 0) > 0)
                        <span class="text-xs font-bold px-3 py-1 bg-rose-100 text-rose-800 border border-rose-200 rounded-full flex items-center gap-1 shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-rose-500 animate-ping"></span>
                            Total Rusak: {{ $totalDamagedStock }} Unit
                        </span>
                    @else
                        <span class="text-xs font-bold px-3 py-1 bg-emerald-100 text-emerald-800 border border-emerald-200 rounded-full flex items-center gap-1 shadow-sm">
                            <span>✅</span> Total Rusak: 0 Unit
                        </span>
                    @endif
                </div>

                @if(isset($damagedVehicles) && count($damagedVehicles) > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kendaraan</th>
                                    <th>Jenis / Tipe</th>
                                    <th>Unit Rusak</th>
                                    <th>Stok Tersedia Saat Ini</th>
                                    <th>Aksi Perbaikan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($damagedVehicles as $item)
                                    <tr>
                                        <td>
                                            <div class="flex items-center gap-3">
                                                @if($item->image)
                                                    <img src="{{ asset('storage/' . $item->image) }}" class="w-12 h-10 object-cover rounded-lg border">
                                                @else
                                                    <div class="w-12 h-10 bg-slate-200 rounded-lg flex items-center justify-center text-sm">🚗</div>
                                                @endif
                                                <div>
                                                    <div class="font-bold text-slate-800">{{ $item->name }}</div>
                                                    <div class="text-xs text-slate-500">{{ $item->brand }} • {{ $item->year }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="px-2 py-0.5 rounded text-xs font-medium {{ $item->vehicle_type === 'car' ? 'bg-blue-100 text-blue-800' : 'bg-emerald-100 text-emerald-800' }}">
                                                {{ $item->vehicle_type === 'car' ? 'Mobil' : 'Motor' }} ({{ $item->type }})
                                            </span>
                                        </td>
                                        <td>
                                            <span class="font-bold text-rose-600 text-sm">
                                                ⚠️ {{ $item->damaged_stock }} unit
                                            </span>
                                        </td>
                                        <td>
                                            <span class="font-semibold text-slate-700">
                                                {{ $item->available_stock }} / {{ $item->total_stock }}
                                            </span>
                                        </td>
                                        <td>
                                            <form action="{{ route('manager.vehicles.repair', $item->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-3.5 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold transition flex items-center gap-1.5 shadow-sm" onclick="return confirm('Konfirmasi: 1 unit {{ $item->name }} telah selesai diservis di bengkel dan siap disewakan kembali?')">
                                                    <span>🔧</span> Selesai Servis / Siap Sewa
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-6 text-center rounded-2xl bg-gradient-to-r from-emerald-50/70 via-teal-50/50 to-emerald-50/70 border border-emerald-200/80 shadow-inner">
                        <div class="w-12 h-12 mx-auto mb-2 rounded-full bg-emerald-100 flex items-center justify-center text-2xl text-emerald-700 shadow-sm">
                            ✨
                        </div>
                        <h4 class="text-base font-bold text-slate-800 mb-1">Armada Cabang {{ Auth::user()->location }} Siap Beroperasi!</h4>
                        <p class="text-slate-600 text-xs max-w-lg mx-auto">
                            Semua unit kendaraan dalam kondisi prima dan siap disewa oleh customer. Tidak ada unit yang sedang mengalami kerusakan atau perbaikan.
                        </p>
                    </div>
                @endif
            </div>

            <!-- ===== SEWA AKTIF ===== -->
            <div class="section-card">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="section-title"><span class="icon">📅</span> Sewa Aktif - {{ Auth::user()->location }}</h3>
                </div>

                @if(isset($activeRentals) && count($activeRentals) > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kendaraan</th>
                                    <th>Disewa Oleh</th>
                                    <th>Tanggal Sewa</th>
                                    <th>Sisa Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activeRentals as $rental)
                                    @php
                                        $remaining = now()->startOfDay()->diffInDays(\Carbon\Carbon::parse($rental->rental_end_date)->startOfDay(), false);
                                        if ($remaining > 0) {
                                            $statusClass = 'active';
                                            $statusText = $remaining . ' hari';
                                        } elseif ($remaining == 0) {
                                            $statusClass = 'warning';
                                            $statusText = 'Hari terakhir!';
                                        } else {
                                            $statusClass = 'danger';
                                            $statusText = 'Telat ' . abs($remaining) . ' hari!';
                                        }
                                    @endphp
                                    <tr>
                                        <td class="font-medium">{{ $rental->vehicle->name ?? 'N/A' }}</td>
                                        <td>{{ $rental->user->name ?? 'N/A' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($rental->rental_start_date)->format('d M Y') }} - {{ \Carbon\Carbon::parse($rental->rental_end_date)->format('d M Y') }}</td>
                                        <td><span class="status-badge {{ $statusClass }}">{{ $statusText }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <span class="icon"></span>
                        <p>Tidak ada sewa aktif</p>
                    </div>
                @endif
            </div>

            <!-- ===== LAPORAN PEMASUKAN BULANAN CABANG MANAGER ===== -->
            <div class="section-card border-l-4 border-l-[#004B87]">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
                    <div>
                        <h3 class="section-title mb-0">
                            <span>📅</span> Laporan Pemasukan Bulanan — Cabang {{ Auth::user()->location }}
                        </h3>
                        <p class="text-xs text-slate-500 mt-0.5">Pilih bulan untuk melihat total pemasukan dan rincian kendaraan cabang Anda yang disewa.</p>
                    </div>

                    {{-- Form Pilih Bulan --}}
                    <form action="{{ route('manager.dashboard') }}" method="GET" class="flex items-center gap-2">
                        <label for="selectMonthManager" class="text-xs font-bold text-slate-600 uppercase tracking-wider">Pilih Bulan:</label>
                        <select name="month" id="selectMonthManager" onchange="this.form.submit()" class="py-2 px-3.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-xs font-bold text-[#004B87] dark:text-blue-300 focus:ring-2 focus:ring-[#004B87] focus:outline-none shadow-sm">
                            @forelse($availableMonths as $monthOpt)
                                <option value="{{ $monthOpt->month_key }}" {{ $selectedMonth === $monthOpt->month_key ? 'selected' : '' }}>
                                    🗓️ {{ $monthOpt->month_name }}
                                </option>
                            @empty
                                <option value="{{ now()->format('Y-m') }}">🗓️ {{ now()->translatedFormat('F Y') }}</option>
                            @endforelse
                        </select>
                    </form>
                </div>

                {{-- Banner Ringkasan Bulan Terpilih --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-5">
                    <div class="p-4 rounded-2xl bg-gradient-to-r from-blue-50 to-sky-50 dark:from-slate-800 dark:to-slate-850 border border-blue-200/80 dark:border-blue-900/50 flex items-center justify-between">
                        <div>
                            <div class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Pemasukan Cabang ({{ $selectedMonthName }})</div>
                            <div class="text-2xl font-black text-[#004B87] dark:text-blue-300 mt-1">
                                Rp {{ number_format($monthlyTotalRevenue ?? 0, 0, ',', '.') }}
                            </div>
                            <div class="text-[11px] text-slate-500 mt-1">
                                Sewa: Rp {{ number_format($monthlyRentalRevenue ?? 0, 0, ',', '.') }}
                            </div>
                        </div>
                        <span class="text-3xl">💰</span>
                    </div>

                    <div class="p-4 rounded-2xl bg-gradient-to-r from-rose-50 to-amber-50 dark:from-slate-800 dark:to-slate-850 border border-rose-200/80 dark:border-rose-900/50 flex items-center justify-between">
                        <div>
                            <div class="text-xs font-bold uppercase tracking-wider text-rose-700">Pemasukan Denda & Reparasi</div>
                            <div class="text-2xl font-black text-rose-600 dark:text-rose-400 mt-1">
                                Rp {{ number_format($monthlyFineRevenue ?? 0, 0, ',', '.') }}
                            </div>
                            <div class="text-[11px] text-slate-500 mt-1">
                                Dari denda telat & perbaikan cabang
                            </div>
                        </div>
                        <span class="text-3xl">🛠️</span>
                    </div>

                    <div class="p-4 rounded-2xl bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-slate-800 dark:to-slate-850 border border-emerald-200/80 dark:border-emerald-900/50 flex items-center justify-between">
                        <div>
                            <div class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Kendaraan Disewa ({{ $selectedMonthName }})</div>
                            <div class="text-2xl font-black text-emerald-700 dark:text-emerald-300 mt-1">
                                {{ $monthlyTransactionCount ?? 0 }} Unit
                            </div>
                            <div class="text-[11px] text-slate-500 mt-1">
                                Cabang {{ Auth::user()->location }}
                            </div>
                        </div>
                        <span class="text-3xl">🚗</span>
                    </div>
                </div>

                {{-- Tabel Daftar Kendaraan yang Disewa di Bulan Terpilih --}}
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-600 dark:text-slate-300 mb-2.5">
                    Daftar Kendaraan Cabang {{ Auth::user()->location }} yang Disewa pada {{ $selectedMonthName }}:
                </h4>

                @if(isset($monthlyItems) && count($monthlyItems) > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode Booking</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Kendaraan Disewa</th>
                                    <th>Penyewa</th>
                                    <th>Durasi Sewa</th>
                                    <th>Status</th>
                                    <th>Biaya Sewa (+Ongkir)</th>
                                    <th>Denda / Reparasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($monthlyItems as $item)
                                    @php
                                        $itemFineTotal = max(0, (float)$item->fine_amount) + max(0, (float)$item->damage_fee);
                                    @endphp
                                    <tr>
                                        <td><span class="font-mono font-bold text-[#004B87] dark:text-blue-300">{{ $item->booking_code }}</span></td>
                                        <td class="text-xs text-slate-600 font-medium">
                                            {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}
                                        </td>
                                        <td>
                                            <div class="font-bold text-slate-800 dark:text-slate-200">{{ $item->vehicle->name ?? 'N/A' }}</div>
                                            <div class="text-[11px] text-slate-400">{{ $item->vehicle->brand ?? '' }} ({{ $item->vehicle->vehicle_type == 'car' ? 'Mobil' : 'Motor' }})</div>
                                        </td>
                                        <td>
                                            <div class="font-bold text-slate-800 dark:text-slate-200">{{ $item->user->name ?? 'N/A' }}</div>
                                            <div class="text-[11px] text-slate-400">{{ $item->user->email ?? '-' }}</div>
                                        </td>
                                        <td class="text-xs font-semibold text-slate-700 dark:text-slate-300">
                                            {{ $item->period === 'weekly' ? '🎁 Paket 7 Hari' : ($item->quantity_days ?? 1) . ' Hari' }}
                                        </td>
                                        <td>
                                            @if($item->status === 'completed')
                                                <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[11px] font-bold">✅ Selesai</span>
                                            @elseif($item->status === 'active')
                                                <span class="px-2 py-0.5 rounded-full bg-blue-100 text-blue-800 text-[11px] font-bold">🚗 Aktif</span>
                                            @elseif($item->status === 'approved')
                                                <span class="px-2 py-0.5 rounded-full bg-sky-100 text-sky-800 text-[11px] font-bold">🚚 OTW</span>
                                            @elseif($item->status === 'paid')
                                                <span class="px-2 py-0.5 rounded-full bg-amber-100 text-amber-800 text-[11px] font-bold">⏳ Dibayar</span>
                                            @else
                                                <span class="px-2 py-0.5 rounded-full bg-purple-100 text-purple-800 text-[11px] font-bold">🔍 Proses Kembali</span>
                                            @endif
                                        </td>
                                        <td style="font-weight: 700; color: #004B87;">
                                            Rp {{ number_format(($item->total_payment > 0 ? $item->total_payment : $item->subtotal) ?? 0, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            @if($itemFineTotal > 0)
                                                <span class="text-rose-600 font-bold text-xs">
                                                    +Rp {{ number_format($itemFineTotal, 0, ',', '.') }}
                                                </span>
                                                @if($item->damage_note)
                                                    <div class="text-[10px] text-slate-500">{{ $item->damage_note }}</div>
                                                @endif
                                            @else
                                                <span class="text-slate-400 text-xs">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($monthlyItems->hasPages())
                        <div class="mt-4">
                            {{ $monthlyItems->links() }}
                        </div>
                    @endif
                @else
                    <div class="empty-state">
                        <p>Tidak ada transaksi sewa kendaraan di cabang {{ Auth::user()->location }} pada bulan {{ $selectedMonthName }}.</p>
                    </div>
                @endif
            </div>

            <!-- ===== TRANSAKSI TERBARU CABANG ===== -->
            <div class="section-card">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="section-title"><span class="icon">📂</span> Transaksi Terbaru — Cabang {{ Auth::user()->location }}</h3>
                    <a href="{{ route('manager.rentals') }}" class="view-all">Lihat Semua →</a>
                </div>

                @if(isset($recentHistory) && count($recentHistory) > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Tanggal</th>
                                    <th>Kendaraan</th>
                                    <th>Penyewa</th>
                                    <th>Lokasi</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentHistory as $item)
                                    <tr>
                                        <td><span class="font-mono font-bold text-[#004B87] dark:text-blue-300">{{ $item->booking_code ?? 'N/A' }}</span></td>
                                        <td class="text-xs text-slate-600 font-medium">
                                            {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}
                                        </td>
                                        <td class="font-bold text-slate-800 dark:text-slate-200">{{ $item->vehicle->name ?? 'N/A' }}</td>
                                        <td>{{ $item->user->name ?? 'N/A' }}</td>
                                        <td>{{ $item->vehicle->location ?? 'N/A' }}</td>
                                        <td>
                                            @if($item->status === 'completed')
                                                <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[11px] font-bold">✅ Selesai</span>
                                            @elseif($item->status === 'active')
                                                <span class="px-2 py-0.5 rounded-full bg-blue-100 text-blue-800 text-[11px] font-bold">🚗 Aktif</span>
                                            @elseif($item->status === 'approved')
                                                <span class="px-2 py-0.5 rounded-full bg-sky-100 text-sky-800 text-[11px] font-bold">🚚 OTW</span>
                                            @elseif($item->status === 'paid')
                                                <span class="px-2 py-0.5 rounded-full bg-amber-100 text-amber-800 text-[11px] font-bold">⏳ Dibayar</span>
                                            @else
                                                <span class="px-2 py-0.5 rounded-full bg-purple-100 text-purple-800 text-[11px] font-bold">🔍 Proses Kembali</span>
                                            @endif
                                        </td>
                                        <td style="font-weight: 600; color: #43637E;">
                                            Rp {{ number_format(($item->total_payment > 0 ? $item->total_payment : $item->subtotal) ?? 0, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($recentHistory->hasPages())
                        <div class="mt-4">
                            {{ $recentHistory->links() }}
                        </div>
                    @endif
                @else
                    <div class="empty-state">
                        <span class="icon"></span>
                        <p>Belum ada transaksi</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>