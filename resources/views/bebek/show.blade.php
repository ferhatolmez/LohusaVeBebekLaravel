@extends('layouts.app')

@php
    use App\Support\MedicalFormOptions;

    $labels = MedicalFormOptions::bebekChecklistLabels();
    $formatDate = fn ($value) => $value?->format('d.m.Y') ?? 'Kayıt yok';
@endphp

@section('title', 'Bebek Kaydi Detayi')

@section('content')
<div class="container">
    <section class="d-flex flex-column flex-lg-row justify-content-between gap-3 align-items-lg-center mb-4">
        <div>
            <span class="badge-soft mb-2">Kayıt detayı</span>
            <h1 class="h2 mb-1">Bebek izlem kaydi #{{ $bebekForm->id }}</h1>
            <p class="text-secondary mb-0">Temel bilgiler, vital bulgular ve gozlem alanlari daha okunur kartlarla sunulur.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <span class="badge text-bg-{{ $bebekForm->completion_tone }} align-self-center">Tamamlilik %{{ $bebekForm->completion_score }}</span>
            @can('export', $bebekForm)
                <a href="{{ route('bebek.pdf', $bebekForm->id) }}" class="btn btn-outline-primary">PDF indir</a>
            @endcan
        </div>
    </section>

    <section class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="glass-panel p-3 h-100">
                <div class="text-secondary small">Sonraki kontrol</div>
                <div class="fw-bold mt-1">{{ $bebekForm->suggested_follow_up_date?->format('d.m.Y') ?? 'Hesaplanamadı' }}</div>
                <div class="small mt-2">
                    @if ($bebekForm->suggested_follow_up_date)
                        <span class="badge text-bg-{{ $bebekForm->follow_up_tone }}">İzlem hatırlatması</span>
                    @else
                        <span class="text-secondary">Muayene tarihi eksik oldugu icin olusmadi.</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-panel p-3 h-100">
                <div class="text-secondary small">Muayene tarihi</div>
                <div class="fw-bold mt-1">{{ $formatDate($bebekForm->muayene_tarihi) }}</div>
                <div class="small text-secondary mt-2">İzlem planlamasının referans tarihidir.</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-panel p-3 h-100">
                <div class="text-secondary small">Termin ve cinsiyet</div>
                <div class="fw-bold mt-1">{{ ($bebekForm->termin_durumu ?? 'Kayıt yok') . ' / ' . ($bebekForm->cinsiyet ?? 'Kayıt yok') }}</div>
                <div class="small text-secondary mt-2">Temel klinik siniflandirma alani.</div>
            </div>
        </div>
    </section>

    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card h-100">
                <div class="card-header">Temel bilgiler</div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        <div><div class="text-secondary small">Doğum tarihi</div><div class="fw-bold">{{ $formatDate($bebekForm->dogum_tarihi) }}</div></div>
                        <div><div class="text-secondary small">Muayene tarihi</div><div class="fw-bold">{{ $formatDate($bebekForm->muayene_tarihi) }}</div></div>
                        <div><div class="text-secondary small">Termin / cinsiyet</div><div class="fw-bold">{{ $bebekForm->termin_durumu ?? 'Kayıt yok' }} / {{ $bebekForm->cinsiyet ?? 'Kayıt yok' }}</div></div>
                        <div><div class="text-secondary small">İzlem / kaçıncı çocuk</div><div class="fw-bold">{{ $bebekForm->izlem_sayisi ?? 'Kayıt yok' }} / {{ $bebekForm->kacinci_cocuk ?? 'Kayıt yok' }}</div></div>
                        <div><div class="text-secondary small">Kan grubu</div><div class="fw-bold">{{ $bebekForm->kan_grubu ?? 'Kayıt yok' }}</div></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card h-100">
                <div class="card-header">Vital bulgular</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6 col-md-4"><div class="glass-panel p-3 h-100"><div class="text-secondary small">Ateş</div><div class="fw-bold">{{ $bebekForm->ates ?? 'Kayıt yok' }}</div></div></div>
                        <div class="col-6 col-md-4"><div class="glass-panel p-3 h-100"><div class="text-secondary small">Nabız</div><div class="fw-bold">{{ $bebekForm->nabiz ?? 'Kayıt yok' }}</div></div></div>
                        <div class="col-6 col-md-4"><div class="glass-panel p-3 h-100"><div class="text-secondary small">Solunum</div><div class="fw-bold">{{ $bebekForm->solunum ?? 'Kayıt yok' }}</div></div></div>
                        <div class="col-6 col-md-4"><div class="glass-panel p-3 h-100"><div class="text-secondary small">Kilo</div><div class="fw-bold">{{ $bebekForm->kilo ?? 'Kayıt yok' }}</div></div></div>
                        <div class="col-6 col-md-4"><div class="glass-panel p-3 h-100"><div class="text-secondary small">Boy</div><div class="fw-bold">{{ $bebekForm->boy ?? 'Kayıt yok' }}</div></div></div>
                        <div class="col-6 col-md-4"><div class="glass-panel p-3 h-100"><div class="text-secondary small">Baş / göğüs çevresi</div><div class="fw-bold">{{ ($bebekForm->bas_cevresi ?? 'Kayıt yok') . ' / ' . ($bebekForm->gogus_cevresi ?? 'Kayıt yok') }}</div></div></div>
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
                        @if (is_array($items) && count(array_filter($items)))
                            <div class="d-flex flex-wrap gap-2">
                                @foreach (array_filter($items) as $item)
                                    <span class="badge-soft">{{ $item }}</span>
                                @endforeach
                            </div>
                        @else
                            <p class="text-secondary mb-0">Kayıtlı bulgu yok.</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection


