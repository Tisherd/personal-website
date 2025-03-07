<?php

namespace App\Services\Notifiers;

use Illuminate\Support\Facades\Http;

class TelegramNotifier implements NotifierInterface
{
    protected $token;
    protected $chatId;

    public function __construct()
    {
        $this->token = config('notifier.telegram.token');
        $this->chatId = config('notifier.telegram.chat_id');
    }

    public function sendMessage(string $message): void
    {
        Http::post("https://api.telegram.org/bot{$this->token}/sendMessage", [
            'chat_id' => $this->chatId,
            'text' => $message,
        ]);
    }
}
