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
        Schema::create('pqrs_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('tipo'); // Petición, Queja, Reclamo, Sugerencia, Felicitación
            $table->string('nombre_completo');
            $table->string('tipo_documento'); // CC, TI, CE, RC, etc.
            $table->string('documento');
            $table->string('email');
            $table->string('telefono');
            $table->string('relacion'); // Padre de familia, Estudiante, etc.
            $table->string('estudiante_nombre')->nullable();
            $table->string('estudiante_grado')->nullable();
            $table->text('mensaje');
            $table->string('adjunto')->nullable(); // Ruta del archivo adjunto
            $table->string('estado')->default('Pendiente'); // Pendiente, En revisión, Respondido, Archivado
            $table->text('respuesta')->nullable();
            $table->timestamp('respondido_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pqrs_submissions');
    }
};
