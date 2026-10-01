<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ajustes_generales', function (Blueprint $table) {
            $table->boolean('popup_habilitado')->default(true)->after('admisiones_boton_url');
            $table->string('popup_button_text')->default('Más información')->after('popup_habilitado');
            $table->string('popup_button_url')->default('/admisiones/inscripcion-en-linea')->after('popup_button_text');
            $table->string('popup_imagen')->nullable()->after('popup_button_url');
        });
    }

    public function down(): void
    {
        Schema::table('ajustes_generales', function (Blueprint $table) {
            $table->dropColumn([
                'popup_habilitado',
                'popup_button_text',
                'popup_button_url',
                'popup_imagen',
            ]);
        });
    }
};
