<?php

namespace App\Domain\Notification\Data;

use Spatie\LaravelData\Data;

class NotificationData extends Data
{
    public function __construct(
        public string $title,
        public string $message,
    ) {}
}
