<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            🛒 Checkout - GoAnywhere
        </h2>
    </x-slot>

    <!-- ============================================ -->
    <!-- STYLE ELEGAN - #43637E + SHADOW HITAM TEBEL -->
    <!-- ============================================ -->
    <style>

        .checkout-section {
            padding: 40px 0 60px;
            background: #eef1f4;
            position: relative;
            min-height: 100vh;
        }

        /* Decorative floating shapes */
        .checkout-section::after {
            content: '✦';
            position: absolute;
            bottom: 40px;
            right: 40px;
            font-size: 60px;
            color: rgba(67, 99, 126, 0.06);
            pointer-events: none;
        }

        .alert-error {
            background: #fce8e8;
            border: 1px solid #d46a6a;
            color: #b04a4a;
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(212, 106, 106, 0.15);
        }

        .alert-warning {
            background: #fdf6e8;
            border: 1px solid #b08a3a;
            color: #b08a3a;
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(176, 138, 58, 0.15);
        }

        .checkout-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 28px 32px;
            margin-bottom: 24px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.10), 0 2px 8px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(232, 228, 222, 0.6);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .checkout-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, #43637E, transparent);
            opacity: 0;
            transition: all 0.5s ease;
        }

        .checkout-card:hover::before {
            opacity: 1;
        }

        .checkout-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.18), 0 8px 24px rgba(0, 0, 0, 0.10);
            border-color: rgba(67, 99, 126, 0.3);
        }

        .checkout-card .card-title {
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: 0.3px;
        }

        .checkout-card .card-title .icon {
            font-size: 22px;
            display: inline-flex;
        }

        /* ===== 2 KOLOM ===== */
        .checkout-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        /* ===== ITEM CARD ===== */
        .item-card {
            display: flex;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid #f0ede8;
            align-items: flex-start;
            transition: all 0.3s ease;
        }

        .item-card:last-child {
            border-bottom: none;
        }

        .item-card:hover {
            background: rgba(67, 99, 126, 0.03);
            margin: 0 -8px;
            padding: 16px 8px;
            border-radius: 12px;
        }

        .item-card .item-image {
            width: 80px;
            height: 80px;
            border-radius: 14px;
            background: linear-gradient(135deg, #e8e4de, #d5d0c8);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
            border: 2px solid #e8e4de;
            transition: all 0.4s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }

        .item-card:hover .item-image {
            border-color: #43637E;
            transform: scale(1.02);
            box-shadow: 0 6px 20px rgba(67, 99, 126, 0.15);
        }

        .item-card .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-card .item-image .placeholder {
            font-size: 36px;
            opacity: 0.6;
            font-weight: 300;
        }

        .item-card .item-detail {
            flex: 1;
        }

        .item-card .item-detail .name {
            font-weight: 700;
            color: #2c3e50;
            font-size: 15px;
            transition: color 0.3s ease;
        }

        .item-card:hover .item-detail .name {
            color: #43637E;
        }

        .item-card .item-detail .meta {
            font-size: 13px;
            color: #7a8a9a;
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        /* Duration Segmented Pills & Stepper */
        .checkout-duration-box {
            margin-top: 12px;
            padding: 12px 14px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            display: flex;
            align-items: flex-start;
            gap: 16px;
            flex-wrap: wrap;
        }

        .dark .checkout-duration-box {
            background: #0f1a24;
            border-color: #2c3e50;
        }

        .checkout-ctrl-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .checkout-ctrl-group .ctrl-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            color: #64748B;
            letter-spacing: 0.5px;
        }

        /* Pill Radio Group for Package */
        .package-pills {
            display: inline-flex;
            gap: 6px;
            background: #e2e8f0;
            padding: 4px;
            border-radius: 10px;
        }

        .dark .package-pills {
            background: #1e293b;
        }

        .package-pill-btn {
            position: relative;
        }

        .package-pill-btn input[type="radio"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .package-pill-btn label {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 14px;
            font-size: 12.5px;
            font-weight: 600;
            border-radius: 8px;
            color: #475569;
            cursor: pointer;
            user-select: none;
            transition: all 0.2s ease;
        }

        .dark .package-pill-btn label {
            color: #94a3b8;
        }

        .package-pill-btn input[type="radio"]:checked + label {
            background: #004B87;
            color: #ffffff;
            box-shadow: 0 2px 6px rgba(0, 75, 135, 0.25);
        }

        .package-pill-btn label:hover {
            color: #002D55;
        }

        .dark .package-pill-btn label:hover {
            color: #f8fafc;
        }

        /* Number Stepper (+ / -) */
        .stepper-box {
            display: inline-flex;
            align-items: center;
            border: 1.5px solid #cbd5e1;
            border-radius: 10px;
            background: #ffffff;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        .dark .stepper-box {
            background: #1e293b;
            border-color: #334155;
        }

        .stepper-btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: #f1f5f9;
            color: #002D55;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.15s ease;
        }

        .dark .stepper-btn {
            background: #0f172a;
            color: #f8fafc;
        }

        .stepper-btn:hover {
            background: #e2e8f0;
            color: #004B87;
        }

        .dark .stepper-btn:hover {
            background: #334155;
        }

        .stepper-input {
            width: 44px;
            height: 32px;
            text-align: center;
            border: none;
            font-size: 13.5px;
            font-weight: 700;
            color: #002D55;
            background: transparent;
            outline: none;
            -moz-appearance: textfield;
        }

        .stepper-input::-webkit-outer-spin-button,
        .stepper-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .dark .stepper-input {
            color: #f8fafc;
        }

        .item-card .item-detail .meta .badge-weekly {
            background: rgba(67, 99, 126, 0.12);
            color: #43637E;
            padding: 2px 12px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .item-card .item-detail .price {
            font-weight: 700;
            color: #43637E;
            font-size: 16px;
            font-family: 'Georgia', serif;
            margin-top: 8px;
        }

        /* ===== DETAIL ORDER ===== */
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 14px;
            color: #7a8a9a;
            transition: all 0.3s ease;
        }

        .detail-row:hover {
            background: rgba(67, 99, 126, 0.03);
            margin: 0 -8px;
            padding: 8px 8px;
            border-radius: 8px;
        }

        .detail-row .label {
            color: #9aabbb;
            font-weight: 500;
        }

        .detail-row .value {
            font-weight: 600;
            color: #2c3e50;
        }

        .detail-row .value.booking-code {
            color: #43637E;
            font-family: 'Courier New', monospace;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 1px;
            background: rgba(67, 99, 126, 0.08);
            padding: 2px 12px;
            border-radius: 6px;
        }

        .detail-row .value.deadline {
            color: #d46a6a;
            font-weight: 700;
        }

        .detail-divider {
            border: none;
            border-top: 2px dashed #e8e4de;
            margin: 14px 0 16px;
        }

        .detail-total {
            display: flex;
            justify-content: space-between;
            font-size: 24px;
            font-weight: 700;
            color: #43637E;
            font-family: 'Georgia', serif;
            padding: 4px 0;
        }

        .detail-total span:last-child {
            background: linear-gradient(135deg, #43637E, #5a7a9a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ===== PAYMENT ===== */
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

        .payment-option .payment-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 16px 8px 14px;
            border: 2px solid #e8e4de;
            border-radius: 16px;
            background: #faf8f5;
            cursor: pointer;
            text-align: center;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .payment-option .payment-label::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(67, 99, 126, 0.1);
            transform: translate(-50%, -50%);
            transition: all 0.6s ease;
        }

        .payment-option .payment-label:hover::after {
            width: 200%;
            padding-top: 200%;
        }

        .payment-option .payment-label:hover {
            border-color: #43637E;
            background: rgba(67, 99, 126, 0.06);
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 8px 30px rgba(67, 99, 126, 0.15);
        }

        .payment-option input[type="radio"]:checked + .payment-label {
            border-color: #43637E;
            background: rgba(67, 99, 126, 0.1);
            box-shadow: 0 4px 25px rgba(67, 99, 126, 0.20);
            transform: translateY(-2px) scale(1.01);
        }

        .payment-option input[type="radio"]:checked + .payment-label .icon {
            transform: scale(1.15);
        }

        .payment-option .payment-label .icon {
            font-size: 32px;
            display: block;
            transition: all 0.4s ease;
            line-height: 1.2;
        }

        .payment-option .payment-label .label-text {
            font-size: 11px;
            font-weight: 700;
            color: #5a6a7a;
            margin-top: 6px;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
        }

        .payment-option input[type="radio"]:checked + .payment-label .label-text {
            color: #43637E;
        }

        /* ===== WARNING BOX ===== */
        .warning-box {
            background: linear-gradient(135deg, #fdf6e8, #faf3e0);
            border: 1px solid #d4b86a;
            border-radius: 16px;
            padding: 16px 20px;
            margin-top: 20px;
            display: flex;
            align-items: flex-start;
            gap: 14px;
            box-shadow: 0 4px 16px rgba(176, 138, 58, 0.12);
        }

        .warning-box .icon {
            font-size: 28px;
            flex-shrink: 0;
            margin-top: 2px;
            animation: pulse-warning 2s ease-in-out infinite;
        }

        @keyframes pulse-warning {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .warning-box .content .title {
            font-weight: 700;
            color: #8a6a2a;
            font-size: 14px;
        }

        .warning-box .content .desc {
            font-size: 13px;
            color: #7a6a4a;
            margin-top: 2px;
        }

        .warning-box .content .location {
            font-size: 13px;
            color: #43637E;
            font-weight: 600;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* ===== SUBMIT BUTTON ===== */
        .btn-pay {
            width: 100%;
            margin-top: 24px;
            background: linear-gradient(135deg, #4a7a5a, #3a6a4a);
            color: #ffffff;
            padding: 18px;
            border-radius: 16px;
            font-weight: 700;
            font-size: 18px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 35px rgba(74, 122, 90, 0.35);
            position: relative;
            overflow: hidden;
        }

        .btn-pay::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            transition: all 0.6s ease;
        }

        .btn-pay:hover::before {
            left: 100%;
        }

        .btn-pay:hover {
            background: linear-gradient(135deg, #3a6a4a, #2a5a3a);
            transform: translateY(-4px);
            box-shadow: 0 14px 45px rgba(74, 122, 90, 0.45);
        }

        .btn-pay:active {
            transform: translateY(0px);
        }

        .btn-pay:disabled {
            background: #d5d0c8;
            color: #7a8a9a;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .btn-pay:disabled::before {
            display: none;
        }

        /* ===== BACK LINK ===== */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #7a8a9a;
            font-weight: 500;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 20px;
            padding: 10px 0;
            position: relative;
        }

        .back-link::after {
            content: '';
            position: absolute;
            bottom: 6px;
            left: 0;
            width: 0;
            height: 2px;
            background: #43637E;
            transition: all 0.3s ease;
        }

        .back-link:hover::after {
            width: 100%;
        }

        .back-link:hover {
            color: #43637E;
            transform: translateX(-6px);
        }

        /* ===== DARK MODE ===== */
        .dark .checkout-section { background: #1a2632; }
        .dark .checkout-section::after { color: rgba(67, 99, 126, 0.08); }
        .dark .alert-error { background: #3d1e1e; border-color: #d46a6a; color: #d46a6a; }
        .dark .alert-warning { background: #3d3a1e; border-color: #b08a3a; color: #d4b86a; }
        .dark .checkout-card { background: #1a2632; border-color: #2c3e50; box-shadow: 0 8px 32px rgba(0,0,0,0.5); }
        .dark .checkout-card:hover { border-color: #43637E; box-shadow: 0 20px 60px rgba(0,0,0,0.6); }
        .dark .checkout-card .card-title { color: #f0ede8; }
        .dark .item-card { border-bottom-color: #2c3e50; }
        .dark .item-card:hover { background: rgba(67,99,126,0.08); }
        .dark .item-card .item-detail .name { color: #f0ede8; }
        .dark .item-card:hover .item-detail .name { color: #f0e6d0; }
        .dark .item-card .item-detail .meta { color: #b0bec5; }
        .dark .item-card .item-detail .price { color: #f0e6d0; }
        .dark .detail-row .value { color: #f0ede8; }
        .dark .detail-divider { border-top-color: #2c3e50; }
        .dark .detail-total { color: #f0e6d0; }
        .dark .detail-total span:last-child { background: linear-gradient(135deg, #f0e6d0, #d4c8b0); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .dark .payment-option .payment-label { background: #0f1a24; border-color: #2c3e50; }
        .dark .payment-option .payment-label:hover { border-color: #43637E; background: rgba(67,99,126,0.15); }
        .dark .payment-option .payment-label .label-text { color: #b0bec5; }
        .dark .payment-option input[type="radio"]:checked + .payment-label { border-color: #43637E; background: rgba(67,99,126,0.25); }
        .dark .payment-option input[type="radio"]:checked + .payment-label .label-text { color: #f0e6d0; }
        .dark .warning-box { background: linear-gradient(135deg, #3d3a1e, #2d2a10); border-color: #b08a3a; }
        .dark .warning-box .content .title { color: #d4b86a; }
        .dark .warning-box .content .desc { color: #b0a080; }
        .dark .warning-box .content .location { color: #8ab4d4; }
        .dark .back-link { color: #7a8a9a; }
        .dark .back-link:hover { color: #f0e6d0; }
        .dark .back-link::after { background: #f0e6d0; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .checkout-grid {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }

        @media (max-width: 768px) {
            .checkout-card { padding: 20px 20px; }
            .checkout-card .card-title { font-size: 16px; }
            .payment-grid { grid-template-columns: repeat(3, 1fr); gap: 10px; }
            .detail-total { font-size: 20px; }
            .item-card .item-image { width: 60px; height: 60px; }
            .item-card .item-image .placeholder { font-size: 28px; }
            .payment-option .payment-label { padding: 14px 6px 12px; }
            .payment-option .payment-label .icon { font-size: 28px; }
        }

        @media (max-width: 480px) {
            .checkout-section { padding: 20px 0 30px; }
            .checkout-card { padding: 16px 16px; margin-bottom: 16px; border-radius: 16px; }
            .checkout-card .card-title { font-size: 14px; margin-bottom: 12px; }
            .payment-grid { grid-template-columns: repeat(2, 1fr); gap: 8px; }
            .payment-option .payment-label { padding: 12px 6px 10px; border-radius: 12px; }
            .payment-option .payment-label .icon { font-size: 24px; }
            .payment-option .payment-label .label-text { font-size: 10px; }
            .detail-total { font-size: 18px; }
            .btn-pay { font-size: 15px; padding: 16px; border-radius: 14px; }
            .item-card { padding: 10px 0; }
            .item-card .item-image { width: 56px; height: 56px; border-radius: 10px; }
            .item-card .item-detail .name { font-size: 13px; }
            .item-card .item-detail .price { font-size: 14px; }
            .warning-box { padding: 12px 14px; border-radius: 12px; }
            .warning-box .icon { font-size: 22px; }
            .warning-box .content .title { font-size: 12px; }
            .warning-box .content .desc { font-size: 12px; }
            .warning-box .content .location { font-size: 12px; }
            .detail-row { font-size: 13px; padding: 6px 0; }
            .detail-row .value.booking-code { font-size: 13px; }
            .back-link { font-size: 13px; margin-top: 12px; }
        }

        /* Scrollbar styling */
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #f0ede8; }
        ::-webkit-scrollbar-thumb { background: linear-gradient(135deg, #43637E, #5a7a9a); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: linear-gradient(135deg, #36546b, #4a6a8a); }
        .dark ::-webkit-scrollbar-track { background: #1a2632; }
        .dark ::-webkit-scrollbar-thumb { background: linear-gradient(135deg, #43637E, #5a7a9a); }

        /* Additional hover animations */
        .checkout-card .card-title .icon {
            transition: transform 0.4s ease;
        }
        .checkout-card:hover .card-title .icon {
            transform: rotate(-5deg) scale(1.1);
        }

        /* Payment option selected checkmark */
        .payment-option input[type="radio"]:checked + .payment-label .checkmark {
            opacity: 1;
            transform: scale(1);
        }

        .payment-option .payment-label .checkmark {
            position: absolute;
            top: -6px;
            right: -6px;
            background: #43637E;
            color: white;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            opacity: 0;
            transform: scale(0);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(67, 99, 126, 0.3);
        }

        .payment-option input[type="radio"]:checked + .payment-label .checkmark {
            opacity: 1;
            transform: scale(1);
        }

        .dark .payment-option .payment-label .checkmark {
            background: #f0e6d0;
            color: #1a2632;
        }
    </style>

    <!-- ============================================ -->
    <!-- CHECKOUT SECTION                             -->
    <!-- ============================================ -->
    <div class="checkout-section">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('error'))
                <div class="alert-error"> ⚠️ {{ session('error') }}</div>
            @endif
            @if(session('warning'))
                <div class="alert-warning"> ⚠️ {{ session('warning') }}</div>
            @endif

            <!-- ===== 2 KOLOM ===== -->
            <div class="checkout-grid">

                <!-- ===== KOLOM KIRI: ITEM YANG DIPESAN ===== -->
                <div class="checkout-card">
                     <h4 class="card-title" style="font-size: 16px; margin-bottom: 12px;">
                         <span class="icon">📦</span> Item yang Dipesan
                     </h4>

                    @foreach($carts as $cart)
                        @php
                            $dailyPrice = (float) $cart->vehicle->price_per_day;
                            $weeklyPrice = (float) ($cart->vehicle->price_per_week > 0 ? $cart->vehicle->price_per_week : ($dailyPrice * 7));
                            $currentPeriod = $cart->period ?: 'daily';
                            $currentDays = $cart->quantity_days ?: 1;
                        @endphp
                        <div class="item-card" id="item_card_{{ $cart->id }}"
                             data-id="{{ $cart->id }}"
                             data-price-day="{{ $dailyPrice }}"
                             data-price-week="{{ $weeklyPrice }}">
                            <div class="item-image">
                                @if($cart->vehicle->image)
                                    <img src="{{ asset('storage/' . $cart->vehicle->image) }}" alt="{{ $cart->vehicle->name }}">
                                @else
                                    <span class="placeholder">{{ $cart->vehicle->vehicle_type == 'car' ? '🚗' : '🏍️' }}</span>
                                @endif
                            </div>
                            <div class="item-detail">
                                <div class="name">{{ $cart->vehicle->name }}</div>
                                <div class="meta">
                                    <span>📍 {{ $cart->vehicle->location }}</span>
                                    <span>&bull;</span>
                                    <span>Rp {{ number_format($dailyPrice, 0, ',', '.') }}/hari</span>
                                    @if($cart->vehicle->price_per_week > 0)
                                        <span class="text-xs text-emerald-600 font-semibold">(Paket 7 Hari: Rp {{ number_format($cart->vehicle->price_per_week, 0, ',', '.') }})</span>
                                    @endif
                                </div>

                                <!-- Input Pengaturan Durasi Sewa: Segmented Button & Stepper -->
                                <div class="checkout-duration-box">
                                    <div class="checkout-ctrl-group">
                                        <span class="ctrl-label">Pilihan Paket</span>
                                        <div class="package-pills">
                                            <div class="package-pill-btn">
                                                <input type="radio" 
                                                       name="durations[{{ $cart->id }}][period]" 
                                                       value="daily" 
                                                       id="period_daily_{{ $cart->id }}"
                                                       form="paymentForm"
                                                       {{ $currentPeriod === 'daily' ? 'checked' : '' }}
                                                       onchange="onPackageSelect('{{ $cart->id }}', 'daily')">
                                                <label for="period_daily_{{ $cart->id }}">
                                                    <span>☀️</span> Harian
                                                </label>
                                            </div>
                                            <div class="package-pill-btn">
                                                <input type="radio" 
                                                       name="durations[{{ $cart->id }}][period]" 
                                                       value="weekly" 
                                                       id="period_weekly_{{ $cart->id }}"
                                                       form="paymentForm"
                                                       {{ $currentPeriod === 'weekly' ? 'checked' : '' }}
                                                       onchange="onPackageSelect('{{ $cart->id }}', 'weekly')">
                                                <label for="period_weekly_{{ $cart->id }}">
                                                    <span>🎁</span> Mingguan (7 Hari)
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="checkout-ctrl-group" id="days_group_{{ $cart->id }}" style="{{ $currentPeriod === 'weekly' ? 'display:none;' : '' }}">
                                        <span class="ctrl-label">Durasi Hari (1 - 5 Hari)</span>
                                        <div class="stepper-box">
                                            <button type="button" class="stepper-btn" onclick="stepDays('{{ $cart->id }}', -1)">−</button>
                                            <input type="number" 
                                                   name="durations[{{ $cart->id }}][days]" 
                                                   form="paymentForm"
                                                   id="days_{{ $cart->id }}"
                                                   class="stepper-input"
                                                   value="{{ min(5, max(1, $currentDays)) }}" 
                                                   min="1" 
                                                   max="5"
                                                   readonly>
                                            <button type="button" class="stepper-btn" onclick="stepDays('{{ $cart->id }}', 1)">+</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="price" id="subtotal_text_{{ $cart->id }}">
                                    Subtotal: Rp {{ number_format($cart->subtotal, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- ===== KOLOM KANAN: DETAIL PEMESANAN ===== -->
                <div class="checkout-card">
                     <h4 class="card-title" style="font-size: 16px; margin-bottom: 12px;">
                         <span class="icon">📋</span> Detail Pemesanan
                     </h4>

                    <div class="detail-row">
                        <span class="label">🔑 Kode Booking</span>
                        <span class="value booking-code">{{ $bookingCode }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">📍 Alamat Pengantaran Unit</span>
                        <span class="value text-xs font-semibold max-w-[200px] text-right truncate" title="{{ auth()->user()->address }}, {{ auth()->user()->location }}">
                            {{ auth()->user()->address }}, {{ auth()->user()->location }}
                        </span>
                    </div>
                    <div class="detail-row">
                        <span class="label">📦 Total Item</span>
                        <span class="value">{{ count($carts) }} Unit</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">⏰ Batas Pembayaran</span>
                        <span class="value deadline">{{ $paymentDeadline->format('d M Y H:i') }}</span>
                    </div>

                    <hr class="detail-divider">

                    <div class="detail-row">
                        <span class="label">Subtotal Sewa</span>
                        <span class="value font-semibold" id="checkoutSubtotalDisplay">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">🚚 Ongkos Kirim ({{ ($carPendingCount ?? 0) > 0 && ($motorcyclePendingCount ?? 0) > 0 ? 'Mobil + Motor' : (($carPendingCount ?? 0) > 0 ? 'Mobil' : 'Motor') }})</span>
                        <span class="value font-semibold text-emerald-600 dark:text-emerald-400">+Rp {{ number_format($deliveryFee, 0, ',', '.') }}</span>
                    </div>

                    <hr class="detail-divider">

                    <div class="detail-total">
                        <span>💰 Total Bayar</span>
                        <span id="checkoutGrandTotalDisplay">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                    </div>
                </div>

            </div>

            <!-- ===== METODE PEMBAYARAN ===== -->
            <div class="checkout-card">
                 <h3 class="card-title"><span class="icon">💳</span> Pilih Metode Pembayaran</h3>

                <form action="{{ route('user.cart.payment') }}" method="POST" id="paymentForm">
                    @csrf
                    <input type="hidden" name="selected_carts" value="{{ implode(',', $carts->pluck('id')->toArray()) }}">

                    <div class="payment-grid">
                        <div class="payment-option">
                            <input type="radio" name="payment_method" value="qris" id="qris">
                            <label for="qris" class="payment-label">
                                <span class="icon">
                                    <svg class="w-8 h-8 mx-auto text-slate-800 dark:text-slate-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="3" width="7" height="7" rx="1.5" />
                                        <rect x="14" y="3" width="7" height="7" rx="1.5" />
                                        <rect x="3" y="14" width="7" height="7" rx="1.5" />
                                        <path d="M14 14h3v3h-3zM17 17h4v4h-4zM14 20h3M20 14v3" />
                                    </svg>
                                </span>
                                <span class="label-text">QRIS</span>
                                <span class="checkmark">✓</span>
                            </label>
                        </div>
                        <div class="payment-option">
                            <input type="radio" name="payment_method" value="bank_transfer" id="bank_transfer">
                            <label for="bank_transfer" class="payment-label">
                                <span class="icon">
                                    <svg class="w-8 h-8 mx-auto text-[#004B87] dark:text-sky-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M3 10h18M5 10v8m4-8v8m6-8v8m4-8v8M3 10l9-6 9 6" />
                                    </svg>
                                </span>
                                <span class="label-text">Transfer Bank</span>
                                <span class="checkmark">✓</span>
                            </label>
                        </div>
                        <div class="payment-option">
                            <input type="radio" name="payment_method" value="gopay" id="gopay">
                            <label for="gopay" class="payment-label">
                                <span class="icon">
                                    <svg class="w-8 h-8 mx-auto" viewBox="0 0 24 24" fill="none">
                                        <circle cx="12" cy="12" r="10" fill="#00AA13"/>
                                        <circle cx="12" cy="12" r="4.5" fill="#ffffff"/>
                                    </svg>
                                </span>
                                <span class="label-text">GoPay</span>
                                <span class="checkmark">✓</span>
                            </label>
                        </div>
                        <div class="payment-option">
                            <input type="radio" name="payment_method" value="dana" id="dana">
                            <label for="dana" class="payment-label">
                                <span class="icon">
                                    <svg class="w-8 h-8 mx-auto" viewBox="0 0 24 24" fill="none">
                                        <rect x="2" y="3" width="20" height="18" rx="4" fill="#118EEA"/>
                                        <path d="M7 8h10M7 12h10M7 16h6" stroke="#ffffff" stroke-width="2.2" stroke-linecap="round"/>
                                    </svg>
                                </span>
                                <span class="label-text">DANA</span>
                                <span class="checkmark">✓</span>
                            </label>
                        </div>
                        <div class="payment-option">
                            <input type="radio" name="payment_method" value="ovo" id="ovo">
                            <label for="ovo" class="payment-label">
                                <span class="icon">
                                    <svg class="w-8 h-8 mx-auto" viewBox="0 0 24 24" fill="none">
                                        <circle cx="12" cy="12" r="10" fill="#4C3494"/>
                                        <circle cx="12" cy="12" r="6" fill="#ffffff"/>
                                        <circle cx="12" cy="12" r="3.2" fill="#4C3494"/>
                                    </svg>
                                </span>
                                <span class="label-text">OVO</span>
                                <span class="checkmark">✓</span>
                            </label>
                        </div>
                    </div>

                    <!-- Warning -->
                    <div class="warning-box">
                         <span class="icon">🚚</span>
                        <div class="content">
                            <div class="title">Setelah pembayaran, kendaraan akan diantar oleh staff kami ke lokasi Anda.</div>
                            <div class="desc">Pastikan alamat dan nomor telepon Anda sudah benar.</div>
                            <div class="location">📍 Pengembalian: Dikembalikan ke kantor</div>
                        </div>
                    </div>

                    <button type="submit" class="btn-pay" id="btnPay" disabled>
                        💳 Bayar Sekarang
                    </button>
                </form>
            </div>

            <!-- Back Link -->
            <a href="{{ route('user.cart') }}" class="back-link">
                ← Kembali ke Keranjang
            </a>

        </div>
    </div>

    <!-- ============================================ -->
    <!-- VALIDASI & INTERAKSI JS                      -->
    <!-- ============================================ -->
    <script>
        const fixedDeliveryFee = {{ (float) $deliveryFee }};

        function formatRupiah(number) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(number);
        }

        function onPackageSelect(cartId, period) {
            const daysGroup = document.getElementById('days_group_' + cartId);
            const daysInput = document.getElementById('days_' + cartId);
            const card = document.getElementById('item_card_' + cartId);
            const subtotalText = document.getElementById('subtotal_text_' + cartId);

            if (!card || !daysInput) return;

            const dailyPrice = parseFloat(card.dataset.priceDay) || 0;
            const weeklyPrice = parseFloat(card.dataset.priceWeek) || 0;

            let itemSubtotal = 0;
            if (period === 'weekly') {
                if (daysGroup) daysGroup.style.display = 'none';
                daysInput.value = 7;
                itemSubtotal = weeklyPrice;
            } else {
                if (daysGroup) daysGroup.style.display = 'flex';
                let days = parseInt(daysInput.value) || 1;
                if (days < 1) days = 1;
                if (days > 5) days = 5;
                daysInput.value = days;
                itemSubtotal = dailyPrice * days;
            }

            card.dataset.itemSubtotal = itemSubtotal;
            if (subtotalText) {
                subtotalText.textContent = 'Subtotal: ' + formatRupiah(itemSubtotal);
            }

            recalculateAllCheckoutTotals();
        }

        function stepDays(cartId, delta) {
            const daysInput = document.getElementById('days_' + cartId);
            const card = document.getElementById('item_card_' + cartId);
            const subtotalText = document.getElementById('subtotal_text_' + cartId);

            if (!daysInput || !card) return;

            let current = parseInt(daysInput.value) || 1;
            let next = current + delta;
            if (next < 1) next = 1;
            if (next > 5) next = 5;

            daysInput.value = next;

            const dailyPrice = parseFloat(card.dataset.priceDay) || 0;
            const itemSubtotal = dailyPrice * next;

            card.dataset.itemSubtotal = itemSubtotal;
            if (subtotalText) {
                subtotalText.textContent = 'Subtotal: ' + formatRupiah(itemSubtotal);
            }

            recalculateAllCheckoutTotals();
        }

        function recalculateAllCheckoutTotals() {
            let totalSubtotal = 0;
            document.querySelectorAll('.item-card').forEach(function(card) {
                const subtotal = parseFloat(card.dataset.itemSubtotal);
                if (!isNaN(subtotal)) {
                    totalSubtotal += subtotal;
                }
            });

            const grandTotal = totalSubtotal + fixedDeliveryFee;

            const subtotalEl = document.getElementById('checkoutSubtotalDisplay');
            const grandTotalEl = document.getElementById('checkoutGrandTotalDisplay');

            if (subtotalEl) subtotalEl.textContent = formatRupiah(totalSubtotal);
            if (grandTotalEl) grandTotalEl.textContent = formatRupiah(grandTotal);
        }

        // Initialize durations on load
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.item-card').forEach(function(card) {
                const cartId = card.dataset.id;
                if (cartId) {
                    const checkedRadio = document.querySelector('input[name="durations[' + cartId + '][period]"]:checked');
                    const period = checkedRadio ? checkedRadio.value : 'daily';
                    onPackageSelect(cartId, period);
                }
            });
        });

        // Enable pay button when payment method is selected
        document.querySelectorAll('input[name="payment_method"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                document.getElementById('btnPay').disabled = false;
                const btn = document.getElementById('btnPay');
                btn.style.transform = 'scale(1.02)';
                setTimeout(() => { btn.style.transform = 'scale(1)'; }, 200);
            });
        });

        // Validate on submit
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            var selected = document.querySelector('input[name="payment_method"]:checked');

            if (!selected) {
                e.preventDefault();
                alert('⚠️ Silakan pilih metode pembayaran terlebih dahulu!');
                return false;
            }

            return true;
        });
    </script>
</x-app-layout>