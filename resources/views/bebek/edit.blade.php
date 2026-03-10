@extends('layouts.app')

@php
    use App\Support\MedicalFormOptions;

    $labels = MedicalFormOptions::bebekChecklistLabels();
    $options = MedicalFormOptions::bebekChecklistOptions();
@endphp

@section('title', 'Bebek Kaydi Duzenle')

@section('content')
<div class="container">
    <section class="d-flex flex-column flex-lg-row justify-content-between gap-3 align-items-lg-center mb-4">
        <div>
            <span class="badge-soft mb-2">Edit flow</span>
            <h1 class="h2 mb-1">Bebek kaydini duzenle</h1>
            <p class="text-secondary mb-0">Ayni validation kurallari guncelleme akisinda da uygulanir.</p>
        </div>
        <a href="{{ route('bebek.index') }}" class="btn btn-outline-primary">Kayit listesine don</a>
    </section>

    @if ($errors->any())
        <div class="alert alert-danger glass-panel border-0 mb-4">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('bebek.update', $bebekForm) }}">
        @csrf
        @method('PUT')

        <div class="card mb-4">
            <div class="card-header">Temel bilgiler</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-sm-6 col-xl-3"><label class="form-label">Dogum tarihi</label><input type="date" name="dogum_tarihi" class="form-control @error('dogum_tarihi') is-invalid @enderror" value="{{ old('dogum_tarihi', $bebekForm->dogum_tarihi?->format('Y-m-d')) }}"></div>
                    <div class="col-sm-6 col-xl-3"><label class="form-label">Kac haftalik</label><input type="number" min="20" max="45" name="kac_haftalik" class="form-control @error('kac_haftalik') is-invalid @enderror" value="{{ old('kac_haftalik', $bebekForm->kac_haftalik) }}"></div>
                    <div class="col-sm-6 col-xl-3"><label class="form-label">Muayene tarihi</label><input type="date" name="muayene_tarihi" class="form-control @error('muayene_tarihi') is-invalid @enderror" value="{{ old('muayene_tarihi', $bebekForm->muayene_tarihi?->format('Y-m-d')) }}"></div>
                    <div class="col-sm-6 col-xl-3"><label class="form-label">Izlem sayisi</label><input type="number" min="1" max="20" name="izlem_sayisi" class="form-control @error('izlem_sayisi') is-invalid @enderror" value="{{ old('izlem_sayisi', $bebekForm->izlem_sayisi) }}"></div>
                    <div class="col-sm-6 col-xl-3"><label class="form-label">Termin durumu</label><select name="termin_durumu" class="form-select @error('termin_durumu') is-invalid @enderror">@foreach (MedicalFormOptions::termOptions() as $term)<option value="{{ $term }}" @selected(old('termin_durumu', $bebekForm->termin_durumu) === $term)>{{ $term }}</option>@endforeach</select></div>
                    <div class="col-sm-6 col-xl-3"><label class="form-label">Cinsiyet</label><select name="cinsiyet" class="form-select @error('cinsiyet') is-invalid @enderror">@foreach (MedicalFormOptions::genderOptions() as $gender)<option value="{{ $gender }}" @selected(old('cinsiyet', $bebekForm->cinsiyet) === $gender)>{{ $gender }}</option>@endforeach</select></div>
                    <div class="col-sm-6 col-xl-3"><label class="form-label">Kacinci cocuk</label><input type="number" min="1" max="20" name="kacinci_cocuk" class="form-control @error('kacinci_cocuk') is-invalid @enderror" value="{{ old('kacinci_cocuk', $bebekForm->kacinci_cocuk) }}"></div>
                    <div class="col-sm-6 col-xl-3"><label class="form-label">Kan grubu</label><select name="kan_grubu" class="form-select @error('kan_grubu') is-invalid @enderror">@foreach (MedicalFormOptions::bloodGroups() as $group)<option value="{{ $group }}" @selected(old('kan_grubu', $bebekForm->kan_grubu) === $group)>{{ $group }}</option>@endforeach</select></div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">Vital bulgular</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-6 col-md-4 col-xl"><label class="form-label">Ates</label><input type="number" step="0.1" name="ates" class="form-control @error('ates') is-invalid @enderror" value="{{ old('ates', $bebekForm->ates) }}"></div>
                    <div class="col-6 col-md-4 col-xl"><label class="form-label">Nabiz</label><input type="number" name="nabiz" class="form-control @error('nabiz') is-invalid @enderror" value="{{ old('nabiz', $bebekForm->nabiz) }}"></div>
                    <div class="col-6 col-md-4 col-xl"><label class="form-label">Solunum</label><input type="number" name="solunum" class="form-control @error('solunum') is-invalid @enderror" value="{{ old('solunum', $bebekForm->solunum) }}"></div>
                    <div class="col-6 col-md-4 col-xl"><label class="form-label">Kilo</label><input type="number" step="0.01" name="kilo" class="form-control @error('kilo') is-invalid @enderror" value="{{ old('kilo', $bebekForm->kilo) }}"></div>
                    <div class="col-6 col-md-4 col-xl"><label class="form-label">Boy</label><input type="number" step="0.01" name="boy" class="form-control @error('boy') is-invalid @enderror" value="{{ old('boy', $bebekForm->boy) }}"></div>
                    <div class="col-6 col-md-4 col-xl"><label class="form-label">Bas cevresi</label><input type="number" step="0.01" name="bas_cevresi" class="form-control @error('bas_cevresi') is-invalid @enderror" value="{{ old('bas_cevresi', $bebekForm->bas_cevresi) }}"></div>
                    <div class="col-6 col-md-4 col-xl"><label class="form-label">Gogus cevresi</label><input type="number" step="0.01" name="gogus_cevresi" class="form-control @error('gogus_cevresi') is-invalid @enderror" value="{{ old('gogus_cevresi', $bebekForm->gogus_cevresi) }}"></div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            @foreach ($labels as $field => $label)
                @php $current = old($field, $bebekForm->$field ?? []); @endphp
                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-header">{{ $label }}</div>
                        <div class="card-body d-flex flex-wrap gap-2">
                            @foreach ($options[$field] as $index => $option)
                                <div class="form-check border rounded-pill px-3 py-2 m-0">
                                    <input type="checkbox" class="form-check-input" name="{{ $field }}[]" id="edit_{{ $field }}_{{ $index }}" value="{{ $option }}" @checked(in_array($option, is_array($current) ? $current : [], true))>
                                    <label class="form-check-label small fw-semibold" for="edit_{{ $field }}_{{ $index }}">{{ $option }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex flex-column flex-md-row gap-2 justify-content-between align-items-md-center mt-4">
            <a href="{{ route('bebek.index') }}" class="btn btn-outline-primary">Iptal</a>
            <button type="submit" class="btn btn-primary btn-lg">Kaydi guncelle</button>
        </div>
    </form>
</div>
@endsection
