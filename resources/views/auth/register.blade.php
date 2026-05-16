<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse — FireApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0; min-height: 100vh; min-width: 320px;
            background: #111;
            display: flex; align-items: center; justify-content: center;
            font-family: 'Segoe UI', system-ui, sans-serif;
            padding: 20px 0;
            overflow-x: hidden;
        }
        body::before {
            content: ''; position: fixed; top: -50%; left: -50%; width: 200%; height: 200%;
            background: radial-gradient(ellipse at 20% 50%, rgba(204,34,0,0.08) 0%, transparent 50%);
            pointer-events: none;
        }
        .register-wrap { width: 100%; max-width: 420px; padding: 20px; position: relative; z-index: 1; }
        .login-logo { text-align: center; margin-bottom: 24px; }
        .login-logo img { width: 70px; height: 70px; object-fit: contain; border-radius: 12px; }
        .login-logo .app-name { display: block; font-size: 20px; font-weight: 600; color: #eee; margin-top: 8px; }
        .login-logo .app-sub { font-size: 11px; color: #666; }
        .login-card { background: #1a1a1a; border: 1px solid #2a2a2a; border-radius: 14px; padding: 28px; }
        .login-card h2 { font-size: 16px; font-weight: 500; color: #ccc; margin-bottom: 22px; text-align: center; }
        .form-label { font-size: 12px; color: #888; margin-bottom: 5px; }
        .form-control { background: #111; border: 1px solid #2a2a2a; border-radius: 8px; color: #eee; font-size: 14px; padding: 10px 14px; min-height: 43px; transition: border-color 0.2s; }
        .form-control:focus { background: #111; border-color: #cc2200; box-shadow: 0 0 0 3px rgba(204,34,0,0.15); color: #eee; }
        .form-control::placeholder { color: #444; }
        .form-control.is-invalid { border-color: #991111; }
        .invalid-feedback { font-size: 11px; color: #ff6b6b; }
        .btn-login { width: 100%; background: #cc2200; border: none; border-radius: 8px; color: #fff; font-size: 14px; font-weight: 500; padding: 11px; margin-top: 6px; cursor: pointer; transition: background 0.2s; }
        .btn-login:hover { background: #aa1a00; }
        .login-footer { text-align: center; margin-top: 16px; font-size: 12px; color: #555; }
        .login-footer a { color: #ff6b47; text-decoration: none; }
        .login-footer a:hover { color: #ffaa33; }
        @media (max-width: 480px) {
            body { align-items: flex-start; padding: 14px 0; }
            .register-wrap { padding: 12px; }
            .login-logo { margin-bottom: 18px; }
            .login-logo img { width: 64px; height: 64px; }
            .login-card { padding: 20px; border-radius: 10px; }
        }
        @media (max-height: 680px) {
            body { align-items: flex-start; }
            .login-logo { margin-bottom: 14px; }
        }
    </style>
</head>
<body>
    <div class="register-wrap">
        <div class="login-logo">
            <img src="{{ asset('images/logo.png') }}" alt="FireApp Logo">
            <span class="app-name">FireApp</span>
            <div class="app-sub">Bomberos Voluntarios de Sonoyta</div>
        </div>

        <div class="login-card">
            <h2>Crear cuenta</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="name">Nombre completo</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email">Correo electrónico</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Contraseña</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password-confirm">Confirmar contraseña</label>
                    <input id="password-confirm" type="password" class="form-control"
                        name="password_confirmation" required autocomplete="new-password">
                </div>
                <button type="submit" class="btn-login">Registrarse</button>
            </form>
        </div>

        <div class="login-footer">
            ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
