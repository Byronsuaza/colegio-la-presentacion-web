<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tabla de postulaciones a vacantes (Trabaja con Nosotros)
        if (! Schema::hasTable('postulaciones')) {
            Schema::create('postulaciones', function (Blueprint $table) {
                $table->id();
                $table->string('nombre_completo');
                $table->string('telefono', 50);
                $table->string('email');
                $table->string('cargo');
                $table->string('hoja_vida'); // Ruta privada en storage/app/private
                $table->string('estado')->default('Nueva'); // Nueva, En revisión, Preseleccionado, Descartado, Contratado
                $table->text('notas')->nullable();
                $table->timestamps();

                $table->index('estado');
                $table->index('created_at');
            });
        }

        // 2. Configuración de Talento Humano en Ajustes Generales
        Schema::table('ajustes_generales', function (Blueprint $table) {
            if (! Schema::hasColumn('ajustes_generales', 'email_talento_humano')) {
                $table->string('email_talento_humano')->nullable()->default('psicologa@colpresentacioneiva.edu.co')->after('email_pqrs');
            }
            if (! Schema::hasColumn('ajustes_generales', 'vacantes_disponibles')) {
                $table->json('vacantes_disponibles')->nullable()->after('email_talento_humano');
            }
        });

        DB::table('ajustes_generales')
            ->whereNull('email_talento_humano')
            ->update(['email_talento_humano' => 'psicologa@colpresentacioneiva.edu.co']);

        // 3. Crear la página "Trabaja con Nosotros" en Contacto → Comunicaciones
        $existe = DB::table('pagina_contenidos')
            ->where('base', 'comunicaciones-contacto')
            ->where('slug', 'trabaja-con-nosotros')
            ->exists();

        if (! $existe) {
            DB::table('pagina_contenidos')->insert([
                'seccion' => 'Comunicaciones & Contacto',
                'subseccion' => 'Comunicaciones',
                'base' => 'comunicaciones-contacto',
                'slug' => 'trabaja-con-nosotros',
                'titulo' => 'Trabaja con Nosotros',
                'subtitulo' => 'Únete a nuestro equipo y forma parte de la familia Presentación.',
                'contenido' => '<p>En el Colegio de La Presentación de Neiva buscamos personas comprometidas con la formación integral de niños, niñas y jóvenes, que se identifiquen con los valores de <strong>Piedad, Sencillez y Trabajo</strong> y con el carisma de Marie Poussepin.</p><p>Si deseas formar parte de nuestro equipo, diligencia el siguiente formulario y adjunta tu hoja de vida. El área de Talento Humano revisará tu postulación y se comunicará contigo si tu perfil se ajusta a nuestras vacantes.</p>',
                'enlaces' => json_encode([]),
                'publicada' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postulaciones');

        Schema::table('ajustes_generales', function (Blueprint $table) {
            foreach (['vacantes_disponibles', 'email_talento_humano'] as $col) {
                if (Schema::hasColumn('ajustes_generales', $col)) {
                    $table->dropColumn($col);
                }
            }
        });

        DB::table('pagina_contenidos')
            ->where('base', 'comunicaciones-contacto')
            ->where('slug', 'trabaja-con-nosotros')
            ->delete();
    }
};
