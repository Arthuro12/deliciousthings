<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case Draft = 'draft';
    case Planning = 'planning';
    case InProgress = 'in-progress';
    case Completed = 'completed';
    case Cancelled = 'cancelled';
}