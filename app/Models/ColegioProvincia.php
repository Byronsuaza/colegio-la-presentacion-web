<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColegioProvincia extends Model
{
    use HasFactory;

    protected $table = 'colegios_provincia';

    protected $fillable = [
        'nombre',
        'ciudad',
        'logo',
        'url',
        'orden',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'orden' => 'integer',
    ];

    public function scopeActivo($query)
    {
        return $query->where('activo', true)->orderBy('orden');
    }

    public function getLogoUrlAttribute(): string
    {
        if (empty($this->logo)) {
            return '';
        }

        if (str_starts_with($this->logo, 'http') || str_starts_with($this->logo, '/')) {
            return $this->logo;
        }

        return asset('storage/' . ltrim($this->logo, '/'));
    }
}
