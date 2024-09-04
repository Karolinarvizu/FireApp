<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parte de Novedades</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .content {
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-height: 80px;
        }
        .header h1 {
            margin: 10px 0 0;
            font-size: 24px;
            text-transform: uppercase;
        }
        .info-table {
            width: 100%;
            margin: 0 auto;
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
        .created-by {
            font-weight: bold;
            text-align: left;
            margin: 20px auto;
            width: 90%;
        }
        .signature-section {
            text-align: center;
            margin-top: 50px;
            position: absolute;
            bottom: 30px;
            width: 100%;
        }
        .signature-section .commander-signature p {
            margin: 0;
            font-size: 16px;
        }
        tr, td, th {
            page-break-inside: avoid;
        }
        @page {
            margin: 20px;
        }
    </style>
</head>
<body>

    <div class="content">
        <div class="header">
            <img src="{{ public_path('storage/images/loguito.jpg') }}" alt="Logo">
            <h1>Parte de Novedades</h1>
        </div>

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

        <p class="created-by">Reporte creado por: {{ $newsReport->user->name }}</p>
    </div>

    <div class="signature-section">
        <p>____________________________________</p>
        <div class="commander-signature">
            <p>{{ $commanderName }}</p>
            <p>Comandante</p>
        </div>
    </div>

</body>
</html>
