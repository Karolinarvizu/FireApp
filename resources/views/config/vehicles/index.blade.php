@extends('layouts.dashboard')
@section('title', 'Configuración - Unidades')
@section('content')
<div class="container">
    <h1><i class="fas fa-truck me-2" style="color:#cc2200;font-size:1rem"></i>Unidades</h1>
    @if(session('success'))
        <div class="alert alert-success py-2">{{ session('success') }}</div>
    @endif
    <div class="mb-3">
        <a href="{{ route('config.vehicles.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Agregar unidad
        </a>
    </div>
    <div class="table-responsive catalog-list">
        <table class="table table-bordered table-striped has-actions fit-mobile mobile-cards table-vehicles">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th style="width:110px">Estado</th>
                    <th style="width:110px">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vehicles as $vehicle)
                <tr>
                    <td data-label="Nombre">{{ $vehicle->name }}</td>
                    <td style="color:#aaa">{{ $vehicle->type ?? '—' }}</td>
                    <td data-label="Estado">
                        @if($vehicle->active)
                            <span class="badge bg-success">Activa</span>
                        @else
                            <span class="badge bg-secondary">Inactiva</span>
                        @endif
                    </td>
                    <td class="table-actions" data-label="Acciones">
                        <a href="{{ route('config.vehicles.edit', $vehicle->id) }}" class="btn btn-warning btn-sm" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('config.vehicles.destroy', $vehicle->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar"
                                onclick="return confirm('¿Está seguro de eliminar esta unidad?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center" style="color:#666;padding:24px">No hay unidades registradas</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
