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
            ->greeting('Dobrý deň, ' . $this->user->full_name())
            ->line('Administrátor webu ' . auth()->user()->full_name() . ' Vám vytvoril účet na ' . env('APP_NAME'). '.')
            ->line('Žiada Vás, aby ste si aktivovali svoj prístup vložením emailu '  . $this->user->email. ' a zadaním nového hesla.')
            ->action('Získať prístup k účtu', url( route('password.update')))
//            ->line('Prečo som dostal tento email?')
//            ->greeting('Prečo som dostal tento email?')
            ->line('Ďakujeme že používate aplikáciu ' . env('APP_NAME'));
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
