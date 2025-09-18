<?php

namespace App\Enums;

enum RoleType: string
{
    case Subscriber = 'subscriber';
    case Author = 'author';
    case Admin = 'admin';

    public function label(): string
    {
        return match ($this) {
            self::Subscriber => 'Subscriber',
            self::Author => 'Author',
            self::Admin => 'Admin'
        };
    }
}
