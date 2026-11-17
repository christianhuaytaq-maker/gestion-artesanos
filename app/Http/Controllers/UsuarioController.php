<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $query = Usuario::query();

        if ($request->has('buscar') && $request->buscar != '') {
            $query->where(function($q) use ($request) {
                $q->where('nombre', 'LIKE', '%' . $request->buscar . '%')
                  ->orWhere('email', 'LIKE', '%' . $request->buscar . '%');
            });
        }

        if ($request->has('rol') && $request->rol != '') {
            $query->where('rol', $request->rol);
        }

        $usuarios = $query->get();

        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'email' => 'required|email|unique:usuarios,email|max:150',
            'password' => 'required|min:6',
            'rol' => 'required|in:administrador,usuario',
        ]);

        Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario agregado correctamente');
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'email' => 'required|email|max:150|unique:usuarios,email,' . $id,
            'password' => 'nullable|min:6',
            'rol' => 'required|in:administrador,usuario',
        ]);

        $usuario = Usuario::findOrFail($id);
        $usuario->nombre = $request->nombre;
        $usuario->email = $request->email;
        $usuario->rol = $request->rol;

        if ($request->password) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente');
    }

    // NUEVA FUNCIÓN: Enviar correo de recuperación al usuario
    public function enviarRecuperacion($id)
    {
        $usuario = Usuario::findOrFail($id);

        try {
            // Laravel busca al usuario por su email y envía el correo de recuperación
            $status = Password::sendResetLink(['email' => $usuario->email]);

            if ($status == Password::RESET_LINK_SENT) {
                return redirect()->route('usuarios.index')->with('success', 'Se ha enviado un correo de recuperación a: ' . $usuario->email);
            } else {
                return redirect()->route('usuarios.index')->with('error', 'No se pudo enviar el correo. Inténtalo de nuevo.');
            }
        } catch (\Exception $e) {
            return redirect()->route('usuarios.index')->with('error', 'Error al enviar el correo: ' . $e->getMessage());
        }
    }
}
