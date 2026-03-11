@php
    use App\Support\MedicalFormOptions;
@endphp
<div class="form-section card shadow-sm mb-4">
    <div class="card-header">Bu doğuma ait bebek bilgileri</div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-3">
                <label for="dogum_tarihi" class="form-label">Doğum tarihi <span class="text-danger">*</span></label>
                <input type="date" name="dogum_tarihi" id="dogum_tarihi" class="form-control @error('dogum_tarihi') is-invalid @enderror" value="{{ old('dogum_tarihi') }}" required>
                @error('dogum_tarihi')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label for="kac_haftalik" class="form-label">Kaç haftalık</label>
                <input type="number" min="20" max="45" name="kac_haftalik" id="kac_haftalik" class="form-control @error('kac_haftalik') is-invalid @enderror" value="{{ old('kac_haftalik') }}">
                @error('kac_haftalik')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label for="bebek_muayene_tarihi" class="form-label">Muayene tarihi</label>
                <input type="date" name="bebek_muayene_tarihi" id="bebek_muayene_tarihi" class="form-control @error('bebek_muayene_tarihi') is-invalid @enderror" value="{{ old('bebek_muayene_tarihi') }}">
                @error('bebek_muayene_tarihi')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label for="izlem_sayisi" class="form-label">İzlem sayısı</label>
                <input type="number" min="1" max="20" name="izlem_sayisi" id="izlem_sayisi" class="form-control @error('izlem_sayisi') is-invalid @enderror" value="{{ old('izlem_sayisi') }}">
                @error('izlem_sayisi')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label for="termin_durumu" class="form-label">Termin durumu</label>
                <select name="termin_durumu" id="termin_durumu" class="form-select @error('termin_durumu') is-invalid @enderror">
                    <option value="">Seçiniz</option>
                    @foreach (MedicalFormOptions::termOptions() as $option)
                        <option value="{{ $option }}" @selected(old('termin_durumu') === $option)>{{ $option }}</option>
                    @endforeach
                </select>
                @error('termin_durumu')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label for="cinsiyet" class="form-label">Cinsiyet</label>
                <select name="cinsiyet" id="cinsiyet" class="form-select @error('cinsiyet') is-invalid @enderror">
                    <option value="">Seçiniz</option>
                    @foreach (MedicalFormOptions::genderOptions() as $option)
                        <option value="{{ $option }}" @selected(old('cinsiyet') === $option)>{{ $option }}</option>
                    @endforeach
                </select>
                @error('cinsiyet')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label for="kacinci_cocuk" class="form-label">Kaçıncı çocuk?</label>
                <input type="number" min="1" max="20" name="kacinci_cocuk" id="kacinci_cocuk" class="form-control @error('kacinci_cocuk') is-invalid @enderror" value="{{ old('kacinci_cocuk') }}">
                @error('kacinci_cocuk')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label for="bebek_kan_grubu" class="form-label">Kan grubu</label>
                <select name="bebek_kan_grubu" id="bebek_kan_grubu" class="form-select @error('bebek_kan_grubu') is-invalid @enderror">
                    <option value="">Seçiniz</option>
                    @foreach (MedicalFormOptions::bloodGroups() as $option)
                        <option value="{{ $option }}" @selected(old('bebek_kan_grubu') === $option)>{{ $option }}</option>
                    @endforeach
                </select>
                @error('bebek_kan_grubu')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>
</div>

