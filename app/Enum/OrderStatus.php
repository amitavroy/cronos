<?php

namespace App\Enum;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case FAILED = 'failed';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    /**
     * @return array<int, string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
