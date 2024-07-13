@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $report->title }}</h1>
    <p>{{ $report->description }}</p>

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

    <a href="{{ route('reports.index') }}" class="btn btn-secondary">Volver a la lista</a>
</div>
@endsection
