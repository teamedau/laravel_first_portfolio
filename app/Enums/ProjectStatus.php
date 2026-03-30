<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case Concept = 'concept';
    case Mvp     = 'mvp';
    case Live    = 'live';
}
