<?php

namespace App\Enums;

enum UserSource: string
{
    case App = 'app';
    case Api = 'api';
    case Seed = 'seed';
}
