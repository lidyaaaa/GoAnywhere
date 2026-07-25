<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            🚗 Armada Kendaraan
        </h2>
    </x-slot>

    <!-- ============================================ -->
    <!-- STYLE ELEGAN - #43637E + SHADOW HITAM TEBEL -->
    <!-- ============================================ -->
    <style>
        * {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .armada-section {
            padding: 40px 0 60px;
            background: #f8f6f2;
            position: relative;
            min-height: 100vh;
        }

        .armada-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
        }

        /* ===== FILTER BOX ===== */
        .filter-box {
            background: #ffffff;
            border-radius: 16px;
            padding: 24px 32px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2), 0 4px 20px rgba(0, 0, 0, 0.1);
            border: 1px solid #e8e4de;
            margin-bottom: 36px;
            transition: all 0.4s ease;
        }

        .filter-box:hover {
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3), 0 12px 40px rgba(0, 0, 0, 0.15);
            border-color: #43637E;
        }

        .filter-row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 16px;
        }

        .filter-row .search-wrap {
            flex: 2;
            min-width: 200px;
            position: relative;
        }

        .filter-row .search-wrap input {
            width: 100%;
            padding: 12px 16px 12px 44px;
            border-radius: 10px;
            border: 1.5px solid #e8e4de;
            font-size: 14px;
            background: #faf8f5;
            transition: all 0.3s ease;
            color: #2c3e50;
        }

        .filter-row .search-wrap input:focus {
            border-color: #43637E;
            box-shadow: 0 0 0 4px rgba(67, 99, 126, 0.12);
            outline: none;
            background: #ffffff;
        }

        .filter-row .search-wrap input::placeholder {
            color: #b0a8a0;
        }

        .filter-row .search-wrap .search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #b0a8a0;
        }

        .filter-row .sort-wrap {
            flex: 1;
            min-width: 140px;
        }

        .filter-row .sort-wrap select {
            width: 100%;
            padding: 12px 16px;
            border-radius: 10px;
            border: 1.5px solid #e8e4de;
            font-size: 14px;
            background: #faf8f5;
            transition: all 0.3s ease;
            color: #2c3e50;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%2343637E' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
        }

        .filter-row .sort-wrap select:focus {
            border-color: #43637E;
            box-shadow: 0 0 0 4px rgba(67, 99, 126, 0.12);
            outline: none;
            background-color: #ffffff;
        }

        .filter-row .price-wrap {
            flex: 1.5;
            min-width: 200px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filter-row .price-wrap .price-label {
            font-size: 13px;
            font-weight: 600;
            color: #43637E;
            white-space: nowrap;
            letter-spacing: 0.3px;
        }

        .filter-row .price-wrap input {
            width: 100%;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1.5px solid #e8e4de;
            font-size: 14px;
            background: #faf8f5;
            transition: all 0.3s ease;
            color: #2c3e50;
            min-width: 70px;
        }

        .filter-row .price-wrap input:focus {
            border-color: #43637E;
            box-shadow: 0 0 0 4px rgba(67, 99, 126, 0.12);
            outline: none;
            background: #ffffff;
        }

        .filter-row .price-wrap input::placeholder {
            color: #b0a8a0;
            font-size: 13px;
        }

        .filter-row .price-wrap .price-sep {
            color: #b0a8a0;
            font-weight: 300;
            font-size: 14px;
        }

        .filter-row .btn-wrap {
            flex: 0.5;
            min-width: 120px;
        }

        .filter-row .btn-wrap button {
            width: 100%;
            padding: 12px 24px;
            border-radius: 10px;
            border: none;
            background: #43637E;
            color: #ffffff;
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 6px 25px rgba(67, 99, 126, 0.35);
        }

        .filter-row .btn-wrap button:hover {
            background: #36546b;
            transform: translateY(-3px);
            box-shadow: 0 10px 35px rgba(67, 99, 126, 0.45);
        }

        .filter-advanced {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #f0ede8;
        }

        .filter-advanced .adv-item {
            flex: 1;
            min-width: 140px;
        }

        .filter-advanced .adv-item label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: #43637E;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .filter-advanced .adv-item select {
            width: 100%;
            padding: 10px 14px;
            border-radius: 10px;
            border: 1.5px solid #e8e4de;
            font-size: 14px;
            background: #faf8f5;
            transition: all 0.3s ease;
            color: #2c3e50;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%2343637E' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
        }

        .filter-advanced .adv-item select:focus {
            border-color: #43637E;
            box-shadow: 0 0 0 4px rgba(67, 99, 126, 0.12);
            outline: none;
            background-color: #ffffff;
        }

        .filter-advanced .adv-item .reset-link {
            display: inline-block;
            margin-top: 4px;
            font-size: 13px;
            color: #7a8a9a;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .filter-advanced .adv-item .reset-link:hover {
            color: #43637E;
        }

        /* ===== ARMADA GRID 3x4 ===== */
        .armada-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .armada-card {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2), 0 4px 20px rgba(0, 0, 0, 0.1);
            border: 1px solid #e8e4de;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .armada-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 2;
        }

        .armada-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 24px 65px rgba(0, 0, 0, 0.35), 0 12px 40px rgba(0, 0, 0, 0.2);
            border-color: #43637E;
        }

        .armada-card:hover::before {
            opacity: 1;
        }

        .armada-card .image-wrap {
            height: 200px;
            background: linear-gradient(135deg, #e8e4de, #d5d0c8);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .armada-card .image-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .armada-card:hover .image-wrap img {
            transform: scale(1.08);
        }

        .armada-card .image-wrap .placeholder-icon {
            font-size: 72px;
            opacity: 0.6;
        }

        .armada-card .image-wrap .type-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(8px);
            color: #ffffff;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            z-index: 1;
        }

        .armada-card .body {
            padding: 20px 22px 24px;
        }

        .armada-card .body .name {
            font-size: 20px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
        }

        .armada-card .body .specs {
            display: flex;
            flex-wrap: wrap;
            gap: 4px 8px;
            font-size: 13px;
            color: #7a8a9a;
            margin-top: 4px;
        }

        .armada-card .body .specs .dot {
            color: #d5d0c8;
        }

        .armada-card .body .price {
            font-size: 28px;
            font-weight: 700;
            color: #43637E;
            margin-top: 10px;
            font-family: 'Georgia', serif;
        }

        .armada-card .body .price small {
            font-size: 14px;
            font-weight: 400;
            color: #9aabbb;
        }

        .armada-card .body .info-row {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 6px;
            font-size: 14px;
        }

        .armada-card .body .info-row .location {
            color: #7a8a9a;
        }

        .armada-card .body .info-row .stock {
            color: #4a7a5a;
            font-weight: 600;
            background: #e8f4ec;
            padding: 2px 14px;
            border-radius: 20px;
            font-size: 12px;
        }

        /* ===== ACTIONS - FULL BUTTON ===== */
        .armada-card .body .actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 16px;
        }

        .armada-card .body .actions .btn-detail,
        .armada-card .body .actions .btn-booking {
            width: 100%;
            padding: 11px 0;
            border-radius: 10px;
            font-weight: 700;
            font-size: 13px;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            box-sizing: border-box;
            letter-spacing: 0.5px;
        }

        .armada-card .body .actions .btn-detail {
            background: #f0ede8;
            color: #2c3e50;
        }

        .armada-card .body .actions .btn-detail:hover {
            background: #e0dcd5;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .armada-card .body .actions .btn-booking {
            background: #43637E;
            color: #ffffff;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(67, 99, 126, 0.3);
        }

        .armada-card .body .actions .btn-booking:hover {
            background: #36546b;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(67, 99, 126, 0.4);
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            grid-column: span 3;
            text-align: center;
            padding: 80px 20px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
            border: 1px solid #e8e4de;
        }

        .empty-state .icon {
            font-size: 72px;
            margin-bottom: 20px;
            display: block;
        }

        .empty-state h3 {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
        }

        .empty-state p {
            color: #7a8a9a;
            margin-top: 4px;
        }

        /* ===== PAGINATION ===== */
        .pagination-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
            margin-top: 40px;
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
        }

        .pagination-wrapper nav .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 42px;
            height: 42px;
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

        .pagination-wrapper nav .page-link .arrow {
            font-size: 16px;
        }

        /* ===== DARK MODE ===== */
        .dark .armada-section {
            background: #1a2632;
        }

        .dark .armada-section::before {
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
        }

        .dark .filter-box {
            background: #1a2632;
            border-color: #2c3e50;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.5), 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .dark .filter-box:hover {
            border-color: #43637E;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6), 0 12px 40px rgba(0, 0, 0, 0.4);
        }

        .dark .filter-row .search-wrap input,
        .dark .filter-row .sort-wrap select,
        .dark .filter-row .price-wrap input,
        .dark .filter-advanced .adv-item select {
            background: #0f1a24;
            border-color: #2c3e50;
            color: #f0ede8;
        }

        .dark .filter-row .search-wrap input:focus,
        .dark .filter-row .sort-wrap select:focus,
        .dark .filter-row .price-wrap input:focus,
        .dark .filter-advanced .adv-item select:focus {
            border-color: #43637E;
            background: #1a2632;
        }

        .dark .filter-row .search-wrap input::placeholder {
            color: #5a6a7a;
        }

        .dark .filter-row .search-wrap .search-icon {
            color: #5a6a7a;
        }

        .dark .filter-advanced {
            border-top-color: #2c3e50;
        }

        .dark .filter-advanced .adv-item label {
            color: #f0e6d0;
        }

        .dark .filter-advanced .adv-item .reset-link {
            color: #7a8a9a;
        }

        .dark .filter-advanced .adv-item .reset-link:hover {
            color: #f0e6d0;
        }

        .dark .armada-card {
            background: #1a2632;
            border-color: #2c3e50;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4), 0 4px 20px rgba(0, 0, 0, 0.25);
        }

        .dark .armada-card:hover {
            border-color: #43637E;
            box-shadow: 0 24px 65px rgba(0, 0, 0, 0.5), 0 12px 40px rgba(0, 0, 0, 0.3);
        }

        .dark .armada-card .body .name {
            color: #f0ede8;
        }

        .dark .armada-card .body .specs {
            color: #b0bec5;
        }

        .dark .armada-card .body .info-row .location {
            color: #b0bec5;
        }

        .dark .armada-card .body .info-row .stock {
            background: #1e3d2e;
            color: #8abd9a;
        }

        .dark .armada-card .body .actions .btn-detail {
            background: #2c3e50;
            color: #f0ede8;
        }

        .dark .armada-card .body .actions .btn-detail:hover {
            background: #3a4a5a;
        }

        .dark .empty-state {
            background: #1a2632;
            border-color: #2c3e50;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
        }

        .dark .empty-state h3 {
            color: #f0ede8;
        }

        .dark .empty-state p {
            color: #b0bec5;
        }

        .dark .pagination-wrapper .info-text {
            color: #b0bec5;
        }

        .dark .pagination-wrapper .info-text strong {
            color: #f0e6d0;
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
        @media (max-width: 1024px) {
            .armada-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 24px;
            }
            .empty-state {
                grid-column: span 2;
            }
        }

        @media (max-width: 768px) {
            .filter-box {
                padding: 18px 16px;
            }
            .filter-row {
                flex-direction: column;
                align-items: stretch;
            }
            .filter-row .search-wrap,
            .filter-row .sort-wrap,
            .filter-row .price-wrap,
            .filter-row .btn-wrap {
                min-width: unset;
                width: 100%;
            }
            .filter-row .price-wrap {
                flex-wrap: wrap;
            }
            .filter-advanced {
                flex-direction: column;
            }
            .filter-advanced .adv-item {
                min-width: unset;
                width: 100%;
            }
            .armada-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            .empty-state {
                grid-column: span 1;
            }
            .armada-card .body .actions {
                grid-template-columns: 1fr 1fr;
            }
            .pagination-wrapper nav .page-link {
                min-width: 36px;
                height: 36px;
                font-size: 13px;
                padding: 0 10px;
            }
        }

        @media (max-width: 480px) {
            .armada-section {
                padding: 24px 0 40px;
            }
            .filter-box {
                padding: 14px 12px;
                border-radius: 12px;
            }
            .filter-row .search-wrap input,
            .filter-row .sort-wrap select,
            .filter-row .price-wrap input {
                padding: 10px 12px;
                font-size: 13px;
            }
            .filter-row .search-wrap input {
                padding-left: 38px;
            }
            .filter-row .search-wrap .search-icon {
                font-size: 15px;
                left: 12px;
            }
            .armada-card .body {
                padding: 16px 16px 20px;
            }
            .armada-card .body .name {
                font-size: 17px;
            }
            .armada-card .body .price {
                font-size: 22px;
            }
            .armada-card .body .actions .btn-detail,
            .armada-card .body .actions .btn-booking {
                font-size: 11px;
                padding: 9px 0;
            }
            .pagination-wrapper nav .page-link {
                min-width: 32px;
                height: 32px;
                font-size: 12px;
                padding: 0 8px;
                border-radius: 8px;
            }
            .pagination-wrapper .info-text {
                font-size: 12px;
            }
        }

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
    <!-- ARMADA SECTION                              -->
    <!-- ============================================ -->
    <div class="armada-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- HEADER -->
            <div class="flex justify-between items-center mb-8 flex-wrap gap-4">
                <div>
                    <h2 style="font-size: 32px; font-weight: 700; color: #2c3e50; font-family: 'Georgia', serif;">
                        🚙 <span style="color: #43637E;">Armada</span> Kendaraan
                    </h2>
                    <p style="color: #7a8a9a; font-weight: 300;">Pilih kendaraan sesuai kebutuhan Anda</p>
                </div>
            </div>

            <!-- FILTER -->
            <div class="filter-box">
                <form action="{{ route('user.armada') }}" method="GET">
                    <div class="filter-row">
                        <!-- Search -->
                        <div class="search-wrap">
                            <span class="search-icon">🔍</span>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk...">
                        </div>

                        <!-- Sort -->
                        <div class="sort-wrap">
                            <select name="sort">
                                <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                                <option value="termurah" {{ request('sort') == 'termurah' ? 'selected' : '' }}>Termurah</option>
                                <option value="termahal" {{ request('sort') == 'termahal' ? 'selected' : '' }}>Termahal</option>
                            </select>
                        </div>

                        <!-- Harga Range -->
                        <div class="price-wrap">
                            <span class="price-label">Filter Harga:</span>
                            <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Rp Min" min="0">
                            <span class="price-sep">-</span>
                            <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Rp Max" min="0">
                        </div>

                        <!-- Tombol Terapkan -->
                        <div class="btn-wrap">
                            <button type="submit">Terapkan</button>
                        </div>
                    </div>

                    <!-- Filter Lanjutan -->
                    <div class="filter-advanced">
                        <div class="adv-item">
                            <label>🚗 Tipe</label>
                            <select name="type">
                                <option value="">Semua</option>
                                <option value="car" {{ request('type') == 'car' ? 'selected' : '' }}>🚗 Mobil</option>
                                <option value="motorcycle" {{ request('type') == 'motorcycle' ? 'selected' : '' }}>🏍️ Motor</option>
                            </select>
                        </div>
                        <div class="adv-item">
                            <label>📍 Lokasi</label>
                            <select name="location">
                                <option value="">Semua</option>
                                @foreach($locations as $loc)
                                    <option value="{{ $loc }}" {{ request('location') == $loc ? 'selected' : '' }}>{{ $loc }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="adv-item" style="display: flex; align-items: flex-end;">
                            <a href="{{ route('user.armada') }}" class="reset-link">↺ Reset Filter</a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- ARMADA GRID 3x4 -->
            <div class="armada-grid">
                @forelse($vehicles as $vehicle)
                    <div class="armada-card">
                        <div class="image-wrap">
                            @if($vehicle->image)
                                <img src="{{ asset('storage/' . $vehicle->image) }}" alt="{{ $vehicle->name }}">
                            @else
                                <span class="placeholder-icon">{{ $vehicle->vehicle_type == 'car' ? '🚗' : '🏍️' }}</span>
                            @endif
                            <span class="type-badge">{{ $vehicle->vehicle_type == 'car' ? 'Mobil' : 'Motor' }}</span>
                        </div>
                        <div class="body">
                            <h3 class="name">{{ $vehicle->name }}</h3>
                            <div class="specs">
                                <span>{{ $vehicle->brand }}</span>
                                <span class="dot">•</span>
                                <span>{{ $vehicle->year }}</span>
                                <span class="dot">•</span>
                                <span>{{ $vehicle->transmission ?? $vehicle->transmission_motor }}</span>
                                <span class="dot">•</span>
                                <span>{{ $vehicle->vehicle_type == 'car' ? $vehicle->capacity . ' Seat' : $vehicle->capacity . 'cc' }}</span>
                            </div>
                            <div class="price">
                                Rp {{ number_format($vehicle->price_per_day, 0, ',', '.') }}
                                <small>/ hari</small>
                            </div>
                            <div class="info-row">
                                <span class="location">📍 {{ $vehicle->location }}</span>
                                <span class="stock">📦 {{ $vehicle->available_stock }} tersedia</span>
                            </div>
                            <div class="actions">
                                <a href="{{ route('user.armada.detail', $vehicle->id) }}" class="btn-detail">
                                    📋 Detail
                                </a>
                                <form action="{{ route('user.cart.add') }}" method="POST" style="margin:0; width:100%;">
                                    @csrf
                                    <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn-booking" style="width:100%;">
                                        📝 Booking
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <span class="icon">🔍</span>
                        <h3>Tidak ada kendaraan</h3>
                        <p>Coba ubah filter atau cari dengan kata kunci lain</p>
                    </div>
                @endforelse
            </div>

            <!-- PAGINATION -->
            <div class="pagination-wrapper">
                <div class="info-text">
                    Menampilkan <strong>{{ $vehicles->firstItem() ?? 0 }}</strong> - <strong>{{ $vehicles->lastItem() ?? 0 }}</strong> dari <strong>{{ $vehicles->total() }}</strong> armada
                </div>
                <div>
                    {{ $vehicles->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>