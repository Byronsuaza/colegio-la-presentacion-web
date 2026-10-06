<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AjusteGeneral extends Model
{
    use HasFactory;

    protected $table = 'ajustes_generales';

    protected $fillable = [
        'telefono',
        'direccion',
        'email',
        'email_pqrs',
        'facebook',
        'instagram',
        'whatsapp',
        'admisiones_anio',
        'admisiones_titulo',
        'admisiones_descripcion',
        'admisiones_boton_texto',
        'admisiones_boton_url',
        'admisiones_llamada_texto',
        'popup_habilitado',
        'popup_button_text',
        'popup_button_url',
        'popup_imagen',
        'evangelio_embed_url',
        'pago_en_linea_url',
        'syscolegios_url',
        'pruebas_diagnosticas_password',
        'admisiones_pasos',
        'admisiones_tags',
        'valor_titulo',
        'valor_subtitulo',
        'valor_frase',
        'valor_frase_autor',
        'valor_pilares',
        'oferta_titulo',
        'oferta_subtitulo',
        'oferta_niveles',
        'footer_anio_fundacion',
        'footer_lema',
    ];

    protected $casts = [
        'popup_habilitado' => 'boolean',
        'admisiones_pasos' => 'array',
        'admisiones_tags' => 'array',
        'valor_pilares' => 'array',
        'oferta_niveles' => 'array',
    ];

    /**
     * Obtiene o crea el registro único de ajustes.
     */
    public static function instancia(): static
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
