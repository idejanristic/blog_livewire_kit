<?php

namespace App\Acl\Enums;

enum RoleType: string
{
    case SUBSCRIBER = 'subscriber';
    case AUTHOR = 'author';
    case ADMIN = 'admin';

    public function label(): string
    {
        return match ($this) {
            self::SUBSCRIBER => 'Subscriber',
            self::AUTHOR => 'Author',
            self::ADMIN => 'Admin'
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::SUBSCRIBER => 'Subscriber can visit the web app and comment on posts',
            self::AUTHOR => 'Autor can create, update, delete posts and also everthig as a subscriber',
            self::ADMIN => 'Admin is a user who administers the appp'
        };
    }
}
