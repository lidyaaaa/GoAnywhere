<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Kelola User
        </h2>
    </x-slot>

    <style>

        .user-section {
            padding: 40px 0 60px;
            background: #eef1f4;
            position: relative;
            min-height: 100vh;
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
            background: #eef1f4;
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
            gap: 6px;
            padding: 5px 12px;
            border-radius: 999px;
            font-size: 11.5px;
            font-weight: 700;
            white-space: nowrap;
            line-height: 1.2;
        }

        .status-badge.active {
            background: #fef3c7;
            color: #b45309;
            border: 1px solid #fde68a;
        }

        .status-badge.active .dot {
            background: #d97706;
        }

        .status-badge.inactive {
            background: #e8f4ec;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .status-badge.inactive .dot {
            background: #16a34a;
        }

        .status-badge.banned {
            background: #fce8e8;
            color: #b04a4a;
            border: 1px solid #f5c2c2;
        }

        .status-badge.banned .dot {
            background: #b04a4a;
        }

        .btn-ban {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
            padding: 7px 14px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 12px;
            white-space: nowrap;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-ban:hover {
            background: #e11d48;
            color: #ffffff;
            border-color: #e11d48;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(225, 29, 72, 0.25);
        }

        .btn-unban {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            background: #ecfdf5;
            color: #047857;
            border: 1px solid #a7f3d0;
            padding: 7px 14px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 12px;
            white-space: nowrap;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-unban:hover {
            background: #059669;
            color: #ffffff;
            border-color: #059669;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.25);
        }

        .status-badge .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            display: inline-block;
            flex-shrink: 0;
        }

        /* ===== RENTAL DETAIL LIST ===== */
        .rental-list {
            margin-top: 6px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .rental-item {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11.5px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 4px 10px;
            color: #475569;
            width: fit-content;
        }

        .rental-item .vehicle-type-tag {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 1px 6px;
            border-radius: 4px;
            background: #e0f2fe;
            color: #0369a1;
        }

        .rental-item .vehicle-name {
            font-weight: 700;
            color: #0f172a;
            white-space: nowrap;
        }

        .rental-item .location {
            color: #64748b;
            font-size: 11px;
            white-space: nowrap;
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

        /* ===== PAGINATION ===== */
        .pagination-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            margin-top: 20px;
            padding-bottom: 8px;
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

        /* ===== DARK MODE ===== */
        .dark .user-section { background: #1a2632; }
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
                <div class="alert-success">✓ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert-error">✕ {{ session('error') }}</div>
            @endif

            <!-- ===== TAB FILTER AKUN AKTIF / NONAKTIF ===== -->
            <div class="flex items-center gap-2 mb-5">
                <a href="{{ route('superadmin.users', ['status' => 'active']) }}" 
                   class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 {{ ($statusTab ?? 'active') === 'active' ? 'bg-[#004B87] text-white shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    Akun Aktif ({{ $activeCount ?? 0 }})
                </a>
                <a href="{{ route('superadmin.users', ['status' => 'inactive']) }}" 
                   class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 {{ ($statusTab ?? 'active') === 'inactive' ? 'bg-[#004B87] text-white shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
                    <span class="w-2 h-2 rounded-full bg-rose-400"></span>
                    Akun Nonaktif / Disband ({{ $inactiveCount ?? 0 }})
                </a>
                <a href="{{ route('superadmin.users', ['status' => 'all']) }}" 
                   class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 {{ ($statusTab ?? 'active') === 'all' ? 'bg-[#004B87] text-white shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
                    Semua ({{ $totalCount ?? 0 }})
                </a>
            </div>

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
                                <th>Status Sewa</th>
                                <th>Status Akun</th>
                                <th style="text-align: center;">Aksi</th>
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
                                                <span class="dot"></span>
                                                <span>Sedang Menyewa ({{ $user->active_rentals->count() }} unit)</span>
                                            </span>
                                            
                                            {{-- TAMPILIN SEMUA KENDARAAN --}}
                                            <div class="rental-list">
                                                @foreach($user->active_rentals as $rental)
                                                    <div class="rental-item">
                                                        <span class="vehicle-type-tag">{{ $rental->vehicle->vehicle_type == 'car' ? 'Mobil' : 'Motor' }}</span>
                                                        <span class="vehicle-name">{{ $rental->vehicle->name ?? 'N/A' }}</span>
                                                        <span class="location">• 📍 {{ $rental->vehicle->location ?? 'N/A' }}</span>
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
                                        @if($user->suspended_at)
                                            <span class="status-badge banned" title="Nonaktif sejak: {{ $user->suspended_at }}">
                                                <span class="dot"></span> Nonaktif (Disband)
                                            </span>
                                            @if($user->suspended_reason)
                                                <div style="font-size: 11px; color: #b04a4a; margin-top: 4px; max-width: 220px; font-weight: 500;">
                                                    <strong>Alasan:</strong> {{ $user->suspended_reason }}
                                                </div>
                                            @endif
                                        @else
                                            <span class="status-badge inactive">
                                                <span class="dot"></span> Aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td style="text-align: center;">
                                        @if($user->suspended_at)
                                            <form action="{{ route('superadmin.users.toggle-ban', $user->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Aktifkan kembali akun user {{ $user->name }}?')">
                                                @csrf
                                                <button type="submit" class="btn-unban">
                                                    <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    <span>Aktifkan Akun</span>
                                                </button>
                                            </form>
                                        @else
                                            <button type="button" class="btn-ban" onclick="openDisbandModal('{{ $user->id }}', '{{ addslashes($user->name) }}')">
                                                <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                                </svg>
                                                <span>Disband Akun</span>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="empty-state">
                                            <span class="icon"></span>
                                            <h4>Belum Ada User</h4>
                                            <p>Belum ada user yang terdaftar</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($users->hasPages())
                    <div class="pagination-wrapper">
                        <div class="info-text">
                            Menampilkan <strong>{{ $users->firstItem() ?? 0 }}</strong> - <strong>{{ $users->lastItem() ?? 0 }}</strong> dari <strong>{{ $users->total() }}</strong> user
                        </div>
                        <div>
                            {{ $users->links() }}
                        </div>
                    </div>
                @endif

                </div>
            </div>

        </div>
    </div>

    <!-- ===== MODAL ALASAN DISBAND AKUN ===== -->
    <div id="modalDisband" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div class="bg-white dark:bg-slate-900 rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-200 dark:border-slate-800">
            <h3 class="text-lg font-bold text-rose-700 mb-1 flex items-center gap-2">
                <span>🚫</span> Disband Akun User
            </h3>
            <p id="disbandUserName" class="text-xs text-slate-500 mb-4">Pengguna ini akan dinonaktifkan dan tidak bisa login ke aplikasi.</p>

            <form id="formDisband" method="POST" action="">
                @csrf
                <div class="mb-4">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                        Alasan Disband Akun (Wajib Diisi)
                    </label>
                    <textarea name="reason" rows="3" required placeholder="Contoh: Terbukti melanggar syarat rental, keterlambatan kronis, atau data profil palsu." class="w-full rounded-xl border border-slate-300 dark:border-slate-700 p-3 text-xs bg-slate-50 dark:bg-slate-800 text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-rose-500 focus:outline-none"></textarea>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeDisbandModal()" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold text-white bg-rose-600 hover:bg-rose-700 shadow-sm">
                        Konfirmasi Disband
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openDisbandModal(userId, userName) {
            const modal = document.getElementById('modalDisband');
            const form = document.getElementById('formDisband');
            const nameEl = document.getElementById('disbandUserName');
            
            form.action = "{{ url('superadmin/users') }}/" + userId + "/toggle-ban";
            nameEl.textContent = "Masukkan alasan penonaktifan akun untuk " + userName + ":";
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDisbandModal() {
            const modal = document.getElementById('modalDisband');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</x-app-layout>