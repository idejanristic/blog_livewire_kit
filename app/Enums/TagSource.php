<?php

namespace App\Enums;

enum TagSource: string
{
    case APP = 'app';
    case API = 'api';
    case SEED = 'seed';
}
