<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        return response()->json(Categoria::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:50|unique:categorias,nombre',
            'activa' => 'boolean',
        ]);

        $categoria = Categoria::create($data);

        return response()->json($categoria, 201);
    }

    public function show($id)
    {
        return response()->json(Categoria::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);

        $data = $request->validate([
            'nombre' => 'sometimes|string|max:50|unique:categorias,nombre,' . $categoria->id_categoria . ',id_categoria',
            'activa' => 'boolean',
        ]);

        $categoria->update($data);

        return response()->json($categoria);
    }

    public function destroy($id)
    {
        Categoria::findOrFail($id)->delete();

        return response()->json(['message' => 'Categoría eliminada']);
    }
}