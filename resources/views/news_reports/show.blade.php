@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Parte de Novedades</h1>

    <div class="mb-3">
        <strong>Fecha:</strong> {{ $newsReport->date }}
    </div>

    <div class="mb-3">
        <strong>Unidades:</strong>
        @foreach(json_decode($newsReport->units, true) as $unit)
            {{ $unit }},
        @endforeach
    </div>

    <div class="mb-3">
        <strong>Dirección:</strong> {{ $newsReport->address }}
    </div>

    <div class="mb-3">
        <strong>Personal:</strong>
        @foreach(json_decode($newsReport->personnel, true) as $person)
            {{ $person }},
        @endforeach
    </div>

    <div class="mb-3">
        <strong>Hora de Inicio:</strong> {{ $newsReport->start_time }}
    </div>

    <div class="mb-3">
        <strong>Hora de Finalizado:</strong> {{ $newsReport->end_time }}
    </div>

    <div class="mb-3">
        <strong>Actividades Realizadas:</strong> {{ $newsReport->activities }}
    </div>

    <div class="mb-3">
        <strong>Otros:</strong> {{ $newsReport->others }}
    </div>

    <div class="mb-3">
        <strong>Creado por:</strong> {{ $newsReport->user->name }}
    </div>

    <a href="{{ route('news_reports.index') }}" class="btn btn-secondary">Regresar</a>
</div>
@endsection
