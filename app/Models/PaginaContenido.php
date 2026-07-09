<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Services\HtmlSanitizerService;

class PaginaContenido extends Model
{
    protected $fillable = [
        'seccion',
        'subseccion',
        'base',
        'slug',
        'titulo',
        'subtitulo',
        'imagen',
        'url_externa',
        'contenido',
        'enlaces',
        'publicada',
    ];

    protected $casts = [
        'enlaces' => 'array',
        'publicada' => 'boolean',
    ];

    public function scopePublicadas($query)
    {
        return $query->where('publicada', true);
    }

    public function getUrlAttribute(): string
    {
        return "/{$this->base}/{$this->slug}";
    }

    /**
     * Sanitiza el contenido HTML antes de guardarlo.
     */
    public function setContenidoAttribute($value)
    {
        $this->attributes['contenido'] = HtmlSanitizerService::sanitize($value);
    }
}

