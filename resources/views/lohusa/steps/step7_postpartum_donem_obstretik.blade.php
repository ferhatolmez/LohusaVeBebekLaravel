@php
    use App\Support\MedicalFormOptions;
@endphp
<div class="form-section p-3 rounded card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">F. Şu Anki Postpartum Döneme Ait Obstetrik Öykü</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <label for="postpartum_gun" class="form-label">Postpartum gün:</label>
                <input type="number" name="postpartum_gun" id="postpartum_gun" class="form-control @error('postpartum_gun') is-invalid @enderror" value="{{ old('postpartum_gun') }}">
                @error('postpartum_gun')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label for="hastaneden_cikis_gun" class="form-label">Hastaneden çıkalı kaç gün oldu?</label>
                <input type="number" name="hastaneden_cikis_gun" id="hastaneden_cikis_gun" class="form-control @error('hastaneden_cikis_gun') is-invalid @enderror" value="{{ old('hastaneden_cikis_gun') }}">
                @error('hastaneden_cikis_gun')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mt-3">
            <label>Şu an ilaç kullanıyor mu?</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('ilac_kullaniyor_mu') is-invalid @enderror" type="radio" name="ilac_kullaniyor_mu" id="ilac_evet" value="Evet" @checked(old('ilac_kullaniyor_mu') === 'Evet')>
                <label class="form-check-label" for="ilac_evet">Evet</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('ilac_kullaniyor_mu') is-invalid @enderror" type="radio" name="ilac_kullaniyor_mu" id="ilac_hayir" value="Hayır" @checked(old('ilac_kullaniyor_mu') === 'Hayır')>
                <label class="form-check-label" for="ilac_hayir">Hayır</label>
            </div>
            @error('ilac_kullaniyor_mu')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>

        @php
            $postpartumSikayetleri = ['Ateş', 'Sık ve yanmalı idrara çıkma', 'Aşırı vajinal kanama (menstruasyon kanamasından daha fazla)', 'Bayılma', 'Bacakta ağrı, kızarıklık, hassasiyet, şişlik', 'Vajinal akıntıda pis koku', 'Baş ağrısı ve görme bozukluğu', 'Perine de veya abdomende şiddetli ağrı', 'Alerji', 'Diğer'];
        @endphp

        <div class="mt-3">
            <label class="fw-bold text-danger">Hastaneden çıktıktan sonra aşağıdaki problemlerden herhangi biri oldu mu? Ve şu an var mı?</label>
            @foreach ($postpartumSikayetleri as $index => $item)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="postpartum_sikayetleri[]" id="sikayet_{{ $index }}" value="{{ $item }}" @checked(in_array($item, old('postpartum_sikayetleri', [])))>
                    <label class="form-check-label" for="sikayet_{{ $index }}">{{ $item }}</label>
                </div>
            @endforeach
        </div>

        <div class="mt-3">
            <label for="ne_yapildi" class="form-label">Olduysa ne yaptınız?</label>
            <select name="ne_yapildi" id="ne_yapildi" class="form-select @error('ne_yapildi') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach (MedicalFormOptions::actionTakenOptions() as $option)
                    <option value="{{ $option }}" @selected(old('ne_yapildi') === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('ne_yapildi')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mt-3">
            <label>Sigara kullanımı?</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('sigara_var_mi') is-invalid @enderror" type="radio" name="sigara_var_mi" id="sigara_evet" value="Evet" @checked(old('sigara_var_mi') === 'Evet')>
                <label class="form-check-label" for="sigara_evet">Evet</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('sigara_var_mi') is-invalid @enderror" type="radio" name="sigara_var_mi" id="sigara_hayir" value="Hayır" @checked(old('sigara_var_mi') === 'Hayır')>
                <label class="form-check-label" for="sigara_hayir">Hayır</label>
            </div>
            @error('sigara_var_mi')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>

        <div class="mt-2">
            <label>Alkol kullanımı?</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('alkol_var_mi') is-invalid @enderror" type="radio" name="alkol_var_mi" id="alkol_evet" value="Evet" @checked(old('alkol_var_mi') === 'Evet')>
                <label class="form-check-label" for="alkol_evet">Evet</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('alkol_var_mi') is-invalid @enderror" type="radio" name="alkol_var_mi" id="alkol_hayir" value="Hayır" @checked(old('alkol_var_mi') === 'Hayır')>
                <label class="form-check-label" for="alkol_hayir">Hayır</label>
            </div>
            @error('alkol_var_mi')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>

        <div class="mt-2">
            <label>Doğum sonrası kontrole gittiniz mi?</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('dogum_sonrasi_kontrol') is-invalid @enderror" type="radio" name="dogum_sonrasi_kontrol" id="kontrol_evet" value="Evet" @checked(old('dogum_sonrasi_kontrol') === 'Evet')>
                <label class="form-check-label" for="kontrol_evet">Evet</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('dogum_sonrasi_kontrol') is-invalid @enderror" type="radio" name="dogum_sonrasi_kontrol" id="kontrol_hayir" value="Hayır" @checked(old('dogum_sonrasi_kontrol') === 'Hayır')>
                <label class="form-check-label" for="kontrol_hayir">Hayır</label>
            </div>
            @error('dogum_sonrasi_kontrol')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>

        <div class="mt-4">
            <label class="fw-bold text-primary">Daha önce hiç aile planlaması yöntemi kullandınız mı?</label>
            <div class="card-body px-0">
                <div class="row g-3">
                    <div class="col-md-6"><label for="ap_hap_sure" class="form-label">Hap kullanım süresi</label><select class="form-select @error('ap_hap_sure') is-invalid @enderror" name="ap_hap_sure" id="ap_hap_sure"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::familyPlanningDurationOptions() as $option)<option value="{{ $option }}" @selected(old('ap_hap_sure') === $option)>{{ $option }}</option>@endforeach</select>@error('ap_hap_sure')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                    <div class="col-md-6"><label for="ap_hap_neden" class="form-label">Hap bırakma nedeni</label><select class="form-select @error('ap_hap_neden') is-invalid @enderror" name="ap_hap_neden" id="ap_hap_neden"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::familyPlanningStopReasonOptions() as $option)<option value="{{ $option }}" @selected(old('ap_hap_neden') === $option)>{{ $option }}</option>@endforeach</select>@error('ap_hap_neden')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                    <div class="col-md-6"><label for="ap_ria_sure" class="form-label">RİA kullanım süresi</label><select class="form-select @error('ap_ria_sure') is-invalid @enderror" name="ap_ria_sure" id="ap_ria_sure"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::familyPlanningDurationOptions() as $option)<option value="{{ $option }}" @selected(old('ap_ria_sure') === $option)>{{ $option }}</option>@endforeach</select>@error('ap_ria_sure')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                    <div class="col-md-6"><label for="ap_ria_neden" class="form-label">RİA bırakma nedeni</label><select class="form-select @error('ap_ria_neden') is-invalid @enderror" name="ap_ria_neden" id="ap_ria_neden"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::familyPlanningStopReasonOptions() as $option)<option value="{{ $option }}" @selected(old('ap_ria_neden') === $option)>{{ $option }}</option>@endforeach</select>@error('ap_ria_neden')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                    <div class="col-md-6"><label for="ap_kondom_sure" class="form-label">Kondom kullanım süresi</label><select class="form-select @error('ap_kondom_sure') is-invalid @enderror" name="ap_kondom_sure" id="ap_kondom_sure"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::familyPlanningDurationOptions() as $option)<option value="{{ $option }}" @selected(old('ap_kondom_sure') === $option)>{{ $option }}</option>@endforeach</select>@error('ap_kondom_sure')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                    <div class="col-md-6"><label for="ap_kondom_neden" class="form-label">Kondom bırakma nedeni</label><select class="form-select @error('ap_kondom_neden') is-invalid @enderror" name="ap_kondom_neden" id="ap_kondom_neden"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::familyPlanningStopReasonOptions() as $option)<option value="{{ $option }}" @selected(old('ap_kondom_neden') === $option)>{{ $option }}</option>@endforeach</select>@error('ap_kondom_neden')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                    <div class="col-md-6"><label for="ap_geleneksel_yontem_sure" class="form-label">Geleneksel yöntem süresi</label><select class="form-select @error('ap_geleneksel_yontem_sure') is-invalid @enderror" name="ap_geleneksel_yontem_sure" id="ap_geleneksel_yontem_sure"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::familyPlanningDurationOptions() as $option)<option value="{{ $option }}" @selected(old('ap_geleneksel_yontem_sure') === $option)>{{ $option }}</option>@endforeach</select>@error('ap_geleneksel_yontem_sure')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                    <div class="col-md-6"><label for="ap_geleneksel_yontem_neden" class="form-label">Geleneksel yöntemi bırakma nedeni</label><select class="form-select @error('ap_geleneksel_yontem_neden') is-invalid @enderror" name="ap_geleneksel_yontem_neden" id="ap_geleneksel_yontem_neden"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::familyPlanningStopReasonOptions() as $option)<option value="{{ $option }}" @selected(old('ap_geleneksel_yontem_neden') === $option)>{{ $option }}</option>@endforeach</select>@error('ap_geleneksel_yontem_neden')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <label for="su_an_ap_yontem" class="form-label">Şu anda düşündüğünüz AP yöntemi:</label>
            <select name="su_an_ap_yontem" id="su_an_ap_yontem" class="form-select @error('su_an_ap_yontem') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach (MedicalFormOptions::familyPlanningMethodOptions() as $option)
                    <option value="{{ $option }}" @selected(old('su_an_ap_yontem') === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('su_an_ap_yontem')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <label for="bebek_cinsiyet" class="form-label">Bebeğin cinsiyeti:</label>
            <select name="bebek_cinsiyet" id="bebek_cinsiyet" class="form-select @error('bebek_cinsiyet') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach (MedicalFormOptions::genderOptions() as $option)
                    <option value="{{ $option }}" @selected(old('bebek_cinsiyet') === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('bebek_cinsiyet')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <label for="anne_tercihi" class="form-label">Annenin / ailenin cinsiyet tercihi:</label>
            <select name="anne_tercihi" id="anne_tercihi" class="form-select @error('anne_tercihi') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach (MedicalFormOptions::genderPreferenceOptions() as $option)
                    <option value="{{ $option }}" @selected(old('anne_tercihi') === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('anne_tercihi')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <label for="cinsiyet_duygu" class="form-label">Doğumda cinsiyeti öğrendiğinizde ne hissettiniz?</label>
            <select name="cinsiyet_duygu" id="cinsiyet_duygu" class="form-select @error('cinsiyet_duygu') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach (MedicalFormOptions::feelingLevelOptions() as $option)
                    <option value="{{ $option }}" @selected(old('cinsiyet_duygu') === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('cinsiyet_duygu')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <label for="bebek_dusunceleri" class="form-label">Şu anda bebeğiniz hakkında ne düşünüyorsunuz?</label>
            <select name="bebek_dusunceleri" id="bebek_dusunceleri" class="form-select @error('bebek_dusunceleri') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach (MedicalFormOptions::babyThoughtOptions() as $option)
                    <option value="{{ $option }}" @selected(old('bebek_dusunceleri') === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('bebek_dusunceleri')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <label for="endise_var_mi" class="form-label">Doğum sonrası kendiniz ya da bebeğiniz için endişe durumu:</label>
            <select name="endise_var_mi" id="endise_var_mi" class="form-select @error('endise_var_mi') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach (MedicalFormOptions::yesNoOptions() as $option)
                    <option value="{{ $option }}" @selected(old('endise_var_mi') === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('endise_var_mi')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <label for="aile_yaklasim" class="form-label">Doğum sonrası babanın ve ailenin yaklaşımı:</label>
            <select name="aile_yaklasim" id="aile_yaklasim" class="form-select @error('aile_yaklasim') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach (MedicalFormOptions::familyApproachOptions() as $option)
                    <option value="{{ $option }}" @selected(old('aile_yaklasim') === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('aile_yaklasim')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <label for="dogum_sonrasi_cinsel_yasam" class="form-label">Doğum sonrası cinsel yaşam:</label>
            <select name="dogum_sonrasi_cinsel_yasam" id="dogum_sonrasi_cinsel_yasam" class="form-select @error('dogum_sonrasi_cinsel_yasam') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach (MedicalFormOptions::postpartumSexualLifeOptions() as $option)
                    <option value="{{ $option }}" @selected(old('dogum_sonrasi_cinsel_yasam') === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('dogum_sonrasi_cinsel_yasam')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        @php $geleneksel = ['Toprağa yatırma', 'Anneye su vermeme', 'Karnı sarma', 'Kundaklama', 'Höllüğe yatırma', '3 ezan bekleme', 'Şekerli su', 'Fizyolojik sarılık uygulamaları', 'Göbek düşmesi için uygulamalar', 'Tuzlama', 'Meme ovma', 'Diğer']; @endphp
        <div class="mt-4">
            <label class="fw-bold text-danger">Doğum sonrası geleneksel uygulamalar:</label><br>
            @foreach ($geleneksel as $index => $uygulama)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="geleneksel_uygulamalar[]" id="geleneksel_{{ $index }}" value="{{ $uygulama }}" class="form-check-input" @checked(in_array($uygulama, old('geleneksel_uygulamalar', [])))>
                    <label class="form-check-label" for="geleneksel_{{ $index }}">{{ $uygulama }}</label>
                </div>
            @endforeach
        </div>
    </div>
</div>
