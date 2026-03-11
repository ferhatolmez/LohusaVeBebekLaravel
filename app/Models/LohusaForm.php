<?php

namespace App\Models;

use App\Models\Concerns\CalculatesCompletionScore;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class LohusaForm extends Model
{
    use CalculatesCompletionScore;
    use HasFactory;
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $dispatchesEvents = [
        'created' => \App\Events\FormCreated::class,
    ];

    protected $fillable = [
        'created_by', 'updated_by',
        'ad_soyad', 'yas', 'egitim_durumu', 'meslek', 'saglik_guvence', 'akraba_evliligi', 'evlilik_yili', 'kan_grubu',
        'gebelik_planlandimi', 'dogum_yeri', 'es_yas', 'es_dogum_yeri', 'es_egitim', 'es_meslek', 'es_kan_grubu',
        'es_telefon', 'es_adres', 'ailenin_hastalik_durumu', 'kontrollerin_onemi_biliniyor', 'aile_mevcut_hastaliklar',
        'aile_ebeden_beklentiler', 'ucretsiz_saglik_bilgisi', 'sosyoekonomik_durum', 'ailede_karar_veren',
        'aile_duygu_ortaya_koyma', 'sorun_paylasma', 'cocuga_verilen_onem', 'ev_tipi', 'ev_odalar_islev_isi_hava',
        'pencere_aydinlik', 'banyo_var_mi', 'banyo_temizlik', 'tuvalet_konum', 'tuvalet_durumu', 'bakim_verenler',
        'yemek_pisirme_besin_degeri', 'yiyecek_saklama_kosullari', 'gecmis_tibbi_oyku_kendisi', 'gecmis_tibbi_oyku_ailesi',
        'gecmis_tibbi_oyku_diger_aciklama', 'menars_yasi', 'normal_sure_25_kisa', 'normal_sure_35_uzun',
        'kanama_sure_3_kisa', 'kanama_sure_7_uzun', 'siklus_duzenli', 'gunde_kac_ped', 'para', 'abortus', 'yasayan',
        'gravida', 'cocuklarin_cinsiyeti', 'cocuklarin_saglik_durumu', 'dogum_yeri_kisi_sekli', 'abortus_yeri_kisi',
        'gebelik_problemleri_son', 'gebelik_problemleri_onceki', 'dogum_problemleri_son', 'dogum_problemleri_onceki',
        'postpartum_problemleri', 'postpartum_gun', 'hastaneden_cikis_gun', 'ilac_kullaniyor_mu', 'postpartum_sikayetleri',
        'ne_yapildi', 'sigara_var_mi', 'alkol_var_mi', 'dogum_sonrasi_kontrol', 'ap_hap_sure', 'ap_hap_neden',
        'ap_ria_sure', 'ap_ria_neden', 'ap_kondom_sure', 'ap_kondom_neden', 'ap_geleneksel_yontem_sure',
        'ap_geleneksel_yontem_neden', 'su_an_ap_yontem', 'bebek_cinsiyet', 'anne_tercihi', 'cinsiyet_duygu',
        'bebek_dusunceleri', 'endise_var_mi', 'aile_yaklasim', 'dogum_sonrasi_cinsel_yasam', 'geleneksel_uygulamalar',
        'muayene_tarihi', 'postpartum_hafta', 'gebelik_kilosu', 'mevcut_kilo', 'ates', 'nabiz', 'solunum', 'tansiyon',
        'bas_bulgular', 'sacli_deri_bulgular', 'yuz_bulgular', 'goz_bulgular', 'burun_bulgular', 'agiz_disfer_bulgular',
        'bogaz_bulgular', 'solunum_bulgular', 'gogus_bulgular', 'meme_ucu', 'emzirmeye_uygun', 'meme_bakimi', 'sutyen_kullanimi', 'fundus_palpe_ediliyor',
        'losia_tipi', 'losia_bulgulari', 'abdomen_bulgulari', 'uriner_bulgular', 'barsak_bulgular', 'alt_ekstremite',
        'uykusuzluk', 'hemoglobin', 'diyet_var_mi', 'kilo_sorunu_tipi', 'istahsizlik', 'yeme_aliskanligi', 'yeme_aliskanligi_aciklama',
        'vitamin_destegi', 'vitamin_icerigi', 'yiyemedigi_yiyecek', 'yiyemedigi_yiyecek_aciklama', 'alinan_besin_gruplari', 'bebek_beslenmesi',
        'psikolojik_belirtiler', 'psikolojik_diger_aciklama', 'anne_bebek_iliskisi', 'emzirme_bulgular', 'emzirme_suresi', 'sut_yeterliligi',
        'egitim_istekleri', 'ebenin_yorumu', 'dogum_tarihi', 'kac_haftalik', 'izlem_sayisi', 'termin_durumu', 'cinsiyet', 'kacinci_cocuk', 'bas_cevresi',
        'gogus_cevresi', 'kilo', 'boy', 'ates', 'nabiz', 'solunum', 'bebek_ates', 'bebek_nabiz', 'bebek_solunum', 'deri', 'bas', 'gozler', 'burun', 'agiz', 'kulak', 'boyun', 'gogus', 'abdomen', 'kasik', 'genital',
        'solunum_sistemi', 'kvs', 'gis', 'uriner', 'kas_iskelet', 'norolojik', 'fiziksel_muayene',
    ];

    protected $casts = [
        'dogum_tarihi' => 'date',
        'muayene_tarihi' => 'date',
        'sorun_paylasma' => 'array',
        'gecmis_tibbi_oyku_kendisi' => 'array',
        'gecmis_tibbi_oyku_ailesi' => 'array',
        'gebelik_problemleri_son' => 'array',
        'gebelik_problemleri_onceki' => 'array',
        'dogum_problemleri_son' => 'array',
        'dogum_problemleri_onceki' => 'array',
        'postpartum_problemleri' => 'array',
        'postpartum_sikayetleri' => 'array',
        'geleneksel_uygulamalar' => 'array',
        'psikolojik_belirtiler' => 'array',
        'anne_bebek_iliskisi' => 'array',
        'emzirme_bulgular' => 'array',
        'sut_yeterliligi' => 'array',
        'egitim_istekleri' => 'array',
        'bas_bulgular' => 'array',
        'sacli_deri_bulgular' => 'array',
        'yuz_bulgular' => 'array',
        'goz_bulgular' => 'array',
        'burun_bulgular' => 'array',
        'agiz_disfer_bulgular' => 'array',
        'bogaz_bulgular' => 'array',
        'solunum_bulgular' => 'array',
        'gogus_bulgular' => 'array',
        'losia_bulgulari' => 'array',
        'abdomen_bulgulari' => 'array',
        'uriner_bulgular' => 'array',
        'barsak_bulgular' => 'array',
        'alt_ekstremite' => 'array',
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
        'uykusuzluk' => 'array',
        'fiziksel_muayene' => 'array',
    ];

    protected function completionFields(): array
    {
        return [
            'ad_soyad', 'yas', 'egitim_durumu', 'meslek', 'saglik_guvence', 'gebelik_planlandimi', 'dogum_yeri',
            'postpartum_gun', 'muayene_tarihi', 'gebelik_kilosu', 'mevcut_kilo', 'ates', 'nabiz', 'solunum',
            'emzirme_bulgular', 'psikolojik_belirtiler', 'egitim_istekleri', 'ebenin_yorumu', 'bebek_beslenmesi',
        ];
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when(filled($filters['q'] ?? null), function (Builder $query) use ($filters) {
                $term = $filters['q'];

                $query->where(function (Builder $query) use ($term) {
                    $query->where('ad_soyad', 'like', '%'.$term.'%')
                        ->orWhere('dogum_yeri', 'like', '%'.$term.'%')
                        ->orWhere('meslek', 'like', '%'.$term.'%');
                });
            })
            ->when(filled($filters['dogum_yeri'] ?? null), fn (Builder $query) => $query->where('dogum_yeri', $filters['dogum_yeri']))
            ->when(filled($filters['bebek_beslenmesi'] ?? null), fn (Builder $query) => $query->where('bebek_beslenmesi', $filters['bebek_beslenmesi']))
            ->when(filled($filters['postpartum_hafta_min'] ?? null), fn (Builder $query) => $query->where('postpartum_hafta', '>=', (int) $filters['postpartum_hafta_min']))
            ->when(filled($filters['created_from'] ?? null), fn (Builder $query) => $query->whereDate('created_at', '>=', $filters['created_from']))
            ->when(filled($filters['created_to'] ?? null), fn (Builder $query) => $query->whereDate('created_at', '<=', $filters['created_to']));
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getSuggestedFollowUpDateAttribute(): ?Carbon
    {
        $referenceDate = $this->dogum_tarihi ?? $this->muayene_tarihi;

        if (! $referenceDate) {
            return null;
        }

        if ($this->postpartum_gun !== null) {
            if ($this->postpartum_gun < 7) {
                return $referenceDate->copy()->addDays(max(0, 7 - $this->postpartum_gun));
            }

            if ($this->postpartum_gun < 42) {
                return $referenceDate->copy()->addDays(max(0, 42 - $this->postpartum_gun));
            }

            return null;
        }

        if ($this->postpartum_hafta !== null) {
            if ($this->postpartum_hafta < 1) {
                return $referenceDate->copy()->addWeek();
            }

            if ($this->postpartum_hafta < 6) {
                return $referenceDate->copy()->addWeeks(6 - $this->postpartum_hafta);
            }
        }

        return null;
    }

    public function getSuggestedFollowUpLabelAttribute(): ?string
    {
        if (! $this->suggested_follow_up_date) {
            return null;
        }

        if (($this->postpartum_gun !== null && $this->postpartum_gun < 7) || ($this->postpartum_hafta !== null && $this->postpartum_hafta < 1)) {
            return '1. hafta kontrolu';
        }

        return '6. hafta kontrolu';
    }

    public function getFollowUpToneAttribute(): string
    {
        $date = $this->suggested_follow_up_date;

        if (! $date) {
            return 'secondary';
        }

        return $date->isPast() ? 'danger' : ($date->diffInDays(now()) <= 7 ? 'warning' : 'success');
    }

    public function getRiskScoreAttribute(): int
    {
        return \App\Support\RiskCalculator::calculateForLohusa($this);
    }

    public function getRiskLevelAttribute(): string
    {
        return \App\Support\RiskCalculator::getRiskLevel($this->risk_score);
    }

    public function getRiskBadgeAttribute(): string
    {
        return \App\Support\RiskCalculator::getRiskBadge($this->risk_score);
    }
}
