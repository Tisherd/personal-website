<?php

namespace App\Services\Notification;

use Illuminate\Support\Facades\Http;

class TelegramNotification implements NotificationInterface
{
    protected string $token;
    protected int $chatId;
    protected string $messagePrefix = 'personal website app';

    public function __construct()
    {
        $this->token = config('notifier.telegram.token');
        $this->chatId = config('notifier.telegram.chat_id');
    }

    public function notify(string $message): void
    {
        $message = $this->messagePrefix . PHP_EOL . $message;
        Http::post("https://api.telegram.org/bot{$this->token}/sendMessage", [
            'chat_id' => $this->chatId,
            'text' => $message,
        ]);
    }
}
