<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\AjusteGeneral;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasColumn('ajustes_generales', 'footer_certificaciones')) {
            Schema::table('ajustes_generales', function (Blueprint $table) {
                $table->json('footer_certificaciones')->nullable()->after('footer_lema');
            });
        }

        // Asegurar que las imágenes por defecto estén en storage/app/public/certificaciones
        $destDir = storage_path('app/public/certificaciones');
        if (! file_exists($destDir)) {
            @mkdir($destDir, 0755, true);
        }
        $sourceDir = public_path('images/certificaciones');
        if (file_exists($sourceDir)) {
            foreach (['icontec-iqnet.png', 'icontec-iso9001.png', 'icontec-iqnet-9001.png', 'iqnet.png'] as $file) {
                $src = $sourceDir . DIRECTORY_SEPARATOR . $file;
                $dst = $destDir . DIRECTORY_SEPARATOR . $file;
                if (file_exists($src) && ! file_exists($dst)) {
                    @copy($src, $dst);
                }
            }
        }

        // Pre-poblar los sellos actuales de Icontec para que aparezcan listos en el panel admin
        $ajuste = AjusteGeneral::first();
        if ($ajuste && empty($ajuste->footer_certificaciones)) {
            $ajuste->footer_certificaciones = [
                [
                    'imagen' => 'certificaciones/icontec-iqnet.png',
                    'titulo' => 'Certificación Icontec ISO 21001 e IQNet - SGOE-CER950417',
                    'alt' => 'Certificación Icontec ISO 21001 e IQNet',
                    'url' => null,
                ],
                [
                    'imagen' => 'certificaciones/icontec-iso9001.png',
                    'titulo' => 'Certificación Icontec ISO 9001',
                    'alt' => 'Certificación Icontec ISO 9001',
                    'url' => null,
                ],
            ];
            $ajuste->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('ajustes_generales', 'footer_certificaciones')) {
            Schema::table('ajustes_generales', function (Blueprint $table) {
                $table->dropColumn('footer_certificaciones');
            });
        }
    }
};
