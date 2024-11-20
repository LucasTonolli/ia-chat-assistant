<?php

namespace App\Notifications;

use App\Notifications\Channels\WhatsappChannel;
use App\Notifications\Channels\WhatsappMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ScheduleListNotification extends Notification
{
    use Queueable;

    protected string $message = "Aqui está sua agenda, {{name}}! 📅

Essas são as próximas tarefas e compromissos que você tem programados:

{{tasks}}

Qualquer coisa que precise ajustar ou adicionar, é só me avisar! 😉";

    protected $tasks = [];

    protected $name;

    /**
     * Create a new notification instance.
     */
    public function __construct($tasks, $name)
    {
        $this->tasks = $tasks->reduce(function ($carry, $item) {
            return "{$carry}\n🕗 {$item->description} às {$item->due_at->format('H:i')} no dia {$item->due_at->format('d/m')}\n";
        });
        $this->name = $name;

        $this->message = str_replace('{{tasks}}', $this->tasks, $this->message);
        $this->message = str_replace('{{name}}', $this->name, $this->message);
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

    public function toWhatsapp()
    {
        return (new WhatsappMessage())
            ->content($this->message);
    }
}
