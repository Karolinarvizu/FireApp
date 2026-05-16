@extends('layouts.dashboard')
@section('title', 'Editar Reporte de Unidades')
@section('content')
<div class="container">
    <h1><i class="fas fa-edit me-2" style="color:#cc2200;font-size:1rem"></i>Editar Reporte de Unidades</h1>

    @if($errors->any())
    <div class="alert alert-danger py-2">
        <ul class="mb-0 ps-3">@foreach($errors->all() as $error)<li style="font-size:13px">{{ $error }}</li>@endforeach</ul>
    </div>
    @endif

    @php $unitsData = json_decode($unitReport->units, true); @endphp

    <form method="POST" action="{{ route('unit_reports.update', $unitReport->id) }}">
        @csrf @method('PUT')
        <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:10px;padding:20px;margin-bottom:12px;">
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label" for="date">Fecha</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $unitReport->date) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="entrega_turno">Entrega de turno</label>
                    <select name="entrega_turno" id="entrega_turno" class="form-control select2">
                        <option value="">-- Seleccionar --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->name }}" {{ old('entrega_turno', $unitReport->entrega_turno) == $user->name ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="recepcion_turno">Recepción de turno</label>
                    <select name="recepcion_turno" id="recepcion_turno" class="form-control select2">
                        <option value="">-- Seleccionar --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->name }}" {{ old('recepcion_turno', $unitReport->recepcion_turno) == $user->name ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @foreach($vehicles as $vehicle)
            @php
                $unitKey = 'unit_' . $loop->index;
                $unitServices = $unitsData[$unitKey]['services'] ?? [];
                $unitGas = $unitsData[$unitKey]['gas_diesel_status'] ?? '';
            @endphp
            <div style="border:1px solid #2a2a2a;border-radius:8px;padding:14px;margin-bottom:10px;">
                <div style="font-size:13px;font-weight:500;color:#ff6b47;margin-bottom:10px;">
                    <i class="fas fa-truck me-2" style="font-size:11px"></i>{{ $vehicle->name }}
                </div>
                <input type="hidden" name="units[{{ $unitKey }}][name]" value="{{ $vehicle->name }}">
                <div class="row">
                    <div class="col-md-8">
                        <label class="form-label" style="font-size:11px;">Servicios verificados</label>
                        <div class="row g-1">
                            @foreach(['Aceite', 'Agua/radiador', 'Baterías', 'Planta de luz', 'Torreta', 'Luces', 'Limpieza/unidad', 'Llantas', 'Nivel de agua'] as $service)
                            <div class="col-6 col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"
                                        name="units[{{ $unitKey }}][services][]" value="{{ $service }}"
                                        {{ in_array($service, $unitServices) ? 'checked' : '' }}>
                                    <label class="form-check-label" style="font-size:12px">{{ $service }}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-4 mt-2 mt-md-0">
                        <label class="form-label" style="font-size:11px;">Gas/Diesel</label>
                        <select class="form-control form-control-sm" name="units[{{ $unitKey }}][gas_diesel_status]">
                            @foreach(['Empty', '1/8', '1/4', '3/8', '1/2', '5/8', '3/4', '7/8', 'Full'] as $level)
                            <option value="{{ $level }}" {{ $unitGas === $level ? 'selected' : '' }}>{{ $level }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="mt-3">
                <label class="form-label" for="gas_diesel_notes">Otros / Observaciones</label>
                <textarea class="form-control" id="gas_diesel_notes" name="gas_diesel_notes" rows="2">{{ old('gas_diesel_notes', $unitReport->gas_diesel_notes) }}</textarea>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary btn-sm">Actualizar reporte</button>
            <a href="{{ route('unit_reports.index') }}" class="btn btn-secondary btn-sm">Cancelar</a>
        </div>
    </form>
</div>
@endsection
@section('scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('#entrega_turno').select2({ width: '100%', placeholder: '-- Seleccionar --' });
    $('#recepcion_turno').select2({ width: '100%', placeholder: '-- Seleccionar --' });
});
</script>
@endsection
