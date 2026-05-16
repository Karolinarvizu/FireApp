@extends('layouts.dashboard')
@section('title', 'Dashboard - FireApp')

@section('content')
@php $user = auth()->user(); @endphp

{{-- Topbar turno + usuario se inyectan via variable en layout, aquí solo el contenido --}}

{{-- STAT CARDS --}}
<div class="row g-3 mb-4 mt-1">
    <div class="col-6 col-md-3">
        <div class="dash-card dash-card--red">
            <div class="dash-card__icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="dash-card__label">Reportes este mes</div>
            <div class="dash-card__value">{{ $totalReportesMes }}</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="dash-card dash-card--orange">
            <div class="dash-card__icon">
                <i class="fas fa-fire"></i>
            </div>
            <div class="dash-card__label">Turno activo</div>
            <div class="dash-card__value dash-card__value--sm">{{ $turnoActivo ?? 'Sin registro' }}</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="dash-card dash-card--blue">
            <div class="dash-card__icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="dash-card__label">Usuarios registrados</div>
            <div class="dash-card__value">{{ $totalUsuarios }}</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="dash-card dash-card--green">
            <div class="dash-card__icon">
                <i class="fas fa-truck"></i>
            </div>
            <div class="dash-card__label">Acceso rápido</div>
            <div class="dash-card__links">
                <a href="{{ route('unit_reports.index') }}">Unidades</a>
                <a href="{{ route('installation_reports.index') }}">Instalaciones</a>
                <a href="{{ route('news_reports.index') }}">Novedades</a>
            </div>
        </div>
    </div>
</div>

{{-- GRÁFICA + RECIENTES --}}
<div class="row g-3">
    <div class="col-12 col-lg-7">
        <div class="dash-panel">
            <div class="dash-panel__header">
                <span>Reportes por mes</span>
                <div class="dash-legend">
                    <span><span class="dash-legend__dot" style="background:#cc2200"></span>Novedades</span>
                    <span><span class="dash-legend__dot" style="background:#2266cc"></span>Unidades</span>
                    <span><span class="dash-legend__dot" style="background:#1a8a3a"></span>Instalaciones</span>
                </div>
            </div>
            <div style="position:relative;width:100%;height:240px;">
                <canvas id="chartReportes" role="img" aria-label="Gráfica de reportes por mes agrupados por tipo">Datos de reportes mensuales.</canvas>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-5">
        <div class="dash-panel">
            <div class="dash-panel__header">
                <span>Últimos reportes</span>
            </div>
            @forelse($ultimosReportes as $reporte)
            @php
                $tipo = $reporte['tipo'];
                $claseColor = $tipo === 'Novedad' ? 'nov' : ($tipo === 'Unidad' ? 'uni' : 'ins');
                $icono = $tipo === 'Novedad' ? 'fa-bell' : ($tipo === 'Unidad' ? 'fa-truck' : 'fa-building');
            @endphp
            <div class="dash-report-row">
                <div class="dash-report-icon dash-report-icon--{{ $claseColor }}">
                    <i class="fas {{ $icono }}"></i>
                </div>
                <div class="dash-report-info">
                    <div class="dash-report-desc">{{ $reporte['descripcion'] }}</div>
                    <div class="dash-report-meta">{{ $reporte['usuario'] }} &mdash; {{ \Carbon\Carbon::parse($reporte['fecha'])->diffForHumans() }}</div>
                </div>
                <span class="dash-badge dash-badge--{{ $claseColor }}">{{ $tipo }}</span>
            </div>
            @empty
            <p class="text-muted small mt-2">No hay reportes recientes.</p>
            @endforelse
        </div>
    </div>
</div>

<style>
.dash-card {
    background: #1e1e1e;
    border-radius: 10px;
    padding: 16px;
    position: relative;
    overflow: hidden;
    height: 100%;
    min-height: 110px;
}
.dash-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
}
.dash-card--red::before { background: #cc2200; }
.dash-card--orange::before { background: #ff8c00; }
.dash-card--blue::before { background: #2266cc; }
.dash-card--green::before { background: #1a8a3a; }

.dash-card__icon {
    width: 34px; height: 34px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 10px;
    font-size: 16px;
}
.dash-card--red .dash-card__icon { background: rgba(204,34,0,0.15); color: #ff6b47; }
.dash-card--orange .dash-card__icon { background: rgba(255,140,0,0.15); color: #ffaa33; }
.dash-card--blue .dash-card__icon { background: rgba(34,102,204,0.15); color: #5599ff; }
.dash-card--green .dash-card__icon { background: rgba(26,138,58,0.15); color: #44cc66; }

.dash-card__label { font-size: 11px; color: #888; margin-bottom: 4px; }
.dash-card__value { font-size: 28px; font-weight: 500; color: #eee; line-height: 1; }
.dash-card__value--sm { font-size: 16px; font-weight: 500; color: #eee; margin-top: 4px; }
.dash-card__links { display: flex; flex-direction: column; gap: 4px; margin-top: 4px; }
.dash-card__links a { font-size: 12px; color: #44cc66; text-decoration: none; }
.dash-card__links a:hover { text-decoration: underline; }

.dash-panel {
    background: #1e1e1e;
    border: 1px solid #2a2a2a;
    border-radius: 10px;
    padding: 16px;
    height: 100%;
}
.dash-panel__header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 14px;
    font-size: 13px;
    color: #ccc;
    font-weight: 500;
    flex-wrap: wrap;
    gap: 6px;
}
.dash-legend { display: flex; gap: 12px; font-size: 11px; color: #666; flex-wrap: wrap; }
.dash-legend__dot { display: inline-block; width: 8px; height: 8px; border-radius: 2px; margin-right: 4px; }

.dash-report-row {
    display: flex; align-items: center; gap: 10px;
    padding: 8px 0;
    border-bottom: 1px solid #252525;
}
.dash-report-row:last-child { border-bottom: none; }
.dash-report-icon {
    width: 30px; height: 30px;
    border-radius: 6px;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px;
    flex-shrink: 0;
}
.dash-report-icon--nov { background: rgba(204,34,0,0.15); color: #ff6b47; }
.dash-report-icon--uni { background: rgba(34,102,204,0.15); color: #5599ff; }
.dash-report-icon--ins { background: rgba(26,138,58,0.15); color: #44cc66; }
.dash-report-info { flex: 1; min-width: 0; }
.dash-report-desc { font-size: 12px; color: #ccc; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.dash-report-meta { font-size: 10px; color: #555; margin-top: 2px; }
.dash-badge { font-size: 10px; padding: 2px 8px; border-radius: 10px; flex-shrink: 0; }
.dash-badge--nov { background: rgba(204,34,0,0.15); color: #ff6b47; }
.dash-badge--uni { background: rgba(34,102,204,0.15); color: #5599ff; }
.dash-badge--ins { background: rgba(26,138,58,0.15); color: #44cc66; }

@media (max-width: 576px) {
    .dash-card__value { font-size: 22px; }
    .dash-card { min-height: 100px; }
}
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
new Chart(document.getElementById('chartReportes'), {
    type: 'bar',
    data: {
        labels: {!! json_encode($meses) !!},
        datasets: [
            {
                label: 'Novedades',
                data: {!! json_encode($datosNovedades) !!},
                backgroundColor: 'rgba(204,34,0,0.75)',
                borderRadius: 4
            },
            {
                label: 'Unidades',
                data: {!! json_encode($datosUnidades) !!},
                backgroundColor: 'rgba(34,102,204,0.65)',
                borderRadius: 4
            },
            {
                label: 'Instalaciones',
                data: {!! json_encode($datosInstalaciones) !!},
                backgroundColor: 'rgba(26,138,58,0.65)',
                borderRadius: 4
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: {
                stacked: true,
                ticks: { color: '#666', font: { size: 11 } },
                grid: { color: '#252525' }
            },
            y: {
                stacked: true,
                ticks: { color: '#666', font: { size: 11 }, stepSize: 1 },
                grid: { color: '#252525' }
            }
        }
    }
});
</script>
@endsection
