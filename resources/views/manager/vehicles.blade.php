<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Kelola Armada - {{ Auth::user()->location }}
        </h2>
    </x-slot>

    <style>

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
            height: 125px;
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
            font-size: 28px;
            font-weight: 700;
            color: #475569;
            opacity: 0.7;
        }

        .vehicle-card .image-wrap .stock-badge {
            position: absolute;
            top: 8px;
            right: 8px;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .vehicle-card .image-wrap .stock-badge.available {
            background: rgba(74, 122, 90, 0.9);
            color: #ffffff;
        }

        .vehicle-card .image-wrap .stock-badge.empty {
            background: rgba(176, 74, 74, 0.9);
            color: #ffffff;
        }

        .vehicle-card .body {
            padding: 12px 14px 14px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .vehicle-card .body .name {
            font-size: 15px;
            font-weight: 700;
            color: #2c3e50;
            line-height: 1.3;
        }

        .vehicle-card .body .specs {
            font-size: 11.5px;
            color: #7a8a9a;
            margin-top: 2px;
        }

        .vehicle-card .body .price {
            font-size: 15px;
            font-weight: 700;
            color: #43637E;
            margin-top: 4px;
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

            <div class="header-actions flex-wrap gap-3">
                <div class="flex items-center gap-2 flex-wrap">
                    <a href="{{ route('manager.vehicles', ['type' => 'all']) }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-1.5 {{ ($typeFilter ?? 'all') === 'all' ? 'bg-[#004B87] text-white shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
                        <span>📋</span> Semua Armada ({{ $totalCount ?? 0 }})
                    </a>
                    <a href="{{ route('manager.vehicles', ['type' => 'car']) }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-1.5 {{ ($typeFilter ?? 'all') === 'car' ? 'bg-[#004B87] text-white shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
                        <span>🚗</span> Mobil ({{ $carCount ?? 0 }})
                    </a>
                    <a href="{{ route('manager.vehicles', ['type' => 'motorcycle']) }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-1.5 {{ ($typeFilter ?? 'all') === 'motorcycle' ? 'bg-[#004B87] text-white shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
                        <span>🏍️</span> Sepeda Motor ({{ $motorCount ?? 0 }})
                    </a>
                </div>
                <a href="{{ route('manager.vehicles.create') }}" class="btn-add">
                    + Tambah Kendaraan
                </a>
            </div>

            @if(($totalCount ?? 0) > 0)

                {{-- ================= SEKSI 1: ARMADA MOBIL ================= --}}
                @if(($typeFilter ?? 'all') === 'all' || ($typeFilter ?? 'all') === 'car')
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-3 pb-2 border-b border-slate-200 dark:border-slate-700">
                        <h4 class="text-base font-extrabold text-[#002D55] dark:text-slate-100 flex items-center gap-2">
                            <span>🚗</span> Armada Mobil
                        </h4>
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-[#004B87]">
                            {{ $cars->count() }} Tipe Mobil
                        </span>
                    </div>

                    @if($cars->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($cars as $vehicle)
                                <div class="vehicle-card">
                                    <div class="image-wrap">
                                        @if($vehicle->image)
                                            <img src="{{ asset('storage/' . $vehicle->image) }}" alt="{{ $vehicle->name }}">
                                        @else
                                            <span class="placeholder">🚗 Mobil</span>
                                        @endif
                                        <span class="stock-badge {{ $vehicle->available_stock > 0 ? 'available' : 'empty' }}">
                                            {{ $vehicle->available_stock > 0 ? 'Tersedia' : 'Habis' }}
                                        </span>
                                    </div>

                                    <div class="body">
                                        <h4 class="name truncate" title="{{ $vehicle->name }}">{{ $vehicle->name }}</h4>
                                        <div class="specs">{{ $vehicle->brand }} • {{ $vehicle->year }} • {{ ucfirst($vehicle->transmission ?? 'Auto') }}</div>
                                        <div class="price">
                                            <div class="text-sm font-bold text-[#002D55] dark:text-blue-300">
                                                Rp {{ number_format($vehicle->price_per_day, 0, ',', '.') }}
                                                <small class="text-[11px] text-gray-500">/ hari</small>
                                            </div>
                                            @if($vehicle->price_per_week > 0)
                                                <div class="text-[11px] text-emerald-600 dark:text-emerald-400 font-semibold">
                                                    🎁 Paket 7 Hari: Rp {{ number_format($vehicle->price_per_week, 0, ',', '.') }}
                                                </div>
                                            @endif
                                        </div>

                                        @php
                                            $rentedCount = max(0, $vehicle->total_stock - $vehicle->available_stock - $vehicle->damaged_stock);
                                        @endphp
                                        <div class="grid grid-cols-2 gap-1.5 my-2 text-[11px]">
                                            <div style="background: #f1f5f9; color: #1e293b; border: 1px solid #cbd5e1;" class="flex items-center justify-between px-2 py-1 rounded-lg">
                                                <span class="font-semibold">📦 Total</span>
                                                <strong class="font-extrabold">{{ $vehicle->total_stock }}</strong>
                                            </div>
                                            <div style="background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;" class="flex items-center justify-between px-2 py-1 rounded-lg">
                                                <span class="font-semibold">✅ Siap</span>
                                                <strong class="font-extrabold">{{ $vehicle->available_stock }}</strong>
                                            </div>
                                            <div style="background: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe;" class="flex items-center justify-between px-2 py-1 rounded-lg">
                                                <span class="font-semibold">🚗 Sewa</span>
                                                <strong class="font-extrabold">{{ $rentedCount }}</strong>
                                            </div>
                                            <div style="{{ $vehicle->damaged_stock > 0 ? 'background: #fff1f2; color: #9f1239; border: 1px solid #fecdd3;' : 'background: #f8fafc; color: #94a3b8; border: 1px solid #e2e8f0;' }}" class="flex items-center justify-between px-2 py-1 rounded-lg">
                                                <span class="font-semibold">🛠️ Rusak</span>
                                                <strong class="font-extrabold">{{ $vehicle->damaged_stock }}</strong>
                                            </div>
                                        </div>

                                        @if($vehicle->damaged_stock > 0)
                                            <form action="{{ route('manager.vehicles.repair', $vehicle->id) }}" method="POST" class="mb-1.5">
                                                @csrf
                                                <button type="submit" class="w-full py-1 px-2.5 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-[11px] font-bold transition flex items-center justify-center gap-1 shadow-sm" onclick="return confirm('Konfirmasi: 1 unit {{ $vehicle->name }} telah selesai direparasi dan siap kembali disewakan?')">
                                                    <span>🛠️</span> Betulkan 1 Unit ({{ $vehicle->damaged_stock }})
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
                                                    ? 'Ubah stok menjadi 0 terlebih dahulu untuk menghapus' 
                                                    : 'Sedang dibooking / disewa user';
                                            @endphp
                                            @if($cannotDelete)
                                                <button type="button" class="btn-delete" disabled style="opacity:0.45; cursor:not-allowed; background:#cbd5e1 !important; color:#64748b !important; border-color:#cbd5e1 !important;" title="Tidak dapat dihapus: {{ $deleteReason }}">
                                                    Hapus
                                                </button>
                                            @else
                                                <button type="button" class="btn-delete" style="width:100%;" onclick="openDeleteVehicleModal('{{ $vehicle->id }}', '{{ addslashes($vehicle->name) }}')">
                                                    Hapus
                                                </button>
                                            @endif
                                        </div>

                                        <form action="{{ route('manager.vehicles.addStock', $vehicle->id) }}" method="POST" class="add-stock-form">
                                            @csrf
                                            <span class="text-[11px] font-bold text-slate-600 dark:text-slate-300 whitespace-nowrap">Stok:</span>
                                            <input type="number" name="stock" min="0" value="{{ $vehicle->total_stock }}" placeholder="0" required title="Isi 0 jika ingin mengosongkan stok agar armada bisa dihapus">
                                            <button type="submit" class="btn-stock">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-6 text-center bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 text-xs text-slate-500">
                            Belum ada armada mobil di cabang {{ Auth::user()->location }}.
                        </div>
                    @endif
                </div>
                @endif

                {{-- ================= SEKSI 2: ARMADA SEPEDA MOTOR ================= --}}
                @if(($typeFilter ?? 'all') === 'all' || ($typeFilter ?? 'all') === 'motorcycle')
                <div>
                    <div class="flex items-center justify-between mb-3 pb-2 border-b border-slate-200 dark:border-slate-700">
                        <h4 class="text-base font-extrabold text-[#002D55] dark:text-slate-100 flex items-center gap-2">
                            <span>🏍️</span> Armada Sepeda Motor
                        </h4>
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                            {{ $motorcycles->count() }} Tipe Motor
                        </span>
                    </div>

                    @if($motorcycles->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($motorcycles as $vehicle)
                                <div class="vehicle-card">
                                    <div class="image-wrap">
                                        @if($vehicle->image)
                                            <img src="{{ asset('storage/' . $vehicle->image) }}" alt="{{ $vehicle->name }}">
                                        @else
                                            <span class="placeholder">🏍️ Motor</span>
                                        @endif
                                        <span class="stock-badge {{ $vehicle->available_stock > 0 ? 'available' : 'empty' }}">
                                            {{ $vehicle->available_stock > 0 ? 'Tersedia' : 'Habis' }}
                                        </span>
                                    </div>

                                    <div class="body">
                                        <h4 class="name truncate" title="{{ $vehicle->name }}">{{ $vehicle->name }}</h4>
                                        <div class="specs">{{ $vehicle->brand }} • {{ $vehicle->year }} • {{ ucfirst($vehicle->transmission_motor ?? $vehicle->transmission ?? 'Matic') }}</div>
                                        <div class="price">
                                            <div class="text-sm font-bold text-[#002D55] dark:text-blue-300">
                                                Rp {{ number_format($vehicle->price_per_day, 0, ',', '.') }}
                                                <small class="text-[11px] text-gray-500">/ hari</small>
                                            </div>
                                            @if($vehicle->price_per_week > 0)
                                                <div class="text-[11px] text-emerald-600 dark:text-emerald-400 font-semibold">
                                                    🎁 Paket 7 Hari: Rp {{ number_format($vehicle->price_per_week, 0, ',', '.') }}
                                                </div>
                                            @endif
                                        </div>

                                        @php
                                            $rentedCount = max(0, $vehicle->total_stock - $vehicle->available_stock - $vehicle->damaged_stock);
                                        @endphp
                                        <div class="grid grid-cols-2 gap-1.5 my-2 text-[11px]">
                                            <div style="background: #f1f5f9; color: #1e293b; border: 1px solid #cbd5e1;" class="flex items-center justify-between px-2 py-1 rounded-lg">
                                                <span class="font-semibold">📦 Total</span>
                                                <strong class="font-extrabold">{{ $vehicle->total_stock }}</strong>
                                            </div>
                                            <div style="background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;" class="flex items-center justify-between px-2 py-1 rounded-lg">
                                                <span class="font-semibold">✅ Siap</span>
                                                <strong class="font-extrabold">{{ $vehicle->available_stock }}</strong>
                                            </div>
                                            <div style="background: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe;" class="flex items-center justify-between px-2 py-1 rounded-lg">
                                                <span class="font-semibold">🏍️ Sewa</span>
                                                <strong class="font-extrabold">{{ $rentedCount }}</strong>
                                            </div>
                                            <div style="{{ $vehicle->damaged_stock > 0 ? 'background: #fff1f2; color: #9f1239; border: 1px solid #fecdd3;' : 'background: #f8fafc; color: #94a3b8; border: 1px solid #e2e8f0;' }}" class="flex items-center justify-between px-2 py-1 rounded-lg">
                                                <span class="font-semibold">🛠️ Rusak</span>
                                                <strong class="font-extrabold">{{ $vehicle->damaged_stock }}</strong>
                                            </div>
                                        </div>

                                        @if($vehicle->damaged_stock > 0)
                                            <form action="{{ route('manager.vehicles.repair', $vehicle->id) }}" method="POST" class="mb-1.5">
                                                @csrf
                                                <button type="submit" class="w-full py-1 px-2.5 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-[11px] font-bold transition flex items-center justify-center gap-1 shadow-sm" onclick="return confirm('Konfirmasi: 1 unit {{ $vehicle->name }} telah selesai direparasi dan siap kembali disewakan?')">
                                                    <span>🛠️</span> Betulkan 1 Unit ({{ $vehicle->damaged_stock }})
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
                                                    ? 'Ubah stok menjadi 0 terlebih dahulu untuk menghapus' 
                                                    : 'Sedang dibooking / disewa user';
                                            @endphp
                                            @if($cannotDelete)
                                                <button type="button" class="btn-delete" disabled style="opacity:0.45; cursor:not-allowed; background:#cbd5e1 !important; color:#64748b !important; border-color:#cbd5e1 !important;" title="Tidak dapat dihapus: {{ $deleteReason }}">
                                                    Hapus
                                                </button>
                                            @else
                                                <button type="button" class="btn-delete" style="width:100%;" onclick="openDeleteVehicleModal('{{ $vehicle->id }}', '{{ addslashes($vehicle->name) }}')">
                                                    Hapus
                                                </button>
                                            @endif
                                        </div>

                                        <form action="{{ route('manager.vehicles.addStock', $vehicle->id) }}" method="POST" class="add-stock-form">
                                            @csrf
                                            <span class="text-[11px] font-bold text-slate-600 dark:text-slate-300 whitespace-nowrap">Stok:</span>
                                            <input type="number" name="stock" min="0" value="{{ $vehicle->total_stock }}" placeholder="0" required title="Isi 0 jika ingin mengosongkan stok agar armada bisa dihapus">
                                            <button type="submit" class="btn-stock">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-6 text-center bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 text-xs text-slate-500">
                            Belum ada armada sepeda motor di cabang {{ Auth::user()->location }}.
                        </div>
                    @endif
                </div>
                @endif

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

    <!-- ===== MODAL KONFIRMASI HAPUS ARMADA ===== -->
    <div id="modalDeleteVehicle" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div class="bg-white dark:bg-slate-900 rounded-3xl max-w-md w-full p-6 text-center shadow-2xl border border-slate-200 dark:border-slate-800">
            <div class="w-16 h-16 bg-rose-100 dark:bg-rose-950/60 text-rose-600 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4 shadow-inner">
                ⚠️
            </div>
            <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mb-2">
                Apakah yakin ingin menghapus armada ini?
            </h3>
            <p id="deleteVehicleDesc" class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                Data kendaraan akan dihapus secara permanen dari cabang Anda dan tindakan ini tidak dapat dibatalkan.
            </p>

            <form id="formDeleteVehicle" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="flex items-center gap-3">
                    <button type="button" onclick="closeDeleteVehicleModal()" class="flex-1 py-3 px-4 rounded-xl text-sm font-bold text-slate-700 dark:text-slate-200 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 transition">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 py-3 px-4 rounded-xl text-sm font-bold text-white bg-rose-600 hover:bg-rose-700 shadow-lg shadow-rose-600/30 transition">
                        Ya, Hapus Armada
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openDeleteVehicleModal(vehicleId, vehicleName) {
            const modal = document.getElementById('modalDeleteVehicle');
            const form = document.getElementById('formDeleteVehicle');
            const desc = document.getElementById('deleteVehicleDesc');

            form.action = "{{ url('manager/vehicles') }}/" + vehicleId;
            desc.innerHTML = 'Anda akan menghapus armada <strong>"' + vehicleName + '"</strong> secara permanen. Tindakan ini tidak dapat dibatalkan.';

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteVehicleModal() {
            const modal = document.getElementById('modalDeleteVehicle');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</x-app-layout>