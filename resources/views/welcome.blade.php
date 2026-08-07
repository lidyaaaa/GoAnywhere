<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GoAnywhere - Modern Vehicle Rental</title>
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="landing-page dark:bg-[#0B0F19]">

    <!-- ===== PILL NAVBAR ===== -->
    <nav class="navbar max-w-5xl mx-auto flex justify-between items-center h-16 px-6">
        <div class="flex items-center">
            <span class="text-xl font-bold tracking-tight text-slate-900 dark:text-white">
                <span>Go<span class="text-slate-600 dark:text-slate-300">Anywhere</span></span>
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
                        <a href="{{ route('register') }}" class="btn-primary px-5 py-2 text-sm rounded-full">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <!-- ===== HERO SECTION ===== -->
    <main class="flex-1 flex items-center justify-center py-20 px-4">
        <div class="max-w-3xl w-full text-center space-y-8">
            
            <!-- Animated Icon -->
            <div class="hero-circle animate-bounce duration-1000"></div>

            <!-- Title -->
            <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight text-slate-900 dark:text-white leading-tight">
                Premium Vehicle Rental for <br><span class="text-slate-900 dark:text-slate-300">Your Next Journey</span>
            </h1>

            <!-- Description -->
            <p class="text-lg text-slate-700 dark:text-slate-300 max-w-xl mx-auto leading-relaxed">
                Solusi rental kendaraan terpercaya di Jabodetabek dengan standar kebersihan tertinggi dan layanan pengantaran langsung ke lokasi Anda.
            </p>

            <!-- Locations -->
            <div class="flex flex-wrap justify-center items-center gap-2 text-sm font-medium text-slate-700 dark:text-slate-300">
                <span>5 Lokasi utama:</span>
                <span class="text-slate-700 dark:text-slate-200 font-semibold">Jakarta</span>
                <span class="text-slate-600 dark:text-slate-400">•</span>
                <span class="text-slate-700 dark:text-slate-200 font-semibold">Bogor</span>
                <span class="text-slate-600 dark:text-slate-400">•</span>
                <span class="text-slate-700 dark:text-slate-200 font-semibold">Depok</span>
                <span class="text-slate-600 dark:text-slate-400">•</span>
                <span class="text-slate-700 dark:text-slate-200 font-semibold">Tangerang</span>
                <span class="text-slate-600 dark:text-slate-400">•</span>
                <span class="text-slate-700 dark:text-slate-200 font-semibold">Bekasi</span>
            </div>

            <!-- Buttons -->
            <div class="pt-4">
                @guest
                    <a href="{{ route('login') }}" class="btn-primary inline-block px-8 py-4 rounded-full text-base font-semibold transition-all">
                        Mulai Perjalanan Anda
                    </a>
                @else
                    <a href="{{ url('/dashboard') }}" class="btn-primary inline-block px-8 py-4 rounded-full text-base font-semibold transition-all">
                        Lihat Dashboard
                    </a>
                @endguest
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-16">
                <div class="feature-card p-8 rounded-2xl border border-slate-100 dark:border-slate-800 bg-white/50 dark:bg-slate-900/50 backdrop-blur-md">
                    <span class="feature-icon block mb-3"></span>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Pilihan Lengkap</h3>
                    <p class="text-sm text-slate-700 dark:text-slate-300 mt-2">Armada mobil dan motor terbaru yang siap menemani perjalanan Anda.</p>
                </div>
                <div class="feature-card p-8 rounded-2xl border border-slate-100 dark:border-slate-800 bg-white/50 dark:bg-slate-900/50 backdrop-blur-md">
                    <span class="feature-icon block mb-3"></span>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Harga Fleksibel</h3>
                    <p class="text-sm text-slate-700 dark:text-slate-300 mt-2">Tarif harian dan mingguan kompetitif mulai dari Rp 120.000/hari.</p>
                </div>
                <div class="feature-card p-8 rounded-2xl border border-slate-100 dark:border-slate-800 bg-white/50 dark:bg-slate-900/50 backdrop-blur-md">
                    <span class="feature-icon block mb-3"></span>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Layanan Antar</h3>
                    <p class="text-sm text-slate-700 dark:text-slate-300 mt-2">Kendaraan akan diantarkan langsung ke depan pintu rumah Anda.</p>
                </div>
            </div>

        </div>
    </main>

    <!-- ===== FOOTER ===== -->
    <footer class="py-12 border-t border-slate-100 dark:border-slate-900">
        <div class="max-w-5xl mx-auto px-6 text-center text-sm text-slate-600 dark:text-slate-400">
            &copy; {{ date('Y') }} GoAnywhere. Designed for comfort and class.
        </div>
    </footer>

</body>
</html>