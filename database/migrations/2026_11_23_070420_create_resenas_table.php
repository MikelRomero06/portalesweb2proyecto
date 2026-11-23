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
        Schema::create('resenas', function (Blueprint $table) {
            $table->id('id_resena');
            $table->foreignId('id_usuario')
                ->constrained('usuarios', 'id_usuario')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('id_producto')
                ->constrained('productos', 'id_producto')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->unsignedTinyInteger('calificacion');
            $table->string('comentario', 500)->nullable();
            $table->dateTime('fecha')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resenas');
    }
};
