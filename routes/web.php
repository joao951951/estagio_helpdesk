<?php

use App\Http\Controllers\ChamadosController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\UsuarioController;
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
    if (Auth::check()) return redirect()->route('dashboard');

    return redirect()->route('login');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::prefix('chamados')->name('chamados.')->group(function () {
        Route::get('', [ChamadosController::class, 'index'])->name('index');
        Route::get('/history', [ChamadosController::class, 'history'])->name('history');
        Route::get('{ticket}/historyticket', [ChamadosController::class, 'historyTicket'])->name('historyticket');
        Route::get('adicionar', [ChamadosController::class, 'create'])->name('create');
        Route::post('', [ChamadosController::class, 'store'])->name('store');
        Route::get('{ticket}/editar', [ChamadosController::class, 'edit'])->name('edit');
        Route::put('{ticket}', [ChamadosController::class, 'update'])->name('update');
        Route::delete('{ticket}', [ChamadosController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('clientes')->name('clientes.')->middleware(['is.admin'])->group(function () {
        Route::get('', [ClienteController::class, 'index'])->name('index');
        Route::get('adicionar', [ClienteController::class, 'create'])->name('create');
        Route::post('', [ClienteController::class, 'store'])->name('store');
        Route::get('{client}/editar', [ClienteController::class, 'edit'])->name('edit');
        Route::put('{client}', [ClienteController::class, 'update'])->name('update');
        Route::delete('{client}', [ClienteController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('funcionarios')->name('funcionarios.')->middleware(['is.admin'])->group(function () {
        Route::get('', [FuncionarioController::class, 'index'])->name('index');
        Route::get('adicionar', [FuncionarioController::class, 'create'])->name('create');
        Route::post('', [FuncionarioController::class, 'store'])->name('store');
        Route::get('{employee}/editar', [FuncionarioController::class, 'edit'])->name('edit');
        Route::put('{employee}', [FuncionarioController::class, 'update'])->name('update');
        Route::delete('{employee}', [FuncionarioController::class, 'destroy'])->name('destroy');
        Route::post('mudar-senha', [FuncionarioController::class, 'changePassword'])->name('change.password');
        Route::post('salvar-senha', [FuncionarioController::class, 'savePassword'])->name('save.password');
    });

    Route::prefix('administradores')->name('administradores.')->group(function () {
        Route::middleware(['is.admin'])->group(function () {
            Route::get('', [UsuarioController::class, 'index'])->name('index');
            Route::get('adicionar', [UsuarioController::class, 'create'])->name('create');
            Route::post('', [UsuarioController::class, 'store'])->name('store');
            Route::get('{admin}/editar', [UsuarioController::class, 'edit'])->name('edit');
            Route::put('{admin}', [UsuarioController::class, 'update'])->name('update');
        });

        Route::post('mudar-senha', [UsuarioController::class, 'changePassword'])->name('change.password');
        Route::post('salvar-senha', [UsuarioController::class, 'savePassword'])->name('save.password');
    });
});
