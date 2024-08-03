<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsReport;

class NewsReportController extends Controller
{
    /**
     * Muestra la lista de reportes, con opción de búsqueda por fecha.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Inicializamos el query
        $query = NewsReport::with('user'); // Cargar el usuario relacionado

        if ($search) {
            $query->where(function($query) use ($search) {
                $query->where('date', 'LIKE', '%' . $search . '%') // Buscar por fecha
                      ->orWhereHas('user', function($q) use ($search) { // Buscar por usuario
                          $q->where('name', 'LIKE', '%' . $search . '%');
                      })
                      ->orWhere('address', 'LIKE', '%' . $search . '%'); // Buscar por dirección
            });
        }

        // Obtener resultados paginados
        $newsReports = $query->paginate(10);

        return view('news_reports.index', compact('newsReports'));
    }

    /**
     * Muestra el formulario para crear un nuevo reporte.
     */
    public function create()
    {
        return view('news_reports.create');
    }

    /**
     * Almacena un nuevo reporte en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'date' => 'required|date',
            'units' => 'required|array',
            'address' => 'required|string|max:255',
            'personnel' => 'required|array',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'activities' => 'nullable|string',
            'others' => 'nullable|string',
        ]);

        // Añadir el ID del usuario autenticado
        $validatedData['user_id'] = auth()->id();

        // Convertir los arrays a JSON
        $validatedData['units'] = json_encode($validatedData['units']);
        $validatedData['personnel'] = json_encode($validatedData['personnel']);

        // Crear el reporte
        NewsReport::create($validatedData);

        // Redirigir con un mensaje de éxito
        return redirect()->route('news_reports.index')->with('success', 'Reporte de Noticias creado exitosamente');
    }

    /**
     * Muestra un reporte específico.
     */
    public function show(NewsReport $newsReport)
    {
        return view('news_reports.show', compact('newsReport'));
    }

    /**
     * Muestra el formulario para editar un reporte existente.
     */
    public function edit(NewsReport $newsReport)
    {
        // Decodificar JSON a array para mostrarlo en el formulario
        $newsReport->units = json_decode($newsReport->units, true);
        $newsReport->personnel = json_decode($newsReport->personnel, true);

        return view('news_reports.edit', compact('newsReport'));
    }

    /**
     * Actualiza un reporte existente en la base de datos.
     */
    public function update(Request $request, NewsReport $newsReport)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'date' => 'required|date',
            'units' => 'required|array',
            'address' => 'required|string|max:255',
            'personnel' => 'required|array',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'activities' => 'nullable|string',
            'others' => 'nullable|string',
        ]);

        // Convertir los arrays a JSON
        $validatedData['units'] = json_encode($validatedData['units']);
        $validatedData['personnel'] = json_encode($validatedData['personnel']);

        // Actualizar el reporte
        $newsReport->update($validatedData);

        // Redirigir con un mensaje de éxito
        return redirect()->route('news_reports.index')->with('success', 'Reporte de Novedades actualizado exitosamente');
    }

    /**
     * Elimina un reporte de la base de datos.
     */
    public function destroy(NewsReport $newsReport)
    {
        $newsReport->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('news_reports.index')->with('success', 'Reporte de Novedades eliminado exitosamente');
    }
}
