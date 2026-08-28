<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            🏠 Home - GoAnywhere
        </h2>
    </x-slot>

    <!-- ============================================ -->
    <!-- STYLE REDESIGN - ELEGAN SEAMLESS            -->
    <!-- ============================================ -->
    <style>
        /* ===== RESET & GLOBAL ===== */
        * {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .home-seamless-bg {
            background: transparent !important;
            position: relative;
            overflow: hidden;
            width: 100%;
        }
        
        .dark .home-seamless-bg {
            background: transparent !important;
        }

        /* ===== AMBIENT GLOW ===== */
        .home-glow-1 {
            position: absolute;
            top: 5%;
            left: -150px;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(0, 75, 135, 0.20) 0%, transparent 70%);
            filter: blur(50px);
            z-index: 0;
            pointer-events: none;
        }

        .home-glow-2 {
            position: absolute;
            top: 45%;
            right: -200px;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.08) 0%, transparent 70%);
            filter: blur(60px);
            z-index: 0;
            pointer-events: none;
        }

        .dark .home-glow-1 {
            background: radial-gradient(circle, rgba(67, 99, 126, 0.20) 0%, transparent 70%);
        }

        .dark .home-glow-2 {
            background: radial-gradient(circle, rgba(99, 102, 241, 0.12) 0%, transparent 70%);
        }

        /* ============================================ */
        /* HERO SECTION WITH IMAGE                      */
        /* ============================================ */
        .hero-section {
            padding: 40px 0 60px;
            position: relative;
            z-index: 1;
        }

        .hero-wrapper {
            background: #ffffff;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25), 0 8px 30px rgba(0, 0, 0, 0.12);
            border: 1px solid rgba(232, 228, 222, 0.3);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .dark .hero-wrapper {
            background: #1a2632;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5), 0 8px 30px rgba(0, 0, 0, 0.3);
            border-color: rgba(44, 62, 80, 0.5);
        }

        .hero-wrapper:hover {
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.35), 0 12px 40px rgba(0, 0, 0, 0.15);
            transform: translateY(-4px);
        }

        .dark .hero-wrapper:hover {
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.6), 0 12px 40px rgba(0, 0, 0, 0.4);
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            min-height: 480px;
        }

        /* ---- LEFT CONTENT ---- */
        .hero-content {
            padding: 50px 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            z-index: 2;
            background: linear-gradient(135deg, #faf8f5 0%, #f0ede8 100%);
        }

        .dark .hero-content {
            background: linear-gradient(135deg, #1a2632 0%, #0f1a24 100%);
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(67, 99, 126, 0.12);
            color: #43637E;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 16px;
            width: fit-content;
            border: 1px solid rgba(67, 99, 126, 0.1);
        }

        .dark .hero-badge {
            background: rgba(67, 99, 126, 0.20);
            color: #f0e6d0;
            border-color: rgba(67, 99, 126, 0.2);
        }

        .hero-title {
            font-size: 48px;
            font-weight: 800;
            color: #002D55;
            line-height: 1.1;
            letter-spacing: -0.5px;
            font-family: 'Poppins', sans-serif !important;
        }

        .dark .hero-title {
            color: #ffffff;
        }

        .hero-title span {
            color: #004B87;
            background: linear-gradient(135deg, #002D55, #004B87);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .dark .hero-title span {
            background: linear-gradient(135deg, #f0e6d0, #d4c5a0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 18px;
            color: #475569;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-top: 6px;
            font-family: 'Poppins', sans-serif !important;
        }

        .dark .hero-subtitle {
            color: rgba(248, 250, 252, 0.8);
        }

        .hero-desc {
            color: #475569;
            font-size: 16px;
            max-width: 460px;
            line-height: 1.8;
            font-weight: 400;
            margin-top: 12px;
        }

        .dark .hero-desc {
            color: rgba(248, 250, 252, 0.7);
        }

        .hero-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 24px;
            position: relative;
            z-index: 2;
        }

        .hero-btn-primary {
            background: #002D55 !important;
            color: #ffffff !important;
            padding: 14px 36px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 0.5px;
            box-shadow: 0 8px 25px rgba(0, 45, 85, 0.30);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            border: none;
        }

        .dark .hero-btn-primary {
            background: #F0F4F8 !important;
            color: #002D55 !important;
            box-shadow: 0 8px 25px rgba(248, 250, 252, 0.15);
        }

        .hero-btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 35px rgba(0, 45, 85, 0.40);
        }

        .dark .hero-btn-primary:hover {
            box-shadow: 0 14px 35px rgba(248, 250, 252, 0.25);
        }

        .hero-btn-secondary {
            border: 1.5px solid rgba(15, 23, 42, 0.15) !important;
            color: #002D55 !important;
            padding: 14px 36px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
        }

        .dark .hero-btn-secondary {
            border: 1.5px solid rgba(255, 255, 255, 0.10) !important;
            color: #F0F4F8 !important;
            background: rgba(15, 23, 42, 0.4);
        }

        .hero-btn-secondary:hover {
            background: rgba(255, 255, 255, 0.8);
            transform: translateY(-3px);
            border-color: rgba(15, 23, 42, 0.30) !important;
        }

        .dark .hero-btn-secondary:hover {
            background: rgba(15, 23, 42, 0.6);
            border-color: rgba(255, 255, 255, 0.20) !important;
        }

        /* ---- RIGHT IMAGE ---- */
        .hero-image-wrapper {
            position: relative;
            overflow: hidden;
            min-height: 480px;
            background: linear-gradient(135deg, #d5d0c8, #e8e4de);
        }

        .dark .hero-image-wrapper {
            background: linear-gradient(135deg, #0f1a24, #1a2632);
        }

        .hero-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hero-wrapper:hover .hero-image-wrapper img {
            transform: scale(1.03);
        }

        .hero-image-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 40%;
            background: linear-gradient(to top, rgba(0,0,0,0.15), transparent);
            pointer-events: none;
        }

        .hero-image-badge {
            position: absolute;
            bottom: 24px;
            left: 24px;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(12px);
            padding: 12px 20px;
            border-radius: 12px;
            color: #ffffff;
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .dark .hero-image-badge {
            background: rgba(0, 0, 0, 0.7);
        }

        .hero-image-badge span {
            font-size: 20px;
        }

        /* ============================================ */
        /* ABOUT SECTION                               */
        /* ============================================ */
        .about-section {
            padding: 70px 0 60px;
            position: relative;
            z-index: 1;
        }

        .about-title {
            font-size: 38px;
            font-weight: 700;
            color: #002D55;
            margin-bottom: 16px;
            font-family: 'Poppins', sans-serif !important;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .dark .about-title {
            color: #ffffff;
        }

        .about-title span {
            color: #004B87;
            background: linear-gradient(135deg, #002D55, #004B87);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .dark .about-title span {
            background: linear-gradient(135deg, #f0e6d0, #d4c5a0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .about-text {
            color: #475569;
            line-height: 1.9;
            font-size: 16px;
            font-weight: 400;
        }

        .dark .about-text {
            color: rgba(248, 250, 252, 0.7);
        }

        .about-highlight {
            background: rgba(255, 255, 255, 0.90) !important;
            backdrop-filter: blur(10px);
            padding: 20px 24px;
            border-radius: 16px;
            border-left: 5px solid #004B87;
            margin-top: 24px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            border-top: 1px solid rgba(255, 255, 255, 0.6);
            border-right: 1px solid rgba(255, 255, 255, 0.6);
            border-bottom: 1px solid rgba(255, 255, 255, 0.6);
        }

        .dark .about-highlight {
            background: rgba(26, 38, 50, 0.90) !important;
            border-color: #43637E;
            border-left-color: #43637E;
        }

        .about-highlight p {
            color: #0f172a !important;
            font-weight: 600;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .dark .about-highlight p {
            color: #f0ede8 !important;
        }

        /* ===== STAT CARD ===== */
        .stat-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.90) !important;
            backdrop-filter: blur(16px);
            padding: 24px 16px;
            border-radius: 18px;
            text-align: center;
            border: 1px solid rgba(232, 228, 222, 0.4);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.06);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 120px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .dark .stat-card {
            background: rgba(26, 38, 50, 0.90) !important;
            border-color: rgba(44, 62, 80, 0.4);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .stat-card:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.15);
            border-color: rgba(67, 99, 126, 0.3);
        }

        .dark .stat-card:hover {
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.4);
            border-color: rgba(67, 99, 126, 0.2);
        }

        .stat-icon {
            font-size: 32px;
            display: block;
            margin-bottom: 8px;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 800;
            color: #0f172a !important;
            font-family: 'Poppins', sans-serif !important;
        }

        .dark .stat-number {
            color: #f0ede8 !important;
        }

        .stat-label {
            font-size: 12px;
            color: #64748B !important;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-top: 4px;
        }

        .dark .stat-label {
            color: #b0bec5 !important;
        }

        /* ============================================ */
        /* ARMADA SECTION                              */
        /* ============================================ */
        .armada-section {
            padding: 60px 0 70px;
            position: relative;
            z-index: 1;
        }

        .armada-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 36px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .armada-header h2 {
            font-size: 34px;
            font-weight: 700;
            color: #002D55;
            font-family: 'Poppins', sans-serif !important;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .dark .armada-header h2 {
            color: #ffffff;
        }

        .armada-header h2 span {
            font-size: 34px;
        }

        .armada-view-all {
            color: #004B87;
            font-weight: 600;
            text-decoration: none;
            padding: 10px 24px;
            border: 2px solid #004B87;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-size: 14px;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .dark .armada-view-all {
            color: #f0e6d0;
            border-color: #f0e6d0;
        }

        .armada-view-all:hover {
            background: #004B87;
            color: #ffffff !important;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 75, 135, 0.3);
        }

        .dark .armada-view-all:hover {
            background: #f0e6d0;
            color: #002D55 !important;
        }

        .armada-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .armada-card {
            background: rgba(255, 255, 255, 0.90) !important;
            backdrop-filter: blur(16px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(232, 228, 222, 0.3);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .dark .armada-card {
            background: rgba(26, 38, 50, 0.90) !important;
            border-color: rgba(44, 62, 80, 0.4);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .armada-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #004B87, #f0e6d0, #004B87);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 2;
        }

        .armada-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.18);
            border-color: rgba(67, 99, 126, 0.3);
        }

        .dark .armada-card:hover {
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
            border-color: rgba(67, 99, 126, 0.2);
        }

        .armada-card:hover::before {
            opacity: 1;
        }

        .armada-image {
            height: 200px;
            background: linear-gradient(135deg, #e8e4de, #d5d0c8);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 72px;
            overflow: hidden;
            position: relative;
        }

        .dark .armada-image {
            background: linear-gradient(135deg, #1a2632, #0f1a24);
        }

        .armada-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .armada-card:hover .armada-image img {
            transform: scale(1.06);
        }

        .armada-image .placeholder-icon {
            font-size: 72px;
            opacity: 0.4;
        }

        .armada-body {
            padding: 20px 22px 24px;
        }

        .armada-name {
            font-size: 20px;
            font-weight: 700;
            color: #0f172a !important;
            font-family: 'Poppins', sans-serif !important;
        }

        .dark .armada-name {
            color: #f0ede8 !important;
        }

        .armada-spec {
            font-size: 13px;
            color: #64748B !important;
            margin-top: 6px;
            letter-spacing: 0.3px;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .dark .armada-spec {
            color: #b0bec5 !important;
        }

        .armada-spec .sep {
            color: #c0c8d0;
        }

        .armada-price {
            font-size: 24px;
            font-weight: 800;
            color: #004B87 !important;
            margin-top: 12px;
            font-family: 'Poppins', sans-serif !important;
        }

        .dark .armada-price {
            color: #f0e6d0 !important;
        }

        .armada-price small {
            font-size: 13px;
            font-weight: 400;
            color: #64748B !important;
        }

        .dark .armada-price small {
            color: #b0bec5 !important;
        }

        .armada-location {
            font-size: 13px;
            color: #64748B !important;
            margin-top: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .dark .armada-location {
            color: #b0bec5 !important;
        }

        .armada-stock {
            font-size: 11px;
            color: #15803D !important;
            background: #DCFCE7 !important;
            padding: 3px 12px;
            border-radius: 20px;
            font-weight: 600;
        }

        .dark .armada-stock {
            background: #1e3d2e !important;
            color: #8abd9a !important;
        }

        .armada-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            text-align: center;
            background: #0f172a;
            color: #ffffff !important;
            padding: 12px 0;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            margin-top: 16px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.15);
        }

        .dark .armada-btn {
            background: #f0e6d0;
            color: #002D55 !important;
        }

        .armada-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.25);
        }

        .dark .armada-btn:hover {
            box-shadow: 0 8px 25px rgba(240, 230, 208, 0.2);
        }

        /* ============================================ */
        /* FOOTER                                      */
        /* ============================================ */
        .footer {
            background: #002D55 !important;
            color: #f0ede8;
            padding: 50px 0 30px;
            position: relative;
            z-index: 1;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .dark .footer {
            background: #0a1a2e !important;
        }

        .footer-title {
            font-size: 26px;
            font-weight: 800;
            color: #ffffff;
        }

        .footer-text {
            color: rgba(240, 237, 232, 0.6);
            margin-top: 6px;
            font-weight: 300;
            font-size: 14px;
        }

        .footer-heading {
            font-weight: 700;
            margin-bottom: 14px;
            font-size: 14px;
            color: #ffffff;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .footer-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-list li {
            color: rgba(240, 237, 232, 0.55);
            padding: 5px 0;
            font-size: 13.5px;
            transition: color 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-list li:hover {
            color: #ffffff;
        }

        .footer-divider {
            border-top: 1px solid rgba(240, 237, 232, 0.06);
            margin-top: 36px;
            padding-top: 28px;
            text-align: center;
            color: rgba(240, 237, 232, 0.35);
            font-size: 13px;
            font-weight: 300;
        }

        /* ============================================ */
        /* RESPONSIVE                                  */
        /* ============================================ */
        @media (max-width: 1024px) {
            .armada-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
            .hero-grid {
                grid-template-columns: 1fr;
            }
            .hero-image-wrapper {
                min-height: 320px;
            }
            .hero-content {
                padding: 36px 32px;
            }
            .hero-title {
                font-size: 38px;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 32px;
            }
            .hero-subtitle {
                font-size: 15px;
                letter-spacing: 2px;
            }
            .hero-content {
                padding: 28px 24px;
            }
            .hero-image-wrapper {
                min-height: 260px;
            }
            .about-title {
                font-size: 30px;
            }
            .stat-number {
                font-size: 26px;
            }
            .stat-grid {
                gap: 12px;
            }
            .armada-header h2 {
                font-size: 28px;
            }
            .armada-grid {
                grid-template-columns: 1fr 1fr;
                gap: 16px;
            }
            .hero-buttons {
                flex-direction: column;
                align-items: stretch;
            }
            .hero-btn-primary,
            .hero-btn-secondary {
                justify-content: center;
            }
            .hero-image-badge {
                font-size: 11px;
                padding: 10px 16px;
                bottom: 16px;
                left: 16px;
            }
            .hero-image-badge span {
                font-size: 16px;
            }
        }

        @media (max-width: 480px) {
            .armada-grid {
                grid-template-columns: 1fr;
                gap: 14px;
            }
            .stat-grid {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }
            .stat-card {
                padding: 16px 12px;
                min-height: 100px;
            }
            .stat-number {
                font-size: 22px;
            }
            .stat-icon {
                font-size: 24px;
            }
            .armada-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .armada-header h2 {
                font-size: 24px;
            }
            .hero-title {
                font-size: 28px;
            }
            .hero-content {
                padding: 20px 16px;
            }
            .hero-image-wrapper {
                min-height: 200px;
            }
            .about-title {
                font-size: 24px;
            }
            .about-highlight {
                padding: 14px 16px;
            }
            .about-highlight p {
                font-size: 13px;
            }
            .footer {
                padding: 30px 0 20px;
            }
            .footer-title {
                font-size: 22px;
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
            background: linear-gradient(135deg, #43637E, #5a7a9a);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #36546b, #4a6a8a);
        }
        .dark ::-webkit-scrollbar-track {
            background: #1a2632;
        }
        .dark ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #43637E, #5a7a9a);
        }
    </style>

    <div class="home-seamless-bg">
        <!-- Floating glow spheres -->
        <div class="home-glow-1"></div>
        <div class="home-glow-2"></div>

        <!-- ============================================ -->
        <!-- HERO SECTION WITH IMAGE                      -->
        <!-- ============================================ -->
        <div class="hero-section">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="hero-wrapper">
                    <div class="hero-grid">
                        <!-- LEFT: Content -->
                        <div class="hero-content">
                            <div class="hero-badge">
                                🏆 Rental Terpercaya #1
                            </div>
                            <h1 class="hero-title">
                                <span>GoAnywhere</span>
                            </h1>
                            <p class="hero-subtitle">Mewah. Nyaman. Profesional.</p>
                            <p class="hero-desc">
                                Tawaran hebat dengan harga menarik dari perusahaan rental kendaraan terpercaya se-Jabodetabek.
                            </p>
                            <div class="hero-buttons">
                                <a href="{{ route('user.armada') }}" class="hero-btn-primary">
                                    🚗 Lihat Armada
                                </a>
                                <a href="{{ route('user.layanan') }}" class="hero-btn-secondary">
                                    📋 Layanan
                                </a>
                            </div>
                        </div>

                        <!-- RIGHT: Image -->
                        <div class="hero-image-wrapper">
                            <img src="{{ asset('storage/goy.png') }}" alt="GoAnywhere - Rental Kendaraan Terpercaya">
                            <div class="hero-image-overlay"></div>
                            <div class="hero-image-badge">
                                <span>🚙</span>
                                <div>
                                    <div style="font-weight: 700; font-size: 14px;">Kendaraan Premium</div>
                                    <div style="opacity: 0.7; font-size: 11px;">Siap Antar ke Lokasi Anda</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- ABOUT SECTION                               -->
        <!-- ============================================ -->
        <div class="about-section">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <div>
                        <h2 class="about-title">
                            <span>📌</span> Tentang <span>GoAnywhere</span>
                        </h2>
                        <p class="about-text">
                            GoAnywhere adalah perusahaan penyedia jasa rental kendaraan Jakarta dan sekitarnya untuk harian dan mingguan.
                        </p>
                        <p class="about-text" style="margin-top: 16px;">
                            Layanan sewa atau rental kendaraan yang kami sediakan mulai dari kendaraan operasional hingga kendaraan mewah seperti Toyota Avanza, Honda Civic, hingga Toyota Fortuner.
                        </p>
                        <p class="about-text" style="margin-top: 16px;">
                            Dengan berbagai macam pilihan kendaraan terbaik, kami jamin mampu memenuhi kebutuhan transportasi Anda, terutama dari segi kenyamanan dan keselamatan demi kepuasan Anda dalam perjalanan.
                        </p>
                        <div class="about-highlight">
                            <p>
                                <span>💬</span> Sewa kendaraan di GoAnywhere sekarang juga! Kami siap melayani Anda sepenuh hati!
                            </p>
                        </div>
                    </div>
                    <div>
                        <div class="stat-grid">
                            <div class="stat-card">
                                <span class="stat-icon">📅</span>
                                <div class="stat-number">2024</div>
                                <div class="stat-label">Berdiri Sejak</div>
                            </div>
                            <div class="stat-card">
                                <span class="stat-icon">📍</span>
                                <div class="stat-number">5</div>
                                <div class="stat-label">Lokasi</div>
                            </div>
                            <div class="stat-card">
                                <span class="stat-icon">🚗</span>
                                <div class="stat-number">{{ $totalVehicles ?? 0 }}+</div>
                                <div class="stat-label">Armada</div>
                            </div>
                            <div class="stat-card">
                                <span class="stat-icon">⭐</span>
                                <div class="stat-number">100%</div>
                                <div class="stat-label">Kepercayaan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- ARMADA TERBARU                              -->
        <!-- ============================================ -->
        <div class="armada-section">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="armada-header">
                    <h2>
                        <span>🚘</span> Armada Terbaru
                    </h2>
                    <a href="{{ route('user.armada') }}" class="armada-view-all">
                        Lihat Semua →
                    </a>
                </div>

                <div class="armada-grid">
                    @forelse($latestVehicles ?? [] as $vehicle)
                        <div class="armada-card">
                            <div class="armada-image">
                                @if($vehicle->image)
                                    <img src="{{ asset('storage/' . $vehicle->image) }}" alt="{{ $vehicle->name }}">
                                @else
                                    <span class="placeholder-icon">{{ $vehicle->vehicle_type == 'car' ? '🚗' : '🏍️' }}</span>
                                @endif
                            </div>
                            <div class="armada-body">
                                <h3 class="armada-name">{{ $vehicle->name }}</h3>
                                <div class="armada-spec">
                                    <span>{{ $vehicle->brand ?? 'N/A' }}</span>
                                    <span class="sep">•</span>
                                    <span>{{ $vehicle->year ?? '2024' }}</span>
                                    <span class="sep">•</span>
                                    <span>{{ $vehicle->transmission ?? $vehicle->transmission_motor ?? 'Manual' }}</span>
                                </div>
                                <div class="armada-price">
                                    Rp {{ number_format($vehicle->price_per_day ?? 0, 0, ',', '.') }}
                                    <small>/ hari</small>
                                </div>
                                <div class="armada-location">
                                    <span>📍 {{ $vehicle->location ?? 'Jakarta' }}</span>
                                    <span class="armada-stock">{{ $vehicle->available_stock ?? 0 }} tersedia</span>
                                </div>
                                <a href="{{ route('user.armada.detail', $vehicle->id) }}" class="armada-btn">
                                    🔍 Detail
                                </a>
                            </div>
                        </div>
                    @empty
                        <div style="grid-column: span 3; text-align: center; padding: 50px 20px; color: #64748B;" class="dark:text-slate-400">
                            <div style="font-size: 56px; margin-bottom: 16px;">🚫</div>
                            <p style="font-size: 18px; font-weight: 400;">Belum ada kendaraan tersedia</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- FOOTER                                      -->
        <!-- ============================================ -->
        <footer class="footer">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                    <div>
                        <h3 class="footer-title">🚗 GoAnywhere</h3>
                        <p class="footer-text">Solusi rental kendaraan terpercaya</p>
                    </div>
                    <div>
                        <h4 class="footer-heading">📍 Lokasi</h4>
                        <ul class="footer-list">
                            <li>📍 Jakarta</li>
                            <li>📍 Bogor</li>
                            <li>📍 Depok</li>
                            <li>📍 Tangerang</li>
                            <li>📍 Bekasi</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="footer-heading">📞 Kontak</h4>
                        <ul class="footer-list">
                            <li>📱 0812-3456-7890</li>
                            <li>✉️ info@goanywhere.com</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="footer-heading">🕐 Jam Operasional</h4>
                        <ul class="footer-list">
                            <li>📅 Senin - Minggu</li>
                            <li>⏰ 08:00 - 22:00</li>
                        </ul>
                    </div>
                </div>
                <div class="footer-divider">
                    © {{ date('Y') }} GoAnywhere. All rights reserved. Made with ❤️
                </div>
            </div>
        </footer>
    </div>
</x-app-layout>