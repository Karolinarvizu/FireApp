@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reporte de Unidades</h1>
    <form action="{{ route('unit_reports.index') }}" method="GET" class="mb-3">
    <div class="form-group">
            <label for="search_date">Buscar por Fecha:</label>
            <input type="date" name="search_date" id="search_date" class="form-control" value="{{ $searchDate }}">
        </div>
        <button type="submit" class="btn btn-secondary">Buscar</button>
    </form>
    
    @can('crear reportes')
    <a href="{{ route('unit_reports.create') }}" class="btn btn-primary mb-3">Crear</a>
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
            @foreach($unitReports as $report)
            <tr>
                <td>{{ $report->id }}</td>
                <td>{{ $report->date }}</td>
                <td>
                    @can('ver reportes')
                    <a href="{{ route('unit_reports.show', $report) }}" class="btn btn-info">Ver</a>
                    @endcan
                    
                    @can('actualizar reportes')
                    <a href="{{ route('unit_reports.edit', $report) }}" class="btn btn-warning">Editar</a>
                    @endcan
                    
                    @can('borrar reportes')
                    <form action="{{ route('unit_reports.destroy', $report) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este reporte?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
