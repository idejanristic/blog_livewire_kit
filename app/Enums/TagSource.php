<?php

namespace App\Enums;

enum TagSource: string
{
    case App = 'app';
    case Api = 'api';
    case Seed = 'seed';
}
