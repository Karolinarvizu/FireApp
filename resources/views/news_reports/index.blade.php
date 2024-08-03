@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Parte de Novedades</h1>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario de búsqueda unificado -->
    <form action="{{ route('news_reports.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <input type="text" name="search" id="search" class="form-control" placeholder="Buscar por fecha, usuario o dirección" value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Buscar</button>
                <a href="{{ route('news_reports.index') }}" class="btn btn-secondary">Limpiar</a>
            </div>
        </div>
    </form>

    <!-- Botón de Crear -->
    @can('crear reportes')
    <a href="{{ route('news_reports.create') }}" class="btn btn-primary mb-3">Crear</a>
    @endcan

    <!-- Tabla de reportes -->
    <table class="table table-bordered">
        <thead>
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
                    <td>
                        @can('ver reportes')
                        <a href="{{ route('news_reports.show', $newsReport->id) }}" class="btn btn-info btn-sm">Ver</a>
                        @endcan

                        @can('actualizar reportes')
                        <a href="{{ route('news_reports.edit', $newsReport->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        @endcan

                        @can('borrar reportes')
                        <form action="{{ route('news_reports.destroy', $newsReport->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de que desea eliminar este reporte?')">Eliminar</button>
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

    <!-- Paginación -->
    {{ $newsReports->links() }}
</div>
@endsection
