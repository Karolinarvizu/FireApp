<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Parte de Novedades</title>
    <style>
        @page {
            size: letter;
            margin: 0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: DejaVu Sans, Arial, sans-serif;
            color: #202020;
            font-size: 12px;
            line-height: 1.35;
        }

        .template-background {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .content {
            padding: 165px 72px 118px;
        }

        .header {
            text-align: center;
            margin-bottom: 16px;
        }

        .header h1 {
            display: inline-block;
            margin: 0;
            padding: 7px 22px 8px;
            border: 1.5px solid #d71920;
            border-radius: 3px;
            background: rgba(255, 255, 255, 0.86);
            color: #111;
            font-size: 18px;
            letter-spacing: 0;
            text-transform: uppercase;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto 14px;
            background: transparent;
            border: 1px solid rgba(130, 130, 130, 0.58);
        }

        .info-table th,
        .info-table td {
            border: 1px solid rgba(130, 130, 130, 0.58);
            padding: 8px 10px;
            text-align: left;
            vertical-align: top;
        }

        .info-table th {
            width: 34%;
            background: rgba(255, 255, 255, 0.58);
            color: #1c1c1c;
            font-size: 10.5px;
            text-transform: uppercase;
            letter-spacing: 0;
        }

        .info-table td {
            background: rgba(255, 255, 255, 0.38);
            color: #262626;
        }

        .long-text {
            min-height: 48px;
            white-space: pre-line;
        }

        .created-by {
            margin: 14px 0 0;
            padding: 9px 12px;
            border-left: 4px solid #d71920;
            background: rgba(255, 255, 255, 0.42);
            font-weight: 700;
        }

        .signature-section {
            position: fixed;
            left: 72px;
            right: 72px;
            bottom: 86px;
            text-align: center;
        }

        .signature-line {
            width: 260px;
            margin: 0 auto 5px;
            border-top: 1px solid #202020;
        }

        .signature-section .commander-signature p {
            margin: 0;
            font-size: 12px;
            font-weight: 700;
        }

        .signature-section .commander-signature p:last-child {
            margin-top: 1px;
            font-size: 10px;
            font-weight: 400;
            text-transform: uppercase;
            letter-spacing: 0;
        }

        tr,
        td,
        th {
            page-break-inside: avoid;
        }
    </style>
</head>
<body>
    @php
        $units = json_decode($newsReport->units, true) ?: [];
        $personnel = json_decode($newsReport->personnel, true) ?: [];
    @endphp

    <img class="template-background" src="{{ public_path('report_templates/news_report_template.jpg') }}" alt="">

    <div class="content">
        <div class="header">
            <h1>Parte de Novedades</h1>
        </div>

        <table class="info-table">
            <tr>
                <th>Fecha</th>
                <td>{{ \Carbon\Carbon::parse($newsReport->date)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>Unidades Involucradas</th>
                <td>{{ implode(', ', $units) }}</td>
            </tr>
            <tr>
                <th>Direcci&oacute;n</th>
                <td>{{ $newsReport->address }}</td>
            </tr>
            <tr>
                <th>Personal Involucrado</th>
                <td>{{ implode(', ', $personnel) }}</td>
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
                <td class="long-text">{{ $newsReport->activities }}</td>
            </tr>
            <tr>
                <th>Otros</th>
                <td class="long-text">{{ $newsReport->others }}</td>
            </tr>
        </table>

        <p class="created-by">Reporte creado por: {{ $newsReport->user->name }}</p>
    </div>

    <div class="signature-section">
        <div class="signature-line"></div>
        <div class="commander-signature">
            <p>{{ $commanderName }}</p>
            <p>Comandante</p>
        </div>
    </div>
</body>
</html>
