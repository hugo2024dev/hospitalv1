<?php

use App\Actions\GenerarPdf;
use App\Enums\Setting\ReportType;
use App\Models\Cita;
use Illuminate\Support\Facades\Route;
use Filament\Notifications\Notification;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/pdf/rayosx/{id}', function (string $id) {
    $cita = Cita::findOrFail($id);
    return GenerarPdf::make()
        ->filename('orden_medica_rayosx')
        // ->header('components.pdf.header-cita-testigo')
        ->marginTop('100px')
        ->handle(ReportType::RAYOSX, $cita);
})->middleware(['auth'])->name('cita-rayosx');

Route::get('/pdf/ecografia/{id}', function (string $id) {
    $cita = Cita::findOrFail($id);
    return GenerarPdf::make()
        ->filename('orden_medica_ecografia')
        // ->header('components.pdf.header-cita-testigo')
        ->marginTop('100px')
        ->handle(ReportType::ECOGRAFIA, $cita);
})->middleware(['auth'])->name('cita-ecografia');

Route::get('/pdf/examen/{id}', function (string $id) {
    $cita = Cita::findOrFail($id);
    return GenerarPdf::make()
        ->filename('orden_medica_examen')
        // ->header('components.pdf.header-cita-testigo')
        ->marginTop('100px')
        ->handle(ReportType::EXAMEN, $cita);
})->middleware(['auth'])->name('cita-examen');

Route::get('/pdf/receta/{id}', function (string $id) {
    $cita = Cita::findOrFail($id);
    return GenerarPdf::make()
        ->filename('receta')
        // ->header('components.pdf.header-cita-testigo')
        ->marginTop('100px')
        ->handle(ReportType::RECETA, $cita);
})->middleware(['auth'])->name('cita-receta');
