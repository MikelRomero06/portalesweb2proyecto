<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetallePedido;
use Illuminate\Http\Request;

class DetallePedidoController extends Controller
{
    public function index()
    {
        return response()->json(DetallePedido::with(['pedido', 'producto'])->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_pedido' => 'required|exists:pedidos,id_pedido',
            'id_producto' => 'required|exists:productos,id_producto',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0.01',
            'subtotal' => 'required|numeric|min:0.01',
            'sabor' => 'nullable|string|max:50',
            'tamano' => 'nullable|string|max:30',
            'mensaje_pastel' => 'nullable|string|max:100',
            'detalles_especiales' => 'nullable|string',
        ]);

        $detalle = DetallePedido::create($data);

        return response()->json($detalle->load('producto'), 201);
    }

    public function show($id)
    {
        return response()->json(DetallePedido::with(['pedido', 'producto'])->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $detalle = DetallePedido::findOrFail($id);

        $data = $request->validate([
            'cantidad' => 'sometimes|integer|min:1',
            'sabor' => 'nullable|string|max:50',
            'tamano' => 'nullable|string|max:30',
            'mensaje_pastel' => 'nullable|string|max:100',
            'detalles_especiales' => 'nullable|string',
        ]);

        $detalle->update($data);

        return response()->json($detalle->load('producto'));
    }

    public function destroy($id)
    {
        DetallePedido::findOrFail($id)->delete();

        return response()->json(['message' => 'Detalle eliminado']);
    }
}