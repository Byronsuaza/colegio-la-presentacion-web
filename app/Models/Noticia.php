<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Services\HtmlSanitizerService;

class Noticia extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'categoria',
        'imagen',
        'contenido',
        'destacada',
    ];

    protected $casts = [
        'destacada' => 'boolean',
    ];

    public function scopeDestacadas($query)
    {
        return $query->where('destacada', true)->latest();
    }

    /**
     * Sanitiza el contenido HTML antes de guardarlo.
     */
    public function setContenidoAttribute($value)
    {
        $this->attributes['contenido'] = HtmlSanitizerService::sanitize($value);
    }
}

