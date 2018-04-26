<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EventNotification extends Notification
{
    use Queueable;

    private $Event;
    private $Message;
    private $Author;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( $Event , $Message, $Author )
    {
        $this->Event = $Event;
        $this->Message = $Message;
        $this->Author = $Author;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'Event' => $this->Event,
            'Message' => $this->Message,
            'Author' => $this->Author,
        ];
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
