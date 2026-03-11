<?php

namespace App\Models\Concerns;

trait CalculatesCompletionScore
{
    abstract protected function completionFields(): array;

    protected ?int $completionScoreCache = null;
    protected ?string $completionToneCache = null;

    public function getCompletionScoreAttribute(): int
    {
        if ($this->completionScoreCache !== null) {
            return $this->completionScoreCache;
        }

        $fields = $this->completionFields();
        $total = count($fields);

        if ($total === 0) {
            return $this->completionScoreCache = 0;
        }

        $filled = 0;

        foreach ($fields as $field) {
            if ($this->valueIsFilled($this->getAttribute($field))) {
                $filled++;
            }
        }

        return $this->completionScoreCache = (int) round(($filled / $total) * 100);
    }

    public function getCompletionToneAttribute(): string
    {
        if ($this->completionToneCache !== null) {
            return $this->completionToneCache;
        }

        return $this->completionToneCache = match (true) {
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
