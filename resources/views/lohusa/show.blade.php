@extends('layouts.app')

@php
    $showValue = function ($value) {
        if (is_array($value)) {
            return count(array_filter($value)) ? implode(', ', array_filter($value)) : 'Kayıt yok';
        }

        return filled($value) ? $value : 'Kayıt yok';
    };

    $formatDate = fn ($value) => $value?->format('d.m.Y') ?? 'Kayıt yok';

    $valuePair = function ($first, $second, $separator = ' / ') use ($showValue) {
        $firstValue = $showValue($first);
        $secondValue = $showValue($second);

        if ($firstValue === 'Kayıt yok' && $secondValue === 'Kayıt yok') {
            return 'Kayıt yok';
        }

        return $firstValue . $separator . $secondValue;
    };

    $physicalExamSections = [
        'Baş bulguları' => $lohusaForm->bas_bulgular,
        'Saçlı deri bulguları' => $lohusaForm->sacli_deri_bulgular,
        'Yüz bulguları' => $lohusaForm->yuz_bulgular,
        'Göz bulguları' => $lohusaForm->goz_bulgular,
        'Burun bulguları' => $lohusaForm->burun_bulgular,
        'Ağız ve diş bulguları' => $lohusaForm->agiz_disfer_bulgular,
        'Boğaz bulguları' => $lohusaForm->bogaz_bulgular,
        'Solunum bulguları' => $lohusaForm->solunum_bulgular,
        'Göğüs bulguları' => $lohusaForm->gogus_bulgular,
        'Loşi bulguları' => $lohusaForm->losia_bulgulari,
        'Karın bulguları' => $lohusaForm->abdomen_bulgulari,
        'İdrar bulguları' => $lohusaForm->uriner_bulgular,
        'Bağırsak bulguları' => $lohusaForm->barsak_bulgular,
        'Alt ekstremite' => $lohusaForm->alt_ekstremite,
    ];

    $physicalExamSummary = collect($physicalExamSections)->filter(fn ($items) => is_array($items) && count(array_filter($items)))->keys()->all();

    $listSections = [
        'Psikolojik belirtiler' => $lohusaForm->psikolojik_belirtiler,
        'Anne-bebek ilişkisi' => $lohusaForm->anne_bebek_iliskisi,
        'Emzirme bulguları' => $lohusaForm->emzirme_bulgular,
        'Süt yeterliliği' => $lohusaForm->sut_yeterliligi,
        'Eğitim istekleri' => $lohusaForm->egitim_istekleri,
        'Postpartum öykü problemleri' => $lohusaForm->postpartum_problemleri,
        'Güncel postpartum şikayetleri' => $lohusaForm->postpartum_sikayetleri,
        'Karın bulguları' => $lohusaForm->abdomen_bulgulari,
        'İdrar bulguları' => $lohusaForm->uriner_bulgular,
        'Bağırsak bulguları' => $lohusaForm->barsak_bulgular,
        'Alt ekstremite' => $lohusaForm->alt_ekstremite,
    ];
@endphp

@section('title', 'Lohusa Kayıt Detayı')

@section('content')
<div class="container">
    <section class="d-flex flex-column flex-lg-row justify-content-between gap-3 align-items-lg-center mb-4">
        <div>
            <span class="badge-soft mb-2">Kayıt detayı</span>
            <h1 class="h2 mb-1">{{ $lohusaForm->ad_soyad }}</h1>
            <p class="text-secondary mb-0">Temel bilgiler, izlemler ve klinik notlar düzenli bölümler halinde sunulur.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <span class="badge text-bg-{{ $lohusaForm->completion_tone }} align-self-center">Tamamlılık %{{ $lohusaForm->completion_score }}</span>
            @can('export', $lohusaForm)
                <a href="{{ route('lohusa.pdf', $lohusaForm->id) }}" class="btn btn-outline-primary">PDF indir</a>
            @endcan
        </div>
    </section>

    <section class="row g-3 mb-4">
        <div class="col-md-4"><div class="glass-panel p-3 h-100"><div class="text-secondary small">Takip önerisi</div><div class="fw-bold mt-1">{{ $lohusaForm->suggested_follow_up_label ?? 'Takip hedefi yok' }}</div><div class="small mt-2">@if ($lohusaForm->suggested_follow_up_date)<span class="badge text-bg-{{ $lohusaForm->follow_up_tone }}">{{ $lohusaForm->suggested_follow_up_date->format('d.m.Y') }}</span>@else<span class="text-secondary">Yeni tarih hesaplanamadı.</span>@endif</div></div></div>
        <div class="col-md-4"><div class="glass-panel p-3 h-100"><div class="text-secondary small">Postpartum durum</div><div class="fw-bold mt-1">{{ $valuePair($lohusaForm->postpartum_gun, $lohusaForm->postpartum_hafta, ' gün / ') }}</div><div class="small text-secondary mt-2">Gün ve hafta bilgisi aynı blokta okunur hale getirildi.</div></div></div>
        <div class="col-md-4"><div class="glass-panel p-3 h-100"><div class="text-secondary small">Muayene tarihi</div><div class="fw-bold mt-1">{{ $formatDate($lohusaForm->muayene_tarihi) }}</div><div class="small text-secondary mt-2">Kaydın saha kullanımındaki zaman bilgisini gösterir.</div></div></div>
    </section>

    <div class="row g-4">
        <div class="col-lg-4"><div class="card h-100"><div class="card-header">Temel özet</div><div class="card-body d-grid gap-3"><div><div class="text-secondary small">Yaş</div><div class="fw-bold">{{ $showValue($lohusaForm->yas) }}</div></div><div><div class="text-secondary small">Eğitim / meslek</div><div class="fw-bold">{{ $valuePair($lohusaForm->egitim_durumu, $lohusaForm->meslek) }}</div></div><div><div class="text-secondary small">Sağlık güvencesi</div><div class="fw-bold">{{ $showValue($lohusaForm->saglik_guvence) }}</div></div><div><div class="text-secondary small">Gebelik planlandı mı?</div><div class="fw-bold">{{ $showValue($lohusaForm->gebelik_planlandimi) }}</div></div><div><div class="text-secondary small">Doğum yeri</div><div class="fw-bold">{{ $showValue($lohusaForm->dogum_yeri) }}</div></div><div><div class="text-secondary small">Muayene tarihi</div><div class="fw-bold">{{ $formatDate($lohusaForm->muayene_tarihi) }}</div></div></div></div></div>
        <div class="col-lg-4"><div class="card h-100"><div class="card-header">Vital bulgular</div><div class="card-body d-grid gap-3"><div><div class="text-secondary small">Ateş</div><div class="fw-bold">{{ $showValue($lohusaForm->ates) }}</div></div><div><div class="text-secondary small">Nabız</div><div class="fw-bold">{{ $showValue($lohusaForm->nabiz) }}</div></div><div><div class="text-secondary small">Solunum</div><div class="fw-bold">{{ $showValue($lohusaForm->solunum) }}</div></div><div><div class="text-secondary small">Tansiyon</div><div class="fw-bold">{{ $showValue($lohusaForm->tansiyon) }}</div></div><div><div class="text-secondary small">Hemoglobin</div><div class="fw-bold">{{ $showValue($lohusaForm->hemoglobin) }}</div></div><div><div class="text-secondary small">Bebek beslenmesi</div><div class="fw-bold">{{ $showValue($lohusaForm->bebek_beslenmesi) }}</div></div></div></div></div>
        <div class="col-lg-4"><div class="card h-100"><div class="card-header">Bebek özeti</div><div class="card-body d-grid gap-3"><div><div class="text-secondary small">Doğum tarihi</div><div class="fw-bold">{{ $formatDate($lohusaForm->dogum_tarihi) }}</div></div><div><div class="text-secondary small">Kaç haftalık / izlem</div><div class="fw-bold">{{ $valuePair($lohusaForm->kac_haftalik, $lohusaForm->izlem_sayisi) }}</div></div><div><div class="text-secondary small">Termin / cinsiyet</div><div class="fw-bold">{{ $valuePair($lohusaForm->termin_durumu, $lohusaForm->cinsiyet) }}</div></div><div><div class="text-secondary small">Kilo / boy</div><div class="fw-bold">{{ $valuePair($lohusaForm->kilo, $lohusaForm->boy) }}</div></div><div><div class="text-secondary small">Baş / göğüs çevresi</div><div class="fw-bold">{{ $valuePair($lohusaForm->bas_cevresi, $lohusaForm->gogus_cevresi) }}</div></div><div><div class="text-secondary small">Bebek ateş / nabız / solunum</div><div class="fw-bold">{{ $showValue($lohusaForm->bebek_ates) }} / {{ $showValue($lohusaForm->bebek_nabiz) }} / {{ $showValue($lohusaForm->bebek_solunum) }}</div></div><div><div class="text-secondary small">Kan grubu</div><div class="fw-bold">{{ $showValue($lohusaForm->kan_grubu) }}</div></div></div></div></div>
    </div>

    <div class="row g-4 mt-1">
        <div class="col-lg-6"><div class="card h-100"><div class="card-header">Belirti ve izlem alanları</div><div class="card-body d-grid gap-3">@foreach (array_slice($listSections, 0, 5, true) as $label => $items)<div><div class="text-secondary small mb-2">{{ $label }}</div>@if (is_array($items) && count(array_filter($items)))<div class="d-flex flex-wrap gap-2">@foreach (array_filter($items) as $item)<span class="badge-soft">{{ $item }}</span>@endforeach</div>@else<div class="text-secondary">Kayıt yok</div>@endif</div>@endforeach @if (filled($lohusaForm->psikolojik_diger_aciklama))<div><div class="text-secondary small mb-2">Psikolojik ek not</div><div>{{ $lohusaForm->psikolojik_diger_aciklama }}</div></div>@endif</div></div></div>
        <div class="col-lg-6"><div class="card h-100"><div class="card-header">Klinik notlar</div><div class="card-body d-grid gap-3">@foreach (array_slice($listSections, 5, null, true) as $label => $items)<div><div class="text-secondary small mb-2">{{ $label }}</div>@if (is_array($items) && count(array_filter($items)))<div class="d-flex flex-wrap gap-2">@foreach (array_filter($items) as $item)<span class="badge-soft">{{ $item }}</span>@endforeach</div>@else<div class="text-secondary">Kayıt yok</div>@endif</div>@endforeach<div><div class="text-secondary small mb-2">Fiziksel muayene özeti</div><div>{{ $showValue($physicalExamSummary) }}</div></div><div><div class="text-secondary small mb-2">Ebenin yorumu</div><div>{{ $showValue($lohusaForm->ebenin_yorumu) }}</div></div>@if (filled($lohusaForm->yeme_aliskanligi_aciklama))<div><div class="text-secondary small mb-2">Yeme alışkanlığı açıklaması</div><div>{{ $lohusaForm->yeme_aliskanligi_aciklama }}</div></div>@endif @if (filled($lohusaForm->yiyemedigi_yiyecek_aciklama))<div><div class="text-secondary small mb-2">Yiyemediği yiyecek açıklaması</div><div>{{ $lohusaForm->yiyemedigi_yiyecek_aciklama }}</div></div>@endif</div></div></div>
    </div>
</div>
@endsection
