<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Admin Dishub Kota Palu</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-dishub.png') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
        }

        /* Left Panel */
        .left-panel {
            width: 55%;
            background: linear-gradient(145deg, #0f1e5e 0%, #1e3a8a 40%, #1d4ed8 70%, #2563eb 100%);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px;
        }

        .left-panel .orb {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.04);
        }

        .left-panel .orb-1 {
            width: 400px;
            height: 400px;
            top: -100px;
            right: -100px;
        }

        .left-panel .orb-2 {
            width: 300px;
            height: 300px;
            bottom: -80px;
            left: -60px;
        }

        .left-panel .orb-3 {
            width: 200px;
            height: 200px;
            top: 50%;
            left: 60%;
            background: rgba(255, 255, 255, 0.03);
        }

        /* Floating dots animation */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-12px)
            }
        }

        @keyframes pulse-ring {
            0% {
                transform: scale(.9);
                opacity: .7
            }

            100% {
                transform: scale(1.1);
                opacity: 0
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(24px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -200%
            }

            100% {
                background-position: 200%
            }
        }

        .float-1 {
            animation: float 4s ease-in-out infinite;
        }

        .float-2 {
            animation: float 4s ease-in-out 1s infinite;
        }

        .float-3 {
            animation: float 4s ease-in-out 2s infinite;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 16px;
            padding: 14px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: fadeInUp .6s ease both;
        }

        /* Right Panel */
        .right-panel {
            width: 45%;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            animation: fadeInUp .5s ease;
        }

        /* Input styles */
        .input-login {
            width: 100%;
            padding: 13px 44px 13px 44px;
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            font-size: 14px;
            outline: none;
            transition: all .25s;
            background: white;
            color: #1e293b;
            box-sizing: border-box;
        }

        .input-login:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        }

        .input-login.error {
            border-color: #ef4444;
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 18px;
            pointer-events: none;
            transition: color .2s;
        }

        .input-wrap:focus-within .input-icon {
            color: #2563eb;
        }

        .toggle-pass {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            cursor: pointer;
            font-size: 18px;
            transition: color .2s;
        }

        .toggle-pass:hover {
            color: #2563eb;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #1e3a8a, #2563eb);
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all .25s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 20px rgba(37, 99, 235, 0.35);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(37, 99, 235, 0.45);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login.loading {
            opacity: .8;
            pointer-events: none;
        }

        @media (max-width: 768px) {
            .left-panel {
                display: none;
            }

            .right-panel {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    {{-- LEFT PANEL --}}
    <div class="left-panel">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>

        <!-- Logo row -->
        <div class="flex items-center gap-4 mb-12 float-1 relative z-10">
            <img src="{{ asset('images/logo-kota-palu.png') }}" alt="Logo Kota Palu"
                style="width:72px;height:72px;object-fit:contain;filter:drop-shadow(0 4px 16px rgba(0,0,0,0.3));">
            <div style="width:1px;height:64px;background:rgba(255,255,255,0.2);"></div>
            <img src="{{ asset('images/logo-dishub.png') }}" alt="Logo Dishub"
                style="width:72px;height:72px;object-fit:contain;filter:drop-shadow(0 4px 16px rgba(0,0,0,0.3));">
        </div>

        <!-- Title -->
        <div class="relative z-10 text-center mb-10">
            <h1 style="color:white;font-size:28px;font-weight:900;line-height:1.2;margin:0 0 10px;">
                Dinas Perhubungan<br>
                <span style="color:#fbbf24;">Kota Palu</span>
            </h1>
            <p style="color:rgba(255,255,255,0.65);font-size:14px;margin:0;">
                Sistem Informasi Manajemen Internal
            </p>
        </div>


        <!-- Bottom tagline -->
        <div class="relative z-10 mt-12 text-center">
            <p style="color:rgba(255,255,255,0.35);font-size:11px;">
                © {{ date('Y') }} Dishub Kota Palu — Sistem Manajemen Internal
            </p>
        </div>
    </div>

    {{-- RIGHT PANEL --}}
    <div class="right-panel">
        <div class="login-card">

            {{-- Mobile Logo --}}
            <div class="flex items-center justify-center gap-3 mb-8 md:hidden">
                <img src="{{ asset('images/logo-kota-palu.png') }}" alt=""
                    style="width:48px;height:48px;object-fit:contain;">
                <img src="{{ asset('images/logo-dishub.png') }}" alt=""
                    style="width:48px;height:48px;object-fit:contain;">
            </div>

            {{-- Heading --}}
            <div class="mb-8">
                <h2 style="font-size:26px;font-weight:900;color:#0f172a;margin:0 0 6px;">
                    Selamat Datang 👋
                </h2>
                <p style="color:#64748b;font-size:14px;margin:0;">
                    Masuk ke panel admin Dishub Kota Palu
                </p>
            </div>

            {{-- Session Status --}}
            @if(session('status'))
                <div
                    style="background:#f0fdf4;border:1px solid #86efac;border-radius:12px;padding:12px 16px;margin-bottom:16px;color:#15803d;font-size:13px;display:flex;align-items:center;gap:8px;">
                    <i class="bx bx-check-circle text-lg"></i> {{ session('status') }}
                </div>
            @endif

            {{-- Error --}}
            @if($errors->any())
                <div
                    style="background:#fef2f2;border:1px solid #fca5a5;border-radius:12px;padding:12px 16px;margin-bottom:16px;color:#dc2626;font-size:13px;display:flex;align-items:start;gap:8px;">
                    <i class="bx bx-error-circle text-lg mt-0.5 flex-shrink-0"></i>
                    <div>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('login') }}" id="login-form">
                @csrf

                {{-- Email --}}
                <div style="margin-bottom:18px;">
                    <label style="display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:8px;">
                        Email
                    </label>
                    <div class="input-wrap">
                        <i class="bx bx-envelope input-icon"></i>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            placeholder="admin@dishub.palu.go.id"
                            class="input-login {{ $errors->has('email') ? 'error' : '' }}" required autofocus
                            autocomplete="username">
                    </div>
                </div>

                {{-- Password --}}
                <div style="margin-bottom:18px;">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                        <label style="font-size:13px;font-weight:600;color:#374151;">
                            Password
                        </label>
                        @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                style="font-size:12px;color:#2563eb;text-decoration:none;font-weight:500;">
                                Lupa password?
                            </a>
                        @endif
                    </div>
                    <div class="input-wrap">
                        <i class="bx bx-lock-alt input-icon"></i>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="input-login {{ $errors->has('password') ? 'error' : '' }}" required
                            autocomplete="current-password">
                        <i class="bx bx-hide toggle-pass" id="togglePass" onclick="togglePassword()"></i>
                    </div>
                </div>

                {{-- Remember Me --}}
                <div style="margin-bottom:24px;display:flex;align-items:center;gap:10px;">
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;color:#4b5563;">
                        <input type="checkbox" name="remember" id="remember_me"
                            style="width:16px;height:16px;accent-color:#2563eb;border-radius:4px;">
                        Ingat saya
                    </label>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn-login" id="login-btn"
                    onclick="this.classList.add('loading');document.getElementById('btn-text').textContent='Masuk...';document.getElementById('btn-icon').className='bx bx-loader-alt bx-spin';">
                    <i class="bx bx-log-in" id="btn-icon" style="font-size:18px;"></i>
                    <span id="btn-text">Masuk ke Dashboard</span>
                </button>
            </form>

            {{-- Footer --}}
            <div style="margin-top:32px;padding-top:24px;border-top:1px solid #f1f5f9;text-align:center;">
                <a href="{{ route('home') }}"
                    style="display:inline-flex;align-items:center;gap:6px;font-size:13px;color:#64748b;text-decoration:none;transition:color .2s;"
                    onmouseenter="this.style.color='#2563eb'" onmouseleave="this.style.color='#64748b'">
                    <i class="bx bx-globe"></i> Kembali ke Website Publik
                </a>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('togglePass');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'bx bx-show toggle-pass';
            } else {
                input.type = 'password';
                icon.className = 'bx bx-hide toggle-pass';
            }
        }

        // Input focus effects
        document.querySelectorAll('.input-login').forEach(input => {
            input.addEventListener('focus', function () {
                this.parentElement.querySelector('.input-icon').style.color = '#2563eb';
            });
            input.addEventListener('blur', function () {
                this.parentElement.querySelector('.input-icon').style.color = '#94a3b8';
            });
        });
    </script>
</body>

</html>