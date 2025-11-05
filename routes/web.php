<?php

use App\Http\Controllers\ConsolidadoController;
use App\Http\Controllers\ResumenController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    
    Route::get('/home', function () {
        return view('index');
    })->name('home');

    Route::resource('/consolidado', ConsolidadoController::class)->names('consolidado');

    Route::get('/resumen', [ResumenController::class, 'index'])->name('resumen');
    Route::get('/resumen-pdf/{selectedMonth}/{selectedYear}', [ResumenController::class, 'downloadPdf'])->name('resumen.pdf');

    Route::get('/ver-pdf/{certificado}', function ($certificado) {
        
        $path = storage_path('app/public/certificados/' . $certificado);
        
        if (file_exists($path)) {
            return response()->file($path);
        }
    
        return abort(404, 'El archivo no existe.');
    });

    Route::resource('/users', UserController::class)->except('show', 'store', 'destroy')->middleware('can:users.index')->names('users');

    Route::resource('/roles', RoleController::class)->except('show')->names('roles');
});
