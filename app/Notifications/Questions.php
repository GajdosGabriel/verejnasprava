<?php

namespace App\Notifications;

use App\Models\Question;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Questions extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $question;
    public function __construct(Question $question)
    {
        $this->question = $question;
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
            ->success()
            ->subject('Otázka -- Verejný Portál-- ' . $this->question->user->company)
            ->line('<strong>' . $this->question->user->company . '</strong> zadal novú otázku.')
            ->line('<h2>Text otázky:</h2>')
            ->line('<strong>' . $this->question->question . '</strong>')
            ->action('Prístup k otázke', url($this->question->user->slug, 'navody'))
            ->line('V prípade nutnosti ma kontaktujte telefonicky, Mgr. Gajdoš 0905 320 616')
            ;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
