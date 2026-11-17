<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artesano;
use App\Events\ArtesanoCreado; // <-- IMPORTAMOS EL EVENTO

class ArtesanoController extends Controller
{
    public function index(Request $request)
    {
        $query = Artesano::query();

        // Búsqueda
        if ($request->has('buscar') && $request->buscar != '') {
            $query->where(function($q) use ($request) {
                $q->where('nombres', 'LIKE', '%' . $request->buscar . '%')
                  ->orWhere('apellidos', 'LIKE', '%' . $request->buscar . '%')
                  ->orWhere('dni', 'LIKE', '%' . $request->buscar . '%');
            });
        }

        // Filtro por especialidad
        if ($request->has('especialidad') && $request->especialidad != '') {
            $query->where('especialidad', $request->especialidad);
        }

        $artesanos = $query->get();
        $especialidades = Artesano::select('especialidad')->distinct()->pluck('especialidad');

        return view('artesanos.index', compact('artesanos', 'especialidades'));
    }

    // Formulario para crear
    public function create()
    {
        return view('artesanos.create');
    }

    // Guardar en base de datos
    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|unique:artesanos,dni|max:8',
            'nombres' => 'required|max:100',
            'apellidos' => 'required|max:100',
            'telefono' => 'nullable|max:15',
            'direccion' => 'nullable|max:200',
            'especialidad' => 'nullable|max:100',
        ]);

        // 1. Guardamos al artesano y lo asignamos a una variable
        $artesano = Artesano::create($request->all());

        // 2. DISPARAMOS EL EVENTO CON LOS DATOS COMPLETOS PARA LA TV
        $nuevoTotal = Artesano::count();
        $nombreCompleto = $artesano->nombres . ' ' . $artesano->apellidos;
        $especialidad = $artesano->especialidad ?? 'Nuevo Artesano';

        // Enviamos el total, el nombre y la especialidad
        ArtesanoCreado::dispatch($nuevoTotal, $nombreCompleto, $especialidad);
        // -----------------------------------------------------------

        return redirect()->route('artesanos.index')->with('success', 'Artesano agregado correctamente');
    }

    // Formulario para editar
    public function edit($id)
    {
        $artesano = Artesano::findOrFail($id);
        return view('artesanos.edit', compact('artesano'));
    }

    // Actualizar
    public function update(Request $request, $id)
    {
        $request->validate([
            'dni' => 'required|max:8|unique:artesanos,dni,' . $id,
            'nombres' => 'required|max:100',
            'apellidos' => 'required|max:100',
            'telefono' => 'nullable|max:15',
            'direccion' => 'nullable|max:200',
            'especialidad' => 'nullable|max:100',
        ]);

        $artesano = Artesano::findOrFail($id);
        $artesano->update($request->all());

        return redirect()->route('artesanos.index')->with('success', 'Artesano actualizado correctamente');
    }

    // Eliminar
    public function destroy($id)
    {
        $artesano = Artesano::findOrFail($id);
        $artesano->delete();

        return redirect()->route('artesanos.index')->with('success', 'Artesano eliminado correctamente');
    }
}
