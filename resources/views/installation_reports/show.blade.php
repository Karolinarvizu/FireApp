@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Reporte de Instalaciones</h1>

    <div class="mb-3">
        <strong>Fecha:</strong> {{ $installationReport->date }}
    </div>

    <div class="mb-3">
        <strong>Salas Limpiadas:</strong> 
        @foreach(json_decode($installationReport->cleaned_rooms, true) as $room)
            {{ $room }},
        @endforeach
    </div>

    <div class="mb-3">
        <strong>Observaciones:</strong> {{ $installationReport->notes }}
    </div>

    <div class="mb-3">
        <strong>Creado por:</strong> {{ $installationReport->user->name }}
    </div>

    <a href="{{ route('installation_reports.index') }}" class="btn btn-secondary">Regresar</a>
</div>
@endsection
