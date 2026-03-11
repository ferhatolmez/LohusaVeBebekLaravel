<?php

namespace App\Http\Requests;

use App\Support\MedicalFormOptions;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BebekFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $normalized = [];

        foreach (array_keys(MedicalFormOptions::bebekChecklistOptions()) as $field) {
            $normalized[$field] = array_values(array_filter((array) $this->input($field, []), fn ($value) => $value !== null && $value !== ''));
        }

        $this->merge($normalized);
    }

    public function rules(): array
    {
        return [
            'dogum_tarihi' => ['required', 'date', 'before_or_equal:today'],
            'kac_haftalik' => ['nullable', 'integer', 'between:20,45'],
            'muayene_tarihi' => ['required', 'date', 'after_or_equal:dogum_tarihi', 'before_or_equal:today'],
            'izlem_sayisi' => ['required', 'integer', 'between:1,20'],
            'termin_durumu' => ['nullable', Rule::in(MedicalFormOptions::termOptions())],
            'cinsiyet' => ['required', Rule::in(MedicalFormOptions::genderOptions())],
            'kacinci_cocuk' => ['nullable', 'integer', 'between:1,20'],
            'kan_grubu' => ['nullable', Rule::in(MedicalFormOptions::bloodGroups())],
            'ates' => ['nullable', 'numeric', 'between:34,42'],
            'nabiz' => ['nullable', 'integer', 'between:60,220'],
            'solunum' => ['nullable', 'integer', 'between:10,120'],
            'kilo' => ['required', 'numeric', 'between:0.5,10'],
            'boy' => ['required', 'numeric', 'between:20,100'],
            'bas_cevresi' => ['required', 'numeric', 'between:10,80'],
            'gogus_cevresi' => ['nullable', 'numeric', 'between:10,80'],
            'deri' => ['nullable', 'array'],
            'bas' => ['nullable', 'array'],
            'gozler' => ['nullable', 'array'],
            'burun' => ['nullable', 'array'],
            'agiz' => ['nullable', 'array'],
            'kulak' => ['nullable', 'array'],
            'boyun' => ['nullable', 'array'],
            'gogus' => ['nullable', 'array'],
            'abdomen' => ['nullable', 'array'],
            'kasik' => ['nullable', 'array'],
            'genital' => ['nullable', 'array'],
            'solunum_sistemi' => ['nullable', 'array'],
            'kvs' => ['nullable', 'array'],
            'gis' => ['nullable', 'array'],
            'uriner' => ['nullable', 'array'],
            'kas_iskelet' => ['nullable', 'array'],
            'norolojik' => ['nullable', 'array'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute alanı zorunludur.',
            'integer' => ':attribute alanı tam sayı olmalıdır.',
            'numeric' => ':attribute alanı sayısal bir değer olmalıdır.',
            'after_or_equal' => ':attribute tarihi, :date tarihinden önce olamaz.',
            'before_or_equal' => ':attribute tarihi bugünden ileri bir tarih olamaz.',
            'between' => ':attribute değeri kabul edilen aralığın (:min - :max) dışındadır.',
            'in' => 'Seçilen :attribute geçersiz.',
        ];
    }

    public function attributes(): array
    {
        return [
            'dogum_tarihi' => 'Doğum tarihi',
            'kac_haftalik' => 'Haftalık bilgi',
            'muayene_tarihi' => 'Muayene tarihi',
            'izlem_sayisi' => 'İzlem sayısı',
            'termin_durumu' => 'Termin durumu',
            'cinsiyet' => 'Cinsiyet',
            'kacinci_cocuk' => 'Kaçıncı çocuk',
            'kan_grubu' => 'Kan grubu',
            'ates' => 'Ateş',
            'nabiz' => 'Nabız',
            'solunum' => 'Solunum',
            'kilo' => 'Kilo',
            'boy' => 'Boy',
            'bas_cevresi' => 'Baş çevresi',
            'gogus_cevresi' => 'Göğüs çevresi',
            'deri' => 'Deri bulguları',
            'bas' => 'Baş bulguları',
            'gozler' => 'Göz bulguları',
            'burun' => 'Burun bulguları',
            'agiz' => 'Ağız bulguları',
            'kulak' => 'Kulak bulguları',
            'boyun' => 'Boyun bulguları',
            'gogus' => 'Göğüs bulguları',
            'abdomen' => 'Abdomen bulguları',
            'kasik' => 'Kasık bulguları',
            'genital' => 'Genital bulguları',
            'solunum_sistemi' => 'Solunum sistemi bulguları',
            'kvs' => 'KVS bulguları',
            'gis' => 'GIS bulguları',
            'uriner' => 'Üriner sistem bulguları',
            'kas_iskelet' => 'Kas-iskelet sistemi bulguları',
            'norolojik' => 'Nörolojik sistem bulguları',
        ];
    }
}
