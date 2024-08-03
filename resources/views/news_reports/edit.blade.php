@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Reporte</h1>

    <form action="{{ route('news_reports.update', $newsReport->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Fecha -->
        <div class="form-group">
            <label for="date">Fecha:</label>
            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', $newsReport->date) }}" required>
            @error('date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Unidades -->
        <div class="form-group">
            <label for="units">Unidades Involucradas:</label>
            @foreach(['Unidad 13', 'Unidad 27', 'Unidad 02', 'Unidad 34', 'Unidad 03', 'Unidad 38', 'Unidad 14', 'Unidad 39'] as $unit)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="units[]" id="{{ $unit }}" value="{{ $unit }}" {{ in_array($unit, old('units', $newsReport->units)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $unit }}">{{ $unit }}</label>
                </div>
            @endforeach
            @error('units')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Dirección -->
        <div class="form-group">
            <label for="address">Dirección:</label>
            <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $newsReport->address) }}" required>
            @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Personal involucrado -->
        <div class="form-group">
            <label for="personnel">Personal Involucrado:</label>
            @foreach(['Antonio Gámez', 'Pablo Sánchez', 'Román Sánchez', 'Javier Castillo', 'Fernando Armenta', 'Alexis Gámez', 'Josué Betancourt', 'Abraham Ventura', 'Aurelio Valenzuela', 'Ary Mendoza', 'Guadalupe Armenta', 'Iván Millán', 'Emanuel Núñez', 'Martín Venegas'] as $person)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="personnel[]" id="{{ $person }}" value="{{ $person }}" {{ in_array($person, old('personnel', $newsReport->personnel)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $person }}">{{ $person }}</label>
                </div>
            @endforeach
            @error('personnel')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Hora de Inicio -->
<div class="form-group">
    <label for="start_time">Hora de Inicio:</label>
    <input type="time" name="start_time" id="start_time" class="form-control @error('start_time') is-invalid @enderror" 
           value="{{ old('start_time', $newsReport->start_time) }}" required>
    @error('start_time')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<!-- Hora de Finalización -->
<div class="form-group">
    <label for="end_time">Hora de Finalizado:</label>
    <input type="time" name="end_time" id="end_time" class="form-control @error('end_time') is-invalid @enderror" 
           value="{{ old('end_time', $newsReport->end_time) }}" required>
    @error('end_time')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>


        <!-- Actividades Realizadas -->
        <div class="form-group">
            <label for="activities">Actividades Realizadas:</label>
            <textarea name="activities" id="activities" class="form-control @error('activities') is-invalid @enderror" rows="4">{{ old('activities', $newsReport->activities) }}</textarea>
            @error('activities')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Otros -->
        <div class="form-group">
            <label for="others">Otros:</label>
            <textarea name="others" id="others" class="form-control @error('others') is-invalid @enderror" rows="3">{{ old('others', $newsReport->others) }}</textarea>
            @error('others')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Botones -->
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('news_reports.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
