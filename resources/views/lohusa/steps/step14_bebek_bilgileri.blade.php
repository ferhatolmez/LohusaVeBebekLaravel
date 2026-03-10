@php
    use App\Support\MedicalFormOptions;
@endphp
<div class="form-section card shadow-sm mb-4">
    <div class="card-header">Bu doğuma ait bebek bilgileri</div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-3"><label class="form-label">Doğum tarihi</label><input type="date" name="dogum_tarihi" class="form-control @error('dogum_tarihi') is-invalid @enderror" value="{{ old('dogum_tarihi') }}"></div>
            <div class="col-md-3"><label class="form-label">Kaç haftalık</label><input type="number" min="20" max="45" name="kac_haftalik" class="form-control @error('kac_haftalik') is-invalid @enderror" value="{{ old('kac_haftalik', $clinicalDefaults['bebek']['kac_haftalik']) }}"></div>
            <div class="col-md-3"><label class="form-label">Muayene tarihi</label><input type="date" name="muayene_tarihi" class="form-control @error('muayene_tarihi') is-invalid @enderror" value="{{ old('muayene_tarihi', now()->format('Y-m-d')) }}"></div>
            <div class="col-md-3"><label class="form-label">İzlem sayısı</label><input type="number" min="1" max="20" name="izlem_sayisi" class="form-control @error('izlem_sayisi') is-invalid @enderror" value="{{ old('izlem_sayisi', $clinicalDefaults['bebek']['izlem_sayisi']) }}"></div>
            <div class="col-md-3"><label class="form-label">Termin durumu</label><select name="termin_durumu" class="form-select @error('termin_durumu') is-invalid @enderror"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::termOptions() as $option)<option value="{{ $option }}" @selected(old('termin_durumu', 'Term') === $option)>{{ $option }}</option>@endforeach</select></div>
            <div class="col-md-3"><label class="form-label">Cinsiyet</label><select name="cinsiyet" class="form-select @error('cinsiyet') is-invalid @enderror"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::genderOptions() as $option)<option value="{{ $option }}" @selected(old('cinsiyet') === $option)>{{ $option }}</option>@endforeach</select></div>
            <div class="col-md-3"><label class="form-label">Kaçıncı çocuk?</label><input type="number" min="1" max="20" name="kacinci_cocuk" class="form-control @error('kacinci_cocuk') is-invalid @enderror" value="{{ old('kacinci_cocuk') }}"></div>
            <div class="col-md-3"><label class="form-label">Kan grubu</label><select name="kan_grubu" class="form-select @error('kan_grubu') is-invalid @enderror"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::bloodGroups() as $option)<option value="{{ $option }}" @selected(old('kan_grubu') === $option)>{{ $option }}</option>@endforeach</select></div>
        </div>
    </div>
</div>
