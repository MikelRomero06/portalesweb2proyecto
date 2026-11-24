<?php

namespace Database\Seeders;

use App\Models\Pedido;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class PedidoSeeder extends Seeder
{
    public function run(): void
    {
        $sofia = Usuario::where('correo', 'sofia.cliente@correo.com')->first();
        $carlos = Usuario::where('correo', 'carlos.cliente@correo.com')->first();

        if ($sofia) {
            Pedido::firstOrCreate(
                [
                    'id_usuario' => $sofia->id_usuario,
                    'total' => 670.00,
                ],
                [
                    'direccion_entrega' => $sofia->direccion,
                    'fecha_pedido' => now()->subDays(2),
                    'fecha_entrega' => now()->addDays(2),
                    'estado' => 'en_preparacion',
                ]
            );
        }

        if ($carlos) {
            Pedido::firstOrCreate(
                [
                    'id_usuario' => $carlos->id_usuario,
                    'total' => 140.00,
                ],
                [
                    'direccion_entrega' => $carlos->direccion,
                    'fecha_pedido' => now()->subDays(5),
                    'fecha_entrega' => now()->subDays(3),
                    'estado' => 'entregado',
                ]
            );
        }
    }
}