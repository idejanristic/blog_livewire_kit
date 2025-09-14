<?php

namespace App\Enums;

enum UserAcivityType: string
{
    case Created = 'created';
    case Updated = 'updated';
    case Deleted = 'deleted';
    case Viewed = 'viewed';
    case Sent = 'sent';
    case Login = 'login';
    case Logout = 'logout';
    case Other = 'other';
}
