<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MailResetPasswordNotification extends Notification
{
    /**
     * Create a new notification instance.
     *
     * @return void
     */

    private $token;
    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via()
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->view(
                'auth.emails.password', [
                    'name' => $notifiable->name,
                    'resetLink' => url('password/reset/'.$this->token.'?email='.$notifiable->getEmailForPasswordReset()),
                ]
            )
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Reset Password');
    }

    public function toArray()
    {
        return [];
    }
}
