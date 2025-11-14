<?php

use App\Http\Controllers\CintilloController;
use App\Http\Controllers\ConsolidadoController;
use App\Http\Controllers\ResumenController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
        if (Auth::User()->new_user == '0')
        {
            return view('index');
        }
        else if (Auth::User()->new_user == '1')
        {
            return view('actualizar_password');
        }
        else
        {
            return 'A ocurrido un error con el estatus del usuario';
        }
    })->name('home');

    Route::resource('/consolidado', ConsolidadoController::class)->middleware('can:consolidado.index')->names('consolidado');

    Route::get('/resumen', [ResumenController::class, 'index'])->middleware('can:resumen.index')->name('resumen');
    Route::get('/resumen-pdf/{selectedMonth}/{selectedYear}/{tipo}', [ResumenController::class, 'downloadPdf'])->middleware('can:resumen.pdf')->name('resumen.pdf');

    Route::get('/ver-pdf/{certificado}', function ($certificado) {
        
        $path = storage_path('app/public/certificados/' . $certificado);
        
        if (file_exists($path)) {
            return response()->file($path);
        }
    
        return abort(404, 'El archivo no existe.');
    });

    Route::resource('/users', UserController::class)->except('show', 'store', 'destroy')->middleware('can:users.index')->names('users');

    Route::resource('/roles', RoleController::class)->except('show')->middleware('can:roles.index')->names('roles');

    Route::get('/cintillos', CintilloController::class)->middleware('can:cintillos.index')->name('cintillos');
});
