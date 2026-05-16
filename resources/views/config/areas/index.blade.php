@extends('layouts.dashboard')
@section('title', 'Configuración - Áreas')
@section('content')
<div class="container">
    <h1><i class="fas fa-map-marker-alt me-2" style="color:#cc2200;font-size:1rem"></i>Áreas del cuartel</h1>

    @if(session('success'))
        <div class="alert alert-success py-2">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('config.areas.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Agregar área
        </a>
    </div>

    <div class="table-responsive catalog-list">
        <table class="table table-bordered table-striped has-actions fit-mobile mobile-cards table-areas">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th style="width:120px">Estado</th>
                    <th style="width:110px">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($areas as $area)
                <tr>
                    <td data-label="Nombre">{{ $area->name }}</td>
                    <td data-label="Estado">
                        @if($area->active)
                            <span class="badge bg-success">Activa</span>
                        @else
                            <span class="badge bg-secondary">Inactiva</span>
                        @endif
                    </td>
                    <td class="table-actions" data-label="Acciones">
                        <a href="{{ route('config.areas.edit', $area->id) }}" class="btn btn-warning btn-sm" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('config.areas.destroy', $area->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar"
                                onclick="return confirm('¿Está seguro de eliminar esta área?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center" style="color:#666;padding:24px">No hay áreas registradas</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
