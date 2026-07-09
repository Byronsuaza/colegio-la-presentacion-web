<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';

    protected $fillable = [
        'titulo',
        'fecha',
        'hora',
        'lugar',
        'es_activo',
    ];

    protected $casts = [
        'fecha' => 'date:Y-m-d',
        'es_activo' => 'boolean',
    ];
}
