<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            📋 Detail Kendaraan
        </h2>
    </x-slot>

    <!-- ============================================ -->
    <!-- STYLE ELEGAN - #43637E + SHADOW HITAM TEBEL -->
    <!-- ============================================ -->
    <style>
        * {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .detail-section {
            padding: 40px 0 60px;
            background: #f8f6f2;
            position: relative;
            min-height: 100vh;
        }

        .detail-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
        }

        .detail-card {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.25), 0 8px 30px rgba(0, 0, 0, 0.12);
            border: 1px solid #e8e4de;
            transition: all 0.4s ease;
        }

        .detail-card:hover {
            box-shadow: 0 24px 65px rgba(0, 0, 0, 0.35), 0 12px 40px rgba(0, 0, 0, 0.2);
            border-color: #43637E;
        }

        /* ===== TOP ROW: IMAGE + INFO ===== */
        .detail-top {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            min-height: 400px;
        }

        .detail-top .image-wrap {
            background: linear-gradient(135deg, #e8e4de, #d5d0c8);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
            min-height: 400px;
        }

        .detail-top .image-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }

        .detail-top .image-wrap:hover img {
            transform: scale(1.03);
        }

        .detail-top .image-wrap .placeholder-icon {
            font-size: 100px;
            opacity: 0.5;
        }

        .detail-top .image-wrap .type-badge-lg {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            color: #ffffff;
            padding: 8px 24px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 1px;
            z-index: 1;
            text-transform: uppercase;
        }

        /* ===== RIGHT SIDE ===== */
        .detail-top .info-wrap {
            padding: 32px 36px 32px 32px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .detail-top .info-wrap .name {
            font-size: 32px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
            margin-bottom: 4px;
        }

        .detail-top .info-wrap .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 12px;
        }

        .detail-top .info-wrap .tags .tag {
            padding: 6px 18px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .detail-top .info-wrap .tags .tag-brand {
            background: rgba(67, 99, 126, 0.15);
            color: #43637E;
        }

        .detail-top .info-wrap .tags .tag-year {
            background: #f0ede8;
            color: #5a6a7a;
        }

        .detail-top .info-wrap .tags .tag-location {
            background: rgba(67, 99, 126, 0.1);
            color: #43637E;
        }

        /* ===== SPECS MINI ===== */
        .specs-mini {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px 24px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1.5px solid #f0ede8;
        }

        .specs-mini .spec-item .label {
            font-size: 11px;
            color: #9aabbb;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .specs-mini .spec-item .value {
            font-size: 15px;
            font-weight: 600;
            color: #2c3e50;
            margin-top: 2px;
        }

        .specs-mini .spec-item .value .stock-badge {
            color: #4a7a5a;
            background: #e8f4ec;
            padding: 2px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
        }

        /* ===== PRICE ===== */
        .price-box {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1.5px solid #f0ede8;
        }

        .price-box .price-value {
            font-size: 34px;
            font-weight: 700;
            color: #43637E;
            font-family: 'Georgia', serif;
        }

        .price-box .price-value small {
            font-size: 16px;
            font-weight: 400;
            color: #9aabbb;
        }

        .price-box .price-note {
            font-size: 13px;
            color: #7a8a9a;
            margin-top: 4px;
        }

        .price-box .price-note strong {
            color: #43637E;
        }

        /* ===== BOTTOM: DESCRIPTION + TERMS + BOOKING ===== */
        .detail-bottom {
            padding: 32px 44px 44px;
        }

        .detail-bottom .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
            margin-bottom: 12px;
        }

        .detail-bottom .section-title .icon {
            margin-right: 8px;
        }

        .detail-bottom .divider {
            border: none;
            border-top: 1.5px solid #f0ede8;
            margin: 24px 0;
        }

        .dark .detail-bottom .divider {
            border-top-color: #2c3e50;
        }

        .dark .specs-mini {
            border-top-color: #2c3e50;
        }

        .dark .price-box {
            border-top-color: #2c3e50;
        }

        /* ===== DESCRIPTION ===== */
        .desc-text {
            color: #5a6a7a;
            font-size: 15px;
            line-height: 1.9;
            font-weight: 300;
        }

        /* ===== TERMS ===== */
        .terms-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4px 24px;
        }

        .terms-list li {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px 0;
            font-size: 14px;
            color: #5a6a7a;
        }

        .terms-list li::before {
            content: '✅';
            font-size: 14px;
            flex-shrink: 0;
        }

        /* ===== BOOKING FORM ===== */
        .booking-form {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            gap: 16px;
            background: rgba(67, 99, 126, 0.04);
            padding: 20px 24px;
            border-radius: 12px;
            border: 1px solid rgba(67, 99, 126, 0.08);
        }

        .booking-form .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #43637E;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .booking-form .form-group input {
            padding: 11px 16px;
            border-radius: 10px;
            border: 1.5px solid #e8e4de;
            font-size: 15px;
            background: #faf8f5;
            transition: all 0.3s ease;
            color: #2c3e50;
            width: 120px;
        }

        .booking-form .form-group input:focus {
            border-color: #43637E;
            box-shadow: 0 0 0 4px rgba(67, 99, 126, 0.12);
            outline: none;
            background: #ffffff;
        }

        .booking-form .btn-booking-lg {
            background: #43637E;
            color: #ffffff;
            padding: 13px 44px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 15px;
            letter-spacing: 1px;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 8px 30px rgba(67, 99, 126, 0.4);
        }

        .booking-form .btn-booking-lg:hover {
            background: #36546b;
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(67, 99, 126, 0.5);
        }

        /* ===== BACK LINK ===== */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #43637E;
            font-weight: 600;
            font-size: 15px;
            text-decoration: none;
            transition: all 0.3s ease;
            padding: 8px 0;
            margin-top: 4px;
        }

        .back-link:hover {
            color: #36546b;
            transform: translateX(-4px);
        }

        /* ===== DARK MODE ===== */
        .dark .detail-section {
            background: #1a2632;
        }

        .dark .detail-section::before {
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
        }

        .dark .detail-card {
            background: #1a2632;
            border-color: #2c3e50;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.5), 0 8px 30px rgba(0, 0, 0, 0.3);
        }

        .dark .detail-card:hover {
            border-color: #43637E;
            box-shadow: 0 24px 65px rgba(0, 0, 0, 0.6), 0 12px 40px rgba(0, 0, 0, 0.4);
        }

        .dark .detail-top .info-wrap .name {
            color: #f0ede8;
        }

        .dark .detail-top .info-wrap .tags .tag-brand {
            background: rgba(67, 99, 126, 0.3);
            color: #f0e6d0;
        }

        .dark .detail-top .info-wrap .tags .tag-year {
            background: #2c3e50;
            color: #b0bec5;
        }

        .dark .detail-top .info-wrap .tags .tag-location {
            background: rgba(67, 99, 126, 0.25);
            color: #f0e6d0;
        }

        .dark .specs-mini .spec-item .value {
            color: #f0ede8;
        }

        .dark .specs-mini .spec-item .value .stock-badge {
            background: #1e3d2e;
            color: #8abd9a;
        }

        .dark .price-box .price-note {
            color: #b0bec5;
        }

        .dark .detail-bottom .section-title {
            color: #f0ede8;
        }

        .dark .desc-text {
            color: #b0bec5;
        }

        .dark .terms-list li {
            color: #b0bec5;
        }

        .dark .booking-form {
            background: rgba(67, 99, 126, 0.1);
            border-color: rgba(67, 99, 126, 0.15);
        }

        .dark .booking-form .form-group label {
            color: #f0e6d0;
        }

        .dark .booking-form .form-group input {
            background: #0f1a24;
            border-color: #2c3e50;
            color: #f0ede8;
        }

        .dark .booking-form .form-group input:focus {
            border-color: #43637E;
            background: #1a2632;
        }

        .dark .back-link {
            color: #f0e6d0;
        }

        .dark .back-link:hover {
            color: #ffffff;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 900px) {
            .detail-top {
                grid-template-columns: 1fr;
                min-height: auto;
            }

            .detail-top .image-wrap {
                min-height: 300px;
            }

            .detail-top .info-wrap {
                padding: 24px 28px;
            }

            .detail-bottom {
                padding: 24px 28px 32px;
            }

            .terms-list {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .detail-top .image-wrap {
                min-height: 250px;
            }

            .detail-top .info-wrap .name {
                font-size: 26px;
            }

            .specs-mini {
                grid-template-columns: 1fr 1fr;
                gap: 4px 16px;
            }

            .price-box .price-value {
                font-size: 28px;
            }

            .booking-form {
                flex-direction: column;
                align-items: stretch;
                padding: 16px 18px;
            }

            .booking-form .form-group input {
                width: 100%;
            }

            .booking-form .btn-booking-lg {
                width: 100%;
                text-align: center;
                padding: 14px;
            }

            .detail-top .image-wrap .type-badge-lg {
                font-size: 12px;
                padding: 6px 16px;
                top: 14px;
                right: 14px;
            }

            .detail-bottom {
                padding: 20px 18px 24px;
            }
        }

        @media (max-width: 480px) {
            .detail-section {
                padding: 24px 0 40px;
            }

            .detail-top .image-wrap {
                min-height: 200px;
            }

            .detail-top .info-wrap {
                padding: 18px 16px;
            }

            .detail-top .info-wrap .name {
                font-size: 22px;
            }

            .detail-top .info-wrap .tags .tag {
                font-size: 11px;
                padding: 4px 14px;
            }

            .specs-mini {
                grid-template-columns: 1fr 1fr;
                gap: 2px 12px;
            }

            .specs-mini .spec-item .value {
                font-size: 14px;
            }

            .price-box .price-value {
                font-size: 24px;
            }

            .price-box .price-value small {
                font-size: 14px;
            }

            .detail-bottom .section-title {
                font-size: 16px;
            }

            .booking-form .btn-booking-lg {
                font-size: 13px;
                padding: 12px;
            }

            .terms-list li {
                font-size: 13px;
                padding: 4px 0;
            }

            .detail-bottom {
                padding: 16px 14px 20px;
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
    <!-- DETAIL SECTION                              -->
    <!-- ============================================ -->
    <div class="detail-section">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="detail-card">

                <!-- ===== TOP ROW: IMAGE + INFO ===== -->
                <div class="detail-top">
                    <!-- KIRI: Gambar -->
                    <div class="image-wrap">
                        @if($vehicle->image)
                            <img src="{{ asset('storage/' . $vehicle->image) }}" alt="{{ $vehicle->name }}">
                        @else
                            <span class="placeholder-icon">{{ $vehicle->vehicle_type == 'car' ? '🚗' : '🏍️' }}</span>
                        @endif
                        <span class="type-badge-lg">{{ $vehicle->vehicle_type == 'car' ? '🚗 Mobil' : '🏍️ Motor' }}</span>
                    </div>

                    <!-- KANAN: Nama + Tags + Spesifikasi + Harga -->
                    <div class="info-wrap">
                        <h1 class="name">{{ $vehicle->name }}</h1>
                        <div class="tags">
                            <span class="tag tag-brand">{{ $vehicle->brand }}</span>
                            <span class="tag tag-year">{{ $vehicle->year }}</span>
                            <span class="tag tag-location">📍 {{ $vehicle->location }}</span>
                        </div>

                        <!-- Spesifikasi Mini -->
                        <div class="specs-mini">
                            <div class="spec-item">
                                <div class="label">Tipe</div>
                                <div class="value">{{ $vehicle->vehicle_type == 'car' ? 'Mobil' : 'Motor' }}</div>
                            </div>
                            <div class="spec-item">
                                <div class="label">Kapasitas</div>
                                <div class="value">{{ $vehicle->vehicle_type == 'car' ? $vehicle->capacity . ' Orang' : $vehicle->capacity . ' cc' }}</div>
                            </div>
                            <div class="spec-item">
                                <div class="label">Transmisi</div>
                                <div class="value">{{ $vehicle->transmission ?? $vehicle->transmission_motor }}</div>
                            </div>
                            <div class="spec-item">
                                <div class="label">Warna</div>
                                <div class="value">{{ $vehicle->color }}</div>
                            </div>
                            <div class="spec-item">
                                <div class="label">BBM</div>
                                <div class="value">{{ $vehicle->fuel }}</div>
                            </div>
                            <div class="spec-item">
                                <div class="label">Stok</div>
                                <div class="value"><span class="stock-badge">📦 {{ $vehicle->available_stock }} tersedia</span></div>
                            </div>
                        </div>

                        <!-- Harga -->
                        <div class="price-box">
                            <div class="price-value">
                                Rp {{ number_format($vehicle->price_per_day, 0, ',', '.') }}
                                <small>/ hari</small>
                            </div>
                            <div class="price-note">
                                ⚠️ Maksimal sewa <strong>7 hari</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===== BOTTOM: Deskripsi + Syarat + Booking ===== -->
                <div class="detail-bottom">
                    <!-- Deskripsi -->
                    @if($vehicle->description)
                        <h2 class="section-title"><span class="icon">📝</span> Deskripsi</h2>
                        <p class="desc-text">{{ $vehicle->description }}</p>
                        <hr class="divider">
                    @endif

                    <!-- Syarat & Ketentuan -->
                    <h2 class="section-title"><span class="icon">📋</span> Syarat & Ketentuan</h2>
                    <ul class="terms-list">
                        <li>Wajib memiliki SIM {{ $vehicle->vehicle_type == 'car' ? 'A/C' : 'C' }}</li>
                        <li>Usia minimal {{ $vehicle->vehicle_type == 'car' ? '18' : '17' }} tahun</li>
                        <li>Dilarang digunakan untuk aktivitas ilegal</li>
                        <li>Dilarang dipinjamkan ke orang lain</li>
                        <li>Denda keterlambatan: Rp 50.000/jam</li>
                        <li>Biaya reparasi jika terjadi kerusakan</li>
                        <li>Waktu toleransi pengembalian: 30 menit</li>
                        @if($vehicle->vehicle_type == 'motorcycle')
                            <li>Wajib menggunakan helm</li>
                        @endif
                    </ul>

                    <hr class="divider">

                    <!-- Booking Form -->
                    <form action="{{ route('user.cart.add') }}" method="POST" class="booking-form">
                        @csrf
                        <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                        <div class="form-group">
                            <label>📅 Jumlah Hari (Max 7)</label>
                            <input type="number" name="quantity" value="1" min="1" max="7">
                        </div>
                        <button type="submit" class="btn-booking-lg">
                            📝 Booking Sekarang
                        </button>
                    </form>

                    <!-- Back Link -->
                    <a href="{{ route('user.armada') }}" class="back-link">
                        ← Kembali ke Armada
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>