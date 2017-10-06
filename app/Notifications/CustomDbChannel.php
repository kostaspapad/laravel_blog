<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CustomDbChannel extends Notification
{
    public function send($notifiable, Notification $notification)
    {
      $data = $notification->toDatabase($notifiable);
  
      return $notifiable->routeNotificationFor('database')->create([
          'id' => $notification->id,
  
          //customize here
          //'answer_id' => $data['answer_id'], //<-- comes from toDatabase() Method below
          'user_id'=> \Auth::user()->id,
          'profile_id'=> \Auth::user()->id,
          'type' => get_class($notification),
          'data' => $data,
          'read_at' => null,
      ]);
    }
}
