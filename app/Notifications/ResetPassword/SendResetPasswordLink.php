<?php

namespace App\Notifications\ResetPassword;

use App\Models\Sosmed;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;

class SendResetPasswordLink extends ResetPassword
{
    use Queueable;

    // public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]));

        return (new MailMessage)->action('Reset Password', $url)->view('mail.send-reset-password-link', [
            'sosmeds' => Sosmed::first(),
        ]);
    }
}
