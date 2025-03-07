<?php

namespace App\Services\Notifiers;

interface NotifierInterface {
    public function sendMessage(string $message): void;
}
