<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <!-- ============================================ -->
    <!-- STYLE ELEGAN - #43637E + SHADOW HITAM TEBEL -->
    <!-- ============================================ -->
    <style>
        * {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .dashboard-section {
            padding: 40px 0 60px;
            background: #f8f6f2;
            position: relative;
            min-height: 100vh;
        }

        .dashboard-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
        }

        /* ===== WELCOME CARD ===== */
        .welcome-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 40px 44px 44px;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.2), 0 8px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid #e8e4de;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .welcome-card::before {
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

        .welcome-card:hover {
            box-shadow: 0 24px 65px rgba(0, 0, 0, 0.3), 0 12px 40px rgba(0, 0, 0, 0.15);
            border-color: #43637E;
        }

        .welcome-card:hover::before {
            opacity: 1;
        }

        .welcome-card .greeting {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .welcome-card .greeting .icon {
            font-size: 40px;
        }

        .welcome-card .greeting h1 {
            font-size: 32px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
        }

        .welcome-card .greeting h1 .highlight {
            color: #43637E;
        }

        .welcome-card .desc {
            font-size: 16px;
            color: #7a8a9a;
            margin-top: 8px;
            font-weight: 300;
            line-height: 1.6;
        }

        .welcome-card .role-badge {
            display: inline-block;
            margin-top: 12px;
            padding: 6px 20px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.5px;
            background: rgba(67, 99, 126, 0.12);
            color: #43637E;
        }

        /* ===== STATS GRID ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-top: 32px;
        }

        .stat-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 24px 20px;
            text-align: center;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15), 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e8e4de;
            transition: all 0.4s ease;
        }

        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25), 0 12px 40px rgba(0, 0, 0, 0.12);
            border-color: #43637E;
        }

        .stat-card .number {
            font-size: 34px;
            font-weight: 700;
            font-family: 'Georgia', serif;
            color: #43637E;
        }

        .stat-card .label {
            font-size: 14px;
            color: #7a8a9a;
            font-weight: 500;
            margin-top: 4px;
            letter-spacing: 0.3px;
        }

        .stat-card .icon {
            font-size: 32px;
            display: block;
            margin-bottom: 6px;
        }

        /* ===== QUICK ACTIONS ===== */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-top: 32px;
        }

        .quick-action {
            background: #ffffff;
            border-radius: 14px;
            padding: 20px 16px;
            text-align: center;
            text-decoration: none;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1), 0 4px 15px rgba(0, 0, 0, 0.06);
            border: 1px solid #e8e4de;
            transition: all 0.4s ease;
        }

        .quick-action:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2), 0 12px 30px rgba(0, 0, 0, 0.1);
            border-color: #43637E;
            background: rgba(67, 99, 126, 0.03);
        }

        .quick-action .icon {
            font-size: 32px;
            display: block;
            margin-bottom: 6px;
        }

        .quick-action .label {
            font-size: 13px;
            font-weight: 600;
            color: #2c3e50;
        }

        .quick-action .desc {
            font-size: 12px;
            color: #9aabbb;
            margin-top: 2px;
            font-weight: 300;
        }

        /* ===== DARK MODE ===== */
        .dark .dashboard-section {
            background: #1a2632;
        }

        .dark .dashboard-section::before {
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
        }

        .dark .welcome-card {
            background: #1a2632;
            border-color: #2c3e50;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.5), 0 8px 30px rgba(0, 0, 0, 0.3);
        }

        .dark .welcome-card:hover {
            border-color: #43637E;
            box-shadow: 0 24px 65px rgba(0, 0, 0, 0.6), 0 12px 40px rgba(0, 0, 0, 0.4);
        }

        .dark .welcome-card .greeting h1 {
            color: #f0ede8;
        }

        .dark .welcome-card .desc {
            color: #b0bec5;
        }

        .dark .welcome-card .role-badge {
            background: rgba(67, 99, 126, 0.25);
            color: #f0e6d0;
        }

        .dark .stat-card {
            background: #1a2632;
            border-color: #2c3e50;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4), 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .dark .stat-card:hover {
            border-color: #43637E;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5), 0 12px 40px rgba(0, 0, 0, 0.3);
        }

        .dark .stat-card .number {
            color: #f0e6d0;
        }

        .dark .stat-card .label {
            color: #b0bec5;
        }

        .dark .quick-action {
            background: #1a2632;
            border-color: #2c3e50;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3), 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .dark .quick-action:hover {
            border-color: #43637E;
            background: rgba(67, 99, 126, 0.08);
        }

        .dark .quick-action .label {
            color: #f0ede8;
        }

        .dark .quick-action .desc {
            color: #7a8a9a;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .quick-actions {
                grid-template-columns: repeat(2, 1fr);
                gap: 14px;
            }
        }

        @media (max-width: 768px) {
            .welcome-card {
                padding: 28px 24px 32px;
            }

            .welcome-card .greeting h1 {
                font-size: 26px;
            }

            .welcome-card .greeting .icon {
                font-size: 32px;
            }

            .welcome-card .desc {
                font-size: 15px;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
                gap: 14px;
            }

            .stat-card {
                padding: 18px 14px;
            }

            .stat-card .number {
                font-size: 28px;
            }

            .quick-actions {
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }

            .quick-action {
                padding: 16px 12px;
            }
        }

        @media (max-width: 480px) {
            .dashboard-section {
                padding: 24px 0 40px;
            }

            .welcome-card {
                padding: 20px 16px 24px;
            }

            .welcome-card .greeting {
                flex-direction: column;
                text-align: center;
            }

            .welcome-card .greeting h1 {
                font-size: 22px;
            }

            .welcome-card .desc {
                font-size: 14px;
                text-align: center;
            }

            .welcome-card .role-badge {
                display: block;
                text-align: center;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .stat-card {
                padding: 14px 10px;
                border-radius: 12px;
            }

            .stat-card .number {
                font-size: 22px;
            }

            .stat-card .label {
                font-size: 12px;
            }

            .stat-card .icon {
                font-size: 24px;
            }

            .quick-actions {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .quick-action {
                padding: 14px 10px;
                border-radius: 12px;
            }

            .quick-action .icon {
                font-size: 24px;
            }

            .quick-action .label {
                font-size: 12px;
            }

            .quick-action .desc {
                font-size: 10px;
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
    <!-- DASHBOARD SECTION                           -->
    <!-- ============================================ -->
    <div class="dashboard-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- ===== WELCOME CARD ===== -->
            <div class="welcome-card">
                <div class="greeting">
                    <span class="icon"></span>
                    <h1>
                        Halo, <span class="highlight">{{ Auth::user()->name }}</span>!
                    </h1>
                </div>
                <p class="desc">
                    Ini adalah dashboard <strong>User</strong> untuk aplikasi GoAnywhere.
                    Kelola sewa kendaraan Anda dengan mudah di sini.
                </p>
                    <span class="role-badge">Role: {{ Auth::user()->role }}</span>
            </div>

            <!-- ===== STATISTIK ===== -->
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="icon"></span>
                    <div class="number">{{ $totalRentals ?? 0 }}</div>
                    <div class="label">Total Sewa</div>
                </div>
                <div class="stat-card">
                    <span class="icon"></span>
                    <div class="number">{{ $activeRentals ?? 0 }}</div>
                    <div class="label">Sewa Aktif</div>
                </div>
                <div class="stat-card">
                    <span class="icon"></span>
                    <div class="number">Rp {{ number_format($totalSpent ?? 0, 0, ',', '.') }}</div>
                    <div class="label">Total Belanja</div>
                </div>
                <div class="stat-card">
                    <span class="icon"></span>
                    <div class="number">{{ $pendingPickup ?? 0 }}</div>
                    <div class="label">Menunggu Diantar</div>
                </div>
            </div>

            <!-- ===== QUICK ACTIONS ===== -->
            <div class="quick-actions">
                <a href="{{ route('user.armada') }}" class="quick-action">
                    <span class="icon"></span>
                    <div class="label">Lihat Armada</div>
                    <div class="desc">Cari kendaraan</div>
                </a>
                <a href="{{ route('user.rental') }}" class="quick-action">
                    <span class="icon"></span>
                    <div class="label">Sewa Saya</div>
                    <div class="desc">Kelola sewa</div>
                </a>
                <a href="{{ route('user.layanan') }}" class="quick-action">
                    <span class="icon"></span>
                    <div class="label">Layanan</div>
                    <div class="desc">Paket sewa</div>
                </a>
                <a href="{{ route('profile.edit') }}" class="quick-action">
                    <span class="icon"></span>
                    <div class="label">Pengaturan</div>
                    <div class="desc">Edit profil</div>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>