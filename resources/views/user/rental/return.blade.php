<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            ✅ Kembalikan Kendaraan
        </h2>
    </x-slot>

    <!-- ============================================ -->
    <!-- STYLE ELEGAN - #43637E + SHADOW HITAM TEBEL -->
    <!-- ============================================ -->
    <style>
        * {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .return-section {
            padding: 40px 0 60px;
            background: #f8f6f2;
            position: relative;
            min-height: 100vh;
        }

        .return-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
        }

        /* ===== CARD ===== */
        .return-card {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.25), 0 8px 30px rgba(0, 0, 0, 0.12);
            border: 1px solid #e8e4de;
            transition: all 0.4s ease;
        }

        .return-card:hover {
            box-shadow: 0 24px 65px rgba(0, 0, 0, 0.35), 0 12px 40px rgba(0, 0, 0, 0.2);
            border-color: #43637E;
        }

        .return-card .body {
            padding: 36px 40px 40px;
        }

        /* ===== HEADER ===== */
        .return-card .body .vehicle-name {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
        }

        .return-card .body .vehicle-location {
            font-size: 15px;
            color: #7a8a9a;
            margin-top: 2px;
        }

        /* ===== INFO DETAIL ===== */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px 24px;
            margin-top: 20px;
            padding: 16px 20px;
            background: #faf8f5;
            border-radius: 12px;
            border: 1px solid #f0ede8;
        }

        .info-grid .info-item .label {
            font-size: 12px;
            color: #9aabbb;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-grid .info-item .value {
            font-size: 15px;
            font-weight: 600;
            color: #2c3e50;
            margin-top: 2px;
        }

        .info-grid .info-item .value .highlight {
            color: #43637E;
        }

        /* ===== STATUS BOX ===== */
        .status-box {
            border-radius: 14px;
            padding: 20px 24px;
            margin-top: 24px;
        }

        .status-box.on-time {
            background: #e8f4ec;
            border: 1px solid #4a7a5a;
            box-shadow: 0 4px 15px rgba(74, 122, 90, 0.12);
        }

        .status-box.on-time .status-icon {
            color: #4a7a5a;
        }

        .status-box.on-time .status-title {
            color: #4a7a5a;
        }

        .status-box.on-time .status-desc {
            color: #3a6a4a;
        }

        .status-box.late {
            background: #fce8e8;
            border: 1px solid #d46a6a;
            box-shadow: 0 4px 15px rgba(180, 60, 60, 0.12);
        }

        .status-box.late .status-icon {
            color: #b04a4a;
        }

        .status-box.late .status-title {
            color: #b04a4a;
        }

        .status-box.late .status-desc {
            color: #8a4a4a;
        }

        .status-box .status-icon {
            font-size: 24px;
            margin-right: 10px;
        }

        .status-box .status-title {
            font-size: 20px;
            font-weight: 700;
            font-family: 'Georgia', serif;
        }

        .status-box .status-desc {
            font-size: 15px;
            margin-top: 4px;
        }

        .status-box .status-desc strong {
            font-weight: 700;
        }

        .status-box .fine-amount {
            font-size: 22px;
            font-weight: 700;
            margin-top: 8px;
            display: block;
        }

        .status-box .fine-amount.late {
            color: #b04a4a;
        }

        /* ===== BUTTON ===== */
        .btn-confirm {
            width: 100%;
            margin-top: 24px;
            background: #43637E;
            color: #ffffff;
            padding: 16px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 16px;
            letter-spacing: 1px;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 8px 30px rgba(67, 99, 126, 0.4);
        }

        .btn-confirm:hover {
            background: #36546b;
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(67, 99, 126, 0.5);
        }

        /* ===== BACK LINK ===== */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #7a8a9a;
            font-weight: 500;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-top: 20px;
            padding: 8px 0;
        }

        .back-link:hover {
            color: #43637E;
            transform: translateX(-4px);
        }

        /* ===== DARK MODE ===== */
        .dark .return-section {
            background: #1a2632;
        }

        .dark .return-section::before {
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
        }

        .dark .return-card {
            background: #1a2632;
            border-color: #2c3e50;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.5), 0 8px 30px rgba(0, 0, 0, 0.3);
        }

        .dark .return-card:hover {
            border-color: #43637E;
            box-shadow: 0 24px 65px rgba(0, 0, 0, 0.6), 0 12px 40px rgba(0, 0, 0, 0.4);
        }

        .dark .return-card .body .vehicle-name {
            color: #f0ede8;
        }

        .dark .return-card .body .vehicle-location {
            color: #b0bec5;
        }

        .dark .info-grid {
            background: #0f1a24;
            border-color: #2c3e50;
        }

        .dark .info-grid .info-item .value {
            color: #f0ede8;
        }

        .dark .status-box.on-time {
            background: #1e3d2e;
            border-color: #4a7a5a;
        }

        .dark .status-box.on-time .status-title {
            color: #8abd9a;
        }

        .dark .status-box.on-time .status-desc {
            color: #7a9a8a;
        }

        .dark .status-box.late {
            background: #3d1e1e;
            border-color: #8a4a4a;
        }

        .dark .status-box.late .status-title {
            color: #d46a6a;
        }

        .dark .status-box.late .status-desc {
            color: #b08a8a;
        }

        .dark .status-box.late .fine-amount.late {
            color: #d46a6a;
        }

        .dark .back-link {
            color: #7a8a9a;
        }

        .dark .back-link:hover {
            color: #f0e6d0;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .return-card .body {
                padding: 24px 20px 28px;
            }

            .return-card .body .vehicle-name {
                font-size: 22px;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 6px 0;
                padding: 14px 16px;
            }

            .info-grid .info-item .value {
                font-size: 14px;
            }

            .status-box .status-title {
                font-size: 18px;
            }

            .status-box .fine-amount {
                font-size: 20px;
            }
        }

        @media (max-width: 480px) {
            .return-section {
                padding: 24px 0 40px;
            }

            .return-card .body {
                padding: 18px 14px 22px;
            }

            .return-card .body .vehicle-name {
                font-size: 20px;
            }

            .info-grid {
                padding: 12px 14px;
            }

            .info-grid .info-item .label {
                font-size: 10px;
            }

            .info-grid .info-item .value {
                font-size: 13px;
            }

            .status-box {
                padding: 16px 18px;
            }

            .status-box .status-title {
                font-size: 16px;
            }

            .status-box .status-desc {
                font-size: 13px;
            }

            .status-box .fine-amount {
                font-size: 18px;
            }

            .btn-confirm {
                font-size: 14px;
                padding: 14px;
            }
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f0ede8;
        }

        ::-webkit-scrollbar-thumb {
            background: #43637E;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #36546b;
        }

        .dark ::-webkit-scrollbar-track {
            background: #1a2632;
        }

        .dark ::-webkit-scrollbar-thumb {
            background: #43637E;
        }
    </style>

    <!-- ============================================ -->
    <!-- RETURN SECTION                              -->
    <!-- ============================================ -->
    <div class="return-section">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="return-card">
                <div class="body">
                    <!-- Vehicle Info -->
                    <h3 class="vehicle-name">{{ $cart->vehicle->name }}</h3>
                    <p class="vehicle-location">📍 {{ $cart->vehicle->location }}</p>

                    <!-- Info Detail Grid -->
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="label">📅 Tanggal Sewa</div>
                            <div class="value">{{ \Carbon\Carbon::parse($cart->rental_start_date)->format('d M Y') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="label">⏰ Wajib Kembali</div>
                            <div class="value"><span class="highlight">{{ \Carbon\Carbon::parse($cart->rental_end_date)->format('d M Y H:i') }}</span></div>
                        </div>
                        <div class="info-item">
                            <div class="label">⏰ Toleransi</div>
                            <div class="value">{{ \Carbon\Carbon::parse($cart->rental_end_date)->addMinutes(30)->format('d M Y H:i') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="label">🕐 Waktu Kembali</div>
                            <div class="value"><span class="highlight">{{ now()->format('d M Y H:i') }}</span></div>
                        </div>
                    </div>

                    <!-- Status Box -->
                    <div class="status-box {{ $isLate ? 'late' : 'on-time' }}">
                        @if(!$isLate)
                            <div>
                                <span class="status-icon">✅</span>
                                <span class="status-title">TEPAT WAKTU!</span>
                                <div class="status-desc">Tidak ada denda. Terima kasih sudah mengembalikan tepat waktu! 🙏</div>
                            </div>
                        @else
                            <div>
                                <span class="status-icon">❌</span>
                                <span class="status-title">TERLAMBAT!</span>
                                <div class="status-desc">
                                    Telat: <strong>{{ floor($lateMinutes / 60) }} jam {{ $lateMinutes % 60 }} menit</strong>
                                </div>
                                <span class="fine-amount late">
                                    💰 Denda: Rp {{ number_format($fineAmount, 0, ',', '.') }}
                                </span>
                            </div>
                        @endif
                    </div>

                    <!-- Confirm Button -->
                    <form action="{{ route('user.rental.processReturn', $cart->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-confirm">
                            ✅ Konfirmasi Pengembalian
                        </button>
                    </form>

                    <!-- Back Link -->
                    <a href="{{ route('user.rental') }}" class="back-link">
                        ← Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>