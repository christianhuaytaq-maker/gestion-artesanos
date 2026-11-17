<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VentaController extends Controller
{
    // Para el Administrador: Ver historial
    public function index()
    {
        $ventas = Venta::with(['producto', 'user'])->orderBy('created_at', 'desc')->get();
        return view('ventas.index', compact('ventas'));
    }

    // Para el Cliente: Guardar la compra
    public function store(Request $request)
    {
        $producto = Producto::findOrFail($request->producto_id);

        // Verificar si hay stock
        if ($producto->stock <= 0) {
            return redirect()->back()->with('error', 'Lo sentimos, este producto está agotado.');
        }

        // Guardar Venta
        Venta::create([
            'producto_id' => $producto->id,
            'user_id' => Auth::id(),
            'dni_cliente' => $request->dni_cliente,
            'cantidad' => 1,
            'total' => $producto->precio,
        ]);

        // Restar Stock
        $producto->stock = $producto->stock - 1;
        $producto->save();

        return redirect()->back()->with('success', '¡Compra realizada con éxito!');
    }
}
