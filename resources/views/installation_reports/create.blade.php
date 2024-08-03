@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Reporte de Instalaciones</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('installation_reports.store') }}">
        @csrf

        <div class="form-group">
            <label for="date">Fecha</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" required>
        </div>

        <div class="form-group">
            <label>Salas Limpiadas</label>
            @foreach(['Baño', 'Radio', 'Recamara', 'Cocina', 'Piso int./ext.'] as $room)
            <div>
                <input type="checkbox" id="{{ strtolower(str_replace(' ', '_', $room)) }}" name="cleaned_rooms[]" value="{{ $room }}">
                <label for="{{ strtolower(str_replace(' ', '_', $room)) }}">{{ $room }}</label>
            </div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="notes">Observaciones</label>
            <textarea class="form-control" id="notes" name="notes">{{ old('notes') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Crear Reporte</button>
        <a href="{{ route('installation_reports.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
