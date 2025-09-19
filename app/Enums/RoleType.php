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

    public function description(): string
    {
        return match ($this) {
            self::Subscriber => 'Subscriber can visit the web app and comment on posts',
            self::Author => 'Autor can create, update, delete posts and also everthig as a subscriber',
            self::Admin => 'Admin is a user who administers the appp'
        };
    }
}
