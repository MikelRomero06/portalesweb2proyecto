<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $pastelesId = Categoria::where('nombre', 'pasteles')->value('id_categoria');
        $cupcakesId = Categoria::where('nombre', 'cupcakes')->value('id_categoria');
        $galletasId = Categoria::where('nombre', 'galletas')->value('id_categoria');
        $postresId = Categoria::where('nombre', 'postres')->value('id_categoria');

        $productos = [
            [
                'id_categoria' => $pastelesId,
                'nombre' => 'Pastel Personalizado de Celebración',
                'descripcion' => 'Pastel por encargo con elección de sabor, tamaño y mensaje.',
                'precio' => 450.00,
                'imagen_url' => 'https://example.com/imagenes/pastel-celebracion.jpg',
                'disponible' => true,
                'es_personalizable' => true,
            ],
            [
                'id_categoria' => $cupcakesId,
                'nombre' => 'Caja de 6 Cupcakes Red Velvet',
                'descripcion' => 'Cupcakes esponjosos con frosting de queso crema.',
                'precio' => 220.00,
                'imagen_url' => 'https://example.com/imagenes/cupcakes-red-velvet.jpg',
                'disponible' => true,
                'es_personalizable' => false,
            ],
            [
                'id_categoria' => $galletasId,
                'nombre' => 'Galletas Chispas de Chocolate',
                'descripcion' => 'Paquete de 6 galletas artesanales horneadas al día.',
                'precio' => 140.00,
                'imagen_url' => 'https://example.com/imagenes/galletas-chocolate.jpg',
                'disponible' => true,
                'es_personalizable' => false,
            ],
            [
                'id_categoria' => $postresId,
                'nombre' => 'Cheesecake de Maracuyá',
                'descripcion' => 'Porción individual con cobertura frutal.',
                'precio' => 95.00,
                'imagen_url' => 'https://example.com/imagenes/cheesecake-maracuya.jpg',
                'disponible' => true,
                'es_personalizable' => false,
            ],
        ];

        foreach ($productos as $producto) {
            Producto::firstOrCreate(['nombre' => $producto['nombre']], $producto);
        }
    }
}