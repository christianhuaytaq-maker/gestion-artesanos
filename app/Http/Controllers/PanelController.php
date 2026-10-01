<?php

namespace App\Http\Controllers;

use App\Models\Artesano;
use App\Models\Producto;
use App\Models\Usuario;

class PanelController extends Controller
{
    public function index()
    {
        $totalArtesanos = Artesano::count();
        $totalProductos = Producto::count();
        $totalUsuarios = Usuario::count();

        return view('panel', compact('totalArtesanos', 'totalProductos', 'totalUsuarios'));
    }
}
