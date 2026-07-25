<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GoAnywhere - Rental Kendaraan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Georgia&display=swap');

        * {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ===== BACKGROUND ===== */
        .landing-page {
            background: #f8f6f2;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .landing-page::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
            z-index: 10;
        }

        /* ============================================ */
        /* NAVBAR - ELEGAN #43637E                      */
        /* ============================================ */
        .navbar {
            background: #ffffff;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08), 0 2px 10px rgba(0, 0, 0, 0.04);
            position: relative;
            z-index: 20;
            padding: 0 24px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.03);
        }

        .navbar .brand {
            font-size: 26px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
            letter-spacing: -0.5px;
        }

        .navbar .brand .highlight {
            color: #43637E;
            position: relative;
        }

        .navbar .brand .highlight::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            right: 0;
            height: 2.5px;
            background: linear-gradient(90deg, #43637E, #f0e6d0);
            border-radius: 4px;
        }

        .navbar .nav-link {
            color: #5a6a7a;
            font-weight: 600;
            text-decoration: none;
            padding: 8px 20px;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .navbar .nav-link:hover {
            color: #43637E;
            background: rgba(67, 99, 126, 0.06);
            transform: translateY(-1px);
        }

        .navbar .btn-login {
            background: transparent;
            color: #43637E;
            border: 2px solid #43637E;
            padding: 8px 28px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .navbar .btn-login:hover {
            background: #43637E;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(67, 99, 126, 0.3);
        }

        .navbar .btn-register {
            background: #43637E;
            color: #ffffff;
            padding: 8px 28px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 6px 25px rgba(67, 99, 126, 0.35);
        }

        .navbar .btn-register:hover {
            background: #36546b;
            transform: translateY(-2px);
            box-shadow: 0 10px 35px rgba(67, 99, 126, 0.45);
        }

        /* ============================================ */
        /* HERO                                         */
        /* ============================================ */
        .hero-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 24px 40px;
        }

        .hero-content {
            max-width: 900px;
            width: 100%;
            text-align: center;
        }

        .hero-icon {
            font-size: 100px;
            display: inline-block;
            animation: float 5s ease-in-out infinite;
            filter: drop-shadow(0 20px 50px rgba(67, 99, 126, 0.15));
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(-2deg) scale(1); }
            50% { transform: translateY(-25px) rotate(2deg) scale(1.05); }
        }

        .hero-title {
            font-size: 56px;
            font-weight: 800;
            color: #2c3e50;
            font-family: 'Georgia', serif;
            line-height: 1.1;
            margin-top: 8px;
        }

        .hero-title .highlight {
            color: #43637E;
            position: relative;
        }

        .hero-title .highlight::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #43637E, #f0e6d0);
            border-radius: 4px;
        }

        .hero-desc {
            font-size: 20px;
            color: #7a8a9a;
            font-weight: 300;
            max-width: 600px;
            margin: 18px auto 0;
            line-height: 1.8;
            letter-spacing: 0.3px;
        }

        .hero-locations {
            font-size: 16px;
            color: #9aabbb;
            margin-top: 10px;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .hero-locations .loc {
            color: #43637E;
            font-weight: 700;
        }

        .hero-locations .dot {
            color: #d5d0c8;
            margin: 0 4px;
        }

        .hero-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 16px;
            margin-top: 36px;
        }

        .btn-primary {
            display: inline-block;
            background: #43637E;
            color: #ffffff;
            padding: 16px 48px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 17px;
            text-decoration: none;
            transition: all 0.4s ease;
            box-shadow: 0 12px 40px rgba(67, 99, 126, 0.4), 0 4px 20px rgba(0, 0, 0, 0.08);
            letter-spacing: 0.5px;
        }

        .btn-primary:hover {
            background: #36546b;
            transform: translateY(-4px);
            box-shadow: 0 20px 60px rgba(67, 99, 126, 0.5), 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .btn-secondary {
            display: inline-block;
            border: 2px solid #43637E;
            color: #43637E;
            padding: 16px 48px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 17px;
            text-decoration: none;
            transition: all 0.4s ease;
            background: transparent;
            letter-spacing: 0.5px;
        }

        .btn-secondary:hover {
            background: #43637E;
            color: #ffffff;
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(67, 99, 126, 0.3);
        }

        /* ============================================ */
        /* FEATURES                                     */
        /* ============================================ */
        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
            margin-top: 60px;
        }

        .feature-card {
            background: #ffffff;
            padding: 32px 24px 28px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1), 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid #e8e4de;
            transition: all 0.4s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 28px 70px rgba(0, 0, 0, 0.18), 0 12px 40px rgba(0, 0, 0, 0.08);
            border-color: #43637E;
        }

        .feature-card .icon {
            font-size: 44px;
            margin-bottom: 12px;
            display: block;
        }

        .feature-card h3 {
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
        }

        .feature-card p {
            font-size: 14px;
            color: #7a8a9a;
            margin-top: 4px;
            font-weight: 300;
        }

        /* ============================================ */
        /* FOOTER                                       */
        /* ============================================ */
        .footer {
            background: #2c3e50;
            color: #f0ede8;
            padding: 32px 0;
            position: relative;
            margin-top: auto;
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

        .footer .footer-text {
            color: rgba(240, 237, 232, 0.5);
            font-size: 14px;
            font-weight: 300;
            letter-spacing: 0.5px;
        }

        /* ============================================ */
        /* DARK MODE                                    */
        /* ============================================ */
        .dark .landing-page {
            background: #1a2632;
        }

        .dark .landing-page::before {
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
        }

        .dark .navbar {
            background: #1a2632;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
            border-bottom-color: rgba(255, 255, 255, 0.03);
        }

        .dark .navbar .brand {
            color: #f0ede8;
        }

        .dark .navbar .brand .highlight {
            color: #f0e6d0;
        }

        .dark .navbar .brand .highlight::after {
            background: linear-gradient(90deg, #f0e6d0, #43637E);
        }

        .dark .navbar .nav-link {
            color: #b0bec5;
        }

        .dark .navbar .nav-link:hover {
            color: #f0e6d0;
            background: rgba(67, 99, 126, 0.15);
        }

        .dark .navbar .btn-login {
            color: #f0e6d0;
            border-color: #f0e6d0;
        }

        .dark .navbar .btn-login:hover {
            background: #f0e6d0;
            color: #1a2632;
        }

        .dark .hero-title {
            color: #f0ede8;
        }

        .dark .hero-desc {
            color: #b0bec5;
        }

        .dark .hero-locations {
            color: #5a6a7a;
        }

        .dark .hero-locations .loc {
            color: #f0e6d0;
        }

        .dark .feature-card {
            background: #1a2632;
            border-color: #2c3e50;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3), 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .dark .feature-card:hover {
            border-color: #43637E;
            box-shadow: 0 28px 70px rgba(0, 0, 0, 0.4), 0 12px 40px rgba(0, 0, 0, 0.2);
        }

        .dark .feature-card h3 {
            color: #f0ede8;
        }

        .dark .feature-card p {
            color: #b0bec5;
        }

        .dark .footer {
            background: #0f1a24;
        }

        /* ============================================ */
        /* RESPONSIVE                                   */
        /* ============================================ */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 36px;
            }

            .hero-icon {
                font-size: 72px;
            }

            .hero-desc {
                font-size: 17px;
            }

            .hero-locations {
                font-size: 14px;
            }

            .btn-primary,
            .btn-secondary {
                padding: 14px 32px;
                font-size: 15px;
            }

            .features {
                grid-template-columns: 1fr;
                gap: 16px;
                margin-top: 40px;
            }

            .navbar .brand {
                font-size: 22px;
            }

            .navbar .nav-link {
                font-size: 13px;
                padding: 6px 14px;
            }

            .navbar .btn-login,
            .navbar .btn-register {
                font-size: 13px;
                padding: 6px 18px;
            }
        }

        @media (max-width: 480px) {
            .hero-section {
                padding: 40px 16px 30px;
            }

            .hero-title {
                font-size: 28px;
            }

            .hero-desc {
                font-size: 15px;
            }

            .hero-icon {
                font-size: 56px;
            }

            .hero-locations {
                font-size: 13px;
                line-height: 1.6;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
                gap: 12px;
            }

            .btn-primary,
            .btn-secondary {
                padding: 12px 28px;
                font-size: 14px;
                width: 100%;
                max-width: 280px;
                text-align: center;
            }

            .features {
                gap: 12px;
                margin-top: 32px;
            }

            .feature-card {
                padding: 20px 16px;
            }

            .feature-card .icon {
                font-size: 32px;
            }

            .feature-card h3 {
                font-size: 16px;
            }

            .navbar {
                padding: 0 12px;
            }

            .navbar .brand {
                font-size: 18px;
            }

            .navbar .nav-link {
                font-size: 12px;
                padding: 4px 10px;
            }

            .navbar .btn-login,
            .navbar .btn-register {
                font-size: 12px;
                padding: 5px 14px;
            }

            .footer .footer-text {
                font-size: 12px;
            }
        }

        /* ============================================ */
        /* SCROLLBAR                                    */
        /* ============================================ */
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
</head>
<body class="landing-page dark:bg-gray-900">

    <!-- ===== NAVBAR ===== -->
    <nav class="navbar">
        <div class="max-w-7xl mx-auto flex justify-between items-center h-16">
            <div class="flex items-center">
                <span class="brand">🚗 <span class="highlight">GoAnywhere</span></span>
            </div>
            <div class="flex items-center gap-2 sm:gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="nav-link">📊 Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-login">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-register">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- ===== HERO ===== -->
    <main class="hero-section">
        <div class="hero-content">

            <!-- Icon -->
            <div class="hero-icon">🚗</div>

            <!-- Title -->
            <h1 class="hero-title">
                Welcome to <span class="highlight">GoAnywhere</span>
            </h1>

            <!-- Description -->
            <p class="hero-desc">
                Solusi rental kendaraan terpercaya di Jabodetabek.<br>
                Tersedia mobil dan motor dengan harga terjangkau.
            </p>

            <!-- Locations -->
            <p class="hero-locations">
                📍 <span class="loc">5 Lokasi</span>
                <span class="dot">•</span> Jakarta
                <span class="dot">•</span> Bogor
                <span class="dot">•</span> Depok
                <span class="dot">•</span> Tangerang
                <span class="dot">•</span> Bekasi
            </p>

            <!-- Buttons -->
            <div class="hero-buttons">
                <a href="{{ route('login') }}" class="btn-primary">
                    🚀 Mulai Sekarang
                </a>
            </div>

            <!-- Features -->
            <div class="features">
                <div class="feature-card">
                    <span class="icon">🚗</span>
                    <h3>Mobil & Motor</h3>
                    <p>Pilihan kendaraan lengkap</p>
                </div>
                <div class="feature-card">
                    <span class="icon">💰</span>
                    <h3>Harga Terjangkau</h3>
                    <p>Mulai dari Rp 120.000/hari</p>
                </div>
                <div class="feature-card">
                    <span class="icon">📍</span>
                    <h3>5 Lokasi</h3>
                    <p>Jabodetabek</p>
                </div>
            </div>

        </div>
    </main>

    <!-- ===== FOOTER ===== -->
    <footer class="footer">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="footer-text">
                &copy; 2024 GoAnywhere. All rights reserved.
            </p>
        </div>
    </footer>

</body>
</html>