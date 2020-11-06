<?php

namespace App\Notifications;

use App\Models\Question;
use App\Models\Support;
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
    public function __construct(Support $question)
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
            ->subject( 'Odpoveď na dotaz ' . env('APP_NAME'))
            ->greeting('Dobrý deň, ' . $this->question->user->full_name())
            ->line( 'Dostali ste novú odoveď na vašu otázku.')
            ->line( 'Vaša otázka:')
            ->line( '" ' . $this->question->question .' "' )
            ->action('Zobraziť odpoveď', url('supports'))
            ->line('V prípade ďalších technických otázok vám zodpovie, Mgr. Gajdoš 0905 320 616')
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
