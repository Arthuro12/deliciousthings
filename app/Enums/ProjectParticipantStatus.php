<?php

namespace App\Enums;

enum ProjectParticipantStatus: string
{
    case Invited = 'invited';
    case Active = 'active';
    case Declined = 'declined';
    case Left = 'left';
    case Removed = 'removed';
}