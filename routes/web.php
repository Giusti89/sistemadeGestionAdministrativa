<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProfileController;
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

Route::middleware(['auth', 'CheckSubscription'])->group(function () {
    Route::controller(ClienteController::class)->group(function () {
        Route::get('clientes.index', 'index')->name('clientIndex');
        Route::get('/clientes.nuevo', 'create')->name('nuevoCliente');
        Route::post('/clientes.store', 'store')->name('crearCliente');        
        Route::get('/clientes.edit/{id}', 'edit')->name('editCliente');      
        Route::put('/clientes/{cliente}', 'update')->name('clienteUpdate');
        Route::delete('/clientes/{cliente}', 'destroy')->name('elicliente');
       
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
