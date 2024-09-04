@extends('layouts.dashboard')

@section('title', 'Reportes de Instalaciones')

@section('content')
<div class="container">
    <h1>Parte de Instalaciones</h1>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario de búsqueda por fecha -->
    <form action="{{ route('installation_reports.index') }}" method="GET" class="mb-3">
        <div class="form-group">
            <label for="search_date">Buscar por Fecha:</label>
            <input type="date" id="search_date" name="search_date" class="form-control" value="{{ old('search_date', $searchDate) }}">
        </div>
        <button type="submit" class="btn btn-secondary">Buscar</button>
    </form>

    <!-- Botón de Crear -->
    @can('crear reportes')
    <a href="{{ route('installation_reports.create') }}" class="btn btn-primary mb-3">Crear</a>
    @endcan

    <!-- Tabla de reportes -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($installationReports as $installationReport)
                <tr>
                    <td>{{ $installationReport->id }}</td>
                    <td>{{ \Carbon\Carbon::parse($installationReport->date)->format('d/m/Y') }}</td>
                    <td class="text-nowrap">
                        @can('ver reportes')
                        <a href="{{ route('installation_reports.show', $installationReport->id) }}" class="btn btn-info btn-sm" title="Ver">
                            <i class="fas fa-eye"></i>
                        </a>
                        @endcan

                        @can('actualizar reportes')
                        <a href="{{ route('installation_reports.edit', $installationReport->id) }}" class="btn btn-warning btn-sm" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        @endcan

                        @can('borrar reportes')
                        <form action="{{ route('installation_reports.destroy', $installationReport->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Está seguro de que desea eliminar este reporte?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    {{ $installationReports->links() }}
</div>
@endsection
