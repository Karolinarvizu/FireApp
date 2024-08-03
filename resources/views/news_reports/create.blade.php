@extends('layouts.app')

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
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="units[]" id="unit13" value="Unidad 13" {{ in_array('Unidad 13', old('units', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="unit13">Unidad 13</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="units[]" id="unit27" value="Unidad 27" {{ in_array('Unidad 27', old('units', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="unit27">Unidad 27</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="units[]" id="unit02" value="Unidad 02" {{ in_array('Unidad 02', old('units', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="unit02">Unidad 02</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="units[]" id="unit34" value="Unidad 34" {{ in_array('Unidad 34', old('units', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="unit34">Unidad 34</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="units[]" id="unit03" value="Unidad 03" {{ in_array('Unidad 03', old('units', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="unit03">Unidad 03</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="units[]" id="unit38" value="Unidad 38" {{ in_array('Unidad 38', old('units', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="unit38">Unidad 38</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="units[]" id="unit14" value="Unidad 14" {{ in_array('Unidad 14', old('units', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="unit14">Unidad 14</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="units[]" id="unit39" value="Unidad 39" {{ in_array('Unidad 39', old('units', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="unit39">Unidad 39</label>
            </div>
            <!-- Puedes añadir más unidades si es necesario -->
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
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="personnel[]" id="antonio_gamez" value="Antonio Gámez" {{ in_array('Antonio Gámez', old('personnel', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="antonio_gamez">Antonio Gámez</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="personnel[]" id="pablo_sanchez" value="Pablo Sánchez" {{ in_array('Pablo Sánchez', old('personnel', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="pablo_sanchez">Pablo Sánchez</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="personnel[]" id="roman_sanchez" value="Román Sánchez" {{ in_array('Román Sánchez', old('personnel', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="roman_sanchez">Román Sánchez</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="personnel[]" id="javier_castillo" value="Javier Castillo" {{ in_array('Javier Castillo', old('personnel', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="javier_castillo">Javier Castillo</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="personnel[]" id="fernando_armenta" value="Fernando Armenta" {{ in_array('Fernando Armenta', old('personnel', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="fernando_armenta">Fernando Armenta</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="personnel[]" id="alexis_gamez" value="Alexis Gámez" {{ in_array('Alexis Gámez', old('personnel', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="alexis_gamez">Alexis Gámez</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="personnel[]" id="josue_betancourt" value="Josué Betancourt" {{ in_array('Josué Betancourt', old('personnel', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="josue_betancourt">Josué Betancourt</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="personnel[]" id="abraham_ventura" value="Abraham Ventura" {{ in_array('Abraham Ventura', old('personnel', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="abraham_ventura">Abraham Ventura</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="personnel[]" id="aurelio_valenzuela" value="Aurelio Valenzuela" {{ in_array('Aurelio Valenzuela', old('personnel', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="aurelio_valenzuela">Aurelio Valenzuela</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="personnel[]" id="ary_mendoza" value="Ary Mendoza" {{ in_array('Ary Mendoza', old('personnel', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="ary_mendoza">Ary Mendoza</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="personnel[]" id="guadalupe_armenta" value="Guadalupe Armenta" {{ in_array('Guadalupe Armenta', old('personnel', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="guadalupe_armenta">Guadalupe Armenta</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="personnel[]" id="ivan_millan" value="Iván Millán" {{ in_array('Iván Millán', old('personnel', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="ivan_millan">Iván Millán</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="personnel[]" id="emanuel_nunez" value="Emanuel Núñez" {{ in_array('Emanuel Núñez', old('personnel', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="emanuel_nunez">Emanuel Núñez</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="personnel[]" id="martin_venegas" value="Martín Venegas" {{ in_array('Martín Venegas', old('personnel', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="martin_venegas">Martín Venegas</label>
            </div>
            <!-- Puedes añadir más personal si es necesario -->
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
