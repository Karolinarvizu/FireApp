@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Reporte de Unidades</h1>

    <div class="mb-3">
        <strong>Fecha:</strong> {{ $unitReport->date }}
    </div>

    @foreach(json_decode($unitReport->units, true) as $unitNumber => $details)
    <div class="mb-3">
        <h4>Unidad {{ str_replace('unit_', '', $unitNumber) }}</h4>
        <div>
            <strong>Servicios:</strong>
            <ul>
                @forelse($details['services'] ?? [] as $service)
                    <li>{{ $service }}</li>
                @empty
                    <li>No hay servicios registrados</li>
                @endforelse
            </ul>
        </div>
        <div>
            <strong>Estado de Gas/Diesel:</strong> {{ $details['gas_diesel_status'] ?? 'No especificado' }}
        </div>
    </div>
    @endforeach

    <div class="mb-3">
        <strong>Notas de Gas/Diesel:</strong> {{ $unitReport->gas_diesel_notes }}
    </div>

    <div class="mb-3">
        <strong>Creado por:</strong> {{ $unitReport->user->name }}
    </div>


    <a href="{{ route('unit_reports.index') }}" class="btn btn-secondary">Regresar</a>
</div>
@endsection
