@extends('layouts.dashboard')

@section('title', 'Editar-Unidades')

@section('content')
<div class="container">
    <h1>Editar Reporte de Unidades</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('unit_reports.update', $unitReport->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="date">Fecha</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $unitReport->date) }}" required>
        </div>

        <div class="form-group">
            <label>Reporte de Unidades</label>
            @foreach([13, 27, 02, 34, 03, 38, 14, 39] as $unitNumber)
            <div class="mb-3">
                <label for="unit_{{ $unitNumber }}">Unidad {{ $unitNumber }}</label>
                <div>
                    <label>Servicios</label>
                    <div>
                        <input type="checkbox" id="oil_{{ $unitNumber }}" name="units[unit_{{ $unitNumber }}][services][]" value="Aceite"
                            {{ (isset(json_decode($unitReport->units, true)['unit_' . $unitNumber]['services']) && in_array('Aceite', json_decode($unitReport->units, true)['unit_' . $unitNumber]['services'])) ? 'checked' : '' }}>
                        <label for="oil_{{ $unitNumber }}">Aceite</label>
                    </div>
                    <div>
                        <input type="checkbox" id="water_{{ $unitNumber }}" name="units[unit_{{ $unitNumber }}][services][]" value="Agua/radiador"
                            {{ (isset(json_decode($unitReport->units, true)['unit_' . $unitNumber]['services']) && in_array('Agua/radiador', json_decode($unitReport->units, true)['unit_' . $unitNumber]['services'])) ? 'checked' : '' }}>
                        <label for="water_{{ $unitNumber }}">Agua/radiador</label>
                    </div>
                    <div>
                        <input type="checkbox" id="batteries_{{ $unitNumber }}" name="units[unit_{{ $unitNumber }}][services][]" value="Baterías"
                            {{ (isset(json_decode($unitReport->units, true)['unit_' . $unitNumber]['services']) && in_array('Baterías', json_decode($unitReport->units, true)['unit_' . $unitNumber]['services'])) ? 'checked' : '' }}>
                        <label for="batteries_{{ $unitNumber }}">Baterías</label>
                    </div>
                    <div>
                        <input type="checkbox" id="light_{{ $unitNumber }}" name="units[unit_{{ $unitNumber }}][services][]" value="Planta de luz"
                            {{ (isset(json_decode($unitReport->units, true)['unit_' . $unitNumber]['services']) && in_array('Planta de luz', json_decode($unitReport->units, true)['unit_' . $unitNumber]['services'])) ? 'checked' : '' }}>
                        <label for="light_{{ $unitNumber }}">Planta de luz</label>
                    </div>
                    <div>
                        <input type="checkbox" id="siren_{{ $unitNumber }}" name="units[unit_{{ $unitNumber }}][services][]" value="Torreta"
                            {{ (isset(json_decode($unitReport->units, true)['unit_' . $unitNumber]['services']) && in_array('Torreta', json_decode($unitReport->units, true)['unit_' . $unitNumber]['services'])) ? 'checked' : '' }}>
                        <label for="siren_{{ $unitNumber }}">Torreta</label>
                    </div>
                    <div>
                        <input type="checkbox" id="lights_{{ $unitNumber }}" name="units[unit_{{ $unitNumber }}][services][]" value="Luces"
                            {{ (isset(json_decode($unitReport->units, true)['unit_' . $unitNumber]['services']) && in_array('Luces', json_decode($unitReport->units, true)['unit_' . $unitNumber]['services'])) ? 'checked' : '' }}>
                        <label for="lights_{{ $unitNumber }}">Luces</label>
                    </div>
                    <div>
                        <input type="checkbox" id="cleaning_{{ $unitNumber }}" name="units[unit_{{ $unitNumber }}][services][]" value="Limpieza/unidad"
                            {{ (isset(json_decode($unitReport->units, true)['unit_' . $unitNumber]['services']) && in_array('Limpieza/unidad', json_decode($unitReport->units, true)['unit_' . $unitNumber]['services'])) ? 'checked' : '' }}>
                        <label for="cleaning_{{ $unitNumber }}">Limpieza/unidad</label>
                    </div>
                    <div>
                        <input type="checkbox" id="tires_{{ $unitNumber }}" name="units[unit_{{ $unitNumber }}][services][]" value="Llantas"
                            {{ (isset(json_decode($unitReport->units, true)['unit_' . $unitNumber]['services']) && in_array('Llantas', json_decode($unitReport->units, true)['unit_' . $unitNumber]['services'])) ? 'checked' : '' }}>
                        <label for="tires_{{ $unitNumber }}">Llantas</label>
                    </div>
                    <div>
                        <input type="checkbox" id="water_level_{{ $unitNumber }}" name="units[unit_{{ $unitNumber }}][services][]" value="Nivel de agua"
                            {{ (isset(json_decode($unitReport->units, true)['unit_' . $unitNumber]['services']) && in_array('Nivel de agua', json_decode($unitReport->units, true)['unit_' . $unitNumber]['services'])) ? 'checked' : '' }}>
                        <label for="water_level_{{ $unitNumber }}">Nivel de agua</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="gas_diesel_status_{{ $unitNumber }}">Estado de Gas/Diesel</label>
                    <select class="form-control" id="gas_diesel_status_{{ $unitNumber }}" name="units[unit_{{ $unitNumber }}][gas_diesel_status]" required>
                        <option value="">Seleccione un estado</option> <!-- Opción inválida por defecto -->
                        <option value="Empty" {{ (isset(json_decode($unitReport->units, true)['unit_' . $unitNumber]['gas_diesel_status']) && json_decode($unitReport->units, true)['unit_' . $unitNumber]['gas_diesel_status'] === 'Empty') ? 'selected' : '' }}>Empty</option>
                        <option value="1/8" {{ (isset(json_decode($unitReport->units, true)['unit_' . $unitNumber]['gas_diesel_status']) && json_decode($unitReport->units, true)['unit_' . $unitNumber]['gas_diesel_status'] === '1/8') ? 'selected' : '' }}>1/8</option>
                        <option value="1/4" {{ (isset(json_decode($unitReport->units, true)['unit_' . $unitNumber]['gas_diesel_status']) && json_decode($unitReport->units, true)['unit_' . $unitNumber]['gas_diesel_status'] === '1/4') ? 'selected' : '' }}>1/4</option>
                        <option value="3/8" {{ (isset(json_decode($unitReport->units, true)['unit_' . $unitNumber]['gas_diesel_status']) && json_decode($unitReport->units, true)['unit_' . $unitNumber]['gas_diesel_status'] === '3/8') ? 'selected' : '' }}>3/8</option>
                        <option value="1/2" {{ (isset(json_decode($unitReport->units, true)['unit_' . $unitNumber]['gas_diesel_status']) && json_decode($unitReport->units, true)['unit_' . $unitNumber]['gas_diesel_status'] === '1/2') ? 'selected' : '' }}>1/2</option>
                        <option value="5/8" {{ (isset(json_decode($unitReport->units, true)['unit_' . $unitNumber]['gas_diesel_status']) && json_decode($unitReport->units, true)['unit_' . $unitNumber]['gas_diesel_status'] === '5/8') ? 'selected' : '' }}>5/8</option>
                        <option value="3/4" {{ (isset(json_decode($unitReport->units, true)['unit_' . $unitNumber]['gas_diesel_status']) && json_decode($unitReport->units, true)['unit_' . $unitNumber]['gas_diesel_status'] === '3/4') ? 'selected' : '' }}>3/4</option>
                        <option value="7/8" {{ (isset(json_decode($unitReport->units, true)['unit_' . $unitNumber]['gas_diesel_status']) && json_decode($unitReport->units, true)['unit_' . $unitNumber]['gas_diesel_status'] === '7/8') ? 'selected' : '' }}>7/8</option>
                        <option value="Full" {{ (isset(json_decode($unitReport->units, true)['unit_' . $unitNumber]['gas_diesel_status']) && json_decode($unitReport->units, true)['unit_' . $unitNumber]['gas_diesel_status'] === 'Full') ? 'selected' : '' }}>Full</option>
                    </select>
                </div>
            </div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="gas_diesel_notes">Otros:</label>
            <textarea class="form-control" id="gas_diesel_notes" name="gas_diesel_notes">{{ old('gas_diesel_notes', $unitReport->gas_diesel_notes) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Reporte</button>
        <a href="{{ route('unit_reports.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
