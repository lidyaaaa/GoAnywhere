<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Transaksi - {{ Auth::user()->location }}
        </h2>
    </x-slot>

    <style>
        * {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .transaksi-section {
            padding: 40px 0 60px;
            background: #eef1f4;
            position: relative;
            min-height: 100vh;
        }

        .section-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 24px 28px;
            margin-bottom: 24px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15), 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e8e4de;
            transition: all 0.4s ease;
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
            margin-bottom: 16px;
        }

        .section-card .section-title .icon {
            margin-right: 8px;
        }

        .table-wrap {
            overflow-x: auto;
        }

        .table-wrap table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-wrap thead {
            background: #eef1f4;
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

        .table-wrap tbody .status-badge {
            display: inline-block;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .table-wrap tbody .status-badge.active {
            background: #e8f4ec;
            color: #4a7a5a;
        }

        .table-wrap tbody .status-badge.warning {
            background: #fdf6e8;
            color: #b08a3a;
        }

        .table-wrap tbody .status-badge.danger {
            background: #fce8e8;
            color: #b04a4a;
        }

        .table-wrap tbody .status-badge.completed {
            background: #e8f4ec;
            color: #4a7a5a;
        }

        .approve-btn {
            border: 0;
            border-radius: 8px;
            padding: 8px 14px;
            background: #43637E;
            color: #ffffff;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
        }

        .approve-btn:hover {
            background: #36546b;
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

        /* ===== PAGINATION ===== */
        .pagination-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            margin-top: 16px;
        }

        .pagination-wrapper .info-text {
            font-size: 14px;
            color: #7a8a9a;
            font-weight: 300;
        }

        .pagination-wrapper .info-text strong {
            color: #43637E;
            font-weight: 600;
        }

        .pagination-wrapper nav {
            display: flex;
            gap: 6px;
            align-items: center;
            flex-wrap: wrap;
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
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .pagination-wrapper nav .page-link:hover {
            background: #43637E;
            color: #ffffff;
            border-color: #43637E;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(67, 99, 126, 0.25);
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
        .dark .transaksi-section { background: #1a2632; }
        .dark .section-card { background: #1a2632; border-color: #2c3e50; box-shadow: 0 12px 40px rgba(0,0,0,0.4); }
        .dark .section-card:hover { border-color: #43637E; }
        .dark .section-card .section-title { color: #f0ede8; }
        .dark .table-wrap thead { background: #0f1a24; }
        .dark .table-wrap thead th { color: #f0e6d0; }
        .dark .table-wrap tbody td { color: #b0bec5; border-top-color: #2c3e50; }
        .dark .table-wrap tbody tr:hover { background: rgba(67,99,126,0.05); }
        .dark .table-wrap tbody .vehicle-name { color: #f0ede8; }
        .dark .table-wrap tbody .booking-code { color: #f0e6d0; }
        .dark .empty-state { color: #b0bec5; }
        .dark .pagination-wrapper .info-text { color: #b0bec5; }
        .dark .pagination-wrapper .info-text strong { color: #f0e6d0; }
        .dark .pagination-wrapper nav .page-link { background: #1a2632; color: #f0ede8; border-color: #2c3e50; box-shadow: 0 2px 8px rgba(0,0,0,0.2); }
        .dark .pagination-wrapper nav .page-link:hover { background: #43637E; color: #ffffff; border-color: #43637E; }
        .dark .pagination-wrapper nav .page-link.active { background: #43637E; color: #ffffff; border-color: #43637E; }

        @media (max-width: 768px) {
            .section-card { padding: 18px 16px; }
            .table-wrap thead th, .table-wrap tbody td { padding: 10px 12px; font-size: 12px; }
            .pagination-wrapper nav .page-link { min-width: 36px; height: 36px; font-size: 13px; padding: 0 10px; }
        }

        @media (max-width: 480px) {
            .transaksi-section { padding: 24px 0 40px; }
            .section-card { padding: 14px 12px; }
            .table-wrap thead th, .table-wrap tbody td { padding: 8px 8px; font-size: 11px; }
            .table-wrap tbody .status-badge { font-size: 10px; padding: 2px 10px; }
            .pagination-wrapper nav .page-link { min-width: 32px; height: 32px; font-size: 12px; padding: 0 8px; border-radius: 8px; }
            .pagination-wrapper .info-text { font-size: 12px; }
        }

        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #f0ede8; }
        ::-webkit-scrollbar-thumb { background: #43637E; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #36546b; }
        .dark ::-webkit-scrollbar-track { background: #1a2632; }
        .dark ::-webkit-scrollbar-thumb { background: #43637E; }
    </style>

    <div class="transaksi-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- ===== MENUNGGU PERSETUJUAN ===== -->
            <div class="section-card">
                <h3 class="section-title"><span class="icon"></span> Menunggu Persetujuan</h3>

                @if(count($pendingApprovals) > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Kendaraan</th>
                                    <th>Penyewa</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingApprovals as $item)
                                    <tr>
                                        <td><span class="booking-code">{{ $item->booking_code ?? 'N/A' }}</span></td>
                                        <td class="vehicle-name">{{ $item->vehicle->name ?? 'N/A' }}</td>
                                        <td>{{ $item->user->name ?? 'N/A' }}</td>
                                        <td>Rp {{ number_format($item->subtotal ?? 0, 0, ',', '.') }}</td>
                                        <td>
                                            <div style="display:flex; align-items:center; gap:8px;">
                                                <form action="{{ route('manager.rentals.approve', $item->booking_code) }}" method="POST" style="margin:0;">
                                                    @csrf
                                                    <button type="submit" class="approve-btn" onclick="return confirm('Setujui booking ini?')">Setujui Booking</button>
                                                </form>
                                                <a href="{{ route('manager.chat.start', ['user_id' => $item->user_id, 'vehicle_id' => $item->vehicle_id]) }}" 
                                                   style="display:inline-flex; align-items:center; gap:6px; padding:7px 12px; background:#43637E; color:#ffffff; border-radius:8px; font-size:12px; font-weight:600; text-decoration:none; transition:all 0.2s ease; border:1px solid #43637E;"
                                                   title="Chat dengan {{ $item->user->name ?? 'Penyewa' }}">
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                                    </svg>
                                                    <span>Chat</span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <span class="icon"></span>
                        <p>Tidak ada transaksi yang menunggu persetujuan</p>
                    </div>
                @endif
            </div>

            <!-- ===== SEWA AKTIF ===== -->
            @include('manager.partials.active-rentals')

            <!-- ===== RIWAYAT TRANSAKSI ===== -->
            <div class="section-card">
                    <h3 class="section-title"><span class="icon"></span> Riwayat Transaksi</h3>

                @if(count($history) > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Kendaraan</th>
                                    <th>Penyewa</th>
                                    <th>Durasi</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($history as $item)
                                    <tr>
                                        <td><span class="booking-code">{{ $item->booking_code ?? 'N/A' }}</span></td>
                                        <td class="vehicle-name">{{ $item->vehicle->name ?? 'N/A' }}</td>
                                        <td>{{ $item->user->name ?? 'N/A' }}</td>
                                        <td>{{ $item->quantity }} hari</td>
                                        <td style="font-weight: 600; color: #43637E;">Rp {{ number_format($item->subtotal ?? 0, 0, ',', '.') }}</td>
                                        <td>
                                            @if($item->status == 'completed')
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

                    <div class="pagination-wrapper">
                        <div class="info-text">
                            Menampilkan <strong>{{ $history->firstItem() ?? 0 }}</strong> - <strong>{{ $history->lastItem() ?? 0 }}</strong> dari <strong>{{ $history->total() }}</strong> transaksi
                        </div>
                        <div>
                            {{ $history->links() }}
                        </div>
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
