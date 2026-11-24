<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Events\CompraRealizada;

class VentaController extends Controller
{
    // Para el Administrador: Ver historial y ventas del día
    public function index()
    {
        // Obtener todas las ventas (para la tabla)
        $ventas = Venta::with(['producto', 'user'])->orderBy('created_at', 'desc')->get();

        // Calcular ventas de hoy (lo que pediste para tu panel)
        $ventasHoy = Venta::whereDate('created_at', today())->get();
        $totalVendidoHoy = $ventasHoy->sum('total');
        $cantidadVentasHoy = $ventasHoy->count();

        return view('ventas.index', compact('ventas', 'totalVendidoHoy', 'cantidadVentasHoy'));
    }

    // Para el Cliente: Guardar la compra (El carrito completo)
    public function store(Request $request)
    {
        // 1. Validar los datos
        $request->validate([
            'dni_cliente' => 'required|digits:8',
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ], [
            'dni_cliente.required' => 'El DNI es obligatorio.',
            'dni_cliente.digits' => 'El DNI debe tener exactamente 8 dígitos.',
        ]);

        try {
            DB::beginTransaction();

            $totalCompra = 0;
            $nombresProductos = [];

            // 2. Recorrer el carrito y guardar cada producto
            foreach ($request->productos as $item) {
                $producto = Producto::findOrFail($item['id']);
                $cantidad = $item['cantidad'];

                if ($producto->stock < $cantidad) {
                    throw new \Exception("No hay suficiente stock para el producto: {$producto->nombre}.");
                }

                // Guardar la venta en la tabla
                Venta::create([
                    'producto_id' => $producto->id,
                    'user_id' => Auth::id(),
                    'dni_cliente' => $request->dni_cliente,
                    'cantidad' => $cantidad,
                    'total' => $producto->precio * $cantidad,
                ]);

                // Restar Stock
                $producto->stock -= $cantidad;
                $producto->save();

                $totalCompra += ($producto->precio * $cantidad);
                $nombresProductos[] = $producto->nombre;
            }

            DB::commit();

            // 3. Disparar el WebSocket (La voz en vivo)
            $nombreCliente = Auth::user()->name ?? 'Cliente';
            $listaProductos = implode(', ', $nombresProductos);

            event(new CompraRealizada(
                $nombreCliente,
                $listaProductos,
                $totalCompra
            ));

            return response()->json([
                'success' => true,
                'message' => '¡Compra realizada con éxito!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
