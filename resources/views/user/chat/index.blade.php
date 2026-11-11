<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center gap-2">
                <svg class="w-6 h-6 text-[#43637E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                Pesan & Chat Manager Armada
            </h2>
            <a href="{{ route('user.armada') }}" class="text-sm font-semibold text-[#43637E] hover:underline flex items-center gap-1">
                <span>Cari Armada Lain</span> &rarr;
            </a>
        </div>
    </x-slot>

    <style>
        .chat-index-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .chat-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #e8e4de;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        }

        .chat-card:hover {
            border-color: #43637E;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(67, 99, 126, 0.12);
        }

        .avatar-circle {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: linear-gradient(135deg, #43637E, #2c3e50);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 18px;
            flex-shrink: 0;
        }

        .badge-vehicle {
            background: rgba(67, 99, 126, 0.1);
            color: #43637E;
            font-size: 12px;
            padding: 2px 10px;
            border-radius: 20px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .unread-indicator {
            background: #43637E;
            color: white;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 12px;
        }

        /* DARK MODE */
        .dark .chat-card {
            background: #1a2632;
            border-color: #2c3e50;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .dark .chat-card:hover {
            border-color: #43637E;
        }

        .dark .badge-vehicle {
            background: rgba(67, 99, 126, 0.3);
            color: #8baac4;
        }
    </style>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="chat-index-container">

                @if(session('success'))
                    <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                @if($conversations->count() > 0)
                    <div class="space-y-3">
                        @foreach($conversations as $item)
                            @php
                                $unread = $item->unreadCountFor(auth()->id());
                                $latest = $item->latestMessage;
                            @endphp
                            <a href="{{ route('user.chat.show', $item->id) }}" class="chat-card block p-5">
                                <div class="flex items-center gap-4">
                                    <div class="avatar-circle">
                                        {{ strtoupper(substr($item->manager->name ?? 'M', 0, 2)) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        @php
                                            $mName = $item->manager->name ?? 'Armada';
                                            $mgrDisplayName = str_starts_with(strtolower($mName), 'manager') ? $mName : 'Manager ' . $mName;
                                        @endphp
                                        <div class="flex items-center justify-between mb-1">
                                            <h3 class="font-bold text-gray-900 dark:text-white text-base truncate">
                                                {{ $mgrDisplayName }}
                                                @if($item->manager->location)
                                                    <span class="text-xs text-gray-500 font-normal">({{ $item->manager->location }})</span>
                                                @endif
                                            </h3>
                                            <span class="text-xs text-gray-400 shrink-0">
                                                {{ $latest ? $latest->created_at->diffForHumans() : $item->updated_at->diffForHumans() }}
                                            </span>
                                        </div>

                                        @if($item->vehicle)
                                            <div class="mb-1.5">
                                                <span class="badge-vehicle">
                                                    🚗 {{ $item->vehicle->name }} ({{ $item->vehicle->location }})
                                                </span>
                                            </div>
                                        @endif

                                        <div class="flex items-center justify-between">
                                            <p class="text-sm text-gray-500 dark:text-gray-400 truncate pr-2">
                                                @if($latest)
                                                    <span class="font-medium {{ $latest->sender_id === auth()->id() ? 'text-[#43637E] dark:text-[#8baac4]' : '' }}">
                                                        {{ $latest->sender_id === auth()->id() ? 'Anda: ' : '' }}
                                                    </span>
                                                    {{ $latest->message }}
                                                @else
                                                    <em>Mulai percakapan dengan manager...</em>
                                                @endif
                                            </p>
                                            @if($unread > 0)
                                                <span class="unread-indicator shrink-0">
                                                    {{ $unread }} baru
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    @if($conversations->hasPages())
                        <div class="mt-6 flex justify-center">
                            {{ $conversations->links() }}
                        </div>
                    @endif

                @else
                    <div class="chat-card text-center py-16 px-6">
                        <div class="w-20 h-20 mx-auto rounded-full bg-slate-100 dark:bg-gray-800 flex items-center justify-center text-slate-400 mb-4">
                            <svg class="w-10 h-10 text-[#43637E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-2 font-serif">Belum Ada Percakapan</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm max-w-md mx-auto mb-6">
                            Anda dapat menghubungi manager armada langsung melalui halaman detail kendaraan atau sewa aktif Anda untuk menanyakan kondisi armada, ketersediaan, atau konfirmasi sewa.
                        </p>
                        <a href="{{ route('user.armada') }}" class="inline-flex items-center gap-2 bg-[#43637E] hover:bg-[#36546b] text-white px-6 py-2.5 rounded-xl font-semibold text-sm transition">
                            <span>Lihat Daftar Armada</span> &rarr;
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
