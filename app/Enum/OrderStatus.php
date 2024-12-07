<?php

namespace App\Enum;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case FAILED = 'failed';
    case COMPLETE = 'complete';
    case CANCELLED = 'cancelled';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
