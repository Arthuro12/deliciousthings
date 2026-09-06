<?php

namespace App\Enums;

enum ServiceRequestStatus: string
{
    case Draft = 'draft';
    case Confirmed = 'confirmed';
    case Sent = 'sent';
    case ResponsesPending = 'responses_pending';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    // Legacy values kept temporarily for already persisted records.
    case Pending = 'pending';
    case Matching = 'matching';
}