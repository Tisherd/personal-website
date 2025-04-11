<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use App\Services\Notification\NotificationInterface;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendUserLoggedInNotificationListener implements ShouldQueue
{
    protected NotificationInterface $notification;

    public function __construct(NotificationInterface $notification)
    {
        $this->notification = $notification;
    }

    public function handle(UserLoggedIn $event): void
    {
        $this->notification->notify("User {$event->user->name} logged in");
    }
}