<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $primaryKey = 'id_pedido';

    protected $fillable = [
        'id_usuario',
        'direccion_entrega',
        'fecha_pedido',
        'fecha_entrega',
        'estado',
        'total',
    ];

    protected $casts = [
        'fecha_pedido' => 'datetime',
        'fecha_entrega' => 'datetime',
        'total' => 'decimal:2',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function detalles(): HasMany
    {
        return $this->hasMany(DetallePedido::class, 'id_pedido', 'id_pedido');
    }
}