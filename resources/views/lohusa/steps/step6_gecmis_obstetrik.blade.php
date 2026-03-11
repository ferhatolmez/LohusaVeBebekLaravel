@php
    use App\Support\MedicalFormOptions;
@endphp
<div class="form-section fade-in p-3 rounded card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">E. Geçmiş Obstetrik Öykü</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <label for="gravida" class="form-label">Gravida (gebelik sayısı)</label>
                <input type="number" name="gravida" id="gravida" class="form-control @error('gravida') is-invalid @enderror" min="0" placeholder="0" value="{{ old('gravida') }}">
                @error('gravida')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label for="para" class="form-label">Parite (canlı doğum sayısı)</label>
                <input type="number" name="para" id="para" class="form-control @error('para') is-invalid @enderror" min="0" placeholder="0" value="{{ old('para') }}">
                @error('para')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label for="abortus" class="form-label">Abortus sayısı</label>
                <input type="number" name="abortus" id="abortus" class="form-control @error('abortus') is-invalid @enderror" min="0" placeholder="0" value="{{ old('abortus') }}">
                @error('abortus')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label for="yasayan" class="form-label">Yaşayan çocuk sayısı</label>
                <input type="number" name="yasayan" id="yasayan" class="form-control @error('yasayan') is-invalid @enderror" min="0" placeholder="0" value="{{ old('yasayan') }}">
                @error('yasayan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mt-3">
            <label for="cocuklarin_cinsiyeti" class="form-label">Yaşayan çocukların cinsiyeti:</label>
            <select name="cocuklarin_cinsiyeti" id="cocuklarin_cinsiyeti" class="form-select @error('cocuklarin_cinsiyeti') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach (MedicalFormOptions::childGenderSummaryOptions() as $option)
                    <option value="{{ $option }}" @selected(old('cocuklarin_cinsiyeti') === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('cocuklarin_cinsiyeti')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <label for="cocuklarin_saglik_durumu" class="form-label">Sağlık durumları:</label>
            <select name="cocuklarin_saglik_durumu" id="cocuklarin_saglik_durumu" class="form-select @error('cocuklarin_saglik_durumu') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach (MedicalFormOptions::childHealthStatusOptions() as $option)
                    <option value="{{ $option }}" @selected(old('cocuklarin_saglik_durumu') === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('cocuklarin_saglik_durumu')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <label for="dogum_yeri_kisi_sekli" class="form-label">Doğumların yapıldığı yer, yaptıran kişi, doğum şekli:</label>
            <select name="dogum_yeri_kisi_sekli" id="dogum_yeri_kisi_sekli" class="form-select @error('dogum_yeri_kisi_sekli') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach (MedicalFormOptions::birthHistorySummaryOptions() as $option)
                    <option value="{{ $option }}" @selected(old('dogum_yeri_kisi_sekli') === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('dogum_yeri_kisi_sekli')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <label for="abortus_yeri_kisi" class="form-label">Abortusların yapıldığı yer ve kişi bilgisi:</label>
            <select name="abortus_yeri_kisi" id="abortus_yeri_kisi" class="form-select @error('abortus_yeri_kisi') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach (MedicalFormOptions::abortionHistorySummaryOptions() as $option)
                    <option value="{{ $option }}" @selected(old('abortus_yeri_kisi') === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('abortus_yeri_kisi')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        @php
            $gebelikProblemleri = ['Hipertansiyon', 'Ödem', 'Anemi', 'Kanama', 'Enfeksiyon', 'Psikolojik problemler', 'Abortus', 'Diğer problemler'];
            $dogumProblemleri = ['Sezeryan', 'Forseps', 'Vakum', 'Uzun doğum', 'Hızlı doğum', 'İkiz doğum', 'Aşırı kanama', 'EMR', 'Uterus inversiyonu', 'Epizyotomi', 'Laserasyon', 'Plasenta retansiyonu', 'Ölü doğum', 'Problemli bebek', 'Konjenital anomali', 'Sarılık', 'Diğer'];
            $postpartumProblemleri = ['Kanama', 'Enfeksiyon', 'Toksemi', 'Hematom', 'Psikolojik problemler', 'Diğer'];
        @endphp

        <div class="mt-3"><label class="fw-bold text-danger">Önceki gebeliklerinizde ve en son gebeliğinizde aşağıdaki problemlerden herhangi biri oldu mu?</label></div>
        <div class="mt-4">
            <label class="form-label">En son gebelik problemleri:</label><br>
            @foreach ($gebelikProblemleri as $index => $problem)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="gebelik_problemleri_son[]" id="gebelik_son_{{ $index }}" value="{{ $problem }}" class="form-check-input" @checked(in_array($problem, old('gebelik_problemleri_son', [])))>
                    <label class="form-check-label" for="gebelik_son_{{ $index }}">{{ $problem }}</label>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            <label class="form-label">Önceki gebelik problemleri:</label><br>
            @foreach ($gebelikProblemleri as $index => $problem)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="gebelik_problemleri_onceki[]" id="gebelik_onceki_{{ $index }}" value="{{ $problem }}" class="form-check-input" @checked(in_array($problem, old('gebelik_problemleri_onceki', [])))>
                    <label class="form-check-label" for="gebelik_onceki_{{ $index }}">{{ $problem }}</label>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            <label class="fw-bold text-danger">Önceki doğumlarınızda ve en son doğumunuzda aşağıdaki problemlerden herhangi biri oldu mu?</label><br><br>
            <label class="form-label">En son doğum problemleri:</label><br>
            @foreach ($dogumProblemleri as $index => $problem)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="dogum_problemleri_son[]" id="dogum_son_{{ $index }}" value="{{ $problem }}" class="form-check-input" @checked(in_array($problem, old('dogum_problemleri_son', [])))>
                    <label class="form-check-label" for="dogum_son_{{ $index }}">{{ $problem }}</label>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            <label class="form-label">Önceki doğum problemleri:</label><br>
            @foreach ($dogumProblemleri as $index => $problem)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="dogum_problemleri_onceki[]" id="dogum_onceki_{{ $index }}" value="{{ $problem }}" class="form-check-input" @checked(in_array($problem, old('dogum_problemleri_onceki', [])))>
                    <label class="form-check-label" for="dogum_onceki_{{ $index }}">{{ $problem }}</label>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            <label class="fw-bold text-danger">Önceki doğumlarınızda postpartum dönemde aşağıdaki problemlerden herhangi biri oldu mu?</label><br><br>
            <label class="form-label">Postpartum dönemde problemler:</label><br>
            @foreach ($postpartumProblemleri as $index => $problem)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="postpartum_problemleri[]" id="postpartum_{{ $index }}" value="{{ $problem }}" class="form-check-input" @checked(in_array($problem, old('postpartum_problemleri', [])))>
                    <label class="form-check-label" for="postpartum_{{ $index }}">{{ $problem }}</label>
                </div>
            @endforeach
        </div>
    </div>
</div>
ass="form-check-label">{{ $problem }}</label></div>@endforeach</div>
    </div>
</div>
