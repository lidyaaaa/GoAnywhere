<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center gap-2">
            <svg class="w-6 h-6 text-[#004B87] dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
            </svg>
            Kelola Semua Armada
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

            <!-- List Kendaraan -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($vehicles as $vehicle)
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition duration-300 flex flex-col justify-between">
                        <div>
                            <!-- Header Card: Brand & Name -->
                            <div class="flex justify-between items-start mb-4">
                                <div class="min-w-0 flex-1 pr-2">
                                    <span class="text-xs font-semibold text-[#004B87] uppercase tracking-wider block mb-0.5">{{ $vehicle->brand }}</span>
                                    <h4 class="font-bold text-base text-slate-900 truncate leading-snug">{{ $vehicle->name }}</h4>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-[#F0F4F8] text-[#002D55] border border-[#6A9BD1]/30 shrink-0">
                                    {{ $vehicle->location }}
                                </span>
                            </div>
                            
                            <!-- Vehicle Details -->
                            <div class="space-y-4 text-sm text-slate-650 mb-6">
                                <!-- Stock Info -->
                                <div>
                                    <div class="flex items-center justify-between mb-1.5">
                                        <span class="text-slate-500">Stok Tersedia:</span>
                                        <span class="font-bold text-slate-900">
                                            {{ $vehicle->available_stock }} <span class="text-xs text-slate-500 font-normal">/ {{ $vehicle->total_stock }}</span>
                                        </span>
                                    </div>
                                    <!-- Stock Progress Bar -->
                                    <div class="w-full bg-slate-100 rounded-full h-1.5 border border-slate-200/50">
                                        @php
                                            $stockPercentage = $vehicle->total_stock > 0 ? ($vehicle->available_stock / $vehicle->total_stock) * 100 : 0;
                                            $barColor = $stockPercentage > 50 ? 'bg-green-500' : ($stockPercentage > 20 ? 'bg-yellow-500' : 'bg-red-500');
                                        @endphp
                                        <div class="{{ $barColor }} h-1.5 rounded-full transition-all duration-500" style="width: {{ $stockPercentage }}%"></div>
                                    </div>
                                </div>
                                
                                <!-- Manager Info -->
                                <div class="flex items-center justify-between border-t border-slate-100 pt-3">
                                    <span class="text-slate-500">Manager:</span>
                                    <span class="font-semibold text-slate-800 truncate max-w-[150px]">{{ $vehicle->manager->name ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Actions -->
                        <div class="border-t border-slate-100 pt-4 mt-auto">
                            <form action="{{ route('superadmin.vehicles.destroy', $vehicle->id) }}" method="POST" onsubmit="return confirm('Hapus kendaraan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-600 font-semibold py-2.5 px-4 rounded-xl transition duration-200 text-sm flex items-center justify-center space-x-1.5 border border-red-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    <span>Hapus Armada</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-2xl border border-slate-200 p-8 text-center text-slate-500">
                        Belum ada kendaraan
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>