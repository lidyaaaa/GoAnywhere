<x-guest-layout>
    <style>
        /* ============================================ */
        /* LOGIN PAGE - ELEGAN #43637E                  */
        /* ============================================ */
        * {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .login-container {
            max-width: 420px;
            margin: 0 auto;
            padding: 40px 36px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.25), 0 8px 30px rgba(0, 0, 0, 0.12);
            border: 1px solid #e8e4de;
        }

        .login-container:hover {
            box-shadow: 0 24px 65px rgba(0, 0, 0, 0.35), 0 12px 40px rgba(0, 0, 0, 0.2);
            border-color: #43637E;
        }

        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-header .icon {
            font-size: 48px;
            display: block;
            margin-bottom: 8px;
        }

        .login-header .title {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
        }

        .login-header .title .highlight {
            color: #43637E;
        }

        .login-header .subtitle {
            font-size: 14px;
            color: #7a8a9a;
            margin-top: 4px;
            font-weight: 300;
        }

        .form-group {
            margin-bottom: 20px;
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

        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 12px 16px;
            border-radius: 10px;
            border: 1.5px solid #e8e4de;
            font-size: 15px;
            background: #faf8f5;
            transition: all 0.3s ease;
            color: #2c3e50;
        }

        .form-group input[type="email"]:focus,
        .form-group input[type="password"]:focus {
            border-color: #43637E;
            box-shadow: 0 0 0 4px rgba(67, 99, 126, 0.12);
            outline: none;
            background: #ffffff;
        }

        .form-group input[type="email"]::placeholder,
        .form-group input[type="password"]::placeholder {
            color: #b0a8a0;
        }

        .form-group .error-text {
            color: #b04a4a;
            font-size: 13px;
            margin-top: 4px;
        }

        .remember-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 4px;
        }

        .remember-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            border-radius: 6px;
            border: 2px solid #e8e4de;
            accent-color: #43637E;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .remember-group input[type="checkbox"]:checked {
            border-color: #43637E;
        }

        .remember-group label {
            font-size: 14px;
            color: #7a8a9a;
            cursor: pointer;
            font-weight: 500;
        }

        .login-actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 24px;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: #43637E;
            color: #ffffff;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 16px;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 8px 30px rgba(67, 99, 126, 0.4);
        }

        .btn-login:hover {
            background: #36546b;
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(67, 99, 126, 0.5);
        }

        .register-link {
            text-align: center;
            font-size: 14px;
            color: #7a8a9a;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .register-link:hover {
            color: #43637E;
        }

        .register-link strong {
            color: #43637E;
        }

        .register-link strong:hover {
            text-decoration: underline;
        }

        .session-status {
            background: #e8f4ec;
            border: 1px solid #4a7a5a;
            color: #4a7a5a;
            padding: 12px 16px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            text-align: center;
            margin-bottom: 20px;
        }

        /* ===== DARK MODE ===== */
        .dark .login-container {
            background: #1a2632;
            border-color: #2c3e50;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.5), 0 8px 30px rgba(0, 0, 0, 0.3);
        }

        .dark .login-container:hover {
            border-color: #43637E;
            box-shadow: 0 24px 65px rgba(0, 0, 0, 0.6), 0 12px 40px rgba(0, 0, 0, 0.4);
        }

        .dark .login-header .title {
            color: #f0ede8;
        }

        .dark .login-header .title .highlight {
            color: #f0e6d0;
        }

        .dark .login-header .subtitle {
            color: #b0bec5;
        }

        .dark .form-group label {
            color: #f0e6d0;
        }

        .dark .form-group input[type="email"],
        .dark .form-group input[type="password"] {
            background: #0f1a24;
            border-color: #2c3e50;
            color: #f0ede8;
        }

        .dark .form-group input[type="email"]:focus,
        .dark .form-group input[type="password"]:focus {
            border-color: #43637E;
            background: #1a2632;
        }

        .dark .form-group input[type="email"]::placeholder,
        .dark .form-group input[type="password"]::placeholder {
            color: #5a6a7a;
        }

        .dark .remember-group label {
            color: #b0bec5;
        }

        .dark .register-link {
            color: #7a8a9a;
        }

        .dark .register-link:hover {
            color: #f0e6d0;
        }

        .dark .register-link strong {
            color: #f0e6d0;
        }

        .dark .session-status {
            background: #1e3d2e;
            border-color: #4a7a5a;
            color: #8abd9a;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 28px 20px;
                border-radius: 16px;
            }

            .login-header .title {
                font-size: 20px;
            }

            .login-header .icon {
                font-size: 40px;
            }

            .form-group input[type="email"],
            .form-group input[type="password"] {
                font-size: 14px;
                padding: 10px 14px;
            }

            .btn-login {
                font-size: 14px;
                padding: 12px;
            }
        }

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

    <div class="login-container">
        <!-- Header -->
        <div class="login-header">
            <span class="icon"></span>
            <h2 class="title">Welcome to <span class="highlight">GoAnywhere</span></h2>
            <p class="subtitle">Masuk untuk mulai menyewa kendaraan</p>
        </div>

        <!-- Session Status -->
        @if(session('status'))
                <div class="session-status">
                     {{ session('status') }}
                </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" 
                       placeholder="Masukkan email Anda" required autofocus autocomplete="username">
                @if($errors->has('email'))
                    <div class="error-text">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" 
                       placeholder="Masukkan password Anda" required autocomplete="current-password">
                @if($errors->has('password'))
                    <div class="error-text">{{ $errors->first('password') }}</div>
                @endif
            </div>

            <div class="remember-group">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">Ingat saya</label>
            </div>

            <div class="login-actions">
                <button type="submit" class="btn-login">
                    Login
                </button>

                <a class="register-link" href="{{ route('register') }}">
                    Belum punya akun? <strong>Register</strong>
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>