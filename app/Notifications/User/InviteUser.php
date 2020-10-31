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
            ->subject( 'Pozvánka pre, '. $this->user->first_name)
            ->greeting('Dobrý deň, ' . $this->user->full_name())
            ->line('Administrátor ' . auth()->user()->full_name() . ' Vám vytvoril účet v aplikácii' . env('APP_NAME'). '.')
            ->line('Aktivujte si prístup vložením emailu '  . $this->user->email. ' a zadaním nového hesla.')
            ->action('Získať prístup k účtu', url( route('password.update')))
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
