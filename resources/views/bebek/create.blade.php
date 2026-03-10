@extends('layouts.app')

@php
    use App\Support\MedicalFormOptions;

    $defaults = $clinicalDefaults['bebek'];
    $labels = MedicalFormOptions::bebekChecklistLabels();
    $options = MedicalFormOptions::bebekChecklistOptions();
@endphp

@section('title', 'Bebek İzlem Formu')

@section('content')
<div class="container">
    <section class="d-flex flex-column flex-lg-row justify-content-between gap-3 align-items-lg-center mb-4">
        <div>
            <span class="badge-soft mb-2">Bebek izlem formu</span>
            <h1 class="h2 mb-1">Bebek İzlem Formu</h1>
            <p class="text-secondary mb-0">Zorunlu alanlar, sayısal aralıklar ve daha güçlü veri kalitesi kuralları ile güncellendi.</p>
        </div>
        <a href="{{ route('bebek.index') }}" class="btn btn-outline-primary">Kayıt listesine dön</a>
    </section>

    @if ($errors->any())
        <div class="alert alert-danger glass-panel border-0 mb-4">
            <div class="fw-bold mb-2">Form kaydedilemedi.</div>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="bebekForm" method="POST" action="{{ route('bebek.store') }}" novalidate>
        @csrf

        <div class="card mb-4">
            <div class="card-header">Temel bilgiler</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-sm-6 col-xl-3">
                        <label for="dogum_tarihi" class="form-label">Doğum tarihi</label>
                        <input type="date" name="dogum_tarihi" id="dogum_tarihi" class="form-control @error('dogum_tarihi') is-invalid @enderror" value="{{ old('dogum_tarihi') }}" required>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <label for="kac_haftalik" class="form-label">Kaç haftalık</label>
                        <input type="number" min="20" max="45" name="kac_haftalik" id="kac_haftalik" class="form-control @error('kac_haftalik') is-invalid @enderror" value="{{ old('kac_haftalik', $defaults['kac_haftalik']) }}" required>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <label for="muayene_tarihi" class="form-label">Muayene tarihi</label>
                        <input type="date" name="muayene_tarihi" id="muayene_tarihi" class="form-control @error('muayene_tarihi') is-invalid @enderror" value="{{ old('muayene_tarihi', now()->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <label for="izlem_sayisi" class="form-label">İzlem sayısı</label>
                        <input type="number" min="1" max="20" name="izlem_sayisi" id="izlem_sayisi" class="form-control @error('izlem_sayisi') is-invalid @enderror" value="{{ old('izlem_sayisi', $defaults['izlem_sayisi']) }}" required>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <label for="termin_durumu" class="form-label">Termin durumu</label>
                        <select name="termin_durumu" id="termin_durumu" class="form-select @error('termin_durumu') is-invalid @enderror" required>
                            <option value="">Seçiniz</option>
                            @foreach (MedicalFormOptions::termOptions() as $term)
                                <option value="{{ $term }}" @selected(old('termin_durumu', 'Term') === $term)>{{ $term }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <label for="cinsiyet" class="form-label">Cinsiyet</label>
                        <select name="cinsiyet" id="cinsiyet" class="form-select @error('cinsiyet') is-invalid @enderror" required>
                            <option value="">Seçiniz</option>
                            @foreach (MedicalFormOptions::genderOptions() as $gender)
                                <option value="{{ $gender }}" @selected(old('cinsiyet') === $gender)>{{ $gender }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <label for="kacinci_cocuk" class="form-label">Kaçıncı çocuk</label>
                        <input type="number" min="1" max="20" name="kacinci_cocuk" id="kacinci_cocuk" class="form-control @error('kacinci_cocuk') is-invalid @enderror" value="{{ old('kacinci_cocuk', 1) }}" required>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <label for="kan_grubu" class="form-label">Kan grubu</label>
                        <select name="kan_grubu" id="kan_grubu" class="form-select @error('kan_grubu') is-invalid @enderror" required>
                            <option value="">Seçiniz</option>
                            @foreach (MedicalFormOptions::bloodGroups() as $group)
                                <option value="{{ $group }}" @selected(old('kan_grubu') === $group)>{{ $group }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">Vital bulgular</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-6 col-md-4 col-xl">
                        <label for="ates" class="form-label">Ateş (C)</label>
                        <input type="number" step="0.1" min="34" max="42" name="ates" id="ates" class="form-control @error('ates') is-invalid @enderror" value="{{ old('ates', $defaults['ates']) }}" required>
                    </div>
                    <div class="col-6 col-md-4 col-xl">
                        <label for="nabiz" class="form-label">Nabız</label>
                        <input type="number" min="60" max="220" name="nabiz" id="nabiz" class="form-control @error('nabiz') is-invalid @enderror" value="{{ old('nabiz', $defaults['nabiz']) }}" required>
                    </div>
                    <div class="col-6 col-md-4 col-xl">
                        <label for="solunum" class="form-label">Solunum</label>
                        <input type="number" min="10" max="120" name="solunum" id="solunum" class="form-control @error('solunum') is-invalid @enderror" value="{{ old('solunum', $defaults['solunum']) }}" required>
                    </div>
                    <div class="col-6 col-md-4 col-xl">
                        <label for="kilo" class="form-label">Kilo (kg)</label>
                        <input type="number" step="0.01" min="0.5" max="10" name="kilo" id="kilo" class="form-control @error('kilo') is-invalid @enderror" value="{{ old('kilo', $defaults['kilo']) }}" required>
                    </div>
                    <div class="col-6 col-md-4 col-xl">
                        <label for="boy" class="form-label">Boy (cm)</label>
                        <input type="number" step="0.01" min="20" max="100" name="boy" id="boy" class="form-control @error('boy') is-invalid @enderror" value="{{ old('boy', $defaults['boy']) }}" required>
                    </div>
                    <div class="col-6 col-md-4 col-xl">
                        <label for="bas_cevresi" class="form-label">Baş çevresi</label>
                        <input type="number" step="0.01" min="10" max="80" name="bas_cevresi" id="bas_cevresi" class="form-control @error('bas_cevresi') is-invalid @enderror" value="{{ old('bas_cevresi', $defaults['bas_cevresi']) }}" required>
                    </div>
                    <div class="col-6 col-md-4 col-xl">
                        <label for="gogus_cevresi" class="form-label">Göğüs çevresi</label>
                        <input type="number" step="0.01" min="10" max="80" name="gogus_cevresi" id="gogus_cevresi" class="form-control @error('gogus_cevresi') is-invalid @enderror" value="{{ old('gogus_cevresi', $defaults['gogus_cevresi']) }}" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            @foreach ($labels as $field => $label)
                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-header">{{ $label }}</div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($options[$field] as $index => $option)
                                    <div class="form-check border rounded-pill px-3 py-2 m-0">
                                        <input type="checkbox" class="form-check-input" name="{{ $field }}[]" id="{{ $field }}_{{ $index }}" value="{{ $option }}" @checked(in_array($option, old($field, []), true))>
                                        <label class="form-check-label small fw-semibold" for="{{ $field }}_{{ $index }}">{{ $option }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mt-4">
            <p class="text-secondary mb-0">Kayıt sonrası PDF alabilir, liste ekranından kalite skorunu görebilirsiniz.</p>
            <button type="submit" class="btn btn-primary btn-lg">Bebek kaydını oluştur</button>
        </div>
    </form>
</div>
@endsection


