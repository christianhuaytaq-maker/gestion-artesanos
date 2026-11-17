<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class VerificationCodeController extends Controller
{
    /**
     * Genera un código de 6 dígitos y lo envía al correo del administrador.
     */
    public function generate(Request $request)
    {
        $user = auth()->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }

        // 1. Generar código de 6 dígitos
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // 2. Guardar en base de datos (expira en 15 minutos)
        DB::table('verification_codes')->updateOrInsert(
            ['email' => $user->email],
            [
                'code' => $code,
                'expires_at' => now()->addMinutes(15),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // 3. Enviar al correo del administrador
        $adminEmail = 'christianhuaytaq@gmail.com'; // 👈 Tu correo real de admin

        Mail::raw("🔐 SOLICITUD DE VERIFICACIÓN\n\nEl usuario: {$user->email}\n\nSolicita verificar su cuenta.\n\nSu código de verificación es: {$code}\n\nEste código expira en 15 minutos.", function ($message) use ($adminEmail) {
            $message->to($adminEmail)
                ->subject('🔐 Código de Verificación de Usuario');
        });

        return back()->with('status', 'Se ha enviado un código al administrador. Pídeselo para continuar.');
    }

    /**
     * Verifica el código ingresado por el usuario.
     */
    public function verify(Request $request)
    {
        $request->validate(['code' => 'required|string|size:6']);

        $user = auth()->user();

        $record = DB::table('verification_codes')
            ->where('email', $user->email)
            ->where('code', $request->code)
            ->where('expires_at', '>', now())
            ->first();

        if (!$record) {
            return back()->withErrors(['code' => 'El código es incorrecto o ha expirado.']);
        }

        // Marcar correo como verificado
        $user->email_verified_at = now();
        $user->save();

        // Borrar el código usado
        DB::table('verification_codes')->where('email', $user->email)->delete();

        // Redirigir según el rol
        if ($user->esAdmin()) {
            return redirect()->route('panel')->with('status', '¡Correo verificado! Bienvenido Administrador.');
        }
        return redirect()->route('catalogo')->with('status', '¡Correo verificado! Bienvenido.');
    }
}
