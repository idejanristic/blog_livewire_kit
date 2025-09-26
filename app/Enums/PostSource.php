<?php

namespace App\Enums;

enum PostSource: string
{
    case APP = 'app';
    case API = 'api';
    case SEED = 'seed';
}
