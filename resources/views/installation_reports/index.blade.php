@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reportes de Instalaciones</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('installation_reports.index') }}" method="GET" class="mb-3">
        <div class="form-group">
            <label for="search_date">Buscar por Fecha:</label>
            <input type="date" id="search_date" name="search_date" class="form-control" value="{{ old('search_date', $searchDate ? \Carbon\Carbon::parse($searchDate)->format('Y-m-d') : '') }}">
        </div>
        <button type="submit" class="btn btn-secondary">Buscar</button>
    </form>

    @can('crear reportes')
    <a href="{{ route('installation_reports.create') }}" class="btn btn-primary mb-3">Crear</a>
    @endcan

    <table class="table table-bordered">
        <thead>
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
                <td>
                    @can('ver reportes')
                    <a href="{{ route('installation_reports.show', $installationReport->id) }}" class="btn btn-info btn-sm">Ver</a>
                    @endcan
                    
                    @can('actualizar reportes')
                    <a href="{{ route('installation_reports.edit', $installationReport->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    @endcan

                    @can('borrar reportes')
                    <form action="{{ route('installation_reports.destroy', $installationReport->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de que desea eliminar este reporte?')">Eliminar</button>
                    </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection


