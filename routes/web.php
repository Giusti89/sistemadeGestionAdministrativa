<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\InsumoController;
use App\Http\Controllers\OrdenpagoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrabajoController;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::middleware(['auth', 'CheckAdmin'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('administracion.index', 'index')->name('adminIndex');
        Route::get('administracion.edit/{id}', 'edit')->name('editusu');
        Route::delete('administracion/{id}', 'destroy')->name('eliadmin');
        Route::put('/administracion/{id}', 'update')->name('adminUpdate');
    });
});

Route::middleware(['CheckActivo','auth', 'CheckSubscription'])->group(function () {
    Route::controller(ClienteController::class)->group(function () {
        Route::get('clientes.index', 'index')->name('clientIndex');
        Route::get('/clientes.nuevo', 'create')->name('nuevoCliente');
        Route::post('/clientes.store', 'store')->name('crearCliente');        
        Route::get('/clientes.edit/{id}', 'edit')->name('editCliente');      
        Route::put('/clientes/{cliente}', 'update')->name('clienteUpdate');
        Route::delete('/clientes/{cliente}', 'destroy')->name('elicliente');
       
    });

    Route::controller(TrabajoController::class)->group(function () {
        Route::get('trabajos.index', 'index')->name('trabIndex');
        Route::get('/trabajos.nuevo', 'create')->name('nuevoTrab');        
        Route::post('/trabajos.store', 'store')->name('crearTrab');
        Route::get('/trabajos.edit/{id}', 'edit')->name('editTrab'); 
        Route::put('/trabajos/{id}', 'update')->name('updateTrab');
        Route::delete('/trabajos/{id}', 'destroy')->name('eliTrab');
       
    });

    Route::controller(InsumoController::class)->group(function () {
        Route::get('insumos.index/{id}', 'index')->name('insumoIndex');
        Route::post('/insumos.store', 'store')->name('createInsumo');
        Route::get('/insumos.edit/{id}', 'edit')->name('editInsumo');
        Route::put('/insumos.update/{id}', 'update')->name('updateInsumo');
        Route::delete('/insumos/{id}', 'destroy')->name('eliInsumo');
        Route::post('/insumos', 'terminar')->name('terminarInsumo');
    });

    Route::controller(OrdenpagoController::class)->group(function () {
        Route::get('ordenpago.index', 'index')->name('pagoIndex');
        Route::get('/ordenpago.pago/{id}', 'create')->name('pagoCreate');        
    });

    Route::controller(PagoController::class)->group(function () {
        Route::post('/ordenpago.pago', 'store')->name('pagoStore');        
    });

    Route::controller(GastoController::class)->group(function () {
        Route::get('/gastos.index', 'index')->name('gastoIndex');
        Route::get('/gastos.nuevo', 'create')->name('nuevoGasto'); 
        Route::post('/gastos.store', 'store')->name('storeGasto');        
    });

});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
