<?php

namespace App\Models\Concerns;

trait CalculatesCompletionScore
{
    abstract protected function completionFields(): array;

    public function getCompletionScoreAttribute(): int
    {
        $fields = $this->completionFields();
        $total = count($fields);

        if ($total === 0) {
            return 0;
        }

        $filled = 0;

        foreach ($fields as $field) {
            if ($this->valueIsFilled($this->getAttribute($field))) {
                $filled++;
            }
        }

        return (int) round(($filled / $total) * 100);
    }

    public function getCompletionToneAttribute(): string
    {
        return match (true) {
            $this->completion_score >= 80 => 'success',
            $this->completion_score >= 50 => 'warning',
            default => 'danger',
        };
    }

    protected function valueIsFilled(mixed $value): bool
    {
        if (is_array($value)) {
            return count(array_filter($value, fn ($item) => $item !== null && $item !== '' && $item !== false)) > 0;
        }

        return $value !== null && $value !== '';
    }
}
