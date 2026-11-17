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
        if ($request->has('buscar') && $request->buscar != '') {
            $query->where('nombre', 'LIKE', '%' . $request->buscar . '%');
        }
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
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif,svg|max:10240',
        ]);

        $data = $request->except('imagen');

        // Guardamos el producto primero
        $producto = Producto::create($data);

        // Si se subió una imagen, la procesamos y actualizamos el producto
        if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
            $imagen = $request->file('imagen');
            $imagenBase64 = base64_encode(file_get_contents($imagen->getRealPath()));
            $mime = $imagen->getClientMimeType();
            $producto->imagen = 'data:' . $mime . ';base64,' . $imagenBase64;
            $producto->save();
        }

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
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif,svg|max:10240',
        ]);

        $producto = Producto::findOrFail($id);

        // Actualizamos los datos excepto la imagen
        $producto->update($request->except('imagen'));

        // Si se sube una nueva imagen, la convertimos a Base64
        if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
            $imagen = $request->file('imagen');
            $imagenBase64 = base64_encode(file_get_contents($imagen->getRealPath()));
            $mime = $imagen->getClientMimeType();
            $producto->imagen = 'data:' . $mime . ';base64,' . $imagenBase64;
            $producto->save();
        }

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
    }

    public function catalogo()
    {
        $productos = Producto::with('artesano')->get();
        return view('catalogo', compact('productos'));
    }
}
