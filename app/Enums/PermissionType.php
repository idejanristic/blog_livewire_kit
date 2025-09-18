<?php

namespace App\Enums;

enum PermissionType: string
{
    case Create = 'create';
    case Update = 'update';
    case Delete = 'delete';
    case View = 'view';
}
