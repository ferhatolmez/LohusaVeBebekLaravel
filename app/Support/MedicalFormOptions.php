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
        return ['Okuryazar DeÄŸil', 'Ä°lkokul', 'Ortaokul', 'Lise', 'Ãœniversite', 'YÃ¼ksek Lisans/Doktora'];
    }

    public static function yesNoOptions(): array
    {
        return ['Evet', 'HayÄ±r'];
    }

    public static function healthInsuranceOptions(): array
    {
        return ['SGK', 'BaÄŸ-Kur', 'Ã–zel Sigorta', 'Yok'];
    }

    public static function familyCurrentDiseaseOptions(): array
    {
        return ['Yok', 'Var', 'Bilinmiyor'];
    }

    public static function midwifeExpectationOptions(): array
    {
        return ['Bilgilendirme ve danÄ±ÅŸmanlÄ±k', 'Emzirme desteÄŸi', 'Bebek bakÄ±mÄ± desteÄŸi', 'Anne saÄŸlÄ±ÄŸÄ± takibi', 'Psikolojik destek', 'Ã–zel beklenti yok'];
    }

    public static function socioeconomicStatusOptions(): array
    {
        return ['Ã‡ok kÃ¶tÃ¼', 'KÃ¶tÃ¼', 'Orta', 'Ä°yi', 'Ã‡ok iyi'];
    }

    public static function familyDecisionMakerOptions(): array
    {
        return ['Anne', 'Baba', 'EÅŸler birlikte', 'Aile bÃ¼yÃ¼kleri', 'DiÄŸer'];
    }

    public static function expressionLevelOptions(): array
    {
        return ['HiÃ§ ortaya koyamÄ±yor', 'KÄ±smen ortaya koyabiliyor', 'Ã‡oÄŸunlukla ortaya koyabiliyor', 'RahatÃ§a ortaya koyabiliyor'];
    }

    public static function childImportanceOptions(): array
    {
        return ['DÃ¼ÅŸÃ¼k', 'Orta', 'YÃ¼ksek', 'Ã‡ok yÃ¼ksek'];
    }

    public static function adequacyLevelOptions(): array
    {
        return ['Yetersiz', 'KÄ±smen yeterli', 'Yeterli'];
    }

    public static function cleanlinessLevelOptions(): array
    {
        return ['KÃ¶tÃ¼', 'Orta', 'Ä°yi'];
    }

    public static function caregiverAvailabilityOptions(): array
    {
        return ['Yok', 'Var - eÅŸ', 'Var - anneanne/babaanne', 'Var - diÄŸer aile bireyleri', 'Var - birden fazla kiÅŸi'];
    }

    public static function cookingImpactOptions(): array
    {
        return ['Etkiliyor', 'KÄ±smen etkiliyor', 'Etkilemiyor', 'Bilinmiyor'];
    }

    public static function storageConditionOptions(): array
    {
        return ['Uygun deÄŸil', 'KÄ±smen uygun', 'Uygun', 'Bilinmiyor'];
    }

    public static function homeTypeOptions(): array
    {
        return ['Konut', 'Apartman', 'MÃ¼stakil', 'Gecekondu', 'DiÄŸer'];
    }

    public static function bathAvailabilityOptions(): array
    {
        return ['Var', 'Yok'];
    }

    public static function toiletLocationOptions(): array
    {
        return ['Ä°Ã§eride', 'DÄ±ÅŸarÄ±da'];
    }

    public static function childGenderSummaryOptions(): array
    {
        return ['KÄ±z', 'Erkek', 'KÄ±z ve erkek', 'Belirtilmedi'];
    }

    public static function childHealthStatusOptions(): array
    {
        return ['SaÄŸlÄ±klÄ±', 'Ä°zlem gerektiren Ã§ocuk var', 'Kronik hastalÄ±k var', 'Ã–zel gereksinimli Ã§ocuk var'];
    }

    public static function birthHistorySummaryOptions(): array
    {
        return ['Hastane - saÄŸlÄ±k personeli - normal doÄŸum', 'Hastane - saÄŸlÄ±k personeli - sezaryen', 'Ev - ebe/saÄŸlÄ±k personeli', 'DiÄŸer'];
    }

    public static function abortionHistorySummaryOptions(): array
    {
        return ['Hastane - saÄŸlÄ±k personeli', 'Ã–zel klinik/doktor', 'Evde/dÄ±ÅŸ mÃ¼dahale yok', 'DiÄŸer'];
    }

    public static function actionTakenOptions(): array
    {
        return ['SaÄŸlÄ±k kuruluÅŸuna baÅŸvurdu', 'Ä°laÃ§ kullandÄ±', 'Evde istirahat etti', 'Bir ÅŸey yapmadÄ±', 'DiÄŸer'];
    }

    public static function familyPlanningDurationOptions(): array
    {
        return ['KullanmadÄ±', '6 aydan az', '6-12 ay', '1-3 yÄ±l', '3 yÄ±ldan fazla'];
    }

    public static function familyPlanningStopReasonOptions(): array
    {
        return ['Yan etki', 'Gebelik isteÄŸi', 'Memnun kalmadÄ±', 'Unutma/uyumsuzluk', 'EriÅŸim sorunu', 'EÅŸ/aile istemedi', 'Hala kullanÄ±yor', 'DiÄŸer'];
    }

    public static function familyPlanningMethodOptions(): array
    {
        return ['Hap', 'RÄ°A', 'Kondom', 'Geleneksel yÃ¶ntem', 'YÃ¶ntem dÃ¼ÅŸÃ¼nmÃ¼yor', 'KararsÄ±z'];
    }

    public static function genderPreferenceOptions(): array
    {
        return ['KÄ±z', 'Erkek', 'Fark etmez'];
    }

    public static function feelingLevelOptions(): array
    {
        return ['Olumlu', 'KarÄ±ÅŸÄ±k', 'Olumsuz', 'KararsÄ±z'];
    }

    public static function babyThoughtOptions(): array
    {
        return ['Olumlu ve baÄŸlÄ±', 'EndiÅŸeli', 'KararsÄ±z', 'ZorlanÄ±yor'];
    }

    public static function familyApproachOptions(): array
    {
        return ['Destekleyici', 'KÄ±smen destekleyici', 'Ä°lgisiz', 'Olumsuz'];
    }

    public static function postpartumSexualLifeOptions(): array
    {
        return ['HenÃ¼z baÅŸlamadÄ±', 'Sorun yok', 'Sorun var', 'Bilgi verilmedi'];
    }

    public static function breastCareOptions(): array
    {
        return ['DÃ¼zenli bakÄ±m yapÄ±yor', 'KÄ±smen bakÄ±m yapÄ±yor', 'BakÄ±m yapmÄ±yor', 'Bilgiye ihtiyacÄ± var'];
    }

    public static function braUsageOptions(): array
    {
        return ['Uygun sÃ¼tyen kullanÄ±yor', 'Ara sÄ±ra kullanÄ±yor', 'KullanmÄ±yor'];
    }

    public static function eatingPatternOptions(): array
    {
        return ['DÃ¼zenli', 'DÃ¼zensiz'];
    }

    public static function supplementContentOptions(): array
    {
        return ['Demir', 'D vitamini', 'Kalsiyum', 'Multivitamin', 'DiÄŸer'];
    }

    public static function foodGroupOptions(): array
    {
        return ['SÃ¼t ve sÃ¼t Ã¼rÃ¼nleri', 'Et-yumurta-kurubaklagil', 'Sebze', 'Meyve', 'TahÄ±l', 'YaÄŸlÄ±/ÅŸekerli gÄ±dalar'];
    }

    public static function genderOptions(): array
    {
        return ['Erkek', 'KÄ±z'];
    }

    public static function termOptions(): array
    {
        return ['Term', 'PrematÃ¼r', 'PostmatÃ¼r'];
    }

    public static function bebekChecklistLabels(): array
    {
        return [
            'deri' => 'Deri',
            'bas' => 'BaÅŸ',
            'gozler' => 'GÃ¶zler',
            'burun' => 'Burun',
            'agiz' => 'AÄŸÄ±z',
            'kulak' => 'Kulak',
            'boyun' => 'Boyun',
            'gogus' => 'GÃ¶ÄŸÃ¼s',
            'abdomen' => 'Abdomen',
            'kasik' => 'KasÄ±k',
            'genital' => 'Genital',
            'solunum_sistemi' => 'Solunum Sistemi',
            'kvs' => 'KardiyovaskÃ¼ler Sistem',
            'gis' => 'Gastrointestinal Sistem',
            'uriner' => 'Ãœriner Sistem',
            'kas_iskelet' => 'Kas-Ä°skelet Sistemi',
            'norolojik' => 'NÃ¶rolojik Sistem',
        ];
    }

    public static function bebekChecklistOptions(): array
    {
        return [
            'deri' => ['Pembe, gergin, pÃ¼rÃ¼zsÃ¼z', 'Ä°silik', 'PiÅŸik', 'SarÄ±lÄ±k', 'Siyanoz', 'DiÄŸer'],
            'bas' => ['Fontanellerde aÃ§Ä±klÄ±k', 'Konak', 'Bit', 'Sefal hematom', 'DiÄŸer'],
            'gozler' => ['Ã‡apaklanma', 'KÄ±zarÄ±klÄ±k', 'Ä°ltihaplanma', 'AkÄ±ntÄ±', 'ÅaÅŸÄ±lÄ±k', 'Ã–dem', 'Sulanma', 'DiÄŸer'],
            'burun' => ['AkÄ±ntÄ±', 'TÄ±kanÄ±klÄ±k', 'Burun kanallarÄ±nÄ±n solunuma katÄ±lmasÄ±', 'DiÄŸer'],
            'agiz' => ['PamukÃ§uk', 'YarÄ±k damak', 'YarÄ±k dudak', 'DiÄŸer'],
            'kulak' => ['AÄŸrÄ±', 'AkÄ±ntÄ±', 'DÃ¼ÅŸÃ¼k kulak', 'DiÄŸer'],
            'boyun' => ['ÅiÅŸlik', 'Tortikolis', 'DiÄŸer'],
            'gogus' => ['ÅiÅŸlik', 'SÃ¼t akmasÄ±', 'DiÄŸer'],
            'abdomen' => ['Kanama', 'AkÄ±ntÄ±', 'KÄ±zarÄ±klÄ±k', 'IsÄ± artÄ±ÅŸÄ±', 'GÃ¶bek granÃ¼lomu', 'Distansiyon', 'GÃ¶bek fÄ±tÄ±ÄŸÄ±', 'DiÄŸer'],
            'kasik' => ['KasÄ±k fÄ±tÄ±ÄŸÄ±', 'DiÄŸer'],
            'genital' => ['Fimozis', 'Ä°nmemiÅŸ testis', 'Hipospadias', 'Epispadias', 'AnÃ¼ste aÃ§Ä±klÄ±k', 'Vajinal akÄ±ntÄ±', 'DiÄŸer'],
            'solunum_sistemi' => ['Solunum sÄ±kÄ±ntÄ±sÄ±', 'Siyanoz', 'Apne', 'Pnomoni', 'DiÄŸer'],
            'kvs' => ['TaÅŸikardi', 'Bradikardi', 'Siyanoz', 'DiÄŸer'],
            'gis' => ['Gaita yapma sÄ±klÄ±ÄŸÄ±', 'Kusma', 'Konstipasyon', 'Diare', 'Dehidratasyon', 'DiÄŸer'],
            'uriner' => ['Ä°drar yapma sÄ±klÄ±ÄŸÄ±', 'Ä°drar yaparken zorluk, sÄ±zlama, aÄŸlama', 'Ä°drar renginde deÄŸiÅŸiklik', 'Ä°drarÄ±n damla damla yapÄ±lmasÄ±', 'DiÄŸer'],
            'kas_iskelet' => ['DKC', 'Ekstremite anomalisi', 'DiÄŸer'],
            'norolojik' => ['KonvÃ¼lsiyon', 'DiÄŸer'],
        ];
    }
}
