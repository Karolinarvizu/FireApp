<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\UnitReport;
use App\Models\Vehicle;
use App\Models\User;

class UnitReportController extends Controller
{
    public function index(Request $request)
    {
        $searchDate = $request->input('search_date');
        $sort = $request->input('sort', 'desc');

        $unitReports = UnitReport::with('user')
            ->when($searchDate, function ($query) use ($searchDate) {
                return $query->whereDate('date', $searchDate);
            })
            ->orderBy('date', $sort)
            ->paginate(10);

        return view('unit_reports.index', compact('unitReports', 'searchDate'));
    }

    public function create()
    {
        $vehicles = Vehicle::where('active', true)->orderBy('name')->get();
        $users = User::orderBy('name')->get();
        return view('unit_reports.create', compact('vehicles', 'users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date'             => 'required|date',
            'units'            => 'required|array',
            'gas_diesel_notes' => 'nullable|string',
            'entrega_turno'    => 'nullable|string',
            'recepcion_turno'  => 'nullable|string',
        ]);
        $validatedData['user_id'] = auth()->id();
        $validatedData['units']   = json_encode($validatedData['units'], JSON_UNESCAPED_UNICODE);
        UnitReport::create($validatedData);
        return redirect()->route('unit_reports.index')->with('success', 'Reporte de Unidades creado exitosamente');
    }

    public function show(UnitReport $unitReport)
    {
        $unitReport->load('user');
        return view('unit_reports.show', compact('unitReport'));
    }

    public function edit(UnitReport $unitReport)
    {
        $vehicles = Vehicle::where('active', true)->orderBy('name')->get();
        $users = User::orderBy('name')->get();
        return view('unit_reports.edit', compact('unitReport', 'vehicles', 'users'));
    }

    public function update(Request $request, UnitReport $unitReport)
    {
        $validatedData = $request->validate([
            'date'             => 'required|date',
            'units'            => 'required|array',
            'gas_diesel_notes' => 'nullable|string',
            'entrega_turno'    => 'nullable|string',
            'recepcion_turno'  => 'nullable|string',
        ]);
        $validatedData['units'] = json_encode($validatedData['units'], JSON_UNESCAPED_UNICODE);
        $unitReport->update($validatedData);
        return redirect()->route('unit_reports.index')->with('success', 'Reporte de Unidades actualizado exitosamente');
    }

    public function destroy(UnitReport $unitReport)
    {
        $unitReport->delete();
        return redirect()->route('unit_reports.index')->with('success', 'Reporte de Unidades eliminado exitosamente');
    }
}