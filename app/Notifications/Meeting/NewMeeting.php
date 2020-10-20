<?php

namespace App\Notifications\Meeting;

use App\Models\Council\Meeting;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMeeting extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $user;
    protected $meeting;
    public function __construct(User $user, Meeting $meeting)
    {
        $this->user = $user;
        $this->meeting = $meeting;
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
            ->subject( 'Pozvanie na zasadnutie')
            ->greeting('Dobrý deň ' . $this->user->full_name())
            ->line('Administrátor zverejnil nové stretnutie, dňa '
                . $this->meeting->start_at->format('m. d. Y') . ' o '
                .$this->meeting->start_at->format('H:i') .' hod.' )
            ->action( $this->meeting->name , url( route('meet.show', [ $this->meeting->id, $this->meeting->slug])))
            ->line('Ďakujeme, že používate aplikáciu!');
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
