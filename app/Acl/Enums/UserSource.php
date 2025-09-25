<?php

namespace App\Acl\Enums;

enum UserSource: string
{
    case APP = 'app';
    case API = 'api';
    case SEED = 'seed';
}
