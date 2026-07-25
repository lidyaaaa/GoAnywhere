<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Sewa Saya
        </h2>
    </x-slot>

    <!-- ============================================ -->
    <!-- STYLE ELEGAN - #43637E + SHADOW HITAM TEBEL -->
    <!-- ============================================ -->
    <style>
        * {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sewa-section {
            padding: 40px 0 60px;
            background: #f8f6f2;
            position: relative;
            min-height: 100vh;
        }

        .sewa-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
        }

        /* ===== ALERT ===== */
        .alert-success {
            background: #e8f4ec;
            border: 1px solid #4a7a5a;
            color: #4a7a5a;
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-warning {
            background: #fdf6e8;
            border: 1px solid #b08a3a;
            color: #b08a3a;
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* ===== STATISTIK ===== */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 28px 20px;
            text-align: center;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2), 0 4px 20px rgba(0, 0, 0, 0.1);
            border: 1px solid #e8e4de;
            transition: all 0.4s ease;
        }

        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3), 0 12px 40px rgba(0, 0, 0, 0.15);
            border-color: #43637E;
        }

        .stat-card .number {
            font-size: 36px;
            font-weight: 700;
            font-family: 'Georgia', serif;
        }

        .stat-card .number.blue {
            color: #43637E;
        }

        .stat-card .number.green {
            color: #4a7a5a;
        }

        .stat-card .number.purple {
            color: #7a5a8a;
        }

        .stat-card .label {
            font-size: 14px;
            color: #7a8a9a;
            font-weight: 500;
            margin-top: 4px;
            letter-spacing: 0.5px;
        }

        /* ===== SECTION TITLE ===== */
        .section-title {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
            margin-bottom: 16px;
        }

        .section-title .icon {
            margin-right: 8px;
        }

        /* ===== PENDING PICKUP ===== */
        .pending-box {
            background: #ffffff;
            border-radius: 16px;
            padding: 20px 24px;
            margin-bottom: 32px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2), 0 4px 20px rgba(0, 0, 0, 0.1);
            border: 1px solid #e8e4de;
            border-left: 5px solid #b08a3a;
            transition: all 0.4s ease;
        }

        .pending-box:hover {
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3), 0 12px 40px rgba(0, 0, 0, 0.15);
            border-color: #43637E;
        }

        .pending-box .pending-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }

        .pending-box .pending-header .icon {
            font-size: 24px;
        }

        .pending-box .pending-header h3 {
            font-size: 18px;
            font-weight: 700;
            color: #b08a3a;
            font-family: 'Georgia', serif;
        }

        .pending-item {
            background: #faf8f5;
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 10px;
            border: 1px solid #f0ede8;
            transition: all 0.3s ease;
        }

        .pending-item:last-child {
            margin-bottom: 0;
        }

        .pending-item:hover {
            border-color: #b08a3a;
            background: #fdf8f0;
        }

        .pending-item .pending-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .pending-item .pending-content .vehicle-info {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px 16px;
        }

        .pending-item .pending-content .vehicle-info .name {
            font-weight: 700;
            color: #2c3e50;
            font-size: 15px;
        }

        .pending-item .pending-content .vehicle-info .location {
            font-size: 13px;
            color: #7a8a9a;
        }

        .pending-item .pending-content .vehicle-info .price {
            font-weight: 700;
            color: #b08a3a;
            font-size: 15px;
        }

        .pending-item .pending-content .btn-pickup {
            background: #43637E;
            color: #ffffff;
            padding: 8px 24px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(67, 99, 126, 0.3);
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .pending-item .pending-content .btn-pickup:hover {
            background: #36546b;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(67, 99, 126, 0.4);
        }

        .pending-item .pending-meta {
            font-size: 12px;
            color: #9aabbb;
            margin-top: 6px;
        }

        .pending-item .pending-meta strong {
            color: #43637E;
        }

        /* ===== RENTAL CARD ===== */
        .rental-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 24px 28px;
            margin-bottom: 16px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2), 0 4px 20px rgba(0, 0, 0, 0.1);
            border: 1px solid #e8e4de;
            transition: all 0.4s ease;
        }

        .rental-card:hover {
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3), 0 12px 40px rgba(0, 0, 0, 0.15);
            border-color: #43637E;
        }

        .rental-card .rental-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        .rental-card .rental-left {
            flex: 1;
        }

        .rental-card .rental-left .vehicle-name {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .rental-card .rental-left .vehicle-name .icon {
            font-size: 28px;
        }

        .rental-card .rental-left .vehicle-name h4 {
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
        }

        .rental-card .rental-left .detail-row {
            font-size: 14px;
            color: #7a8a9a;
            margin-top: 4px;
            display: flex;
            flex-wrap: wrap;
            gap: 4px 16px;
        }

        .rental-card .rental-left .status-badge {
            display: inline-block;
            padding: 4px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-top: 6px;
        }

        .rental-card .rental-left .status-badge.green {
            background: #e8f4ec;
            color: #4a7a5a;
        }

        .rental-card .rental-left .status-badge.yellow {
            background: #fdf6e8;
            color: #b08a3a;
        }

        .rental-card .rental-left .status-badge.red {
            background: #fce8e8;
            color: #b04a4a;
        }

        .rental-card .rental-right {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .rental-card .rental-right .btn-return {
            background: #4a7a5a;
            color: #ffffff;
            padding: 10px 32px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 14px;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(74, 122, 90, 0.35);
            letter-spacing: 0.5px;
        }

        .rental-card .rental-right .btn-return:hover {
            background: #3a6a4a;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(74, 122, 90, 0.45);
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            background: #ffffff;
            border-radius: 16px;
            padding: 40px 20px;
            text-align: center;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
            border: 1px solid #e8e4de;
        }

        .empty-state .icon {
            font-size: 48px;
            margin-bottom: 12px;
            display: block;
        }

        .empty-state p {
            color: #7a8a9a;
            font-size: 15px;
        }

        /* ===== TABLE ===== */
        .table-wrap {
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2), 0 4px 20px rgba(0, 0, 0, 0.1);
            border: 1px solid #e8e4de;
            transition: all 0.4s ease;
        }

        .table-wrap:hover {
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3), 0 12px 40px rgba(0, 0, 0, 0.15);
            border-color: #43637E;
        }

        .table-wrap table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-wrap thead {
            background: #f8f6f2;
        }

        .table-wrap thead th {
            padding: 14px 20px;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            color: #43637E;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table-wrap tbody td {
            padding: 14px 20px;
            font-size: 14px;
            color: #5a6a7a;
            border-top: 1px solid #f0ede8;
        }

        .table-wrap tbody tr:hover {
            background: rgba(67, 99, 126, 0.03);
        }

        .table-wrap tbody td .status-badge-sm {
            display: inline-block;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .table-wrap tbody td .status-badge-sm.completed {
            background: #e8f4ec;
            color: #4a7a5a;
        }

        .table-wrap tbody td .status-badge-sm.cancelled {
            background: #fce8e8;
            color: #b04a4a;
        }

        .table-wrap tbody td .booking-code {
            font-weight: 600;
            color: #43637E;
            font-family: monospace;
            font-size: 13px;
        }

        .table-wrap tbody td .fine-amount {
            color: #b04a4a;
            font-weight: 600;
        }

        .table-wrap tbody td .fine-amount.none {
            color: #4a7a5a;
            font-weight: 400;
        }

        /* ===== PAGINATION ===== */
        .pagination-wrapper {
            margin-top: 16px;
        }

        .pagination-wrapper nav {
            display: flex;
            gap: 6px;
            align-items: center;
            justify-content: center;
        }

        .pagination-wrapper nav .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 14px;
            border-radius: 10px;
            background: #ffffff;
            color: #2c3e50;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            border: 1.5px solid #e8e4de;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .pagination-wrapper nav .page-link:hover {
            background: #43637E;
            color: #ffffff;
            border-color: #43637E;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(67, 99, 126, 0.3);
        }

        .pagination-wrapper nav .page-link.active {
            background: #43637E;
            color: #ffffff;
            border-color: #43637E;
            box-shadow: 0 8px 25px rgba(67, 99, 126, 0.35);
        }

        .pagination-wrapper nav .page-link.disabled {
            opacity: 0.4;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* ===== DARK MODE ===== */
        .dark .sewa-section {
            background: #1a2632;
        }

        .dark .sewa-section::before {
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
        }

        .dark .alert-success {
            background: #1e3d2e;
            border-color: #4a7a5a;
            color: #8abd9a;
        }

        .dark .alert-warning {
            background: #3d3a1e;
            border-color: #b08a3a;
            color: #d4b86a;
        }

        .dark .stat-card {
            background: #1a2632;
            border-color: #2c3e50;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.5), 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .dark .stat-card:hover {
            border-color: #43637E;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6), 0 12px 40px rgba(0, 0, 0, 0.4);
        }

        .dark .stat-card .label {
            color: #b0bec5;
        }

        .dark .section-title {
            color: #f0ede8;
        }

        .dark .pending-box {
            background: #1a2632;
            border-color: #2c3e50;
            border-left-color: #b08a3a;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.5), 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .dark .pending-box:hover {
            border-color: #43637E;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6), 0 12px 40px rgba(0, 0, 0, 0.4);
        }

        .dark .pending-box .pending-header h3 {
            color: #d4b86a;
        }

        .dark .pending-item {
            background: #0f1a24;
            border-color: #2c3e50;
        }

        .dark .pending-item:hover {
            border-color: #b08a3a;
            background: #1a2632;
        }

        .dark .pending-item .pending-content .vehicle-info .name {
            color: #f0ede8;
        }

        .dark .pending-item .pending-content .vehicle-info .location {
            color: #b0bec5;
        }

        .dark .pending-item .pending-meta {
            color: #5a6a7a;
        }

        .dark .pending-item .pending-meta strong {
            color: #f0e6d0;
        }

        .dark .rental-card {
            background: #1a2632;
            border-color: #2c3e50;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.5), 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .dark .rental-card:hover {
            border-color: #43637E;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6), 0 12px 40px rgba(0, 0, 0, 0.4);
        }

        .dark .rental-card .rental-left .vehicle-name h4 {
            color: #f0ede8;
        }

        .dark .rental-card .rental-left .detail-row {
            color: #b0bec5;
        }

        .dark .rental-card .rental-left .status-badge.green {
            background: #1e3d2e;
            color: #8abd9a;
        }

        .dark .rental-card .rental-left .status-badge.yellow {
            background: #3d3a1e;
            color: #d4b86a;
        }

        .dark .rental-card .rental-left .status-badge.red {
            background: #3d1e1e;
            color: #d46a6a;
        }

        .dark .empty-state {
            background: #1a2632;
            border-color: #2c3e50;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
        }

        .dark .empty-state p {
            color: #b0bec5;
        }

        .dark .table-wrap {
            background: #1a2632;
            border-color: #2c3e50;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.5), 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .dark .table-wrap:hover {
            border-color: #43637E;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6), 0 12px 40px rgba(0, 0, 0, 0.4);
        }

        .dark .table-wrap thead {
            background: #0f1a24;
        }

        .dark .table-wrap thead th {
            color: #f0e6d0;
        }

        .dark .table-wrap tbody td {
            color: #b0bec5;
            border-top-color: #2c3e50;
        }

        .dark .table-wrap tbody tr:hover {
            background: rgba(67, 99, 126, 0.08);
        }

        .dark .table-wrap tbody td .booking-code {
            color: #f0e6d0;
        }

        .dark .table-wrap tbody td .status-badge-sm.completed {
            background: #1e3d2e;
            color: #8abd9a;
        }

        .dark .table-wrap tbody td .status-badge-sm.cancelled {
            background: #3d1e1e;
            color: #d46a6a;
        }

        .dark .pagination-wrapper nav .page-link {
            background: #1a2632;
            color: #f0ede8;
            border-color: #2c3e50;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .dark .pagination-wrapper nav .page-link:hover {
            background: #43637E;
            color: #ffffff;
            border-color: #43637E;
        }

        .dark .pagination-wrapper nav .page-link.active {
            background: #43637E;
            color: #ffffff;
            border-color: #43637E;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .stat-grid {
                grid-template-columns: 1fr 1fr;
                gap: 16px;
            }

            .stat-card .number {
                font-size: 28px;
            }

            .rental-card {
                padding: 18px 20px;
            }

            .rental-card .rental-content {
                flex-direction: column;
                align-items: stretch;
            }

            .rental-card .rental-right {
                flex-direction: row;
                margin-top: 8px;
            }

            .rental-card .rental-right .btn-return {
                flex: 1;
                text-align: center;
                padding: 10px 20px;
            }

            .pending-item .pending-content {
                flex-direction: column;
                align-items: stretch;
            }

            .pending-item .pending-content .btn-pickup {
                text-align: center;
            }

            .table-wrap {
                overflow-x: auto;
            }

            .table-wrap table {
                min-width: 600px;
            }

            .section-title {
                font-size: 20px;
            }
        }

        @media (max-width: 480px) {
            .sewa-section {
                padding: 24px 0 40px;
            }

            .stat-grid {
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }

            .stat-card {
                padding: 18px 12px;
            }

            .stat-card .number {
                font-size: 22px;
            }

            .stat-card .label {
                font-size: 12px;
            }

            .pending-box {
                padding: 14px 16px;
            }

            .pending-item {
                padding: 12px 14px;
            }

            .pending-item .pending-content .vehicle-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 4px;
            }

            .rental-card {
                padding: 14px 16px;
            }

            .rental-card .rental-left .vehicle-name h4 {
                font-size: 16px;
            }

            .rental-card .rental-left .detail-row {
                font-size: 13px;
                flex-direction: column;
                gap: 2px;
            }

            .rental-card .rental-right .btn-return {
                font-size: 12px;
                padding: 8px 16px;
            }

            .section-title {
                font-size: 18px;
            }

            .table-wrap tbody td,
            .table-wrap thead th {
                padding: 10px 14px;
                font-size: 12px;
            }
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f0ede8;
        }

        ::-webkit-scrollbar-thumb {
            background: #43637E;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #36546b;
        }

        .dark ::-webkit-scrollbar-track {
            background: #1a2632;
        }

        .dark ::-webkit-scrollbar-thumb {
            background: #43637E;
        }
    </style>

    <!-- ============================================ -->
    <!-- SEWA SECTION                                -->
    <!-- ============================================ -->
    <div class="sewa-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- ===== ALERT ===== -->
            @if(session('success'))
                <div class="alert-success">
                     {{ session('success') }}
                </div>
            @endif
            @if(session('warning'))
                <div class="alert-warning">
                     {{ session('warning') }}
                </div>
            @endif

            <!-- ===== STATISTIK ===== -->
            <div class="stat-grid">
                <div class="stat-card">
                    <div class="number blue">{{ $totalRentals }}</div>
                    <div class="label">Total Sewa</div>
                </div>
                <div class="stat-card">
                    <div class="number green">{{ count($activeRentals) }}</div>
                    <div class="label">Sewa Aktif</div>
                </div>
                <div class="stat-card">
                    <div class="number purple">Rp {{ number_format($totalSpent, 0, ',', '.') }}</div>
                    <div class="label">Total Belanja</div>
                </div>
            </div>

            <!-- ===== KENDARAAN BELUM DIAMBIL ===== -->
            @if(count($pendingPickup) > 0)
                <div class="pending-box">
                    <div class="pending-header">
                         <span class="icon"></span>
                        <h3>Kendaraan Dalam Pengantaran</h3>
                    </div>
                    @foreach($pendingPickup as $item)
                        <div class="pending-item">
                            <div class="pending-content">
                                <div class="vehicle-info">
                                    <span class="name">{{ $item->vehicle->name }}</span>
                                    <span class="location">                                     <span class="location">{{ $item->vehicle->location }}</span></span>
                                    <span class="price">                                     <span class="price">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span></span>
                                </div>
                                <a href="{{ route('user.payment.success', $item->booking_code) }}" class="btn-pickup">
                                    Konfirmasi Penerimaan
                                </a>
                            </div>
                            <div class="pending-meta">
                                Kode Booking: <strong>{{ $item->booking_code }}</strong> &nbsp;|&nbsp;
                                Estimasi Pengantaran: <strong>{{ \Carbon\Carbon::parse($item->payment_deadline)->format('d M Y H:i') }}</strong>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- ===== SEWA AKTIF ===== -->
                    <h3 class="section-title"><span class="icon"></span> Sewa Aktif</h3>

            @if(count($activeRentals) > 0)
                @foreach($activeRentals as $rental)
                    @php
                        $endDate = \Carbon\Carbon::parse($rental->rental_end_date);
                        $now = now();
                        if ($now->lt($endDate)) {
                            $diffInMinutes = $now->diffInMinutes($endDate);
                            $days = floor($diffInMinutes / 1440);
                            $hours = floor(($diffInMinutes % 1440) / 60);
                            $minutes = $diffInMinutes % 60;
                            $statusClass = $diffInMinutes > 1440 ? 'green' : 'yellow';
                            $parts = [];
                            if ($days > 0) $parts[] = $days . ' hari';
                            if ($hours > 0) $parts[] = $hours . ' jam';
                            if ($minutes > 0 || empty($parts)) $parts[] = $minutes . ' menit';
                            $statusText = 'Sisa ' . implode(' ', $parts);
                        } else {
                            $diffInMinutes = $endDate->diffInMinutes($now);
                            $days = floor($diffInMinutes / 1440);
                            $hours = floor(($diffInMinutes % 1440) / 60);
                            $minutes = $diffInMinutes % 60;
                            $statusClass = 'red';
                            $parts = [];
                            if ($days > 0) $parts[] = $days . ' hari';
                            if ($hours > 0) $parts[] = $hours . ' jam';
                            if ($minutes > 0 || empty($parts)) $parts[] = $minutes . ' menit';
                            $statusText = 'Telat ' . implode(' ', $parts);
                        }
                    @endphp

                    <div class="rental-card">
                        <div class="rental-content">
                            <div class="rental-left">
                                <div class="vehicle-name">
                                     <span class="icon">{{ $rental->vehicle->vehicle_type == 'car' ? 'Car' : 'Motorcycle' }}</span>
                                    <h4>{{ $rental->vehicle->name }}</h4>
                                </div>
                                <div class="detail-row">
                                     <span>{{ \Carbon\Carbon::parse($rental->rental_start_date)->format('d M Y') }} - {{ \Carbon\Carbon::parse($rental->rental_end_date)->format('d M Y') }}</span>
                                </div>
                                <div class="detail-row">
                                     <span>Wajib kembali: {{ \Carbon\Carbon::parse($rental->rental_end_date)->format('d M Y H:i') }}</span>
                                </div>
                                <div class="detail-row">
                                     <span>Batas Akhir Pengembalian: {{ \Carbon\Carbon::parse($rental->rental_end_date)->addMinutes(30)->format('d M Y H:i') }}</span>
                                </div>
                                <div class="detail-row">
                                     <span>Denda telat: Rp 50.000/jam</span>
                                </div>
                                <span class="status-badge {{ $statusClass }}">{{ $statusText }}</span>
                            </div>
                            <div class="rental-right">
                                <a href="{{ route('user.rental.return', $rental->id) }}" class="btn-return">
                                    Kembalikan
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                            <span class="icon"></span>
                    <p>Tidak ada sewa aktif</p>
                </div>
            @endif

            <!-- ===== RIWAYAT ===== -->
                    <h3 class="section-title" style="margin-top: 40px;"><span class="icon"></span> Riwayat Transaksi</h3>

            @if(count($history) > 0)
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Kendaraan</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Denda</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($history as $item)
                                <tr>
                                    <td><span class="booking-code">{{ $item->booking_code }}</span></td>
                                    <td>{{ $item->vehicle->name ?? 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                                    <td style="font-weight: 600; color: #43637E;">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    <td>
                                        @if($item->fine_amount > 0)
                                            <span class="fine-amount">Rp {{ number_format($item->fine_amount, 0, ',', '.') }}</span>
                                        @else
                                            <span class="fine-amount none">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->status == 'completed')
                                            <span class="status-badge-sm completed">Selesai</span>
                                        @else
                                            <span class="status-badge-sm cancelled">Batal</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination-wrapper">
                    {{ $history->links() }}
                </div>
            @else
                <div class="empty-state">
                        <span class="icon"></span>
                    <p>Belum ada riwayat transaksi</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>