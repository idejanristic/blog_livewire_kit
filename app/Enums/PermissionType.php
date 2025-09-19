<?php

namespace App\Enums;

enum PermissionType: string
{
    case Create = 'create';
    case Update = 'update';
    case Delete = 'delete';
    case View = 'view';

    public function label(): string
    {
        return match ($this) {
            self::Create => 'Create',
            self::Update => 'Update',
            self::Delete => 'Delete',
            self::View => 'View'
        };
    }
}
