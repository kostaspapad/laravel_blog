<?php

namespace App\Notifications;

use Carbon\Carbon;
use App\Notifications\CustomDbChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewPrivateMessage extends Notification
{
    use Queueable;

    protected $message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message; 
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
        //return [CustomDbChannel::class];
    }

    public function toDatabase($notifiable)
    {
        return [
            'repliedTime'=>Carbon::now(),
            'sender'=>$this->message->getUserId(),
            'category' => $this->message->getUserId(),
            //'active' => notifiable
        ];
    }
}
