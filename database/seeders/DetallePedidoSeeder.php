<?php

namespace Database\Seeders;

use App\Models\DetallePedido;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class DetallePedidoSeeder extends Seeder
{
    public function run(): void
    {
        $sofia = Usuario::where('correo', 'sofia.cliente@correo.com')->first();
        $carlos = Usuario::where('correo', 'carlos.cliente@correo.com')->first();

        $pastel = Producto::where('nombre', 'Pastel Personalizado de Celebración')->first();
        $cupcakes = Producto::where('nombre', 'Caja de 6 Cupcakes Red Velvet')->first();
        $galletas = Producto::where('nombre', 'Galletas Chispas de Chocolate')->first();

        $pedidoSofia = $sofia ? Pedido::where('id_usuario', $sofia->id_usuario)->first() : null;
        $pedidoCarlos = $carlos ? Pedido::where('id_usuario', $carlos->id_usuario)->first() : null;

        if ($pedidoSofia && $pastel && $cupcakes) {
            DetallePedido::firstOrCreate(
                [
                    'id_pedido' => $pedidoSofia->id_pedido,
                    'id_producto' => $pastel->id_producto,
                ],
                [
                    'cantidad' => 1,
                    'precio_unitario' => $pastel->precio,
                    'subtotal' => $pastel->precio * 1,
                    'sabor' => 'Chocolate',
                    'tamano' => 'Mediano (15 porciones)',
                    'mensaje_pastel' => 'Feliz Cumpleaños',
                    'detalles_especiales' => 'Decoración en tonos pastel',
                ]
            );

            DetallePedido::firstOrCreate(
                [
                    'id_pedido' => $pedidoSofia->id_pedido,
                    'id_producto' => $cupcakes->id_producto,
                ],
                [
                    'cantidad' => 1,
                    'precio_unitario' => $cupcakes->precio,
                    'subtotal' => $cupcakes->precio * 1,
                    'sabor' => null,
                    'tamano' => null,
                    'mensaje_pastel' => null,
                    'detalles_especiales' => null,
                ]
            );
        }

        if ($pedidoCarlos && $galletas) {
            DetallePedido::firstOrCreate(
                [
                    'id_pedido' => $pedidoCarlos->id_pedido,
                    'id_producto' => $galletas->id_producto,
                ],
                [
                    'cantidad' => 1,
                    'precio_unitario' => $galletas->precio,
                    'subtotal' => $galletas->precio * 1,
                    'sabor' => null,
                    'tamano' => null,
                    'mensaje_pastel' => null,
                    'detalles_especiales' => null,
                ]
            );
        }
    }
}