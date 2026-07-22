<?php

namespace App\Notifications;

use Filament\Auth\Notifications\ResetPassword as FilamentResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends FilamentResetPassword
{
    /**
     * Obtiene la URL de reseteo de forma segura.
     */
    protected function resetUrl($notifiable): string
    {
        if (isset($this->url) && !empty($this->url)) {
            return $this->url;
        }

        return \Filament\Facades\Filament::getResetPasswordUrl($this->token, $notifiable);
    }

    /**
     * Construye el correo de recuperacion de contrasena en espanol.
     */
    public function toMail(mixed $notifiable): MailMessage
    {
        $url = $this->resetUrl($notifiable);
        $expiracion = config('auth.passwords.' . config('auth.defaults.passwords') . '.expire', 60);

        return (new MailMessage)
            ->subject('Recuperación de contraseña – Panel Administrador')
            ->greeting('Hola, ' . $notifiable->name . '.')
            ->line('Has recibido este correo porque solicitaste recuperar la contraseña de tu cuenta en el Panel Administrador del Colegio La Presentación.')
            ->action('Restablecer contraseña', $url)
            ->line('Este enlace de recuperación expirará en ' . $expiracion . ' minutos.')
            ->line('Si no solicitaste recuperar tu contraseña, puedes ignorar este correo de forma segura.')
            ->salutation('Atentamente, Colegio La Presentación');
    }
}
