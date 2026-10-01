<?php

namespace App\Mail;

use App\Models\PqrsSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class NuevaPqrsMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public PqrsSubmission $submission
    ) {}

    public function envelope(): Envelope
    {
        $replyTo = [];
        if (!empty($this->submission->email) && filter_var($this->submission->email, FILTER_VALIDATE_EMAIL)) {
            $replyTo[] = new Address($this->submission->email, $this->submission->nombre_completo);
        }

        return new Envelope(
            subject: "[PQRS #{$this->submission->id}] Nueva solicitud ({$this->submission->tipo}) – {$this->submission->nombre_completo}",
            replyTo: $replyTo,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.nueva_pqrs',
        );
    }

    public function attachments(): array
    {
        $attachments = [];

        if (!empty($this->submission->adjunto) && Storage::disk('local')->exists($this->submission->adjunto)) {
            $attachments[] = Attachment::fromPath(Storage::disk('local')->path($this->submission->adjunto));
        }

        return $attachments;
    }
}
