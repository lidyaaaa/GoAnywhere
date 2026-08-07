<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Home - GoAnywhere
        </h2>
    </x-slot>

    <!-- ============================================ -->
    <!-- STYLE REDESIGN - ELEGAN DENGAN #43637E      -->
    <!-- ============================================ -->
    <style>
        /* ===== RESET & GLOBAL ===== */
        * {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ===== HERO SECTION ===== */
        .hero-section {
            background: linear-gradient(160deg, #2c3e50, #43637E, #2c3e50);
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 30% 50%, rgba(255, 255, 255, 0.03) 0%, transparent 60%);
            animation: heroGlow 12s ease-in-out infinite alternate;
        }

        @keyframes heroGlow {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(5%, 5%) scale(1.1); }
        }

        .hero-title {
            font-size: 56px;
            font-weight: 800;
            color: #ffffff;
            position: relative;
            z-index: 1;
            line-height: 1.1;
            text-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            letter-spacing: -0.5px;
        }

        .hero-title span {
            color: #f0e6d0;
            background: linear-gradient(135deg, #f0e6d0, #d4c5a0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 24px;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 300;
            letter-spacing: 4px;
            position: relative;
            z-index: 1;
            text-transform: uppercase;
            font-family: 'Georgia', serif;
        }

        .hero-desc {
            color: rgba(255, 255, 255, 0.8);
            font-size: 18px;
            max-width: 500px;
            line-height: 1.8;
            position: relative;
            z-index: 1;
            font-weight: 300;
        }

        .hero-btn-primary {
            background: #43637E;
            color: #ffffff;
            padding: 16px 40px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            letter-spacing: 1px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 12px 40px rgba(67, 99, 126, 0.5), 0 4px 20px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
            display: inline-block;
            text-decoration: none;
            text-transform: uppercase;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .hero-btn-primary:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 20px 60px rgba(67, 99, 126, 0.6), 0 8px 30px rgba(0, 0, 0, 0.4);
            background: #36546b;
        }

        .hero-btn-secondary {
            border: 2px solid rgba(255, 255, 255, 0.5);
            color: #ffffff;
            padding: 16px 40px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            letter-spacing: 1px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            z-index: 1;
            display: inline-block;
            text-decoration: none;
            text-transform: uppercase;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
        }

        .hero-btn-secondary:hover {
            background: #ffffff;
            color: #43637E;
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
            border-color: #ffffff;
        }

        .hero-icon {
            width: 160px;
            height: 160px;
            border-radius: 28px;
            position: relative;
            z-index: 1;
            animation: float 5s ease-in-out infinite;
            filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.3));
            background: radial-gradient(circle at top left, rgba(255, 255, 255, 0.4), rgba(67, 99, 126, 0.18) 45%, transparent 70%);
            border: 1px solid rgba(255, 255, 255, 0.28);
        }

        .hero-icon::before {
            content: '';
            position: absolute;
            width: 32px;
            height: 32px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.8);
            top: 16px;
            left: 20px;
            opacity: 0.7;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(-2deg); }
            50% { transform: translateY(-25px) rotate(2deg); }
        }

        /* ===== ABOUT SECTION ===== */
        .about-section {
            padding: 90px 0;
            background: #f8f6f2;
            position: relative;
        }

        .about-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
        }

        .about-title {
            font-size: 40px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
            font-family: 'Georgia', serif;
        }

        .about-title span {
            color: #43637E;
            position: relative;
        }

        .about-title span::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #43637E, transparent);
        }

        .about-text {
            color: #5a6a7a;
            line-height: 1.9;
            font-size: 16px;
            font-weight: 400;
        }

        .about-highlight {
            background: linear-gradient(135deg, #ffffff, #f0ede8);
            padding: 24px 28px;
            border-radius: 12px;
            border-left: 5px solid #43637E;
            margin-top: 28px;
            box-shadow: 0 8px 30px rgba(67, 99, 126, 0.12), 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .about-highlight p {
            color: #43637E;
            font-weight: 600;
            font-size: 17px;
            letter-spacing: 0.5px;
        }

        /* ===== STAT CARD - 2x2 ===== */
        .stat-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .stat-card {
            background: #ffffff;
            padding: 28px 20px;
            border-radius: 16px;
            text-align: center;
            border: 1px solid #e8e4de;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
            min-height: 140px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .stat-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 60px rgba(67, 99, 126, 0.2), 0 8px 30px rgba(0, 0, 0, 0.12);
            border-color: #43637E;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            margin-bottom: 12px;
            display: block;
            border-radius: 16px;
            background: rgba(67, 99, 126, 0.14);
            position: relative;
        }

        .stat-icon::before {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            border-radius: 999px;
            background: rgba(67, 99, 126, 0.22);
            top: 12px;
            left: 12px;
        }

        .stat-number {
            font-size: 38px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
        }

        .stat-label {
            font-size: 14px;
            color: #7a8a9a;
            font-weight: 500;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* ===== ARMADA CARD ===== */
        .armada-card {
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
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
        }

        .armada-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 24px 80px rgba(67, 99, 126, 0.2), 0 12px 40px rgba(0, 0, 0, 0.15);
            border-color: #43637E;
        }

        .armada-card:hover::before {
            opacity: 1;
        }

        .armada-image {
            height: 220px;
            background: linear-gradient(135deg, #e8e4de, #d5d0c8);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 80px;
            overflow: hidden;
            position: relative;
        }

        .armada-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .armada-card:hover .armada-image img {
            transform: scale(1.05);
        }

        .armada-image::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60%;
            background: linear-gradient(to top, rgba(0,0,0,0.1), transparent);
        }

        .armada-body {
            padding: 20px 22px 24px;
        }

        .armada-name {
            font-size: 20px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
        }

        .armada-spec {
            font-size: 14px;
            color: #7a8a9a;
            margin-top: 6px;
            letter-spacing: 0.5px;
        }

        .armada-spec span {
            margin: 0 4px;
        }

        .armada-price {
            font-size: 28px;
            font-weight: 700;
            color: #43637E;
            margin-top: 12px;
            font-family: 'Georgia', serif;
        }

        .armada-price small {
            font-size: 14px;
            font-weight: 400;
            color: #9aabbb;
        }

        .armada-location {
            font-size: 14px;
            color: #7a8a9a;
            margin-top: 6px;
        }

        .armada-stock {
            font-size: 13px;
            color: #4a7a5a;
            margin-left: 8px;
            background: #e8f4ec;
            padding: 2px 12px;
            border-radius: 20px;
            font-weight: 600;
        }

        .armada-btn {
            display: inline-block;
            width: 100%;
            text-align: center;
            background: #43637E;
            color: #ffffff;
            padding: 12px 0;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            margin-top: 16px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            letter-spacing: 1px;
            text-transform: uppercase;
            box-shadow: 0 4px 15px rgba(67, 99, 126, 0.3);
        }

        .armada-btn:hover {
            background: #36546b;
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(67, 99, 126, 0.4);
        }

        /* ===== ARMADA SECTION BACKGROUND ===== */
        .armada-section {
            padding: 70px 0;
            background: #f8f6f2;
            position: relative;
        }

        .armada-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #f0e6d0, #43637E, #f0e6d0);
        }

        /* ===== ARMADA GRID - PAKSA 3 KOLOM ===== */
        .armada-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
        }

        /* ===== FOOTER ===== */
        .footer {
            background: #2c3e50;
            color: #f0ede8;
            padding: 60px 0 30px;
            position: relative;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
        }

        .footer-title {
            font-size: 28px;
            font-weight: 700;
            font-family: 'Georgia', serif;
            color: #f0ede8;
        }

        .footer-text {
            color: rgba(240, 237, 232, 0.7);
            margin-top: 8px;
            font-weight: 300;
        }

        .footer-heading {
            font-weight: 700;
            margin-bottom: 16px;
            font-size: 16px;
            color: #f0ede8;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .footer-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-list li {
            color: rgba(240, 237, 232, 0.7);
            padding: 6px 0;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .footer-list li:hover {
            color: #f0ede8;
        }

        .footer-divider {
            border-top: 1px solid rgba(240, 237, 232, 0.1);
            margin-top: 40px;
            padding-top: 32px;
            text-align: center;
            color: rgba(240, 237, 232, 0.5);
            font-size: 14px;
            font-weight: 300;
        }

        /* ===== DARK MODE ===== */
        .dark .about-section {
            background: #1a2632;
        }

        .dark .about-section::before {
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
        }

        .dark .about-title {
            color: #f0ede8;
        }

        .dark .about-text {
            color: #b0bec5;
        }

        .dark .about-highlight {
            background: linear-gradient(135deg, #1e2d3d, #2c3e50);
            border-left-color: #43637E;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
        }

        .dark .about-highlight p {
            color: #f0e6d0;
        }

        .dark .stat-card {
            background: #1a2632;
            border-color: #2c3e50;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .dark .stat-card:hover {
            border-color: #43637E;
            box-shadow: 0 20px 60px rgba(67, 99, 126, 0.2), 0 8px 30px rgba(0, 0, 0, 0.3);
        }

        .dark .stat-number {
            color: #f0ede8;
        }

        .dark .armada-section {
            background: #1a2632;
        }

        .dark .armada-card {
            background: #1a2632;
            border-color: #2c3e50;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .dark .armada-card:hover {
            border-color: #43637E;
            box-shadow: 0 24px 80px rgba(67, 99, 126, 0.15), 0 12px 40px rgba(0, 0, 0, 0.3);
        }

        .dark .armada-image {
            background: linear-gradient(135deg, #2c3e50, #1a2632);
        }

        .dark .armada-name {
            color: #f0ede8;
        }

        .dark .armada-spec {
            color: #b0bec5;
        }

        .dark .armada-location {
            color: #b0bec5;
        }

        .dark .armada-stock {
            background: #1e3d2e;
            color: #8abd9a;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .armada-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 34px;
            }
            .hero-subtitle {
                font-size: 18px;
                letter-spacing: 2px;
            }
            .hero-icon {
                font-size: 72px;
            }
            .about-title {
                font-size: 30px;
            }
            .stat-number {
                font-size: 28px;
            }
            .hero-btn-primary,
            .hero-btn-secondary {
                padding: 14px 28px;
                font-size: 14px;
            }
            .armada-price {
                font-size: 24px;
            }
            .stat-grid {
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }
        }

        @media (max-width: 640px) {
            .armada-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
        }

        @media (max-width: 480px) {
            .stat-grid {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }
            .stat-card {
                padding: 16px 12px;
                min-height: 100px;
            }
            .stat-number {
                font-size: 22px;
            }
            .stat-icon {
                font-size: 28px;
            }
        }

        /* ===== SCROLLBAR CUSTOM ===== */
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
    <!-- HERO SECTION                                -->
    <!-- ============================================ -->
    <div class="hero-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                <div>
                    <h1 class="hero-title">
                        <span>GoAnywhere</span>
                    </h1>
                    <p class="hero-subtitle">Mewah. Nyaman. Profesional.</p>
                    <p class="hero-desc">
                        Tawaran hebat dengan harga menarik dari perusahaan rental kendaraan terpercaya se-Jabodetabek.
                    </p>
                    <div style="display: flex; flex-wrap: wrap; gap: 16px; position: relative; z-index: 1; margin-top: 8px;">
                        <a href="{{ route('user.armada') }}" class="hero-btn-primary">
                            Lihat Armada
                        </a>
                        <a href="{{ route('user.layanan') }}" class="hero-btn-secondary">
                            Layanan
                        </a>
                    </div>
                </div>
                <div class="hidden md:block text-center">
                    <div class="hero-icon"></div>
                    <p style="color: rgba(255,255,255,0.6); margin-top: 20px; position: relative; z-index: 1; font-weight: 300; letter-spacing: 2px; font-size: 14px; text-transform: uppercase;">
                        Rental Kendaraan Terpercaya
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================ -->
    <!-- ABOUT SECTION                               -->
    <!-- ============================================ -->
    <div class="about-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                <div>
                    <h2 class="about-title">Tentang <span>GoAnywhere</span></h2>
                    <p class="about-text">
                        GoAnywhere adalah perusahaan penyedia jasa rental kendaraan Jakarta dan sekitarnya untuk harian dan mingguan.
                    </p>
                    <p class="about-text" style="margin-top: 18px;">
                        Layanan sewa atau rental kendaraan yang kami sediakan mulai dari kendaraan operasional hingga kendaraan mewah seperti Toyota Avanza, Honda Civic, hingga Toyota Fortuner.
                    </p>
                    <p class="about-text" style="margin-top: 18px;">
                        Dengan berbagai macam pilihan kendaraan terbaik, kami jamin mampu memenuhi kebutuhan transportasi Anda, terutama dari segi kenyamanan dan keselamatan demi kepuasan Anda dalam perjalanan.
                    </p>
                    <div class="about-highlight">
                        <p>Sewa kendaraan di GoAnywhere sekarang juga! Kami siap melayani Anda sepenuh hati!</p>
                    </div>
                </div>
                <div>
                    <!-- STATISTIK 2x2 -->
                    <div class="stat-grid">
                        <div class="stat-card">
                            <span class="stat-icon"></span>
                            <div class="stat-number">2024</div>
                            <div class="stat-label">Berdiri Sejak</div>
                        </div>
                        <div class="stat-card">
                            <span class="stat-icon"></span>
                            <div class="stat-number">5</div>
                            <div class="stat-label">Lokasi</div>
                        </div>
                        <div class="stat-card">
                            <span class="stat-icon"></span>
                            <div class="stat-number">{{ $totalVehicles }}+</div>
                            <div class="stat-label">Armada</div>
                        </div>
                        <div class="stat-card">
                            <span class="stat-icon"></span>
                            <div class="stat-number">100%</div>
                            <div class="stat-label">Kepercayaan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================ -->
    <!-- ARMADA TERBARU - 3x2 (PAKSA PAKE GRID CSS)  -->
    <!-- ============================================ -->
    <div class="armada-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; flex-wrap: wrap; gap: 16px;">
                <div>
                     <h2 style="font-size: 34px; font-weight: 700; color: #2c3e50; font-family: 'Georgia', serif;">Armada Terbaru</h2>
                    <p style="color: #7a8a9a; margin-top: 4px; font-weight: 300;">Kendaraan pilihan dengan kualitas terbaik</p>
                </div>
                <a href="{{ route('user.armada') }}" style="color: #43637E; font-weight: 600; text-decoration: none; padding: 8px 20px; border: 2px solid #43637E; border-radius: 8px; transition: all 0.3s ease; font-size: 14px; letter-spacing: 0.5px; white-space: nowrap;">
                    Lihat Semua →
                </a>
            </div>

            <!-- PAKAI CSS GRID LANGSUNG - 3 KOLOM -->
            <div class="armada-grid">
                @forelse($latestVehicles as $vehicle)
                    <div class="armada-card">
                        <div class="armada-image">
                            @if($vehicle->image)
                                <img src="{{ asset('storage/' . $vehicle->image) }}" alt="{{ $vehicle->name }}">
                            @else
                                 {{ $vehicle->vehicle_type == 'car' ? 'Car' : 'Motorcycle' }}
                            @endif
                        </div>
                        <div class="armada-body">
                            <h3 class="armada-name">{{ $vehicle->name }}</h3>
                            <div class="armada-spec">
                                <span>{{ $vehicle->brand }}</span>
                                <span>•</span>
                                <span>{{ $vehicle->year }}</span>
                                <span>•</span>
                                <span>{{ $vehicle->transmission ?? $vehicle->transmission_motor }}</span>
                            </div>
                            <div class="armada-price">
                                Rp {{ number_format($vehicle->price_per_day, 0, ',', '.') }}
                                <small>/ hari</small>
                            </div>
                            <div class="armada-location">
                                 {{ $vehicle->location }}
                                 <span class="armada-stock">{{ $vehicle->available_stock }} available</span>
                            </div>
                            <a href="{{ route('user.armada.detail', $vehicle->id) }}" class="armada-btn">
                                 Detail
                            </a>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: span 3; text-align: center; padding: 60px 0; color: #7a8a9a;">
                        <div style="font-size: 56px; margin-bottom: 20px; opacity: 0.5;"></div>
                        <p style="font-size: 18px; font-weight: 300;">Belum ada kendaraan tersedia</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- ============================================ -->
    <!-- FOOTER                                      -->
    <!-- ============================================ -->
    <footer class="footer">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <div>
                    <h3 class="footer-title">GoAnywhere</h3>
                    <p class="footer-text">Solusi rental kendaraan terpercaya</p>
                </div>
                <div>
                    <h4 class="footer-heading">Lokasi</h4>
                    <ul class="footer-list">
                        <li>Jakarta</li>
                        <li>Bogor</li>
                        <li>Depok</li>
                        <li>Tangerang</li>
                        <li>Bekasi</li>
                    </ul>
                </div>
                <div>
                    <h4 class="footer-heading">Kontak</h4>
                    <ul class="footer-list">
                        <li>0812-3456-7890</li>
                        <li>info@goanywhere.com</li>
                    </ul>
                </div>
                <div>
                    <h4 class="footer-heading">Jam Operasional</h4>
                    <ul class="footer-list">
                        <li>Senin - Minggu</li>
                        <li>08:00 - 22:00</li>
                    </ul>
                </div>
            </div>
            <div class="footer-divider">
                &copy; 2024 GoAnywhere. All rights reserved.
            </div>
        </div>
    </footer>
</x-app-layout>