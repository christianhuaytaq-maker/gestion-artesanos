<?php

namespace App\Http\Controllers;

use App\Models\Artesano;
use App\Models\Producto;
use App\Models\Usuario;
use App\Models\Venta; // IMPORTANTE: Importamos el modelo Venta
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Para manejar fechas

class PanelController extends Controller
{
    public function index()
    {
        // 1. Contadores
        $totalArtesanos = Artesano::count();
        $totalProductos = Producto::count();
        $totalUsuarios = Usuario::count();

        // 2. Últimos 5 artesanos
        $ultimosArtesanos = Artesano::latest()->take(5)->get();

        // 3. Datos para el Gráfico Circular (Especialidades)
        $especialidades = Artesano::select('especialidad', DB::raw('count(*) as total'))
                            ->groupBy('especialidad')
                            ->get();
        $labelsGrafico = $especialidades->pluck('especialidad');
        $dataGrafico = $especialidades->pluck('total');

        // 4. NUEVO: Datos para el Gráfico de Barras (Ventas Recientes)
        // Traemos las últimas 5 ventas.
        // (Ajusta 'total' o 'created_at' según los nombres de tu tabla ventas)
        $ultimasVentas = Venta::orderBy('created_at', 'desc')->take(5)->get();

        // Preparamos los datos para Chart.js
        $labelsVentas = $ultimasVentas->map(function($venta) {
            // Mostramos el ID del producto o el nombre si tienes la relación
            return 'Venta #' . $venta->id;
        });

        $dataVentas = $ultimasVentas->pluck('total');

        // 5. Enviamos TODO a la vista
        return view('panel', compact(
            'totalArtesanos',
            'totalProductos',
            'totalUsuarios',
            'ultimosArtesanos',
            'labelsGrafico',
            'dataGrafico',
            'labelsVentas', // Enviamos las etiquetas del gráfico de ventas
            'dataVentas'    // Enviamos los totales
        ));
    }
}
