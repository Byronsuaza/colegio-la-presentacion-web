<?php

namespace Database\Seeders;

use App\Models\User;
use App\Support\MenuPages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'admin@colegio.com'],
            ['name' => 'Admin', 'password' => bcrypt('password')]
        );

        \App\Models\AjusteGeneral::firstOrCreate(
            ['id' => 1],
            [
                'telefono' => '311 6304190',
                'direccion' => 'Cra. 7 No. 8-19 - Neiva, Huila, Colombia.',
                'email' => 'info@colpresentacioneiva.edu.co',
                'facebook' => 'https://facebook.com/colegiopresentacionneiva',
                'instagram' => 'https://instagram.com/colegiopresentacionneiva',
                'whatsapp' => 'https://wa.me/573100000000',
                'admisiones_anio' => '2027',
                'admisiones_titulo' => 'Únete a la Familia Presentacionista',
                'admisiones_descripcion' => 'Las inscripciones para el año lectivo 2027 están abiertas. Cupos limitados en todos los niveles. Da el primer paso hacia una educación de excelencia.',
                'admisiones_boton_texto' => 'Inscríbete Ahora',
                'admisiones_boton_url' => '/admisiones/inscripcion-en-linea',
                'admisiones_llamada_texto' => 'Llamar: 311 6304190',
            ]
        );

        // Seed Noticias si está vacía
        if (\App\Models\Noticia::count() === 0) {
            $noticias = [
                ['titulo' => 'Estudiantes destacan en Olimpiadas de Matemáticas del Huila', 'categoria' => 'Logros', 'contenido' => 'Tres estudiantes de grado 11° obtuvieron primeros puestos en la fase departamental, clasificando a la etapa nacional.', 'destacada' => true],
                ['titulo' => 'Festival de Arte y Talentos 2026', 'categoria' => 'Cultural', 'contenido' => 'Una noche de expresión artística que reunió a más de 500 familias de la comunidad educativa.', 'destacada' => false],
                ['titulo' => 'Modelo de Naciones Unidas — COLMUN 2026', 'categoria' => 'Académico', 'contenido' => 'Nuestros delegados representaron a Colombia con excelencia en el debate internacional.', 'destacada' => false],
                ['titulo' => 'Campeonato Intercolegial de Fútbol', 'categoria' => 'Deportes', 'contenido' => 'El equipo femenino de La Presentación obtuvo el título departamental por tercer año consecutivo.', 'destacada' => false],
                ['titulo' => 'Semana Poussepin 2026: Carisma y Servicio', 'categoria' => 'Pastoral', 'contenido' => 'Actividades formativas y de proyección social en honor a nuestra fundadora Beata Marie Poussepin.', 'destacada' => false],
            ];
            foreach ($noticias as $n) {
                \App\Models\Noticia::create($n);
            }
        }

        // Seed HeroSlides si está vacía
        if (\App\Models\HeroSlide::count() === 0) {
            $slides = [
                ['imagen' => 'hero.jpg', 'titulo' => 'Colegio de La Presentación', 'subtitulo' => 'Campus Colegio de La Presentación de Neiva'],
                ['imagen' => 'hero2.jpg', 'titulo' => 'Vida estudiantil', 'subtitulo' => 'La Presentación Neiva'],
                ['imagen' => 'hero3.jpg', 'titulo' => 'Instalaciones académicas', 'subtitulo' => 'La Presentación Neiva'],
            ];
            foreach ($slides as $k => $s) {
                \App\Models\HeroSlide::create([
                    'imagen' => $s['imagen'],
                    'titulo' => $s['titulo'],
                    'subtitulo' => $s['subtitulo'],
                    'orden' => $k,
                    'activo' => true
                ]);
            }
        }

        \App\Models\PaginaContenido::firstOrCreate(
            [
                'base' => 'nuestra-institucion',
                'slug' => 'marie-poussepin',
            ],
            [
                'seccion' => 'Nuestra Institución',
                'titulo' => 'Marie Poussepin: Madre de la Caridad',
                'subtitulo' => 'Fundadora de la Congregación de las Dominicas de la Presentación',
                'imagen' => '/marie_poussepin.png',
                'contenido' => '<p>Marie Poussepin nació el <strong>14 de octubre de 1653</strong> en Dourdan, Francia. Fue una mujer visionaria que, desde su juventud, combinó la fe profunda con una inteligencia empresarial extraordinaria, transformando la industria de la seda de su región y generando prosperidad para su comunidad.</p><p>A los 42 años, respondiendo al llamado de Dios, se entregó totalmente al servicio de los pobres y enfermos, fundando la <em>Congregación de las Dominicas de la Presentación de la Santísima Virgen al Templo</em>, institución que llegaría a más de 40 países en los cinco continentes.</p><p>Su legado es el fundamento de nuestra identidad: <strong>fe, caridad, servicio y excelencia</strong>. El <strong>Colegio de La Presentación de Neiva</strong> es heredero vivo de este carisma, formando mujeres y hombres capaces de transformar la sociedad desde los valores del Evangelio.</p>',
                'enlaces' => [],
                'publicada' => true,
            ]
        );

        foreach (MenuPages::sections() as $section) {
            foreach ($section['pages'] as $page) {
                \App\Models\PaginaContenido::firstOrCreate(
                    [
                        'base' => $section['base'],
                        'slug' => $page['slug'],
                    ],
                    [
                        'seccion' => $section['label'],
                        'titulo' => $page['title'],
                        'subtitulo' => 'Información institucional del Colegio de La Presentación de Neiva.',
                        'contenido' => '<p>Esta página está lista para editarse desde el panel administrador. Puedes reemplazar este texto por el contenido oficial, agregar imágenes destacadas y enlazar documentos o formularios.</p>',
                        'enlaces' => [],
                        'publicada' => true,
                    ]
                );
            }
        }

        $this->call(InstitutionalPagesSeeder::class);
        $this->call(SeccionSeeder::class);
    }
}
