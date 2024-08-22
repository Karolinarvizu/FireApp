<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verificar Correo Electrónico</title>
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

        <!-- Card para la verificación de correo -->
        <div class="card shadow-lg border-0 rounded-lg w-100">
            <div class="card-header">
                <h3 class="text-center font-weight-light my-4">Verifica tu Correo Electrónico</h3>
            </div>
            <div class="card-body">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        Un nuevo enlace de verificación ha sido enviado a tu dirección de correo electrónico.
                    </div>
                @endif

                <p class="text-center">Antes de continuar, por favor revisa tu correo electrónico para encontrar el enlace de verificación.</p>
                <p class="text-center">Si no recibiste el correo,</p>
                
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <div class="text-center">
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">haz clic aquí para solicitar otro</button>.
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
