<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Restablecer Contraseña</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Fondo claro */
            color: #212529; /* Color de texto */
            font-family: Arial, sans-serif;
        }
        .card {
            background-color: #ffffff; /* Fondo blanco para el card */
        }
        .card-header, .card-footer {
            background-color: #f1f3f5; /* Fondo gris claro para el header y footer del card */
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .img-logo {
            max-width: 150px;
            height: auto;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container d-flex flex-column justify-content-center align-items-center flex-grow-1">
        <!-- Imagen antes del card -->
        <div class="text-center mb-4">
            <img src="{{ asset('images/loguito.jpg') }}" alt="Logo" class="img-logo">
        </div>

        <!-- Card para el formulario de restablecimiento de contraseña -->
        <div class="card shadow-lg border-0 rounded-lg w-100">
            <div class="card-header">
                <h3 class="text-center font-weight-light my-4">Restablecer Contraseña</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Correo Electrónico</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirmar Contraseña</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Restablecer Contraseña
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
