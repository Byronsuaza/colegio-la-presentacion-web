<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    protected $fillable = [
        'nombre',
        'titulo',
        'descripcion_corta',
        'descripcion_completa',
        'imagen_hero',
        'estadisticas',
        'objetivos',
        'caracteristicas',
        'programas',
        'grados',
        'galeria',
        'coordinador_nombre',
        'coordinador_correo',
        'coordinador_telefono',
    ];

    protected $casts = [
        'estadisticas' => 'array',
        'objetivos' => 'array',
        'caracteristicas' => 'array',
        'programas' => 'array',
        'grados' => 'array',
        'galeria' => 'array',
    ];
}

