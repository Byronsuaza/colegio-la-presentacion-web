<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostulacionRequest;
use App\Mail\NuevaPostulacionMail;
use App\Models\AjusteGeneral;
use App\Models\Postulacion;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostulacionController extends Controller
{
    public function store(StorePostulacionRequest $request)
    {
        // Verificación anti-spam (Cloudflare Turnstile), igual que en PQRS
        $secretKey = config('services.turnstile.secret_key');

        if (! empty($secretKey)) {
            $turnstileToken = $request->input('cf-turnstile-response');

            if (empty($turnstileToken)) {
                return response()->json([
                    'success' => false,
                    'errors' => ['turnstile' => ['Por favor, complete la verificación de seguridad.']],
                ], 422);
            }

            $verifyData = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                'secret' => $secretKey,
                'response' => $turnstileToken,
                'remoteip' => $request->ip(),
            ])->json();

            if (! ($verifyData['success'] ?? false)) {
                return response()->json([
                    'success' => false,
                    'errors' => ['turnstile' => ['La verificación de seguridad falló. Por favor, inténtelo de nuevo.']],
                ], 422);
            }
        }

        $data = $request->validated();
        unset($data['habeas_data']);

        // La hoja de vida se guarda en disco privado (no accesible públicamente)
        $archivo = $request->file('hoja_vida');
        $nombreArchivo = now()->format('Ymd_His') . '_' . Str::slug($data['nombre_completo']) . '.' . strtolower($archivo->getClientOriginalExtension());
        $data['hoja_vida'] = $archivo->storeAs('postulaciones', $nombreArchivo, 'local');

        $postulacion = Postulacion::create($data);

        // Notificación por correo a Talento Humano con la hoja de vida adjunta
        try {
            $destinatario = AjusteGeneral::first()?->email_talento_humano
                ?: env('TALENTO_HUMANO_MAIL_TO', 'psicologa@colpresentacioneiva.edu.co');

            if (! empty($destinatario)) {
                Mail::to($destinatario)->send(new NuevaPostulacionMail($postulacion));
            }
        } catch (\Throwable $e) {
            Log::error("Error enviando correo de postulación #{$postulacion->id}: " . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Hemos recibido tu postulación. El área de Talento Humano revisará tu hoja de vida y se comunicará contigo si tu perfil se ajusta a la vacante.',
            'radicado' => $postulacion->id,
        ]);
    }

    /**
     * Descarga de la hoja de vida (solo usuarios autenticados del panel).
     */
    public function hojaVida(Postulacion $postulacion)
    {
        if (! $postulacion->hoja_vida || ! Storage::disk('local')->exists($postulacion->hoja_vida)) {
            abort(404);
        }

        $extension = pathinfo($postulacion->hoja_vida, PATHINFO_EXTENSION);
        $nombreDescarga = 'Hoja de vida - ' . $postulacion->nombre_completo . '.' . $extension;

        return Storage::disk('local')->download($postulacion->hoja_vida, $nombreDescarga);
    }
}
