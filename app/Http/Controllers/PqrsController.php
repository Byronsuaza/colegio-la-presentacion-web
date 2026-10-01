<?php

namespace App\Http\Controllers;

use App\Models\PqrsSubmission;
use App\Http\Requests\StorePqrsRequest;
use Illuminate\Support\Facades\Http;


class PqrsController extends Controller
{
    public function store(StorePqrsRequest $request)
    {
        $secretKey = config('services.turnstile.secret_key');

        if (! empty($secretKey)) {
            $turnstileToken = $request->input('cf-turnstile-response');

            if (empty($turnstileToken)) {
                return response()->json([
                    'success' => false,
                    'errors' => [
                        'turnstile' => ['Por favor, complete la verificación de seguridad.'],
                    ],
                ], 422);
            }

            $verifyResponse = Http::asForm()->post(
                'https://challenges.cloudflare.com/turnstile/v0/siteverify',
                [
                    'secret' => $secretKey,
                    'response' => $turnstileToken,
                    'remoteip' => $request->ip(),
                ]
            );

            $verifyData = $verifyResponse->json();

            if (! ($verifyData['success'] ?? false)) {
                return response()->json([
                    'success' => false,
                    'errors' => [
                        'turnstile' => ['La verificación de seguridad falló. Por favor, inténtelo de nuevo.'],
                    ],
                ], 422);
            }
        }

        $data = $request->validated();

        if ($request->hasFile('adjunto')) {
            $path = $request->file('adjunto')->store('pqrs', 'local');
            $data['adjunto'] = $path;
        }

        $submission = PqrsSubmission::create($data);

        // Envío de notificación por correo a Calidad
        try {
            $destinatario = \App\Models\AjusteGeneral::first()?->email_pqrs 
                ?: env('PQRS_MAIL_TO', 'calidad@colpresentacioneiva.edu.co');

            if (!empty($destinatario)) {
                \Illuminate\Support\Facades\Mail::to($destinatario)->send(new \App\Mail\NuevaPqrsMail($submission));
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error("Error enviando correo de PQRS #{$submission->id}: " . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Su solicitud PQRS ha sido registrada exitosamente con el ticket #' . $submission->id . '.',
            'ticket' => $submission->id,
        ]);
    }
}