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
        'datos_estructurados',
        'enlaces',
        'publicada',
    ];

    protected $casts = [
        'enlaces' => 'array',
        'datos_estructurados' => 'array',
        'publicada' => 'boolean',
    ];

    protected static function booted()
    {
        static::saving(function (PaginaContenido $page) {
            if (!empty($page->datos_estructurados) && in_array($page->slug, ['mision', 'rectora', 'principios', 'simbolos'])) {
                $compiled = \App\Support\PaginaLayoutBuilder::buildHtml($page->slug, $page->datos_estructurados);
                if ($compiled) {
                    $page->attributes['contenido'] = $compiled;
                }
            }
        });
    }

    public function scopePublicadas($query)
    {
        return $query->where('publicada', true);
    }

    public function getUrlAttribute(): string
    {
        return "/{$this->base}/{$this->slug}";
    }

    public function getImagenAttribute($value)
    {
        if (! $value) {
            return null;
        }

        $trimmed = trim(str_replace('\\', '/', $value));

        if (preg_match('/^https?:\/\/(127\.0\.0\.1|localhost):8000(\/.*)$/', $trimmed, $matches)) {
            return ltrim($matches[2], '/');
        }

        if (preg_match('/^https?:\/\/[^\/]+(\/storage\/.*)$/', $trimmed, $matches)) {
            return ltrim($matches[1], '/');
        }

        return ltrim($trimmed, '/');
    }

    /**
     * Sanitiza el contenido HTML antes de guardarlo.
     */
    public function setContenidoAttribute($value)
    {
        $this->attributes['contenido'] = HtmlSanitizerService::sanitize($value);
    }
}

