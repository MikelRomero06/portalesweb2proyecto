<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Resena;
use Illuminate\Http\Request;

class ResenaController extends Controller
{
    public function index(Request $request)
    {
        $query = Resena::with(['usuario', 'producto']);

        if ($request->filled('id_producto')) {
            $query->where('id_producto', $request->id_producto);
        }

        return response()->json($query->orderByDesc('fecha')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'id_producto' => 'required|exists:productos,id_producto',
            'calificacion' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string|max:500',
        ]);

        $data['fecha'] = now();

        $resena = Resena::create($data);

        return response()->json($resena->load(['usuario', 'producto']), 201);
    }

    public function show($id)
    {
        return response()->json(Resena::with(['usuario', 'producto'])->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $resena = Resena::findOrFail($id);

        $data = $request->validate([
            'calificacion' => 'sometimes|integer|min:1|max:5',
            'comentario' => 'nullable|string|max:500',
        ]);

        $resena->update($data);

        return response()->json($resena->load(['usuario', 'producto']));
    }

    public function destroy($id)
    {
        Resena::findOrFail($id)->delete();

        return response()->json(['message' => 'Reseña eliminada']);
    }
}