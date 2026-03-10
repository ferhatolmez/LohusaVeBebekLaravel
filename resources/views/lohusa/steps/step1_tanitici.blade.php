@php
    use App\Support\MedicalFormOptions;
@endphp
<div class="form-section card shadow-sm mb-4">
    <div class="card-header">A1. Lohusanın tanıtıcı bilgileri</div>
    <div class="card-body">
        <p class="text-secondary small mb-4">Kimlik ve temel sosyodemografik bilgiler bu adımda toplanır.</p>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="ad_soyad" class="form-label">Ad soyad <span class="text-danger">*</span></label>
                <input type="text" name="ad_soyad" id="ad_soyad" class="form-control form-control-lg only-letters @error('ad_soyad') is-invalid @enderror" value="{{ old('ad_soyad') }}" placeholder="Ad ve soyad" required>
                @error('ad_soyad')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label for="yas" class="form-label">Yaş <span class="text-danger">*</span></label>
                <input type="number" min="12" max="60" name="yas" id="yas" class="form-control form-control-lg only-numbers @error('yas') is-invalid @enderror" value="{{ old('yas') }}" placeholder="28" required>
                @error('yas')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label for="egitim_durumu" class="form-label">Eğitim durumu <span class="text-danger">*</span></label>
                <select name="egitim_durumu" id="egitim_durumu" class="form-select form-select-lg @error('egitim_durumu') is-invalid @enderror" required>
                    <option value="">Seçiniz</option>
                    @foreach (MedicalFormOptions::educationLevels() as $option)
                        <option value="{{ $option }}" @selected(old('egitim_durumu') === $option)>{{ $option }}</option>
                    @endforeach
                </select>
                @error('egitim_durumu')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label for="meslek" class="form-label">Meslek <span class="text-danger">*</span></label>
                <input type="text" name="meslek" id="meslek" class="form-control form-control-lg only-letters @error('meslek') is-invalid @enderror" value="{{ old('meslek') }}" placeholder="Örn: Ebe" required>
                @error('meslek')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label for="saglik_guvence" class="form-label">Sağlık güvencesi <span class="text-danger">*</span></label>
                <select name="saglik_guvence" id="saglik_guvence" class="form-select form-select-lg @error('saglik_guvence') is-invalid @enderror" required>
                    <option value="">Seçiniz</option>
                    @foreach (MedicalFormOptions::healthInsuranceOptions() as $option)
                        <option value="{{ $option }}" @selected(old('saglik_guvence') === $option)>{{ $option }}</option>
                    @endforeach
                </select>
                @error('saglik_guvence')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label for="akraba_evliligi" class="form-label">Akraba evliliği</label>
                <select name="akraba_evliligi" id="akraba_evliligi" class="form-select form-select-lg">
                    <option value="">Seçiniz</option>
                    @foreach (MedicalFormOptions::yesNoOptions() as $option)
                        <option value="{{ $option }}" @selected(old('akraba_evliligi') === $option)>{{ $option }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="evlilik_yili" class="form-label">Evlilik yılı</label>
                <input type="number" name="evlilik_yili" id="evlilik_yili" class="form-control form-control-lg @error('evlilik_yili') is-invalid @enderror" value="{{ old('evlilik_yili') }}" min="1950" max="{{ date('Y') }}" placeholder="2020">
                @error('evlilik_yili')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label for="kan_grubu" class="form-label">Kan grubu</label>
                <select name="kan_grubu" id="kan_grubu" class="form-select form-select-lg">
                    <option value="">Seçiniz</option>
                    @foreach (MedicalFormOptions::bloodGroups() as $option)
                        <option value="{{ $option }}" @selected(old('kan_grubu') === $option)>{{ $option }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="gebelik_planlandimi" class="form-label">Gebelik planlandı mı? <span class="text-danger">*</span></label>
                <select name="gebelik_planlandimi" id="gebelik_planlandimi" class="form-select form-select-lg @error('gebelik_planlandimi') is-invalid @enderror" required>
                    <option value="">Seçiniz</option>
                    @foreach (MedicalFormOptions::yesNoOptions() as $option)
                        <option value="{{ $option }}" @selected(old('gebelik_planlandimi') === $option)>{{ $option }}</option>
                    @endforeach
                </select>
                @error('gebelik_planlandimi')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label for="dogum_yeri" class="form-label">Doğum yeri <span class="text-danger">*</span></label>
                <input type="text" name="dogum_yeri" id="dogum_yeri" class="form-control form-control-lg only-letters @error('dogum_yeri') is-invalid @enderror" value="{{ old('dogum_yeri') }}" placeholder="Örn: İstanbul" required>
                @error('dogum_yeri')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>
</div>
