<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center gap-2">
            <svg class="w-6 h-6 text-[#004B87] dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            Kelola Manager
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                 <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4"> {{ session('success') }}</div>
            @endif
            @if(session('error'))
                 <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4"> {{ session('error') }}</div>
            @endif

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl mb-6 shadow-sm">
                    <div class="font-bold mb-1 flex items-center gap-1.5 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        Terdapat kesalahan pada input data manager:
                    </div>
                    <ul class="list-disc list-inside text-xs space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Tambah Manager -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 mb-8 border border-slate-100 dark:border-slate-700">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-5 flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#004B87] dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    Tambah Manager Baru
                </h3>
                <form action="{{ route('superadmin.managers.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @csrf
                    <div>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Manager" required class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <input type="password" name="password" placeholder="Password (Min. 8 karakter)" required class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="No WhatsApp (contoh: 081234567890)" required class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 @error('phone') border-red-500 @enderror">
                        @error('phone')
                            <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <select name="location" required class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 @error('location') border-red-500 @enderror">
                            <option value="">Pilih Lokasi</option>
                            @foreach($locations as $loc)
                                <option value="{{ $loc }}" {{ old('location') == $loc ? 'selected' : '' }}>{{ $loc }}</option>
                            @endforeach
                        </select>
                        @error('location')
                            <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="bg-[#004B87] hover:bg-[#002D55] text-white font-semibold px-4 py-2.5 rounded-lg transition duration-250 shadow-md shadow-[#004B87]/15 h-[42px]">Tambah Manager</button>
                </form>
            </div>

            <!-- List Manager -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($managers as $manager)
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition duration-300 flex flex-col justify-between">
                        <div>
                            <!-- Header Card: Avatar & Name -->
                            <div class="flex items-center space-x-4 mb-4">
                                <div class="w-12 h-12 rounded-full bg-[#F0F4F8] flex items-center justify-center text-[#004B87] font-bold text-lg border border-[#6A9BD1]/30">
                                    {{ strtoupper(substr($manager->name, 0, 2)) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-base text-slate-900 truncate leading-snug">{{ $manager->name }}</h4>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-[#F0F4F8]/80 text-[#002D55] border border-[#6A9BD1]/30/50 mt-1">
                                        {{ $manager->location }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Manager Details -->
                            <div class="space-y-3 text-sm text-slate-600 mb-6">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="truncate">{{ $manager->email }}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    <span>{{ $manager->phone ?? '-' }}</span>
                                </div>
                                <div class="flex items-center justify-between pt-2 border-t border-slate-100 text-xs">
                                    <span class="text-slate-500">Armada Dikelola:</span>
                                    <span class="font-bold {{ ($manager->assigned_vehicles_count ?? 0) > 0 ? 'text-[#004B87]' : 'text-slate-400' }}">
                                        {{ $manager->assigned_vehicles_count ?? 0 }} Kendaraan
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Actions -->
                        <div class="border-t border-slate-100 pt-4 mt-auto">
                            @php
                                $vehicleCount = $manager->assigned_vehicles_count ?? 0;
                            @endphp
                            @if($vehicleCount > 0)
                                <button type="button" disabled class="w-full bg-slate-100 text-slate-400 font-semibold py-2.5 px-4 rounded-xl text-sm flex items-center justify-center space-x-1.5 border border-slate-200 cursor-not-allowed opacity-75" title="Manager tidak dapat dihapus karena masih mengelola {{ $vehicleCount }} armada di {{ $manager->location }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                    <span>Masih Ada {{ $vehicleCount }} Armada</span>
                                </button>
                            @else
                                <form action="{{ route('superadmin.managers.destroy', $manager->id) }}" method="POST" onsubmit="return confirm('Hapus manager {{ $manager->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-600 font-semibold py-2.5 px-4 rounded-xl transition duration-200 text-sm flex items-center justify-center space-x-1.5 border border-red-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        <span>Hapus Manager</span>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-2xl border border-slate-200 p-8 text-center text-slate-500">
                        Belum ada manager
                    </div>
                @endforelse
            </div>

            @if($managers->hasPages())
                <div class="mt-8 flex flex-col items-center gap-2">
                    <div class="text-sm text-gray-500">
                        Menampilkan <strong>{{ $managers->firstItem() ?? 0 }}</strong> - <strong>{{ $managers->lastItem() ?? 0 }}</strong> dari <strong>{{ $managers->total() }}</strong> manager
                    </div>
                    <div>
                        {{ $managers->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
