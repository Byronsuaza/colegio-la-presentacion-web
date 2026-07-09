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
        Schema::table('ajustes_generales', function (Blueprint $table) {
            $table->string('pago_en_linea_url')->nullable()->after('evangelio_embed_url');
            $table->string('syscolegios_url')->nullable()->after('pago_en_linea_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ajustes_generales', function (Blueprint $table) {
            $table->dropColumn(['pago_en_linea_url', 'syscolegios_url']);
        });
    }
};
