<?php

namespace App\Http\Requests;

use App\Support\MedicalFormOptions;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLohusaFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $arrayFields = [
            'sorun_paylasma',
            'gecmis_tibbi_oyku_kendisi',
            'gecmis_tibbi_oyku_ailesi',
            'gebelik_problemleri_son',
            'gebelik_problemleri_onceki',
            'dogum_problemleri_son',
            'dogum_problemleri_onceki',
            'postpartum_problemleri',
            'postpartum_sikayetleri',
            'geleneksel_uygulamalar',
            'psikolojik_belirtiler',
            'anne_bebek_iliskisi',
            'emzirme_bulgular',
            'sut_yeterliligi',
            'egitim_istekleri',
            'uykusuzluk',
            'bas_bulgular',
            'sacli_deri_bulgular',
            'yuz_bulgular',
            'goz_bulgular',
            'burun_bulgular',
            'agiz_disfer_bulgular',
            'bogaz_bulgular',
            'solunum_bulgular',
            'gogus_bulgular',
            'losia_bulgulari',
            'abdomen_bulgulari',
            'uriner_bulgular',
            'barsak_bulgular',
            'alt_ekstremite',
            'deri',
            'bas',
            'gozler',
            'burun',
            'agiz',
            'kulak',
            'boyun',
            'gogus',
            'abdomen',
            'kasik',
            'genital',
            'solunum_sistemi',
            'kvs',
            'gis',
            'uriner',
            'kas_iskelet',
            'norolojik',
        ];

        $data = [];

        foreach ($arrayFields as $field) {
            $data[$field] = array_values(array_filter((array) $this->input($field, []), fn ($value) => $value !== null && $value !== ''));
        }

        $fizikselMuayene = [];

        foreach ($this->fizikselMuayeneKeys() as $key) {
            $fizikselMuayene[$key] = $this->boolean($key);
        }

        $this->merge(array_merge($data, [
            'fiziksel_muayene' => $fizikselMuayene,
        ]));
    }

    public function rules(): array
    {
        $bloodGroups = MedicalFormOptions::bloodGroups();
        $yesNo = MedicalFormOptions::yesNoOptions();
        $educations = MedicalFormOptions::educationLevels();
        $insurances = MedicalFormOptions::healthInsuranceOptions();
        $familyCurrentDiseases = MedicalFormOptions::familyCurrentDiseaseOptions();
        $midwifeExpectations = MedicalFormOptions::midwifeExpectationOptions();
        $socioeconomicStatuses = MedicalFormOptions::socioeconomicStatusOptions();
        $familyDecisionMakers = MedicalFormOptions::familyDecisionMakerOptions();
        $expressionLevels = MedicalFormOptions::expressionLevelOptions();
        $childImportanceLevels = MedicalFormOptions::childImportanceOptions();
        $adequacyLevels = MedicalFormOptions::adequacyLevelOptions();
        $cleanlinessLevels = MedicalFormOptions::cleanlinessLevelOptions();
        $caregiverAvailability = MedicalFormOptions::caregiverAvailabilityOptions();
        $cookingImpactOptions = MedicalFormOptions::cookingImpactOptions();
        $storageConditionOptions = MedicalFormOptions::storageConditionOptions();
        $homeTypes = MedicalFormOptions::homeTypeOptions();
        $bathAvailabilityOptions = MedicalFormOptions::bathAvailabilityOptions();
        $toiletLocationOptions = MedicalFormOptions::toiletLocationOptions();
        $childGenderSummaryOptions = MedicalFormOptions::childGenderSummaryOptions();
        $childHealthStatusOptions = MedicalFormOptions::childHealthStatusOptions();
        $birthHistorySummaryOptions = MedicalFormOptions::birthHistorySummaryOptions();
        $abortionHistorySummaryOptions = MedicalFormOptions::abortionHistorySummaryOptions();
        $actionTakenOptions = MedicalFormOptions::actionTakenOptions();
        $familyPlanningDurationOptions = MedicalFormOptions::familyPlanningDurationOptions();
        $familyPlanningStopReasonOptions = MedicalFormOptions::familyPlanningStopReasonOptions();
        $familyPlanningMethodOptions = MedicalFormOptions::familyPlanningMethodOptions();
        $genderPreferenceOptions = MedicalFormOptions::genderPreferenceOptions();
        $feelingLevelOptions = MedicalFormOptions::feelingLevelOptions();
        $babyThoughtOptions = MedicalFormOptions::babyThoughtOptions();
        $familyApproachOptions = MedicalFormOptions::familyApproachOptions();
        $postpartumSexualLifeOptions = MedicalFormOptions::postpartumSexualLifeOptions();
        $breastCareOptions = MedicalFormOptions::breastCareOptions();
        $braUsageOptions = MedicalFormOptions::braUsageOptions();
        $eatingPatternOptions = MedicalFormOptions::eatingPatternOptions();
        $supplementContentOptions = MedicalFormOptions::supplementContentOptions();
        $foodGroupOptions = MedicalFormOptions::foodGroupOptions();
        $genders = MedicalFormOptions::genderOptions();
        $terms = MedicalFormOptions::termOptions();

        return [
            'ad_soyad' => ['required', 'string', 'min:3', 'max:120', 'regex:/^[\pL\s\'.-]+$/u'],
            'yas' => ['required', 'integer', 'between:12,60'],
            'egitim_durumu' => ['nullable', Rule::in($educations)],
            'meslek' => ['nullable', 'string', 'min:2', 'max:100', 'regex:/^[\pL\s\'.-]+$/u'],
            'saglik_guvence' => ['nullable', Rule::in($insurances)],
            'akraba_evliligi' => ['nullable', Rule::in($yesNo)],
            'evlilik_yili' => ['nullable', 'integer', 'min:1950', 'max:'.date('Y')],
            'kan_grubu' => ['nullable', Rule::in($bloodGroups)],
            'gebelik_planlandimi' => ['nullable', Rule::in($yesNo)],
            'dogum_yeri' => ['nullable', 'string', 'max:100', 'regex:/^[\pL\s\'.-]+$/u'],
            'es_yas' => ['nullable', 'integer', 'between:12,80'],
            'es_dogum_yeri' => ['nullable', 'string', 'max:100', 'regex:/^[\pL\s\'.-]+$/u'],
            'es_egitim' => ['nullable', Rule::in($educations)],
            'es_meslek' => ['nullable', 'string', 'max:100', 'regex:/^[\pL\s\'.-]+$/u'],
            'es_kan_grubu' => ['nullable', Rule::in($bloodGroups)],
            'es_telefon' => ['nullable', 'regex:/^[0-9\s\(\)\-+]+$/', 'min:10', 'max:20'],
            'es_adres' => ['nullable', 'string', 'max:500'],
            'ailenin_hastalik_durumu' => ['nullable', 'string', 'max:1000'],
            'kontrollerin_onemi_biliniyor' => ['nullable', 'string', 'max:1000'],
            'aile_mevcut_hastaliklar' => ['nullable', Rule::in($familyCurrentDiseases)],
            'aile_ebeden_beklentiler' => ['nullable', Rule::in($midwifeExpectations)],
            'ucretsiz_saglik_bilgisi' => ['nullable', 'string', 'max:1000'],
            'sosyoekonomik_durum' => ['nullable', Rule::in($socioeconomicStatuses)],
            'ailede_karar_veren' => ['nullable', Rule::in($familyDecisionMakers)],
            'aile_duygu_ortaya_koyma' => ['nullable', Rule::in($expressionLevels)],
            'sorun_paylasma' => ['nullable', 'array'],
            'cocuga_verilen_onem' => ['nullable', Rule::in($childImportanceLevels)],
            'ev_tipi' => ['nullable', 'string', 'max:100'],
            'ev_odalar_islev_isi_hava' => ['nullable', Rule::in($adequacyLevels)],
            'pencere_aydinlik' => ['nullable', Rule::in($cleanlinessLevels)],
            'banyo_var_mi' => ['nullable', 'string', 'max:1000'],
            'banyo_temizlik' => ['nullable', Rule::in($cleanlinessLevels)],
            'tuvalet_konum' => ['nullable', 'string', 'max:1000'],
            'tuvalet_durumu' => ['nullable', Rule::in($cleanlinessLevels)],
            'bakim_verenler' => ['nullable', Rule::in($caregiverAvailability)],
            'yemek_pisirme_besin_degeri' => ['nullable', Rule::in($cookingImpactOptions)],
            'yiyecek_saklama_kosullari' => ['nullable', Rule::in($storageConditionOptions)],
            'gecmis_tibbi_oyku_kendisi' => ['nullable', 'array'],
            'gecmis_tibbi_oyku_ailesi' => ['nullable', 'array'],
            'gecmis_tibbi_oyku_diger_aciklama' => ['nullable', 'string', 'max:1000'],
            'menars_yasi' => ['nullable', 'integer', 'between:8,25'],
            'normal_sure_25_kisa' => ['nullable', 'string', 'max:100'],
            'normal_sure_35_uzun' => ['nullable', 'string', 'max:100'],
            'kanama_sure_3_kisa' => ['nullable', 'string', 'max:100'],
            'kanama_sure_7_uzun' => ['nullable', 'string', 'max:100'],
            'siklus_duzenli' => ['nullable', 'string', 'max:100'],
            'gunde_kac_ped' => ['nullable', 'integer', 'between:0,20'],
            'para' => ['nullable', 'integer', 'between:0,20'],
            'abortus' => ['nullable', 'integer', 'between:0,20'],
            'yasayan' => ['nullable', 'integer', 'between:0,20'],
            'gravida' => ['nullable', 'integer', 'between:0,20'],
            'cocuklarin_cinsiyeti' => ['nullable', Rule::in($childGenderSummaryOptions)],
            'cocuklarin_saglik_durumu' => ['nullable', Rule::in($childHealthStatusOptions)],
            'dogum_yeri_kisi_sekli' => ['nullable', Rule::in($birthHistorySummaryOptions)],
            'abortus_yeri_kisi' => ['nullable', Rule::in($abortionHistorySummaryOptions)],
            'gebelik_problemleri_son' => ['nullable', 'array'],
            'gebelik_problemleri_onceki' => ['nullable', 'array'],
            'dogum_problemleri_son' => ['nullable', 'array'],
            'dogum_problemleri_onceki' => ['nullable', 'array'],
            'postpartum_problemleri' => ['nullable', 'array'],
            'postpartum_gun' => ['nullable', 'integer', 'between:0,60'],
            'hastaneden_cikis_gun' => ['nullable', 'integer', 'between:0,30'],
            'ilac_kullaniyor_mu' => ['nullable', 'string', 'max:255'],
            'postpartum_sikayetleri' => ['nullable', 'array'],
            'ne_yapildi' => ['nullable', Rule::in($actionTakenOptions)],
            'sigara_var_mi' => ['nullable', Rule::in($yesNo)],
            'alkol_var_mi' => ['nullable', Rule::in($yesNo)],
            'dogum_sonrasi_kontrol' => ['nullable', 'string', 'max:255'],
            'ap_hap_sure' => ['nullable', Rule::in($familyPlanningDurationOptions)],
            'ap_hap_neden' => ['nullable', Rule::in($familyPlanningStopReasonOptions)],
            'ap_ria_sure' => ['nullable', Rule::in($familyPlanningDurationOptions)],
            'ap_ria_neden' => ['nullable', Rule::in($familyPlanningStopReasonOptions)],
            'ap_kondom_sure' => ['nullable', Rule::in($familyPlanningDurationOptions)],
            'ap_kondom_neden' => ['nullable', Rule::in($familyPlanningStopReasonOptions)],
            'ap_geleneksel_yontem_sure' => ['nullable', Rule::in($familyPlanningDurationOptions)],
            'ap_geleneksel_yontem_neden' => ['nullable', Rule::in($familyPlanningStopReasonOptions)],
            'su_an_ap_yontem' => ['nullable', Rule::in($familyPlanningMethodOptions)],
            'bebek_cinsiyet' => ['nullable', Rule::in($genders)],
            'anne_tercihi' => ['nullable', Rule::in($genderPreferenceOptions)],
            'cinsiyet_duygu' => ['nullable', Rule::in($feelingLevelOptions)],
            'bebek_dusunceleri' => ['nullable', Rule::in($babyThoughtOptions)],
            'endise_var_mi' => ['nullable', Rule::in($yesNo)],
            'aile_yaklasim' => ['nullable', Rule::in($familyApproachOptions)],
            'dogum_sonrasi_cinsel_yasam' => ['nullable', Rule::in($postpartumSexualLifeOptions)],
            'geleneksel_uygulamalar' => ['nullable', 'array'],
            'muayene_tarihi' => ['required', 'date', 'before_or_equal:today'],
            'postpartum_hafta' => ['nullable', 'integer', 'between:0,8'],
            'gebelik_kilosu' => ['nullable', 'numeric', 'between:35,200'],
            'mevcut_kilo' => ['required', 'numeric', 'between:30,200'],
            'ates' => ['required', 'numeric', 'between:34,42'],
            'nabiz' => ['nullable', 'numeric', 'between:30,220'],
            'solunum' => ['nullable', 'numeric', 'between:5,80'],
            'tansiyon' => ['required', 'regex:/^\d{2,3}\/\d{2,3}$/'],
            'bas_bulgular' => ['nullable', 'array'],
            'sacli_deri_bulgular' => ['nullable', 'array'],
            'yuz_bulgular' => ['nullable', 'array'],
            'goz_bulgular' => ['nullable', 'array'],
            'burun_bulgular' => ['nullable', 'array'],
            'agiz_disfer_bulgular' => ['nullable', 'array'],
            'bogaz_bulgular' => ['nullable', 'array'],
            'solunum_bulgular' => ['nullable', 'array'],
            'gogus_bulgular' => ['nullable', 'array'],
            'meme_ucu' => ['nullable', 'string', 'max:255'],
            'emzirmeye_uygun' => ['nullable', 'string', 'max:1000'],
            'meme_bakimi' => ['nullable', Rule::in($breastCareOptions)],
            'sutyen_kullanimi' => ['nullable', Rule::in($braUsageOptions)],
            'fundus_palpe_ediliyor' => ['nullable', 'string', 'max:255'],
            'losia_tipi' => ['nullable', 'string', 'max:255'],
            'losia_bulgulari' => ['nullable', 'array'],
            'abdomen_bulgulari' => ['nullable', 'array'],
            'uriner_bulgular' => ['nullable', 'array'],
            'barsak_bulgular' => ['nullable', 'array'],
            'alt_ekstremite' => ['nullable', 'array'],
            'uykusuzluk' => ['nullable', 'array'],
            'hemoglobin' => ['nullable', 'numeric', 'between:4,25'],
            'diyet_var_mi' => ['nullable', 'string', 'max:255'],
            'kilo_sorunu_tipi' => ['nullable', 'string', 'max:255'],
            'istahsizlik' => ['nullable', 'string', 'max:255'],
            'yeme_aliskanligi' => ['nullable', Rule::in($eatingPatternOptions)],
            'yeme_aliskanligi_aciklama' => ['nullable', 'string', 'max:1000'],
            'vitamin_destegi' => ['nullable', 'string', 'max:255'],
            'vitamin_icerigi' => ['nullable', Rule::in($supplementContentOptions)],
            'yiyemedigi_yiyecek' => ['nullable', 'string', 'max:255'],
            'yiyemedigi_yiyecek_aciklama' => ['nullable', 'string', 'max:1000'],
            'alinan_besin_gruplari' => ['nullable', 'array'],
            'bebek_beslenmesi' => ['nullable', 'string', 'max:255'],
            'psikolojik_belirtiler' => ['nullable', 'array'],
            'psikolojik_diger_aciklama' => ['nullable', 'string', 'max:1000'],
            'anne_bebek_iliskisi' => ['nullable', 'array'],
            'emzirme_bulgular' => ['nullable', 'array'],
            'emzirme_suresi' => ['nullable', 'integer', 'between:0,180'],
            'sut_yeterliligi' => ['nullable', 'array'],
            'egitim_istekleri' => ['nullable', 'array'],
            'ebenin_yorumu' => ['nullable', 'string', 'max:2000'],
            'dogum_tarihi' => ['required', 'date', 'before_or_equal:today'],
            'kac_haftalik' => ['nullable', 'integer', 'between:20,45'],
            'izlem_sayisi' => ['nullable', 'integer', 'between:1,20'],
            'termin_durumu' => ['nullable', Rule::in($terms)],
            'cinsiyet' => ['nullable', Rule::in($genders)],
            'kacinci_cocuk' => ['nullable', 'integer', 'between:1,20'],
            'kilo' => ['nullable', 'numeric', 'between:0.5,10'],
            'boy' => ['nullable', 'numeric', 'between:20,100'],
            'bebek_ates' => ['nullable', 'numeric', 'between:34,42'],
            'bebek_nabiz' => ['nullable', 'numeric', 'between:60,220'],
            'bebek_solunum' => ['nullable', 'numeric', 'between:10,120'],
            'bas_cevresi' => ['nullable', 'numeric', 'between:10,80'],
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
            'fiziksel_muayene' => ['nullable', 'array'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute alanı zorunludur.',
            'integer' => ':attribute alanı tam sayı olmalıdır.',
            'numeric' => ':attribute alanı sayısal bir değer olmalıdır.',
            'date' => ':attribute geçerli bir tarih olmalıdır.',
            'before_or_equal' => ':attribute tarihi bugünden ileri olamaz.',
            'between' => ':attribute değeri :min ile :max arasında olmalıdır.',
            'min' => ':attribute alanı en az :min karakter olmalıdır.',
            'max' => ':attribute alanı en fazla :max karakter olmalıdır.',
            'regex' => ':attribute formatı geçersiz.',
            'in' => 'Seçilen :attribute geçersiz.',
        ];
    }

    public function attributes(): array
    {
        return [
            'ad_soyad' => 'Ad soyad',
            'yas' => 'Yaş',
            'egitim_durumu' => 'Eğitim durumu',
            'meslek' => 'Meslek',
            'saglik_guvence' => 'Sağlık güvencesi',
            'akraba_evliligi' => 'Akraba evliliği',
            'evlilik_yili' => 'Evlilik yılı',
            'kan_grubu' => 'Kan grubu',
            'gebelik_planlandimi' => 'Gebelik planlandı mı',
            'dogum_yeri' => 'Doğum yeri',
            'es_yas' => 'Eşinin yaşı',
            'es_dogum_yeri' => 'Eşinin doğum yeri',
            'es_egitim' => 'Eşinin eğitim durumu',
            'es_meslek' => 'Eşinin mesleği',
            'es_kan_grubu' => 'Eşinin kan grubu',
            'es_telefon' => 'Eşinin telefonu',
            'es_adres' => 'Eşinin adresi',
            'ailenin_hastalik_durumu' => 'Ailenin hastalık durumu',
            'kontrollerin_onemi_biliniyor' => 'Kontrollerin önemi',
            'aile_mevcut_hastaliklar' => 'Ailede mevcut hastalıklar',
            'aile_ebeden_beklentiler' => 'Ebeden beklentiler',
            'ucretsiz_saglik_bilgisi' => 'Ücretsiz sağlık hizmeti bilgisi',
            'sosyoekonomik_durum' => 'Sosyoekonomik durum',
            'ailede_karar_veren' => 'Karar verici',
            'aile_duygu_ortaya_koyma' => 'Duygu ifade düzeyi',
            'sorun_paylasma' => 'Sorun paylaşma',
            'cocuga_verilen_onem' => 'Çocuğa verilen önem',
            'ev_tipi' => 'Ev tipi',
            'ev_odalar_islev_isi_hava' => 'Ev koşulları',
            'pencere_aydinlik' => 'Aydınlanma durumu',
            'banyo_var_mi' => 'Banyo durumu',
            'banyo_temizlik' => 'Banyo temizliği',
            'tuvalet_konum' => 'Tuvalet konumu',
            'tuvalet_durumu' => 'Tuvalet durumu',
            'bakim_verenler' => 'Bakım verenler',
            'yemek_pisirme_besin_degeri' => 'Yemek pişirme etkisi',
            'yiyecek_saklama_kosullari' => 'Yiyecek saklama koşulları',
            'gecmis_tibbi_oyku_kendisi' => 'Geçmiş tıbbi öykü (Kendi)',
            'gecmis_tibbi_oyku_ailesi' => 'Geçmiş tıbbi öykü (Aile)',
            'menars_yasi' => 'Menarş yaşı',
            'gunde_kac_ped' => 'Günlük ped sayısı',
            'para' => 'Parite',
            'abortus' => 'Abortus',
            'yasayan' => 'Yaşayan çocuk sayısı',
            'gravida' => 'Gravida',
            'cocuklarin_cinsiyeti' => 'Çocukların cinsiyeti',
            'cocuklarin_saglik_durumu' => 'Çocukların sağlık durumu',
            'dogum_yeri_kisi_sekli' => 'Doğum geçmişi',
            'abortus_yeri_kisi' => 'Abortus geçmişi',
            'postpartum_gun' => 'Postpartum gün',
            'hastaneden_cikis_gun' => 'Hastaneden çıkış günü',
            'ilac_kullaniyor_mu' => 'İlaç kullanımı',
            'ne_yapildi' => 'Yapılan müdahale',
            'sigara_var_mi' => 'Sigara kullanımı',
            'alkol_var_mi' => 'Alkol kullanımı',
            'dogum_sonrasi_kontrol' => 'Doğum sonrası kontrol',
            'su_an_ap_yontem' => 'AP yöntemi',
            'bebek_cinsiyet' => 'Bebek cinsiyeti',
            'anne_tercihi' => 'Anne tercihi',
            'cinsiyet_duygu' => 'Cinsiyet duygusu',
            'bebek_dusunceleri' => 'Bebek hakkındaki düşünceler',
            'endise_var_mi' => 'Endişe durumu',
            'aile_yaklasim' => 'Aile yaklaşımı',
            'dogum_sonrasi_cinsel_yasam' => 'Cinsel yaşam',
            'muayene_tarihi' => 'Muayene tarihi',
            'postpartum_hafta' => 'Postpartum hafta',
            'gebelik_kilosu' => 'Gebelik kilosu',
            'mevcut_kilo' => 'Mevcut kilo',
            'ates' => 'Ateş',
            'nabiz' => 'Nabız',
            'solunum' => 'Solunum',
            'tansiyon' => 'Tansiyon',
            'meme_ucu' => 'Meme ucu',
            'emzirmeye_uygun' => 'Emzirmeye uygunluk',
            'meme_bakimi' => 'Meme bakımı',
            'sutyen_kullanimi' => 'Sütyen kullanımı',
            'fundus_palpe_ediliyor' => 'Fundus muayenesi',
            'losia_tipi' => 'Losia tipi',
            'hemoglobin' => 'Hemoglobin',
            'diyet_var_mi' => 'Diyet durumu',
            'istahsizlik' => 'İştahsızlık',
            'yeme_aliskanligi' => 'Yeme alışkanlığı',
            'vitamin_destegi' => 'Vitamin desteği',
            'yiyemedigi_yiyecek' => 'Yiyemediği yiyecek',
            'alinan_besin_gruplari' => 'Alınan besin grupları',
            'bebek_beslenmesi' => 'Bebek beslenmesi',
            'emzirme_suresi' => 'Emzirme süresi',
            'ebenin_yorumu' => 'Ebenin yorumu',
            // Bebek alanları
            'dogum_tarihi' => 'Bebeğin doğum tarihi',
            'kac_haftalik' => 'Haftalık bilgi',
            'izlem_sayisi' => 'İzlem sayısı',
            'termin_durumu' => 'Termin durumu',
            'cinsiyet' => 'Cinsiyet',
            'kacinci_cocuk' => 'Kaçıncı çocuk',
            'kilo' => 'Kilo',
            'boy' => 'Boy',
            'bebek_ates' => 'Bebeğin ateşi',
            'bebek_nabiz' => 'Bebeğin nabzı',
            'bebek_solunum' => 'Bebeğin solunumu',
            'bas_cevresi' => 'Baş çevresi',
            'gogus_cevresi' => 'Göğüs çevresi',
        ];
    }

    private function fizikselMuayeneKeys(): array
    {
        return [
            'bas_agrisi', 'bas_donmesi', 'kepek', 'bit', 'dokulme', 'sac_hijyen',
            'yuz_solukluk', 'yuz_odem', 'konjuktiva_solukluk', 'sulanma_akinti',
            'capaklanma', 'goz_kapagi_odem', 'burun_tikaniklik', 'burun_akinti',
            'burun_kanamasi', 'dudak_solukluk', 'agiz_aft', 'dis_curuk', 'dis_eti_kanama',
            'dis_hijyen', 'hipertroidi', 'lenf_sisme', 'tonsil_sisme', 'solunum_normal',
            'nefes_darligi', 'akciger_ses_patoloji', 'oksuruk', 'gogus_agrisi',
            'kalp_sesi', 'kirmizlik', 'hassasiyet', 'dolgunluk', 'meme_catlagi',
            'meme_absesi', 'meme_ent', 'gecmis_meme_hastalik',
        ];
    }
}
