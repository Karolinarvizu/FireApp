@extends('layouts.dashboard')
@section('title', 'Agregar Unidad')
@section('content')
<div class="container" style="max-width:500px">
    <h1><i class="fas fa-plus-circle me-2" style="color:#cc2200;font-size:1rem"></i>Agregar unidad</h1>
    <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:10px;padding:24px;">
        <form action="{{ route('config.vehicles.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="name">Nombre de la unidad</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" placeholder="Ej: Unidad 13" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="type">Tipo</label>
                <input type="text" name="type" id="type" class="form-control"
                    value="{{ old('type') }}" placeholder="Ej: Combate, Rescate, Ambulancia">
            </div>
            <div class="mb-4">
                <div class="form-check">
                    <input type="checkbox" name="active" id="active" class="form-check-input" checked>
                    <label for="active" class="form-check-label">Unidad activa</label>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                <a href="{{ route('config.vehicles.index') }}" class="btn btn-secondary btn-sm">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
