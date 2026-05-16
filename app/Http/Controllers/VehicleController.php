<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::orderBy('name')->get();
        return view('config.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('config.vehicles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
        ]);

        Vehicle::create([
            'name'   => $request->name,
            'type'   => $request->type,
            'active' => $request->has('active') ? 1 : 0,
        ]);

        return redirect()->route('config.vehicles.index')->with('success', 'Unidad creada exitosamente');
    }

    public function edit(Vehicle $vehicle)
    {
        return view('config.vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
        ]);

        $vehicle->update([
            'name'   => $request->name,
            'type'   => $request->type,
            'active' => $request->has('active') ? 1 : 0,
        ]);

        return redirect()->route('config.vehicles.index')->with('success', 'Unidad actualizada exitosamente');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('config.vehicles.index')->with('success', 'Unidad eliminada exitosamente');
    }
}