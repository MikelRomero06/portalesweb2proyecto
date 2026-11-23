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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->foreignId('id_rol')
                ->constrained('roles', 'id_rol')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->string('nombre', 100);
            $table->string('correo', 100)->unique();
            $table->string('contrasena_hash', 255);
            $table->string('telefono', 20)->nullable();
            $table->string('direccion', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
