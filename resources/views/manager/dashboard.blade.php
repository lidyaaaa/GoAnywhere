<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard Manager - {{ Auth::user()->location }}
        </h2>
    </x-slot>

    <style>
        * {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .manager-section {
            padding: 40px 0 60px;
            background: #f8f6f2;
            position: relative;
            min-height: 100vh;
        }

        .manager-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
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
            background: #f8f6f2;
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
        .dark .manager-section::before { background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E); }
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
                    <div class="icon"></div>
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
                    <div class="icon"></div>
                    <div class="info">
                        <div class="number green">{{ $totalActiveRentals ?? 0 }}</div>
                        <div class="label">Sewa Aktif</div>
                    </div>
                </div>

                <!-- Riwayat Transaksi -->
                <div class="stat-card">
                    <div class="icon"></div>
                    <div class="info">
                        <div class="number purple">{{ $totalHistory ?? 0 }}</div>
                        <div class="label">Riwayat Transaksi</div>
                    </div>
                </div>

                <!-- Mobil -->
                <div class="stat-card">
                    <div class="icon"></div>
                    <div class="info">
                        <div class="number orange">{{ $totalCars ?? 0 }}</div>
                        <div class="label">Mobil</div>
                    </div>
                </div>

                <!-- Motor -->
                <div class="stat-card">
                    <div class="icon"></div>
                    <div class="info">
                        <div class="number teal">{{ $totalMotorcycles ?? 0 }}</div>
                        <div class="label">Motor</div>
                    </div>
                </div>

                <!-- Total Stok -->
                <div class="stat-card">
                    <div class="icon"></div>
                    <div class="info">
                        <div class="number blue">{{ $totalStock ?? 0 }}</div>
                        <div class="label">Total Stok</div>
                    </div>
                </div>

                <!-- Stok Tersedia -->
                <div class="stat-card">
                    <div class="icon"></div>
                    <div class="info">
                        <div class="number green">{{ $availableStock ?? 0 }}</div>
                        <div class="label">Stok Tersedia</div>
                    </div>
                </div>
            </div>

            <!-- ===== SEWA AKTIF ===== -->
            <div class="section-card">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="section-title"><span class="icon"></span> Sewa Aktif - {{ Auth::user()->location }}</h3>
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
                                        $remaining = now()->diffInDays(\Carbon\Carbon::parse($rental->rental_end_date), false);
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

            <!-- ===== RIWAYAT TRANSAKSI ===== -->
            <div class="section-card">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="section-title"><span class="icon"></span> Riwayat Transaksi Terakhir</h3>
                    <a href="{{ route('manager.rentals') }}" class="view-all">Lihat Semua →</a>
                </div>

                @if(isset($recentHistory) && count($recentHistory) > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Kendaraan</th>
                                    <th>Penyewa</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentHistory as $item)
                                    <tr>
                                        <td>{{ $item->booking_code ?? 'N/A' }}</td>
                                        <td>{{ $item->vehicle->name ?? 'N/A' }}</td>
                                        <td>{{ $item->user->name ?? 'N/A' }}</td>
                                        <td class="font-semibold">Rp {{ number_format($item->subtotal ?? 0, 0, ',', '.') }}</td>
                                        <td>
                                            @if($item->status == 'completed' || $item->status == 'paid')
                                                <span class="status-badge completed">Selesai</span>
                                            @else
                                                <span class="status-badge active">{{ ucfirst($item->status ?? 'N/A') }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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