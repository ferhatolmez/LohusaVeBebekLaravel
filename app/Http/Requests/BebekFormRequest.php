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
            'kac_haftalik' => ['required', 'integer', 'between:20,45'],
            'muayene_tarihi' => ['required', 'date', 'after_or_equal:dogum_tarihi', 'before_or_equal:today'],
            'izlem_sayisi' => ['required', 'integer', 'between:1,20'],
            'termin_durumu' => ['required', Rule::in(MedicalFormOptions::termOptions())],
            'cinsiyet' => ['required', Rule::in(MedicalFormOptions::genderOptions())],
            'kacinci_cocuk' => ['required', 'integer', 'between:1,20'],
            'kan_grubu' => ['required', Rule::in(MedicalFormOptions::bloodGroups())],
            'ates' => ['required', 'numeric', 'between:34,42'],
            'nabiz' => ['required', 'integer', 'between:60,220'],
            'solunum' => ['required', 'integer', 'between:10,120'],
            'kilo' => ['required', 'numeric', 'between:0.5,10'],
            'boy' => ['required', 'numeric', 'between:20,100'],
            'bas_cevresi' => ['required', 'numeric', 'between:10,80'],
            'gogus_cevresi' => ['required', 'numeric', 'between:10,80'],
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
            'required' => ':attribute zorunludur.',
            'integer' => ':attribute sadece sayi olmali.',
            'numeric' => ':attribute sayisal bir deger olmali.',
            'after_or_equal' => ':attribute dogum tarihinden once olamaz.',
            'before_or_equal' => ':attribute bugunden ileri bir tarih olamaz.',
            'between' => ':attribute kabul edilen araligin disinda.',
        ];
    }

    public function attributes(): array
    {
        return [
            'dogum_tarihi' => 'Dogum tarihi',
            'kac_haftalik' => 'Haftalik bilgi',
            'muayene_tarihi' => 'Muayene tarihi',
            'izlem_sayisi' => 'Izlem sayisi',
            'termin_durumu' => 'Termin durumu',
            'cinsiyet' => 'Cinsiyet',
            'kacinci_cocuk' => 'Kacinci cocuk',
            'kan_grubu' => 'Kan grubu',
            'ates' => 'Ates',
            'nabiz' => 'Nabiz',
            'solunum' => 'Solunum',
            'kilo' => 'Kilo',
            'boy' => 'Boy',
            'bas_cevresi' => 'Bas cevresi',
            'gogus_cevresi' => 'Gogus cevresi',
        ];
    }
}
