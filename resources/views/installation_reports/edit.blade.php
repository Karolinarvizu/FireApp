@extends('layouts.dashboard')
@section('title', 'Editar Reporte de Instalaciones')
@section('content')
<div class="container" style="max-width:600px">
    <h1><i class="fas fa-edit me-2" style="color:#cc2200;font-size:1rem"></i>Editar Reporte de Instalaciones</h1>
    @if($errors->any())
    <div class="alert alert-danger py-2">
        <ul class="mb-0 ps-3">@foreach($errors->all() as $error)<li style="font-size:13px">{{ $error }}</li>@endforeach</ul>
    </div>
    @endif
    <form method="POST" action="{{ route('installation_reports.update', $installationReport->id) }}">
        @csrf @method('PUT')
        <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:10px;padding:20px;margin-bottom:12px;">
            <div class="mb-3">
                <label class="form-label" for="date">Fecha</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $installationReport->date) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Áreas atendidas</label>
                @php $selectedRooms = json_decode($installationReport->cleaned_rooms, true) ?? []; @endphp
                <div class="row g-2 mt-1">
                    @foreach($areas as $area)
                    <div class="col-6 col-md-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="area_{{ $area->id }}"
                                name="cleaned_rooms[]" value="{{ $area->name }}"
                                {{ in_array($area->name, old('cleaned_rooms', $selectedRooms)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="area_{{ $area->id }}" style="font-size:13px;">{{ $area->name }}</label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="notes">Observaciones</label>
                <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes', $installationReport->notes) }}</textarea>
            </div>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
            <a href="{{ route('installation_reports.index') }}" class="btn btn-secondary btn-sm">Cancelar</a>
        </div>
    </form>
</div>
@endsection
