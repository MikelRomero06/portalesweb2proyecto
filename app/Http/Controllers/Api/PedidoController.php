<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetallePedido;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function index(Request $request)
    {
        $query = Pedido::with(['usuario', 'detalles.producto']);

        if ($request->filled('id_usuario')) {
            $query->where('id_usuario', $request->id_usuario);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        return response()->json($query->orderByDesc('fecha_pedido')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'direccion_entrega' => 'nullable|string|max:255',
            'fecha_entrega' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.id_producto' => 'required|exists:productos,id_producto',
            'items.*.cantidad' => 'required|integer|min:1',
            'items.*.sabor' => 'nullable|string|max:50',
            'items.*.tamano' => 'nullable|string|max:30',
            'items.*.mensaje_pastel' => 'nullable|string|max:100',
            'items.*.detalles_especiales' => 'nullable|string',
        ]);

        return DB::transaction(function () use ($data) {
            $total = 0;
            $lineas = [];

            foreach ($data['items'] as $item) {
                $producto = Producto::findOrFail($item['id_producto']);
                $precioUnitario = $producto->precio;
                $subtotal = $precioUnitario * $item['cantidad'];
                $total += $subtotal;

                $lineas[] = [
                    'id_producto' => $producto->id_producto,
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $precioUnitario,
                    'subtotal' => $subtotal,
                    'sabor' => $item['sabor'] ?? null,
                    'tamano' => $item['tamano'] ?? null,
                    'mensaje_pastel' => $item['mensaje_pastel'] ?? null,
                    'detalles_especiales' => $item['detalles_especiales'] ?? null,
                ];
            }

            $pedido = Pedido::create([
                'id_usuario' => $data['id_usuario'],
                'direccion_entrega' => $data['direccion_entrega'] ?? null,
                'fecha_pedido' => now(),
                'fecha_entrega' => $data['fecha_entrega'],
                'estado' => 'pendiente',
                'total' => $total,
            ]);

            foreach ($lineas as $linea) {
                $linea['id_pedido'] = $pedido->id_pedido;
                DetallePedido::create($linea);
            }

            return response()->json($pedido->load('detalles.producto'), 201);
        });
    }

    public function show($id)
    {
        return response()->json(Pedido::with(['usuario', 'detalles.producto'])->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);

        $data = $request->validate([
            'estado' => 'required|in:pendiente,en_preparacion,listo,entregado,cancelado',
            'direccion_entrega' => 'nullable|string|max:255',
            'fecha_entrega' => 'sometimes|date',
        ]);

        $pedido->update($data);

        return response()->json($pedido->load('detalles.producto'));
    }

    public function destroy($id)
    {
        Pedido::findOrFail($id)->delete();

        return response()->json(['message' => 'Pedido eliminado']);
    }

    public function reportes(Request $request)
    {
        $ventasQuery = Pedido::where('estado', '!=', 'cancelado');

        if ($request->filled('desde')) {
            $ventasQuery->whereDate('fecha_pedido', '>=', $request->desde);
        }

        if ($request->filled('hasta')) {
            $ventasQuery->whereDate('fecha_pedido', '<=', $request->hasta);
        }

        $totalVentas = $ventasQuery->sum('total');

        $masVendidos = DetallePedido::select(
            'id_producto',
            DB::raw('SUM(cantidad) as total_unidades'),
            DB::raw('SUM(subtotal) as total_ingresos')
        )
            ->with('producto')
            ->groupBy('id_producto')
            ->orderByDesc('total_unidades')
            ->take(5)
            ->get();

        $pedidosPendientes = Pedido::where('estado', 'pendiente')->count();

        return response()->json([
            'total_ventas' => (float) $totalVentas,
            'pedidos_pendientes' => $pedidosPendientes,
            'productos_mas_vendidos' => $masVendidos,
        ]);
    }
}