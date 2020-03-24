<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRegistration extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $user;
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
//        return (new MailMessage)
//            ->subject('Registrácia -- Verejný Portál-- ' . $this->user->company)
//            ->line('<strong>' . $this->user->company . '</strong> zaregistrovali ste sa na portály <a href="http://verejnyportal.eu">Verejná správa.eu</a>')
//            ->line('Meno: <strong>' . $this->user->company . '</strong> <br>
//                    ulica: ' . $this->user->street . '<br>
//                    Mesto: ' . $this->user->city . '<br>
//                    Tel: ' . $this->user->phone . '<br>
//                    Ičo: ' . $this->user->ico . '<br>')
//            ->action('Váš prístup do zóny TU', url($this->user->company))
//            ->line('<strong>Nové heslo môžete si vygenerovať nové heslo na tomto <a href="http://verejnyportal.eu/password/reset">odkaze</a><strong>')
//            ->line('V prípade akýchkoľvek otázok, kontaktujte ma emailom ale telefonicky, Mgr. Gajdoš 0905 320 616')
//
//            ;
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
