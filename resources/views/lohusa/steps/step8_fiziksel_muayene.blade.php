@php
    use App\Support\MedicalFormOptions;
    $defaults = $clinicalDefaults['lohusa'];
@endphp
<div class="form-section fade-in p-3 rounded card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">G. Fiziksel Muayene</div>
    <div class="card-body">
        <p class="text-muted small mb-3">Klinik ölçüler ortalama değerlerle gelir; hastaya göre üzerine yazabilirsiniz.</p>
        <div class="row g-3">
            <div class="col-md-3"><label>Muayene tarihi</label><input type="date" name="muayene_tarihi" class="form-control" value="{{ old('muayene_tarihi', now()->format('Y-m-d')) }}"></div>
            <div class="col-md-3"><label>Postpartum hafta</label><input type="number" name="postpartum_hafta" class="form-control" value="{{ old('postpartum_hafta') }}"></div>
            <div class="col-md-3"><label>Gebelik kilosu</label><input type="number" step="1" name="gebelik_kilosu" class="form-control" value="{{ old('gebelik_kilosu', $defaults['gebelik_kilosu']) }}"></div>
            <div class="col-md-3"><label>Mevcut kilo</label><input type="number" step="1" name="mevcut_kilo" class="form-control" value="{{ old('mevcut_kilo', $defaults['mevcut_kilo']) }}"></div>
        </div>
        <div class="row mt-3">
            <label class="fw-bold text-primary">Yaşam bulguları:</label>
            <div class="col-md-3"><label>Ateş (°C)</label><input type="number" step="0.1" name="ates" class="form-control" value="{{ old('ates', $defaults['ates']) }}" placeholder="36.5"></div>
            <div class="col-md-3"><label>Nabız</label><input type="number" name="nabiz" class="form-control" value="{{ old('nabiz', $defaults['nabiz']) }}"></div>
            <div class="col-md-3"><label>Solunum</label><input type="number" name="solunum" class="form-control" value="{{ old('solunum', $defaults['solunum']) }}"></div>
            <div class="col-md-3"><label>Tansiyon</label><input type="text" name="tansiyon" class="form-control" value="{{ old('tansiyon', $defaults['tansiyon']) }}"></div>
        </div>

        @php
            $basFields = ['Baş ağrısı', 'Baş dönmesi'];
            $sacliDeriFields = ['Kepek', 'Bit, sirke', 'Dökülme', 'Saç hijyeni'];
            $yuzFields = ['Solukluk', 'Ödem'];
            $gozlerFields = ['Konjonktival solukluk', 'Sulanma, akıntı, iltihap', 'Çapaklanma', 'Göz kapaklarında ödem'];
            $burunFields = ['Tıkanıklık', 'Akıntı', 'Burun kanaması'];
            $agizDisferFields = ['Dudak mukozası soluk', 'Ağızda aft', 'Dişlerde çürük', 'Diş eti kanaması', 'Diş hijyeni bozukluğu'];
            $bogazFields = ['Hipertiroidi', 'Lenf bezlerinde şişme', 'Tonsillerde şişme'];
            $solunumFields = ['Solunum (normal/hızlı)', 'Nefes darlığı', 'Akciğer seslerinde patoloji', 'Öksürük', 'Göğüs ağrısı', 'Kalp sesleri (taşikardi, bradikardi)'];
            $goguslerFields = ['Kızarıklık', 'Hassasiyet', 'Dolgunluk', 'Meme ucu çatlağı', 'Meme absesi', 'Meme enfeksiyonu / mastit', 'Önceden geçirilmiş meme hastalığı'];
            $losiaFields = ['Loşi akıntıda anormal bulgu', 'Üretrosel', 'Cinsel ilişki', 'İlişki sırasında herhangi bir sorun', 'Epizyo bölgesinde enfeksiyon belirtileri', 'Perine hijyeni (uygun teknikte)', 'Hematom'];
            $abdomenFields = ['Linea nigra', 'Strialar', 'Diastazis rekti', 'İnsizyon bölgesinde enfeksiyon belirtileri', 'Egzersiz uygulanması'];
            $urinerFields = ['Sık idrara çıkma', 'Ağrılı idrara çıkma', 'İnkontinans', 'Sistosel', 'Enfeksiyon', 'Kegel egzersizi uygulanması'];
            $barsakFields = ['Konstipasyon', 'Diyare', 'Distansiyon', 'Rektosel', 'Hemoroid'];
            $altExtremiteFields = ['Bacaklarda tromboflebit belirtileri', 'Ödem', 'Varis'];
        @endphp

        <div class="mt-4"><h5>Baş</h5>@foreach ($basFields as $field)<div class="form-check form-check-inline"><input type="checkbox" name="bas_bulgular[]" value="{{ $field }}" class="form-check-input"><label class="form-check-label">{{ $field }}</label></div>@endforeach</div>
        <div class="mt-3"><h5>Saçlı deri</h5>@foreach ($sacliDeriFields as $field)<div class="form-check form-check-inline"><input type="checkbox" name="sacli_deri_bulgular[]" value="{{ $field }}" class="form-check-input"><label class="form-check-label">{{ $field }}</label></div>@endforeach</div>
        <div class="mt-3"><h5>Yüz</h5>@foreach ($yuzFields as $field)<div class="form-check form-check-inline"><input type="checkbox" name="yuz_bulgular[]" value="{{ $field }}" class="form-check-input"><label class="form-check-label">{{ $field }}</label></div>@endforeach</div>
        <div class="mt-3"><h5>Gözler</h5>@foreach ($gozlerFields as $field)<div class="form-check form-check-inline"><input type="checkbox" name="goz_bulgular[]" value="{{ $field }}" class="form-check-input"><label class="form-check-label">{{ $field }}</label></div>@endforeach</div>
        <div class="mt-3"><h5>Burun</h5>@foreach ($burunFields as $field)<div class="form-check form-check-inline"><input type="checkbox" name="burun_bulgular[]" value="{{ $field }}" class="form-check-input"><label class="form-check-label">{{ $field }}</label></div>@endforeach</div>
        <div class="mt-3"><h5>Ağız / Dişler</h5>@foreach ($agizDisferFields as $field)<div class="form-check form-check-inline"><input type="checkbox" name="agiz_disfer_bulgular[]" value="{{ $field }}" class="form-check-input"><label class="form-check-label">{{ $field }}</label></div>@endforeach</div>
        <div class="mt-3"><h5>Boğaz</h5>@foreach ($bogazFields as $field)<div class="form-check form-check-inline"><input type="checkbox" name="bogaz_bulgular[]" value="{{ $field }}" class="form-check-input"><label class="form-check-label">{{ $field }}</label></div>@endforeach</div>
        <div class="mt-3"><h5>Solunum sistemi / KVS</h5>@foreach ($solunumFields as $field)<div class="form-check form-check-inline"><input type="checkbox" name="solunum_bulgular[]" value="{{ $field }}" class="form-check-input"><label class="form-check-label">{{ $field }}</label></div>@endforeach</div>
        <div class="mt-3"><h5>Göğüs</h5>@foreach ($goguslerFields as $field)<div class="form-check form-check-inline"><input type="checkbox" name="gogus_bulgular[]" value="{{ $field }}" class="form-check-input"><label class="form-check-label">{{ $field }}</label></div>@endforeach</div>

        <div class="mt-3"><label>Meme ucu tipi:</label><select name="meme_ucu" class="form-control"><option value="Normal">Normal</option><option value="Düz">Düz</option><option value="İçe çökük">İçe çökük</option><option value="Büyük">Büyük</option></select></div>
        <div class="mt-3"><label>Emzirmeye uygunluk:</label><br><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="emzirmeye_uygun" value="Uygun"><label class="form-check-label">Uygun</label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="emzirmeye_uygun" value="Uygun değil"><label class="form-check-label">Uygun değil</label></div></div>
        <div class="mt-3"><label>Meme bakımı:</label><select name="meme_bakimi" class="form-select"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::breastCareOptions() as $option)<option value="{{ $option }}" @selected(old('meme_bakimi') === $option)>{{ $option }}</option>@endforeach</select></div>
        <div class="mt-3"><label>Sütyen kullanımı:</label><select name="sutyen_kullanimi" class="form-select"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::braUsageOptions() as $option)<option value="{{ $option }}" @selected(old('sutyen_kullanimi') === $option)>{{ $option }}</option>@endforeach</select></div>
        <div class="mt-3"><label>Fundus:</label><br><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="fundus_palpe_ediliyor" value="Palpe ediliyor"><label class="form-check-label">Palpe ediliyor</label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="fundus_palpe_ediliyor" value="Palpe edilmiyor"><label class="form-check-label">Palpe edilmiyor</label></div></div>
        <div class="mt-3"><label>Loşi tipi:</label><select name="losia_tipi" class="form-control"><option value="Rubra">Rubra</option><option value="Seroza">Seroza</option><option value="Alba">Alba</option></select></div>
        <div class="mt-3"><label class="fw-bold">Loşi ve ilgili bulgular:</label><br>@foreach ($losiaFields as $field)<div class="form-check form-check-inline"><input type="checkbox" name="losia_bulgulari[]" value="{{ $field }}" class="form-check-input"><label class="form-check-label">{{ $field }}</label></div>@endforeach</div>
        <div class="mt-3"><label class="fw-bold">Abdomen bulguları:</label><br>@foreach ($abdomenFields as $field)<div class="form-check form-check-inline"><input type="checkbox" name="abdomen_bulgulari[]" value="{{ $field }}" class="form-check-input"><label class="form-check-label">{{ $field }}</label></div>@endforeach</div>
        <div class="mt-3"><label class="fw-bold">Üriner sistem bulguları:</label><br>@foreach ($urinerFields as $field)<div class="form-check form-check-inline"><input type="checkbox" name="uriner_bulgular[]" value="{{ $field }}" class="form-check-input"><label class="form-check-label">{{ $field }}</label></div>@endforeach</div>
        <div class="mt-3"><label class="fw-bold">Bağırsak fonksiyonları:</label><br>@foreach ($barsakFields as $field)<div class="form-check form-check-inline"><input type="checkbox" name="barsak_bulgular[]" value="{{ $field }}" class="form-check-input"><label class="form-check-label">{{ $field }}</label></div>@endforeach</div>
        <div class="mt-3"><label class="fw-bold">Alt ekstremite bulguları:</label><br>@foreach ($altExtremiteFields as $field)<div class="form-check form-check-inline"><input type="checkbox" name="alt_ekstremite[]" value="{{ $field }}" class="form-check-input"><label class="form-check-label">{{ $field }}</label></div>@endforeach</div>

        <div class="mt-3"><label class="fw-bold">Uyku / dinlenme durumu:</label><br><div class="form-check form-check-inline"><input type="checkbox" name="uykusuzluk[]" value="Uykusuzluk" class="form-check-input"><label class="form-check-label">Uykusuzluk</label></div></div>
        <div class="mt-3"><label>Hemoglobin:</label><input type="number" name="hemoglobin" class="form-control" value="{{ old('hemoglobin', $defaults['hemoglobin']) }}"></div>
        <div class="mt-3"><label class="fw-bold">Beslenme durumu:</label><br><label>Herhangi bir nedenle diyet uyguluyor musunuz?</label><br><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="diyet_var_mi" value="Evet"><label class="form-check-label">Evet</label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="diyet_var_mi" value="Hayır"><label class="form-check-label">Hayır</label></div></div>
        <div class="mt-3"><label>Kilo ile ilgili sorununuz var mı?</label><select name="kilo_sorunu_tipi" class="form-control"><option value="">Yok</option><option value="Zayıflık">Zayıflık</option><option value="Şişmanlık">Şişmanlık</option><option value="Diğer">Diğer</option></select></div>
        <div class="mt-3"><label>İştahsızlık sorununuz var mı?</label><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="istahsizlik" value="Evet"><label class="form-check-label">Evet</label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="istahsizlik" value="Hayır"><label class="form-check-label">Hayır</label></div></div>
        <div class="mt-3"><label class="fw-bold">Yeme alışkanlığı:</label><br><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="yeme_aliskanligi" value="Düzenli"><label class="form-check-label">Düzenli (açıklayınız)</label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="yeme_aliskanligi" value="Düzensiz"><label class="form-check-label">Düzensiz (açıklayınız)</label></div><textarea name="yeme_aliskanligi_aciklama" class="form-control mt-2" placeholder="Açıklama yazınız...">{{ old('yeme_aliskanligi_aciklama') }}</textarea></div>
        <div class="mt-3"><label>Vitamin / mineral desteği:</label><br><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="vitamin_destegi" value="Evet"><label class="form-check-label">Evet</label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="vitamin_destegi" value="Hayır"><label class="form-check-label">Hayır</label></div><br><label class="mt-2">İçerik</label><select name="vitamin_icerigi" class="form-select"><option value="">Seçiniz</option>@foreach (MedicalFormOptions::supplementContentOptions() as $option)<option value="{{ $option }}" @selected(old('vitamin_icerigi') === $option)>{{ $option }}</option>@endforeach</select></div>
        <div class="mt-3"><label class="fw-bold">Yiyemediğiniz yiyecek var mı?</label><br><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="yiyemedigi_yiyecek" value="Evet"><label class="form-check-label">Evet</label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="yiyemedigi_yiyecek" value="Hayır"><label class="form-check-label">Hayır</label></div><textarea name="yiyemedigi_yiyecek_aciklama" class="form-control mt-2" placeholder="Varsa açıklayınız...">{{ old('yiyemedigi_yiyecek_aciklama') }}</textarea></div>
        <div class="mt-3"><label>Evde alınan besin grupları:</label><br>@foreach (MedicalFormOptions::foodGroupOptions() as $option)<div class="form-check form-check-inline"><input type="checkbox" name="alinan_besin_gruplari[]" value="{{ $option }}" class="form-check-input" @checked(in_array($option, old('alinan_besin_gruplari', []), true))><label class="form-check-label">{{ $option }}</label></div>@endforeach</div>
        <div class="mt-3"><label>Bebeğinizi nasıl besliyorsunuz?</label><select name="bebek_beslenmesi" class="form-control"><option>Emzirme</option><option>Ticari mama</option><option>Süt</option><option>Diğer</option></select></div>
    </div>
</div>
