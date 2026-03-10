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
        return ['Okuryazar Değil', 'İlkokul', 'Ortaokul', 'Lise', 'Üniversite', 'Yüksek Lisans/Doktora'];
    }

    public static function yesNoOptions(): array
    {
        return ['Evet', 'Hayır'];
    }

    public static function healthInsuranceOptions(): array
    {
        return ['SGK', 'Bağ-Kur', 'Özel Sigorta', 'Yok'];
    }

    public static function genderOptions(): array
    {
        return ['Erkek', 'Kız'];
    }

    public static function termOptions(): array
    {
        return ['Term', 'Prematür', 'Postmatür'];
    }

    public static function bebekChecklistLabels(): array
    {
        return [
            'deri' => 'Deri',
            'bas' => 'Baş',
            'gozler' => 'Gözler',
            'burun' => 'Burun',
            'agiz' => 'Ağız',
            'kulak' => 'Kulak',
            'boyun' => 'Boyun',
            'gogus' => 'Göğüs',
            'abdomen' => 'Abdomen',
            'kasik' => 'Kasik',
            'genital' => 'Genital',
            'solunum_sistemi' => 'Solunum Sistemi',
            'kvs' => 'Kardiyovasküler Sistem',
            'gis' => 'Gastrointestinal Sistem',
            'uriner' => 'Uriner Sistem',
            'kas_iskelet' => 'Kas-Iskelet Sistemi',
            'norolojik' => 'Nörolojik Sistem',
        ];
    }

    public static function bebekChecklistOptions(): array
    {
        return [
            'deri' => ['Pembe, gergin, pürüzsüz', 'İsilik', 'Pişik', 'Sarılık', 'Siyanoz', 'Diğer'],
            'bas' => ['Fontanellerde açıklık', 'Konak', 'Bit', 'Sefal hematom', 'Diğer'],
            'gozler' => ['Çapaklanma', 'Kızariklik', 'İltihaplanma', 'Akinti', 'Şaşılık', 'Ödem', 'Sulanma', 'Diğer'],
            'burun' => ['Akinti', 'Tıkanıklık', 'Burun kanallarinin solunuma katilmasi', 'Diğer'],
            'agiz' => ['Pamukcuk', 'Yarık damak', 'Yarık dudak', 'Diğer'],
            'kulak' => ['Ağrı', 'Akinti', 'Düşük kulak', 'Diğer'],
            'boyun' => ['Şişlik', 'Tortikolis', 'Diğer'],
            'gogus' => ['Şişlik', 'Süt akması', 'Diğer'],
            'abdomen' => ['Kanama', 'Akinti', 'Kızariklik', 'Isı artışı', 'Göbek granülomu', 'Distansiyon', 'Göbek fıtığı', 'Diğer'],
            'kasik' => ['Kasık fıtığı', 'Diğer'],
            'genital' => ['Fimozis', 'İnmemiş testis', 'Hipospadias', 'Epispadias', 'Anuste açıklık', 'Vajinal akıntı', 'Diğer'],
            'solunum_sistemi' => ['Solunum sıkıntısı', 'Siyanoz', 'Apne', 'Pnomoni', 'Diğer'],
            'kvs' => ['Taşikardi', 'Bradikardi', 'Siyanoz', 'Diğer'],
            'gis' => ['Gaita yapma sıklığı', 'Kusma', 'Konstipasyon', 'Diare', 'Dehidratasyon', 'Diğer'],
            'uriner' => ['İdrar yapma sıklığı', 'İdrar yaparken zorluk, sızlama, ağlama', 'İdrar renginde değişiklik', 'İdrarın damla damla yapılması', 'Diğer'],
            'kas_iskelet' => ['DKC', 'Ekstremite anomalisi', 'Diğer'],
            'norolojik' => ['Konvülsiyon', 'Diğer'],
        ];
    }
}

