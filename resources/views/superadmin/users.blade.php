<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            👤 Kelola User
        </h2>
    </x-slot>

    <style>
        * {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .user-section {
            padding: 40px 0 60px;
            background: #f8f6f2;
            position: relative;
            min-height: 100vh;
        }

        .user-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
        }

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

        .alert-error {
            background: #fce8e8;
            border: 1px solid #d46a6a;
            color: #b04a4a;
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .table-card {
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15), 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e8e4de;
            transition: all 0.4s ease;
        }

        .table-card:hover {
            box-shadow: 0 20px 55px rgba(0, 0, 0, 0.22), 0 12px 35px rgba(0, 0, 0, 0.12);
            border-color: #43637E;
        }

        .table-wrap {
            overflow-x: auto;
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

        .table-wrap tbody .user-name {
            font-weight: 600;
            color: #2c3e50;
        }

        .table-wrap tbody .user-email {
            color: #43637E;
        }

        .table-wrap tbody .user-phone {
            font-family: monospace;
            font-size: 13px;
        }

        .table-wrap tbody .user-rental-count {
            font-weight: 600;
            color: #43637E;
        }

        /* ===== STATUS BADGE ===== */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-badge.active {
            background: #fdf6e8;
            color: #b08a3a;
        }

        .status-badge.active .dot {
            background: #b08a3a;
        }

        .status-badge.inactive {
            background: #e8f4ec;
            color: #4a7a5a;
        }

        .status-badge.inactive .dot {
            background: #4a7a5a;
        }

        .status-badge .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
        }

        /* ===== RENTAL DETAIL LIST ===== */
        .rental-list {
            margin-top: 4px;
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .rental-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: #7a8a9a;
            padding: 2px 0;
        }

        .rental-item .vehicle-icon {
            font-size: 14px;
        }

        .rental-item .vehicle-name {
            font-weight: 600;
            color: #43637E;
        }

        .rental-item .location {
            color: #9aabbb;
            font-size: 11px;
        }

        .rental-item .badge-count {
            font-size: 10px;
            background: rgba(67, 99, 126, 0.1);
            color: #43637E;
            padding: 0 8px;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-delete {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: transparent;
            color: #b04a4a;
            border: 1.5px solid #b04a4a;
            padding: 5px 14px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-delete:hover {
            background: #b04a4a;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(176, 74, 74, 0.25);
        }

        .btn-delete:disabled {
            opacity: 0.4;
            cursor: not-allowed;
            transform: none;
        }

        .btn-delete:disabled:hover {
            background: transparent;
            color: #b04a4a;
            transform: none;
            box-shadow: none;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #7a8a9a;
        }

        .empty-state .icon {
            font-size: 48px;
            display: block;
            margin-bottom: 12px;
        }

        .empty-state h4 {
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
        }

        .empty-state p {
            font-size: 14px;
            margin-top: 4px;
        }

        /* ===== DARK MODE ===== */
        .dark .user-section { background: #1a2632; }
        .dark .user-section::before { background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E); }
        .dark .alert-success { background: #1e3d2e; border-color: #4a7a5a; color: #8abd9a; }
        .dark .alert-error { background: #3d1e1e; border-color: #d46a6a; color: #d46a6a; }
        .dark .table-card { background: #1a2632; border-color: #2c3e50; box-shadow: 0 12px 40px rgba(0,0,0,0.4); }
        .dark .table-card:hover { border-color: #43637E; }
        .dark .table-wrap thead { background: #0f1a24; }
        .dark .table-wrap thead th { color: #f0e6d0; }
        .dark .table-wrap tbody td { color: #b0bec5; border-top-color: #2c3e50; }
        .dark .table-wrap tbody tr:hover { background: rgba(67,99,126,0.05); }
        .dark .table-wrap tbody .user-name { color: #f0ede8; }
        .dark .table-wrap tbody .user-email { color: #f0e6d0; }
        .dark .table-wrap tbody .user-rental-count { color: #f0e6d0; }
        .dark .status-badge.active { background: #3d3a1e; color: #d4b86a; }
        .dark .status-badge.inactive { background: #1e3d2e; color: #8abd9a; }
        .dark .rental-item { color: #b0bec5; }
        .dark .rental-item .vehicle-name { color: #f0e6d0; }
        .dark .rental-item .location { color: #5a6a7a; }
        .dark .rental-item .badge-count { background: rgba(67,99,126,0.2); color: #f0e6d0; }
        .dark .empty-state h4 { color: #f0ede8; }
        .dark .empty-state p { color: #b0bec5; }

        @media (max-width: 768px) {
            .table-wrap thead th, .table-wrap tbody td { padding: 10px 14px; font-size: 13px; }
            .btn-delete { font-size: 11px; padding: 4px 12px; }
            .status-badge { font-size: 11px; padding: 3px 12px; }
            .rental-item { font-size: 11px; flex-wrap: wrap; }
        }

        @media (max-width: 480px) {
            .user-section { padding: 24px 0 40px; }
            .table-wrap thead th, .table-wrap tbody td { padding: 8px 10px; font-size: 12px; }
            .table-wrap thead th { font-size: 10px; }
            .btn-delete { font-size: 10px; padding: 3px 10px; }
            .status-badge { font-size: 10px; padding: 2px 10px; }
            .rental-item { font-size: 10px; }
            .empty-state .icon { font-size: 36px; }
            .empty-state h4 { font-size: 16px; }
        }

        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #f0ede8; }
        ::-webkit-scrollbar-thumb { background: #43637E; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #36546b; }
        .dark ::-webkit-scrollbar-track { background: #1a2632; }
        .dark ::-webkit-scrollbar-thumb { background: #43637E; }
    </style>

    <div class="user-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="alert-success">✅ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert-error">❌ {{ session('error') }}</div>
            @endif

            <!-- ===== TABLE ===== -->
            <div class="table-card">
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No HP</th>
                                <th>Total Sewa</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td class="user-name">{{ $user->name }}</td>
                                    <td class="user-email">{{ $user->email }}</td>
                                    <td class="user-phone">{{ $user->phone ?? '-' }}</td>
                                    <td class="user-rental-count">{{ $user->total_rentals ?? 0 }} kali</td>
                                    <td>
                                        @if($user->has_active_rental ?? false)
                                            <span class="status-badge active">
                                                <span class="dot"></span> Sedang Menyewa 
                                                <span style="font-size:10px; background:rgba(176,138,58,0.15); padding:0 8px; border-radius:10px; margin-left:4px;">
                                                    {{ $user->active_rentals->count() }} kendaraan
                                                </span>
                                            </span>
                                            
                                            {{-- 🔥 TAMPILIN SEMUA KENDARAAN --}}
                                            <div class="rental-list">
                                                @foreach($user->active_rentals as $rental)
                                                    <div class="rental-item">
                                                        <span class="vehicle-icon">{{ $rental->vehicle->vehicle_type == 'car' ? '🚗' : '🏍️' }}</span>
                                                        <span class="vehicle-name">{{ $rental->vehicle->name ?? 'N/A' }}</span>
                                                        <span class="location">📍 {{ $rental->vehicle->location ?? 'N/A' }}</span>
                                                        @if($loop->count > 1)
                                                            <span class="badge-count">#{{ $loop->iteration }}</span>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="status-badge inactive">
                                                <span class="dot"></span> Tidak Menyewa
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('superadmin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus user {{ $user->name }}?')" style="margin:0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete" {{ ($user->has_active_rental ?? false) ? 'disabled' : '' }}>
                                                🗑️ Hapus
                                            </button>
                                        </form>
                                        @if($user->has_active_rental ?? false)
                                            <div style="font-size: 10px; color: #b04a4a; margin-top: 2px;">(sedang menyewa)</div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="empty-state">
                                            <span class="icon">👤</span>
                                            <h4>Belum Ada User</h4>
                                            <p>Belum ada user yang terdaftar</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>