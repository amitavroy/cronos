<?php

namespace App\Domain\Notification\Data;

use App\Domain\Notification\Models\Notification;
use Carbon\Carbon;
use Spatie\LaravelData\Data;

class NotificationData extends Data
{
    public function __construct(
        public string $title,
        public string $message,
        private readonly ?Carbon $created_at = null,
    ) {}

    public static function fromModel(Notification $notification): self
    {
        return new self(
            title: $notification->title,
            message: $notification->message,
            created_at: $notification->created_at
        );
    }

    /**
     * @return string[]
     */
    public function with(): array
    {
        return [
            'time_ago' => $this->created_at?->diffForHumans() ?? 'N/A',
        ];
    }
}
