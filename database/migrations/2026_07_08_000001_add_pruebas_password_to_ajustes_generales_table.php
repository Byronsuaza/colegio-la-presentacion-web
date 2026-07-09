<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ajustes_generales', function (Blueprint $table) {
            $table->string('pruebas_diagnosticas_password')->nullable()->after('syscolegios_url');
        });
    }

    public function down(): void
    {
        Schema::table('ajustes_generales', function (Blueprint $table) {
            $table->dropColumn('pruebas_diagnosticas_password');
        });
    }
};
