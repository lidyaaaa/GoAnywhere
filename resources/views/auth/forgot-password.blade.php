<x-guest-layout>
    <style>
        /* ============================================ */
        /* FORGOT PASSWORD PAGE - ELEGAN #43637E        */
        /* ============================================ */
        * {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .auth-container {
            max-width: 440px;
            margin: 0 auto;
            padding: 40px 36px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.25), 0 8px 30px rgba(0, 0, 0, 0.12);
            border: 1px solid #e8e4de;
        }

        .auth-container:hover {
            box-shadow: 0 24px 65px rgba(0, 0, 0, 0.35), 0 12px 40px rgba(0, 0, 0, 0.2);
            border-color: #43637E;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .auth-header .icon-wrap {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: rgba(67, 99, 126, 0.1);
            color: #43637E;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
            font-size: 28px;
        }

        .auth-header .title {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
        }

        .auth-header .title .highlight {
            color: #43637E;
        }

        .auth-header .subtitle {
            font-size: 14px;
            color: #7a8a9a;
            margin-top: 8px;
            line-height: 1.5;
            font-weight: 300;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #43637E;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .form-group input[type="email"] {
            width: 100%;
            padding: 12px 16px;
            border-radius: 10px;
            border: 1.5px solid #e8e4de;
            font-size: 15px;
            background: #faf8f5;
            transition: all 0.3s ease;
            color: #2c3e50;
        }

        .form-group input[type="email"]:focus {
            border-color: #43637E;
            box-shadow: 0 0 0 4px rgba(67, 99, 126, 0.12);
            outline: none;
            background: #ffffff;
        }

        .form-group input[type="email"]::placeholder {
            color: #b0a8a0;
        }

        .form-group .error-text {
            color: #b04a4a;
            font-size: 13px;
            margin-top: 4px;
        }

        .auth-actions {
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin-top: 10px;
        }

        .btn-submit {
            background: #43637E;
            color: #ffffff;
            padding: 14px 20px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            text-align: center;
            border: none;
            cursor: pointer;
            width: 100%;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(67, 99, 126, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background: #36546b;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(67, 99, 126, 0.4);
        }

        .back-link {
            text-align: center;
            font-size: 14px;
            color: #7a8a9a;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 4px;
        }

        .back-link strong {
            color: #43637E;
        }

        .back-link:hover {
            color: #43637E;
        }

        .session-status {
            background: #eef6ec;
            border: 1px solid #c2e2ba;
            color: #2b7a2b;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 20px;
            line-height: 1.4;
        }

        /* DARK MODE */
        .dark .auth-container {
            background: #1a2632;
            border-color: #2c3e50;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.5);
        }

        .dark .auth-header .icon-wrap {
            background: rgba(67, 99, 126, 0.25);
            color: #8baac4;
        }

        .dark .auth-header .title {
            color: #f0ede8;
        }

        .dark .auth-header .subtitle {
            color: #8b9baa;
        }

        .dark .form-group label {
            color: #8baac4;
        }

        .dark .form-group input[type="email"] {
            background: #0f1a24;
            border-color: #2c3e50;
            color: #f0ede8;
        }

        .dark .form-group input[type="email"]:focus {
            background: #15222e;
            border-color: #43637E;
        }

        .dark .back-link {
            color: #8b9baa;
        }

        .dark .back-link strong {
            color: #8baac4;
        }

        .dark .session-status {
            background: #162e20;
            border-color: #255836;
            color: #8bd99f;
        }
    </style>

    <div class="auth-container">
        <!-- Header -->
        <div class="auth-header">
            <div class="icon-wrap">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h2 class="title">Lupa <span class="highlight">Password</span>?</h2>
            <p class="subtitle">
                Jangan khawatir. Masukkan email yang terdaftar dan kami akan mengirimkan tautan untuk mengatur ulang password Anda.
            </p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="session-status">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" 
                       placeholder="contoh: nama@email.com" required autofocus autocomplete="username">
                @if($errors->has('email'))
                    <div class="error-text">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <div class="auth-actions">
                <button type="submit" class="btn-submit">
                    <span>Kirim Tautan Reset Password</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>

                <a class="back-link" href="{{ route('login') }}">
                    ← Ingat password? <strong>Kembali ke Login</strong>
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
