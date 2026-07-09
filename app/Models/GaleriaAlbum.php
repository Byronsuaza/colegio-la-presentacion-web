<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriaAlbum extends Model
{
    protected $fillable = [
        'titulo',
        'slug',
        'categoria',
        'fecha',
        'portada',
        'imagenes',
        'videos',
        'descripcion',
        'orden',
        'publicado',
    ];

    protected $casts = [
        'fecha' => 'date',
        'imagenes' => 'array',
        'videos' => 'array',
        'publicado' => 'boolean',
    ];

    public function scopePublicados($query)
    {
        return $query->where('publicado', true);
    }
}
