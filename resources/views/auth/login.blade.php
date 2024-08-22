<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa; /* Fondo blanco */
            color: #212529; /* Color de texto */
            font-family: Arial, sans-serif;
        }
        .card {
            background-color: #ffffff; /* Fondo blanco para el card */
        }
        .card-header, .card-footer {
            background-color: #f1f3f5; /* Fondo gris claro para el header y footer del card */
        }
        .text-muted {
            color: #6c757d !important; /* Color gris para el texto en el footer */
        }
        .img-logo {
            max-width: 150px;
            height: auto;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container d-flex flex-column justify-content-center align-items-center flex-grow-1">
        <div class="text-center mb-4">
            <img src="{{ asset('images/loguito.jpg') }}" alt="Logo" class="img-fluid" style="max-width: 150px; height: auto;">
        </div>

        <div class="card shadow-lg border-0 rounded-lg w-100" style="max-width: 500px;">
            <div class="card-header">
                <h3 class="text-center font-weight-light my-4">Iniciar Sesión</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-floating mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="name@example.com" />
                        <label for="email">Email</label>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password" />
                        <label for="password">Contraseña</label>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                        <label class="form-check-label" for="remember">
                            {{ __('Recordarme') }}
                        </label>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        @if (Route::has('password.request'))
                            <a class="small" href="{{ route('password.request') }}">{{ __('Olvidaste tu contraseña?') }}</a>
                        @endif
                        <button type="submit" class="btn btn-primary">{{ __('Iniciar Sesión') }}</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center py-3">
                <div class="small">
                    <a href="{{ route('register') }}">¿No tienes cuenta? Regístrate</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
