@php
    use App\Support\MedicalFormOptions;
@endphp
<div class="form-section fade-in p-3 rounded card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">E. Geçmiş Obstetrik Öykü</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3"><label>Gravida (gebelik sayısı)</label><input type="number" name="gravida" class="form-control" min="0" placeholder="0" value="{{ old('gravida') }}"></div>
            <div class="col-md-3"><label>Parite (canlı doğum sayısı)</label><input type="number" name="para" class="form-control" min="0" placeholder="0" value="{{ old('para') }}"></div>
            <div class="col-md-3"><label>Abortus sayısı</label><input type="number" name="abortus" class="form-control" min="0" placeholder="0" value="{{ old('abortus') }}"></div>
            <div class="col-md-3"><label>Yaşayan çocuk sayısı</label><input type="number" name="yasayan" class="form-control" min="0" placeholder="0" value="{{ old('yasayan') }}"></div>
        </div>

        <div class="mt-3"><label>Yaşayan çocukların cinsiyeti:</label><select name="cocuklarin_cinsiyeti" class="form-select"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::childGenderSummaryOptions() as $option)<option value="{{ $option }}" @selected(old('cocuklarin_cinsiyeti') === $option)>{{ $option }}</option>@endforeach</select></div>
        <div class="mt-3"><label>Sağlık durumları:</label><select name="cocuklarin_saglik_durumu" class="form-select"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::childHealthStatusOptions() as $option)<option value="{{ $option }}" @selected(old('cocuklarin_saglik_durumu') === $option)>{{ $option }}</option>@endforeach</select></div>
        <div class="mt-3"><label>Doğumların yapıldığı yer, yaptıran kişi, doğum şekli:</label><select name="dogum_yeri_kisi_sekli" class="form-select"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::birthHistorySummaryOptions() as $option)<option value="{{ $option }}" @selected(old('dogum_yeri_kisi_sekli') === $option)>{{ $option }}</option>@endforeach</select></div>
        <div class="mt-3"><label>Abortusların yapıldığı yer ve kişi bilgisi:</label><select name="abortus_yeri_kisi" class="form-select"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::abortionHistorySummaryOptions() as $option)<option value="{{ $option }}" @selected(old('abortus_yeri_kisi') === $option)>{{ $option }}</option>@endforeach</select></div>

        @php
            $gebelikProblemleri = ['Hipertansiyon', 'Ödem', 'Anemi', 'Kanama', 'Enfeksiyon', 'Psikolojik problemler', 'Abortus', 'Diğer problemler'];
            $dogumProblemleri = ['Sezeryan', 'Forseps', 'Vakum', 'Uzun doğum', 'Hızlı doğum', 'İkiz doğum', 'Aşırı kanama', 'EMR', 'Uterus inversiyonu', 'Epizyotomi', 'Laserasyon', 'Plasenta retansiyonu', 'Ölü doğum', 'Problemli bebek', 'Konjenital anomali', 'Sarılık', 'Diğer'];
            $postpartumProblemleri = ['Kanama', 'Enfeksiyon', 'Toksemi', 'Hematom', 'Psikolojik problemler', 'Diğer'];
        @endphp

        <div class="mt-3"><label class="fw-bold text-danger">Önceki gebeliklerinizde ve en son gebeliğinizde aşağıdaki problemlerden herhangi biri oldu mu?</label></div>
        <div class="mt-4"><label>En son gebelik problemleri:</label>@foreach ($gebelikProblemleri as $problem)<div class="form-check form-check-inline"><input type="checkbox" name="gebelik_problemleri_son[]" value="{{ $problem }}" class="form-check-input"><label class="form-check-label">{{ $problem }}</label></div>@endforeach</div>
        <div class="mt-3"><label>Önceki gebelik problemleri:</label>@foreach ($gebelikProblemleri as $problem)<div class="form-check form-check-inline"><input type="checkbox" name="gebelik_problemleri_onceki[]" value="{{ $problem }}" class="form-check-input"><label class="form-check-label">{{ $problem }}</label></div>@endforeach</div>
        <div class="mt-3"><label class="fw-bold text-danger">Önceki doğumlarınızda ve en son doğumunuzda aşağıdaki problemlerden herhangi biri oldu mu?</label><br><br><label>En son doğum problemleri:</label>@foreach ($dogumProblemleri as $problem)<div class="form-check form-check-inline"><input type="checkbox" name="dogum_problemleri_son[]" value="{{ $problem }}" class="form-check-input"><label class="form-check-label">{{ $problem }}</label></div>@endforeach</div>
        <div class="mt-3"><label>Önceki doğum problemleri:</label>@foreach ($dogumProblemleri as $problem)<div class="form-check form-check-inline"><input type="checkbox" name="dogum_problemleri_onceki[]" value="{{ $problem }}" class="form-check-input"><label class="form-check-label">{{ $problem }}</label></div>@endforeach</div>
        <div class="mt-3"><label class="fw-bold text-danger">Önceki doğumlarınızda postpartum dönemde aşağıdaki problemlerden herhangi biri oldu mu?</label><br><br><label>Postpartum dönemde problemler:</label>@foreach ($postpartumProblemleri as $problem)<div class="form-check form-check-inline"><input type="checkbox" name="postpartum_problemleri[]" value="{{ $problem }}" class="form-check-input"><label class="form-check-label">{{ $problem }}</label></div>@endforeach</div>
    </div>
</div>
