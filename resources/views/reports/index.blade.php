@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reportes</h1>
    @can('crear reportes')
        <a href="{{ route('reports.create') }}" class="btn btn-primary mb-3">Crear Reporte</a>
    @endcan
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
            <tr>
                <td>{{ $report->id }}</td>
                <td>{{ $report->title }}</td>
                <td>{{ $report->description }}</td>
                <td>
                    @can('ver reportes')
                    <a href="{{ route('reports.show', $report) }}" class="btn btn-info">Ver</a>
                    @endcan

                    @can('actualizar reportes')
                    <a href="{{ route('reports.edit', $report) }}" class="btn btn-warning">Editar</a>
                    @endcan

                    @can('borrar reportes')
                    <form action="{{ route('reports.destroy', $report) }}" method="POST" style="display:inline;">
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
