<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            $table->index('activo');
            $table->index('orden');
        });

        Schema::table('noticias', function (Blueprint $table) {
            $table->index('categoria');
            $table->index('destacada');
            $table->index('created_at');
        });

        Schema::table('pagina_contenidos', function (Blueprint $table) {
            $table->index('seccion');
            $table->index('publicada');
            $table->index('base');
        });

        Schema::table('eventos', function (Blueprint $table) {
            $table->index('fecha');
            $table->index('es_activo');
        });

        Schema::table('galeria_albums', function (Blueprint $table) {
            $table->index('publicado');
            $table->index('categoria');
            $table->index('orden');
            $table->index('fecha');
        });

        Schema::table('pqrs_submissions', function (Blueprint $table) {
            $table->index('estado');
            $table->index('tipo');
            $table->index('created_at');
        });

        Schema::table('areas_academicas', function (Blueprint $table) {
            $table->index('activa');
            $table->index('orden');
        });
    }

    public function down(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            $table->dropIndex(['activo']);
            $table->dropIndex(['orden']);
        });

        Schema::table('noticias', function (Blueprint $table) {
            $table->dropIndex(['categoria']);
            $table->dropIndex(['destacada']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('pagina_contenidos', function (Blueprint $table) {
            $table->dropIndex(['seccion']);
            $table->dropIndex(['publicada']);
            $table->dropIndex(['base']);
        });

        Schema::table('eventos', function (Blueprint $table) {
            $table->dropIndex(['fecha']);
            $table->dropIndex(['es_activo']);
        });

        Schema::table('galeria_albums', function (Blueprint $table) {
            $table->dropIndex(['publicado']);
            $table->dropIndex(['categoria']);
            $table->dropIndex(['orden']);
            $table->dropIndex(['fecha']);
        });

        Schema::table('pqrs_submissions', function (Blueprint $table) {
            $table->dropIndex(['estado']);
            $table->dropIndex(['tipo']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('areas_academicas', function (Blueprint $table) {
            $table->dropIndex(['activa']);
            $table->dropIndex(['orden']);
        });
    }
};