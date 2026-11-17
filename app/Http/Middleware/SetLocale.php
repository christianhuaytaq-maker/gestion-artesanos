<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // <-- IMPORTAMOS AUTH
use Illuminate\Support\Facades\Session; // <-- IMPORTAMOS SESSION

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        // Si el usuario está logueado y tiene idioma guardado en la BD, lo usamos
        if (Auth::check() && Auth::user()->locale) {
            app()->setLocale(Auth::user()->locale);
            Session::put('locale', Auth::user()->locale);
        }
        // Si no, usamos el de la sesión (para el login)
        elseif (Session::has('locale')) {
            app()->setLocale(Session::get('locale'));
        }

        return $next($request);
    }
}
