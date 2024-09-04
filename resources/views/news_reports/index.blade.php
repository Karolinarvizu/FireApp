@extends('layouts.dashboard')

@section('title', 'Reportes de Novedades')

@section('content')
<div class="container">
    <h1>Parte de Novedades</h1>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario de búsqueda con label externo -->
    <form action="{{ route('news_reports.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-8 mb-2 mb-md-0">
                <div class="form-group">
                    <label for="search">Buscar por fecha, usuario o dirección:</label>
                    <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    <a href="{{ route('news_reports.index') }}" class="btn btn-secondary">Limpiar</a>
                </div>
            </div>
        </div>
    </form>

    <!-- Botón de Crear -->
    @can('crear reportes')
    <a href="{{ route('news_reports.create') }}" class="btn btn-primary mb-3">Crear</a>
    @endcan

    <!-- Tabla de reportes con diseño responsivo -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($newsReports as $newsReport)
                    <tr>
                        <td>{{ $newsReport->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($newsReport->date)->format('d/m/Y') }}</td>
                        <td>{{ $newsReport->user->name }}</td>
                        <td>{{ $newsReport->address }}</td>
                        <td class="text-nowrap">
                            @can('ver reportes')
                            <a href="{{ route('news_reports.show', $newsReport->id) }}" class="btn btn-info btn-sm" title="Ver">
                                <i class="fas fa-eye"></i>
                            </a>
                            @endcan

                            @can('actualizar reportes')
                            <a href="{{ route('news_reports.edit', $newsReport->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endcan

                            @can('borrar reportes')
                            <form action="{{ route('news_reports.destroy', $newsReport->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Está seguro de que desea eliminar este reporte?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No se encontraron reportes</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    {{ $newsReports->links() }}
</div>
@endsection
