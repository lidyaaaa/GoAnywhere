<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            💰 Bayar Denda
        </h2>
    </x-slot>

    <!-- ============================================ -->
    <!-- STYLE ELEGAN - #43637E + SHADOW HITAM TEBEL -->
    <!-- ============================================ -->
    <style>
        * {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .denda-section {
            padding: 40px 0 60px;
            background: #f8f6f2;
            position: relative;
            min-height: 100vh;
        }

        .denda-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
        }

        /* ===== CARD ===== */
        .denda-card {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.25), 0 8px 30px rgba(0, 0, 0, 0.12);
            border: 1px solid #e8e4de;
            transition: all 0.4s ease;
        }

        .denda-card:hover {
            box-shadow: 0 24px 65px rgba(0, 0, 0, 0.35), 0 12px 40px rgba(0, 0, 0, 0.2);
            border-color: #43637E;
        }

        .denda-card .body {
            padding: 36px 40px 40px;
        }

        /* ===== HEADER ===== */
        .denda-card .body .vehicle-name {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
        }

        .denda-card .body .vehicle-location {
            font-size: 15px;
            color: #7a8a9a;
            margin-top: 2px;
        }

        /* ===== FINE BOX ===== */
        .fine-box {
            background: #fce8e8;
            border: 1px solid #d46a6a;
            border-radius: 14px;
            padding: 20px 24px;
            margin-top: 24px;
            box-shadow: 0 4px 15px rgba(180, 60, 60, 0.12);
        }

        .fine-box .fine-total {
            font-size: 26px;
            font-weight: 700;
            color: #b04a4a;
            font-family: 'Georgia', serif;
        }

        .fine-box .fine-total small {
            font-size: 16px;
            font-weight: 400;
            color: #7a4a4a;
        }

        .fine-box .fine-detail {
            font-size: 14px;
            color: #8a5a5a;
            margin-top: 4px;
        }

        .fine-box .fine-detail strong {
            color: #b04a4a;
        }

        /* ===== PAYMENT METHODS ===== */
        .payment-label {
            font-weight: 700;
            color: #2c3e50;
            font-size: 15px;
            margin-bottom: 12px;
            display: block;
        }

        .payment-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
        }

        .payment-btn {
            padding: 14px 8px;
            border: 2px solid #e8e4de;
            border-radius: 12px;
            background: #faf8f5;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            color: #5a6a7a;
            text-align: center;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
        }

        .payment-btn .icon {
            font-size: 28px;
        }

        .payment-btn:hover {
            border-color: #43637E;
            background: rgba(67, 99, 126, 0.06);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(67, 99, 126, 0.15);
            color: #43637E;
        }

        .payment-btn:focus {
            outline: none;
            border-color: #43637E;
            box-shadow: 0 0 0 4px rgba(67, 99, 126, 0.15);
        }

        .payment-btn.selected {
            border-color: #43637E;
            background: rgba(67, 99, 126, 0.1);
            color: #43637E;
            box-shadow: 0 4px 15px rgba(67, 99, 126, 0.15);
        }

        /* ===== SUBMIT BUTTON ===== */
        .btn-submit {
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

        .btn-submit:hover {
            background: #36546b;
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(67, 99, 126, 0.5);
        }

        .btn-submit:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
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
        .dark .denda-section {
            background: #1a2632;
        }

        .dark .denda-section::before {
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
        }

        .dark .denda-card {
            background: #1a2632;
            border-color: #2c3e50;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.5), 0 8px 30px rgba(0, 0, 0, 0.3);
        }

        .dark .denda-card:hover {
            border-color: #43637E;
            box-shadow: 0 24px 65px rgba(0, 0, 0, 0.6), 0 12px 40px rgba(0, 0, 0, 0.4);
        }

        .dark .denda-card .body .vehicle-name {
            color: #f0ede8;
        }

        .dark .denda-card .body .vehicle-location {
            color: #b0bec5;
        }

        .dark .fine-box {
            background: #3d1e1e;
            border-color: #8a4a4a;
        }

        .dark .fine-box .fine-total {
            color: #d46a6a;
        }

        .dark .fine-box .fine-total small {
            color: #9a6a6a;
        }

        .dark .fine-box .fine-detail {
            color: #b08a8a;
        }

        .dark .fine-box .fine-detail strong {
            color: #d46a6a;
        }

        .dark .payment-label {
            color: #f0ede8;
        }

        .dark .payment-btn {
            background: #0f1a24;
            border-color: #2c3e50;
            color: #b0bec5;
        }

        .dark .payment-btn:hover {
            border-color: #43637E;
            background: rgba(67, 99, 126, 0.15);
            color: #f0e6d0;
        }

        .dark .payment-btn.selected {
            border-color: #43637E;
            background: rgba(67, 99, 126, 0.2);
            color: #f0e6d0;
        }

        .dark .back-link {
            color: #7a8a9a;
        }

        .dark .back-link:hover {
            color: #f0e6d0;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .denda-card .body {
                padding: 24px 20px 28px;
            }

            .denda-card .body .vehicle-name {
                font-size: 22px;
            }

            .payment-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 10px;
            }

            .payment-btn {
                padding: 12px 8px;
                font-size: 12px;
            }

            .payment-btn .icon {
                font-size: 24px;
            }

            .fine-box .fine-total {
                font-size: 22px;
            }
        }

        @media (max-width: 480px) {
            .denda-section {
                padding: 24px 0 40px;
            }

            .denda-card .body {
                padding: 18px 14px 22px;
            }

            .denda-card .body .vehicle-name {
                font-size: 20px;
            }

            .payment-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
            }

            .payment-btn {
                padding: 10px 6px;
                font-size: 11px;
            }

            .payment-btn .icon {
                font-size: 20px;
            }

            .fine-box {
                padding: 16px 18px;
            }

            .fine-box .fine-total {
                font-size: 20px;
            }

            .btn-submit {
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
    <!-- DENDA SECTION                               -->
    <!-- ============================================ -->
    <div class="denda-section">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="denda-card">
                <div class="body">
                    <!-- Vehicle Info -->
                    <h3 class="vehicle-name">{{ $cart->vehicle->name }}</h3>
                    <p class="vehicle-location">📍 {{ $cart->vehicle->location }}</p>

                    <!-- Fine Box -->
                    <div class="fine-box">
                        <div class="fine-total">
                            Rp {{ number_format($fine->total_fine ?? 0, 0, ',', '.') }}
                            <small>Total Denda</small>
                        </div>
                        <div class="fine-detail">
                            ⏱️ Telat: <strong>{{ floor(($fine->late_minutes ?? 0) / 60) }} jam {{ ($fine->late_minutes ?? 0) % 60 }} menit</strong>
                        </div>
                    </div>

                    <!-- Payment Form -->
                    <form action="{{ route('user.rental.payFine', $cart->id) }}" method="POST" style="margin-top: 28px;">
                        @csrf

                        <span class="payment-label">Pilih Metode Pembayaran:</span>

                        <div class="payment-grid">
                            <button type="submit" name="payment_method" value="qris" class="payment-btn">
                                <span class="icon">📱</span>
                                QRIS
                            </button>
                            <button type="submit" name="payment_method" value="bank_transfer" class="payment-btn">
                                <span class="icon">🏦</span>
                                Transfer
                            </button>
                            <button type="submit" name="payment_method" value="gopay" class="payment-btn">
                                <span class="icon">💚</span>
                                GoPay
                            </button>
                            <button type="submit" name="payment_method" value="dana" class="payment-btn">
                                <span class="icon">🟣</span>
                                DANA
                            </button>
                            <button type="submit" name="payment_method" value="ovo" class="payment-btn">
                                <span class="icon">🟡</span>
                                OVO
                            </button>
                        </div>

                        <button type="submit" class="btn-submit">
                            💳 Bayar Denda
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