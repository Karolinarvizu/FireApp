@extends('layouts.dashboard')
@section('title', 'Reportes de Novedades')
@section('content')
<div class="container">
    <h1><i class="fas fa-bell me-2" style="color:#cc2200;font-size:1rem"></i>Parte de Novedades</h1>

    @if(session('success'))
        <div class="alert alert-success py-2">{{ session('success') }}</div>
    @endif

    <form action="{{ route('news_reports.index') }}" method="GET" class="mb-3">
        <div class="row g-2 align-items-end">
            <div class="col-12 col-md-5">
                <label class="form-label mb-1">Búsqueda general</label>
                <input type="text" name="search" class="form-control form-control-sm"
                    placeholder="Dirección, personal, unidad, actividades..."
                    value="{{ request('search') }}">
            </div>
            <div class="col-6 col-md-2">
                <label class="form-label mb-1">Desde</label>
                <input type="date" name="date_from" class="form-control form-control-sm" value="{{ request('date_from') }}">
            </div>
            <div class="col-6 col-md-2">
                <label class="form-label mb-1">Hasta</label>
                <input type="date" name="date_to" class="form-control form-control-sm" value="{{ request('date_to') }}">
            </div>
            <div class="col-12 col-md-3 d-flex gap-1">
                <button type="submit" class="btn btn-primary btn-sm flex-fill">Buscar</button>
                <a href="{{ route('news_reports.index') }}" class="btn btn-secondary btn-sm flex-fill">Limpiar</a>
            </div>
        </div>

        @if(request('search') || request('date_from') || request('date_to'))
        <div class="alert alert-info mt-2 mb-0 py-2" style="font-size:12px;">
            <i class="fas fa-filter me-1"></i> Filtros activos —
            @if(request('search')) <strong>Texto:</strong> "{{ request('search') }}" @endif
            @if(request('date_from')) &nbsp;<strong>Desde:</strong> {{ \Carbon\Carbon::parse(request('date_from'))->format('d/m/Y') }} @endif
            @if(request('date_to')) &nbsp;<strong>Hasta:</strong> {{ \Carbon\Carbon::parse(request('date_to'))->format('d/m/Y') }} @endif
            &nbsp;— <strong>{{ $newsReports->total() }}</strong> resultado(s)
        </div>
        @endif
    </form>

    @can('crear reportes')
    <div class="mb-3">
        <a href="{{ route('news_reports.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Crear reporte
        </a>
    </div>
    @endcan

    <div class="table-responsive">
        <table class="table table-bordered table-striped has-actions scroll-mobile table-news mb-3">
            <thead>
                <tr>
                    <th style="width:50px">#</th>
                    <th onclick="sortFecha()" style="width:115px;cursor:pointer;user-select:none;">
                        Fecha &nbsp;@if(request('sort', 'desc') === 'desc') &#9660; @else &#9650; @endif
                    </th>
                    <th style="min-width:130px">Usuario</th>
                    <th>Dirección</th>
                    <th style="width:70px" class="text-center">Fotos</th>
                    <th style="width:120px">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($newsReports as $newsReport)
                <tr>
                    <td style="color:#666">{{ $newsReport->id }}</td>
                    <td>{{ \Carbon\Carbon::parse($newsReport->date)->format('d/m/Y') }}</td>
                    <td style="font-size:13px;color:#aaa">{{ $newsReport->user->name }}</td>
                    <td style="font-size:13px">{{ $newsReport->address }}</td>
                    <td class="text-center">
                        @php $photos = json_decode($newsReport->photos, true) ?? []; @endphp
                        @if(count($photos) > 0)
                            <span style="background:rgba(34,102,204,0.15);color:#5599ff;font-size:11px;padding:2px 7px;border-radius:4px;">
                                <i class="fas fa-camera me-1" style="font-size:10px"></i>{{ count($photos) }}
                            </span>
                        @else
                            <span style="color:#444">—</span>
                        @endif
                    </td>
                    <td class="table-actions">
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
                    <td colspan="6" class="text-center" style="color:#666;padding:24px">No se encontraron reportes</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $newsReports->appends(request()->query())->links() }}
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
