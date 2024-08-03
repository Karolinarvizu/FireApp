@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Reporte de Unidades</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('unit_reports.store') }}">
        @csrf

        <div class="form-group">
            <label for="date">Fecha</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" required>
        </div>

        <div class="form-group">
            <label>Reporte de Unidades</label>
            @foreach([13, 27, 02, 34, 03, 38, 14, 39] as $unitNumber)
            <div class="mb-3">
                <label for="unit_{{ $unitNumber }}">Unidad {{ $unitNumber }}</label>
                <div>
                    <label>Servicios</label>
                    <div>
                        <input type="checkbox" id="oil_{{ $unitNumber }}" name="units[unit_{{ $unitNumber }}][services][]" value="Aceite">
                        <label for="oil_{{ $unitNumber }}">Aceite</label>
                    </div>
                    <div>
                        <input type="checkbox" id="water_{{ $unitNumber }}" name="units[unit_{{ $unitNumber }}][services][]" value="Agua/radiador">
                        <label for="water_{{ $unitNumber }}">Agua/radiador</label>
                    </div>
                    <div>
                        <input type="checkbox" id="batteries_{{ $unitNumber }}" name="units[unit_{{ $unitNumber }}][services][]" value="Baterías">
                        <label for="batteries_{{ $unitNumber }}">Baterías</label>
                    </div>
                    <div>
                        <input type="checkbox" id="light_{{ $unitNumber }}" name="units[unit_{{ $unitNumber }}][services][]" value="Planta de luz">
                        <label for="light_{{ $unitNumber }}">Planta de luz</label>
                    </div>
                    <div>
                        <input type="checkbox" id="siren_{{ $unitNumber }}" name="units[unit_{{ $unitNumber }}][services][]" value="Torreta">
                        <label for="siren_{{ $unitNumber }}">Torreta</label>
                    </div>
                    <div>
                        <input type="checkbox" id="lights_{{ $unitNumber }}" name="units[unit_{{ $unitNumber }}][services][]" value="Luces">
                        <label for="lights_{{ $unitNumber }}">Luces</label>
                    </div>
                    <div>
                        <input type="checkbox" id="cleaning_{{ $unitNumber }}" name="units[unit_{{ $unitNumber }}][services][]" value="Limpieza/unidad">
                        <label for="cleaning_{{ $unitNumber }}">Limpieza/unidad</label>
                    </div>
                    <div>
                        <input type="checkbox" id="tires_{{ $unitNumber }}" name="units[unit_{{ $unitNumber }}][services][]" value="Llantas">
                        <label for="tires_{{ $unitNumber }}">Llantas</label>
                    </div>
                    <div>
                        <input type="checkbox" id="water_level_{{ $unitNumber }}" name="units[unit_{{ $unitNumber }}][services][]" value="Nivel de agua">
                        <label for="water_level_{{ $unitNumber }}">Nivel de agua</label>
                    </div>
                </div>
                <div class="form-group">
            <label for="gas_diesel_status_{{ $unitNumber }}">Estado de Gas/Diesel</label>
            <select class="form-control" id="gas_diesel_status_{{ $unitNumber }}" name="units[unit_{{ $unitNumber }}][gas_diesel_status]">
                <option value="Empty">Empty</option>
                <option value="1/8">1/8</option>
                <option value="1/4">1/4</option>
                <option value="3/8">3/8</option>
                <option value="1/2">1/2</option>
                <option value="5/8">5/8</option>
                <option value="3/4">3/4</option>
                <option value="7/8">7/8</option>
                <option value="Full">Full</option>
            </select>
        </div>
            </div>
            @endforeach
        </div>


        <div class="form-group">
            <label for="gas_diesel_notes">Otros:</label>
            <textarea class="form-control" id="gas_diesel_notes" name="gas_diesel_notes">{{ old('gas_diesel_notes') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Crear Reporte</button>
        <a href="{{ route('unit_reports.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection