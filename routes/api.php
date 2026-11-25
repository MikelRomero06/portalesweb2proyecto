<?php

use App\Http\Controllers\Api\CarritoItemController;
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\DetallePedidoController;
use App\Http\Controllers\Api\PedidoController;
use App\Http\Controllers\Api\ProductoController;
use App\Http\Controllers\Api\ResenaController;
use App\Http\Controllers\Api\RolController;
use App\Http\Controllers\Api\UsuarioController;
use Illuminate\Support\Facades\Route;

//ROLES
Route::get('roles', [RolController::class, 'index']);
Route::post('roles', [RolController::class, 'store']);
Route::get('roles/{id}', [RolController::class, 'show']);
Route::put('roles/{id}', [RolController::class, 'update']);
Route::delete('roles/{id}', [RolController::class, 'destroy']);

//USUARIOS
Route::get('usuarios', [UsuarioController::class, 'index']);
Route::post('usuarios', [UsuarioController::class, 'store']);
Route::get('usuarios/{id}', [UsuarioController::class, 'show']);
Route::put('usuarios/{id}', [UsuarioController::class, 'update']);
Route::delete('usuarios/{id}', [UsuarioController::class, 'destroy']);

//CATEGORIAS
Route::get('categorias', [CategoriaController::class, 'index']);
Route::post('categorias', [CategoriaController::class, 'store']);
Route::get('categorias/{id}', [CategoriaController::class, 'show']);
Route::put('categorias/{id}', [CategoriaController::class, 'update']);
Route::delete('categorias/{id}', [CategoriaController::class, 'destroy']);

//PRODUCTOS
Route::get('productos', [ProductoController::class, 'index']);
Route::post('productos', [ProductoController::class, 'store']);
Route::get('productos/{id}', [ProductoController::class, 'show']);
Route::put('productos/{id}', [ProductoController::class, 'update']);
Route::delete('productos/{id}', [ProductoController::class, 'destroy']);

//CARRITOITEMS
Route::get('carrito-items', [CarritoItemController::class, 'index']);
Route::post('carrito-items', [CarritoItemController::class, 'store']);
Route::get('carrito-items/{id}', [CarritoItemController::class, 'show']);
Route::put('carrito-items/{id}', [CarritoItemController::class, 'update']);
Route::delete('carrito-items/{id}', [CarritoItemController::class, 'destroy']);

//PEDIDO
Route::get('pedidos/reportes', [PedidoController::class, 'reportes']);
Route::get('pedidos', [PedidoController::class, 'index']);
Route::post('pedidos', [PedidoController::class, 'store']);
Route::get('pedidos/{id}', [PedidoController::class, 'show']);
Route::put('pedidos/{id}', [PedidoController::class, 'update']);
Route::delete('pedidos/{id}', [PedidoController::class, 'destroy']);

//DETALLEPEDIDO
Route::get('detalle-pedido', [DetallePedidoController::class, 'index']);
Route::post('detalle-pedido', [DetallePedidoController::class, 'store']);
Route::get('detalle-pedido/{id}', [DetallePedidoController::class, 'show']);
Route::put('detalle-pedido/{id}', [DetallePedidoController::class, 'update']);
Route::delete('detalle-pedido/{id}', [DetallePedidoController::class, 'destroy']);

//RESEÑAS
Route::get('resenas', [ResenaController::class, 'index']);
Route::post('resenas', [ResenaController::class, 'store']);
Route::get('resenas/{id}', [ResenaController::class, 'show']);
Route::put('resenas/{id}', [ResenaController::class, 'update']);
Route::delete('resenas/{id}', [ResenaController::class, 'destroy']);