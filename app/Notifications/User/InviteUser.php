<?php

namespace App\Notifications\User;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InviteUser extends Notification
{
    use Queueable;

    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
            ->subject( 'Pozvánka pre, '. $this->user->full_name())
            ->greeting('Dobrý deň ' . $this->user->full_name())
            ->line('Administrátor Vám vytvoril účet na email. '  . $this->user->email)
            ->line('Vložte email '  . $this->user->email . ' a aktivujte si prístup.')
            ->action('Získať prístup k svojmu účtu', url( route('password.update')))
            ->line('Prečo som dostal tento email?')
            ->greeting('Prečo som dostal tento email?')
            ->line('Ďakujeme že používate túto aplikáciu!');
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
