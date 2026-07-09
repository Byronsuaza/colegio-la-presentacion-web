<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ajustes_generales', function (Blueprint $table) {
            $table->string('admisiones_anio')->default('2027')->after('youtube');
            $table->string('admisiones_titulo')->nullable()->after('admisiones_anio');
            $table->text('admisiones_descripcion')->nullable()->after('admisiones_titulo');
            $table->string('admisiones_boton_texto')->default('Inscríbete Ahora')->after('admisiones_descripcion');
            $table->string('admisiones_boton_url')->default('/admisiones/inscripcion-en-linea')->after('admisiones_boton_texto');
            $table->string('admisiones_llamada_texto')->nullable()->after('admisiones_boton_url');
        });
    }

    public function down(): void
    {
        Schema::table('ajustes_generales', function (Blueprint $table) {
            $table->dropColumn([
                'admisiones_anio',
                'admisiones_titulo',
                'admisiones_descripcion',
                'admisiones_boton_texto',
                'admisiones_boton_url',
                'admisiones_llamada_texto',
            ]);
        });
    }
};
