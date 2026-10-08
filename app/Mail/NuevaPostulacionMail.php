<?php

namespace App\Mail;

use App\Models\Postulacion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class NuevaPostulacionMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Postulacion $postulacion
    ) {}

    public function envelope(): Envelope
    {
        $replyTo = [];
        if (filter_var($this->postulacion->email, FILTER_VALIDATE_EMAIL)) {
            $replyTo[] = new Address($this->postulacion->email, $this->postulacion->nombre_completo);
        }

        return new Envelope(
            subject: "[Postulación #{$this->postulacion->id}] {$this->postulacion->cargo} – {$this->postulacion->nombre_completo}",
            replyTo: $replyTo,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.nueva_postulacion',
        );
    }

    public function attachments(): array
    {
        $ruta = $this->postulacion->hoja_vida;

        if (empty($ruta) || ! Storage::disk('local')->exists($ruta)) {
            return [];
        }

        $extension = pathinfo($ruta, PATHINFO_EXTENSION);

        return [
            Attachment::fromPath(Storage::disk('local')->path($ruta))
                ->as('Hoja de vida - ' . $this->postulacion->nombre_completo . '.' . $extension),
        ];
    }
}
