<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ActivityLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'action',
        'model_type',
        'model_id',
        'changes',
        'ip_address',
        'created_at',
    ];

    protected $casts = [
        'changes' => 'array',
        'created_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subject(): MorphTo
    {
        return $this->morphTo('model');
    }

    public static function record(string $action, Model $model, ?array $changes = null): self
    {
        return self::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'model_type' => $model->getMorphClass(),
            'model_id' => $model->getKey(),
            'changes' => $changes,
            'ip_address' => request()->ip(),
            'created_at' => now(),
        ]);
    }
}
