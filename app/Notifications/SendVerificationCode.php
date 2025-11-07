<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendVerificationCode extends Notification
{
    use Queueable;

    protected $code;

    /**
     * Create a new notification instance.
     *
     * @param string $code
     * @return void
     */
    public function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
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
        return (new MailMessage)
            ->subject('Email Verification Code - CCSuggest')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Thank you for registering with CCSuggest.')
            ->line('Your email verification code is:')
            ->line('**' . $this->code . '**')
            ->line('This code will expire in 15 minutes.')
            ->line('Please enter this code on the verification page to activate your account.')
            ->line('If you did not create an account, please ignore this email.')
            ->salutation('Best regards, The CCSuggest Team');
    }
}
