<?php

namespace Database\Seeders;

use App\Models\PaginaContenido;
use Illuminate\Database\Seeder;

class MenuAnteriorFaltantesSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            ['Gestión Académica', 'Horarios específicos', 'gestion-academica', 'atencion-a-padres', 'Atención a Padres'],
            ['Gestión Académica', 'Horarios específicos', 'gestion-academica', 'horario-preescolar-y-primaria', 'Horario Preescolar y Primaria'],
            ['Gestión Académica', 'Horarios específicos', 'gestion-academica', 'horario-bachillerato', 'Horario Bachillerato'],
            ['Gestión Académica', 'Horarios específicos', 'gestion-academica', 'horario-tarde', 'Horario Tarde'],
            ['Gestión Académica', 'Horarios específicos', 'gestion-academica', 'horario-nivelaciones', 'Horario Nivelaciones'],
            ['Gestión Académica', 'Horarios específicos', 'gestion-academica', 'horario-ludicas', 'Horario Lúdicas'],

            ['Calidad y Pastoral', 'Pastoral', 'calidad-y-pastoral', 'infografia-proyecto-de-pastoral', 'Infografía Proyecto de Pastoral'],
            ['Calidad y Pastoral', 'Pastoral', 'calidad-y-pastoral', 'infografia-plan-global-de-educacion-presentacion', 'Infografía Plan Global de Educación Presentación'],

            ['Gestión Comunitaria', 'Proyectos', 'gestion-comunitaria', 'proyectos-comunitarios-video', 'Proyectos comunitarios - Video'],
            ['Gestión Comunitaria', 'Proyectos', 'gestion-comunitaria', 'presentacion-de-proyectos', 'Presentación de Proyectos'],

            ['Gestión Comunitaria', 'Rutas de atención', 'gestion-comunitaria', 'embarazo-adolescente-temprana', 'Embarazo adolescente temprana'],
            ['Gestión Comunitaria', 'Rutas de atención', 'gestion-comunitaria', 'violencia-sexual', 'Violencia sexual'],
            ['Gestión Comunitaria', 'Rutas de atención', 'gestion-comunitaria', 'violencia-por-discriminacion', 'Violencia por discriminación'],
            ['Gestión Comunitaria', 'Rutas de atención', 'gestion-comunitaria', 'presunto-suicidio-consumado', 'Presunto suicidio consumado'],
            ['Gestión Comunitaria', 'Rutas de atención', 'gestion-comunitaria', 'agresion-y-acoso-escolar', 'Agresión y acoso escolar'],
            ['Gestión Comunitaria', 'Rutas de atención', 'gestion-comunitaria', 'presunto-consumo-spa', 'Presunto consumo SPA'],
            ['Gestión Comunitaria', 'Rutas de atención', 'gestion-comunitaria', 'ruta-atencion-integral-convivencia-escolar-colegio', 'Ruta de atención integral para la convivencia escolar Colegio'],

            ['Gestión Comunitaria', 'Kit de herramientas', 'gestion-comunitaria', 'suicidio-y-spa-familias', 'Suicidio y SPA familias'],
            ['Gestión Comunitaria', 'Kit de herramientas', 'gestion-comunitaria', 'ciberacoso-estudiantes', 'Ciberacoso estudiantes'],
            ['Gestión Comunitaria', 'Kit de herramientas', 'gestion-comunitaria', 'conducta-suicida-estudiantes', 'Conducta suicida estudiantes'],
            ['Gestión Comunitaria', 'Kit de herramientas', 'gestion-comunitaria', 'vbg-estudiantes', 'VBG estudiantes'],
            ['Gestión Comunitaria', 'Kit de herramientas', 'gestion-comunitaria', 'vbg-familias', 'VBG familias'],

            ['Servicios y Comunidad', 'Plataformas', 'servicios', 'correo-institucional', 'Correo institucional'],
            ['Servicios y Comunidad', 'Comunidad educativa', 'servicios', 'encuesta-satisfaccion', 'Encuesta Satisfacción'],
            ['Servicios y Comunidad', 'Comunidad educativa', 'servicios', 'evaluacion-actividades-eventos-estudiantes', 'Evaluación de actividades y/o eventos - Estudiantes'],
            ['Servicios y Comunidad', 'Comunidad educativa', 'servicios', 'evaluacion-de-desempeno', 'Evaluación de desempeño'],
        ];

        foreach ($pages as [$section, $subsection, $base, $slug, $title]) {
            PaginaContenido::firstOrCreate(
                [
                    'base' => $base,
                    'slug' => $slug,
                ],
                [
                    'seccion' => $section,
                    'subseccion' => $subsection,
                    'titulo' => $title,
                    'subtitulo' => 'Contenido migrado desde la estructura del menú anterior.',
                    'contenido' => '<p>Esta página fue creada para conservar la estructura del menú anterior. Puedes editarla desde el panel administrador y cargar documentos PDF, enlaces o contenido oficial.</p>',
                    'enlaces' => [],
                    'publicada' => true,
                ]
            );
        }
    }
}
