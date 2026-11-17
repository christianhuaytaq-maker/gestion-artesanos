<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Si no está logueado, al login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Si está logueado pero NO es admin, lo mandamos al catálogo con un error
        if (!auth()->user()->esAdmin()) {
            return redirect()->route('catalogo')->with('error', 'No tienes permiso para acceder a esta sección.');
        }

        return $next($request);
    }
}
