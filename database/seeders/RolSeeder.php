<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['nombre' => 'administrador'],
            ['nombre' => 'cliente'],
        ];

        foreach ($roles as $rol) {
            Rol::firstOrCreate(['nombre' => $rol['nombre']], $rol);
        }
    }
}