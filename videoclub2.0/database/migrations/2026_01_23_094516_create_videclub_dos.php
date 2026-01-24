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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->year('year', 8);
            $table->string('director', 64);
            $table->string('poster')->nullable();
            $table->boolean('rented')->default(false);
            $table->text('synopsis');
            //Clave fóranea para asignar películas a usuarios
            //Si no tiene usuario asignado será null
            //No se puede eliminar un usuario si tiene películas asignadas
            $table->foreignId('id_usuario')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
