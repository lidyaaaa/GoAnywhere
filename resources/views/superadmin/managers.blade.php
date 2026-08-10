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
                    <input type="text" name="name" placeholder="Nama Manager" required class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                    <input type="email" name="email" placeholder="Email" required class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                    <input type="password" name="password" placeholder="Password" required class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                    <input type="text" name="phone" placeholder="No HP" class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                    <select name="location" required class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                        <option value="">Pilih Lokasi</option>
                        @foreach($locations as $loc)
                            <option value="{{ $loc }}">{{ $loc }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-[#004B87] hover:bg-[#002D55] text-white font-semibold px-4 py-2.5 rounded-lg transition duration-250 shadow-md shadow-[#004B87]/15">Tambah Manager</button>
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
                            </div>
                        </div>
                        
                        <!-- Actions -->
                        <div class="border-t border-slate-100 pt-4 mt-auto">
                            <form action="{{ route('superadmin.managers.destroy', $manager->id) }}" method="POST" onsubmit="return confirm('Hapus manager ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-600 font-semibold py-2.5 px-4 rounded-xl transition duration-200 text-sm flex items-center justify-center space-x-1.5 border border-red-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    <span>Hapus Manager</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-2xl border border-slate-200 p-8 text-center text-slate-500">
                        Belum ada manager
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>