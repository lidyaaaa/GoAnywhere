<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('user.chat.index') }}" class="p-2 rounded-xl text-gray-500 hover:text-[#43637E] hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div>
                    @php
                        $mgrName = $conversation->manager->name ?? 'Armada';
                        $displayMgrName = str_starts_with(strtolower($mgrName), 'manager') ? $mgrName : 'Manager ' . $mgrName;
                    @endphp
                    <h2 class="font-bold text-lg text-gray-800 dark:text-gray-200 leading-tight">
                        {{ $displayMgrName }}
                    </h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        Lokasi: {{ $conversation->manager->location ?? 'Semua Lokasi' }}
                    </p>
                </div>
            </div>

            @if($conversation->vehicle)
                <a href="{{ route('user.armada.detail', $conversation->vehicle->id) }}" class="text-xs bg-[#43637E]/10 hover:bg-[#43637E]/20 text-[#43637E] dark:text-[#8baac4] font-semibold px-3 py-1.5 rounded-lg transition flex items-center gap-1.5">
                    <span>Lihat Unit {{ $conversation->vehicle->name }}</span> &rarr;
                </a>
            @endif
        </div>
    </x-slot>

    <style>
        .chat-layout {
            display: grid;
            grid-template-columns: 320px 1fr;
            height: calc(100vh - 160px);
            min-height: 560px;
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #e8e4de;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
        }

        @media (max-width: 900px) {
            .chat-layout {
                grid-template-columns: 1fr;
                height: calc(100vh - 140px);
            }
            .chat-sidebar {
                display: none;
            }
        }

        .chat-sidebar {
            border-right: 1px solid #edf0f2;
            background: #fbfbfd;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        /* Sidebar Item */
        .sidebar-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 14px;
            text-decoration: none;
            color: #2c3e50;
            background: transparent;
            transition: all 0.25s ease;
            margin-bottom: 6px;
        }

        .sidebar-item:hover {
            background: #f1f5f9;
        }

        .sidebar-item.active {
            background: #43637E !important;
            color: #ffffff !important;
            box-shadow: 0 4px 16px rgba(67, 99, 126, 0.35);
        }

        .sidebar-item.active .sidebar-item-title {
            color: #ffffff !important;
        }

        .sidebar-item.active .sidebar-item-sub {
            color: rgba(255, 255, 255, 0.85) !important;
        }

        .sidebar-item.active .sidebar-avatar {
            background: rgba(255, 255, 255, 0.25) !important;
            color: #ffffff !important;
        }

        .sidebar-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
            background: #e2e8f0;
            color: #43637E;
            transition: all 0.2s;
        }

        .sidebar-item-title {
            font-size: 14px;
            font-weight: 700;
            color: #2c3e50;
            line-height: 1.3;
        }

        .sidebar-item-sub {
            font-size: 12px;
            color: #7a8a9a;
            margin-top: 2px;
        }

        .chat-main {
            display: flex;
            flex-direction: column;
            background: #f6f7f9;
            height: 100%;
            position: relative;
        }

        .vehicle-banner {
            background: #ffffff;
            border-bottom: 1px solid #e8e4de;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .messages-container {
            flex: 1;
            overflow-y: auto;
            padding: 24px 20px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .message-bubble {
            max-width: 75%;
            padding: 12px 16px;
            border-radius: 18px;
            font-size: 14px;
            line-height: 1.45;
            position: relative;
            word-break: break-word;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03);
        }

        .message-me {
            align-self: flex-end;
            background: #43637E;
            color: #ffffff;
            border-bottom-right-radius: 4px;
        }

        .message-other {
            align-self: flex-start;
            background: #ffffff;
            color: #2c3e50;
            border-bottom-left-radius: 4px;
            border: 1px solid #edf0f2;
        }

        .message-time {
            font-size: 10px;
            margin-top: 4px;
            display: block;
            text-align: right;
            opacity: 0.8;
        }

        .chat-input-bar {
            background: #ffffff;
            border-top: 1px solid #e8e4de;
            padding: 14px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .chat-input-bar input {
            flex: 1;
            padding: 12px 18px;
            border-radius: 25px;
            border: 1.5px solid #e2e8f0;
            background: #f8fafc;
            font-size: 14px;
            outline: none;
            transition: all 0.2s;
        }

        .chat-input-bar input:focus {
            border-color: #43637E;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(67, 99, 126, 0.15);
        }

        .btn-send {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: #43637E;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            flex-shrink: 0;
        }

        .btn-send:hover {
            background: #36546b;
            transform: scale(1.05);
        }

        /* DARK MODE */
        .dark .chat-layout {
            background: #1a2632;
            border-color: #2c3e50;
        }
        .dark .chat-sidebar {
            background: #15222e;
            border-right-color: #2c3e50;
        }
        .dark .sidebar-item {
            color: #f0ede8;
        }
        .dark .sidebar-item:hover {
            background: rgba(255, 255, 255, 0.05);
        }
        .dark .sidebar-avatar {
            background: #243447;
            color: #8baac4;
        }
        .dark .sidebar-item-title {
            color: #f0ede8;
        }
        .dark .sidebar-item-sub {
            color: #8fa1b3;
        }
        .dark .chat-main {
            background: #0f1a24;
        }
        .dark .vehicle-banner {
            background: #1a2632;
            border-bottom-color: #2c3e50;
        }
        .dark .message-other {
            background: #1a2632;
            color: #f0ede8;
            border-color: #2c3e50;
        }
        .dark .chat-input-bar {
            background: #1a2632;
            border-top-color: #2c3e50;
        }
        .dark .chat-input-bar input {
            background: #0f1a24;
            border-color: #2c3e50;
            color: #ffffff;
        }
        .dark .chat-input-bar input:focus {
            border-color: #43637E;
        }
    </style>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="chat-layout">

                <!-- SIDEBAR PERCAKAPAN -->
                <div class="chat-sidebar p-4 space-y-1">
                    <div class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-3 px-2">
                        Daftar Obrolan
                    </div>
                    @foreach($conversations as $item)
                        @php
                            $isActive = $item->id === $conversation->id;
                            $mName = $item->manager->name ?? 'Armada';
                            $titleName = str_starts_with(strtolower($mName), 'manager') ? $mName : 'Manager ' . $mName;
                        @endphp
                        <a href="{{ route('user.chat.show', $item->id) }}" class="sidebar-item {{ $isActive ? 'active' : '' }}">
                            <div class="sidebar-avatar">
                                {{ strtoupper(substr($mName, 0, 2)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="sidebar-item-title truncate">
                                    {{ $titleName }}
                                </div>
                                <div class="sidebar-item-sub truncate">
                                    @if($item->vehicle)
                                        🚗 {{ $item->vehicle->name }}
                                    @else
                                        {{ $item->manager->location ?? 'General' }}
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- MAIN CHAT PANEL -->
                <div class="chat-main">

                    <!-- BANNER KENDARAAN (JIKA TERKAIT KENDARAAN) -->
                    @if($conversation->vehicle)
                        <div class="vehicle-banner">
                            <div class="flex items-center gap-3">
                                @if($conversation->vehicle->image)
                                    <img src="{{ asset('storage/' . $conversation->vehicle->image) }}" class="w-12 h-10 object-cover rounded-lg border border-slate-200 dark:border-slate-700" alt="{{ $conversation->vehicle->name }}">
                                @else
                                    <div class="w-12 h-10 bg-slate-100 dark:bg-gray-800 rounded-lg flex items-center justify-center text-xs">🚗</div>
                                @endif
                                <div>
                                    <h4 class="font-bold text-sm text-gray-900 dark:text-white">
                                        {{ $conversation->vehicle->brand }} {{ $conversation->vehicle->name }}
                                    </h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        Rp {{ number_format($conversation->vehicle->price_per_day, 0, ',', '.') }}/hari &bull; Lokasi {{ $conversation->vehicle->location }}
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('user.armada.detail', $conversation->vehicle->id) }}" class="text-xs font-semibold text-[#43637E] dark:text-[#8baac4] hover:underline shrink-0">
                                Detail & Sewa
                            </a>
                        </div>
                    @endif

                    <!-- MESSAGES LIST -->
                    <div id="messagesContainer" class="messages-container">
                        @forelse($conversation->messages as $msg)
                            @php $isMe = $msg->sender_id === auth()->id(); @endphp
                            <div class="message-bubble {{ $isMe ? 'message-me' : 'message-other' }}">
                                <div class="text-[11px] font-semibold mb-1 {{ $isMe ? 'text-white/80' : 'text-[#43637E] dark:text-[#8baac4]' }}">
                                    {{ $isMe ? 'Anda' : $displayMgrName }}
                                </div>
                                <div class="message-content">
                                    {{ $msg->message }}
                                </div>
                                <span class="message-time">
                                    {{ $msg->created_at->format('H:i') }}
                                </span>
                            </div>
                        @empty
                            <div id="emptyMessageNotice" class="text-center py-12 text-gray-400 text-sm">
                                <p>Belum ada pesan. Mulai sapa Manager armada untuk bertanya!</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- CHAT INPUT -->
                    <form id="chatForm" action="{{ route('user.chat.send', $conversation->id) }}" method="POST" class="chat-input-bar">
                        @csrf
                        <input type="text" id="messageInput" name="message" placeholder="Ketik pesan Anda untuk Manager armada..." autocomplete="off" required>
                        <button type="submit" class="btn-send" title="Kirim Pesan">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('messagesContainer');
            const form = document.getElementById('chatForm');
            const input = document.getElementById('messageInput');
            const pollUrl = "{{ route('user.chat.messages', $conversation->id) }}";

            function scrollToBottom() {
                container.scrollTop = container.scrollHeight;
            }
            scrollToBottom();

            // Submit via AJAX
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const text = input.value.trim();
                if (!text) return;

                const token = document.querySelector('input[name="_token"]').value;

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ message: text })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        input.value = '';
                        const emptyNotice = document.getElementById('emptyMessageNotice');
                        if (emptyNotice) emptyNotice.remove();

                        const bubble = document.createElement('div');
                        bubble.className = 'message-bubble message-me';
                        bubble.innerHTML = `
                            <div class="text-[11px] font-semibold mb-1 text-white/80">Anda</div>
                            <div class="message-content">${escapeHtml(data.message.message)}</div>
                            <span class="message-time">${data.message.created_at}</span>
                        `;
                        container.appendChild(bubble);
                        scrollToBottom();
                    }
                })
                .catch(err => {
                    form.submit();
                });
            });

            // Polling auto-refresh setiap 4 detik
            setInterval(function () {
                fetch(pollUrl, {
                    headers: { 'Accept': 'application/json' }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success && data.messages) {
                        renderMessages(data.messages);
                    }
                })
                .catch(() => {});
            }, 4000);

            function renderMessages(messages) {
                if (!messages || messages.length === 0) return;
                const wasNearBottom = container.scrollHeight - container.scrollTop - container.clientHeight < 120;
                
                let html = '';
                messages.forEach(msg => {
                    const isMe = msg.is_me;
                    html += `
                        <div class="message-bubble ${isMe ? 'message-me' : 'message-other'}">
                            <div class="text-[11px] font-semibold mb-1 ${isMe ? 'text-white/80' : 'text-[#43637E] dark:text-[#8baac4]'}">
                                ${isMe ? 'Anda' : escapeHtml(msg.sender_name)}
                            </div>
                            <div class="message-content">${escapeHtml(msg.message)}</div>
                            <span class="message-time">${msg.created_at}</span>
                        </div>
                    `;
                });
                container.innerHTML = html;
                if (wasNearBottom) {
                    scrollToBottom();
                }
            }

            function escapeHtml(text) {
                const map = {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#039;'
                };
                return text.replace(/[&<>"']/g, function(m) { return map[m]; });
            }
        });
    </script>
</x-app-layout>
