<?php

namespace App\Notifications;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InformAuthorOnArticleRead extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public \Carbon\Carbon $when,
        public int $article_id,
    ) { }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        sleep(5);

        $article = Article::findOrFail($this->article_id);

        return (new MailMessage)
            ->subject('Good News!')
            ->greeting('Hello '.$notifiable->name.',')
            ->line('Your article <strong>'.$article->title.'</strong> has been read at'.$this->when->format('Y-m-d H:i').'.')
            ->salutation('You are great!');
    }

}
