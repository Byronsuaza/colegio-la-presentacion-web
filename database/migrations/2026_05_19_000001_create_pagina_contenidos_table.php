<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pagina_contenidos', function (Blueprint $table) {
            $table->id();
            $table->string('seccion');
            $table->string('base');
            $table->string('slug');
            $table->string('titulo');
            $table->string('subtitulo')->nullable();
            $table->string('imagen')->nullable();
            $table->string('url_externa')->nullable();
            $table->longText('contenido')->nullable();
            $table->json('enlaces')->nullable();
            $table->boolean('publicada')->default(true);
            $table->timestamps();

            $table->unique(['base', 'slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pagina_contenidos');
    }
};
