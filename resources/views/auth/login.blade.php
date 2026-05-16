<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión — FireApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            min-width: 320px;
            background: #111;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', system-ui, sans-serif;
            position: relative;
            overflow-x: hidden;
            padding: 24px 0;
        }
        body::before {
            content: '';
            position: fixed;
            top: -50%; left: -50%;
            width: 200%; height: 200%;
            background: radial-gradient(ellipse at 20% 50%, rgba(204,34,0,0.08) 0%, transparent 50%),
                        radial-gradient(ellipse at 80% 20%, rgba(255,140,0,0.05) 0%, transparent 40%);
            pointer-events: none;
        }
        .login-wrap {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            position: relative;
            z-index: 1;
        }
        .login-logo {
            text-align: center;
            margin-bottom: 28px;
        }
        .login-logo img {
            width: 90px;
            height: 90px;
            object-fit: contain;
            border-radius: 16px;
        }
        .login-logo .app-name {
            display: block;
            font-size: 22px;
            font-weight: 600;
            color: #eee;
            margin-top: 10px;
            letter-spacing: 1px;
        }
        .login-logo .app-sub {
            font-size: 12px;
            color: #666;
            margin-top: 2px;
        }
        .login-card {
            background: #1a1a1a;
            border: 1px solid #2a2a2a;
            border-radius: 14px;
            padding: 28px;
        }
        .login-card h2 {
            font-size: 16px;
            font-weight: 500;
            color: #ccc;
            margin-bottom: 22px;
            text-align: center;
        }
        .form-label { font-size: 12px; color: #888; margin-bottom: 5px; }
        .form-control {
            background: #111;
            border: 1px solid #2a2a2a;
            border-radius: 8px;
            color: #eee;
            font-size: 14px;
            padding: 10px 14px;
            min-height: 43px;
            transition: border-color 0.2s;
        }
        .form-control:focus {
            background: #111;
            border-color: #cc2200;
            box-shadow: 0 0 0 3px rgba(204,34,0,0.15);
            color: #eee;
        }
        .form-control::placeholder { color: #444; }
        .form-control.is-invalid { border-color: #991111; }
        .invalid-feedback { font-size: 11px; color: #ff6b6b; }
        .btn-login {
            width: 100%;
            background: #cc2200;
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 14px;
            font-weight: 500;
            padding: 11px;
            margin-top: 6px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-login:hover { background: #aa1a00; }
        .form-check-input { background-color: #222; border-color: #444; }
        .form-check-input:checked { background-color: #cc2200; border-color: #cc2200; }
        .form-check-label { font-size: 12px; color: #777; }
        .login-footer { text-align: center; margin-top: 18px; font-size: 12px; color: #555; }
        .login-footer a { color: #ff6b47; text-decoration: none; }
        .login-footer a:hover { color: #ffaa33; }
        .forgot-link { font-size: 11px; color: #666; text-decoration: none; }
        .forgot-link:hover { color: #ff6b47; }
        @media (max-width: 480px) {
            body {
                align-items: flex-start;
                padding: 14px 0;
            }
            .login-wrap { padding: 12px; }
            .login-logo { margin-bottom: 18px; }
            .login-logo img { width: 72px; height: 72px; border-radius: 12px; }
            .login-logo .app-name { font-size: 20px; }
            .login-card { padding: 20px; border-radius: 10px; }
            .d-flex.align-items-center.justify-content-between {
                align-items: flex-start !important;
                gap: 8px;
            }
            .forgot-link { text-align: right; }
        }

        @media (max-height: 620px) {
            body {
                align-items: flex-start;
            }
            .login-logo { margin-bottom: 14px; }
        }
    </style>
</head>
<body>
    <div class="login-wrap">
        <div class="login-logo">
            <img src="{{ asset('images/logo.png') }}" alt="FireApp Logo">
            <span class="app-name">FireApp</span>
            <div class="app-sub">Bomberos Voluntarios de Sonoyta</div>
        </div>

        <div class="login-card">
            <h2>Iniciar sesión</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="email">Correo electrónico</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                        placeholder="correo@ejemplo.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password">Contraseña</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password" placeholder="••••••••">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="form-check mb-0">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Recordarme</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                    @endif
                </div>

                <button type="submit" class="btn-login">Entrar</button>
            </form>
        </div>

        <div class="login-footer">
            ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
