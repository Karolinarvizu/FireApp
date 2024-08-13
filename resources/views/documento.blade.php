<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parte de Novedades</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 100%;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header img {
            max-height: 100px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info-table th, .info-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .info-table th {
            background-color: #f4f4f4;
        }
        .signature-section {
            margin-top: 50px;
            text-align: center;
        }
        .signature-section .commander-signature {
            margin-top: 20px;
        }
        .signature-section .commander-signature p {
            margin: 0;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Header con el logo y título -->
        <div class="header">
        <img src="{{ asset('storage/' . 'images/logo.png') }}" >
            <h1>Parte de Novedades</h1>
        </div>

        <!-- Información del reporte -->
        <table class="info-table">
            <tr>
                <th>Fecha</th>
                <td>{{ \Carbon\Carbon::parse($newsReport->date)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>Unidades Involucradas</th>
                <td>{{ implode(', ', json_decode($newsReport->units)) }}</td>
            </tr>
            <tr>
                <th>Dirección</th>
                <td>{{ $newsReport->address }}</td>
            </tr>
            <tr>
                <th>Personal Involucrado</th>
                <td>{{ implode(', ', json_decode($newsReport->personnel)) }}</td>
            </tr>
            <tr>
                <th>Hora de Inicio</th>
                <td>{{ $newsReport->start_time }}</td>
            </tr>
            <tr>
                <th>Hora de Finalizado</th>
                <td>{{ $newsReport->end_time }}</td>
            </tr>
            <tr>
                <th>Actividades Realizadas</th>
                <td>{{ $newsReport->activities }}</td>
            </tr>
            <tr>
                <th>Otros</th>
                <td>{{ $newsReport->others }}</td>
            </tr>
        </table>

        <!-- Sección para la firma del comandante -->
        <div class="signature-section">
            <p>____________________________________</p>
            <div class="commander-signature">
                <p>{{ $commanderName }}</p>
                <p>Comandante</p>
            </div>
        </div>
    </div>

</body>
</html>
