<?php

namespace App\Enums;

enum Role: string
{
    case Admin = 'admin';
    case Ebe = 'ebe';
    case Student = 'student';

    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Yönetici',
            self::Ebe => 'Ebe',
            self::Student => 'Öğrenci',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Admin => '#ef4444',
            self::Ebe => '#3b82f6',
            self::Student => '#f59e0b',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Admin => 'shield',
            self::Ebe => 'stethoscope',
            self::Student => 'graduation-cap',
        };
    }

    public function badgeStyle(): string
    {
        return match ($this) {
            self::Admin => 'background:#ef4444;color:#fff',
            self::Ebe => 'background:#3b82f6;color:#fff',
            self::Student => 'background:#f59e0b;color:#1e293b',
        };
    }
}
