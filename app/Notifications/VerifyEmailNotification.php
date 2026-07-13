<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmailNotification extends BaseVerifyEmail
{
    public function toMail($notifiable): MailMessage
    {
        $url = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('ইমেইল যাচাই করুন — '.config('app.name'))
            ->view('emails.verify', [
                'user' => $notifiable,
                'url' => $url,
            ]);
    }
}
