<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsReport;
use App\Models\Vehicle;
use App\Models\User;
use PDF;

class NewsReportController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');
        $sort = $request->input('sort', 'desc');

        $query = NewsReport::with('user');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('address', 'LIKE', '%' . $search . '%')
                  ->orWhere('activities', 'LIKE', '%' . $search . '%')
                  ->orWhere('others', 'LIKE', '%' . $search . '%')
                  ->orWhere('date', 'LIKE', '%' . $search . '%')
                  ->orWhereRaw("units LIKE ? COLLATE utf8mb4_general_ci", ['%' . $search . '%'])
                  ->orWhereRaw("personnel LIKE ? COLLATE utf8mb4_general_ci", ['%' . $search . '%'])
                  ->orWhereRaw("DATE_FORMAT(start_time, '%H:%i') LIKE ?", ['%' . $search . '%'])
                  ->orWhereRaw("DATE_FORMAT(end_time, '%H:%i') LIKE ?", ['%' . $search . '%'])
                  ->orWhereHas('user', function($q2) use ($search) {
                      $q2->where('name', 'LIKE', '%' . $search . '%');
                  });
            });
        }

        if ($dateFrom) {
            $query->whereDate('date', '>=', $dateFrom);
        }

        if ($dateTo) {
            $query->whereDate('date', '<=', $dateTo);
        }

        $newsReports = $query->orderBy('date', $sort)->paginate(10);

        return view('news_reports.index', compact('newsReports'));
    }

    public function create()
    {
        $vehicles = Vehicle::where('active', true)->orderBy('name')->get();
        $users = User::orderBy('name')->get();
        return view('news_reports.create', compact('vehicles', 'users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date'       => 'required|date',
            'units'      => 'required|array',
            'address'    => 'required|string|max:255',
            'personnel'  => 'required|array',
            'start_time' => 'required|date_format:H:i',
            'end_time'   => 'required|date_format:H:i|after:start_time',
            'activities' => 'nullable|string',
            'others'     => 'nullable|string',
            'photos.*'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $validatedData['user_id']   = auth()->id();
        $validatedData['units']     = json_encode($validatedData['units'], JSON_UNESCAPED_UNICODE);
        $validatedData['personnel'] = json_encode($validatedData['personnel'], JSON_UNESCAPED_UNICODE);

        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('news_photos', 'public');
                $photoPaths[] = $path;
            }
        }
        $validatedData['photos'] = json_encode($photoPaths);

        NewsReport::create($validatedData);

        return redirect()->route('news_reports.index')->with('success', 'Reporte creado exitosamente');
    }

    public function show(NewsReport $newsReport)
    {
        return view('news_reports.show', compact('newsReport'));
    }

    public function edit(NewsReport $newsReport)
    {
        $newsReport->units     = json_decode($newsReport->units, true);
        $newsReport->personnel = json_decode($newsReport->personnel, true);
        $vehicles = Vehicle::where('active', true)->orderBy('name')->get();
        $users = User::orderBy('name')->get();
        return view('news_reports.edit', compact('newsReport', 'vehicles', 'users'));
    }

    public function update(Request $request, NewsReport $newsReport)
    {
        $validatedData = $request->validate([
            'date'       => 'required|date',
            'units'      => 'required|array',
            'address'    => 'required|string|max:255',
            'personnel'  => 'required|array',
            'start_time' => 'required|string',
            'end_time'   => 'required|string',
            'activities' => 'nullable|string',
            'others'     => 'nullable|string',
            'photos.*'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $validatedData['units']     = json_encode($validatedData['units'], JSON_UNESCAPED_UNICODE);
        $validatedData['personnel'] = json_encode($validatedData['personnel'], JSON_UNESCAPED_UNICODE);

        $existingPhotos = json_decode($newsReport->photos, true) ?? [];

        $deletePhotos = json_decode($request->input('delete_photos', '[]'), true) ?? [];
        foreach ($deletePhotos as $photoPath) {
            \Storage::disk('public')->delete($photoPath);
            $existingPhotos = array_filter($existingPhotos, fn($p) => $p !== $photoPath);
        }
        $existingPhotos = array_values($existingPhotos);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('news_photos', 'public');
                $existingPhotos[] = $path;
            }
        }

        $validatedData['photos'] = json_encode($existingPhotos);
        $newsReport->update($validatedData);

        return redirect()->route('news_reports.show', $newsReport->id)->with('success', 'Reporte actualizado exitosamente');
    }

    public function destroy(NewsReport $newsReport)
    {
        $photos = json_decode($newsReport->photos, true) ?? [];
        foreach ($photos as $photo) {
            \Storage::disk('public')->delete($photo);
        }

        $newsReport->delete();
        return redirect()->route('news_reports.index')->with('success', 'Reporte eliminado exitosamente');
    }

    public function downloadPDF(NewsReport $newsReport)
    {
        $commanderName = "Ángel Antonio Gámez Navarro";
        $pdf = PDF::loadView('documento', compact('newsReport', 'commanderName'));
        $pdf->getDomPDF()->set_option('isRemoteEnabled', true);
        return $pdf->download('reporte_novedades.pdf');
    }
}