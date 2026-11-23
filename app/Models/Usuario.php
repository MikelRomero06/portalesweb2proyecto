<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'id_rol',
        'nombre',
        'correo',
        'contrasena_hash',
        'telefono',
        'direccion',
    ];

    protected $hidden = [
        'contrasena_hash',
    ];

    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol');
    }

    public function carritoItems(): HasMany
    {
        return $this->hasMany(CarritoItem::class, 'id_usuario', 'id_usuario');
    }

    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class, 'id_usuario', 'id_usuario');
    }

    public function resenas(): HasMany
    {
        return $this->hasMany(Resena::class, 'id_usuario', 'id_usuario');
    }
}