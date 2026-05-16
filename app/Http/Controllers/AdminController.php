<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnitReport;
use App\Models\InstallationReport;
use App\Models\NewsReport;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index() {
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        $totalReportesMes = UnitReport::whereBetween('date', [$startOfMonth, $endOfMonth])->count()
            + InstallationReport::whereBetween('date', [$startOfMonth, $endOfMonth])->count()
            + NewsReport::whereBetween('date', [$startOfMonth, $endOfMonth])->count();

        $totalUsuarios = User::count();

        $turnoActivo = UnitReport::whereNotNull('recepcion_turno')
            ->latest()
            ->value('recepcion_turno');

        $ultimosReportes = collect();

        UnitReport::with('user')->latest()->take(5)->get()->each(function ($r) use (&$ultimosReportes) {
            $ultimosReportes->push([
                'tipo' => 'Unidad',
                'descripcion' => 'Reporte de unidades',
                'fecha' => $r->created_at,
                'usuario' => optional($r->user)->name ?? '—',
            ]);
        });

        InstallationReport::with('user')->latest()->take(5)->get()->each(function ($r) use (&$ultimosReportes) {
            $ultimosReportes->push([
                'tipo' => 'Instalación',
                'descripcion' => 'Reporte de instalaciones',
                'fecha' => $r->created_at,
                'usuario' => optional($r->user)->name ?? '—',
            ]);
        });

        NewsReport::with('user')->latest()->take(5)->get()->each(function ($r) use (&$ultimosReportes) {
            $ultimosReportes->push([
                'tipo' => 'Novedad',
                'descripcion' => isset($r->activities) ? \Str::limit($r->activities, 50) : 'Reporte de novedad',
                'fecha' => $r->created_at,
                'usuario' => optional($r->user)->name ?? '—',
            ]);
        });

        $ultimosReportes = $ultimosReportes->sortByDesc('fecha')->take(5)->values();

        $meses = [];
        $datosNovedades = [];
        $datosUnidades = [];
        $datosInstalaciones = [];

        for ($i = 11; $i >= 0; $i--) {
            $mes = Carbon::now()->subMonths($i);
            $meses[] = $mes->locale('es')->isoFormat('MMM');
            $inicio = $mes->copy()->startOfMonth();
            $fin = $mes->copy()->endOfMonth();

            $datosUnidades[] = UnitReport::whereBetween('date', [$inicio, $fin])->count();
            $datosInstalaciones[] = InstallationReport::whereBetween('date', [$inicio, $fin])->count();
            $datosNovedades[] = NewsReport::whereBetween('date', [$inicio, $fin])->count();
        }

        return view('layouts.cards', compact(
            'totalReportesMes',
            'totalUsuarios',
            'turnoActivo',
            'ultimosReportes',
            'meses',
            'datosNovedades',
            'datosUnidades',
            'datosInstalaciones'
        ));
    }
}
