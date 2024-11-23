<?php

namespace App\Notifications;

use App\Notifications\Channels\WhatsappChannel;
use App\Notifications\Channels\WhatsappMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriptionCancelledNotification extends Notification
{
    use Queueable;


    protected string $message = 'Assinatura cancelada!';
    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [WhatsappChannel::class];
    }

    public function toWhatsapp($notification)
    {

        return (new WhatsappMessage())
            ->content($this->message);
    }
}
