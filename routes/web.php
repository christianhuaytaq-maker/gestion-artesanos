<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\ArtesanoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VerificationCodeController;
use App\Http\Controllers\LanguageController; // <-- IMPORTAMOS EL CONTROLADOR DE IDIOMA

// 1. Ruta de bienvenida (pública)
Route::get('/', function () {
    return view('welcome');
})->name('bienvenida');

// =========================================================
// 🌎 RUTA PARA CAMBIAR EL IDIOMA (PERSISTENTE)
// =========================================================
Route::get('lang/{locale}', [LanguageController::class, 'switchLang'])->name('lang.switch');

// 2. CARGAMOS LAS RUTAS DE AUTENTICACIÓN (Públicas)
require __DIR__.'/auth.php';

// 3. RUTAS PARA USUARIOS LOGUEADOS PERO QUE AÚN NO ESTÁN VERIFICADOS
Route::middleware(['auth'])->group(function () {
    Route::post('/verify-code/generate', [VerificationCodeController::class, 'generate'])->name('verify.code.generate');
    Route::post('/verify-code/check', [VerificationCodeController::class, 'verify'])->name('verify.code.check');
});

// 4. GRUPO PROTEGIDO PARA USUARIOS LOGUEADOS Y VERIFICADOS
Route::middleware(['auth', 'verified'])->group(function () {

    // Redirección general
    Route::get('/dashboard', function () {
        if (auth()->user()->esAdmin()) {
            return redirect()->route('panel');
        }
        return redirect()->route('catalogo');
    })->name('dashboard');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Catálogo y ventas (Rutas personalizadas que NO son un CRUD completo)
    Route::get('/catalogo', [ProductoController::class, 'catalogo'])->name('catalogo');
    Route::post('/comprar', [VentaController::class, 'store'])->name('ventas.store');

    // SOLO ADMINISTRADORES
    Route::middleware(['esAdmin'])->group(function () {

        Route::get('/panel', [PanelController::class, 'index'])->name('panel');

        // =========================================================
        // ✨ RUTAS DE RECURSOS (CRUD) ✨
        // =========================================================

        // Artesanos
        Route::resource('artesanos', ArtesanoController::class);

        // Productos
        Route::resource('productos', ProductoController::class);

        // Usuarios
        Route::resource('usuarios', UsuarioController::class);

        // Ventas
        Route::resource('ventas', VentaController::class)->only(['index']);

        // Ruta personalizada extra para enviar recuperación
        Route::post('/usuarios/enviar-recuperacion/{id}', [UsuarioController::class, 'enviarRecuperacion'])->name('usuarios.enviarRecuperacion');

        // =========================================================
        // 🔔 RUTA PARA LA PANTALLA DEL SOCKET (TV)
        // =========================================================
        Route::get('/pantalla-socket', function () {
            return view('socket.pantalla');
        })->name('socket.pantalla');

    });
});
