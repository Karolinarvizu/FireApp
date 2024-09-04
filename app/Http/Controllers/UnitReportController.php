<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnitReport;

class UnitReportController extends Controller
{
    public function index(Request $request)
    {
        $searchDate = $request->input('search_date');

        $unitReports = UnitReport::with('user')
            ->when($searchDate, function ($query) use ($searchDate) {
                return $query->where('date', $searchDate);
            })
            ->paginate(10);

        return view('unit_reports.index', compact('unitReports', 'searchDate'));
    }

    public function create()
    {
        return view('unit_reports.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'units' => 'required|array',
            'gas_diesel_status' => 'nullable|string',
            'gas_diesel_notes' => 'nullable|string',
        ]);

        $validatedData['user_id'] = auth()->id();
        $validatedData['units'] = json_encode($validatedData['units']);

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
        return view('unit_reports.edit', compact('unitReport'));
    }

    public function update(Request $request, UnitReport $unitReport)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'units' => 'required|array',
            'gas_diesel_status' => 'nullable|string',
            'gas_diesel_notes' => 'nullable|string',
        ]);

        $validatedData['units'] = json_encode($validatedData['units']);

        $unitReport->update($validatedData);

        return redirect()->route('unit_reports.index')->with('success', 'Reporte de Unidades actualizado exitosamente');
    }

    public function destroy(UnitReport $unitReport)
    {
        $unitReport->delete();

        return redirect()->route('unit_reports.index')->with('success', 'Reporte de Unidades eliminado exitosamente');
    }

}
