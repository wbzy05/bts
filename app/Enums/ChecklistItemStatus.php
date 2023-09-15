<?php

namespace App\Enums;

enum ChecklistItemStatus: int
{
    case Completed = 1;
    case NotCompleted = 0;

    public function label(): string
    {
        return match ($this) {
            self::Completed => __('Completed'),
            self::NotCompleted => __('Not Completed'),
        };
    }
}
