<?php

declare(strict_types=1);

namespace App\Enum;

enum UserAccountStatusEnum: string
{
    case ACTIVE = 'active';
    case BANNED = 'banned';
    case BLOCKED = 'blocked';
    case PENDING = 'pending';
    case DELETED = 'deleted';
}