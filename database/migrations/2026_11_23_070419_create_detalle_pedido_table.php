<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detalle_pedido', function (Blueprint $table) {
            $table->id('id_detalle');
            $table->foreignId('id_pedido')
                ->constrained('pedidos', 'id_pedido')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('id_producto')
                ->constrained('productos', 'id_producto')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->string('sabor', 50)->nullable();
            $table->string('tamano', 30)->nullable();
            $table->string('mensaje_pastel', 100)->nullable();
            $table->text('detalles_especiales')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_pedido');
    }
};
