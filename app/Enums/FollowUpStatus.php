<?php

namespace App\Enums;

enum FollowUpStatus: string
{
    case Upcoming = 'upcoming';
    case Overdue = 'overdue';
    case Completed = 'completed';
    case NoTarget = 'no_target';

    public function label(): string
    {
        return match ($this) {
            self::Upcoming => 'Yaklaşan',
            self::Overdue => 'Geciken',
            self::Completed => 'Tamamlandı',
            self::NoTarget => 'Hedef yok',
        };
    }

    public function badge(): string
    {
        return match ($this) {
            self::Upcoming => 'warning',
            self::Overdue => 'danger',
            self::Completed => 'success',
            self::NoTarget => 'secondary',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Upcoming => 'clock',
            self::Overdue => 'alert-triangle',
            self::Completed => 'check-circle',
            self::NoTarget => 'minus-circle',
        };
    }
}
