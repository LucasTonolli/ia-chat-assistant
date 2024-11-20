<?php

namespace App\Notifications;

use App\Notifications\Channels\WhatsappChannel;
use App\Notifications\Channels\WhatsappMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReminderNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }
    public function via(object $notifiable): array
    {
        return [WhatsappChannel::class];
    }

    public function toWhatsapp($notification)
    {

        return (new WhatsappMessage())
            ->contentSid('HX864d77c4680f14d62bcd4f701ac21d09') //Template ID
            ->variables([]);
    }
}
