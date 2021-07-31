<?php

namespace App\Notifications\Invitation;

use App\Models\Council\Invitation;
use App\Models\Council\Meeting;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvitationForUser extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    protected $invitation;
    public function __construct( Invitation $invitation)
    {
        $this->invitation = $invitation;
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
            ->greeting('P O Z V Á N K A')
            ->line('Dobrý deň ' . $this->invitation->user->full_name())
            ->line('Pozývame Vás na zasadnutie, '. $this->invitation->meeting->council->name )

            ->line('dňa: ' . $this->invitation->meeting->start_at->format('m. d. Y') . ' o '
                .$this->invitation->meeting->start_at->format('H:i') .' hod.' )
            ->line('Miesto: '. $this->invitation->meeting->locality )


            ->action( $this->invitation->meeting->name , url( route('meetings.show', $this->invitation->meeting->id)))
            ->action( 'Potvrdiť účasť' , url( route('invitations.show', $this->invitation->id)))
            ->line('Vystavené v aplikácií ' . env('APP_NAME'). '.');
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
