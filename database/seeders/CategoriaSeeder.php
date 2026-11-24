<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'pasteles', 'activa' => true],
            ['nombre' => 'cupcakes', 'activa' => true],
            ['nombre' => 'galletas', 'activa' => true],
            ['nombre' => 'postres', 'activa' => true],
        ];

        foreach ($categorias as $categoria) {
            Categoria::firstOrCreate(['nombre' => $categoria['nombre']], $categoria);
        }
    }
}