<?php
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Productos;
use App\Http\Controllers\PedidosController;


Route::get('/login', [LoginController::class, 'mostrarLogin']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/', function () {
    return view('login');
});
Route::get('/productos', [LoginController::class, 'mostrarLogin'])->name('productos');
Route::get('/clientes', [ClienteController::class, 'index'])->middleware('auth');
Route::post('/clientes', [ClienteController::class, 'store']);
Route::delete('/clientes/{id}', [ClienteController::class, 'destroy']);
Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit']);
Route::put('/clientes/{id}', [ClienteController::class, 'update']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/productos', [ProductosController::class, 'index'])->name('productos.index');
Route::post('/productos', [ProductosController::class, 'store']);
Route::delete('/productos/{id}', [ProductosController::class, 'destroy']);
Route::get('/productos/{id}/edit', [ProductosController::class, 'edit']);
Route::put('/productos/{id}', [ProductosController::class, 'update']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::prefix('clientes')->group(function () {
    Route::get('{id}/pedidos', [PedidosController::class, 'index'])->name('clientes.pedidos');
    Route::post('{id}/pedidos', [PedidosController::class, 'store'])->name('clientes.pedidos.store');
    Route::delete('pedidos/{id}', [PedidosController::class, 'destroy'])->name('clientes.pedidos.destroy');
});

Route::get('/clientes/buscar', [ClienteController::class, 'buscar']);