<?php

namespace Database\Seeders;

use App\Models\Seccion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $secciones = [
            [
                'nombre' => 'preescolar',
                'titulo' => 'Sección I - Preescolar',
                'descripcion_corta' => 'Nuestra Sección I del Colegio de La Presentación de Neiva desarrolla una formación integral del (la) estudiante, incorpora procesos de desarrollo cognitivo y refuerzo afectivo.',
                'descripcion_completa' => 'Nuestra Sección I del Colegio de La Presentación de Neiva desarrolla una formación integral del (la) estudiante, incorpora procesos de desarrollo cognitivo y refuerzo afectivo a través de la promoción de la interacción y de la experiencia de cada uno.',
                'imagen_hero' => '/preescolar.png',
                'estadisticas' => [
                    'Estudiantes' => '100+',
                    'Años de inicio' => '3',
                    'Profesores' => '15',
                ],
                'objetivos' => [
                    ['titulo' => 'Potenciar Talentos', 'descripcion' => 'Potenciar los valores, capacidades y talentos de cada alumno en un ambiente seguro y acogedor'],
                    ['titulo' => 'Interacción Social', 'descripcion' => 'Promover la interacción con otros compañeros que permita la construcción de experiencias de aprendizaje enriquecidas'],
                    ['titulo' => 'Desarrollo Crítico', 'descripcion' => 'Desarrollar habilidades de creatividad, resolución de problemas y razonamiento crítico'],
                    ['titulo' => 'Desarrollo Integral', 'descripcion' => 'Estimular el desarrollo cognitivo y afectivo integral en cada etapa'],
                ],
                'caracteristicas' => [
                    ['titulo' => 'Aulas Montessori', 'icon' => 'graduation-cap', 'descripcion' => 'Ambientes preparados para el aprendizaje autónomo'],
                    ['titulo' => 'Psicorientación', 'icon' => 'heart', 'descripcion' => 'Acompañamiento emocional y psicológico integral'],
                    ['titulo' => 'Inglés desde los 3', 'icon' => 'globe', 'descripcion' => 'Inmersión bilingüe desde temprana edad'],
                    ['titulo' => 'Arte y Música', 'icon' => 'music', 'descripcion' => 'Educación artística y musical diferenciada'],
                    ['titulo' => 'Movimiento', 'icon' => 'activity', 'descripcion' => 'Psicomotricidad y desarrollo físico integral'],
                    ['titulo' => 'Estimulación', 'icon' => 'sparkles', 'descripcion' => 'Actividades de estimulación temprana adaptadas'],
                ],
                'programas' => [
                    ['nombre' => 'Inmersión Bilingüe'],
                    ['nombre' => 'Programas STEM'],
                    ['nombre' => 'Educación Emocional'],
                ],
                'grados' => [
                    ['nombre' => 'Jardín', 'edades' => '3-4 años'],
                    ['nombre' => 'Transición', 'edades' => '5-6 años'],
                ],
                'galeria' => [
                    ['url' => '/preescolar.png', 'titulo' => 'Aula Montessori'],
                    ['url' => '/preescolar.png', 'titulo' => 'Actividades Bilingües'],
                    ['url' => '/preescolar.png', 'titulo' => 'Espacios de Aprendizaje'],
                ],
                'coordinador_nombre' => 'Coordinadora Académica',
                'coordinador_correo' => 'coordinadora.preescolar@colegiopresentacion.edu.co',
                'coordinador_telefono' => '+57 (8) 8234456',
            ],
            [
                'nombre' => 'primaria',
                'titulo' => 'Sección II - Básica Primaria',
                'descripcion_corta' => 'En la Sección II del Colegio de La Presentación de Neiva, tenemos la gran tarea de mantener y fomentar la curiosidad, el interés y la creatividad de nuestros estudiantes.',
                'descripcion_completa' => 'En la Sección II del Colegio de La Presentación de Neiva, tenemos la gran tarea de mantener y fomentar la curiosidad, el interés y la creatividad de nuestros estudiantes logrando avanzar en el desarrollo de su autonomía y autorregulación.',
                'imagen_hero' => '/primaria.png',
                'estadisticas' => [
                    'Estudiantes' => '300+',
                    'Docentes' => '40',
                    'Laboratorios' => '10',
                ],
                'objetivos' => [
                    ['titulo' => 'Pensamiento Crítico', 'descripcion' => 'Desarrollar el pensamiento crítico a través de proyectos de aula contextualizados'],
                    ['titulo' => 'Competencias Fundamentales', 'descripcion' => 'Consolidar competencias fundamentales con metodología activa e interdisciplinar'],
                    ['titulo' => 'Ciudadanía', 'descripcion' => 'Formar ciudadanos comprometidos con su entorno y comunidad'],
                    ['titulo' => 'Bilingüismo', 'descripcion' => 'Fortalecer habilidades de comunicación en inglés y español'],
                    ['titulo' => 'Cooperación', 'descripcion' => 'Promover el trabajo cooperativo y el respeto mutuo'],
                ],
                'caracteristicas' => [
                    ['titulo' => 'Bilingüismo', 'icon' => 'globe', 'descripcion' => 'Programa de inmersión bilingüe avanzado'],
                    ['titulo' => 'Laboratorios STEM', 'icon' => 'beaker', 'descripcion' => 'Laboratorios de Ciencia, Tecnología, Ingeniería y Matemáticas'],
                    ['titulo' => 'Arte y Deporte', 'icon' => 'music', 'descripcion' => 'Integración de arte y deporte en el currículo'],
                    ['titulo' => 'Proyectos', 'icon' => 'target', 'descripcion' => 'Clubs y proyectos especiales según intereses'],
                    ['titulo' => 'Metodología', 'icon' => 'check-circle', 'descripcion' => 'Metodología de proyectos interdisciplinares'],
                    ['titulo' => 'Tecnología', 'icon' => 'briefcase', 'descripcion' => 'Integración de tecnología educativa avanzada'],
                ],
                'programas' => [
                    ['nombre' => 'Bilingüismo Avanzado'],
                    ['nombre' => 'Laboratorios STEM'],
                    ['nombre' => 'Proyectos Interdisciplinares'],
                ],
                'grados' => [
                    ['nombre' => '1°', 'edades' => '6-7 años'],
                    ['nombre' => '2°', 'edades' => '7-8 años'],
                    ['nombre' => '3°', 'edades' => '8-9 años'],
                    ['nombre' => '4°', 'edades' => '9-10 años'],
                    ['nombre' => '5°', 'edades' => '10-11 años'],
                ],
                'galeria' => [
                    ['url' => '/primaria.png', 'titulo' => 'Laboratorio STEM'],
                    ['url' => '/primaria.png', 'titulo' => 'Clase Bilingüe'],
                    ['url' => '/primaria.png', 'titulo' => 'Proyecto Interdisciplinar'],
                ],
                'coordinador_nombre' => 'Coordinadora Académica',
                'coordinador_correo' => 'coordinadora.primaria@colegiopresentacion.edu.co',
                'coordinador_telefono' => '+57 (8) 8234456',
            ],
            [
                'nombre' => 'bachillerato',
                'titulo' => 'Sección III - Bachillerato',
                'descripcion_corta' => 'La Sección III del Colegio de La Presentación de Neiva es un programa educativo innovador basado en metodologías pedagógicas constructivas.',
                'descripcion_completa' => 'La Sección III del Colegio de La Presentación de Neiva es un programa educativo innovador, basado en metodologías pedagógicas constructivas, que tiene como objetivo desarrollar el pensamiento crítico, la autonomía y la creatividad de nuestros estudiantes.',
                'imagen_hero' => '/bachillerato.png',
                'estadisticas' => [
                    'Estudiantes' => '400+',
                    'Docentes' => '50',
                    'Universidades' => '100%',
                ],
                'objetivos' => [
                    ['titulo' => 'Personas Íntegras', 'descripcion' => 'Formar personas íntegras comprometidas con la comunidad y su entorno'],
                    ['titulo' => 'Liderazgo', 'descripcion' => 'Desarrollar líderes con visión en un mundo cambiante y dinámico'],
                    ['titulo' => 'Excelencia Académica', 'descripcion' => 'Preparar académicamente para universidades de prestigio nacional e internacional'],
                    ['titulo' => 'Autonomía', 'descripcion' => 'Fortalecer el pensamiento crítico y la autonomía en la toma de decisiones'],
                    ['titulo' => 'Formación Integral', 'descripcion' => 'Integrar formación académica, espiritual y de carácter'],
                ],
                'caracteristicas' => [
                    ['titulo' => 'Preuniversitario', 'icon' => 'glasses', 'descripcion' => 'Programa especializado de preparación para pruebas ICFES'],
                    ['titulo' => 'Proyecto de Vida', 'icon' => 'target', 'descripcion' => 'Construcción personalizada del proyecto de vida'],
                    ['titulo' => 'Pruebas Int\'l', 'icon' => 'search', 'descripcion' => 'Preparación en pruebas internacionales avanzadas'],
                    ['titulo' => 'Emprendimiento', 'icon' => 'briefcase', 'descripcion' => 'Énfasis en emprendimiento e innovación empresarial'],
                    ['titulo' => 'Liderazgo', 'icon' => 'heart', 'descripcion' => 'Programas de liderazgo y servicio comunitario'],
                    ['titulo' => 'Investigación', 'icon' => 'check-circle', 'descripcion' => 'Metodología de investigación científica avanzada'],
                ],
                'programas' => [
                    ['nombre' => 'Preparación ICFES'],
                    ['nombre' => 'Pruebas Internacionales'],
                    ['nombre' => 'Emprendimiento'],
                ],
                'grados' => [
                    ['nombre' => '6°', 'edades' => '11-12 años'],
                    ['nombre' => '7°', 'edades' => '12-13 años'],
                    ['nombre' => '8°', 'edades' => '13-14 años'],
                    ['nombre' => '9°', 'edades' => '14-15 años'],
                    ['nombre' => '10°', 'edades' => '15-16 años'],
                    ['nombre' => '11°', 'edades' => '16-17 años'],
                ],
                'galeria' => [
                    ['url' => '/bachillerato.png', 'titulo' => 'Laboratorio de Innovación'],
                    ['url' => '/bachillerato.png', 'titulo' => 'Liderazgo Estudiantil'],
                    ['url' => '/bachillerato.png', 'titulo' => 'Investigación Científica'],
                ],
                'coordinador_nombre' => 'Coordinador Académico',
                'coordinador_correo' => 'coordinador.bachillerato@colegiopresentacion.edu.co',
                'coordinador_telefono' => '+57 (8) 8234456',
            ],
        ];

        foreach ($secciones as $seccion) {
            Seccion::updateOrCreate(
                ['nombre' => $seccion['nombre']],
                $seccion
            );
        }
    }
}
