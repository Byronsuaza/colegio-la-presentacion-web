<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeria_albums', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('slug')->unique();
            $table->string('categoria')->default('Actividades y Eventos');
            $table->date('fecha')->nullable();
            $table->string('portada')->nullable();
            $table->json('imagenes')->nullable();
            $table->json('videos')->nullable();
            $table->text('descripcion')->nullable();
            $table->unsignedInteger('orden')->default(0);
            $table->boolean('publicado')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeria_albums');
    }
};
