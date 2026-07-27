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

