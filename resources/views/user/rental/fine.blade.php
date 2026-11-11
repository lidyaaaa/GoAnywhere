<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Bayar Denda
        </h2>
    </x-slot>

    <!-- ============================================ -->
    <!-- STYLE ELEGAN - #43637E + SHADOW HITAM TEBEL -->
    <!-- ============================================ -->
    <style>
        * {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .denda-section {
            padding: 40px 0 60px;
            background: #eef1f4;
            position: relative;
            min-height: 100vh;
        }

        /* ===== CARD ===== */
        .denda-card {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.25), 0 8px 30px rgba(0, 0, 0, 0.12);
            border: 1px solid #e8e4de;
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
            margin-left: 8px;
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
        .payment-label-title {
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

        .payment-option {
            position: relative;
        }

        .payment-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .payment-option-label {
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
            gap: 6px;
            user-select: none;
        }

        .payment-option-label .icon {
            font-size: 24px;
            line-height: 1;
        }

        .payment-option-label:hover {
            border-color: #43637E;
            background: rgba(67, 99, 126, 0.06);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(67, 99, 126, 0.15);
            color: #43637E;
        }

        /* When radio is checked */
        .payment-option input[type="radio"]:checked + .payment-option-label {
            border-color: #43637E;
            background: rgba(67, 99, 126, 0.12);
            color: #43637E;
            font-weight: 700;
            box-shadow: 0 4px 18px rgba(67, 99, 126, 0.25);
            transform: translateY(-2px);
        }

        /* ===== SUBMIT BUTTON ===== */
        .btn-submit {
            width: 100%;
            margin-top: 24px;
            background: #43637E;
            color: #ffffff;
            border: none;
            padding: 16px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            box-shadow: 0 8px 30px rgba(67, 99, 126, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background: #36546b;
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(67, 99, 126, 0.5);
        }

        /* ===== BACK LINK ===== */
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #43637E;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        /* ===== DARK MODE ===== */
        .dark .denda-section {
            background: #111a22;
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

        .dark .payment-label-title {
            color: #f0ede8;
        }

        .dark .payment-option-label {
            background: #0f1a24;
            border-color: #2c3e50;
            color: #b0bec5;
        }

        .dark .payment-option-label:hover {
            border-color: #43637E;
            background: rgba(67, 99, 126, 0.15);
            color: #f0e6d0;
        }

        .dark .payment-option input[type="radio"]:checked + .payment-option-label {
            border-color: #43637E;
            background: rgba(67, 99, 126, 0.3);
            color: #f0e6d0;
        }

        .dark .back-link {
            color: #8baac4;
        }

        .dark .back-link:hover {
            color: #f0ede8;
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
                gap: 8px;
            }

            .payment-option-label {
                padding: 12px 6px;
                font-size: 12px;
            }

            .payment-option-label .icon {
                font-size: 22px;
            }
        }

        @media (max-width: 480px) {
            .payment-grid {
                grid-template-columns: repeat(2, 1fr);
            }
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
                            Telat: <strong>{{ floor(($fine->late_minutes ?? 0) / 60) }} jam {{ ($fine->late_minutes ?? 0) % 60 }} menit</strong>
                        </div>
                    </div>

                    @if($errors->has('payment_method'))
                        <div class="mt-4 p-3 rounded-lg bg-red-100 border border-red-300 text-red-700 text-sm">
                            {{ $errors->first('payment_method') }}
                        </div>
                    @endif

                    <!-- Payment Form -->
                    <form id="finePaymentForm" action="{{ route('user.rental.payFine', $cart->id) }}" method="POST" style="margin-top: 28px;">
                        @csrf

                        <span class="payment-label-title">Pilih Metode Pembayaran:</span>

                        <div class="payment-grid">
                            <div class="payment-option">
                                <input type="radio" name="payment_method" value="qris" id="method_qris" required>
                                <label for="method_qris" class="payment-option-label">
                                    <span class="icon">📱</span>
                                    <span>QRIS</span>
                                </label>
                            </div>

                            <div class="payment-option">
                                <input type="radio" name="payment_method" value="bank_transfer" id="method_transfer" required>
                                <label for="method_transfer" class="payment-option-label">
                                    <span class="icon">🏦</span>
                                    <span>Transfer</span>
                                </label>
                            </div>

                            <div class="payment-option">
                                <input type="radio" name="payment_method" value="gopay" id="method_gopay" required>
                                <label for="method_gopay" class="payment-option-label">
                                    <span class="icon">💚</span>
                                    <span>GoPay</span>
                                </label>
                            </div>

                            <div class="payment-option">
                                <input type="radio" name="payment_method" value="dana" id="method_dana" required>
                                <label for="method_dana" class="payment-option-label">
                                    <span class="icon">💙</span>
                                    <span>DANA</span>
                                </label>
                            </div>

                            <div class="payment-option">
                                <input type="radio" name="payment_method" value="ovo" id="method_ovo" required>
                                <label for="method_ovo" class="payment-option-label">
                                    <span class="icon">💜</span>
                                    <span>OVO</span>
                                </label>
                            </div>
                        </div>

                        <button type="submit" id="btnPayFine" class="btn-submit">
                            Bayar Denda
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('finePaymentForm');
            form.addEventListener('submit', function(e) {
                const selected = document.querySelector('input[name="payment_method"]:checked');
                if (!selected) {
                    e.preventDefault();
                    alert('Silakan pilih salah satu metode pembayaran terlebih dahulu!');
                }
            });
        });
    </script>
</x-app-layout>
