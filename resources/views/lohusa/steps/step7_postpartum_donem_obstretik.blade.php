@php
    use App\Support\MedicalFormOptions;
@endphp
<div class="form-section p-3 rounded card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">F. Şu Anki Postpartum Döneme Ait Obstetrik Öykü</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <label>Postpartum gün:</label>
                <input type="number" name="postpartum_gun" class="form-control" value="{{ old('postpartum_gun') }}">
            </div>
            <div class="col-md-4">
                <label>Hastaneden çıkalı kaç gün oldu?</label>
                <input type="number" name="hastaneden_cikis_gun" class="form-control" value="{{ old('hastaneden_cikis_gun') }}">
            </div>
        </div>

        <div class="mt-3">
            <label>Şu an ilaç kullanıyor mu?</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="ilac_kullaniyor_mu" value="Evet">
                <label class="form-check-label">Evet</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="ilac_kullaniyor_mu" value="Hayır">
                <label class="form-check-label">Hayır</label>
            </div>
        </div>

        @php
            $postpartumSikayetleri = ['Ateş', 'Sık ve yanmalı idrara çıkma', 'Aşırı vajinal kanama (menstruasyon kanamasından daha fazla)', 'Bayılma', 'Bacakta ağrı, kızarıklık, hassasiyet, şişlik', 'Vajinal akıntıda pis koku', 'Baş ağrısı ve görme bozukluğu', 'Perine de veya abdomende şiddetli ağrı', 'Alerji', 'Diğer'];
        @endphp

        <div class="mt-3">
            <label class="fw-bold text-danger">Hastaneden çıktıktan sonra aşağıdaki problemlerden herhangi biri oldu mu? Ve şu an var mı?</label>
            @foreach ($postpartumSikayetleri as $item)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="postpartum_sikayetleri[]" value="{{ $item }}">
                    <label class="form-check-label">{{ $item }}</label>
                </div>
            @endforeach
        </div>

        <div class="mt-3">
            <label>Olduysa ne yaptınız?</label>
            <select name="ne_yapildi" class="form-select">
                <option value="">Seçiniz</option>
                @foreach (MedicalFormOptions::actionTakenOptions() as $option)
                    <option value="{{ $option }}" @selected(old('ne_yapildi') === $option)>{{ $option }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-3">
            <label>Sigara kullanımı?</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="sigara_var_mi" value="Evet">
                <label class="form-check-label">Evet</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="sigara_var_mi" value="Hayır">
                <label class="form-check-label">Hayır</label>
            </div>
        </div>

        <div class="mt-2">
            <label>Alkol kullanımı?</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="alkol_var_mi" value="Evet">
                <label class="form-check-label">Evet</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="alkol_var_mi" value="Hayır">
                <label class="form-check-label">Hayır</label>
            </div>
        </div>

        <div class="mt-2">
            <label>Doğum sonrası kontrole gittiniz mi?</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="dogum_sonrasi_kontrol" value="Evet">
                <label class="form-check-label">Evet</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="dogum_sonrasi_kontrol" value="Hayır">
                <label class="form-check-label">Hayır</label>
            </div>
        </div>

        <div class="mt-4">
            <label class="fw-bold text-primary">Daha önce hiç aile planlaması yöntemi kullandınız mı?</label>
            <div class="card-body px-0">
                <div class="row g-3">
                    <div class="col-md-6"><label for="ap_hap_sure" class="form-label">Hap kullanım süresi</label><select class="form-select" name="ap_hap_sure" id="ap_hap_sure"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::familyPlanningDurationOptions() as $option)<option value="{{ $option }}" @selected(old('ap_hap_sure') === $option)>{{ $option }}</option>@endforeach</select></div>
                    <div class="col-md-6"><label for="ap_hap_neden" class="form-label">Hap bırakma nedeni</label><select class="form-select" name="ap_hap_neden" id="ap_hap_neden"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::familyPlanningStopReasonOptions() as $option)<option value="{{ $option }}" @selected(old('ap_hap_neden') === $option)>{{ $option }}</option>@endforeach</select></div>
                    <div class="col-md-6"><label for="ap_ria_sure" class="form-label">RİA kullanım süresi</label><select class="form-select" name="ap_ria_sure" id="ap_ria_sure"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::familyPlanningDurationOptions() as $option)<option value="{{ $option }}" @selected(old('ap_ria_sure') === $option)>{{ $option }}</option>@endforeach</select></div>
                    <div class="col-md-6"><label for="ap_ria_neden" class="form-label">RİA bırakma nedeni</label><select class="form-select" name="ap_ria_neden" id="ap_ria_neden"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::familyPlanningStopReasonOptions() as $option)<option value="{{ $option }}" @selected(old('ap_ria_neden') === $option)>{{ $option }}</option>@endforeach</select></div>
                    <div class="col-md-6"><label for="ap_kondom_sure" class="form-label">Kondom kullanım süresi</label><select class="form-select" name="ap_kondom_sure" id="ap_kondom_sure"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::familyPlanningDurationOptions() as $option)<option value="{{ $option }}" @selected(old('ap_kondom_sure') === $option)>{{ $option }}</option>@endforeach</select></div>
                    <div class="col-md-6"><label for="ap_kondom_neden" class="form-label">Kondom bırakma nedeni</label><select class="form-select" name="ap_kondom_neden" id="ap_kondom_neden"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::familyPlanningStopReasonOptions() as $option)<option value="{{ $option }}" @selected(old('ap_kondom_neden') === $option)>{{ $option }}</option>@endforeach</select></div>
                    <div class="col-md-6"><label for="ap_geleneksel_yontem_sure" class="form-label">Geleneksel yöntem süresi</label><select class="form-select" name="ap_geleneksel_yontem_sure" id="ap_geleneksel_yontem_sure"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::familyPlanningDurationOptions() as $option)<option value="{{ $option }}" @selected(old('ap_geleneksel_yontem_sure') === $option)>{{ $option }}</option>@endforeach</select></div>
                    <div class="col-md-6"><label for="ap_geleneksel_yontem_neden" class="form-label">Geleneksel yöntemi bırakma nedeni</label><select class="form-select" name="ap_geleneksel_yontem_neden" id="ap_geleneksel_yontem_neden"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::familyPlanningStopReasonOptions() as $option)<option value="{{ $option }}" @selected(old('ap_geleneksel_yontem_neden') === $option)>{{ $option }}</option>@endforeach</select></div>
                </div>
            </div>
        </div>

        <div class="mt-3"><label>Şu anda düşündüğünüz AP yöntemi:</label><select name="su_an_ap_yontem" class="form-select"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::familyPlanningMethodOptions() as $option)<option value="{{ $option }}" @selected(old('su_an_ap_yontem') === $option)>{{ $option }}</option>@endforeach</select></div>
        <div class="mt-3"><label>Bebeğin cinsiyeti:</label><select name="bebek_cinsiyet" class="form-select"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::genderOptions() as $option)<option value="{{ $option }}" @selected(old('bebek_cinsiyet') === $option)>{{ $option }}</option>@endforeach</select></div>
        <div class="mt-3"><label>Annenin / ailenin cinsiyet tercihi:</label><select name="anne_tercihi" class="form-select"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::genderPreferenceOptions() as $option)<option value="{{ $option }}" @selected(old('anne_tercihi') === $option)>{{ $option }}</option>@endforeach</select></div>
        <div class="mt-3"><label>Doğumda cinsiyeti öğrendiğinizde ne hissettiniz?</label><select name="cinsiyet_duygu" class="form-select"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::feelingLevelOptions() as $option)<option value="{{ $option }}" @selected(old('cinsiyet_duygu') === $option)>{{ $option }}</option>@endforeach</select></div>
        <div class="mt-3"><label>Şu anda bebeğiniz hakkında ne düşünüyorsunuz?</label><select name="bebek_dusunceleri" class="form-select"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::babyThoughtOptions() as $option)<option value="{{ $option }}" @selected(old('bebek_dusunceleri') === $option)>{{ $option }}</option>@endforeach</select></div>
        <div class="mt-3"><label>Doğum sonrası kendiniz ya da bebeğiniz için endişe durumu:</label><select name="endise_var_mi" class="form-select"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::concernLevelOptions() as $option)<option value="{{ $option }}" @selected(old('endise_var_mi') === $option)>{{ $option }}</option>@endforeach</select></div>
        <div class="mt-3"><label>Doğum sonrası babanın ve ailenin yaklaşımı:</label><select name="aile_yaklasim" class="form-select"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::familyApproachOptions() as $option)<option value="{{ $option }}" @selected(old('aile_yaklasim') === $option)>{{ $option }}</option>@endforeach</select></div>
        <div class="mt-3"><label>Doğum sonrası cinsel yaşam:</label><select name="dogum_sonrasi_cinsel_yasam" class="form-select"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::postpartumSexualLifeOptions() as $option)<option value="{{ $option }}" @selected(old('dogum_sonrasi_cinsel_yasam') === $option)>{{ $option }}</option>@endforeach</select></div>

        @php $geleneksel = ['Toprağa yatırma', 'Anneye su vermeme', 'Karnı sarma', 'Kundaklama', 'Höllüğe yatırma', '3 ezan bekleme', 'Şekerli su', 'Fizyolojik sarılık uygulamaları', 'Göbek düşmesi için uygulamalar', 'Tuzlama', 'Meme ovma', 'Diğer']; @endphp
        <div class="mt-4">
            <label class="fw-bold text-danger">Doğum sonrası geleneksel uygulamalar:</label><br>
            @foreach ($geleneksel as $uygulama)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="geleneksel_uygulamalar[]" value="{{ $uygulama }}" class="form-check-input">
                    <label class="form-check-label">{{ $uygulama }}</label>
                </div>
            @endforeach
        </div>
    </div>
</div>
