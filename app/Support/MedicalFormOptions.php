<?php

namespace App\Support;

class MedicalFormOptions
{
    public static function clinicalDefaults(): array
    {
        return [
            'lohusa' => [
                'gebelik_kilosu' => 70,
                'mevcut_kilo' => 65,
                'ates' => 36.6,
                'nabiz' => 80,
                'solunum' => 16,
                'tansiyon' => '120/80',
                'hemoglobin' => 12,
            ],
            'bebek' => [
                'kac_haftalik' => 40,
                'izlem_sayisi' => 1,
                'ates' => 36.5,
                'nabiz' => 120,
                'solunum' => 40,
                'kilo' => 3.2,
                'boy' => 50,
                'bas_cevresi' => 34,
                'gogus_cevresi' => 32,
            ],
        ];
    }

    public static function bloodGroups(): array
    {
        return ['A Rh+', 'A Rh-', 'B Rh+', 'B Rh-', 'AB Rh+', 'AB Rh-', '0 Rh+', '0 Rh-'];
    }

    public static function educationLevels(): array
    {
        return ['Okuryazar Degil', 'Ilkokul', 'Ortaokul', 'Lise', 'Universite', 'Yuksek Lisans/Doktora'];
    }

    public static function yesNoOptions(): array
    {
        return ['Evet', 'Hayir'];
    }

    public static function healthInsuranceOptions(): array
    {
        return ['SGK', 'Bag-Kur', 'Ozel Sigorta', 'Yok'];
    }

    public static function genderOptions(): array
    {
        return ['Erkek', 'Kiz'];
    }

    public static function termOptions(): array
    {
        return ['Term', 'Prematur', 'Postmatur'];
    }

    public static function bebekChecklistLabels(): array
    {
        return [
            'deri' => 'Deri',
            'bas' => 'Bas',
            'gozler' => 'Gozler',
            'burun' => 'Burun',
            'agiz' => 'Agiz',
            'kulak' => 'Kulak',
            'boyun' => 'Boyun',
            'gogus' => 'Gogus',
            'abdomen' => 'Abdomen',
            'kasik' => 'Kasik',
            'genital' => 'Genital',
            'solunum_sistemi' => 'Solunum Sistemi',
            'kvs' => 'Kardiyovaskuler Sistem',
            'gis' => 'Gastrointestinal Sistem',
            'uriner' => 'Uriner Sistem',
            'kas_iskelet' => 'Kas-Iskelet Sistemi',
            'norolojik' => 'Norolojik Sistem',
        ];
    }

    public static function bebekChecklistOptions(): array
    {
        return [
            'deri' => ['Pembe, gergin, puruzsuz', 'Isilik', 'Pisik', 'Sarilik', 'Siyanoz', 'Diger'],
            'bas' => ['Fontanellerde aciklik', 'Konak', 'Bit', 'Sefal hematom', 'Diger'],
            'gozler' => ['Capaklanma', 'Kizariklik', 'Iltihaplanma', 'Akinti', 'Sasilik', 'Odem', 'Sulanma', 'Diger'],
            'burun' => ['Akinti', 'Tikaniklik', 'Burun kanallarinin solunuma katilmasi', 'Diger'],
            'agiz' => ['Pamukcuk', 'Yarik damak', 'Yarik dudak', 'Diger'],
            'kulak' => ['Agri', 'Akinti', 'Dusuk kulak', 'Diger'],
            'boyun' => ['Sislik', 'Tortikolis', 'Diger'],
            'gogus' => ['Sislik', 'Sut akmasi', 'Diger'],
            'abdomen' => ['Kanama', 'Akinti', 'Kizariklik', 'Isi artisi', 'Gobek granolomu', 'Distansiyon', 'Gobek fitigi', 'Diger'],
            'kasik' => ['Kasik fitigi', 'Diger'],
            'genital' => ['Fimozis', 'Inmemis testis', 'Hipospadias', 'Epispadias', 'Anuste aciklik', 'Vajinal akinti', 'Diger'],
            'solunum_sistemi' => ['Solunum sikintisi', 'Siyanoz', 'Apne', 'Pnomoni', 'Diger'],
            'kvs' => ['Tasikardi', 'Bradikardi', 'Siyanoz', 'Diger'],
            'gis' => ['Gaita yapma sikligi', 'Kusma', 'Konstipasyon', 'Diare', 'Dehidratasyon', 'Diger'],
            'uriner' => ['Idrar yapma sikligi', 'Idrar yaparken zorluk, sizlama, aglama', 'Idrar renginde degisiklik', 'Idrarin damla damla yapilmasi', 'Diger'],
            'kas_iskelet' => ['DKC', 'Ekstremite anomalisi', 'Diger'],
            'norolojik' => ['Konvulsiyon', 'Diger'],
        ];
    }
}
