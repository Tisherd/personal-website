<?php

namespace App\Services\Notification;

interface NotificationInterface {
    public function notify(string $message): void;
}
