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

    public static function familyCurrentDiseaseOptions(): array
    {
        return ['Yok', 'Var', 'Bilinmiyor'];
    }

    public static function midwifeExpectationOptions(): array
    {
        return ['Bilgilendirme ve danışmanlık', 'Emzirme desteği', 'Bebek bakımı desteği', 'Anne sağlığı takibi', 'Psikolojik destek', 'Özel beklenti yok'];
    }

    public static function socioeconomicStatusOptions(): array
    {
        return ['Çok kötü', 'Kötü', 'Orta', 'İyi', 'Çok iyi'];
    }

    public static function familyDecisionMakerOptions(): array
    {
        return ['Anne', 'Baba', 'Eşler birlikte', 'Aile büyükleri', 'Diğer'];
    }

    public static function expressionLevelOptions(): array
    {
        return ['Hiç ortaya koyamıyor', 'Kısmen ortaya koyabiliyor', 'Çoğunlukla ortaya koyabiliyor', 'Rahatça ortaya koyabiliyor'];
    }

    public static function childImportanceOptions(): array
    {
        return ['Düşük', 'Orta', 'Yüksek', 'Çok yüksek'];
    }

    public static function adequacyLevelOptions(): array
    {
        return ['Yetersiz', 'Kısmen yeterli', 'Yeterli'];
    }

    public static function cleanlinessLevelOptions(): array
    {
        return ['Kötü', 'Orta', 'İyi'];
    }

    public static function caregiverAvailabilityOptions(): array
    {
        return ['Yok', 'Var - eş', 'Var - anneanne/babaanne', 'Var - diğer aile bireyleri', 'Var - birden fazla kişi'];
    }

    public static function cookingImpactOptions(): array
    {
        return ['Etkiliyor', 'Kısmen etkiliyor', 'Etkilemiyor', 'Bilinmiyor'];
    }

    public static function storageConditionOptions(): array
    {
        return ['Uygun değil', 'Kısmen uygun', 'Uygun', 'Bilinmiyor'];
    }

    public static function homeTypeOptions(): array
    {
        return ['Konut', 'Apartman', 'Müstakil', 'Gecekondu', 'Diğer'];
    }

    public static function bathAvailabilityOptions(): array
    {
        return ['Var', 'Yok'];
    }

    public static function toiletLocationOptions(): array
    {
        return ['İçeride', 'Dışarıda'];
    }

    public static function childGenderSummaryOptions(): array
    {
        return ['Kız', 'Erkek', 'Kız ve erkek', 'Belirtilmedi'];
    }

    public static function childHealthStatusOptions(): array
    {
        return ['Sağlıklı', 'İzlem gerektiren çocuk var', 'Kronik hastalık var', 'Özel gereksinimli çocuk var'];
    }

    public static function birthHistorySummaryOptions(): array
    {
        return ['Hastane - sağlık personeli - normal doğum', 'Hastane - sağlık personeli - sezaryen', 'Ev - ebe/sağlık personeli', 'Diğer'];
    }

    public static function abortionHistorySummaryOptions(): array
    {
        return ['Hastane - sağlık personeli', 'Özel klinik/doktor', 'Evde/dış müdahale yok', 'Diğer'];
    }

    public static function actionTakenOptions(): array
    {
        return ['Sağlık kuruluşuna başvurdu', 'İlaç kullandı', 'Evde istirahat etti', 'Bir şey yapmadı', 'Diğer'];
    }

    public static function familyPlanningDurationOptions(): array
    {
        return ['Kullanmadı', '6 aydan az', '6-12 ay', '1-3 yıl', '3 yıldan fazla'];
    }

    public static function familyPlanningStopReasonOptions(): array
    {
        return ['Yan etki', 'Gebelik isteği', 'Memnun kalmadı', 'Unutma/uyumsuzluk', 'Erişim sorunu', 'Eş/aile istemedi', 'Hala kullanıyor', 'Diğer'];
    }

    public static function familyPlanningMethodOptions(): array
    {
        return ['Hap', 'RİA', 'Kondom', 'Geleneksel yöntem', 'Yöntem düşünülmüyor', 'Kararsız'];
    }

    public static function genderPreferenceOptions(): array
    {
        return ['Kız', 'Erkek', 'Fark etmez'];
    }

    public static function feelingLevelOptions(): array
    {
        return ['Olumlu', 'Karışık', 'Olumsuz', 'Kararsız'];
    }

    public static function babyThoughtOptions(): array
    {
        return ['Olumlu ve bağlı', 'Endişeli', 'Kararsız', 'Zorlanıyor'];
    }

    public static function familyApproachOptions(): array
    {
        return ['Destekleyici', 'Kısmen destekleyici', 'İlgisiz', 'Olumsuz'];
    }

    public static function postpartumSexualLifeOptions(): array
    {
        return ['Henüz başlamadı', 'Sorun yok', 'Sorun var', 'Bilgi verilmedi'];
    }

    public static function breastCareOptions(): array
    {
        return ['Düzenli bakım yapıyor', 'Kısmen bakım yapıyor', 'Bakım yapmıyor', 'Bilgiye ihtiyacı var'];
    }

    public static function braUsageOptions(): array
    {
        return ['Uygun sütyen kullanıyor', 'Ara sıra kullanıyor', 'Kullanmıyor'];
    }

    public static function eatingPatternOptions(): array
    {
        return ['Düzenli', 'Düzensiz'];
    }

    public static function supplementContentOptions(): array
    {
        return ['Demir', 'D vitamini', 'Kalsiyum', 'Multivitamin', 'Diğer'];
    }

    public static function foodGroupOptions(): array
    {
        return ['Süt ve süt ürünleri', 'Et-yumurta-kurubaklagil', 'Sebze', 'Meyve', 'Tahıl', 'Yağlı/şekerli gıdalar'];
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
            'kasik' => 'Kasık',
            'genital' => 'Genital',
            'solunum_sistemi' => 'Solunum Sistemi',
            'kvs' => 'Kardiyovasküler Sistem',
            'gis' => 'Gastrointestinal Sistem',
            'uriner' => 'Üriner Sistem',
            'kas_iskelet' => 'Kas-İskelet Sistemi',
            'norolojik' => 'Nörolojik Sistem',
        ];
    }

    public static function bebekChecklistOptions(): array
    {
        return [
            'deri' => ['Pembe, gergin, pürüzsüz', 'İsilik', 'Pişik', 'Sarılık', 'Siyanoz', 'Diğer'],
            'bas' => ['Fontanellerde açıklık', 'Konak', 'Bit', 'Sefal hematom', 'Diğer'],
            'gozler' => ['Çapaklanma', 'Kızarıklık', 'İltihaplanma', 'Akıntı', 'Şaşılık', 'Ödem', 'Sulanma', 'Diğer'],
            'burun' => ['Akıntı', 'Tıkanıklık', 'Burun kanallarının solunuma katılması', 'Diğer'],
            'agiz' => ['Pamukçuk', 'Yarık damak', 'Yarık dudak', 'Diğer'],
            'kulak' => ['Ağrı', 'Akıntı', 'Düşük kulak', 'Diğer'],
            'boyun' => ['Şişlik', 'Tortikolis', 'Diğer'],
            'gogus' => ['Şişlik', 'Süt akması', 'Diğer'],
            'abdomen' => ['Kanama', 'Akıntı', 'Kızarıklık', 'Isı artışı', 'Göbek granülomu', 'Distansiyon', 'Göbek fıtığı', 'Diğer'],
            'kasik' => ['Kasık fıtığı', 'Diğer'],
            'genital' => ['Fimozis', 'İnmemiş testis', 'Hipospadias', 'Epispadias', 'Anüste açıklık', 'Vajinal akıntı', 'Diğer'],
            'solunum_sistemi' => ['Solunum sıkıntısı', 'Siyanoz', 'Apne', 'Pnomoni', 'Diğer'],
            'kvs' => ['Taşikardi', 'Bradikardi', 'Siyanoz', 'Diğer'],
            'gis' => ['Gaita yapma sıklığı', 'Kusma', 'Konstipasyon', 'Diare', 'Dehidratasyon', 'Diğer'],
            'uriner' => ['İdrar yapma sıklığı', 'İdrar yaparken zorluk, sızlama, ağlama', 'İdrar renginde değişiklik', 'İdrarın damla damla yapılması', 'Diğer'],
            'kas_iskelet' => ['DKC', 'Ekstremite anomalisi', 'Diğer'],
            'norolojik' => ['Konvülsiyon', 'Diğer'],
        ];
    }
}
