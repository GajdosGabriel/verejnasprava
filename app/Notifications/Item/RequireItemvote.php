<?php

namespace App\Notifications\Item;

use App\Models\Council\Item;
use App\Models\Council\Meeting;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequireItemvote extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $user;
    protected $item;
    public function __construct(User $user, Item $item)
    {
        $this->user = $user;
        $this->item = $item;
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
            ->subject( '[Reakcia], vyžaduje sa vaša aktivita')
            ->greeting('Dobrý deň ' . $this->user->full_name())
            ->line('Administrátor žiada o hlasovanie k bodu ' . $this->item->name)
            ->action( $this->item->name , url( route('item.show', [ $this->item->id, $this->item->slug])))
            ->line('Veríme že sa rozhodnete správne a múdro.');
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
