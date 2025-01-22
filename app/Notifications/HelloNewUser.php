<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HelloNewUser extends Notification
{
    use Queueable;

    public function __construct(public string $cool_sentence)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('You are amazing to join us!')
            ->from('strawberry@superbcn.com', 'Apple')
            ->greeting('Hello '.$notifiable->name)
            ->line('I could write a lot, but just want to say '.$this->cool_sentence)
            ->action('Check out our articles', route('articles.index'))
            ->line('Thank you for using our application!')
            ->salutation('See you soon!');
    }
}
