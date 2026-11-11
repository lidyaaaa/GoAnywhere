<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center gap-2">
                <svg class="w-6 h-6 text-[#43637E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
                Pesan & Chat Customer
            </h2>
            <span class="text-xs font-semibold bg-[#43637E]/10 text-[#43637E] dark:text-[#8baac4] px-3 py-1.5 rounded-full">
                Lokasi: {{ Auth::user()->location ?? 'Manager' }}
            </span>
        </div>
    </x-slot>

    <style>
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
            background: linear-gradient(135deg, #2c3e50, #43637E);
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
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if($conversations->count() > 0)
                <div class="space-y-3">
                    @foreach($conversations as $item)
                        @php
                            $unread = $item->unreadCountFor(auth()->id());
                            $latest = $item->latestMessage;
                        @endphp
                        <a href="{{ route('manager.chat.show', $item->id) }}" class="chat-card block p-5">
                            <div class="flex items-center gap-4">
                                <div class="avatar-circle">
                                    {{ strtoupper(substr($item->user->name ?? 'U', 0, 2)) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between mb-1">
                                        <h3 class="font-bold text-gray-900 dark:text-white text-base truncate">
                                            {{ $item->user->name ?? 'Customer' }}
                                            <span class="text-xs text-gray-400 font-normal ml-1">({{ $item->user->email }})</span>
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
                                                    {{ $latest->sender_id === auth()->id() ? 'Anda: ' : ($item->user->name . ': ') }}
                                                </span>
                                                {{ $latest->message }}
                                            @else
                                                <em>Belum ada pesan</em>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-2 font-serif">Belum Ada Pesan Masuk</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm max-w-md mx-auto">
                        Ketika user/customer menghubungi Anda mengenai armada atau transaksi sewa, obrolan mereka akan muncul di sini secara otomatis.
                    </p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
