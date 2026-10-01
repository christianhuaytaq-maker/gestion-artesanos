<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Artesano;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::with('artesano');

        // Búsqueda por nombre
        if ($request->has('buscar') && $request->buscar != '') {
            $query->where('nombre', 'LIKE', '%' . $request->buscar . '%');
        }

        // Filtro por categoría
        if ($request->has('categoria') && $request->categoria != '') {
            $query->where('categoria', $request->categoria);
        }

        $productos = $query->get();
        $categorias = Producto::select('categoria')->distinct()->pluck('categoria');

        return view('productos.index', compact('productos', 'categorias'));
    }

    public function create()
    {
        $artesanos = Artesano::all();
        return view('productos.create', compact('artesanos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'artesano_id' => 'required|exists:artesanos,id',
            'nombre' => 'required|max:150',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric|min:0',
            'categoria' => 'required|max:100',
        ]);

        Producto::create($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto agregado correctamente');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $artesanos = Artesano::all();
        return view('productos.edit', compact('producto', 'artesanos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'artesano_id' => 'required|exists:artesanos,id',
            'nombre' => 'required|max:150',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric|min:0',
            'categoria' => 'required|max:100',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
    }
}
