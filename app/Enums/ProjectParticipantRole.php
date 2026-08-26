<?php

namespace App\Enums;

enum ProjectParticipantRole: string
{
    case Client = 'client';
    case Provider = 'provider';
    case Collaborator = 'collaborator';
}