<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        if (in_array($lang, ['es', 'en', 'qu'])) {
            // 1. Guardar en sesión
            Session::put('locale', $lang);
            App::setLocale($lang);

            // 2. Guardar en la base de datos si está logueado
            if (Auth::check()) {
                $user = Auth::user();
                $user->locale = $lang;
                $user->save();
            }
        }

        // Redirigir a donde estaba el usuario
        return redirect()->back();
    }
}
