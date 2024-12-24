<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class NotificationData extends Data
{
    public function __construct(
        public string $title,
        public string $message,
    ) {}
}
