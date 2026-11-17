<?php

namespace App\Http\Controllers;

use App\Models\Artesano;
use App\Models\Producto;
use App\Models\Usuario;

class PanelController extends Controller
{
    public function index()
    {
        // 1. Contadores para las tarjetas de arriba
        $totalArtesanos = Artesano::count();
        $totalProductos = Producto::count();
        $totalUsuarios = Usuario::count();

        // 2. Traemos los últimos 5 artesanos para llenar la tabla de abajo
        // (Esto evita que el panel se vea vacío)
        $ultimosArtesanos = Artesano::latest()->take(5)->get();

        // 3. Enviamos TODO a la vista
        return view('panel', compact('totalArtesanos', 'totalProductos', 'totalUsuarios', 'ultimosArtesanos'));
    }
}
