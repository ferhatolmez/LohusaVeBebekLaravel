<?php

namespace App\Models;

use App\Models\Concerns\CalculatesCompletionScore;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class BebekForm extends Model
{
    use CalculatesCompletionScore;
    use HasFactory;
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $dispatchesEvents = [
        'created' => \App\Events\FormCreated::class,
    ];

    protected $fillable = [
        'created_by', 'updated_by',
        'dogum_tarihi', 'kac_haftalik', 'muayene_tarihi', 'izlem_sayisi',
        'termin_durumu', 'cinsiyet', 'kacinci_cocuk', 'kan_grubu',
        'ates', 'nabiz', 'solunum', 'kilo', 'boy', 'bas_cevresi', 'gogus_cevresi',
        'deri', 'bas', 'gozler', 'burun', 'agiz', 'kulak', 'boyun',
        'gogus', 'abdomen', 'kasik', 'genital', 'solunum_sistemi', 'kvs',
        'gis', 'uriner', 'kas_iskelet', 'norolojik',
    ];

    protected $casts = [
        'dogum_tarihi' => 'date',
        'muayene_tarihi' => 'date',
        'deri' => 'array',
        'bas' => 'array',
        'gozler' => 'array',
        'burun' => 'array',
        'agiz' => 'array',
        'kulak' => 'array',
        'boyun' => 'array',
        'gogus' => 'array',
        'abdomen' => 'array',
        'kasik' => 'array',
        'genital' => 'array',
        'solunum_sistemi' => 'array',
        'kvs' => 'array',
        'gis' => 'array',
        'uriner' => 'array',
        'kas_iskelet' => 'array',
        'norolojik' => 'array',
    ];

    protected function completionFields(): array
    {
        return [
            'dogum_tarihi', 'kac_haftalik', 'muayene_tarihi', 'izlem_sayisi', 'termin_durumu',
            'cinsiyet', 'kacinci_cocuk', 'kan_grubu', 'ates', 'nabiz', 'solunum', 'kilo',
            'boy', 'bas_cevresi', 'gogus_cevresi', 'deri', 'solunum_sistemi', 'kvs', 'norolojik',
        ];
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when(filled($filters['q'] ?? null), function (Builder $query) use ($filters) {
                $term = $filters['q'];

                $query->where(function (Builder $query) use ($term) {
                    $query->where('cinsiyet', 'like', '%'.$term.'%')
                        ->orWhere('termin_durumu', 'like', '%'.$term.'%')
                        ->orWhere('kac_haftalik', 'like', '%'.$term.'%')
                        ->orWhere('kan_grubu', 'like', '%'.$term.'%');
                });
            })
            ->when(filled($filters['cinsiyet'] ?? null), fn (Builder $query) => $query->where('cinsiyet', $filters['cinsiyet']))
            ->when(filled($filters['termin_durumu'] ?? null), fn (Builder $query) => $query->where('termin_durumu', $filters['termin_durumu']))
            ->when(filled($filters['izlem_min'] ?? null), fn (Builder $query) => $query->where('izlem_sayisi', '>=', (int) $filters['izlem_min']))
            ->when(filled($filters['muayene_from'] ?? null), fn (Builder $query) => $query->whereDate('muayene_tarihi', '>=', $filters['muayene_from']))
            ->when(filled($filters['muayene_to'] ?? null), fn (Builder $query) => $query->whereDate('muayene_tarihi', '<=', $filters['muayene_to']));
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getSuggestedFollowUpDateAttribute(): ?Carbon
    {
        if (! $this->muayene_tarihi) {
            return null;
        }

        $daysByVisit = [1 => 2, 2 => 5, 3 => 10, 4 => 30];
        $days = $daysByVisit[$this->izlem_sayisi] ?? 30;

        return $this->muayene_tarihi->copy()->addDays($days);
    }

    public function getFollowUpToneAttribute(): string
    {
        $date = $this->suggested_follow_up_date;

        if (! $date) {
            return 'secondary';
        }

        return $date->isPast() ? 'danger' : ($date->diffInDays(now()) <= 7 ? 'warning' : 'success');
    }
}
