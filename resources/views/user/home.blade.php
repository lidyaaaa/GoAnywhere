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
        /* DETAILED RENTAL WORKFLOW SECTION            */
        /* ============================================ */
        .flow-section {
            padding: 50px 0 60px;
            position: relative;
            z-index: 1;
        }

        .flow-header {
            text-align: center;
            max-width: 760px;
            margin: 0 auto 44px;
        }

        .flow-tag {
            display: inline-block;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #004B87;
            background: rgba(0, 75, 135, 0.08);
            padding: 6px 14px;
            border-radius: 20px;
            margin-bottom: 12px;
            border: 1px solid rgba(0, 75, 135, 0.15);
        }

        .dark .flow-tag {
            color: #8ab4d4;
            background: rgba(67, 99, 126, 0.25);
            border-color: rgba(67, 99, 126, 0.4);
        }

        .flow-title {
            font-size: 32px;
            font-weight: 800;
            color: #002D55;
            font-family: 'Poppins', sans-serif !important;
            margin-bottom: 12px;
            line-height: 1.3;
        }

        .dark .flow-title {
            color: #ffffff;
        }

        .flow-subtitle {
            font-size: 15px;
            color: #64748B;
            line-height: 1.6;
        }

        .dark .flow-subtitle {
            color: #94a3b8;
        }

        .flow-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        @media (max-width: 1024px) {
            .flow-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .flow-grid {
                grid-template-columns: 1fr;
            }
        }

        .flow-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(16px);
            border-radius: 22px;
            padding: 26px 24px;
            border: 1px solid rgba(232, 228, 222, 0.6);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .dark .flow-card {
            background: rgba(26, 38, 50, 0.85);
            border-color: rgba(44, 62, 80, 0.6);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        }

        .flow-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 40px rgba(0, 75, 135, 0.12);
            border-color: rgba(0, 75, 135, 0.3);
        }

        .dark .flow-card:hover {
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.45);
            border-color: rgba(138, 180, 212, 0.3);
        }

        .flow-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .flow-badge-step {
            font-size: 11px;
            font-weight: 800;
            padding: 4px 10px;
            border-radius: 8px;
            letter-spacing: 0.5px;
        }

        .flow-step-icon {
            font-size: 28px;
        }

        .flow-card-heading {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 10px;
            line-height: 1.35;
        }

        .dark .flow-card-heading {
            color: #f8fafc;
        }

        .flow-card-desc {
            font-size: 13.5px;
            color: #475569;
            line-height: 1.7;
            margin-bottom: 16px;
        }

        .dark .flow-card-desc {
            color: #cbd5e1;
        }

        .flow-card-tip {
            background: rgba(241, 245, 249, 0.8);
            border-radius: 12px;
            padding: 10px 14px;
            font-size: 11.5px;
            color: #334155;
            border-left: 3px solid #004B87;
            line-height: 1.5;
        }

        .dark .flow-card-tip {
            background: rgba(15, 23, 42, 0.6);
            color: #94a3b8;
            border-left-color: #38bdf8;
        }

        .flow-card-tip strong {
            color: #004B87;
        }

        .dark .flow-card-tip strong {
            color: #38bdf8;
        }

        .flow-summary-banner {
            margin-top: 36px;
            background: linear-gradient(135deg, #002D55 0%, #004B87 100%);
            border-radius: 24px;
            padding: 28px 32px;
            color: #ffffff;
            box-shadow: 0 16px 45px rgba(0, 45, 85, 0.25);
        }

        .dark .flow-summary-banner {
            background: linear-gradient(135deg, #0a1928 0%, #17324d 100%);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .flow-summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        @media (max-width: 1024px) {
            .flow-summary-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .flow-summary-grid {
                grid-template-columns: 1fr;
            }
        }

        .flow-summary-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .flow-summary-icon {
            font-size: 24px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .flow-summary-text h5 {
            font-size: 14px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 4px;
        }

        .flow-summary-text p {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.75);
            line-height: 1.5;
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
                            <img src="{{ asset('storage/goy.jpg') }}" alt="GoAnywhere - Rental Kendaraan Terpercaya">
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
        <!-- PANDUAN DETAIL ALUR SEWA (USER JOURNEY)      -->
        <!-- ============================================ -->
        <div class="flow-section">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flow-header">
                    <span class="flow-tag">Panduan Lengkap Penyewa</span>
                    <h2 class="flow-title">Alur Lengkap Sewa Kendaraan di GoAnywhere</h2>
                    <p class="flow-subtitle">
                        Transparan, tertib, dan aman. Pahami 6 tahapan mudah mulai dari memilih unit armada hingga pengembalian dan penyelesaian transaksi.
                    </p>
                </div>

                <div class="flow-grid">
                    <!-- Step 1 -->
                    <div class="flow-card">
                        <div>
                            <div class="flow-card-top">
                                <span class="flow-badge-step bg-blue-100 text-blue-800 dark:bg-blue-950 dark:text-blue-300">Tahap 01</span>
                                <span class="flow-step-icon">🚗</span>
                            </div>
                            <h3 class="flow-card-heading">Pilih Lokasi & Durasi Sewa</h3>
                            <p class="flow-card-desc">
                                Cari kendaraan sesuai wilayah Anda (Jakarta, Bogor, Depok, Tangerang, Bekasi). Tentukan paket durasi: <strong>Harian (1–5 hari)</strong> atau <strong>Mingguan (7 hari)</strong> dengan harga hemat.
                            </p>
                        </div>
                        <div class="flow-card-tip">
                            <strong>💡 Aturan Rental:</strong> Anda dapat menyewa maksimal 1 Mobil dan/atau 1 Motor dalam satu transaksi checkout.
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="flow-card">
                        <div>
                            <div class="flow-card-top">
                                <span class="flow-badge-step bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300">Tahap 02</span>
                                <span class="flow-step-icon">💳</span>
                            </div>
                            <h3 class="flow-card-heading">Checkout & Pembayaran Online</h3>
                            <p class="flow-card-desc">
                                Masukkan alamat pengantaran unit. Biaya kirim door-to-door flat (Motor Rp 25k, Mobil Rp 50k). Bayar cepat melalui <strong>QRIS, Transfer Bank, GoPay, DANA, atau OVO</strong>.
                            </p>
                        </div>
                        <div class="flow-card-tip">
                            <strong>🛡️ Transparan:</strong> Begitu bayar, status menjadi <em>Paid</em>. Anda dapat membatalkan pesanan mandiri sebelum di-approve manager.
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="flow-card">
                        <div>
                            <div class="flow-card-top">
                                <span class="flow-badge-step bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300">Tahap 03</span>
                                <span class="flow-step-icon">🚚</span>
                            </div>
                            <h3 class="flow-card-heading">Persetujuan Cabang & Unit OTW</h3>
                            <p class="flow-card-desc">
                                Manager cabang menyetujui pesanan Anda, stok unit terpotong otomatis, dan driver langsung mengantarkan armada ke titik lokasi Anda (status <strong>Armada OTW</strong>).
                            </p>
                        </div>
                        <div class="flow-card-tip">
                            <strong>💬 Live Chat:</strong> Pantau pengantaran dan chat langsung dengan driver/manager cabang via fitur Live Chat bawaan.
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="flow-card">
                        <div>
                            <div class="flow-card-top">
                                <span class="flow-badge-step bg-indigo-100 text-indigo-800 dark:bg-indigo-950 dark:text-indigo-300">Tahap 04</span>
                                <span class="flow-step-icon">🪪</span>
                            </div>
                            <h3 class="flow-card-heading">Serah Terima & Foto Jaminan KTP</h3>
                            <p class="flow-card-desc">
                                Saat unit tiba di lokasi, tunjukkan <strong>KTP Asli Fisik</strong> kepada staf untuk difoto sebagai jaminan resmi. Detik serah terima dikonfirmasi, status berubah menjadi <strong>Sewa Aktif</strong>.
                            </p>
                        </div>
                        <div class="flow-card-tip">
                            <strong>⏱️ Timer Adil:</strong> Timer masa sewa Anda <strong>baru mulai berjalan</strong> saat kunci fisik diserahkan, bukan saat bayar!
                        </div>
                    </div>

                    <!-- Step 5 -->
                    <div class="flow-card">
                        <div>
                            <div class="flow-card-top">
                                <span class="flow-badge-step bg-purple-100 text-purple-800 dark:bg-purple-950 dark:text-purple-300">Tahap 05</span>
                                <span class="flow-step-icon">🏢</span>
                            </div>
                            <h3 class="flow-card-heading">Pengembalian ke Gerai Cabang</h3>
                            <p class="flow-card-desc">
                                Sebelum batas waktu habis, bawa kendaraan ke gerai cabang terdaftar. Begitu Anda tiba dan menyerahkan kunci, Manager mengklik <strong>Konfirmasi Tiba di Gerai</strong>.
                            </p>
                        </div>
                        <div class="flow-card-tip">
                            <strong>🛑 Stop Denda:</strong> Timer keterlambatan terkunci dan berhenti resmi detik Manager mengonfirmasi kedatangan Anda di gerai.
                        </div>
                    </div>

                    <!-- Step 6 -->
                    <div class="flow-card">
                        <div>
                            <div class="flow-card-top">
                                <span class="flow-badge-step bg-teal-100 text-teal-800 dark:bg-teal-950 dark:text-teal-300">Tahap 06</span>
                                <span class="flow-step-icon">🔍</span>
                            </div>
                            <h3 class="flow-card-heading">Cek Fisik Unit & Selesai</h3>
                            <p class="flow-card-desc">
                                Manager memeriksa fisik kendaraan bersama Anda. Jika unit aman & tepat waktu, transaksi tuntas berstatus <strong>Selesai</strong> dan KTP jaminan Anda dikembalikan penuh.
                            </p>
                        </div>
                        <div class="flow-card-tip">
                            <strong>⚖️ Transparansi:</strong> Jika ada baret/kerusakan atau telat (>30 menit toleransi), tagihan denda diinput transparan dan dibayar online.
                        </div>
                    </div>
                </div>

                <!-- 4 Highlight Bullets at Bottom -->
                <div class="flow-summary-banner">
                    <div class="flow-summary-grid">
                        <div class="flow-summary-item">
                            <span class="flow-summary-icon">⏱️</span>
                            <div class="flow-summary-text">
                                <h5>Timer Real-Time Adil</h5>
                                <p>Durasi sewa murni dimulai saat terima kunci dan berhenti saat tiba di gerai cabang.</p>
                            </div>
                        </div>
                        <div class="flow-summary-item">
                            <span class="flow-summary-icon">🪪</span>
                            <div class="flow-summary-text">
                                <h5>KTP Terjamin Aman</h5>
                                <p>Foto jaminan KTP tersimpan aman terenkripsi hanya untuk keperluan verifikasi unit.</p>
                            </div>
                        </div>
                        <div class="flow-summary-item">
                            <span class="flow-summary-icon">💬</span>
                            <div class="flow-summary-text">
                                <h5>Fitur Live Chat Bawaan</h5>
                                <p>Komunikasi langsung dengan Manager gerai di dalam aplikasi tanpa nomor pribadi.</p>
                            </div>
                        </div>
                        <div class="flow-summary-item">
                            <span class="flow-summary-icon">🛡️</span>
                            <div class="flow-summary-text">
                                <h5>Bebas Biaya Tersembunyi</h5>
                                <p>Semua rincian biaya sewa, ongkos kirim, dan denda tercatat detail dan transparan.</p>
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
    </div>
</x-app-layout>