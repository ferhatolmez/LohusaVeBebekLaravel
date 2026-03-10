@extends('layouts.app')

@php
    use App\Support\MedicalFormOptions;

    $labels = MedicalFormOptions::bebekChecklistLabels();
@endphp

@section('title', 'Bebek Kaydi Detayi')

@section('content')
<div class="container">
    <section class="d-flex flex-column flex-lg-row justify-content-between gap-3 align-items-lg-center mb-4">
        <div>
            <span class="badge-soft mb-2">Kayit detayi</span>
            <h1 class="h2 mb-1">Bebek izlem kaydi #{{ $bebekForm->id }}</h1>
            <p class="text-secondary mb-0">Tamamlilik skoru ve klinik gozlemler tek sayfada ozetlenir.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <span class="badge text-bg-{{ $bebekForm->completion_tone }} align-self-center">Tamamlilik %{{ $bebekForm->completion_score }}</span>
            <a href="{{ route('bebek.pdf', $bebekForm->id) }}" class="btn btn-outline-primary">PDF indir</a>
        </div>
    </section>

    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card h-100">
                <div class="card-header">Temel bilgiler</div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        <div><div class="text-secondary small">Dogum tarihi</div><div class="fw-bold">{{ optional($bebekForm->dogum_tarihi)->format('d.m.Y') ?? '-' }}</div></div>
                        <div><div class="text-secondary small">Muayene tarihi</div><div class="fw-bold">{{ optional($bebekForm->muayene_tarihi)->format('d.m.Y') ?? '-' }}</div></div>
                        <div><div class="text-secondary small">Termin / cinsiyet</div><div class="fw-bold">{{ $bebekForm->termin_durumu ?? '-' }} / {{ $bebekForm->cinsiyet ?? '-' }}</div></div>
                        <div><div class="text-secondary small">Izlem / kacinci cocuk</div><div class="fw-bold">{{ $bebekForm->izlem_sayisi ?? '-' }} / {{ $bebekForm->kacinci_cocuk ?? '-' }}</div></div>
                        <div><div class="text-secondary small">Kan grubu</div><div class="fw-bold">{{ $bebekForm->kan_grubu ?? '-' }}</div></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card h-100">
                <div class="card-header">Vital bulgular</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6 col-md-4"><div class="glass-panel p-3 h-100"><div class="text-secondary small">Ates</div><div class="fw-bold">{{ $bebekForm->ates ?? '-' }}</div></div></div>
                        <div class="col-6 col-md-4"><div class="glass-panel p-3 h-100"><div class="text-secondary small">Nabiz</div><div class="fw-bold">{{ $bebekForm->nabiz ?? '-' }}</div></div></div>
                        <div class="col-6 col-md-4"><div class="glass-panel p-3 h-100"><div class="text-secondary small">Solunum</div><div class="fw-bold">{{ $bebekForm->solunum ?? '-' }}</div></div></div>
                        <div class="col-6 col-md-4"><div class="glass-panel p-3 h-100"><div class="text-secondary small">Kilo</div><div class="fw-bold">{{ $bebekForm->kilo ?? '-' }}</div></div></div>
                        <div class="col-6 col-md-4"><div class="glass-panel p-3 h-100"><div class="text-secondary small">Boy</div><div class="fw-bold">{{ $bebekForm->boy ?? '-' }}</div></div></div>
                        <div class="col-6 col-md-4"><div class="glass-panel p-3 h-100"><div class="text-secondary small">Bas/Gogus cevresi</div><div class="fw-bold">{{ $bebekForm->bas_cevresi ?? '-' }} / {{ $bebekForm->gogus_cevresi ?? '-' }}</div></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-1">
        @foreach ($labels as $field => $label)
            <div class="col-md-6 col-xl-4">
                <div class="card h-100">
                    <div class="card-header">{{ $label }}</div>
                    <div class="card-body">
                        @php $items = $bebekForm->$field ?? []; @endphp
                        @if (!empty($items))
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($items as $item)
                                    <span class="badge-soft">{{ $item }}</span>
                                @endforeach
                            </div>
                        @else
                            <p class="text-secondary mb-0">Kayitli bulgu yok.</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
