<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Report::class, 'report');
    }

    public function index()
    {
        $this->authorize('viewAny', Report::class);
        $reports = Report::all();
        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        $this->authorize('create', Report::class);
        return view('reports.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Report::class);
        $report = Report::create($request->all());
        return redirect()->route('reports.index');
    }

    public function show(Report $report)
    {
        $this->authorize('view', $report);
        return view('reports.show', compact('report'));
    }

    public function edit(Report $report)
    {
        $this->authorize('update', $report);
        return view('reports.edit', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        $this->authorize('update', $report);
        $report->update($request->all());
        return redirect()->route('reports.index');
    }

    public function destroy(Report $report)
    {
        $this->authorize('delete', $report);
        $report->delete();
        return redirect()->route('reports.index');
    }
}
