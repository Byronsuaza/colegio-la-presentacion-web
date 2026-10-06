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
            // Admisiones extras (pasos y viñetas)
            $table->json('admisiones_pasos')->nullable()->after('admisiones_llamada_texto');
            $table->json('admisiones_tags')->nullable()->after('admisiones_pasos');

            // Propuesta de Valor / Identidad
            $table->string('valor_titulo')->nullable()->after('admisiones_tags');
            $table->text('valor_subtitulo')->nullable()->after('valor_titulo');
            $table->text('valor_frase')->nullable()->after('valor_subtitulo');
            $table->string('valor_frase_autor')->nullable()->after('valor_frase');
            $table->json('valor_pilares')->nullable()->after('valor_frase_autor');

            // Oferta Educativa
            $table->string('oferta_titulo')->nullable()->after('valor_pilares');
            $table->text('oferta_subtitulo')->nullable()->after('oferta_titulo');
            $table->json('oferta_niveles')->nullable()->after('oferta_subtitulo');

            // Footer
            $table->string('footer_anio_fundacion')->nullable()->after('oferta_niveles');
            $table->string('footer_lema')->nullable()->after('footer_anio_fundacion');
        });

        // Poblar valores por defecto para que el administrador los encuentre listos para editar
        \Illuminate\Support\Facades\DB::table('ajustes_generales')->where('id', 1)->update([
            'admisiones_tags' => json_encode(['Cupos disponibles', 'Proceso 100% online']),
            'admisiones_pasos' => json_encode([
                [
                    'num' => '01',
                    'titulo' => 'Solicitud de Información',
                    'desc' => 'Completa el formulario en línea o visítanos en nuestra sede. Un asesor de admisiones te contactará para orientarte.',
                ],
                [
                    'num' => '02',
                    'titulo' => 'Entrevista Familiar',
                    'desc' => 'Reunión con coordinación académica para conocer el proyecto de vida familiar y los valores que compartimos.',
                ],
                [
                    'num' => '03',
                    'titulo' => 'Prueba de Nivelación',
                    'desc' => 'Evaluación diagnóstica adaptada a la edad del estudiante para garantizar una transición académica exitosa.',
                ],
                [
                    'num' => '04',
                    'titulo' => 'Matrícula & Bienvenida',
                    'desc' => 'Formalización del proceso, entrega de documentos y bienvenida a la familia de La Presentación.',
                ],
            ]),
            'valor_titulo' => 'Una Educación que Transforma Vidas',
            'valor_subtitulo' => 'Cada estudiante es el centro de nuestro proceso educativo. Formamos personas íntegras, comprometidas con la sociedad y preparadas para los desafíos del mundo contemporáneo.',
            'valor_frase' => 'La verdadera educación es aquella que forma el corazón, ilumina la mente y fortalece el espíritu para servir a los demás.',
            'valor_frase_autor' => '— Inspirados en el Carisma de Marie Poussepin',
            'valor_pilares' => json_encode([
                [
                    'titulo' => 'Excelencia Académica',
                    'descripcion' => 'Comprometidos con los más altos estándares educativos. Resultados ICFES Superior, metodologías activas y docentes especializados forman estudiantes de élite intelectual.',
                ],
                [
                    'titulo' => 'Formación en Valores',
                    'descripcion' => 'Inspirados en el carisma dominico de Marie Poussepin, cultivamos la fe, la solidaridad, la honestidad y el compromiso social como pilares del desarrollo humano integral.',
                ],
                [
                    'titulo' => 'Innovación Pedagógica',
                    'descripcion' => 'Integramos tecnología de vanguardia, pensamiento crítico y aprendizaje basado en proyectos para preparar ciudadanos creativos y competentes en el siglo XXI.',
                ],
            ]),
            'oferta_titulo' => 'Nuestra Oferta Educativa',
            'oferta_subtitulo' => 'Tres ciclos formativos diseñados para acompañar al estudiante en cada etapa de su desarrollo, con metodologías diferenciadas y propósitos claros.',
            'oferta_niveles' => json_encode([
                [
                    'nivel' => 'Preescolar',
                    'grados' => 'Jardín · Transición',
                    'descripcion' => 'Ambientes lúdicos y afectivos que estimulan el desarrollo integral de la primera infancia. Potenciamos la creatividad, la socialización y el amor por el aprendizaje desde los primeros años.',
                    'features' => ['Aulas Montessori', 'Psicorientación', 'Inglés desde los 3 años'],
                    'enlace' => '/nuestra-institucion/seccion-preescolar',
                    'imagen' => 'oferta-educativa/preescolar.png',
                ],
                [
                    'nivel' => 'Básica Primaria',
                    'grados' => 'Grados 1° — 5°',
                    'descripcion' => 'Consolidamos las competencias fundamentales con una metodología activa e interdisciplinar. Formamos pensadores críticos, lectores apasionados y ciudadanos comprometidos con su entorno.',
                    'features' => ['Bilingüismo', 'Laboratorios Stem', 'Arte y Deporte'],
                    'enlace' => '/nuestra-institucion/seccion-primaria',
                    'imagen' => 'oferta-educativa/primaria.png',
                ],
                [
                    'nivel' => 'Bachillerato',
                    'grados' => 'Grados 6° — 11°',
                    'descripcion' => 'Preparación académica de élite orientada al ingreso a universidades de prestigio. Profundizamos en ciencias, humanidades y tecnología con énfasis en liderazgo y emprendimiento social.',
                    'features' => ['Preuniversitario', 'Proyecto de Vida', 'ICFES Superior'],
                    'enlace' => '/nuestra-institucion/seccion-bachillerato',
                    'imagen' => 'oferta-educativa/bachillerato.png',
                ],
            ]),
            'footer_anio_fundacion' => '1882',
            'footer_lema' => 'inspiradas en el carisma de Marie Poussepin.',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ajustes_generales', function (Blueprint $table) {
            $table->dropColumn([
                'admisiones_pasos',
                'admisiones_tags',
                'valor_titulo',
                'valor_subtitulo',
                'valor_frase',
                'valor_frase_autor',
                'valor_pilares',
                'oferta_titulo',
                'oferta_subtitulo',
                'oferta_niveles',
                'footer_anio_fundacion',
                'footer_lema',
            ]);
        });
    }
};
