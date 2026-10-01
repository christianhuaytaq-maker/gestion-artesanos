<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\ArtesanoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;

Route::get('/', function () {
    return view('bienvenida');
})->name('bienvenida');

// Todas las rutas requieren autenticación
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Catálogo (para clientes)
    Route::get('/catalogo', [ProductoController::class, 'catalogo'])->name('catalogo');

    // SOLO administradores
    Route::middleware(['esAdmin'])->group(function () {

        // Panel
        Route::get('/panel', [PanelController::class, 'index'])->name('panel');

        // Artesanos
        Route::get('/artesanos', [ArtesanoController::class, 'index'])->name('artesanos.index');
        Route::get('/artesanos/crear', [ArtesanoController::class, 'create'])->name('artesanos.create');
        Route::post('/artesanos/guardar', [ArtesanoController::class, 'store'])->name('artesanos.store');
        Route::get('/artesanos/editar/{id}', [ArtesanoController::class, 'edit'])->name('artesanos.edit');
        Route::put('/artesanos/actualizar/{id}', [ArtesanoController::class, 'update'])->name('artesanos.update');
        Route::delete('/artesanos/eliminar/{id}', [ArtesanoController::class, 'destroy'])->name('artesanos.destroy');

        // Productos
        Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
        Route::get('/productos/crear', [ProductoController::class, 'create'])->name('productos.create');
        Route::post('/productos/guardar', [ProductoController::class, 'store'])->name('productos.store');
        Route::get('/productos/editar/{id}', [ProductoController::class, 'edit'])->name('productos.edit');
        Route::put('/productos/actualizar/{id}', [ProductoController::class, 'update'])->name('productos.update');
        Route::delete('/productos/eliminar/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');

        // Usuarios
        Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
        Route::get('/usuarios/editar/{id}', [UsuarioController::class, 'edit'])->name('usuarios.edit');
        Route::put('/usuarios/actualizar/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
        Route::delete('/usuarios/eliminar/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
    });
});

require __DIR__.'/auth.php';
