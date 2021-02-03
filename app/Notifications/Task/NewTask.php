<?php

namespace App\Notifications\Task;

use App\Models\Task;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewTask extends Notification
{
    use Queueable;

    protected $user;
    protected $task;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Task $task)
    {
        $this->user = $user;
        $this->task = $task;
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
            ->subject( 'Nová požiadavka [' . $this->user->full_name() .']' )
            ->greeting('P O Ž I A D A V K A')
            ->line('Dobrý deň. Bola Vám zaslaná novú požiadavka.')
            ->line('Termín splnenia: ' . $this->dueDate())
            ->action( 'Zobraziť' , url( route('organizations.index')))
            ->line('Vystavené v aplikácií ' . env('APP_NAME'). '.');
    }

    public function dueDate(){
        if ($this->task->due_date == null) {
            return 'Termín realizácie uvedený.';
        } else {
            return $this->task->due_date . ' ' . $this->task->due_time;
        }
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
