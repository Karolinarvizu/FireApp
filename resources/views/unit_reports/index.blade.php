@extends('layouts.dashboard')
@section('title', 'Reportes de Unidades')
@section('content')
<div class="container">
    <h1><i class="fas fa-truck me-2" style="color:#cc2200;font-size:1rem"></i>Reportes de Unidades</h1>

    @if(session('success'))
        <div class="alert alert-success py-2">{{ session('success') }}</div>
    @endif

    <div class="d-flex flex-wrap gap-2 align-items-end mb-3">
        <form action="{{ route('unit_reports.index') }}" method="GET" class="d-flex gap-2 flex-wrap">
            <div>
                <label class="form-label mb-1">Buscar por fecha</label>
                <input type="date" name="search_date" class="form-control form-control-sm" value="{{ old('search_date', $searchDate) }}">
            </div>
            <input type="hidden" name="sort" value="{{ request('sort', 'desc') }}">
            <div class="d-flex gap-1 align-items-end">
                <button type="submit" class="btn btn-secondary btn-sm">Buscar</button>
                <a href="{{ route('unit_reports.index') }}" class="btn btn-secondary btn-sm">Limpiar</a>
            </div>
        </form>
        @can('crear reportes')
        <a href="{{ route('unit_reports.create') }}" class="btn btn-primary btn-sm ms-auto">
            <i class="fas fa-plus me-1"></i>Crear reporte
        </a>
        @endcan
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped has-actions fit-mobile table-report-simple mb-3">
            <thead>
                <tr>
                    <th style="width:60px">#</th>
                    <th onclick="sortFecha()" style="cursor:pointer;user-select:none;">
                        Fecha &nbsp;
                        @if(request('sort', 'desc') === 'desc') &#9660; @else &#9650; @endif
                    </th>
                    <th style="width:130px">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($unitReports as $report)
                <tr>
                    <td style="color:#666">{{ $report->id }}</td>
                    <td>{{ \Carbon\Carbon::parse($report->date)->format('d/m/Y') }}</td>
                    <td class="table-actions">
                        @can('ver reportes')
                        <a href="{{ route('unit_reports.show', $report->id) }}" class="btn btn-info btn-sm" title="Ver">
                            <i class="fas fa-eye"></i>
                        </a>
                        @endcan
                        @can('actualizar reportes')
                        <a href="{{ route('unit_reports.edit', $report->id) }}" class="btn btn-warning btn-sm" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        @endcan
                        @can('borrar reportes')
                        <form action="{{ route('unit_reports.destroy', $report->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar"
                                onclick="return confirm('¿Está seguro de que desea eliminar este reporte?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center" style="color:#666;padding:24px">No se encontraron reportes</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $unitReports->appends(request()->query())->links() }}
</div>
@endsection
@section('scripts')
<script>
function sortFecha() {
    var url = new URL(window.location.href);
    var currentSort = url.searchParams.get('sort') || 'desc';
    url.searchParams.set('sort', currentSort === 'desc' ? 'asc' : 'desc');
    window.location.href = url.toString();
}
</script>
@endsection
