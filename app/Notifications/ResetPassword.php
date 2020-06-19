<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends ResetPasswordNotification
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
          ->line('Vous rececez cet email car une demande de mot de passe oublié a été effectuée')
          ->action('Réinitialiser le mot de passe', url(config('app.url') . route('password.reset', $this->token, false)))
          ->line('Si vous n\'avez pas demandé à changer de mot de passe, merci d\'ignorer ce mail');
    }
}
