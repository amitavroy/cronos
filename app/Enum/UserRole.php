<?php

namespace App\Enum;

enum UserRole: string
{
    case ADMIN = 'admin';
    case MANAGER = 'manager';
    case CUSTOMER = 'customer';

    /**
     * @return array<int, string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
