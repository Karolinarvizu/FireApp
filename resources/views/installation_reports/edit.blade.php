@extends('layouts.dashboard')

@section('title', 'Editar-Instalaciones')

@section('content')
<div class="container">
    <h1>Editar Reporte de Instalaciones</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('installation_reports.update', $installationReport->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="date">Fecha</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $installationReport->date) }}" required>
        </div>

        <div class="form-group">
            <label>Salas Limpiadas</label>
            @php
                // Decodifica el JSON de cleaned_rooms si es necesario
                $cleanedRoomsArray = is_array($installationReport->cleaned_rooms)
                    ? $installationReport->cleaned_rooms
                    : json_decode($installationReport->cleaned_rooms, true) ?? [];
            @endphp
            @foreach(['Baño', 'Radio', 'Recamara', 'Cocina', 'Piso int./ext.'] as $room)
            <div class="form-check">
                <input type="checkbox" 
                    id="{{ strtolower(str_replace(' ', '_', $room)) }}" 
                    name="cleaned_rooms[]" 
                    value="{{ $room }}" 
                    {{ in_array($room, old('cleaned_rooms', $cleanedRoomsArray)) ? 'checked' : '' }}>
                <label for="{{ strtolower(str_replace(' ', '_', $room)) }}">
                    {{ $room }}
                </label>
            </div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="notes">Observaciones</label>
            <textarea class="form-control" id="notes" name="notes">{{ old('notes', $installationReport->notes) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Reporte de Instalaciones</button>
        <a href="{{ route('installation_reports.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
