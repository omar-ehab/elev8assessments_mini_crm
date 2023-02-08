<?php

namespace App\Enums;

enum ActionTypeEnum: string
{
    case Call = 'call';
    case Visit = 'visit';
    case Follow_Up = 'follow_up';

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
