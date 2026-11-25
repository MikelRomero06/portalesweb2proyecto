<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::with('categoria');

        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        if ($request->filled('id_categoria')) {
            $query->where('id_categoria', $request->id_categoria);
        }

        if ($request->filled('precio_min')) {
            $query->where('precio', '>=', $request->precio_min);
        }

        if ($request->filled('precio_max')) {
            $query->where('precio', '<=', $request->precio_max);
        }

        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0.01',
            'imagen_url' => 'nullable|string|max:255',
            'disponible' => 'boolean',
            'es_personalizable' => 'boolean',
        ]);

        $producto = Producto::create($data);

        return response()->json($producto->load('categoria'), 201);
    }

    public function show($id)
    {
        return response()->json(Producto::with(['categoria', 'resenas.usuario'])->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $data = $request->validate([
            'id_categoria' => 'sometimes|exists:categorias,id_categoria',
            'nombre' => 'sometimes|string|max:100',
            'descripcion' => 'nullable|string',
            'precio' => 'sometimes|numeric|min:0.01',
            'imagen_url' => 'nullable|string|max:255',
            'disponible' => 'boolean',
            'es_personalizable' => 'boolean',
        ]);

        $producto->update($data);

        return response()->json($producto->load('categoria'));
    }

    public function destroy($id)
    {
        Producto::findOrFail($id)->delete();

        return response()->json(['message' => 'Producto eliminado']);
    }
}