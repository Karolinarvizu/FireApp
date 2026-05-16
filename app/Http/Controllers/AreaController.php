<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::orderBy('name')->get();
        return view('config.areas.index', compact('areas'));
    }

    public function create()
    {
        return view('config.areas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Area::create([
            'name'   => $request->name,
            'active' => $request->has('active') ? 1 : 0,
        ]);

        return redirect()->route('config.areas.index')->with('success', 'Área creada exitosamente');
    }

    public function edit(Area $area)
    {
        return view('config.areas.edit', compact('area'));
    }

    public function update(Request $request, Area $area)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $area->update([
            'name'   => $request->name,
            'active' => $request->has('active') ? 1 : 0,
        ]);

        return redirect()->route('config.areas.index')->with('success', 'Área actualizada exitosamente');
    }

    public function destroy(Area $area)
    {
        $area->delete();
        return redirect()->route('config.areas.index')->with('success', 'Área eliminada exitosamente');
    }
}