<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artesano;

class NotificacionController extends Controller
{
    public function index()
    {
        // Pasamos el total actual de artesanos a la vista
        $totalArtesanos = Artesano::count();
        return view('notificaciones.index', compact('totalArtesanos'));
    }
}
