<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            👑 Super Admin Dashboard
        </h2>
    </x-slot>

    <style>
        * {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .superadmin-section {
            padding: 40px 0 60px;
            background: #f8f6f2;
            position: relative;
            min-height: 100vh;
        }

        .superadmin-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
        }

        /* ===== STATISTIK 2x4 ===== */
        .stat-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
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

        .stat-card .info .number.blue { color: #43637E; }
        .stat-card .info .number.green { color: #4a7a5a; }
        .stat-card .info .number.purple { color: #7a5a8a; }
        .stat-card .info .number.orange { color: #b08a3a; }
        .stat-card .info .number.indigo { color: #4a5a8a; }
        .stat-card .info .number.yellow { color: #b08a3a; }
        .stat-card .info .number.teal { color: #3a7a7a; }
        .stat-card .info .number.red { color: #b04a4a; }
        .stat-card .info .number.gold { color: #c9a84c; }

        .stat-card .info .label {
            font-size: 13px;
            color: #7a8a9a;
            font-weight: 500;
            margin-top: 2px;
        }

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

        .location-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 16px;
            margin-top: 16px;
        }

        .location-card {
            background: #faf8f5;
            border-radius: 12px;
            padding: 16px;
            text-align: center;
            border: 1px solid #f0ede8;
            transition: all 0.3s ease;
        }

        .location-card:hover {
            border-color: #43637E;
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .location-card .name {
            font-weight: 700;
            color: #2c3e50;
            font-size: 15px;
            font-family: 'Georgia', serif;
        }

        .location-card .stat-row {
            font-size: 13px;
            color: #7a8a9a;
            margin-top: 4px;
        }

        .location-card .stat-row strong {
            color: #43637E;
        }

        .location-card .revenue {
            font-size: 14px;
            font-weight: 700;
            color: #43637E;
            margin-top: 4px;
        }

        .table-wrap {
            overflow-x: auto;
            margin-top: 12px;
        }

        .table-wrap table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-wrap thead {
            background: #f8f6f2;
            border-radius: 10px;
        }

        .table-wrap thead th {
            padding: 12px 16px;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            color: #43637E;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table-wrap tbody td {
            padding: 12px 16px;
            font-size: 14px;
            color: #5a6a7a;
            border-top: 1px solid #f0ede8;
        }

        .table-wrap tbody tr:hover {
            background: rgba(67, 99, 126, 0.02);
        }

        .table-wrap tbody .vehicle-name {
            font-weight: 600;
            color: #2c3e50;
        }

        .table-wrap tbody .booking-code {
            font-weight: 600;
            color: #43637E;
            font-family: monospace;
            font-size: 13px;
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
        .dark .superadmin-section { background: #1a2632; }
        .dark .superadmin-section::before { background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E); }
        .dark .stat-card { background: #1a2632; border-color: #2c3e50; box-shadow: 0 12px 40px rgba(0,0,0,0.4); }
        .dark .stat-card:hover { border-color: #43637E; }
        .dark .stat-card .info .number { color: #f0ede8; }
        .dark .stat-card .icon { background: rgba(67,99,126,0.15); }
        .dark .stat-card .info .label { color: #b0bec5; }
        .dark .section-card { background: #1a2632; border-color: #2c3e50; box-shadow: 0 12px 40px rgba(0,0,0,0.4); }
        .dark .section-card:hover { border-color: #43637E; }
        .dark .section-card .section-title { color: #f0ede8; }
        .dark .section-card .view-all { color: #f0e6d0; }
        .dark .section-card .view-all:hover { color: #ffffff; }
        .dark .location-card { background: #0f1a24; border-color: #2c3e50; }
        .dark .location-card:hover { border-color: #43637E; }
        .dark .location-card .name { color: #f0ede8; }
        .dark .location-card .stat-row { color: #b0bec5; }
        .dark .location-card .stat-row strong { color: #f0e6d0; }
        .dark .location-card .revenue { color: #f0e6d0; }
        .dark .table-wrap thead { background: #0f1a24; }
        .dark .table-wrap thead th { color: #f0e6d0; }
        .dark .table-wrap tbody td { color: #b0bec5; border-top-color: #2c3e50; }
        .dark .table-wrap tbody tr:hover { background: rgba(67,99,126,0.05); }
        .dark .table-wrap tbody .vehicle-name { color: #f0ede8; }
        .dark .table-wrap tbody .booking-code { color: #f0e6d0; }
        .dark .empty-state { color: #b0bec5; }

        @media (max-width: 1024px) {
            .location-grid { grid-template-columns: repeat(3, 1fr); }
        }

        @media (max-width: 768px) {
            .section-card { padding: 18px 16px; }
            .location-grid { grid-template-columns: repeat(2, 1fr); }
            .stat-grid { gap: 12px; }
            .stat-card { padding: 16px 14px; }
            .stat-card .icon { font-size: 28px; width: 44px; height: 44px; }
            .stat-card .info .number { font-size: 22px; }
            .stat-card .info .label { font-size: 12px; }
            .table-wrap thead th, .table-wrap tbody td { padding: 10px 12px; font-size: 12px; }
        }

        @media (max-width: 480px) {
            .superadmin-section { padding: 24px 0 40px; }
            .section-card { padding: 14px 12px; }
            .stat-grid { gap: 10px; }
            .stat-card { padding: 12px 10px; }
            .stat-card .icon { font-size: 22px; width: 36px; height: 36px; }
            .stat-card .info .number { font-size: 18px; }
            .stat-card .info .label { font-size: 11px; }
            .location-grid { grid-template-columns: 1fr; }
            .table-wrap thead th, .table-wrap tbody td { padding: 8px 8px; font-size: 11px; }
        }

        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #f0ede8; }
        ::-webkit-scrollbar-thumb { background: #43637E; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #36546b; }
        .dark ::-webkit-scrollbar-track { background: #1a2632; }
        .dark ::-webkit-scrollbar-thumb { background: #43637E; }
    </style>

    <div class="superadmin-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- ===== STATISTIK 2x4 ===== -->
            <div class="stat-grid">
                <!-- Total User -->
                <div class="stat-card">
                    <div class="icon">👤</div>
                    <div class="info">
                        <div class="number blue">{{ $totalUsers ?? 0 }}</div>
                        <div class="label">Total User</div>
                    </div>
                </div>

                <!-- Total Manager -->
                <div class="stat-card">
                    <div class="icon">👨‍💼</div>
                    <div class="info">
                        <div class="number green">{{ $totalManagers ?? 0 }}</div>
                        <div class="label">Total Manager</div>
                    </div>
                </div>

                <!-- Total Armada -->
                <div class="stat-card">
                    <div class="icon">🚗</div>
                    <div class="info">
                        <div class="number purple">{{ $totalVehicles ?? 0 }}</div>
                        <div class="label">Total Armada</div>
                    </div>
                </div>

                <!-- Total Stok -->
                <div class="stat-card">
                    <div class="icon">📦</div>
                    <div class="info">
                        <div class="number orange">{{ $totalStock ?? 0 }}</div>
                        <div class="label">Total Stok</div>
                    </div>
                </div>

                <!-- Total Transaksi -->
                <div class="stat-card">
                    <div class="icon">📋</div>
                    <div class="info">
                        <div class="number indigo">{{ $totalTransactions ?? 0 }}</div>
                        <div class="label">Total Transaksi</div>
                    </div>
                </div>

                <!-- Sewa Aktif -->
                <div class="stat-card">
                    <div class="icon">🚗</div>
                    <div class="info">
                        <div class="number yellow">{{ $activeRentals ?? 0 }}</div>
                        <div class="label">Sewa Aktif</div>
                    </div>
                </div>

                <!-- Total Revenue (full width) -->
                <div class="stat-card" style="grid-column: span 2;">
                    <div class="icon">💰</div>
                    <div class="info">
                        <div class="number gold">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</div>
                        <div class="label">Total Revenue</div>
                    </div>
                </div>
            </div>

            <!-- ===== STATISTIK PER LOKASI ===== -->
            <div class="section-card">
                <h3 class="section-title"><span class="icon">📍</span> Statistik per Lokasi</h3>

                <div class="location-grid">
                    @foreach($locationStats as $loc => $stats)
                        <div class="location-card">
                            <div class="name">{{ $loc }}</div>
                            <div class="stat-row">🚗 <strong>{{ $stats['vehicles'] }}</strong> Armada</div>
                            <div class="stat-row">⏳ <strong>{{ $stats['active_rentals'] }}</strong> Aktif</div>
                            <div class="revenue">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- ===== TRANSAKSI TERBARU ===== -->
            <div class="section-card">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="section-title"><span class="icon">📜</span> Transaksi Terbaru</h3>
                    <a href="{{ route('superadmin.rentals') }}" class="view-all">Lihat Semua →</a>
                </div>

                @if(isset($recentTransactions) && count($recentTransactions) > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Kendaraan</th>
                                    <th>Penyewa</th>
                                    <th>Lokasi</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentTransactions as $item)
                                    <tr>
                                        <td><span class="booking-code">{{ $item->booking_code ?? 'N/A' }}</span></td>
                                        <td class="vehicle-name">{{ $item->vehicle->name ?? 'N/A' }}</td>
                                        <td>{{ $item->user->name ?? 'N/A' }}</td>
                                        <td>{{ $item->vehicle->location ?? 'N/A' }}</td>
                                        <td style="font-weight: 600; color: #43637E;">Rp {{ number_format($item->subtotal ?? 0, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <span class="icon">📭</span>
                        <p>Belum ada transaksi</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>