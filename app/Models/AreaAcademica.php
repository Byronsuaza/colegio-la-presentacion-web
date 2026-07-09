<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaAcademica extends Model
{
    protected $table = 'areas_academicas';

    protected $fillable = [
        'titulo',
        'coordinador',
        'descripcion',
        'enlaces',
        'orden',
        'activa',
    ];

    protected $casts = [
        'enlaces' => 'array',
        'activa' => 'boolean',
    ];

    public function scopeActivas($query)
    {
        return $query->where('activa', true);
    }

    public function scopeOrdenadas($query)
    {
        return $query->orderBy('orden');
    }
}
