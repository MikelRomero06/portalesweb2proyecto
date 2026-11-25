<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarritoItem;
use Illuminate\Http\Request;

class CarritoItemController extends Controller
{
    public function index(Request $request)
    {
        $query = CarritoItem::with('producto');

        if ($request->filled('id_usuario')) {
            $query->where('id_usuario', $request->id_usuario);
        }

        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'id_producto' => 'required|exists:productos,id_producto',
            'cantidad' => 'required|integer|min:1',
            'personalizacion' => 'nullable|string',
        ]);

        $item = CarritoItem::create($data);

        return response()->json($item->load('producto'), 201);
    }

    public function show($id)
    {
        return response()->json(CarritoItem::with('producto')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $item = CarritoItem::findOrFail($id);

        $data = $request->validate([
            'cantidad' => 'sometimes|integer|min:1',
            'personalizacion' => 'nullable|string',
        ]);

        $item->update($data);

        return response()->json($item->load('producto'));
    }

    public function destroy($id)
    {
        CarritoItem::findOrFail($id)->delete();

        return response()->json(['message' => 'Producto quitado del carrito']);
    }
}