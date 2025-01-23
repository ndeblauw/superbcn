<?php

namespace App\Notifications;

use App\Models\Purchase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InformAuthorOfPurchase extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Purchase $purchase)
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
            ->subject('Hurray')
            ->greeting('Hej '.$notifiable->name)
            ->line('Somebody just bought '.$this->purchase->article->title.' for '.$this->purchase->price_in_eur().' EUR.')
            ->line('Thank you for writing for us')
            ->salutation('Best regards from the team');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
