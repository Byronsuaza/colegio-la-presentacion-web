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
        Schema::create('seccions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique(); // preescolar, primaria, bachillerato
            $table->string('titulo');
            $table->text('descripcion_corta');
            $table->text('descripcion_completa')->nullable();
            $table->string('imagen_hero')->nullable();
            $table->json('estadisticas')->nullable(); // {estudiantes: 500, docentes: 20, ...}
            $table->json('objetivos')->nullable(); // array of objectives
            $table->json('caracteristicas')->nullable(); // array of features with icon
            $table->json('programas')->nullable(); // array of programs
            $table->json('grados')->nullable(); // array of grades
            $table->json('galeria')->nullable(); // array of images
            $table->string('coordinador_nombre')->nullable();
            $table->string('coordinador_correo')->nullable();
            $table->string('coordinador_telefono')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seccions');
    }
};
