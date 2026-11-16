<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-800 dark:text-slate-100 leading-tight flex items-center gap-2.5">
                    <span class="text-2xl">🚗</span> Kelola Semua Armada (Super Admin)
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    Monitoring dan manajemen seluruh armada kendaraan di cabang Jakarta, Bogor, Depok, Tangerang, dan Bekasi.
                </p>
            </div>
            <div class="flex items-center gap-2">
                <span class="px-3.5 py-1.5 bg-[#004B87]/10 text-[#004B87] dark:text-sky-300 font-bold text-xs rounded-full border border-[#004B87]/20 flex items-center gap-1.5 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Total Model: {{ $stats['total_vehicles'] }} Armada
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-2xl text-sm font-semibold flex items-center gap-2 shadow-sm">
                    <span>✅</span> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-2xl text-sm font-semibold flex items-center gap-2 shadow-sm">
                    <span>⚠️</span> {{ session('error') }}
                </div>
            @endif

            <!-- ===== 1. KARTU STATISTIK ARMADA ===== -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Total Model Armada -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Model Armada</span>
                        <div class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-lg text-slate-700">
                            🚘
                        </div>
                    </div>
                    <div class="text-2xl font-black text-slate-800 dark:text-white">{{ $stats['total_vehicles'] }}</div>
                    <p class="text-xs text-slate-500 mt-1">{{ $stats['total_cars'] }} Mobil • {{ $stats['total_motorcycles'] }} Sepeda Motor</p>
                </div>

                <!-- Total Stok Fisik -->
                <div class="bg-white dark:bg-slate-900 border border-blue-200/80 dark:border-slate-800 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold uppercase tracking-wider text-blue-600">Total Stok Unit</span>
                        <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-950/60 flex items-center justify-center text-lg text-blue-700">
                            📦
                        </div>
                    </div>
                    <div class="text-2xl font-black text-blue-700 dark:text-sky-300">{{ $stats['total_stock'] }} Unit</div>
                    <p class="text-xs text-slate-500 mt-1">Akumulasi seluruh unit fisik di garasi</p>
                </div>

                <!-- Stok Siap Disewa -->
                <div class="bg-white dark:bg-slate-900 border border-emerald-200/80 dark:border-slate-800 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold uppercase tracking-wider text-emerald-600">Siap Disewa</span>
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 flex items-center justify-center text-lg text-emerald-700">
                            ✅
                        </div>
                    </div>
                    <div class="text-2xl font-black text-emerald-700 dark:text-emerald-400">{{ $stats['available_stock'] }} Unit</div>
                    <p class="text-xs text-slate-500 mt-1">Tersedia untuk disewa customer</p>
                </div>

                <!-- Unit Rusak/Servis -->
                <div class="bg-white dark:bg-slate-900 border border-amber-200/80 dark:border-slate-800 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold uppercase tracking-wider text-amber-600">Dalam Servis / Rusak</span>
                        <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-950/60 flex items-center justify-center text-lg text-amber-700">
                            🛠️
                        </div>
                    </div>
                    <div class="text-2xl font-black text-amber-700 dark:text-amber-400">{{ $stats['damaged_stock'] }} Unit</div>
                    <p class="text-xs text-slate-500 mt-1">Sedang di bengkel perbaikan</p>
                </div>
            </div>

            <!-- ===== 2. FORM SEARCH BY KENDARAAN & SEARCH BY MANAGER ===== -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 rounded-2xl p-5 shadow-sm">
                <form action="{{ route('superadmin.vehicles') }}" method="GET" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
                        
                        <!-- 1. Search by Kendaraan -->
                        <div class="md:col-span-4">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 dark:text-slate-300 mb-1.5">
                                🔍 Cari Kendaraan
                            </label>
                            <input type="text" 
                                   name="search" 
                                   value="{{ $search }}" 
                                   placeholder="Cari Nama Kendaraan, Brand, Tipe, Tahun..." 
                                   class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-xl text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400 focus:bg-white focus:border-[#004B87] focus:ring-2 focus:ring-[#004B87]/20 transition">
                        </div>

                        <!-- 2. Search / Filter by Manager (Dropdown) -->
                        <div class="md:col-span-3">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 dark:text-slate-300 mb-1.5">
                                🏢 Filter Manager Cabang
                            </label>
                            <select name="manager_id" onchange="this.form.submit()" class="w-full py-2.5 px-3 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-xl text-sm text-slate-800 dark:text-slate-100 focus:bg-white focus:border-[#004B87] focus:ring-2 focus:ring-[#004B87]/20 transition">
                                <option value="all" {{ $managerId === 'all' ? 'selected' : '' }}>Semua Manager</option>
                                @foreach($managers as $m)
                                    <option value="{{ $m->id }}" {{ $managerId == $m->id ? 'selected' : '' }}>
                                        📍 {{ $m->location }} — {{ $m->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- 3. Text Search Manager (Pencarian Nama Manager) -->
                        <div class="md:col-span-3">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 dark:text-slate-300 mb-1.5">
                                👤 Cari Nama Manager
                            </label>
                            <input type="text" 
                                   name="manager_search" 
                                   value="{{ $managerSearch }}" 
                                   placeholder="Ketik nama atau email manager..." 
                                   class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-xl text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400 focus:bg-white focus:border-[#004B87] focus:ring-2 focus:ring-[#004B87]/20 transition">
                        </div>

                        <!-- 4. Tombol Filter & Reset -->
                        <div class="md:col-span-2 flex items-end gap-2">
                            <button type="submit" class="flex-1 py-2.5 px-4 bg-[#004B87] hover:bg-[#002D55] text-white font-bold text-sm rounded-xl transition shadow-sm flex items-center justify-center gap-1.5">
                                <span>Filter</span>
                            </button>
                            @if(!empty($search) || !empty($managerSearch) || $managerId !== 'all' || $location !== 'all' || $vehicleType !== 'all')
                                <a href="{{ route('superadmin.vehicles') }}" class="py-2.5 px-3.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 text-slate-700 dark:text-slate-300 font-bold text-sm rounded-xl transition border border-slate-300" title="Reset Semua Filter">
                                    ↺
                                </a>
                            @endif
                        </div>

                    </div>

                    <!-- Filter Pill Tipe & Lokasi Tambahan -->
                    <div class="flex items-center gap-2 flex-wrap pt-2 border-t border-slate-100 dark:border-slate-800 text-xs">
                        <span class="font-bold text-slate-500">Filter Cepat:</span>
                        
                        <!-- Tipe Armada -->
                        <a href="{{ route('superadmin.vehicles', array_merge(request()->query(), ['vehicle_type' => 'all'])) }}" 
                           class="px-3 py-1 rounded-lg font-bold transition {{ ($vehicleType === 'all') ? 'bg-[#004B87] text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                            Semua Tipe
                        </a>
                        <a href="{{ route('superadmin.vehicles', array_merge(request()->query(), ['vehicle_type' => 'car'])) }}" 
                           class="px-3 py-1 rounded-lg font-bold transition {{ ($vehicleType === 'car') ? 'bg-[#004B87] text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                            🚗 Mobil
                        </a>
                        <a href="{{ route('superadmin.vehicles', array_merge(request()->query(), ['vehicle_type' => 'motorcycle'])) }}" 
                           class="px-3 py-1 rounded-lg font-bold transition {{ ($vehicleType === 'motorcycle') ? 'bg-[#004B87] text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                            🏍️ Sepeda Motor
                        </a>

                        <span class="text-slate-300 dark:text-slate-700">|</span>

                        <!-- Cabang Lokasi -->
                        @foreach(['Jakarta', 'Bogor', 'Depok', 'Tangerang', 'Bekasi'] as $loc)
                            <a href="{{ route('superadmin.vehicles', array_merge(request()->query(), ['location' => ($location === $loc ? 'all' : $loc)])) }}" 
                               class="px-3 py-1 rounded-lg font-bold transition {{ ($location === $loc) ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                                📍 {{ $loc }}
                            </a>
                        @endforeach
                    </div>
                </form>
            </div>

            <!-- ===== 3. GRID DAFTAR KENDARAAN ===== -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="font-extrabold text-base text-slate-800 dark:text-slate-100">
                        Daftar Armada Ditemukan: <span class="text-[#004B87]">{{ $vehicles->total() }} Unit</span>
                    </h3>
                    @if(!empty($search) || !empty($managerSearch) || $managerId !== 'all')
                        <span class="text-xs text-slate-500">
                            Menampilkan hasil pencarian armada & manager
                        </span>
                    @endif
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($vehicles as $vehicle)
                        @php
                            $rentedCount = max(0, $vehicle->total_stock - $vehicle->available_stock - ($vehicle->damaged_stock ?? 0));
                            $cannotDelete = ($vehicle->available_stock > 0 || $vehicle->total_stock > 0) || in_array($vehicle->id, $inCartOrBooked ?? []);
                            $deleteReason = ($vehicle->available_stock > 0 || $vehicle->total_stock > 0) 
                                ? 'Stok belum 0' 
                                : 'Sedang dibooking/disewa user';
                        @endphp

                        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200/90 dark:border-slate-800 shadow-sm hover:shadow-md transition overflow-hidden flex flex-col justify-between">
                            <div>
                                <!-- Foto Armada & Badge Lokasi -->
                                <div class="relative h-44 bg-slate-100 dark:bg-slate-800 overflow-hidden flex items-center justify-center">
                                    @if($vehicle->image)
                                        <img src="{{ asset('storage/' . $vehicle->image) }}" alt="{{ $vehicle->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="text-5xl opacity-40">
                                            {{ $vehicle->vehicle_type === 'car' ? '🚗' : '🏍️' }}
                                        </div>
                                    @endif

                                    <!-- Badge Lokasi Cabang -->
                                    <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-xs font-extrabold bg-[#004B87] text-white shadow-md flex items-center gap-1">
                                        <span>📍</span> Cabang {{ $vehicle->location }}
                                    </span>

                                    <!-- Badge Tipe -->
                                    <span class="absolute top-3 right-3 px-2.5 py-1 rounded-full text-[11px] font-bold {{ $vehicle->vehicle_type === 'car' ? 'bg-blue-100 text-blue-800' : 'bg-emerald-100 text-emerald-800' }} shadow-sm">
                                        {{ $vehicle->vehicle_type === 'car' ? 'Mobil' : 'Motor' }} ({{ $vehicle->type ?? '-' }})
                                    </span>
                                </div>

                                <!-- Body Card -->
                                <div class="p-5 space-y-3">
                                    <!-- Nama & Brand -->
                                    <div>
                                        <span class="text-xs font-bold uppercase tracking-wider text-[#004B87] dark:text-sky-300">
                                            {{ $vehicle->brand }} • {{ $vehicle->year }}
                                        </span>
                                        <h4 class="font-extrabold text-lg text-slate-900 dark:text-white capitalize truncate" title="{{ $vehicle->name }}">
                                            {{ $vehicle->name }}
                                        </h4>
                                    </div>

                                    <!-- Manager Penanggung Jawab -->
                                    <div class="p-2.5 rounded-xl bg-slate-50 dark:bg-slate-800/80 border border-slate-200/70 dark:border-slate-700/80 flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-950 text-[#004B87] dark:text-sky-300 font-extrabold text-xs flex items-center justify-center shrink-0">
                                            {{ strtoupper(substr($vehicle->manager->name ?? 'M', 0, 2)) }}
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <div class="text-xs font-bold text-slate-800 dark:text-slate-100 truncate">
                                                {{ $vehicle->manager->name ?? 'Tanpa Manager' }}
                                            </div>
                                            <div class="text-[11px] text-slate-500 truncate">
                                                {{ $vehicle->manager->email ?? '-' }}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 4 Pill Stock Box (Kontras Tinggi) -->
                                    <div class="grid grid-cols-2 gap-2 text-xs">
                                        <div style="background: #f1f5f9; color: #1e293b; border: 1px solid #cbd5e1;" class="flex items-center justify-between p-2 rounded-xl shadow-sm">
                                            <span class="font-semibold">📦 Total</span>
                                            <strong class="font-extrabold text-sm">{{ $vehicle->total_stock }}</strong>
                                        </div>
                                        <div style="background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;" class="flex items-center justify-between p-2 rounded-xl shadow-sm">
                                            <span class="font-semibold">✅ Siap</span>
                                            <strong class="font-extrabold text-sm">{{ $vehicle->available_stock }} unit</strong>
                                        </div>
                                        <div style="background: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe;" class="flex items-center justify-between p-2 rounded-xl shadow-sm">
                                            <span class="font-semibold">🚗 Disewa</span>
                                            <strong class="font-extrabold text-sm">{{ $rentedCount }} unit</strong>
                                        </div>
                                        <div style="{{ ($vehicle->damaged_stock ?? 0) > 0 ? 'background: #fff1f2; color: #9f1239; border: 1px solid #fecdd3;' : 'background: #f8fafc; color: #94a3b8; border: 1px solid #e2e8f0;' }}" class="flex items-center justify-between p-2 rounded-xl shadow-sm">
                                            <span class="font-semibold">🛠️ Rusak</span>
                                            <strong class="font-extrabold text-sm">{{ $vehicle->damaged_stock ?? 0 }} unit</strong>
                                        </div>
                                    </div>

                                    <!-- Tarif Harga -->
                                    <div class="pt-1">
                                        <div class="text-xs text-slate-500">Tarif Sewa:</div>
                                        <div class="text-lg font-black text-[#004B87] dark:text-sky-300">
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

                            <!-- Tombol Aksi Hapus -->
                            <div class="p-5 pt-0 border-t border-slate-100 dark:border-slate-800 mt-2">
                                @if($cannotDelete)
                                    <button type="button" disabled class="w-full bg-slate-100 text-slate-400 font-bold py-2.5 px-4 rounded-xl text-xs flex items-center justify-center gap-1.5 border border-slate-200 cursor-not-allowed opacity-60" title="Tidak dapat dihapus: {{ $deleteReason }}">
                                        <span>🔒</span> Hapus ({{ $deleteReason }})
                                    </button>
                                @else
                                    <form action="{{ route('superadmin.vehicles.destroy', $vehicle->id) }}" method="POST" onsubmit="return confirm('Konfirmasi: Hapus armada {{ $vehicle->name }} secara permanen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full bg-rose-50 hover:bg-rose-100 text-rose-700 font-bold py-2.5 px-4 rounded-xl transition text-xs flex items-center justify-center gap-1.5 border border-rose-200 shadow-sm">
                                            <span>🗑️</span> Hapus Armada
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 p-12 text-center">
                            <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-3xl text-slate-400">
                                🔍
                            </div>
                            <h4 class="text-base font-bold text-slate-800 dark:text-white mb-1">Tidak Ada Armada Ditemukan</h4>
                            <p class="text-xs text-slate-500 max-w-md mx-auto mb-4">
                                Tidak ada kendaraan yang cocok dengan kata kunci pencarian kendaraan atau nama manager yang Anda masukkan.
                            </p>
                            @if(!empty($search) || !empty($managerSearch) || $managerId !== 'all' || $location !== 'all' || $vehicleType !== 'all')
                                <a href="{{ route('superadmin.vehicles') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-800 text-white font-bold text-xs rounded-xl hover:bg-slate-900 transition">
                                    <span>↺ Reset Pencarian</span>
                                </a>
                            @endif
                        </div>
                    @endforelse
                </div>

                <!-- Paginasi -->
                @if($vehicles->hasPages())
                    <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-3 bg-white dark:bg-slate-900 p-4 rounded-2xl border border-slate-200 dark:border-slate-800">
                        <div class="text-xs text-slate-500">
                            Menampilkan {{ $vehicles->firstItem() }} - {{ $vehicles->lastItem() }} dari {{ $vehicles->total() }} total armada
                        </div>
                        <div>
                            {{ $vehicles->links() }}
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
