<?php

namespace Database\Seeders;

use App\Models\PaginaContenido;
use Illuminate\Database\Seeder;

class ContenidoMenuAnteriorSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            'gestion-academica/atencion-a-padres' => [
                'subtitulo' => 'Horario de atencion a padres de familia.',
                'contenido' => '<p>Consulta el horario dispuesto por la institucion para la atencion a padres de familia.</p>',
                'label' => 'Ver horario de atencion a padres',
                'url' => 'https://drive.google.com/file/d/0B2KJSlc0hVL-U18xSFZsdWtuQlk/view?usp=sharing&resourcekey=0-GcuPmA7kwJnqrleXDrF3Wg',
            ],
            'gestion-academica/horario-preescolar-y-primaria' => [
                'subtitulo' => 'Horario academico para preescolar y primaria.',
                'contenido' => '<p>Consulta el horario correspondiente a los niveles de preescolar y primaria.</p>',
                'label' => 'Ver horario de preescolar y primaria',
                'url' => 'https://drive.google.com/file/d/0B2KJSlc0hVL-RWtIZy01dkM3cDA/view?usp=sharing&resourcekey=0-uzfYA6Of6Wb0ZsEx4uPqcw',
            ],
            'gestion-academica/horario-bachillerato' => [
                'subtitulo' => 'Horario academico para bachillerato.',
                'contenido' => '<p>Consulta el horario correspondiente a los grados de bachillerato.</p>',
                'label' => 'Ver horario de bachillerato',
                'url' => 'https://drive.google.com/file/d/0B2KJSlc0hVL-WlZxekx3cDdMNjQ/view?usp=sharing&resourcekey=0-xWQZ4C5T14LqbeWb-oUjEg',
            ],
            'gestion-academica/horario-tarde' => [
                'subtitulo' => 'Horario de la jornada de la tarde.',
                'contenido' => '<p>Consulta el horario establecido para las actividades de la jornada de la tarde.</p>',
                'label' => 'Ver horario tarde',
                'url' => 'https://drive.google.com/file/d/0B2KJSlc0hVL-V2VUV0czWEdCRzQ/view?usp=sharing&resourcekey=0-IO1nocwX63HQtM8nwzPH1Q',
            ],
            'gestion-academica/horario-nivelaciones' => [
                'subtitulo' => 'Horario de nivelaciones academicas.',
                'contenido' => '<p>Consulta el horario destinado a los procesos de nivelacion academica.</p>',
                'label' => 'Ver horario de nivelaciones',
                'url' => 'https://drive.google.com/file/d/0B2KJSlc0hVL-TExScV95ai1OTzQ/view?usp=sharing&resourcekey=0-WnagTpYBYkwW1oo4-D2-GQ',
            ],
            'gestion-academica/horario-ludicas' => [
                'subtitulo' => 'Horario de actividades ludicas.',
                'contenido' => '<p>Consulta el horario de las actividades ludicas ofrecidas por la institucion.</p>',
                'label' => 'Ver horario de ludicas',
                'url' => 'https://drive.google.com/open?id=1ZmW6BqFJ4ghsfH7FXdtBAQZ2et1__ZmJ',
            ],
            'calidad-y-pastoral/infografia-proyecto-de-pastoral' => [
                'subtitulo' => 'Infografia del proyecto de pastoral institucional.',
                'contenido' => '<p>Accede a la infografia del Proyecto de Pastoral, recurso de apoyo para conocer sus lineas de accion y orientaciones.</p>',
                'label' => 'Ver infografia del Proyecto de Pastoral',
                'url' => 'https://drive.google.com/file/d/1wZvhULBagcnAzKoIro-vFABRzyYbPsk4/view?usp=share_link',
            ],
            'calidad-y-pastoral/infografia-plan-global-de-educacion-presentacion' => [
                'subtitulo' => 'Infografia del Plan Global de Educacion Presentacion.',
                'contenido' => '<p>Accede a la infografia del Plan Global de Educacion Presentacion como recurso de consulta para la comunidad educativa.</p>',
                'label' => 'Ver infografia del Plan Global',
                'url' => 'https://drive.google.com/file/d/1wX4DC_aHn3rjduWL6hzta5xgEMGMTaON/view?usp=share_link',
            ],
            'gestion-comunitaria/proyectos-comunitarios-video' => [
                'subtitulo' => 'Video de proyectos comunitarios.',
                'contenido' => '<p>Consulta el video de proyectos comunitarios compartido desde la estructura anterior del sitio web.</p>',
                'label' => 'Ver video de proyectos comunitarios',
                'url' => 'https://drive.google.com/file/d/1gNN8i6a-WsWrekgl9yPL1bQjW7cArzz1/view?usp=sharing',
            ],
            'gestion-comunitaria/presentacion-de-proyectos' => [
                'subtitulo' => 'Presentacion de proyectos comunitarios.',
                'contenido' => '<p>Consulta la presentacion de proyectos comunitarios de la institucion.</p>',
                'label' => 'Ver presentacion de proyectos',
                'url' => 'https://drive.google.com/file/d/1OYtTqG_HBjZbApvTWlOL5M-hycUutwe0/view?usp=sharing',
            ],
            'gestion-comunitaria/embarazo-adolescente-temprana' => [
                'subtitulo' => 'Ruta de atencion para embarazo adolescente temprana.',
                'contenido' => '<p>Consulta la ruta de atencion relacionada con embarazo adolescente temprana.</p>',
                'label' => 'Ver ruta de embarazo adolescente temprana',
                'url' => 'https://drive.google.com/file/d/1dZh52GOdPkyOqAxKHu42aIZt2_5VQKbT/view?usp=sharing',
            ],
            'gestion-comunitaria/violencia-sexual' => [
                'subtitulo' => 'Ruta de atencion para casos de violencia sexual.',
                'contenido' => '<p>Consulta la ruta de atencion para presuntos casos de violencia sexual.</p>',
                'label' => 'Ver ruta de violencia sexual',
                'url' => 'https://drive.google.com/file/d/1gUzE9YaeaGeEHZLQjecXT4XN6ojYSQZV/view?usp=sharing',
            ],
            'gestion-comunitaria/violencia-por-discriminacion' => [
                'subtitulo' => 'Ruta de atencion para violencia por discriminacion.',
                'contenido' => '<p>Consulta la ruta de atencion para situaciones de violencia por discriminacion.</p>',
                'label' => 'Ver ruta de violencia por discriminacion',
                'url' => 'https://drive.google.com/file/d/1r_m3HbdFM13rvpLU14Ze61lV_wvxSarL/view?usp=sharing',
            ],
            'gestion-comunitaria/presunto-suicidio-consumado' => [
                'subtitulo' => 'Ruta de atencion para presunto suicidio consumado.',
                'contenido' => '<p>Consulta la ruta de atencion para presunto suicidio consumado.</p>',
                'label' => 'Ver ruta de presunto suicidio consumado',
                'url' => 'https://drive.google.com/file/d/1v8DDGEcBv54C44iBKBTDg10gLYa02WMN/view?usp=sharing',
            ],
            'gestion-comunitaria/agresion-y-acoso-escolar' => [
                'subtitulo' => 'Ruta de atencion para agresion y acoso escolar.',
                'contenido' => '<p>Consulta la ruta de atencion para situaciones de agresion y acoso escolar.</p>',
                'label' => 'Ver ruta de agresion y acoso escolar',
                'url' => 'https://drive.google.com/file/d/1TAfVQIJ6W1hXADFjmcVY14gKA7Q6FvB_/view?usp=sharing',
            ],
            'gestion-comunitaria/presunto-consumo-spa' => [
                'subtitulo' => 'Ruta de atencion para presunto consumo de SPA.',
                'contenido' => '<p>Consulta la ruta de atencion para presunto consumo de sustancias psicoactivas.</p>',
                'label' => 'Ver ruta de presunto consumo SPA',
                'url' => 'https://drive.google.com/file/d/1fTYzCWGhxDiIlUeDDkRr8QPUSocDoumF/view?usp=sharing',
            ],
            'gestion-comunitaria/ruta-atencion-integral-convivencia-escolar-colegio' => [
                'subtitulo' => 'Ruta institucional de convivencia escolar.',
                'contenido' => '<p>Consulta la ruta de atencion integral para la convivencia escolar del Colegio de La Presentacion de Neiva.</p>',
                'label' => 'Ver ruta de convivencia escolar del colegio',
                'url' => 'https://drive.google.com/file/d/1OZczVrnfj_CINeUY_83aP_eCEQ2h0ove/view?usp=sharing',
            ],
            'gestion-comunitaria/suicidio-y-spa-familias' => [
                'subtitulo' => 'Kit de herramientas para familias.',
                'contenido' => '<p>Material de apoyo para familias sobre prevencion de conducta suicida y consumo de sustancias psicoactivas.</p>',
                'label' => 'Ver kit Suicidio y SPA familias',
                'url' => 'https://drive.google.com/file/d/1uwUp5TuAVP7LFN1sfD-bRMBVdPDH20y-/view?usp=sharing',
            ],
            'gestion-comunitaria/ciberacoso-estudiantes' => [
                'subtitulo' => 'Kit de herramientas para estudiantes sobre ciberacoso.',
                'contenido' => '<p>Material de apoyo para estudiantes sobre promocion de la convivencia y prevencion del ciberacoso.</p>',
                'label' => 'Ver kit Ciberacoso estudiantes',
                'url' => 'https://drive.google.com/file/d/1mTPk_bRvSJ30kvUzzjTfbPlU5gFozSu9/view?usp=sharing',
            ],
            'gestion-comunitaria/conducta-suicida-estudiantes' => [
                'subtitulo' => 'Kit de herramientas para estudiantes sobre conducta suicida.',
                'contenido' => '<p>Material de apoyo para estudiantes sobre prevencion y atencion de la conducta suicida.</p>',
                'label' => 'Ver kit Conducta suicida estudiantes',
                'url' => 'https://drive.google.com/file/d/1ku7OZD9Jejc5bHKm-Vwfh_JFBxZ4l5fq/view?usp=sharing',
            ],
            'gestion-comunitaria/vbg-estudiantes' => [
                'subtitulo' => 'Kit de herramientas para estudiantes sobre VBG.',
                'contenido' => '<p>Material de apoyo para estudiantes sobre prevencion de violencias basadas en genero.</p>',
                'label' => 'Ver kit VBG estudiantes',
                'url' => 'https://drive.google.com/file/d/1bx6xu7AixggKhanimKlMKkwm6Kk-2bf9/view?usp=sharing',
            ],
            'gestion-comunitaria/vbg-familias' => [
                'subtitulo' => 'Kit de herramientas para familias sobre VBG.',
                'contenido' => '<p>Material de apoyo para familias sobre prevencion de violencias basadas en genero.</p>',
                'label' => 'Ver kit VBG familias',
                'url' => 'https://drive.google.com/file/d/1VfK900UjSB2BWXQ2jGlUE_-VyXbTt3VA/view?usp=sharing',
            ],
            'servicios/correo-institucional' => [
                'subtitulo' => 'Acceso al correo institucional.',
                'contenido' => '<p>Ingresa al correo institucional del dominio colpresentacioneiva.edu.co.</p>',
                'label' => 'Abrir correo institucional',
                'url' => 'http://www.google.com/a/cpanel/colpresentacioneiva.edu.co',
            ],
            'servicios/encuesta-satisfaccion' => [
                'subtitulo' => 'Encuesta de satisfaccion institucional.',
                'contenido' => '<p>Accede al formulario de encuesta de satisfaccion para la comunidad educativa.</p>',
                'label' => 'Abrir encuesta de satisfaccion',
                'url' => 'https://forms.gle/xWuzUk6wMzSXBVMS6',
            ],
            'servicios/evaluacion-actividades-eventos-estudiantes' => [
                'subtitulo' => 'Evaluacion de actividades y eventos para estudiantes.',
                'contenido' => '<p>Accede al espacio de evaluacion de actividades y eventos dirigido a estudiantes.</p>',
                'label' => 'Abrir evaluacion de actividades',
                'url' => 'https://sites.google.com/colpresentacioneiva.edu.co/actividades',
            ],
            'servicios/evaluacion-de-desempeno' => [
                'subtitulo' => 'Evaluacion de desempeno.',
                'contenido' => '<p>Este apartado conserva el acceso del menu anterior para la evaluacion de desempeno. El enlace oficial puede actualizarse desde el panel administrador cuando este disponible.</p>',
                'label' => 'Enlace pendiente de actualizacion',
                'url' => '#',
            ],
        ];

        foreach ($pages as $key => $data) {
            [$base, $slug] = explode('/', $key, 2);

            PaginaContenido::where('base', $base)
                ->where('slug', $slug)
                ->update([
                    'subtitulo' => $data['subtitulo'],
                    'contenido' => $data['contenido'],
                    'enlaces' => [
                        [
                            'label' => $data['label'],
                            'url' => $data['url'],
                            'archivo' => null,
                        ],
                    ],
                    'publicada' => true,
                ]);
        }
    }
}
