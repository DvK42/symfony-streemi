<?php

declare(strict_types=1);

namespace App\Enum;

enum MediaTypeEnum: string
{
    case PUBLISHED = 'published';
    case PENDING = 'pending';
    case REJECTED = 'rejected';
}