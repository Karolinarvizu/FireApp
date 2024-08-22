<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Registrarse</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
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
        .container-fluid {
            max-width: 600px;
            margin-top: 30px;
        }
        @media (max-width: 576px) {
            .container-fluid {
                margin-top: 15px; /* Reducir margen en pantallas pequeñas */
            }
            .img-logo {
                max-width: 100px; /* Ajustar el tamaño del logo en pantallas pequeñas */
            }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container-fluid d-flex flex-column justify-content-center align-items-center flex-grow-1">
        <!-- Imagen antes del card -->
        <div class="text-center mb-4">
            <img src="images/loguito.jpg" alt="Logo" class="img-logo">
        </div>

        <!-- Card para el formulario de registro -->
        <div class="card shadow-lg border-0 rounded-lg w-100">
            <div class="card-header">
                <h3 class="text-center font-weight-light my-4">Crear Cuenta</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Nombre</label>

                        <div class="col-12 col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                        <div class="col-12 col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña</label>

                        <div class="col-12 col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirmar contraseña</label>

                        <div class="col-12 col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-12 col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary w-100">
                                Registrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center py-3">
                <div class="small">
                    <a href="{{ route('login') }}">¿Ya tienes cuenta? Inicia sesión</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
