<x-app-layout>
    <style>
        * {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .superadmin-section {
            padding: 40px 0 60px;
            background: transparent;
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

        /* ===== STATISTIK ===== */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 32px;
        }

        @keyframes statReveal {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.82) !important;
            border: 1px solid rgba(15, 23, 42, 0.07) !important;
            border-radius: 18px !important;
            padding: 22px !important;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.06), 0 2px 5px rgba(15, 23, 42, 0.03) !important;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease !important;
            display: flex;
            align-items: flex-start;
            gap: 16px;
            text-decoration: none;
            position: relative;
            overflow: hidden;
            min-height: 142px;
            cursor: pointer;
            animation: statReveal 0.45s ease both;
        }

        .stat-card:nth-child(2) { animation-delay: 0.05s; }
        .stat-card:nth-child(3) { animation-delay: 0.1s; }
        .stat-card:nth-child(4) { animation-delay: 0.15s; }
        .stat-card:nth-child(5) { animation-delay: 0.2s; }
        .stat-card:nth-child(6) { animation-delay: 0.25s; }
        .stat-card:nth-child(7) { animation-delay: 0.3s; }

        .stat-card::after {
            content: '';
            position: absolute;
            width: 150px;
            height: 150px;
            right: -84px;
            bottom: -92px;
            border-radius: 50%;
            background: rgba(106, 155, 209, 0.12);
            pointer-events: none;
            transition: transform 0.35s ease;
        }

        .stat-card:hover {
            background: #ffffff !important;
            border-color: rgba(0, 75, 135, 0.18) !important;
            transform: translateY(-6px);
            box-shadow: 0 18px 34px rgba(0, 75, 135, 0.14), 0 5px 12px rgba(15, 23, 42, 0.06) !important;
        }

        .stat-card:hover::after {
            transform: scale(1.35);
        }

        .stat-card:focus-visible {
            outline: 3px solid rgba(0, 75, 135, 0.3);
            outline-offset: 3px;
        }

        .stat-card .info {
            transition: transform 0.3s ease;
            min-width: 0;
            position: relative;
            z-index: 1;
        }

        .stat-card:hover .info,
        .stat-card:focus-visible .info {
            transform: translateX(6px);
        }

        .stat-card:hover .number,
        .stat-card:focus-visible .number {
            color: #004b87;
        }

        .stat-card .icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            flex: 0 0 48px;
            border-radius: 14px;
            background: var(--icon-bg, #e8f1f8);
            color: var(--icon-color, #17659c);
            transition: transform 0.3s ease;
        }

        .stat-card .icon svg {
            width: 23px;
            height: 23px;
        }

        .stat-card:hover .icon,
        .stat-card:focus-visible .icon {
            transform: rotate(-6deg) scale(1.08);
        }

        .stat-card .icon-green { --icon-bg: #e8f5ed; --icon-color: #3f8157; }
        .stat-card .icon-purple { --icon-bg: #f1eafa; --icon-color: #7957a5; }
        .stat-card .icon-orange { --icon-bg: #fff3dc; --icon-color: #b47a20; }
        .stat-card .icon-indigo { --icon-bg: #e9edfb; --icon-color: #4c5da4; }
        .stat-card .icon-yellow { --icon-bg: #fff6d9; --icon-color: #a77b1b; }
        .stat-card .icon-gold { --icon-bg: #fff1c7; --icon-color: #a47716; }

        .stat-card .info .number {
            font-size: 32px;
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: #082f52;
            line-height: 1.1;
        }

        .stat-card .info .label {
            display: block;
            margin-top: 8px;
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .section-card {
            background: #ffffff;
            border-radius: 8px;
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
            border-radius: 6px;
            padding: 16px;
            text-align: center;
            border: 1px solid #f0ede8;
            transition: all 0.3s ease;
            position: relative;
        }

        .location-card:hover {
            border-color: #43637E;
            transform: translateY(-4px) scale(1.02);
            background: #ffffff;
            box-shadow: 0 12px 25px rgba(0, 75, 135, 0.12);
        }

        .location-card:hover .revenue {
            color: #004b87;
            transform: translateY(-2px);
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
            background: rgba(106, 155, 209, 0.1);
            transform: translateX(4px);
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
        .dark .stat-card { background: rgba(15, 26, 36, 0.78) !important; border-color: rgba(148, 163, 184, 0.16) !important; box-shadow: 0 10px 24px rgba(0,0,0,0.24) !important; }
        .dark .stat-card:hover { background: #162b3d !important; border-color: #6a9bd1 !important; box-shadow: 0 18px 34px rgba(0,0,0,0.34) !important; }
        .dark .stat-card .info .number { color: #f0ede8; }
        .dark .stat-card:hover .number { color: #b9d9f0; }
        .dark .stat-card .info .label { color: #aebdca; }
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
            .stat-grid { grid-template-columns: repeat(2, 1fr); }
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
            .stat-grid { grid-template-columns: 1fr; }
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

            <!-- ===== STATISTIK ===== -->
            <div class="stat-grid">
                <!-- Total User -->
                <a href="{{ route('superadmin.users') }}" class="stat-card">
                    <div class="icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m6-10a4 4 0 100-8 4 4 0 000 8zm12 10v-2a4 4 0 00-3-3.87m-1-12a4 4 0 010 7.75"/></svg>
                    </div>
                    <div class="info">
                        <div class="number blue">{{ $totalUsers ?? 0 }}</div>
                        <div class="label">Total User</div>
                    </div>
                </a>

                <!-- Total Manager -->
                <a href="{{ route('superadmin.managers') }}" class="stat-card">
                    <div class="icon icon-green">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15a4 4 0 100-8 4 4 0 000 8zm-7 6a7 7 0 0114 0M19 8h3m-1.5-1.5V10"/></svg>
                    </div>
                    <div class="info">
                        <div class="number green">{{ $totalManagers ?? 0 }}</div>
                        <div class="label">Total Manager</div>
                    </div>
                </a>

                <!-- Total Armada -->
                <a href="{{ route('superadmin.vehicles') }}" class="stat-card">
                    <div class="icon icon-purple">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 17h14l1-5-2-5H6l-2 5 1 5zm0 0v2m14-2v2M7 12h10M7 17h.01M17 17h.01"/></svg>
                    </div>
                    <div class="info">
                        <div class="number purple">{{ $totalVehicles ?? 0 }}</div>
                        <div class="label">Total Armada</div>
                    </div>
                </a>

                <!-- Total Stok -->
                <a href="{{ route('superadmin.vehicles') }}" class="stat-card">
                    <div class="icon icon-orange">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 7l8-4 8 4-8 4-8-4zm0 5l8 4 8-4M4 17l8 4 8-4"/></svg>
                    </div>
                    <div class="info">
                        <div class="number orange">{{ $totalStock ?? 0 }}</div>
                        <div class="label">Total Stok</div>
                    </div>
                </a>

                <!-- Total Transaksi -->
                <a href="{{ route('superadmin.rentals') }}" class="stat-card">
                    <div class="icon icon-indigo">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7h8m-8 4h5m-9 9h14a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div class="info">
                        <div class="number indigo">{{ $totalTransactions ?? 0 }}</div>
                        <div class="label">Total Transaksi</div>
                    </div>
                </a>

                <!-- Sewa Aktif -->
                <a href="{{ route('superadmin.rentals') }}" class="stat-card">
                    <div class="icon icon-yellow">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="info">
                        <div class="number yellow">{{ $activeRentals ?? 0 }}</div>
                        <div class="label">Sewa Aktif</div>
                    </div>
                </a>

                <!-- Total Revenue (full width) -->
                <a href="{{ route('superadmin.rentals') }}" class="stat-card" style="grid-column: 1 / -1;">
                    <div class="icon icon-gold">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v18m4-14.5c-.7-.65-1.8-1-3-1-2.2 0-4 1.12-4 2.5s1.8 2.5 4 2.5 4 1.12 4 2.5-1.8 2.5-4 2.5c-1.2 0-2.3-.35-3-1"/></svg>
                    </div>
                    <div class="info">
                        <div class="number gold">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</div>
                        <div class="label">Total Revenue</div>
                    </div>
                </a>
            </div>

            <!-- ===== STATISTIK PER LOKASI ===== -->
            <div class="section-card">
                <h3 class="section-title">Statistik per Lokasi</h3>

                <div class="location-grid">
                    @foreach($locationStats as $loc => $stats)
                        <div class="location-card">
                            <div class="name">{{ $loc }}</div>
                            <div class="stat-row"> <strong>{{ $stats['vehicles'] }}</strong> Armada</div>
                            <div class="stat-row">⏳ <strong>{{ $stats['active_rentals'] }}</strong> Aktif</div>
                            <div class="revenue">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- ===== TRANSAKSI TERBARU ===== -->
            <div class="section-card">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="section-title">Transaksi Terbaru</h3>
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
                        <p>Belum ada transaksi</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>