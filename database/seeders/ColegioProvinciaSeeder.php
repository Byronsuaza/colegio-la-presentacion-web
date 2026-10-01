<?php

namespace Database\Seeders;

use App\Models\ColegioProvincia;
use Illuminate\Database\Seeder;

class ColegioProvinciaSeeder extends Seeder
{
    public function run(): void
    {
        $colegios = [
            [
                'nombre' => 'Colegio de La Presentación Fusagasugá',
                'ciudad' => 'Fusagasugá',
                'logo' => '/images/provincia/logoFusagasuga.webp',
                'url' => 'https://colpres.edu.co/colegio-la-presentacion-fusagasuga',
                'orden' => 1,
                'activo' => true,
            ],
            [
                'nombre' => 'Colegio de La Presentación Zipaquirá',
                'ciudad' => 'Zipaquirá',
                'logo' => '/images/provincia/logoZipaquira.webp',
                'url' => 'https://colpresentacionzipa.edu.co/',
                'orden' => 2,
                'activo' => true,
            ],
            [
                'nombre' => 'Colegio de La Presentación Neiva',
                'ciudad' => 'Neiva',
                'logo' => '/images/provincia/logoNeiva.webp',
                'url' => 'https://colpresentacioneiva.edu.co/',
                'orden' => 3,
                'activo' => true,
            ],
            [
                'nombre' => 'Colegio de La Presentación Pitalito',
                'ciudad' => 'Pitalito',
                'logo' => '/images/provincia/logoPitalito.webp',
                'url' => 'https://lapresentacionpitalito.edu.co/',
                'orden' => 4,
                'activo' => true,
            ],
            [
                'nombre' => 'Colegio Santa Teresa Cúcuta',
                'ciudad' => 'Cúcuta',
                'logo' => '/images/provincia/staTeresaCucuta.png',
                'url' => 'https://colpresantateresacucuta.edu.co/',
                'orden' => 5,
                'activo' => true,
            ],
            [
                'nombre' => 'Colegio de La Presentación Mérida',
                'ciudad' => 'Mérida',
                'logo' => '/images/provincia/merida.png',
                'url' => 'https://lapresentacioncolegio.com/',
                'orden' => 6,
                'activo' => true,
            ],
            [
                'nombre' => 'Ciudadela La Presentación',
                'ciudad' => 'Medellín',
                'logo' => '/images/provincia/ciudadelapresentacion.png',
                'url' => 'https://www.ciudadelapresentacion.edu.co/',
                'orden' => 7,
                'activo' => true,
            ],
        ];

        foreach ($colegios as $c) {
            ColegioProvincia::updateOrCreate(
                ['nombre' => $c['nombre']],
                $c
            );
        }
    }
}
