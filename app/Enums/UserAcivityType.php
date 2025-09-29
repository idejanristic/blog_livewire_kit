<?php

namespace App\Enums;

enum UserAcivityType: string
{
    case CREATED = 'created';
    case UPDATED = 'updated';
    case DELETED = 'deleted';
    case VIEWED = 'viewed';
    case SENT = 'sent';
    case LOGIN = 'login';
    case LOGOUT = 'logout';
    case OTHER = 'other';
}
