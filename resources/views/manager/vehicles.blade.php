<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Kelola Armada - {{ Auth::user()->location }}
        </h2>
    </x-slot>

    <style>
        * {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .armada-section {
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

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .header-actions .title {
            font-size: 22px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
        }

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #43637E;
            color: #ffffff;
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(67, 99, 126, 0.3);
        }

        .btn-add:hover {
            background: #36546b;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(67, 99, 126, 0.4);
        }

        .vehicle-card {
            background: #ffffff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12), 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid #e8e4de;
            transition: all 0.4s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .vehicle-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 45px rgba(0, 0, 0, 0.18), 0 6px 20px rgba(0, 0, 0, 0.08);
            border-color: #43637E;
        }

        .vehicle-card .image-wrap {
            height: 180px;
            background: linear-gradient(135deg, #e8e4de, #d5d0c8);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
            flex-shrink: 0;
        }

        .vehicle-card .image-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .vehicle-card .image-wrap .placeholder {
            font-size: 56px;
            opacity: 0.6;
        }

        .vehicle-card .image-wrap .stock-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 4px 14px;
            border-radius: 14px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .vehicle-card .image-wrap .stock-badge.available {
            background: rgba(74, 122, 90, 0.85);
            color: #ffffff;
        }

        .vehicle-card .image-wrap .stock-badge.empty {
            background: rgba(176, 74, 74, 0.85);
            color: #ffffff;
        }

        .vehicle-card .body {
            padding: 14px 16px 16px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .vehicle-card .body .name {
            font-size: 17px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
        }

        .vehicle-card .body .specs {
            font-size: 13px;
            color: #7a8a9a;
            margin-top: 2px;
        }

        .vehicle-card .body .price {
            font-size: 19px;
            font-weight: 700;
            color: #43637E;
            margin-top: 4px;
            font-family: 'Georgia', serif;
        }

        .vehicle-card .body .price small {
            font-size: 12px;
            font-weight: 400;
            color: #9aabbb;
        }

        .vehicle-card .body .stock-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            color: #7a8a9a;
            margin-top: 6px;
            padding-top: 6px;
            border-top: 1px solid #f0ede8;
        }

        .vehicle-card .body .stock-info .status-text {
            font-weight: 600;
        }

        .vehicle-card .body .stock-info .status-text.available {
            color: #4a7a5a;
        }

        .vehicle-card .body .stock-info .status-text.empty {
            color: #b04a4a;
        }

        .vehicle-card .body .actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-top: 10px;
        }

        .vehicle-card .body .actions .btn-edit {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            background: #004B87 !important;
            color: #ffffff !important;
            padding: 8px 12px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 13px;
            text-decoration: none;
            transition: all 0.2s ease;
            box-shadow: 0 2px 6px rgba(0, 75, 135, 0.2);
        }

        .vehicle-card .body .actions .btn-edit:hover {
            background: #002D55 !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 75, 135, 0.3);
        }

        .vehicle-card .body .actions .btn-delete {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            background: #fff1f2 !important;
            color: #e11d48 !important;
            border: 1px solid #fecdd3 !important;
            padding: 8px 12px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s ease;
            width: 100%;
        }

        .vehicle-card .body .actions .btn-delete:hover {
            background: #e11d48 !important;
            color: #ffffff !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(225, 29, 72, 0.25);
        }

        .vehicle-card .body .add-stock-form {
            display: flex;
            gap: 6px;
            margin-top: 8px;
            padding-top: 8px;
            border-top: 1px solid #f0ede8;
            align-items: center;
        }

        .vehicle-card .body .add-stock-form input {
            flex: 1;
            padding: 5px 10px;
            border-radius: 6px;
            border: 1.5px solid #e8e4de;
            font-size: 12px;
            background: #faf8f5;
            transition: all 0.3s ease;
            color: #2c3e50;
            min-width: 50px;
            height: 30px;
        }

        .vehicle-card .body .add-stock-form input:focus {
            border-color: #43637E;
            box-shadow: 0 0 0 3px rgba(67, 99, 126, 0.1);
            outline: none;
        }

        .vehicle-card .body .add-stock-form input::placeholder {
            color: #b0a8a0;
            font-size: 11px;
        }

        .vehicle-card .body .add-stock-form .btn-stock {
            display: flex;
            align-items: center;
            gap: 3px;
            background: #4a7a5a;
            color: #ffffff;
            padding: 5px 16px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 12px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(74, 122, 90, 0.2);
            white-space: nowrap;
            height: 30px;
        }

        .vehicle-card .body .add-stock-form .btn-stock:hover {
            background: #3a6a4a;
            transform: translateY(-2px);
        }

        .empty-state {
            background: #ffffff;
            border-radius: 20px;
            padding: 60px 20px;
            text-align: center;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.15);
            border: 1px solid #e8e4de;
        }

        .empty-state .icon {
            font-size: 64px;
            display: block;
            margin-bottom: 12px;
        }

        .empty-state h3 {
            font-size: 22px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
        }

        .empty-state p {
            color: #7a8a9a;
            margin-top: 4px;
        }

        .empty-state .btn-add-first {
            display: inline-block;
            margin-top: 16px;
            background: #43637E;
            color: #ffffff;
            padding: 12px 32px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 15px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(67, 99, 126, 0.3);
        }

        .empty-state .btn-add-first:hover {
            background: #36546b;
            transform: translateY(-3px);
        }

        .pagination-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            margin-top: 32px;
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
        .dark .armada-section { background: #1a2632; }
        .dark .alert-success { background: #1e3d2e; border-color: #4a7a5a; color: #8abd9a; }
        .dark .alert-error { background: #3d1e1e; border-color: #d46a6a; color: #d46a6a; }
        .dark .header-actions .title { color: #f0ede8; }
        .dark .vehicle-card { background: #1a2632; border-color: #2c3e50; box-shadow: 0 8px 25px rgba(0,0,0,0.4); }
        .dark .vehicle-card:hover { border-color: #43637E; }
        .dark .vehicle-card .body .name { color: #f0ede8; }
        .dark .vehicle-card .body .specs { color: #b0bec5; }
        .dark .vehicle-card .body .price { color: #f0e6d0; }
        .dark .vehicle-card .body .stock-info { border-top-color: #2c3e50; }
        .dark .vehicle-card .body .actions .btn-edit { background: #2c3e50; color: #f0ede8; }
        .dark .vehicle-card .body .actions .btn-edit:hover { background: #3a4a5a; }
        .dark .vehicle-card .body .add-stock-form { border-top-color: #2c3e50; }
        .dark .vehicle-card .body .add-stock-form input { background: #0f1a24; border-color: #2c3e50; color: #f0ede8; }
        .dark .vehicle-card .body .add-stock-form input:focus { border-color: #43637E; }
        .dark .empty-state { background: #1a2632; border-color: #2c3e50; box-shadow: 0 16px 50px rgba(0,0,0,0.4); }
        .dark .empty-state h3 { color: #f0ede8; }
        .dark .empty-state p { color: #b0bec5; }
        .dark .pagination-wrapper .info-text { color: #b0bec5; }
        .dark .pagination-wrapper .info-text strong { color: #f0e6d0; }
        .dark .pagination-wrapper nav .page-link { background: #1a2632; color: #f0ede8; border-color: #2c3e50; box-shadow: 0 2px 8px rgba(0,0,0,0.2); }
        .dark .pagination-wrapper nav .page-link:hover { background: #43637E; color: #ffffff; border-color: #43637E; }
        .dark .pagination-wrapper nav .page-link.active { background: #43637E; color: #ffffff; border-color: #43637E; }

        @media (max-width: 768px) {
            .header-actions { flex-direction: column; gap: 12px; align-items: stretch; }
            .btn-add { justify-content: center; }
            .vehicle-card .body .actions { grid-template-columns: 1fr 1fr; }
            .vehicle-card .body .add-stock-form { flex-wrap: wrap; }
            .vehicle-card .body .add-stock-form .btn-stock { flex: 1; justify-content: center; }
            .pagination-wrapper nav .page-link { min-width: 36px; height: 36px; font-size: 13px; padding: 0 10px; }
        }

        @media (max-width: 480px) {
            .armada-section { padding: 24px 0 40px; }
            .vehicle-card .image-wrap { height: 140px; }
            .vehicle-card .body { padding: 12px 12px 14px; }
            .vehicle-card .body .name { font-size: 15px; }
            .vehicle-card .body .price { font-size: 17px; }
            .vehicle-card .body .add-stock-form input { font-size: 11px; padding: 4px 8px; height: 26px; }
            .vehicle-card .body .add-stock-form .btn-stock { font-size: 11px; padding: 4px 12px; height: 26px; }
            .empty-state { padding: 40px 16px; }
            .empty-state .icon { font-size: 48px; }
            .empty-state h3 { font-size: 18px; }
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

    <div class="armada-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="alert-success"> {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert-error"> {{ session('error') }}</div>
            @endif

            <div class="header-actions">
                <h3 class="title">Daftar Kendaraan</h3>
                <a href="{{ route('manager.vehicles.create') }}" class="btn-add">
                     Tambah Kendaraan
                </a>
            </div>

            @if($vehicles->count() > 0)
                {{-- GRID 2 KOLOM --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    @foreach($vehicles as $vehicle)
                        <div class="vehicle-card">
                            <div class="image-wrap">
                                @if($vehicle->image)
                                    <img src="{{ asset('storage/' . $vehicle->image) }}" alt="{{ $vehicle->name }}">
                                @else
                                    <span class="placeholder">                                 {{ $vehicle->vehicle_type == 'car' ? 'Car' : 'Motorcycle' }}</span>
                                @endif
                                <span class="stock-badge {{ $vehicle->available_stock > 0 ? 'available' : 'empty' }}">
                                     {{ $vehicle->available_stock > 0 ? 'Tersedia' : 'Habis' }}
                                </span>
                            </div>

                            <div class="body">
                                <h4 class="name">{{ $vehicle->name }}</h4>
                                <div class="specs">{{ $vehicle->brand }} • {{ $vehicle->year }}</div>
                                <div class="price">
                                    <div class="text-base font-bold text-[#002D55] dark:text-blue-300">
                                        Rp {{ number_format($vehicle->price_per_day, 0, ',', '.') }}
                                        <small class="text-xs text-gray-500">/ hari</small>
                                    </div>
                                    @if($vehicle->price_per_week > 0)
                                        <div class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold mt-0.5">
                                            🎁 Paket 7 Hari: Rp {{ number_format($vehicle->price_per_week, 0, ',', '.') }}
                                        </div>
                                    @endif
                                </div>

                                @php
                                    $rentedCount = max(0, $vehicle->total_stock - $vehicle->available_stock - $vehicle->damaged_stock);
                                @endphp
                                <div class="grid grid-cols-2 gap-2 my-2.5 text-xs">
                                    <div style="background: #f1f5f9; color: #1e293b; border: 1px solid #cbd5e1;" class="flex items-center justify-between p-2 rounded-xl shadow-sm">
                                        <span class="flex items-center gap-1 font-semibold">📦 Total</span>
                                        <strong class="font-extrabold text-sm">{{ $vehicle->total_stock }}</strong>
                                    </div>
                                    <div style="background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;" class="flex items-center justify-between p-2 rounded-xl shadow-sm">
                                        <span class="flex items-center gap-1 font-semibold">✅ Siap</span>
                                        <strong class="font-extrabold text-sm">{{ $vehicle->available_stock }} unit</strong>
                                    </div>
                                    <div style="background: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe;" class="flex items-center justify-between p-2 rounded-xl shadow-sm">
                                        <span class="flex items-center gap-1 font-semibold">🚗 Disewa</span>
                                        <strong class="font-extrabold text-sm">{{ $rentedCount }} unit</strong>
                                    </div>
                                    <div style="{{ $vehicle->damaged_stock > 0 ? 'background: #fff1f2; color: #9f1239; border: 1px solid #fecdd3;' : 'background: #f8fafc; color: #94a3b8; border: 1px solid #e2e8f0;' }}" class="flex items-center justify-between p-2 rounded-xl shadow-sm">
                                        <span class="flex items-center gap-1 font-semibold">🛠️ Rusak</span>
                                        <strong class="font-extrabold text-sm">{{ $vehicle->damaged_stock }} unit</strong>
                                    </div>
                                </div>

                                @if($vehicle->damaged_stock > 0)
                                    <form action="{{ route('manager.vehicles.repair', $vehicle->id) }}" method="POST" class="mb-2">
                                        @csrf
                                        <button type="submit" class="w-full py-1.5 px-3 bg-amber-500 hover:bg-amber-600 text-white rounded-xl text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-sm" onclick="return confirm('Konfirmasi: 1 unit {{ $vehicle->name }} telah selesai direparasi dan siap kembali disewakan?')">
                                            <span>🛠️</span> Betulkan 1 Unit Rusak (Stok Rusak: {{ $vehicle->damaged_stock }})
                                        </button>
                                    </form>
                                @endif

                                <div class="actions">
                                    <a href="{{ route('manager.vehicles.edit', $vehicle->id) }}" class="btn-edit">
                                         Edit
                                    </a>
                                    @php
                                        $cannotDelete = ($vehicle->available_stock > 0 || $vehicle->total_stock > 0) || in_array($vehicle->id, $inCartOrBooked ?? []);
                                        $deleteReason = ($vehicle->available_stock > 0 || $vehicle->total_stock > 0) 
                                            ? 'Stok belum 0' 
                                            : 'Sedang di keranjang / dibooking user';
                                    @endphp
                                    @if($cannotDelete)
                                        <button type="button" class="btn-delete" disabled style="opacity:0.45; cursor:not-allowed; background:#cbd5e1; color:#64748b; border-color:#cbd5e1;" title="Tidak dapat dihapus: {{ $deleteReason }}">
                                             Hapus
                                        </button>
                                    @else
                                        <form action="{{ route('manager.vehicles.destroy', $vehicle->id) }}" method="POST" style="margin:0; width:100%;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete" onclick="return confirm('Hapus kendaraan {{ $vehicle->name }}?')">
                                                 Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>

                                <form action="{{ route('manager.vehicles.addStock', $vehicle->id) }}" method="POST" class="add-stock-form">
                                    @csrf
                                    <input type="number" name="stock" min="1" placeholder="Tambah" required>
                                    <button type="submit" class="btn-stock">                            Stok</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- PAGINATION 2x5 (10 per halaman) --}}
                <div class="pagination-wrapper">
                    <div class="info-text">
                        Menampilkan <strong>{{ $vehicles->firstItem() ?? 0 }}</strong> - <strong>{{ $vehicles->lastItem() ?? 0 }}</strong> dari <strong>{{ $vehicles->total() }}</strong> kendaraan
                    </div>
                    <nav>
                        {{-- Previous --}}
                        @if ($vehicles->onFirstPage())
                            <span class="page-link disabled">‹</span>
                        @else
                            <a href="{{ $vehicles->previousPageUrl() }}" class="page-link">‹</a>
                        @endif

                        {{-- Halaman --}}
                        @php
                            $currentPage = $vehicles->currentPage();
                            $lastPage = $vehicles->lastPage();
                            $start = max(1, $currentPage - 2);
                            $end = min($lastPage, $currentPage + 2);
                            
                            if ($start > 1) {
                                echo '<a href="' . $vehicles->url(1) . '" class="page-link">1</a>';
                                if ($start > 2) {
                                    echo '<span class="page-link disabled">…</span>';
                                }
                            }
                            
                            for ($i = $start; $i <= $end; $i++) {
                                if ($i == $currentPage) {
                                    echo '<span class="page-link active">' . $i . '</span>';
                                } else {
                                    echo '<a href="' . $vehicles->url($i) . '" class="page-link">' . $i . '</a>';
                                }
                            }
                            
                            if ($end < $lastPage) {
                                if ($end < $lastPage - 1) {
                                    echo '<span class="page-link disabled">…</span>';
                                }
                                echo '<a href="' . $vehicles->url($lastPage) . '" class="page-link">' . $lastPage . '</a>';
                            }
                        @endphp

                        {{-- Next --}}
                        @if ($vehicles->hasMorePages())
                            <a href="{{ $vehicles->nextPageUrl() }}" class="page-link">›</a>
                        @else
                            <span class="page-link disabled">›</span>
                        @endif
                    </nav>
                </div>

            @else
                <div class="empty-state">
                        <span class="icon"></span>
                    <h3>Belum Ada Kendaraan</h3>
                    <p>Belum ada kendaraan di lokasi {{ Auth::user()->location }}</p>
                    <a href="{{ route('manager.vehicles.create') }}" class="btn-add-first">
                        Tambah Kendaraan Pertama
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>