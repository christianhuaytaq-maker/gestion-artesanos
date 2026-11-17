<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $resetRecord = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$resetRecord || $resetRecord->token !== $request->token) {
            throw ValidationException::withMessages([
                'email' => ['El token de restablecimiento de contraseña es inválido.'],
            ]);
        }

        $user = User::where('email', $request->email)->first();

        // Sumamos +1 al contador también aquí
        $user->forceFill([
            'password' => Hash::make($request->password),
            'password_updates' => $user->password_updates + 1,
        ])->save();

        event(new PasswordReset($user));

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', '¡Contraseña restablecida correctamente!');
    }
}
