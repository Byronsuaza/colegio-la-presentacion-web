<?php

namespace Database\Seeders;

use App\Models\GaleriaAlbum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GaleriaAlbumSeeder extends Seeder
{
    public function run(): void
    {
        $albums = [
            'Agape - Triduo Pascual',
            'Día de la Familia',
            'Instalación órganos de Participación 2025',
            'Izada de bandera Fiesta de la Nacionalidad',
            'Izada de bandera Cumpleaños Neiva',
            'Izada de bandera Día del Idioma',
            'Consagración 2025',
            'Festival INNOV-ARTE V3 2025',
            'Mes Mariano 2025',
            'Encuentros sábados FLIA',
            'Proyecto preescolar',
            'Proyecto transversal',
            'Sampedrito 2025',
            'Entronización Santo Domingo de Guzmán',
            'Día del medio ambiente',
            'Clase laboratorio de química',
            'Salida pedagógica al Capitolio y al museo',
        ];

        foreach ($albums as $index => $title) {
            GaleriaAlbum::firstOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'titulo' => $title,
                    'categoria' => 'Actividades y Eventos',
                    'orden' => $index + 1,
                    'publicado' => true,
                ]
            );
        }
    }
}
