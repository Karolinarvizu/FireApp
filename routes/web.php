<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UnitReportController;
use App\Http\Controllers\InstallationReportController;
use App\Http\Controllers\NewsReportController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return Auth::check() ? redirect('/home') : redirect('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('unit_reports', UnitReportController::class);
Route::resource('installation_reports', InstallationReportController::class);
Route::resource('news_reports', NewsReportController::class);
Route::get('news_reports/{newsReport}/download-pdf', [NewsReportController::class, 'downloadPDF'])->name('news_reports.download_pdf');
Route::get('storage/images/{filename}', function ($filename) {
    $path = storage_path('app/public/images/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header('Content-Type', $type);

    return $response;
});

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    
});

Route::middleware(['auth'])->group(function () {
    Route::get('profile', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::post('profile', [UserController::class, 'updateProfile'])->name('profile.update');

    Route::get('/dashboard',[AdminController::class,'index'])->name('dashboard');
});


