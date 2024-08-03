<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstallationReport;

class InstallationReportController extends Controller
{
    public function index(Request $request)
    {
        $searchDate = $request->input('search_date');

        $installationReports = InstallationReport::with('user')
            ->when($searchDate, function ($query) use ($searchDate) {
                return $query->where('date', $searchDate);
            })
            ->get();

        return view('installation_reports.index', compact('installationReports', 'searchDate'));
    }

    public function create()
    {
        return view('installation_reports.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'cleaned_rooms' => 'required|array',
            'notes' => 'nullable|string',
        ]);

        $validatedData['user_id'] = auth()->id();
        $validatedData['cleaned_rooms'] = json_encode($validatedData['cleaned_rooms']);

        InstallationReport::create($validatedData);

        return redirect()->route('installation_reports.index')->with('success', 'Reporte de Instalaciones creado exitosamente');
    }

    public function show(InstallationReport $installationReport)
    {
        $installationReport->load('user');
        return view('installation_reports.show', compact('installationReport'));
    }

    public function edit(InstallationReport $installationReport)
    {
        return view('installation_reports.edit', compact('installationReport'));
    }

    public function update(Request $request, InstallationReport $installationReport)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'cleaned_rooms' => 'required|array',
            'notes' => 'nullable|string',
        ]);

        $validatedData['cleaned_rooms'] = json_encode($validatedData['cleaned_rooms']);

        $installationReport->update($validatedData);

        return redirect()->route('installation_reports.index')->with('success', 'Reporte de Instalaciones actualizado exitosamente');
    }

    public function destroy(InstallationReport $installationReport)
    {
        $installationReport->delete();

        return redirect()->route('installation_reports.index')->with('success', 'Reporte de Instalaciones eliminado exitosamente');
    }
}