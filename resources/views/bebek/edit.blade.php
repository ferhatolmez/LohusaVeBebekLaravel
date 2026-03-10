@extends('layouts.app')

@php
    use App\Support\MedicalFormOptions;

    $labels = MedicalFormOptions::bebekChecklistLabels();
    $options = MedicalFormOptions::bebekChecklistOptions();
@endphp

@section('title', 'Bebek Kaydı Düzenle')

@section('content')
<div class="container">
    <section class="page-header">
        <div class="page-header-row">
            <div>
                <span class="badge-soft mb-2">Düzenleme ekranı</span>
                <h1 class="h2 mb-2">Bebek kaydını düzenle</h1>
                <p class="text-secondary mb-0">Oluşturma ekranındaki bölümleme ve tamamlanma göstergesi düzenleme akışına da taşındı; böylece iki ekranın davranışı tutarlı kaldı.</p>
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
            <form id="bebekEditForm" method="POST" action="{{ route('bebek.update', $bebekForm) }}">
                @csrf
                @method('PUT')

                <div class="card mb-4 record-form-section" id="section-temel">
                    <div class="card-header">
                        <span>Temel bilgiler</span>
                        <span class="section-note">Tarih ve kimlik alanları</span>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-sm-6 col-xl-3"><label class="form-label">Doğum tarihi</label><input type="date" name="dogum_tarihi" class="form-control @error('dogum_tarihi') is-invalid @enderror" value="{{ old('dogum_tarihi', $bebekForm->dogum_tarihi?->format('Y-m-d')) }}" required></div>
                            <div class="col-sm-6 col-xl-3"><label class="form-label">Kaç haftalık</label><input type="number" min="20" max="45" name="kac_haftalik" class="form-control @error('kac_haftalik') is-invalid @enderror" value="{{ old('kac_haftalik', $bebekForm->kac_haftalik) }}" required></div>
                            <div class="col-sm-6 col-xl-3"><label class="form-label">Muayene tarihi</label><input type="date" name="muayene_tarihi" class="form-control @error('muayene_tarihi') is-invalid @enderror" value="{{ old('muayene_tarihi', $bebekForm->muayene_tarihi?->format('Y-m-d')) }}" required></div>
                            <div class="col-sm-6 col-xl-3"><label class="form-label">İzlem sayısı</label><input type="number" min="1" max="20" name="izlem_sayisi" class="form-control @error('izlem_sayisi') is-invalid @enderror" value="{{ old('izlem_sayisi', $bebekForm->izlem_sayisi) }}" required></div>
                            <div class="col-sm-6 col-xl-3"><label class="form-label">Termin durumu</label><select name="termin_durumu" class="form-select @error('termin_durumu') is-invalid @enderror" required>@foreach (MedicalFormOptions::termOptions() as $term)<option value="{{ $term }}" @selected(old('termin_durumu', $bebekForm->termin_durumu) === $term)>{{ $term }}</option>@endforeach</select></div>
                            <div class="col-sm-6 col-xl-3"><label class="form-label">Cinsiyet</label><select name="cinsiyet" class="form-select @error('cinsiyet') is-invalid @enderror" required>@foreach (MedicalFormOptions::genderOptions() as $gender)<option value="{{ $gender }}" @selected(old('cinsiyet', $bebekForm->cinsiyet) === $gender)>{{ $gender }}</option>@endforeach</select></div>
                            <div class="col-sm-6 col-xl-3"><label class="form-label">Kaçıncı çocuk</label><input type="number" min="1" max="20" name="kacinci_cocuk" class="form-control @error('kacinci_cocuk') is-invalid @enderror" value="{{ old('kacinci_cocuk', $bebekForm->kacinci_cocuk) }}" required></div>
                            <div class="col-sm-6 col-xl-3"><label class="form-label">Kan grubu</label><select name="kan_grubu" class="form-select @error('kan_grubu') is-invalid @enderror" required>@foreach (MedicalFormOptions::bloodGroups() as $group)<option value="{{ $group }}" @selected(old('kan_grubu', $bebekForm->kan_grubu) === $group)>{{ $group }}</option>@endforeach</select></div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4 record-form-section" id="section-vital">
                    <div class="card-header">
                        <span>Vital bulgular</span>
                        <span class="section-note">Ölçüm sırası korunur</span>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-6 col-md-4 col-xl"><label class="form-label">Ateş</label><input type="number" step="0.1" name="ates" class="form-control @error('ates') is-invalid @enderror" value="{{ old('ates', $bebekForm->ates) }}" required></div>
                            <div class="col-6 col-md-4 col-xl"><label class="form-label">Nabız</label><input type="number" name="nabiz" class="form-control @error('nabiz') is-invalid @enderror" value="{{ old('nabiz', $bebekForm->nabiz) }}" required></div>
                            <div class="col-6 col-md-4 col-xl"><label class="form-label">Solunum</label><input type="number" name="solunum" class="form-control @error('solunum') is-invalid @enderror" value="{{ old('solunum', $bebekForm->solunum) }}" required></div>
                            <div class="col-6 col-md-4 col-xl"><label class="form-label">Kilo</label><input type="number" step="0.01" name="kilo" class="form-control @error('kilo') is-invalid @enderror" value="{{ old('kilo', $bebekForm->kilo) }}" required></div>
                            <div class="col-6 col-md-4 col-xl"><label class="form-label">Boy</label><input type="number" step="0.01" name="boy" class="form-control @error('boy') is-invalid @enderror" value="{{ old('boy', $bebekForm->boy) }}" required></div>
                            <div class="col-6 col-md-4 col-xl"><label class="form-label">Baş çevresi</label><input type="number" step="0.01" name="bas_cevresi" class="form-control @error('bas_cevresi') is-invalid @enderror" value="{{ old('bas_cevresi', $bebekForm->bas_cevresi) }}" required></div>
                            <div class="col-6 col-md-4 col-xl"><label class="form-label">Göğüs çevresi</label><input type="number" step="0.01" name="gogus_cevresi" class="form-control @error('gogus_cevresi') is-invalid @enderror" value="{{ old('gogus_cevresi', $bebekForm->gogus_cevresi) }}" required></div>
                        </div>
                    </div>
                </div>

                <div class="row g-4 record-form-section" id="section-gozlem">
                    @foreach ($labels as $field => $label)
                        @php $current = old($field, $bebekForm->$field ?? []); @endphp
                        <div class="col-lg-6">
                            <div class="card h-100">
                                <div class="card-header">{{ $label }}</div>
                                <div class="card-body d-flex flex-wrap gap-2">
                                    @foreach ($options[$field] as $index => $option)
                                        <div class="form-check form-check-choice">
                                            <input type="checkbox" class="form-check-input" name="{{ $field }}[]" id="edit_{{ $field }}_{{ $index }}" value="{{ $option }}" @checked(in_array($option, is_array($current) ? $current : [], true))>
                                            <label class="form-check-label small fw-semibold" for="edit_{{ $field }}_{{ $index }}">{{ $option }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="glass-panel p-3 p-lg-4 mt-4 d-flex flex-column flex-md-row gap-2 justify-content-between align-items-md-center form-actions">
                    <a href="{{ route('bebek.index') }}" class="btn btn-outline-primary">İptal</a>
                    <button type="submit" class="btn btn-primary btn-lg">Kaydı güncelle</button>
                </div>
            </form>
        </div>

        <aside class="sticky-panel">
            <div class="glass-panel p-3 p-lg-4 mb-3">
                <div class="d-flex justify-content-between small text-secondary mb-2"><span>Zorunlu alan tamamlanma</span><span id="bebekEditProgressText">%0</span></div>
                <div class="progress mb-3" style="height: 10px;"><div id="bebekEditProgressBar" class="progress-bar bg-success" style="width: 0%"></div></div>
                <div class="small text-secondary">Düzenleme sırasında kritik alanların boş kalıp kalmadığını sağ panelden takip edebilirsiniz.</div>
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
        const form = document.getElementById('bebekEditForm');
        const progressBar = document.getElementById('bebekEditProgressBar');
        const progressText = document.getElementById('bebekEditProgressText');
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
