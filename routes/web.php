<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\ArtesanoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VerificationCodeController;
use App\Http\Controllers\LanguageController;
use App\Events\ArtesanoActualizado;

// 1. Ruta de bienvenida (pública)
Route::get('/', function () {
    return view('welcome');
})->name('bienvenida');

// 🌎 RUTA PARA CAMBIAR EL IDIOMA
Route::get('lang/{locale}', [LanguageController::class, 'switchLang'])->name('lang.switch');

// ✅ CATÁLOGO PÚBLICO — Cualquier persona puede verlo
Route::get('/catalogo', [ProductoController::class, 'catalogo'])->name('catalogo');

// 🔊 RUTA DE PRUEBA DE VOZ POR WEBSOCKET (temporal, puedes borrarla después)
Route::get('/probar-voz', function () {
    $nombre = request('nombre', 'María desde ruta');
    event(new ArtesanoActualizado($nombre));
    return response()->json([
        'ok' => true,
        'mensaje' => 'Evento disparado ✅',
        'usuario' => $nombre,
        'hora' => now()->toDateTimeString(),
    ]);
})->name('probar.voz');

// 2. CARGAMOS LAS RUTAS DE AUTENTICACIÓN
require __DIR__.'/auth.php';

// 3. RUTAS PARA USUARIOS LOGUEADOS (no requiere verificación para comprar)
Route::middleware(['auth'])->group(function () {
    Route::post('/verify-code/generate', [VerificationCodeController::class, 'generate'])->name('verify.code.generate');
    Route::post('/verify-code/check', [VerificationCodeController::class, 'verify'])->name('verify.code.check');

    // ✅ Comprar: solo logueado, sin necesidad de verificación
    Route::post('/comprar', [VentaController::class, 'store'])->name('ventas.store');
});

// 4. GRUPO PROTEGIDO: Logueados Y Verificados
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

    // SOLO ADMINISTRADORES
    Route::middleware(['esAdmin'])->group(function () {

        Route::get('/panel', [PanelController::class, 'index'])->name('panel');

        // RUTAS DE RECURSOS (CRUD)
        Route::resource('artesanos', ArtesanoController::class);
        Route::resource('productos', ProductoController::class);
        Route::resource('usuarios', UsuarioController::class);
        Route::resource('ventas', VentaController::class)->only(['index']);
        Route::post('/usuarios/enviar-recuperacion/{id}', [UsuarioController::class, 'enviarRecuperacion'])->name('usuarios.enviarRecuperacion');

        // PANTALLA DEL SOCKET
        Route::get('/pantalla-socket', function () {
            return view('socket.pantalla');
        })->name('socket.pantalla');
    });
});
