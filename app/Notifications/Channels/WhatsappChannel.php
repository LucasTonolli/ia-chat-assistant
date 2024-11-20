<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;
use Twilio\Rest\Client;

class WhatsappChannel
{
  public function send($notifiable, Notification $notification)
  {
    $message = $notification->toWhatsapp($notifiable);

    $to = 'whatsapp:' . $notifiable->routeNotificationFor('Whatsapp');
    $from = config('twilio.from');

    $twilio = new Client(
      config('twilio.account_sid'),
      config('twilio.auth_token')
    );

   

    if ($message->contentSid) {

      return $twilio->messages->create(
        $to,
        [
          'from' => 'whatsapp:' . $from,
          'contentSid' => $message->contentSid,
          'contentVariables' => $message->variables
        ]
      );
    }

    return $twilio->messages->create(
      'whatsapp:' . $to,
      [
        'from' =>  'whatsapp:' . $from,
        'body' => $message->content
      ]
    );
  }
}
