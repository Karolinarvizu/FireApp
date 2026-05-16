@extends('layouts.dashboard')
@section('title', 'Editar Área')
@section('content')
<div class="container" style="max-width:500px">
    <h1><i class="fas fa-edit me-2" style="color:#cc2200;font-size:1rem"></i>Editar área</h1>
    <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:10px;padding:24px;">
        <form action="{{ route('config.areas.update', $area->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label" for="name">Nombre del área</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $area->name) }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <div class="form-check">
                    <input type="checkbox" name="active" id="active" class="form-check-input" {{ $area->active ? 'checked' : '' }}>
                    <label for="active" class="form-check-label">Área activa</label>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                <a href="{{ route('config.areas.index') }}" class="btn btn-secondary btn-sm">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
