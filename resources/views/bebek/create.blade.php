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
    <section class="page-header">
        <div class="page-header-row">
            <div>
                <span class="badge-soft mb-2">Bebek izlem formu</span>
                <h1 class="h2 mb-2">Bebek İzlem Formu</h1>
                <p class="text-secondary mb-0">Uzun tek akış üç blokta düzenlendi. Sağ panel, tamamlanma oranı ve hızlı bölüm geçişi sağlayarak tarama yükünü azaltır.</p>
            </div>
            <a href="{{ route('bebek.index') }}" class="btn btn-outline-primary">Kayıt listesine dön</a>
        </div>
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

    <div class="step-layout">
        <div>
            <form id="bebekForm" method="POST" action="{{ route('bebek.store', [], false) }}" novalidate>
                @csrf

                <div class="card mb-4 record-form-section" id="section-temel">
                    <div class="card-header">
                        <span>Temel bilgiler</span>
                        <span class="section-note">Zorunlu alanlar ve tarih akışı</span>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-sm-6 col-xl-3">
                                <label for="dogum_tarihi" class="form-label">Bebeğin Doğum Tarihi <span class="text-danger">*</span></label>
                                <input type="date" name="dogum_tarihi" id="dogum_tarihi" class="form-control @error('dogum_tarihi') is-invalid @enderror" value="{{ old('dogum_tarihi') }}" required>
                                @error('dogum_tarihi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <label for="kac_haftalik" class="form-label">Kaç haftalık</label>
                                <input type="number" min="20" max="45" name="kac_haftalik" id="kac_haftalik" class="form-control @error('kac_haftalik') is-invalid @enderror" value="{{ old('kac_haftalik', $defaults['kac_haftalik']) }}">
                                @error('kac_haftalik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <label for="muayene_tarihi" class="form-label">Muayene tarihi <span class="text-danger">*</span></label>
                                <input type="date" name="muayene_tarihi" id="muayene_tarihi" class="form-control @error('muayene_tarihi') is-invalid @enderror" value="{{ old('muayene_tarihi', now()->format('Y-m-d')) }}" required>
                                @error('muayene_tarihi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <label for="izlem_sayisi" class="form-label">İzlem sayısı <span class="text-danger">*</span></label>
                                <input type="number" min="1" max="20" name="izlem_sayisi" id="izlem_sayisi" class="form-control @error('izlem_sayisi') is-invalid @enderror" value="{{ old('izlem_sayisi', $defaults['izlem_sayisi']) }}" required>
                                @error('izlem_sayisi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <label for="termin_durumu" class="form-label">Termin durumu</label>
                                <select name="termin_durumu" id="termin_durumu" class="form-select @error('termin_durumu') is-invalid @enderror">
                                    <option value="">Seçiniz</option>
                                    @foreach (MedicalFormOptions::termOptions() as $term)
                                        <option value="{{ $term }}" @selected(old('termin_durumu', 'Term') === $term)>{{ $term }}</option>
                                    @endforeach
                                </select>
                                @error('termin_durumu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <label for="cinsiyet" class="form-label">Cinsiyet <span class="text-danger">*</span></label>
                                <select name="cinsiyet" id="cinsiyet" class="form-select @error('cinsiyet') is-invalid @enderror" required>
                                    <option value="">Seçiniz</option>
                                    @foreach (MedicalFormOptions::genderOptions() as $gender)
                                        <option value="{{ $gender }}" @selected(old('cinsiyet') === $gender)>{{ $gender }}</option>
                                    @endforeach
                                </select>
                                @error('cinsiyet')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <label for="kacinci_cocuk" class="form-label">Kaçıncı çocuk</label>
                                <input type="number" min="1" max="20" name="kacinci_cocuk" id="kacinci_cocuk" class="form-control @error('kacinci_cocuk') is-invalid @enderror" value="{{ old('kacinci_cocuk', 1) }}">
                                @error('kacinci_cocuk')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <label for="kan_grubu" class="form-label">Kan grubu</label>
                                <select name="kan_grubu" id="kan_grubu" class="form-select @error('kan_grubu') is-invalid @enderror">
                                    <option value="">Seçiniz</option>
                                    @foreach (MedicalFormOptions::bloodGroups() as $group)
                                        <option value="{{ $group }}" @selected(old('kan_grubu') === $group)>{{ $group }}</option>
                                    @endforeach
                                </select>
                                @error('kan_grubu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4 record-form-section" id="section-vital">
                    <div class="card-header">
                        <span>Vital bulgular</span>
                        <span class="section-note">Ölçüm alanları mantıksal sırada</span>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-6 col-md-4 col-xl">
                                <label for="ates" class="form-label">Ateş (C)</label>
                                <input type="number" step="0.1" min="34" max="42" name="ates" id="ates" class="form-control @error('ates') is-invalid @enderror" value="{{ old('ates', $defaults['ates']) }}">
                                @error('ates')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-6 col-md-4 col-xl">
                                <label for="nabiz" class="form-label">Nabız</label>
                                <input type="number" min="60" max="220" name="nabiz" id="nabiz" class="form-control @error('nabiz') is-invalid @enderror" value="{{ old('nabiz', $defaults['nabiz']) }}">
                                @error('nabiz')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-6 col-md-4 col-xl">
                                <label for="solunum" class="form-label">Solunum</label>
                                <input type="number" min="10" max="120" name="solunum" id="solunum" class="form-control @error('solunum') is-invalid @enderror" value="{{ old('solunum', $defaults['solunum']) }}">
                                @error('solunum')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-6 col-md-4 col-xl">
                                <label for="kilo" class="form-label">Kilo (kg) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" name="kilo" id="kilo" class="form-control @error('kilo') is-invalid @enderror" value="{{ old('kilo', $defaults['kilo']) }}" required>
                                @error('kilo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-6 col-md-4 col-xl">
                                <label for="boy" class="form-label">Boy (cm) <span class="text-danger">*</span></label>
                                <input type="number" step="1" name="boy" id="boy" class="form-control @error('boy') is-invalid @enderror" value="{{ old('boy', $defaults['boy']) }}" required>
                                @error('boy')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-6 col-md-4 col-xl">
                                <label for="bas_cevresi" class="form-label">Baş Çevresi (cm) <span class="text-danger">*</span></label>
                                <input type="number" step="0.1" name="bas_cevresi" id="bas_cevresi" class="form-control @error('bas_cevresi') is-invalid @enderror" value="{{ old('bas_cevresi', $defaults['bas_cevresi']) }}" required>
                                @error('bas_cevresi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-6 col-md-4 col-xl">
                                <label for="gogus_cevresi" class="form-label">Göğüs çevresi</label>
                                <input type="number" step="0.01" min="10" max="80" name="gogus_cevresi" id="gogus_cevresi" class="form-control @error('gogus_cevresi') is-invalid @enderror" value="{{ old('gogus_cevresi', $defaults['gogus_cevresi']) }}">
                                @error('gogus_cevresi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4 record-form-section" id="section-gozlem">
                    @foreach ($labels as $field => $label)
                        <div class="col-lg-6">
                            <div class="card h-100">
                                <div class="card-header">{{ $label }}</div>
                                <div class="card-body">
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach ($options[$field] as $index => $option)
                                            <div class="form-check form-check-choice">
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

                <div class="glass-panel p-3 p-lg-4 mt-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 form-actions">
                    <p class="text-secondary mb-0">Kayıt sonrası PDF alabilir, liste ekranında kalite ve takip tarihini izleyebilirsiniz.</p>
                    <button type="submit" class="btn btn-primary btn-lg">Bebek kaydını oluştur</button>
                </div>
            </form>
        </div>

        <aside class="sticky-panel">
            <div class="glass-panel p-3 p-lg-4 mb-3">
                <div class="d-flex justify-content-between small text-secondary mb-2"><span>Zorunlu alan tamamlanma</span><span id="bebekProgressText">%0</span></div>
                <div class="progress mb-3" style="height: 10px;"><div id="bebekProgressBar" class="progress-bar bg-success" style="width: 0%"></div></div>
                <div class="small text-secondary">Temel ve vital alanlar doldukça oran güncellenir. Amaç, kaydetmeden önce eksik bırakılan kritik alanları görünür kılmaktır.</div>
            </div>
            <div class="glass-panel p-3 p-lg-4">
                <h2 class="h5 mb-3">Hızlı gezinme</h2>
                <div class="d-grid gap-2">
                    <a href="#section-temel" class="btn btn-outline-primary text-start">Temel bilgiler</a>
                    <a href="#section-vital" class="btn btn-outline-primary text-start">Vital bulgular</a>
                    <a href="#section-gozlem" class="btn btn-outline-primary text-start">Gözlem listeleri</a>
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('bebekForm');
        const progressBar = document.getElementById('bebekProgressBar');
        const progressText = document.getElementById('bebekProgressText');
        const requiredFields = Array.from(form.querySelectorAll('[required]'));

        function refreshProgress() {
            const completed = requiredFields.filter(function (field) {
                return String(field.value || '').trim() !== '';
            }).length;
            const percent = requiredFields.length ? Math.round((completed / requiredFields.length) * 100) : 0;
            progressBar.style.width = percent + '%';
            progressText.textContent = '%' + percent;
        }

        form.addEventListener('input', refreshProgress);
        form.addEventListener('change', refreshProgress);
        refreshProgress();
    });
</script>
@endpush
