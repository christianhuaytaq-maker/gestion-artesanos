<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artesano;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA; // 👈 Importante

class ArtesanoApiController extends Controller
{
    #[OA\Get(
        path: "/api/artesanos",
        summary: "Obtener todos los artesanos",
        tags: ["Artesanos"],
        responses: [
            new OA\Response(response: 200, description: "Lista de artesanos")
        ]
    )]
    public function index()
    {
        return response()->json(Artesano::all(), 200);
    }

    #[OA\Post(
        path: "/api/artesanos",
        summary: "Crear un nuevo artesano",
        tags: ["Artesanos"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["dni", "nombres", "apellidos"],
                properties: [
                    new OA\Property(property: "dni", type: "string", example: "12345678"),
                    new OA\Property(property: "nombres", type: "string", example: "Juan"),
                    new OA\Property(property: "apellidos", type: "string", example: "Perez"),
                    new OA\Property(property: "telefono", type: "string", example: "987654321"),
                    new OA\Property(property: "especialidad", type: "string", example: "Cerámica")
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: "Artesano creado")
        ]
    )]
    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|max:8|unique:artesanos',
            'nombres' => 'required',
            'apellidos' => 'required',
        ]);

        $artesano = Artesano::create($request->all());
        return response()->json($artesano, 201);
    }

    #[OA\Get(
        path: "/api/artesanos/{id}",
        summary: "Obtener un artesano por ID",
        tags: ["Artesanos"],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 200, description: "Datos del artesano"),
            new OA\Response(response: 404, description: "Artesano no encontrado")
        ]
    )]
    public function show(string $id)
    {
        $artesano = Artesano::find($id);
        if (!$artesano) {
            return response()->json(['message' => 'Artesano no encontrado'], 404);
        }
        return response()->json($artesano, 200);
    }

    #[OA\Put(
        path: "/api/artesanos/{id}",
        summary: "Actualizar un artesano",
        tags: ["Artesanos"],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "nombres", type: "string", example: "Juan Editado")
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: "Artesano actualizado")
        ]
    )]
    public function update(Request $request, string $id)
    {
        $artesano = Artesano::find($id);
        if (!$artesano) {
            return response()->json(['message' => 'Artesano no encontrado'], 404);
        }
        $artesano->update($request->all());
        return response()->json($artesano, 200);
    }

    #[OA\Delete(
        path: "/api/artesanos/{id}",
        summary: "Eliminar un artesano",
        tags: ["Artesanos"],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 200, description: "Artesano eliminado")
        ]
    )]
    public function destroy(string $id)
    {
        $artesano = Artesano::find($id);
        if (!$artesano) {
            return response()->json(['message' => 'Artesano no encontrado'], 404);
        }
        $artesano->delete();
        return response()->json(['message' => 'Artesano eliminado correctamente'], 200);
    }
}