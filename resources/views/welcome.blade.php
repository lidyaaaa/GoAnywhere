<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GoAnywhere - Rental Kendaraan Jabodetabek Terpercaya</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('GoAnywhereLogo.png') }}">
    <link rel="shortcut icon" href="{{ asset('GoAnywhereLogo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif !important;
            background-color: #F0F4F8 !important;
            background-image: 
                radial-gradient(circle at 10% 15%, rgba(106, 155, 209, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 90% 45%, rgba(0, 75, 135, 0.10) 0%, transparent 45%),
                radial-gradient(circle at 50% 85%, rgba(106, 155, 209, 0.12) 0%, transparent 40%),
                linear-gradient(to bottom, #F0F4F8, #FFFFFF) !important;
            background-attachment: fixed !important;
            color: #002D55 !important;
            overflow-x: hidden;
        }

        .dark body {
            background-color: #001F3F !important;
            background-image: 
                radial-gradient(circle at 10% 15%, rgba(106, 155, 209, 0.20) 0%, transparent 40%),
                radial-gradient(circle at 90% 45%, rgba(0, 75, 135, 0.25) 0%, transparent 45%),
                radial-gradient(circle at 50% 85%, rgba(106, 155, 209, 0.15) 0%, transparent 40%),
                linear-gradient(to bottom, #001F3F, #080B12) !important;
            color: #F0F4F8 !important;
        }

        /* Glassmorphism Cards */
        .glass-box {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 24px;
            box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .dark .glass-box {
            background: rgba(15, 23, 42, 0.65);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.35);
        }

        .glass-box:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -12px rgba(0, 75, 135, 0.12);
            border-color: rgba(0, 75, 135, 0.2);
        }

        /* Ambient Glow Blobs */
        .ambient-blob-1 {
            position: absolute;
            top: 5%;
            left: -120px;
            width: 480px;
            height: 480px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(106, 155, 209, 0.28) 0%, transparent 70%);
            filter: blur(70px);
            z-index: 0;
            pointer-events: none;
        }

        .ambient-blob-2 {
            position: absolute;
            top: 45%;
            right: -140px;
            width: 550px;
            height: 550px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(0, 75, 135, 0.15) 0%, transparent 70%);
            filter: blur(80px);
            z-index: 0;
            pointer-events: none;
        }

        /* Pill Badge */
        .pill-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between selection:bg-[#004B87] selection:text-white relative">

    <!-- Ambient Glow Backgrounds -->
    <div class="ambient-blob-1"></div>
    <div class="ambient-blob-2"></div>

    <!-- ======================================================== -->
    <!-- 1. STICKY NAVBAR DENGAN LOGO GOANYWHERE RESMI            -->
    <!-- ======================================================== -->
    <header class="sticky top-0 z-50 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md border-b border-slate-200/80 dark:border-slate-800 transition shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-18 flex items-center justify-between">
            
            <!-- Brand Logo Resmi -->
            <a href="{{ url('/') }}" class="flex items-center gap-2.5 group">
                <img src="{{ asset('GoAnywhereLogo.png') }}" alt="GoAnywhere Logo" class="w-9 h-9 object-contain rounded-lg shadow-sm group-hover:scale-105 transition shrink-0" style="width: 36px; height: 36px; max-width: 36px; max-height: 36px;">
                <span class="font-extrabold text-xl tracking-tight text-slate-900 dark:text-white">
                    Go<span class="text-[#004B87] dark:text-[#6A9BD1]">Anywhere</span>
                </span>
            </a>

            <!-- Menu Tautan Cepat -->
            <nav class="hidden md:flex items-center space-x-1 text-sm font-semibold text-slate-600 dark:text-slate-300">
                <a href="#hero" class="px-3 py-2 rounded-xl hover:text-[#004B87] hover:bg-slate-100 dark:hover:bg-slate-800 transition">Beranda</a>
                <a href="#armada" class="px-3 py-2 rounded-xl hover:text-[#004B87] hover:bg-slate-100 dark:hover:bg-slate-800 transition">Cari Armada</a>
                <a href="#alur-sewa" class="px-3 py-2 rounded-xl hover:text-[#004B87] hover:bg-slate-100 dark:hover:bg-slate-800 transition">Alur Sewa</a>
                <a href="#keunggulan" class="px-3 py-2 rounded-xl hover:text-[#004B87] hover:bg-slate-100 dark:hover:bg-slate-800 transition">Keunggulan</a>
                <a href="#cabang" class="px-3 py-2 rounded-xl hover:text-[#004B87] hover:bg-slate-100 dark:hover:bg-slate-800 transition">Cabang</a>
                <a href="#faq" class="px-3 py-2 rounded-xl hover:text-[#004B87] hover:bg-slate-100 dark:hover:bg-slate-800 transition">FAQ</a>
            </nav>

            <!-- Autentikasi / Dashboard -->
            <div class="flex items-center gap-2.5">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-[#004B87] hover:bg-[#002D55] text-white text-xs sm:text-sm font-bold rounded-xl shadow-md transition flex items-center gap-1.5">
                        <span>Dashboard Saya</span> →
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-xs sm:text-sm font-bold text-slate-700 dark:text-slate-200 hover:text-[#004B87] hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl transition">
                        Masuk
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-[#004B87] hover:bg-[#002D55] text-white text-xs sm:text-sm font-bold rounded-xl shadow-md transition flex items-center gap-1">
                            <span>Daftar Akun</span>
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </header>

    <main class="flex-1 space-y-24 py-10 relative z-10">

        <!-- ======================================================== -->
        <!-- 2. HERO SECTION DENGAN FILTER CEPAT                      -->
        <!-- ======================================================== -->
        <section id="hero" class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8 pt-4">
            
            <!-- Tagline Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-50 dark:bg-blue-950/60 border border-blue-200/80 dark:border-blue-900/60 text-[#004B87] dark:text-sky-300 text-xs font-bold tracking-wide uppercase shadow-sm">
                <span class="w-2 h-2 rounded-full bg-blue-600 animate-ping"></span>
                <span>⚡ Solusi Rental Kendaraan No. 1 di Jabodetabek</span>
            </div>

            <!-- Headline -->
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-tight text-slate-900 dark:text-white leading-[1.15]">
                Premium Vehicle Rental for <br>
                <span class="bg-gradient-to-r from-[#004B87] via-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    Your Next Journey
                </span>
            </h1>

            <!-- Subtitle -->
            <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Nikmati kenyamanan sewa mobil dan motor terpercaya di Jakarta, Bogor, Depok, Tangerang, dan Bekasi. Unit terawat berkala, bebas unit rusak, serta layanan pengantaran langsung ke pintu Anda.
            </p>

            <!-- Cabang Pills (Bisa Diklik Untuk Memfilter Cepat) -->
            <div class="flex flex-wrap justify-center items-center gap-2 text-xs font-semibold">
                <span class="text-slate-500 dark:text-slate-400 mr-1">📍 Jangkauan Cabang:</span>
                @foreach(['Jakarta', 'Bogor', 'Depok', 'Tangerang', 'Bekasi'] as $loc)
                    <button type="button" onclick="quickFilterLocation('{{ $loc }}')" class="px-3.5 py-1.5 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-[#004B87] hover:text-[#004B87] dark:hover:text-sky-300 shadow-sm transition">
                        {{ $loc }}
                    </button>
                @endforeach
            </div>

            <!-- ===== FILTER FORM BOX (INTERAKTIF PREVIEW) ===== -->
            <div class="max-w-3xl mx-auto p-4 sm:p-5 rounded-3xl bg-white/95 dark:bg-slate-900/90 border border-slate-200/90 dark:border-slate-800 shadow-2xl backdrop-blur-xl text-left">
                <form id="filterForm" onsubmit="event.preventDefault(); applyFilter();" class="grid grid-cols-1 md:grid-cols-12 gap-3 items-end">
                    
                    <!-- Pilihan Tipe Kendaraan -->
                    <div class="md:col-span-5">
                        <label for="filterType" class="block text-[11px] font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                            🚗 Tipe Kendaraan
                        </label>
                        <select id="filterType" onchange="applyFilter()" class="w-full bg-slate-50 dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 text-sm font-semibold text-slate-800 dark:text-slate-100 py-2.5 px-3 focus:border-[#004B87] focus:ring-2 focus:ring-[#004B87]/20 transition">
                            <option value="all">Semua Mobil & Motor</option>
                            <option value="car">Mobil (Car)</option>
                            <option value="motorcycle">Sepeda Motor (Motorcycle)</option>
                        </select>
                    </div>

                    <!-- Pilihan Lokasi Anda -->
                    <div class="md:col-span-4">
                        <label for="filterLocation" class="block text-[11px] font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                            📍 Lokasi Anda (Cabang)
                        </label>
                        <select id="filterLocation" onchange="applyFilter()" class="w-full bg-slate-50 dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 text-sm font-semibold text-slate-800 dark:text-slate-100 py-2.5 px-3 focus:border-[#004B87] focus:ring-2 focus:ring-[#004B87]/20 transition">
                            <option value="all">Semua Lokasi Jabodetabek</option>
                            <option value="Jakarta">Jakarta</option>
                            <option value="Bogor">Bogor</option>
                            <option value="Depok">Depok</option>
                            <option value="Tangerang">Tangerang</option>
                            <option value="Bekasi">Bekasi</option>
                        </select>
                    </div>

                    <!-- Tombol Cari -->
                    <div class="md:col-span-3">
                        <button type="submit" class="w-full py-2.5 px-4 bg-[#004B87] hover:bg-[#002D55] text-white font-bold text-sm rounded-xl shadow-lg shadow-[#004B87]/25 transition flex items-center justify-center gap-1.5">
                            <span>🔍</span> Temukan
                        </button>
                    </div>
                </form>
            </div>

        </section>

        <!-- ======================================================== -->
        <!-- 3. PREVIEW KATALOG KENDARAAN (REALTIME SESUAI FILTER)     -->
        <!-- ======================================================== -->
        <section id="armada" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24 space-y-8">
            
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 border-b border-slate-200 dark:border-slate-800 pb-5">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-2xl">🚗</span>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white">
                            Katalog Armada Tersedia
                        </h2>
                    </div>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                        Pilih kendaraan impian Anda. Unit dalam kondisi prima, wangi, bersih, dan siap diantar.
                    </p>
                </div>

                <!-- Status Filter Aktif -->
                <div class="flex items-center gap-2">
                    <span id="resultCountBadge" class="px-3.5 py-1.5 rounded-full text-xs font-bold bg-[#004B87]/10 text-[#004B87] dark:text-sky-300 border border-[#004B87]/20">
                        Memuat Armada...
                    </span>
                    <button type="button" onclick="resetFilter()" class="text-xs font-bold text-slate-500 hover:text-slate-800 dark:hover:text-white px-2 py-1 rounded-lg border border-slate-200 dark:border-slate-700 transition" title="Tampilkan Semua">
                        Reset ↺
                    </button>
                </div>
            </div>

            <!-- Grid Preview Armada -->
            <div id="vehicleGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($vehicles as $vehicle)
                    @php
                        $vehicleJson = json_encode([
                            'id' => $vehicle->id,
                            'name' => $vehicle->name,
                            'brand' => $vehicle->brand,
                            'type' => $vehicle->type,
                            'vehicle_type' => $vehicle->vehicle_type,
                            'year' => $vehicle->year,
                            'color' => $vehicle->color ?? '-',
                            'transmission' => $vehicle->vehicle_type === 'car' ? ($vehicle->transmission ?? 'Automatic') : ($vehicle->transmission_motor ?? 'Matic'),
                            'capacity' => $vehicle->capacity ?? ($vehicle->vehicle_type === 'car' ? 5 : 2),
                            'fuel' => $vehicle->fuel ?? 'Bensin',
                            'price_day' => number_format($vehicle->price_per_day, 0, ',', '.'),
                            'price_week' => number_format($vehicle->price_per_week, 0, ',', '.'),
                            'has_week' => $vehicle->price_per_week > 0,
                            'location' => $vehicle->location,
                            'stock' => $vehicle->available_stock,
                            'image' => $vehicle->image ? asset('storage/' . $vehicle->image) : null,
                            'description' => $vehicle->description ?? 'Unit kendaraan terawat dengan standar servis rutin dari bengkel resmi GoAnywhere.',
                        ]);
                    @endphp

                    <div class="vehicle-card-item glass-box overflow-hidden flex flex-col justify-between"
                         data-type="{{ $vehicle->vehicle_type }}"
                         data-location="{{ $vehicle->location }}">
                        
                        <div>
                            <!-- Foto Kendaraan & Badges -->
                            <div class="relative h-48 bg-slate-100 dark:bg-slate-800 overflow-hidden flex items-center justify-center">
                                @if($vehicle->image)
                                    <img src="{{ asset('storage/' . $vehicle->image) }}" alt="{{ $vehicle->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @else
                                    <div class="text-5xl opacity-40">
                                        {{ $vehicle->vehicle_type === 'car' ? '🚗' : '🏍️' }}
                                    </div>
                                @endif

                                <!-- Badge Lokasi Cabang -->
                                <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-[11px] font-extrabold bg-[#004B87] text-white shadow-md flex items-center gap-1">
                                    <span>📍</span> {{ $vehicle->location }}
                                </span>

                                <!-- Badge Tipe & Stok -->
                                <span class="absolute top-3 right-3 px-2.5 py-1 rounded-full text-[11px] font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-200 shadow-sm flex items-center gap-1">
                                    <span>✅</span> {{ $vehicle->available_stock }} Unit
                                </span>
                            </div>

                            <!-- Info Kendaraan -->
                            <div class="p-5 space-y-3">
                                <div>
                                    <span class="text-[11px] font-bold uppercase tracking-wider text-[#004B87] dark:text-sky-300">
                                        {{ $vehicle->brand }} • {{ $vehicle->year }}
                                    </span>
                                    <h3 class="text-lg font-extrabold text-slate-900 dark:text-white capitalize truncate mt-0.5" title="{{ $vehicle->name }}">
                                        {{ $vehicle->name }}
                                    </h3>
                                </div>

                                <!-- Fitur Ringkas -->
                                <div class="grid grid-cols-3 gap-2 py-2 border-y border-slate-100 dark:border-slate-800 text-[11px] font-semibold text-slate-600 dark:text-slate-300 text-center">
                                    <div class="bg-slate-50 dark:bg-slate-800/80 p-1.5 rounded-lg">
                                        ⚙️ {{ $vehicle->vehicle_type === 'car' ? ($vehicle->transmission ?? 'Matic') : ($vehicle->transmission_motor ?? 'Matic') }}
                                    </div>
                                    <div class="bg-slate-50 dark:bg-slate-800/80 p-1.5 rounded-lg">
                                        👥 {{ $vehicle->capacity ?? ($vehicle->vehicle_type === 'car' ? 5 : 2) }} Seat
                                    </div>
                                    <div class="bg-slate-50 dark:bg-slate-800/80 p-1.5 rounded-lg">
                                        ⛽ {{ $vehicle->fuel ?? 'Bensin' }}
                                    </div>
                                </div>

                                <!-- Tarif Harga -->
                                <div class="pt-1">
                                    <div class="text-xs text-slate-500 dark:text-slate-400">Mulai dari:</div>
                                    <div class="text-xl font-black text-[#004B87] dark:text-sky-300">
                                        Rp {{ number_format($vehicle->price_per_day, 0, ',', '.') }}
                                        <span class="text-xs font-normal text-slate-500">/ hari</span>
                                    </div>
                                    @if($vehicle->price_per_week > 0)
                                        <div class="text-xs text-emerald-600 dark:text-emerald-400 font-bold mt-0.5">
                                            🎁 Paket 7 Hari: Rp {{ number_format($vehicle->price_per_week, 0, ',', '.') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="p-5 pt-0 grid grid-cols-2 gap-2">
                            <button type="button" 
                                    onclick='openVehicleDetailModal({!! $vehicleJson !!})'
                                    class="w-full py-2.5 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-bold transition flex items-center justify-center gap-1">
                                <span>🔍</span> Detail
                            </button>

                            <button type="button" 
                                    onclick='handleRentalAction({!! $vehicleJson !!})'
                                    class="w-full py-2.5 px-3 rounded-xl bg-[#004B87] hover:bg-[#002D55] text-white text-xs font-bold shadow-md transition flex items-center justify-center gap-1">
                                <span>🔑</span> Sewa
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 p-12 text-center bg-white dark:bg-slate-800 rounded-3xl border border-slate-200">
                        <div class="text-4xl mb-2">🚗</div>
                        <h4 class="text-base font-bold text-slate-800 dark:text-white">Belum Ada Armada Tersedia</h4>
                        <p class="text-xs text-slate-500 mt-1">Silakan kunjungi cabang lain atau hubungi admin kami.</p>
                    </div>
                @endforelse
            </div>

            <!-- Empty Filter State (Muncul Jika Filter Tidak Menemukan Unit) -->
            <div id="noFilterResult" class="hidden p-12 text-center bg-white dark:bg-slate-800 rounded-3xl border border-slate-200 dark:border-slate-700">
                <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-blue-50 dark:bg-blue-950/60 flex items-center justify-center text-3xl text-[#004B87]">
                    🔍
                </div>
                <h4 class="text-lg font-bold text-slate-800 dark:text-white mb-1">Armada Tidak Ditemukan</h4>
                <p class="text-xs text-slate-500 max-w-md mx-auto mb-4">
                    Tidak ada kendaraan yang sesuai dengan kombinasi tipe dan lokasi cabang yang Anda pilih saat ini.
                </p>
                <button type="button" onclick="resetFilter()" class="px-5 py-2.5 bg-[#004B87] text-white text-xs font-bold rounded-xl shadow-md hover:bg-[#002D55] transition">
                    Tampilkan Seluruh Armada Jabodetabek
                </button>
            </div>

        </section>

        <!-- ======================================================== -->
        <!-- 4. ALUR RENTAL TRANSPARAN (5 LANGKAH CEPAT)               -->
        <!-- ======================================================== -->
        <section id="alur-sewa" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24 space-y-10">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider text-[#004B87] dark:text-sky-300">
                    Alur Bisnis Sederhana & Pasti
                </span>
                <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white">
                    Bagaimana Cara Menyewa di GoAnywhere?
                </h2>
                <p class="text-sm text-slate-500">
                    Sistem rental modern yang menjamin transparansi waktu, kondisi fisik, dan keamanan tanpa ribet.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <!-- Step 1 -->
                <div class="glass-box p-6 text-center space-y-3 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 mx-auto rounded-2xl bg-blue-100 text-[#004B87] font-black text-lg flex items-center justify-center shadow-sm">
                            1
                        </div>
                        <h4 class="font-extrabold text-base text-slate-800 dark:text-white mt-3">Pilih Lokasi & Unit</h4>
                        <p class="text-xs text-slate-500 leading-relaxed mt-2">
                            Pilih armada di kota domisili Anda (Jakarta, Bogor, Depok, Tangerang, Bekasi).
                        </p>
                    </div>
                    <span class="text-[11px] font-bold text-blue-600">Sesuai Profil Wilayah</span>
                </div>

                <!-- Step 2 -->
                <div class="glass-box p-6 text-center space-y-3 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 mx-auto rounded-2xl bg-emerald-100 text-emerald-700 font-black text-lg flex items-center justify-center shadow-sm">
                            2
                        </div>
                        <h4 class="font-extrabold text-base text-slate-800 dark:text-white mt-3">Booking & Checkout</h4>
                        <p class="text-xs text-slate-500 leading-relaxed mt-2">
                            Tentukan durasi (Harian / Mingguan). Ongkir pengantaran dihitung otomatis (Motor 25k, Mobil 50k).
                        </p>
                    </div>
                    <span class="text-[11px] font-bold text-emerald-600">Ongkir Otomatis</span>
                </div>

                <!-- Step 3 -->
                <div class="glass-box p-6 text-center space-y-3 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 mx-auto rounded-2xl bg-amber-100 text-amber-700 font-black text-lg flex items-center justify-center shadow-sm">
                            3
                        </div>
                        <h4 class="font-extrabold text-base text-slate-800 dark:text-white mt-3">Diantar ke Lokasi</h4>
                        <p class="text-xs text-slate-500 leading-relaxed mt-2">
                            Setelah pembayaran diverifikasi, Manager cabang menyetujui booking dan unit langsung diantar OTW.
                        </p>
                    </div>
                    <span class="text-[11px] font-bold text-amber-600">Door-to-Door</span>
                </div>

                <!-- Step 4 -->
                <div class="glass-box p-6 text-center space-y-3 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 mx-auto rounded-2xl bg-indigo-100 text-indigo-700 font-black text-lg flex items-center justify-center shadow-sm">
                            4
                        </div>
                        <h4 class="font-extrabold text-base text-slate-800 dark:text-white mt-3">Serah Terima & KTP</h4>
                        <p class="text-xs text-slate-500 leading-relaxed mt-2">
                            Tunjukkan KTP jaminan asli ke Manager. <strong>Timer masa sewa baru dimulai di detik serah terima!</strong>
                        </p>
                    </div>
                    <span class="text-[11px] font-bold text-indigo-600">Timer Real-Time</span>
                </div>

                <!-- Step 5 -->
                <div class="glass-box p-6 text-center space-y-3 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 mx-auto rounded-2xl bg-purple-100 text-purple-700 font-black text-lg flex items-center justify-center shadow-sm">
                            5
                        </div>
                        <h4 class="font-extrabold text-base text-slate-800 dark:text-white mt-3">Cek Fisik & Selesai</h4>
                        <p class="text-xs text-slate-500 leading-relaxed mt-2">
                            Kembalikan unit ke gerai cabang kami. Pengecekan fisik transparan & bebas denda bila tepat waktu.
                        </p>
                    </div>
                    <span class="text-[11px] font-bold text-purple-600">Inspeksi Cepat</span>
                </div>
            </div>
        </section>

        <!-- ======================================================== -->
        <!-- 5. MENGAPA MEMILIH GOANYWHERE? (KEUNGGULAN UTAMA)        -->
        <!-- ======================================================== -->
        <section id="keunggulan" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24 space-y-10">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider text-[#004B87] dark:text-sky-300">
                    Kualitas Tanpa Kompromi
                </span>
                <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white">
                    Mengapa Harus GoAnywhere?
                </h2>
                <p class="text-sm text-slate-500">
                    Standar kenyamanan dan kejujuran layanan sewa kendaraan di dunia nyata.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Feature 1 -->
                <div class="glass-box p-6 space-y-3">
                    <div class="w-12 h-12 rounded-2xl bg-blue-100 text-[#004B87] flex items-center justify-center text-2xl shadow-sm">
                        🛡️
                    </div>
                    <h3 class="text-base font-extrabold text-slate-900 dark:text-white">Armada Terawat Bebas Rusak</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Sistem kami otomatis mengisolasi unit rusak ke bengkel servis. Anda dijamin hanya menyewa kendaraan dalam kondisi 100% prima.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="glass-box p-6 space-y-3">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-2xl shadow-sm">
                        ⏱️
                    </div>
                    <h3 class="text-base font-extrabold text-slate-900 dark:text-white">Timer Dihitung Saat Bertemu</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Tidak ada waktu sewa yang terpotong saat pengantaran. Masa rental baru resmi berjalan saat kunci dan unit diterima di tangan Anda.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="glass-box p-6 space-y-3">
                    <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center text-2xl shadow-sm">
                        💰
                    </div>
                    <h3 class="text-base font-extrabold text-slate-900 dark:text-white">Tarif Pasti Tanpa Biaya Siluman</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Subtotal sewa dan ongkir sudah dihitung jelas sejak checkout. Denda keterlambatan atau perbaikan selalu dijelaskan secara transparan.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="glass-box p-6 space-y-3">
                    <div class="w-12 h-12 rounded-2xl bg-purple-100 text-purple-700 flex items-center justify-center text-2xl shadow-sm">
                        💬
                    </div>
                    <h3 class="text-base font-extrabold text-slate-900 dark:text-white">Live Chat dengan Manager</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Butuh konfirmasi unit atau tanya lokasi cabang? Hubungi langsung Manager cabang yang bertugas lewat fitur pesan instan terpadu.
                    </p>
                </div>
            </div>
        </section>

        <!-- ======================================================== -->
        <!-- 6. JANGKAUAN 5 CABANG RESMI JABODETABEK                 -->
        <!-- ======================================================== -->
        <section id="cabang" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24 space-y-10">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider text-[#004B87] dark:text-sky-300">
                    Gerai Resmi Terpercaya
                </span>
                <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white">
                    5 Cabang Kami di Seluruh Jabodetabek
                </h2>
                <p class="text-sm text-slate-500">
                    Setiap cabang dipimpin oleh Manager profesional yang mengawasi armada dan pengantaran Anda.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                @php
                    $branchList = [
                        ['city' => 'Jakarta', 'icon' => '🏙️', 'desc' => 'Pusat Kota & Bandara Soetta'],
                        ['city' => 'Bogor', 'icon' => '🌲', 'desc' => 'Kawasan Wisata & Puncak'],
                        ['city' => 'Depok', 'icon' => '🎓', 'desc' => 'Area Kampus & Hunian'],
                        ['city' => 'Tangerang', 'icon' => '✈️', 'desc' => 'Kawasan Bisnis BSD & Bandara'],
                        ['city' => 'Bekasi', 'icon' => '🏭', 'desc' => 'Kawasan Industri & Sentra Kota'],
                    ];
                @endphp

                @foreach($branchList as $b)
                    <div class="glass-box p-5 text-center space-y-2 cursor-pointer hover:border-[#004B87]" onclick="quickFilterLocation('{{ $b['city'] }}')">
                        <div class="text-3xl mb-1">{{ $b['icon'] }}</div>
                        <h4 class="font-extrabold text-base text-slate-900 dark:text-white">Cabang {{ $b['city'] }}</h4>
                        <p class="text-xs text-slate-500">{{ $b['desc'] }}</p>
                        <span class="inline-block mt-2 text-[11px] font-bold text-[#004B87] dark:text-sky-300 hover:underline">
                            Lihat Unit Cabang →
                        </span>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- ======================================================== -->
        <!-- 7. FAQ (PERTANYAAN SERING DIAJUKAN)                     -->
        <!-- ======================================================== -->
        <section id="faq" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24 space-y-8">
            <div class="text-center space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider text-[#004B87] dark:text-sky-300">
                    Pusat Informasi
                </span>
                <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white">
                    Pertanyaan Seputar Rental (FAQ)
                </h2>
                <p class="text-sm text-slate-500">
                    Semua yang perlu Anda ketahui sebelum menyewa kendaraan di GoAnywhere.
                </p>
            </div>

            <div class="space-y-3">
                <!-- Q1 -->
                <details class="glass-box p-5 group rounded-2xl cursor-pointer">
                    <summary class="font-bold text-slate-800 dark:text-white text-sm sm:text-base flex justify-between items-center list-none">
                        <span>🪪 Apa saja syarat jaminan untuk menyewa kendaraan?</span>
                        <span class="text-slate-400 group-open:rotate-180 transition">▼</span>
                    </summary>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 mt-3 pt-3 border-t border-slate-100 dark:border-slate-800 leading-relaxed">
                        Cukup sediakan KTP asli yang masih berlaku. Saat Manager menyerahkan unit di alamat Anda, Manager akan memfoto KTP Anda sebagai jaminan resmi sistem. Tidak perlu meninggalkan dokumen fisik berharga lainnya!
                    </p>
                </details>

                <!-- Q2 -->
                <details class="glass-box p-5 group rounded-2xl cursor-pointer">
                    <summary class="font-bold text-slate-800 dark:text-white text-sm sm:text-base flex justify-between items-center list-none">
                        <span>🚚 Berapa biaya ongkos kirim pengantaran unit?</span>
                        <span class="text-slate-400 group-open:rotate-180 transition">▼</span>
                    </summary>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 mt-3 pt-3 border-t border-slate-100 dark:border-slate-800 leading-relaxed">
                        Tarif pengantaran dihitung flat otomatis saat Anda checkout: <strong>Rp 25.000 untuk Sepeda Motor</strong> dan <strong>Rp 50.000 untuk Mobil</strong>. Jika menyewa 1 motor dan 1 mobil sekaligus, tarif ongkir adalah Rp 75.000.
                    </p>
                </details>

                <!-- Q3 -->
                <details class="glass-box p-5 group rounded-2xl cursor-pointer">
                    <summary class="font-bold text-slate-800 dark:text-white text-sm sm:text-base flex justify-between items-center list-none">
                        <span>⏱️ Kapan timer durasi masa sewa saya dimulai?</span>
                        <span class="text-slate-400 group-open:rotate-180 transition">▼</span>
                    </summary>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 mt-3 pt-3 border-t border-slate-100 dark:border-slate-800 leading-relaxed">
                        Sistem kami sangat adil! Waktu sewa <strong>TIDAK dihitung dari saat Anda membayar</strong>, melainkan baru dimulai persis di detik Manager mengklik tombol serah terima kunci dan foto KTP bersama Anda di lokasi.
                    </p>
                </details>

                <!-- Q4 -->
                <details class="glass-box p-5 group rounded-2xl cursor-pointer">
                    <summary class="font-bold text-slate-800 dark:text-white text-sm sm:text-base flex justify-between items-center list-none">
                        <span>🔁 Bagaimana jika saya terlambat mengembalikan kendaraan?</span>
                        <span class="text-slate-400 group-open:rotate-180 transition">▼</span>
                    </summary>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 mt-3 pt-3 border-t border-slate-100 dark:border-slate-800 leading-relaxed">
                        Jika terlambat, sistem otomatis mengkalkulasi denda keterlambatan per jam secara transparan saat Anda melakukan cek fisik di gerai cabang. Tagihan denda dapat langsung dibayar online melalui aplikasi.
                    </p>
                </details>
            </div>
        </section>

        <!-- ======================================================== -->
        <!-- 8. BANNER AJAKAN MENYEWA (CALL TO ACTION)                -->
        <!-- ======================================================== -->
        <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl p-8 sm:p-12 text-center text-white bg-gradient-to-r from-[#002D55] via-[#004B87] to-[#1e3a8a] shadow-2xl relative overflow-hidden">
                <div class="relative z-10 space-y-4 max-w-xl mx-auto">
                    <h3 class="text-2xl sm:text-4xl font-extrabold tracking-tight">
                        Siap Menjelajahi Jabodetabek Bersama GoAnywhere?
                    </h3>
                    <p class="text-xs sm:text-sm text-blue-100 leading-relaxed">
                        Daftar sekarang untuk memesan kendaraan pilihan Anda. Proses cepat, armada bersih, dan diantar langsung ke rumah Anda!
                    </p>
                    <div class="pt-2 flex flex-wrap justify-center gap-3">
                        @auth
                            <a href="#armada" class="px-6 py-3 bg-white text-[#004B87] font-bold text-sm rounded-xl hover:bg-blue-50 transition shadow-lg">
                                Pilih Armada Sekarang
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="px-6 py-3 bg-white text-[#004B87] font-bold text-sm rounded-xl hover:bg-blue-50 transition shadow-lg">
                                Buat Akun Gratis
                            </a>
                            <a href="{{ route('login') }}" class="px-6 py-3 bg-blue-900/60 hover:bg-blue-900 text-white font-bold text-sm rounded-xl border border-blue-400/30 transition">
                                Sudah Punya Akun? Masuk
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- ======================================================== -->
    <!-- 9. FOOTER RESMI DENGAN BRANDING GOANYWHERE               -->
    <!-- ======================================================== -->
    <footer class="bg-white dark:bg-slate-900 border-t border-slate-200/80 dark:border-slate-800 pt-12 pb-8 relative z-10 transition">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                
                <!-- Brand Info -->
                <div class="space-y-3 md:col-span-1">
                    <div class="flex items-center gap-2.5">
                        <img src="{{ asset('GoAnywhereLogo.png') }}" alt="GoAnywhere" class="w-8 h-8 object-contain rounded-lg shrink-0">
                        <span class="font-black text-xl text-slate-900 dark:text-white">Go<span class="text-[#004B87]">Anywhere</span></span>
                    </div>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Platform rental mobil & sepeda motor modern terpercaya di Jabodetabek dengan jaminan unit prima dan pengantaran cepat.
                    </p>
                </div>

                <!-- Cabang Kami -->
                <div>
                    <h4 class="font-bold text-xs uppercase tracking-wider text-slate-800 dark:text-slate-200 mb-3">Cabang Jabodetabek</h4>
                    <ul class="space-y-1.5 text-xs text-slate-500">
                        <li>📍 Cabang Jakarta (Pusat)</li>
                        <li>📍 Cabang Bogor</li>
                        <li>📍 Cabang Depok</li>
                        <li>📍 Cabang Tangerang</li>
                        <li>📍 Cabang Bekasi</li>
                    </ul>
                </div>

                <!-- Tautan Cepat -->
                <div>
                    <h4 class="font-bold text-xs uppercase tracking-wider text-slate-800 dark:text-slate-200 mb-3">Menu Cepat</h4>
                    <ul class="space-y-1.5 text-xs text-slate-500">
                        <li><a href="#hero" class="hover:text-[#004B87]">Beranda</a></li>
                        <li><a href="#armada" class="hover:text-[#004B87]">Katalog Armada</a></li>
                        <li><a href="#alur-sewa" class="hover:text-[#004B87]">Alur Bisnis Rental</a></li>
                        <li><a href="#keunggulan" class="hover:text-[#004B87]">Keunggulan Kami</a></li>
                        <li><a href="#faq" class="hover:text-[#004B87]">Tanya Jawab (FAQ)</a></li>
                    </ul>
                </div>

                <!-- Jam Kerja & Kontak -->
                <div>
                    <h4 class="font-bold text-xs uppercase tracking-wider text-slate-800 dark:text-slate-200 mb-3">Layanan Pelanggan</h4>
                    <p class="text-xs text-slate-500 leading-relaxed mb-2">
                        Buka setiap hari 24 Jam untuk kebutuhan darurat dan pengantaran armada.
                    </p>
                    <a href="https://wa.me/628157184307" target="_blank" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold hover:bg-emerald-100 transition">
                        <span>💬</span> WhatsApp Support
                    </a>
                </div>
            </div>

            <div class="border-t border-slate-100 dark:border-slate-800 pt-6 text-center text-xs text-slate-400">
                &copy; {{ date('Y') }} GoAnywhere. All rights reserved. Designed for comfort and class in Jabodetabek.
            </div>
        </div>
    </footer>

    <!-- ======================================================== -->
    <!-- 10. MODAL DETAIL SPESIFIKASI KENDARAAN                   -->
    <!-- ======================================================== -->
    <div id="modalVehicleDetail" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/60 backdrop-blur-sm transition">
        <div class="bg-white dark:bg-slate-900 rounded-3xl max-w-2xl w-full overflow-hidden shadow-2xl border border-slate-200 dark:border-slate-800 animate-fadeInUp">
            
            <!-- Foto & Header Modal -->
            <div class="relative h-56 bg-slate-100 dark:bg-slate-800">
                <img id="detailModalImage" src="" alt="" class="w-full h-full object-cover">
                <button type="button" onclick="closeVehicleDetailModal()" class="absolute top-4 right-4 w-9 h-9 rounded-full bg-black/50 hover:bg-black/80 text-white flex items-center justify-center font-bold text-base transition">
                    ✕
                </button>
                <div class="absolute bottom-3 left-4 flex gap-2">
                    <span id="detailModalLocation" class="px-3 py-1 rounded-full text-xs font-bold bg-[#004B87] text-white shadow-md"></span>
                    <span id="detailModalStock" class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200 shadow-sm"></span>
                </div>
            </div>

            <!-- Konten Detail -->
            <div class="p-6 space-y-4 max-h-[60vh] overflow-y-auto">
                <div>
                    <span id="detailModalBrandYear" class="text-xs font-bold uppercase tracking-wider text-[#004B87] dark:text-sky-300"></span>
                    <h3 id="detailModalName" class="text-2xl font-extrabold text-slate-900 dark:text-white capitalize"></h3>
                </div>

                <!-- Spesifikasi Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 p-3 rounded-2xl bg-slate-50 dark:bg-slate-800/80 text-xs">
                    <div>
                        <span class="text-slate-400 block text-[10px] uppercase font-bold">Transmisi</span>
                        <strong id="detailModalTrans" class="text-slate-800 dark:text-white font-semibold"></strong>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px] uppercase font-bold">Kapasitas</span>
                        <strong id="detailModalCapacity" class="text-slate-800 dark:text-white font-semibold"></strong>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px] uppercase font-bold">Bahan Bakar</span>
                        <strong id="detailModalFuel" class="text-slate-800 dark:text-white font-semibold"></strong>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px] uppercase font-bold">Warna Unit</span>
                        <strong id="detailModalColor" class="text-slate-800 dark:text-white font-semibold"></strong>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">Kondisi & Deskripsi Unit</h4>
                    <p id="detailModalDesc" class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed"></p>
                </div>

                <!-- Tarif Harga -->
                <div class="p-4 rounded-2xl bg-blue-50/60 dark:bg-slate-800 border border-blue-100 dark:border-slate-700 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <span class="text-xs text-slate-500">Tarif Sewa:</span>
                        <div class="text-xl font-extrabold text-[#004B87] dark:text-sky-300">
                            Rp <span id="detailModalPriceDay"></span> <span class="text-xs font-normal text-slate-500">/ hari</span>
                        </div>
                        <div id="detailModalPriceWeekRow" class="text-xs text-emerald-600 font-bold mt-0.5">
                            🎁 Paket 7 Hari: Rp <span id="detailModalPriceWeek"></span>
                        </div>
                    </div>
                    <button type="button" id="detailModalRentBtn" class="px-6 py-2.5 bg-[#004B87] hover:bg-[#002D55] text-white text-xs font-bold rounded-xl shadow-md transition flex items-center justify-center gap-1.5 shrink-0">
                        <span>🔑</span> Rental Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ======================================================== -->
    <!-- 11. MODAL AJAKAN LOGIN (JIKA BELUM LOGIN)                -->
    <!-- ======================================================== -->
    <div id="modalLoginPrompt" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/60 backdrop-blur-sm transition">
        <div class="bg-white dark:bg-slate-900 rounded-3xl max-w-md w-full p-6 text-center shadow-2xl border border-slate-200 dark:border-slate-800 animate-fadeInUp">
            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-blue-50 dark:bg-blue-950/60 text-[#004B87] dark:text-sky-300 flex items-center justify-center text-3xl shadow-inner">
                🔐
            </div>
            <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mb-2">
                Silakan Masuk Terlebih Dahulu
            </h3>
            <p id="loginPromptDesc" class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                Untuk menyewa kendaraan di GoAnywhere, Anda perlu masuk ke akun atau mendaftar terlebih dahulu agar proses booking dan verifikasi KTP dapat tercatat dengan aman.
            </p>
            <div class="flex items-center gap-3">
                <button type="button" onclick="closeLoginPromptModal()" class="flex-1 py-2.5 px-4 rounded-xl text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 transition">
                    Batal
                </button>
                <a href="{{ route('login') }}" class="flex-1 py-2.5 px-4 rounded-xl text-xs font-bold text-white bg-[#004B87] hover:bg-[#002D55] shadow-md transition">
                    Masuk Sekarang
                </a>
            </div>
            <div class="mt-4 text-xs text-slate-500">
                Belum punya akun? <a href="{{ route('register') }}" class="text-[#004B87] font-bold underline">Daftar di sini</a>
            </div>
        </div>
    </div>

    <!-- ======================================================== -->
    <!-- 12. SCRIPT INTERAKTIF FILTER & MODAL                     -->
    <!-- ======================================================== -->
    <script>
        const isUserLoggedIn = @json(auth()->check());
        let currentSelectedVehicle = null;

        // Terapkan filter real-time pada katalog kendaraan
        function applyFilter() {
            const selectedType = document.getElementById('filterType').value;
            const selectedLocation = document.getElementById('filterLocation').value;
            const items = document.querySelectorAll('.vehicle-card-item');
            let visibleCount = 0;

            items.forEach(item => {
                const itemType = item.getAttribute('data-type');
                const itemLocation = item.getAttribute('data-location');

                const typeMatch = (selectedType === 'all' || itemType === selectedType);
                const locationMatch = (selectedLocation === 'all' || itemLocation.toLowerCase() === selectedLocation.toLowerCase());

                if (typeMatch && locationMatch) {
                    item.style.display = 'flex';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            // Update badge dan kondisi jika tidak ada hasil
            const badge = document.getElementById('resultCountBadge');
            const noResultBox = document.getElementById('noFilterResult');
            const grid = document.getElementById('vehicleGrid');

            if (visibleCount > 0) {
                badge.textContent = visibleCount + ' Unit Ditemukan';
                noResultBox.classList.add('hidden');
                grid.classList.remove('hidden');
            } else {
                badge.textContent = '0 Unit';
                noResultBox.classList.remove('hidden');
                grid.classList.add('hidden');
            }

            // Scroll halus ke katalog armada
            document.getElementById('armada').scrollIntoView({ behavior: 'smooth' });
        }

        // Quick filter dari klik tombol cabang
        function quickFilterLocation(loc) {
            document.getElementById('filterLocation').value = loc;
            applyFilter();
        }

        // Reset filter menampilkan semua
        function resetFilter() {
            document.getElementById('filterType').value = 'all';
            document.getElementById('filterLocation').value = 'all';
            applyFilter();
        }

        // Buka modal detail spesifikasi
        function openVehicleDetailModal(vehicle) {
            currentSelectedVehicle = vehicle;
            const modal = document.getElementById('modalVehicleDetail');

            document.getElementById('detailModalImage').src = vehicle.image || '{{ asset('GoAnywhereLogo.png') }}';
            document.getElementById('detailModalLocation').textContent = '📍 Cabang ' + vehicle.location;
            document.getElementById('detailModalStock').textContent = '✅ Siap: ' + vehicle.stock + ' Unit';
            document.getElementById('detailModalBrandYear').textContent = vehicle.brand + ' • Tahun ' + vehicle.year;
            document.getElementById('detailModalName').textContent = vehicle.name;
            document.getElementById('detailModalTrans').textContent = vehicle.transmission;
            document.getElementById('detailModalCapacity').textContent = vehicle.capacity + ' Orang';
            document.getElementById('detailModalFuel').textContent = vehicle.fuel;
            document.getElementById('detailModalColor').textContent = vehicle.color;
            document.getElementById('detailModalDesc').textContent = vehicle.description;
            document.getElementById('detailModalPriceDay').textContent = vehicle.price_day;

            const weekRow = document.getElementById('detailModalPriceWeekRow');
            if (vehicle.has_week) {
                weekRow.style.display = 'block';
                document.getElementById('detailModalPriceWeek').textContent = vehicle.price_week;
            } else {
                weekRow.style.display = 'none';
            }

            // Handler tombol sewa di dalam modal detail
            document.getElementById('detailModalRentBtn').onclick = function() {
                handleRentalAction(vehicle);
            };

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeVehicleDetailModal() {
            const modal = document.getElementById('modalVehicleDetail');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Buka / Tutup Modal Prompt Login
        function openLoginPromptModal(vehicleName) {
            const modal = document.getElementById('modalLoginPrompt');
            const desc = document.getElementById('loginPromptDesc');
            if (vehicleName) {
                desc.innerHTML = 'Untuk menyewa armada <strong>"' + vehicleName + '"</strong>, silakan masuk ke akun Anda terlebih dahulu agar pesanan langsung tersimpan ke keranjang Anda.';
            }
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeLoginPromptModal() {
            const modal = document.getElementById('modalLoginPrompt');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Tindakan saat tombol Sewa / Rental diklik
        function handleRentalAction(vehicle) {
            if (!isUserLoggedIn) {
                openLoginPromptModal(vehicle.name);
            } else {
                // Jika sudah login, bawa ke halaman detail armada user
                window.location.href = "{{ url('user/armada') }}/" + vehicle.id;
            }
        }

        // Inisialisasi awal saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            applyFilter();
        });
    </script>
</body>
</html>
