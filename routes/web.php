<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CategoriasController;
<<<<<<< HEAD
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\PromocionesController;
use App\Http\Controllers\CambiosController;
=======
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CambioController;
use App\Http\Controllers\ControlVencimientoController;
use App\Http\Controllers\AlertaController;
>>>>>>> 78f0e7ad0afcfd8c1027d09c271005c02ccdc76f


use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:web'])->group(function () {
    Route::get('/',[HomeController::class,'index'])->name('home');
    Route::get('/productos', [ProductosController::class, 'index'])->name('productos.index');
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/categorias', [CategoriasController::class, 'index'])->name('categorias.index');
<<<<<<< HEAD
    Route::get('/pedidos', [PedidosController::class, 'index'])->name('pedidos.index');
    Route::get('/promociones', [PromocionesController::class, 'index'])->name('promociones.index');
    Route::get('/cambios', [CambiosController::class, 'index'])->name('cambios.index');
=======
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::get('/cambios', [CambioController::class, 'index'])->name('cambios.index');
    Route::get('/control_vencimientos', [ControlVencimientoController::class, 'index'])->name('control_vencimientos.index');
    Route::get('/alertas', [AlertaController::class, 'index'])->name('alertas.index');
>>>>>>> 78f0e7ad0afcfd8c1027d09c271005c02ccdc76f
});
// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
