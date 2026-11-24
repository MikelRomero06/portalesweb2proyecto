<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\Resena;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class ResenaSeeder extends Seeder
{
    public function run(): void
    {
        $carlos = Usuario::where('correo', 'carlos.cliente@correo.com')->first();
        $galletas = Producto::where('nombre', 'Galletas Chispas de Chocolate')->first();

        if ($carlos && $galletas) {
            Resena::firstOrCreate(
                [
                    'id_usuario' => $carlos->id_usuario,
                    'id_producto' => $galletas->id_producto,
                ],
                [
                    'calificacion' => 5,
                    'comentario' => 'Llegaron suaves y calientitas, muy buenas.',
                    'fecha' => now()->subDays(2),
                ]
            );
        }
    }
}