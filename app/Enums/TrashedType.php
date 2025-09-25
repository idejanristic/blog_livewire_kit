<?php

namespace App\Enums;

enum TrashedType: string
{
    case UNTRASHED = 'untrashed';
    case TRASHED = 'trashed';
    case ALL = 'all';

    public function label(): string
    {
        return match ($this) {
            self::ALL => 'All',
            self::TRASHED => 'Trashed',
            self::UNTRASHED => 'Users'
        };
    }

    public function route(): string
    {
        return match ($this) {
            self::ALL => 'admin.users.all',
            self::TRASHED => 'admin.users.treshed',
            self::UNTRASHED => 'admin.users.index'
        };
    }
}
