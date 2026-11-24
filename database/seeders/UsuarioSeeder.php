<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        $adminRolId = Rol::where('nombre', 'administrador')->value('id_rol');
        $clienteRolId = Rol::where('nombre', 'cliente')->value('id_rol');

        $usuarios = [
            [
                'id_rol' => $adminRolId,
                'nombre' => 'Admin Enchante',
                'correo' => 'admin@enchantebakery.com',
                'contrasena_hash' => Hash::make('Admin1234*'),
                'telefono' => '9999-0001',
                'direccion' => 'Local Principal Enchante Bakery',
            ],
            [
                'id_rol' => $clienteRolId,
                'nombre' => 'Sofía Martínez',
                'correo' => 'sofia.cliente@correo.com',
                'contrasena_hash' => Hash::make('Cliente1234*'),
                'telefono' => '9888-1122',
                'direccion' => 'Col. El Centro, Calle Principal #12',
            ],
            [
                'id_rol' => $clienteRolId,
                'nombre' => 'Carlos Mendoza',
                'correo' => 'carlos.cliente@correo.com',
                'contrasena_hash' => Hash::make('Cliente1234*'),
                'telefono' => '9777-3344',
                'direccion' => 'Residencial Las Flores, Casa #8',
            ],
        ];

        foreach ($usuarios as $usuario) {
            Usuario::firstOrCreate(['correo' => $usuario['correo']], $usuario);
        }
    }
}