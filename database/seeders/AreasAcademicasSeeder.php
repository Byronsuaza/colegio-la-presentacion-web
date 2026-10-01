<?php

namespace Database\Seeders;

use App\Models\AreaAcademica;
use Illuminate\Database\Seeder;

class AreasAcademicasSeeder extends Seeder
{
    public function run(): void
    {
        $areas = [
            [
                'titulo' => 'Área de Castellano',
                'coordinador' => null,
                'descripcion' => '<p>Docentes integrantes del área por asignar.</p>',
                'enlaces' => [],
                'orden' => 1,
                'activa' => true,
            ],
            [
                'titulo' => 'Área de Ciencias',
                'coordinador' => null,
                'descripcion' => '<p>Docentes integrantes del área por asignar.</p>',
                'enlaces' => [],
                'orden' => 2,
                'activa' => true,
            ],
            [
                'titulo' => 'Área de Educación Física y Artística',
                'coordinador' => null,
                'descripcion' => '<p>Docentes integrantes del área por asignar.</p>',
                'enlaces' => [],
                'orden' => 3,
                'activa' => true,
            ],
            [
                'titulo' => 'Área de Idioma Extranjero',
                'coordinador' => null,
                'descripcion' => '<p>Docentes integrantes del área por asignar.</p>',
                'enlaces' => [],
                'orden' => 4,
                'activa' => true,
            ],
            [
                'titulo' => 'Área de Matemáticas',
                'coordinador' => null,
                'descripcion' => '<p>Docentes integrantes del área por asignar.</p>',
                'enlaces' => [],
                'orden' => 5,
                'activa' => true,
            ],
            [
                'titulo' => 'Área de Preescolar',
                'coordinador' => null,
                'descripcion' => '<p>Docentes integrantes del área por asignar.</p>',
                'enlaces' => [],
                'orden' => 6,
                'activa' => true,
            ],
            [
                'titulo' => 'Área de Religión',
                'coordinador' => null,
                'descripcion' => '<p>Docentes integrantes del área por asignar.</p>',
                'enlaces' => [],
                'orden' => 7,
                'activa' => true,
            ],
            [
                'titulo' => 'Área de Sociales',
                'coordinador' => null,
                'descripcion' => '<p>Docentes integrantes del área por asignar.</p>',
                'enlaces' => [],
                'orden' => 8,
                'activa' => true,
            ],
        ];

        foreach ($areas as $data) {
            AreaAcademica::firstOrCreate(
                ['titulo' => $data['titulo']],
                $data
            );
        }
    }
}
