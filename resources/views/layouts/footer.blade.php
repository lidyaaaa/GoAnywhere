<!-- ======================================================== -->
<!-- GOANYWHERE OFFICIAL FOOTER                               -->
<!-- ======================================================== -->
<footer class="bg-white dark:bg-slate-900 border-t border-slate-200/80 dark:border-slate-800 pt-14 pb-8 relative z-10 transition">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 lg:gap-12">
            
            <!-- Kolom 1: Brand Info -->
            <div class="space-y-4 md:col-span-1">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('GoAnywhereLogo.png') }}" alt="GoAnywhere Logo" class="w-9 h-9 object-contain rounded-xl shadow-sm shrink-0">
                    <span class="font-black text-2xl text-slate-900 dark:text-white tracking-tight">Go<span class="text-[#004B87] dark:text-sky-400">Anywhere</span></span>
                </div>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                    Platform rental mobil & sepeda motor modern terpercaya di wilayah Jabodetabek. Menghadirkan armada prima, higienis, dan layanan pengantaran langsung ke pintu Anda.
                </p>
                <div class="flex items-center gap-2 pt-1">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Armada Siap Jalan
                    </span>
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-blue-50 text-blue-700 dark:bg-blue-950/60 dark:text-blue-300 border border-blue-200 dark:border-blue-800">
                        ⚡ Booking Cepat
                    </span>
                </div>
            </div>

            <!-- Kolom 2: Cabang Gerai Jabodetabek -->
            <div>
                <h4 class="font-extrabold text-xs uppercase tracking-wider text-slate-800 dark:text-slate-200 mb-4 flex items-center gap-2">
                    <span class="text-base">🏢</span> Gerai Cabang Kami
                </h4>
                <ul class="space-y-2.5 text-xs text-slate-500 dark:text-slate-400">
                    <li class="flex items-center gap-2 hover:text-[#004B87] transition cursor-pointer">
                        <span class="text-rose-500">📍</span> Cabang Jakarta (Pusat)
                    </li>
                    <li class="flex items-center gap-2 hover:text-[#004B87] transition cursor-pointer">
                        <span class="text-rose-500">📍</span> Cabang Bogor
                    </li>
                    <li class="flex items-center gap-2 hover:text-[#004B87] transition cursor-pointer">
                        <span class="text-rose-500">📍</span> Cabang Depok
                    </li>
                    <li class="flex items-center gap-2 hover:text-[#004B87] transition cursor-pointer">
                        <span class="text-rose-500">📍</span> Cabang Tangerang
                    </li>
                    <li class="flex items-center gap-2 hover:text-[#004B87] transition cursor-pointer">
                        <span class="text-rose-500">📍</span> Cabang Bekasi
                    </li>
                </ul>
            </div>

            <!-- Kolom 3: Menu Navigasi Cepat -->
            <div>
                <h4 class="font-extrabold text-xs uppercase tracking-wider text-slate-800 dark:text-slate-200 mb-4 flex items-center gap-2">
                    <span class="text-base">🧭</span> Navigasi
                </h4>
                <ul class="space-y-2.5 text-xs text-slate-500 dark:text-slate-400">
                    <li>
                        <a href="{{ route('user.home') }}" class="hover:text-[#004B87] dark:hover:text-sky-300 transition flex items-center gap-1.5">
                            <span>🏠</span> Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.layanan') }}" class="hover:text-[#004B87] dark:hover:text-sky-300 transition flex items-center gap-1.5">
                            <span>✨</span> Layanan Kami
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.armada') }}" class="hover:text-[#004B87] dark:hover:text-sky-300 transition flex items-center gap-1.5">
                            <span>🚗</span> Katalog Armada
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.profile') }}" class="hover:text-[#004B87] dark:hover:text-sky-300 transition flex items-center gap-1.5">
                            <span>📍</span> Lokasi & Kontak Cabang
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.cart') }}" class="hover:text-[#004B87] dark:hover:text-sky-300 transition flex items-center gap-1.5">
                            <span>🛒</span> Keranjang Belanja
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Kolom 4: Hubungi Kami & Jam Kerja -->
            <div>
                <h4 class="font-extrabold text-xs uppercase tracking-wider text-slate-800 dark:text-slate-200 mb-4 flex items-center gap-2">
                    <span class="text-base">📞</span> Layanan Pelanggan
                </h4>
                <div class="space-y-2.5 text-xs text-slate-500 dark:text-slate-400">
                    <div class="flex items-center gap-2">
                        <span class="text-emerald-500">💬</span>
                        <span>WhatsApp: <b>0812-3456-7890</b></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-blue-500">✉️</span>
                        <span>Email: <b>info@goanywhere.com</b></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-amber-500">⏰</span>
                        <span>Operasional: <b>08:00 - 22:00 WIB</b></span>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-t border-slate-100 dark:border-slate-800">
                    <a href="https://wa.me/628157184307" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-sm transition">
                        <span>💬</span> Chat WhatsApp Support
                    </a>
                </div>
            </div>

        </div>

        <!-- Copyright & Bottom Bar -->
        <div class="border-t border-slate-100 dark:border-slate-800 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
            <div>
                &copy; {{ date('Y') }} <strong>GoAnywhere</strong>. Seluruh Hak Cipta Dilindungi. Solusi rental kendaraan prima di Jabodetabek.
            </div>
            <div class="flex items-center gap-4 text-slate-400">
                <span class="hover:text-[#004B87] cursor-pointer">Syarat & Ketentuan</span>
                <span>&bull;</span>
                <span class="hover:text-[#004B87] cursor-pointer">Kebijakan Privasi</span>
                <span>&bull;</span>
                <span class="hover:text-[#004B87] cursor-pointer">Bantuan</span>
            </div>
        </div>
    </div>
</footer>
