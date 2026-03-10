@extends('layouts.app')

@php
    $showValue = function ($value) {
        if (is_array($value)) {
            return count($value) ? implode(', ', array_filter($value)) : 'Kayit yok';
        }

        return filled($value) ? $value : 'Kayit yok';
    };
@endphp

@section('title', 'Lohusa Kaydi Detayi')

@section('content')
<div class="container">
    <section class="d-flex flex-column flex-lg-row justify-content-between gap-3 align-items-lg-center mb-4">
        <div>
            <span class="badge-soft mb-2">Kayit detayi</span>
            <h1 class="h2 mb-1">{{ $lohusaForm->ad_soyad }}</h1>
            <p class="text-secondary mb-0">Lohusa kaydi ozet, vital ve bebek bilgileri tek ekranda sunulur.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <span class="badge text-bg-{{ $lohusaForm->completion_tone }} align-self-center">Tamamlilik %{{ $lohusaForm->completion_score }}</span>
            <a href="{{ route('lohusa.pdf', $lohusaForm->id) }}" class="btn btn-outline-primary">PDF indir</a>
        </div>
    </section>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header">Temel ozet</div>
                <div class="card-body d-grid gap-3">
                    <div><div class="text-secondary small">Yas</div><div class="fw-bold">{{ $showValue($lohusaForm->yas) }}</div></div>
                    <div><div class="text-secondary small">Egitim / meslek</div><div class="fw-bold">{{ $showValue($lohusaForm->egitim_durumu) }} / {{ $showValue($lohusaForm->meslek) }}</div></div>
                    <div><div class="text-secondary small">Saglik guvencesi</div><div class="fw-bold">{{ $showValue($lohusaForm->saglik_guvence) }}</div></div>
                    <div><div class="text-secondary small">Gebelik planlandi mi?</div><div class="fw-bold">{{ $showValue($lohusaForm->gebelik_planlandimi) }}</div></div>
                    <div><div class="text-secondary small">Dogum yeri</div><div class="fw-bold">{{ $showValue($lohusaForm->dogum_yeri) }}</div></div>
                    <div><div class="text-secondary small">Muayene tarihi</div><div class="fw-bold">{{ optional($lohusaForm->muayene_tarihi)->format('d.m.Y') ?? 'Kayit yok' }}</div></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header">Vital bulgular</div>
                <div class="card-body d-grid gap-3">
                    <div><div class="text-secondary small">Ates</div><div class="fw-bold">{{ $showValue($lohusaForm->ates) }}</div></div>
                    <div><div class="text-secondary small">Nabiz</div><div class="fw-bold">{{ $showValue($lohusaForm->nabiz) }}</div></div>
                    <div><div class="text-secondary small">Solunum</div><div class="fw-bold">{{ $showValue($lohusaForm->solunum) }}</div></div>
                    <div><div class="text-secondary small">Tansiyon</div><div class="fw-bold">{{ $showValue($lohusaForm->tansiyon) }}</div></div>
                    <div><div class="text-secondary small">Hemoglobin</div><div class="fw-bold">{{ $showValue($lohusaForm->hemoglobin) }}</div></div>
                    <div><div class="text-secondary small">Bebek beslenmesi</div><div class="fw-bold">{{ $showValue($lohusaForm->bebek_beslenmesi) }}</div></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header">Bebek ozet</div>
                <div class="card-body d-grid gap-3">
                    <div><div class="text-secondary small">Dogum tarihi</div><div class="fw-bold">{{ optional($lohusaForm->dogum_tarihi)->format('d.m.Y') ?? 'Kayit yok' }}</div></div>
                    <div><div class="text-secondary small">Kac haftalik / izlem</div><div class="fw-bold">{{ $showValue($lohusaForm->kac_haftalik) }} / {{ $showValue($lohusaForm->izlem_sayisi) }}</div></div>
                    <div><div class="text-secondary small">Termin / cinsiyet</div><div class="fw-bold">{{ $showValue($lohusaForm->termin_durumu) }} / {{ $showValue($lohusaForm->cinsiyet) }}</div></div>
                    <div><div class="text-secondary small">Kilo / boy</div><div class="fw-bold">{{ $showValue($lohusaForm->kilo) }} / {{ $showValue($lohusaForm->boy) }}</div></div>
                    <div><div class="text-secondary small">Bas / gogus cevresi</div><div class="fw-bold">{{ $showValue($lohusaForm->bas_cevresi) }} / {{ $showValue($lohusaForm->gogus_cevresi) }}</div></div>
                    <div><div class="text-secondary small">Kan grubu</div><div class="fw-bold">{{ $showValue($lohusaForm->kan_grubu) }}</div></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-1">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header">Psikolojik ve emzirme</div>
                <div class="card-body d-grid gap-3">
                    <div><div class="text-secondary small">Psikolojik belirtiler</div><div>{{ $showValue($lohusaForm->psikolojik_belirtiler) }}</div></div>
                    <div><div class="text-secondary small">Anne-bebek iliskisi</div><div>{{ $showValue($lohusaForm->anne_bebek_iliskisi) }}</div></div>
                    <div><div class="text-secondary small">Emzirme bulgulari</div><div>{{ $showValue($lohusaForm->emzirme_bulgular) }}</div></div>
                    <div><div class="text-secondary small">Sut yeterliligi</div><div>{{ $showValue($lohusaForm->sut_yeterliligi) }}</div></div>
                    <div><div class="text-secondary small">Egitim istekleri</div><div>{{ $showValue($lohusaForm->egitim_istekleri) }}</div></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header">Klinik notlar</div>
                <div class="card-body d-grid gap-3">
                    <div><div class="text-secondary small">Postpartum problemleri</div><div>{{ $showValue($lohusaForm->postpartum_problemleri) }}</div></div>
                    <div><div class="text-secondary small">Fiziksel muayene</div><div>{{ $showValue($lohusaForm->fiziksel_muayene) }}</div></div>
                    <div><div class="text-secondary small">Vital-disi bulgular</div><div>{{ $showValue($lohusaForm->abdomen_bulgulari) }}</div></div>
                    <div><div class="text-secondary small">Ebenin yorumu</div><div>{{ $showValue($lohusaForm->ebenin_yorumu) }}</div></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
