<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <title>Lohusa ve Bebek İzlem Formu</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 11px; line-height: 1.5; margin: 18px; color: #23303b; }
        h2 { text-align: center; margin-bottom: 24px; color: #103b36; border-bottom: 2px solid #d9f3ef; padding-bottom: 10px; }
        h3 { background: #eef8f6; color: #146c63; padding: 8px 12px; margin-top: 20px; margin-bottom: 12px; border-left: 4px solid #1f9d8f; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 18px; }
        th, td { border: 1px solid #d5dde5; padding: 8px 10px; text-align: left; vertical-align: top; }
        th { width: 35%; background: #f7fafc; }
        tr:nth-child(even) { background: #fbfdff; }
        .empty { color: #708090; font-style: italic; }
    </style>
</head>
<body>
    <h2>Lohusa ve Bebek İzlem Formu</h2>

    @php
        function formatValue($value) {
            if (is_array($value)) {
                $filtered = array_filter($value, fn ($item) => $item !== null && $item !== '');
                return count($filtered) ? implode(', ', $filtered) : 'Veri yok';
            }

            if (is_string($value) && str_starts_with($value, '[')) {
                $decoded = json_decode($value, true);
                if (is_array($decoded)) {
                    $filtered = array_filter($decoded, fn ($item) => $item !== null && $item !== '');
                    return count($filtered) ? implode(', ', $filtered) : 'Veri yok';
                }
            }

            return filled($value) ? $value : 'Veri yok';
        }

        $groups = [
            'Tanıtıcı bilgiler' => ['ad_soyad', 'yas', 'egitim_durumu', 'meslek', 'saglik_guvence', 'akraba_evliligi', 'evlilik_yili', 'kan_grubu', 'gebelik_planlandimi', 'dogum_yeri'],
            'Eş bilgileri' => ['es_yas', 'es_dogum_yeri', 'es_egitim', 'es_meslek', 'es_kan_grubu', 'es_telefon', 'es_adres'],
            'Aile ve sosyal durum' => ['ailenin_hastalik_durumu', 'kontrollerin_onemi_biliniyor', 'aile_mevcut_hastaliklar', 'aile_ebeden_beklentiler', 'ucretsiz_saglik_bilgisi', 'sosyoekonomik_durum', 'ailede_karar_veren', 'aile_duygu_ortaya_koyma', 'sorun_paylasma', 'cocuga_verilen_onem'],
            'Ev durumu ve hijyen' => ['ev_tipi', 'ev_odalar_islev_isi_hava', 'pencere_aydinlik', 'banyo_var_mi', 'banyo_temizlik', 'tuvalet_konum', 'tuvalet_durumu', 'bakim_verenler', 'yemek_pisirme_besin_degeri', 'yiyecek_saklama_kosullari'],
            'Tıbbi öykü' => ['gecmis_tibbi_oyku_kendisi', 'gecmis_tibbi_oyku_ailesi', 'gecmis_tibbi_oyku_diger_aciklama'],
            'Menstrüel durum' => ['menars_yasi', 'normal_sure_25_kisa', 'normal_sure_35_uzun', 'kanama_sure_3_kisa', 'kanama_sure_7_uzun', 'siklus_duzenli', 'gunde_kac_ped'],
            'Gebelik ve doğum' => ['para', 'abortus', 'yasayan', 'gravida', 'cocuklarin_cinsiyeti', 'cocuklarin_saglik_durumu', 'dogum_yeri_kisi_sekli', 'abortus_yeri_kisi', 'gebelik_problemleri_son', 'gebelik_problemleri_onceki', 'dogum_problemleri_son', 'dogum_problemleri_onceki'],
            'Postpartum süreç' => ['postpartum_problemleri', 'postpartum_gun', 'hastaneden_cikis_gun', 'ilac_kullaniyor_mu', 'postpartum_sikayetleri', 'ne_yapildi'],
            'Alışkanlıklar' => ['sigara_var_mi', 'alkol_var_mi', 'dogum_sonrasi_kontrol'],
            'Aile planlaması' => ['ap_hap_sure', 'ap_hap_neden', 'ap_ria_sure', 'ap_ria_neden', 'ap_kondom_sure', 'ap_kondom_neden', 'ap_geleneksel_yontem_sure', 'ap_geleneksel_yontem_neden', 'su_an_ap_yontem'],
            'Bebek beslenmesi ve gelişimi' => ['bebek_cinsiyet', 'anne_tercihi', 'cinsiyet_duygu', 'bebek_dusunceleri', 'endise_var_mi', 'aile_yaklasim', 'dogum_sonrasi_cinsel_yasam'],
            'Muayene bulguları' => ['ates', 'nabiz', 'tansiyon', 'solunum', 'postpartum_hafta', 'gebelik_kilosu', 'mevcut_kilo'],
            'Fiziksel muayene' => ['bas_bulgular', 'sacli_deri_bulgular', 'yuz_bulgular', 'goz_bulgular', 'burun_bulgular', 'agiz_disfer_bulgular', 'bogaz_bulgular', 'solunum_bulgular', 'gogus_bulgular'],
            'Göğüs ve emzirme' => ['meme_ucu', 'emzirmeye_uygun', 'meme_bakimi', 'sutyen_kullanimi', 'fundus_palpe_ediliyor', 'losia_tipi'],
            'Emzirmenin değerlendirilmesi' => ['emzirme_suresi', 'emzirme_bulgular', 'sut_yeterliligi'],
            'Genel sistem değerlendirmeleri' => ['abdomen_bulgulari', 'uriner_bulgular', 'barsak_bulgular', 'alt_ekstremite'],
            'Beslenme durumu' => ['uykusuzluk', 'hemoglobin', 'diyet_var_mi', 'kilo_sorunu_tipi', 'istahsizlik', 'yeme_aliskanligi', 'yeme_aliskanligi_aciklama', 'vitamin_destegi', 'vitamin_icerigi', 'yiyemedigi_yiyecek', 'yiyemedigi_yiyecek_aciklama', 'alinan_besin_gruplari', 'bebek_beslenmesi'],
            'Psikolojik değerlendirme' => ['psikolojik_belirtiler', 'psikolojik_diger_aciklama'],
            'Anne-bebek ilişkisi' => ['anne_bebek_iliskisi'],
            'Eğitim istekleri' => ['egitim_istekleri'],
            'Ebenin notu' => ['ebenin_yorumu'],
            'Bebek bilgileri' => ['dogum_tarihi', 'kac_haftalik', 'muayene_tarihi', 'izlem_sayisi', 'termin_durumu', 'cinsiyet', 'kacinci_cocuk', 'kan_grubu'],
            'Bebekte klinik bulgular' => ['kilo', 'boy', 'bas_cevresi', 'gogus_cevresi', 'deri', 'bas', 'gozler', 'burun', 'agiz', 'kulak', 'boyun', 'gogus', 'abdomen', 'kasik', 'genital', 'solunum_sistemi', 'kvs', 'gis', 'uriner', 'kas_iskelet', 'norolojik'],
        ];
    @endphp

    @foreach ($groups as $title => $fields)
        <h3>{{ $title }}</h3>
        <table>
            @foreach ($fields as $field)
                @php($label = \Illuminate\Support\Str::of($field)->replace('_', ' ')->title())
                <tr>
                    <th>{{ $label }}</th>
                    <td>{{ formatValue($lohusa->{$field} ?? null) }}</td>
                </tr>
            @endforeach
        </table>
    @endforeach
</body>
</html>