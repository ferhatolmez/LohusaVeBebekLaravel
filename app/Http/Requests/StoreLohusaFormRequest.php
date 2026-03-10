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
        $genders = MedicalFormOptions::genderOptions();
        $terms = MedicalFormOptions::termOptions();

        return [
            'ad_soyad' => ['required', 'string', 'min:3', 'max:120', 'regex:/^[\pL\s\'.-]+$/u'],
            'yas' => ['required', 'integer', 'between:12,60'],
            'egitim_durumu' => ['required', Rule::in($educations)],
            'meslek' => ['required', 'string', 'min:2', 'max:100', 'regex:/^[\pL\s\'.-]+$/u'],
            'saglik_guvence' => ['required', Rule::in($insurances)],
            'akraba_evliligi' => ['nullable', Rule::in($yesNo)],
            'evlilik_yili' => ['nullable', 'integer', 'min:1950', 'max:'.date('Y')],
            'kan_grubu' => ['nullable', Rule::in($bloodGroups)],
            'gebelik_planlandimi' => ['required', Rule::in($yesNo)],
            'dogum_yeri' => ['required', 'string', 'min:2', 'max:100', 'regex:/^[\pL\s\'.-]+$/u'],
            'es_yas' => ['nullable', 'integer', 'between:12,80'],
            'es_dogum_yeri' => ['nullable', 'string', 'max:100', 'regex:/^[\pL\s\'.-]+$/u'],
            'es_egitim' => ['nullable', Rule::in($educations)],
            'es_meslek' => ['nullable', 'string', 'max:100', 'regex:/^[\pL\s\'.-]+$/u'],
            'es_kan_grubu' => ['nullable', Rule::in($bloodGroups)],
            'es_telefon' => ['nullable', 'regex:/^[0-9\s\(\)\-+]+$/', 'min:10', 'max:20'],
            'es_adres' => ['nullable', 'string', 'max:500'],
            'ailenin_hastalik_durumu' => ['nullable', 'string', 'max:1000'],
            'kontrollerin_onemi_biliniyor' => ['nullable', 'string', 'max:1000'],
            'aile_mevcut_hastaliklar' => ['nullable', 'string', 'max:1000'],
            'aile_ebeden_beklentiler' => ['nullable', 'string', 'max:1000'],
            'ucretsiz_saglik_bilgisi' => ['nullable', 'string', 'max:1000'],
            'sosyoekonomik_durum' => ['nullable', 'string', 'max:500'],
            'ailede_karar_veren' => ['nullable', 'string', 'max:100'],
            'aile_duygu_ortaya_koyma' => ['nullable', 'string', 'max:1000'],
            'sorun_paylasma' => ['nullable', 'array'],
            'cocuga_verilen_onem' => ['nullable', 'string', 'max:1000'],
            'ev_tipi' => ['nullable', 'string', 'max:100'],
            'ev_odalar_islev_isi_hava' => ['nullable', 'string', 'max:1000'],
            'pencere_aydinlik' => ['nullable', 'string', 'max:1000'],
            'banyo_var_mi' => ['nullable', 'string', 'max:1000'],
            'banyo_temizlik' => ['nullable', 'string', 'max:1000'],
            'tuvalet_konum' => ['nullable', 'string', 'max:1000'],
            'tuvalet_durumu' => ['nullable', 'string', 'max:1000'],
            'bakim_verenler' => ['nullable', 'string', 'max:1000'],
            'yemek_pisirme_besin_degeri' => ['nullable', 'string', 'max:1000'],
            'yiyecek_saklama_kosullari' => ['nullable', 'string', 'max:1000'],
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
            'cocuklarin_cinsiyeti' => ['nullable', 'string', 'max:255'],
            'cocuklarin_saglik_durumu' => ['nullable', 'string', 'max:1000'],
            'dogum_yeri_kisi_sekli' => ['nullable', 'string', 'max:255'],
            'abortus_yeri_kisi' => ['nullable', 'string', 'max:255'],
            'gebelik_problemleri_son' => ['nullable', 'array'],
            'gebelik_problemleri_onceki' => ['nullable', 'array'],
            'dogum_problemleri_son' => ['nullable', 'array'],
            'dogum_problemleri_onceki' => ['nullable', 'array'],
            'postpartum_problemleri' => ['nullable', 'array'],
            'postpartum_gun' => ['nullable', 'integer', 'between:0,60'],
            'hastaneden_cikis_gun' => ['nullable', 'integer', 'between:0,30'],
            'ilac_kullaniyor_mu' => ['nullable', 'string', 'max:255'],
            'postpartum_sikayetleri' => ['nullable', 'array'],
            'ne_yapildi' => ['nullable', 'string', 'max:1000'],
            'sigara_var_mi' => ['nullable', Rule::in($yesNo)],
            'alkol_var_mi' => ['nullable', Rule::in($yesNo)],
            'dogum_sonrasi_kontrol' => ['nullable', 'string', 'max:255'],
            'ap_hap_sure' => ['nullable', 'string', 'max:100'],
            'ap_hap_neden' => ['nullable', 'string', 'max:255'],
            'ap_ria_sure' => ['nullable', 'string', 'max:100'],
            'ap_ria_neden' => ['nullable', 'string', 'max:255'],
            'ap_kondom_sure' => ['nullable', 'string', 'max:100'],
            'ap_kondom_neden' => ['nullable', 'string', 'max:255'],
            'ap_geleneksel_yontem_sure' => ['nullable', 'string', 'max:100'],
            'ap_geleneksel_yontem_neden' => ['nullable', 'string', 'max:255'],
            'su_an_ap_yontem' => ['nullable', 'string', 'max:100'],
            'bebek_cinsiyet' => ['nullable', Rule::in($genders)],
            'anne_tercihi' => ['nullable', 'string', 'max:255'],
            'cinsiyet_duygu' => ['nullable', 'string', 'max:1000'],
            'bebek_dusunceleri' => ['nullable', 'string', 'max:1000'],
            'endise_var_mi' => ['nullable', 'string', 'max:255'],
            'aile_yaklasim' => ['nullable', 'string', 'max:1000'],
            'dogum_sonrasi_cinsel_yasam' => ['nullable', 'string', 'max:1000'],
            'geleneksel_uygulamalar' => ['nullable', 'array'],
            'muayene_tarihi' => ['nullable', 'date', 'before_or_equal:today'],
            'postpartum_hafta' => ['nullable', 'integer', 'between:0,8'],
            'gebelik_kilosu' => ['nullable', 'numeric', 'between:35,200'],
            'mevcut_kilo' => ['nullable', 'numeric', 'between:30,200'],
            'ates' => ['nullable', 'numeric', 'between:34,42'],
            'nabiz' => ['nullable', 'numeric', 'between:30,220'],
            'solunum' => ['nullable', 'numeric', 'between:5,80'],
            'tansiyon' => ['nullable', 'regex:/^\d{2,3}\/\d{2,3}$/'],
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
            'meme_bakimi' => ['nullable', 'string', 'max:1000'],
            'sutyen_kullanimi' => ['nullable', 'string', 'max:1000'],
            'fundus_palpe_ediliyor' => ['nullable', 'string', 'max:255'],
            'losia_tipi' => ['nullable', 'string', 'max:255'],
            'abdomen_bulgulari' => ['nullable', 'array'],
            'uriner_bulgular' => ['nullable', 'array'],
            'barsak_bulgular' => ['nullable', 'array'],
            'alt_ekstremite' => ['nullable', 'array'],
            'uykusuzluk' => ['nullable', 'array'],
            'hemoglobin' => ['nullable', 'numeric', 'between:4,25'],
            'diyet_var_mi' => ['nullable', 'string', 'max:255'],
            'kilo_sorunu_tipi' => ['nullable', 'string', 'max:255'],
            'istahsizlik' => ['nullable', 'string', 'max:255'],
            'yeme_aliskanligi' => ['nullable', 'string', 'max:1000'],
            'vitamin_destegi' => ['nullable', 'string', 'max:255'],
            'vitamin_icerigi' => ['nullable', 'string', 'max:255'],
            'yiyemedigi_yiyecek' => ['nullable', 'string', 'max:255'],
            'alinan_besin_gruplari' => ['nullable', 'string', 'max:1000'],
            'bebek_beslenmesi' => ['nullable', 'string', 'max:255'],
            'psikolojik_belirtiler' => ['nullable', 'array'],
            'anne_bebek_iliskisi' => ['nullable', 'array'],
            'emzirme_bulgular' => ['nullable', 'array'],
            'emzirme_suresi' => ['nullable', 'integer', 'between:0,180'],
            'sut_yeterliligi' => ['nullable', 'array'],
            'egitim_istekleri' => ['nullable', 'array'],
            'ebenin_yorumu' => ['nullable', 'string', 'max:2000'],
            'dogum_tarihi' => ['nullable', 'date', 'before_or_equal:today'],
            'kac_haftalik' => ['nullable', 'integer', 'between:20,45'],
            'izlem_sayısi' => ['nullable', 'integer', 'between:1,20'],
            'termin_durumu' => ['nullable', Rule::in($terms)],
            'cinsiyet' => ['nullable', Rule::in($genders)],
            'kacinci_cocuk' => ['nullable', 'integer', 'between:1,20'],
            'kilo' => ['nullable', 'numeric', 'between:0.5,10'],
            'boy' => ['nullable', 'numeric', 'between:20,100'],
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
            'ad_soyad.required' => 'Ad soyad zorunludur.',
            'ad_soyad.regex' => 'Ad soyad alanında sadece harf, boşluk, nokta ve tire kullanılabilir.',
            'yas.required' => 'Yaş alanı zorunludur.',
            'yas.integer' => 'Yaş sadece sayı olmalı.',
            'yas.between' => 'Yaş 12 ile 60 arasında olmalı.',
            'egitim_durumu.required' => 'Eğitim durumu seçilmelidir.',
            'meslek.required' => 'Meslek alanı zorunludur.',
            'meslek.regex' => 'Meslek alanında sadece harf karakterleri kullanılabilir.',
            'saglik_guvence.required' => 'Sağlık guvencesi seçilmelidir.',
            'gebelik_planlandimi.required' => 'Gebelik planlanma durumu seçilmelidir.',
            'dogum_yeri.required' => 'Doğum yeri zorunludur.',
            'dogum_yeri.regex' => 'Doğum yeri alanında yalnızca metin girilebilir.',
            'es_telefon.regex' => 'Telefon alanı geçerli bir formatta olmalı.',
            'tansiyon.regex' => 'Tansiyon alanı 120/80 formatinda olmalı.',
            '*.integer' => 'Bu alana sadece sayı girilebilir.',
            '*.numeric' => 'Bu alana sadece sayısal deger girilebilir.',
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
