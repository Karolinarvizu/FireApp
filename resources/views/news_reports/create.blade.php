@extends('layouts.dashboard')

@section('title', 'Crear-Novedades')

@section('content')
<div class="container">
    <h1>Crear Reporte</h1>

    <form action="{{ route('news_reports.store') }}" method="POST">
        @csrf

        <!-- Fecha -->
        <div class="form-group">
            <label for="date">Fecha:</label>
            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}" required>
            @error('date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Unidades -->
        <div class="form-group">
            <label for="units">Unidades Involucradas:</label>
            <select name="units[]" id="units" class="form-control select2 @error('units') is-invalid @enderror" multiple required>
                <option value="Unidad 13" {{ in_array('Unidad 13', old('units', [])) ? 'selected' : '' }}>Unidad 13</option>
                <option value="Unidad 27" {{ in_array('Unidad 27', old('units', [])) ? 'selected' : '' }}>Unidad 27</option>
                <option value="Unidad 02" {{ in_array('Unidad 02', old('units', [])) ? 'selected' : '' }}>Unidad 02</option>
                <option value="Unidad 34" {{ in_array('Unidad 34', old('units', [])) ? 'selected' : '' }}>Unidad 34</option>
                <option value="Unidad 03" {{ in_array('Unidad 03', old('units', [])) ? 'selected' : '' }}>Unidad 03</option>
                <option value="Unidad 38" {{ in_array('Unidad 38', old('units', [])) ? 'selected' : '' }}>Unidad 38</option>
                <option value="Unidad 14" {{ in_array('Unidad 14', old('units', [])) ? 'selected' : '' }}>Unidad 14</option>
                <option value="Unidad 39" {{ in_array('Unidad 39', old('units', [])) ? 'selected' : '' }}>Unidad 39</option>
                <!-- Puedes añadir más unidades si es necesario -->
            </select>
            @error('units')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Dirección -->
        <div class="form-group">
            <label for="address">Dirección:</label>
            <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" required>
            @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Personal involucrado -->
        <div class="form-group">
            <label for="personnel">Personal Involucrado:</label>
            <select name="personnel[]" id="personnel" class="form-control select2 @error('personnel') is-invalid @enderror" multiple required>
                <option value="Antonio Gámez" {{ in_array('Antonio Gámez', old('personnel', [])) ? 'selected' : '' }}>Antonio Gámez</option>
                <option value="Pablo Sánchez" {{ in_array('Pablo Sánchez', old('personnel', [])) ? 'selected' : '' }}>Pablo Sánchez</option>
                <option value="Román Sánchez" {{ in_array('Román Sánchez', old('personnel', [])) ? 'selected' : '' }}>Román Sánchez</option>
                <option value="Javier Castillo" {{ in_array('Javier Castillo', old('personnel', [])) ? 'selected' : '' }}>Javier Castillo</option>
                <option value="Fernando Armenta" {{ in_array('Fernando Armenta', old('personnel', [])) ? 'selected' : '' }}>Fernando Armenta</option>
                <option value="Alexis Gámez" {{ in_array('Alexis Gámez', old('personnel', [])) ? 'selected' : '' }}>Alexis Gámez</option>
                <option value="Josué Betancourt" {{ in_array('Josué Betancourt', old('personnel', [])) ? 'selected' : '' }}>Josué Betancourt</option>
                <option value="Abraham Ventura" {{ in_array('Abraham Ventura', old('personnel', [])) ? 'selected' : '' }}>Abraham Ventura</option>
                <option value="Aurelio Valenzuela" {{ in_array('Aurelio Valenzuela', old('personnel', [])) ? 'selected' : '' }}>Aurelio Valenzuela</option>
                <option value="Ary Mendoza" {{ in_array('Ary Mendoza', old('personnel', [])) ? 'selected' : '' }}>Ary Mendoza</option>
                <option value="Guadalupe Armenta" {{ in_array('Guadalupe Armenta', old('personnel', [])) ? 'selected' : '' }}>Guadalupe Armenta</option>
                <option value="Iván Millán" {{ in_array('Iván Millán', old('personnel', [])) ? 'selected' : '' }}>Iván Millán</option>
                <option value="Emanuel Núñez" {{ in_array('Emanuel Núñez', old('personnel', [])) ? 'selected' : '' }}>Emanuel Núñez</option>
                <option value="Martín Venegas" {{ in_array('Martín Venegas', old('personnel', [])) ? 'selected' : '' }}>Martín Venegas</option>
                <!-- Puedes añadir más personal si es necesario -->
            </select>
            @error('personnel')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Hora de Inicio -->
        <div class="form-group">
            <label for="start_time">Hora de Inicio:</label>
            <input type="time" name="start_time" id="start_time" class="form-control @error('start_time') is-invalid @enderror" value="{{ old('start_time') }}" required>
            @error('start_time')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Hora de Finalización -->
        <div class="form-group">
            <label for="end_time">Hora de Finalizado:</label>
            <input type="time" name="end_time" id="end_time" class="form-control @error('end_time') is-invalid @enderror" value="{{ old('end_time') }}" required>
            @error('end_time')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Actividades Realizadas -->
        <div class="form-group">
            <label for="activities">Actividades Realizadas:</label>
            <textarea name="activities" id="activities" class="form-control @error('activities') is-invalid @enderror" rows="4">{{ old('activities') }}</textarea>
            @error('activities')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <!-- Otros -->
        <div class="form-group">
            <label for="others">Otros:</label>
            <textarea name="others" id="others" class="form-control @error('others') is-invalid @enderror" rows="3">{{ old('others') }}</textarea>
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

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#personnel').select2({
            width: '100%'
        });
        $('#units').select2({
            width: '100%'
        });
    });
</script>
@endsection