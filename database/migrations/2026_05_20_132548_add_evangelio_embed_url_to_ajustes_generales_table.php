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
            $table->text('evangelio_embed_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ajustes_generales', function (Blueprint $table) {
            $table->dropColumn('evangelio_embed_url');
        });
    }
};
