<?php

namespace App\Notifications;

use App\Notifications\Channels\WhatsappChannel;
use App\Notifications\Channels\WhatsappMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected string $name, protected string $text)
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
            ->contentSid(config('twilio.new_user_notification_sid')) //Template ID
            ->variables([
                '1' => $this->name,
                '2' => $this->text
            ]);

      
    }
}
