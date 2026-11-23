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
        Schema::create('carrito_items', function (Blueprint $table) {
            $table->id('id_item');
            $table->foreignId('id_usuario')
                ->constrained('usuarios', 'id_usuario')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('id_producto')
                ->constrained('productos', 'id_producto')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->integer('cantidad')->default(1);
            $table->text('personalizacion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrito_items');
    }
};
