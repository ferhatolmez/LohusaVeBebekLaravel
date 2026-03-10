<?php

namespace App\Models;

use App\Models\Concerns\CalculatesCompletionScore;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BebekForm extends Model
{
    use CalculatesCompletionScore;
    use HasFactory;

    protected $fillable = [
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
}
