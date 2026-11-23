<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';

    protected $fillable = [
        'id_categoria',
        'nombre',
        'descripcion',
        'precio',
        'imagen_url',
        'disponible',
        'es_personalizable',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'disponible' => 'boolean',
        'es_personalizable' => 'boolean',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

    public function carritoItems(): HasMany
    {
        return $this->hasMany(CarritoItem::class, 'id_producto', 'id_producto');
    }

    public function detallePedidos(): HasMany
    {
        return $this->hasMany(DetallePedido::class, 'id_producto', 'id_producto');
    }

    public function resenas(): HasMany
    {
        return $this->hasMany(Resena::class, 'id_producto', 'id_producto');
    }
}