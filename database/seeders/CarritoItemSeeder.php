<?php

namespace Database\Seeders;

use App\Models\CarritoItem;
use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class CarritoItemSeeder extends Seeder
{
    public function run(): void
    {
        $sofia = Usuario::where('correo', 'sofia.cliente@correo.com')->first();
        $cupcakes = Producto::where('nombre', 'Caja de 6 Cupcakes Red Velvet')->first();
        $galletas = Producto::where('nombre', 'Galletas Chispas de Chocolate')->first();

        if ($sofia && $cupcakes && $galletas) {
            CarritoItem::firstOrCreate(
                [
                    'id_usuario' => $sofia->id_usuario,
                    'id_producto' => $cupcakes->id_producto,
                ],
                [
                    'cantidad' => 1,
                    'personalizacion' => null,
                ]
            );

            CarritoItem::firstOrCreate(
                [
                    'id_usuario' => $sofia->id_usuario,
                    'id_producto' => $galletas->id_producto,
                ],
                [
                    'cantidad' => 2,
                    'personalizacion' => 'Sin nueces',
                ]
            );
        }
    }
}