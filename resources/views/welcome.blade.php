<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GoAnywhere - Modern Vehicle Rental</title>
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Smooth Scrolling and Custom Scrollbar */
        html {
            scroll-behavior: smooth;
        }

        /* Seamless Background Gradient with Floating Glow Blobs */
        body {
            background-color: #F0F4F8 !important;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(106, 155, 209, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 90% 50%, rgba(0, 75, 135, 0.10) 0%, transparent 45%),
                radial-gradient(circle at 50% 80%, rgba(106, 155, 209, 0.08) 0%, transparent 40%),
                linear-gradient(to bottom, #F0F4F8, #FFFFFF) !important;
            background-attachment: fixed !important;
            position: relative;
            overflow-x: hidden;
            font-family: 'Poppins', sans-serif !important;
        }
        
        .dark body {
            background-color: #001F3F !important;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(106, 155, 209, 0.20) 0%, transparent 40%),
                radial-gradient(circle at 90% 50%, rgba(0, 75, 135, 0.25) 0%, transparent 45%),
                radial-gradient(circle at 50% 80%, rgba(106, 155, 209, 0.12) 0%, transparent 40%),
                linear-gradient(to bottom, #001F3F, #080B12) !important;
            background-attachment: fixed !important;
        }

        /* Ambient Glow Spheres */
        .ambient-glow-1 {
            position: absolute;
            top: 10%;
            left: -100px;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(106, 155, 209, 0.35) 0%, transparent 70%);
            filter: blur(60px);
            z-index: 0;
            pointer-events: none;
        }

        .ambient-glow-2 {
            position: absolute;
            top: 50%;
            right: -150px;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(67, 99, 126, 0.12) 0%, transparent 70%);
            filter: blur(70px);
            z-index: 0;
            pointer-events: none;
        }

        .dark .ambient-glow-1 {
            background: radial-gradient(circle, rgba(106, 155, 209, 0.40) 0%, transparent 75%);
        }

        .dark .ambient-glow-2 {
            background: radial-gradient(circle, rgba(0, 75, 135, 0.30) 0%, transparent 75%);
        }

        /* Custom Transitions */
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .hover-lift:hover {
            transform: translateY(-5px);
        }

        /* Bright Glassmorphic elements - Light background in both modes */
        .glass-card {
            background: rgba(255, 255, 255, 0.85) !important;
            backdrop-filter: blur(20px) !important;
            -webkit-backdrop-filter: blur(20px) !important;
            border: 1px solid rgba(255, 255, 255, 0.6) !important;
        }

        .dark .glass-card {
            background: rgba(255, 255, 255, 0.85) !important;
            border: 1px solid rgba(255, 255, 255, 0.5) !important;
        }
    </style>
</head>
<body class="landing-page dark:bg-[#001F3F] min-h-screen flex flex-col justify-between">

    <!-- Ambient Background Elements -->
    <div class="ambient-glow-1"></div>
    <div class="ambient-glow-2"></div>

    <!-- ===== PILL NAVBAR ===== -->
    <nav class="navbar max-w-5xl mx-auto flex justify-between items-center h-16 px-6 relative z-10">
        <div class="flex items-center gap-2">
            <svg class="w-6 h-6 text-[#004B87] dark:text-[#6A9BD1]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
            </svg>
            <span class="text-xl font-bold tracking-tight text-slate-900 dark:text-white">
                <span>Go<span class="text-[#004B87] dark:text-[#6A9BD1]">Anywhere</span></span>
            </span>
        </div>
        <div class="flex items-center gap-3">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-secondary px-5 py-2 text-sm rounded-full">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="btn-secondary px-5 py-2 text-sm rounded-full">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-secondary px-5 py-2 text-sm rounded-full">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-primary px-5 py-2 text-sm rounded-full bg-[#004B87] text-white hover:bg-[#002D55] shadow-md">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <!-- ===== HERO SECTION ===== -->
    <main class="flex-1 flex items-center justify-center py-16 px-4 relative z-10">
        <div class="max-w-4xl w-full text-center space-y-10">
            
            <!-- Floating badge -->
            <div class="inline-flex items-center space-x-2 px-4 py-1.5 rounded-full bg-[#F0F4F8]/80 dark:bg-indigo-950/40 border border-[#6A9BD1]/30/50 dark:border-indigo-900/50 text-[#002D55] dark:text-indigo-300 text-xs font-semibold tracking-wider uppercase backdrop-blur-sm animate-pulse">
                <span>⚡ Premium Rental Service</span>
            </div>

            <!-- Title -->
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight text-slate-900 dark:text-white leading-tight">
                Premium Vehicle Rental for <br>
                <span class="bg-gradient-to-r from-indigo-600 via-blue-500 to-purple-600 bg-clip-text text-transparent dark:from-indigo-400 dark:to-blue-300">
                    Your Next Journey
                </span>
            </h1>

            <!-- Description -->
            <p class="text-base md:text-lg text-slate-600 dark:text-slate-350 max-w-xl mx-auto leading-relaxed">
                Solusi rental kendaraan terpercaya di Jabodetabek dengan standar kebersihan tertinggi dan layanan pengantaran langsung ke lokasi Anda.
            </p>

            <!-- Locations Pills -->
            <div class="flex flex-wrap justify-center items-center gap-3 text-xs md:text-sm font-medium">
                <span class="text-slate-500 dark:text-slate-400">Tersedia di:</span>
                <span class="px-3.5 py-1.5 rounded-full bg-white/60 dark:bg-slate-900/40 border border-slate-200/50 dark:border-slate-800/50 shadow-sm backdrop-blur-sm text-slate-800 dark:text-slate-200">Jakarta</span>
                <span class="px-3.5 py-1.5 rounded-full bg-white/60 dark:bg-slate-900/40 border border-slate-200/50 dark:border-slate-800/50 shadow-sm backdrop-blur-sm text-slate-800 dark:text-slate-200">Bogor</span>
                <span class="px-3.5 py-1.5 rounded-full bg-white/60 dark:bg-slate-900/40 border border-slate-200/50 dark:border-slate-800/50 shadow-sm backdrop-blur-sm text-slate-800 dark:text-slate-200">Depok</span>
                <span class="px-3.5 py-1.5 rounded-full bg-white/60 dark:bg-slate-900/40 border border-slate-200/50 dark:border-slate-800/50 shadow-sm backdrop-blur-sm text-slate-800 dark:text-slate-200">Tangerang</span>
                <span class="px-3.5 py-1.5 rounded-full bg-white/60 dark:bg-slate-900/40 border border-slate-200/50 dark:border-slate-800/50 shadow-sm backdrop-blur-sm text-slate-800 dark:text-slate-200">Bekasi</span>
            </div>

            <!-- Search Mockup Form -->
            <div class="max-w-3xl mx-auto p-5 rounded-3xl bg-white/40 dark:bg-slate-900/45 border border-white/40 dark:border-slate-800/40 shadow-xl backdrop-blur-xl hover:shadow-2xl transition duration-300">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-left">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5 pl-1">Tipe Kendaraan</label>
                        <select class="w-full bg-white/80 dark:bg-slate-800/80 rounded-xl border-slate-200 dark:border-slate-700 text-sm focus:border-[#004B87] focus:ring-[#004B87]">
                            <option>Semua Mobil & Motor</option>
                            <option>Mobil Premium</option>
                            <option>Motor / Matic</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5 pl-1">Lokasi Anda</label>
                        <select class="w-full bg-white/80 dark:bg-slate-800/80 rounded-xl border-slate-200 dark:border-slate-700 text-sm focus:border-[#004B87] focus:ring-[#004B87]">
                            <option>Pilih Lokasi Terdekat</option>
                            <option>Jakarta</option>
                            <option>Bogor</option>
                            <option>Depok</option>
                            <option>Tangerang</option>
                            <option>Bekasi</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        @guest
                            <a href="{{ route('login') }}" class="w-full text-center bg-[#004B87] hover:bg-[#002D55] text-white font-semibold py-2.5 px-6 rounded-xl shadow-lg shadow-[#004B87]/25 transition duration-200 text-sm">
                                Temukan Kendaraan
                            </a>
                        @else
                            <a href="{{ url('/dashboard') }}" class="w-full text-center bg-[#004B87] hover:bg-[#002D55] text-white font-semibold py-2.5 px-6 rounded-xl shadow-lg shadow-[#004B87]/25 transition duration-200 text-sm">
                                Temukan Kendaraan
                            </a>
                        @endguest
                    </div>
                </div>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-10">
                <div class="glass-card hover-lift p-8 rounded-2xl text-left flex flex-col justify-between shadow-sm">
                    <div>
                        <span class="feature-icon flex items-center justify-center mb-4 bg-indigo-100 text-[#004B87] rounded-xl w-12 h-12">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </span>
                        <h3 class="text-lg font-bold text-slate-900">Pilihan Lengkap</h3>
                        <p class="text-sm text-slate-650 mt-2">Armada mobil dan motor terbaru yang siap menemani perjalanan Anda dengan kondisi prima.</p>
                    </div>
                </div>
                <div class="glass-card hover-lift p-8 rounded-2xl text-left flex flex-col justify-between shadow-sm">
                    <div>
                        <span class="feature-icon flex items-center justify-center mb-4 bg-blue-100 text-blue-600 rounded-xl w-12 h-12">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </span>
                        <h3 class="text-lg font-bold text-slate-900">Harga Fleksibel</h3>
                        <p class="text-sm text-slate-650 mt-2">Tarif harian dan mingguan kompetitif mulai dari Rp 120.000/hari tanpa biaya tersembunyi.</p>
                    </div>
                </div>
                <div class="glass-card hover-lift p-8 rounded-2xl text-left flex flex-col justify-between shadow-sm">
                    <div>
                        <span class="feature-icon flex items-center justify-center mb-4 bg-purple-100 text-purple-600 rounded-xl w-12 h-12">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </span>
                        <h3 class="text-lg font-bold text-slate-900">Layanan Antar</h3>
                        <p class="text-sm text-slate-650 mt-2">Dapatkan kemudahan dengan layanan antar jemput unit langsung ke depan rumah Anda.</p>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- ===== FOOTER ===== -->
    <footer class="py-8 border-t border-slate-200/50 dark:border-slate-800/40 relative z-10">
        <div class="max-w-5xl mx-auto px-6 text-center text-xs md:text-sm text-slate-500 dark:text-slate-400 font-medium">
            &copy; {{ date('Y') }} GoAnywhere. Designed for comfort and class.
        </div>
    </footer>

</body>
</html>