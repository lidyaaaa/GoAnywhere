<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            📋 Layanan GoAnywhere
        </h2>
    </x-slot>

    <!-- ============================================ -->
    <!-- STYLE ELEGAN - #43637E + SHADOW HITAM TEBEL -->
    <!-- ============================================ -->
    <style>
        /* ===== RESET & GLOBAL ===== */
        * {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ===== LAYANAN SECTION ===== */
        .layanan-section {
            padding: 80px 0 100px;
            background: #f8f6f2;
            position: relative;
        }

        .layanan-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
        }

        .layanan-title {
            font-size: 48px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
            margin-bottom: 8px;
        }

        .layanan-title span {
            color: #43637E;
            position: relative;
        }

        .layanan-title span::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #43637E, transparent);
        }

        .layanan-subtitle {
            color: #7a8a9a;
            font-size: 18px;
            font-weight: 300;
            letter-spacing: 1px;
        }

        /* ===== LAYANAN CARD - BERSEMBELAHAN ===== */
        .layanan-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            max-width: 1100px;
            margin: 0 auto;
        }

        .layanan-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 44px 36px 40px;
            text-align: center;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.3), 0 8px 30px rgba(0, 0, 0, 0.15);
            border: 1px solid #e8e4de;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .layanan-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .layanan-card::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(67, 99, 126, 0.03) 0%, transparent 70%);
            pointer-events: none;
        }

        .layanan-card:hover {
            transform: translateY(-16px);
            box-shadow: 0 28px 70px rgba(0, 0, 0, 0.4), 0 16px 45px rgba(0, 0, 0, 0.2);
            border-color: #43637E;
        }

        .layanan-card:hover::before {
            opacity: 1;
        }

        .layanan-card .icon {
            font-size: 72px;
            margin-bottom: 16px;
            display: block;
            position: relative;
            z-index: 1;
        }

        .layanan-card h3 {
            font-size: 26px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
            position: relative;
            z-index: 1;
        }

        .layanan-card .price {
            font-size: 36px;
            font-weight: 700;
            color: #43637E;
            margin-top: 8px;
            font-family: 'Georgia', serif;
            position: relative;
            z-index: 1;
        }

        .layanan-card .price small {
            font-size: 18px;
            font-weight: 400;
            color: #9aabbb;
        }

        .layanan-card .desc {
            color: #7a8a9a;
            margin-top: 12px;
            font-weight: 300;
            font-size: 16px;
            position: relative;
            z-index: 1;
        }

        .layanan-card .badge {
            display: inline-block;
            padding: 8px 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            margin-top: 14px;
            letter-spacing: 0.5px;
            background: rgba(67, 99, 126, 0.12);
            color: #43637E;
            position: relative;
            z-index: 1;
        }

        .layanan-card .feature-list {
            list-style: none;
            padding: 0;
            margin: 18px 0 0;
            text-align: left;
            position: relative;
            z-index: 1;
        }

        .layanan-card .feature-list li {
            color: #5a6a7a;
            font-size: 15px;
            padding: 8px 0;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 400;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        }

        .layanan-card .feature-list li:last-child {
            border-bottom: none;
        }

        .layanan-card .feature-list li::before {
            content: '✦';
            color: #43637E;
            font-size: 16px;
            font-weight: 700;
        }

        .layanan-btn {
            display: inline-block;
            margin-top: 24px;
            background: #43637E;
            color: #ffffff;
            padding: 14px 40px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 15px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 30px rgba(67, 99, 126, 0.45), 0 4px 20px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            z-index: 1;
        }

        .layanan-btn:hover {
            background: #2c4a5e;
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 14px 45px rgba(67, 99, 126, 0.55), 0 8px 30px rgba(0, 0, 0, 0.25);
        }

        /* ===== INFO BOX ===== */
        .info-grid {
            max-width: 1100px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-top: 50px;
        }

        .info-box {
            border-radius: 20px;
            padding: 32px 36px;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.25), 0 8px 30px rgba(0, 0, 0, 0.12);
            border: 1px solid #e8e4de;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: #ffffff;
        }

        .info-box:hover {
            box-shadow: 0 24px 65px rgba(0, 0, 0, 0.35), 0 12px 40px rgba(0, 0, 0, 0.2);
            border-color: #43637E;
            transform: translateY(-6px);
        }

        .info-box .icon {
            font-size: 32px;
            flex-shrink: 0;
        }

        .info-box h4 {
            font-weight: 700;
            color: #2c3e50;
            font-size: 20px;
            font-family: 'Georgia', serif;
        }

        .info-box p,
        .info-box li {
            color: #5a6a7a;
            font-size: 15px;
            font-weight: 300;
        }

        .info-box strong {
            color: #43637E;
            font-weight: 600;
        }

        .location-tag {
            display: inline-block;
            background: rgba(67, 99, 126, 0.1);
            color: #43637E;
            padding: 8px 24px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .location-tag:hover {
            background: #43637E;
            color: #ffffff;
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 10px 30px rgba(67, 99, 126, 0.35);
        }

        .info-box .rule-list {
            list-style: none;
            padding: 0;
            margin: 8px 0 0;
        }

        .info-box .rule-list li {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px 0;
            font-size: 15px;
            color: #5a6a7a;
        }

        .info-box .rule-list li::before {
            content: '✅';
            font-size: 16px;
        }

        /* ===== DARK MODE ===== */
        .dark .layanan-section {
            background: #1a2632;
        }

        .dark .layanan-section::before {
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
        }

        .dark .layanan-title {
            color: #f0ede8;
        }

        .dark .layanan-subtitle {
            color: #b0bec5;
        }

        .dark .layanan-card {
            background: #1a2632;
            border-color: #2c3e50;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.5), 0 8px 30px rgba(0, 0, 0, 0.3);
        }

        .dark .layanan-card:hover {
            border-color: #43637E;
            box-shadow: 0 28px 70px rgba(0, 0, 0, 0.6), 0 16px 45px rgba(0, 0, 0, 0.4);
        }

        .dark .layanan-card h3 {
            color: #f0ede8;
        }

        .dark .layanan-card .desc {
            color: #b0bec5;
        }

        .dark .layanan-card .feature-list li {
            color: #b0bec5;
            border-bottom-color: rgba(255, 255, 255, 0.05);
        }

        .dark .layanan-card .badge {
            background: rgba(67, 99, 126, 0.3);
            color: #f0e6d0;
        }

        .dark .info-box {
            background: #1a2632;
            border-color: #2c3e50;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.5), 0 8px 30px rgba(0, 0, 0, 0.3);
        }

        .dark .info-box:hover {
            border-color: #43637E;
            box-shadow: 0 24px 65px rgba(0, 0, 0, 0.6), 0 12px 40px rgba(0, 0, 0, 0.4);
        }

        .dark .info-box h4 {
            color: #f0ede8;
        }

        .dark .info-box p,
        .dark .info-box li {
            color: #b0bec5;
        }

        .dark .info-box strong {
            color: #f0e6d0;
        }

        .dark .info-box .rule-list li {
            color: #b0bec5;
        }

        .dark .location-tag {
            background: rgba(67, 99, 126, 0.3);
            color: #f0e6d0;
        }

        .dark .location-tag:hover {
            background: #43637E;
            color: #ffffff;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 900px) {
            .layanan-grid {
                grid-template-columns: 1fr 1fr;
                gap: 28px;
            }
            .info-grid {
                grid-template-columns: 1fr;
                gap: 28px;
            }
        }

        @media (max-width: 768px) {
            .layanan-title {
                font-size: 32px;
            }
            .layanan-card {
                padding: 30px 22px 28px;
            }
            .layanan-card .price {
                font-size: 28px;
            }
            .layanan-card .icon {
                font-size: 52px;
            }
            .layanan-card h3 {
                font-size: 22px;
            }
            .info-box {
                padding: 24px 22px;
            }
            .layanan-grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }
        }

        @media (max-width: 480px) {
            .layanan-title {
                font-size: 26px;
            }
            .layanan-card {
                padding: 24px 16px 22px;
            }
            .layanan-card .price {
                font-size: 24px;
            }
            .layanan-card .price small {
                font-size: 14px;
            }
            .layanan-btn {
                padding: 12px 28px;
                font-size: 13px;
            }
            .location-tag {
                font-size: 12px;
                padding: 6px 16px;
            }
            .info-box {
                padding: 18px 16px;
            }
            .layanan-card .feature-list li {
                font-size: 13px;
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
    <!-- LAYANAN SECTION                             -->
    <!-- ============================================ -->
    <div class="layanan-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- HEADER -->
            <div class="text-center mb-16">
                <h1 class="layanan-title">💎 <span>Layanan Kami</span></h1>
                <p class="layanan-subtitle">Pilihan layanan rental kendaraan sesuai kebutuhan Anda</p>
            </div>

            <!-- LAYANAN CARDS - 2 KOLOM BERSEMBELAHAN -->
            <div class="layanan-grid">
                <!-- Sewa Harian -->
                <div class="layanan-card">
                    <span class="icon">📅</span>
                    <h3>Sewa Harian</h3>
                    <div class="price">Rp 120.000 <small>/ hari</small></div>
                    <p class="desc">Fleksibel untuk kebutuhan harian Anda</p>
                    <div class="badge">⚠️ Maksimal 7 Hari</div>
                    <ul class="feature-list">
                        <li>Bebas pilih kendaraan</li>
                        <li>Bebas pilih lokasi</li>
                        <li>Harga transparan</li>
                    </ul>
                    <a href="{{ route('user.armada') }}" class="layanan-btn">
                        Lihat Armada →
                    </a>
                </div>

                <!-- Sewa Mingguan -->
                <div class="layanan-card">
                    <span class="icon">📆</span>
                    <h3>Sewa Mingguan</h3>
                    <div class="price">Rp 700.000 <small>/ minggu</small></div>
                    <p class="desc">Lebih hemat untuk sewa 7 hari</p>
                    <div class="badge">⚠️ Maksimal 1 Minggu</div>
                    <ul class="feature-list">
                        <li>Diskon 10%</li>
                        <li>Bebas pilih kendaraan</li>
                        <li>Bebas pilih lokasi</li>
                    </ul>
                    <a href="{{ route('user.armada') }}" class="layanan-btn">
                        Lihat Armada →
                    </a>
                </div>
            </div>

            <!-- INFO BOX - 2 KOLOM BERSEMBELAHAN -->
            <div class="info-grid">
                <!-- Lokasi -->
                <div class="info-box">
                    <div class="flex items-start gap-5">
                        <span class="icon">📍</span>
                        <div style="flex: 1;">
                            <h4>Lokasi Pengambilan</h4>
                            <p class="mt-1">
                                Anda bisa mengambil kendaraan di 5 lokasi kami:
                            </p>
                            <div class="flex flex-wrap gap-3 mt-4">
                                <span class="location-tag">Jakarta</span>
                                <span class="location-tag">Bogor</span>
                                <span class="location-tag">Depok</span>
                                <span class="location-tag">Tangerang</span>
                                <span class="location-tag">Bekasi</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Aturan Sewa -->
                <div class="info-box">
                    <div class="flex items-start gap-5">
                        <span class="icon">⏰</span>
                        <div style="flex: 1;">
                            <h4>Aturan Sewa</h4>
                            <ul class="rule-list">
                                <li>Maksimal sewa <strong>7 hari</strong> untuk harian</li>
                                <li>Maksimal sewa <strong>1 minggu</strong> untuk mingguan</li>
                                <li>Pengembalian tepat waktu dengan toleransi 30 menit</li>
                                <li>Denda keterlambatan <strong>Rp 50.000/jam</strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>