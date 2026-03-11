@php
    use App\Support\MedicalFormOptions;
    $defaults = $clinicalDefaults['lohusa'];
@endphp
<div class="form-section fade-in p-3 rounded card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">G. Fiziksel Muayene</div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-3">
                <label for="muayene_tarihi" class="form-label">Muayene tarihi <span class="text-danger">*</span></label>
                <input type="date" name="muayene_tarihi" id="muayene_tarihi" class="form-control @error('muayene_tarihi') is-invalid @enderror" value="{{ old('muayene_tarihi') }}" required>
                @error('muayene_tarihi')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label for="postpartum_hafta" class="form-label">Postpartum hafta</label>
                <input type="number" name="postpartum_hafta" id="postpartum_hafta" class="form-control @error('postpartum_hafta') is-invalid @enderror" value="{{ old('postpartum_hafta') }}">
                @error('postpartum_hafta')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label for="gebelik_kilosu" class="form-label">Gebelik kilosu</label>
                <input type="number" step="1" min="30" max="250" name="gebelik_kilosu" id="gebelik_kilosu" class="form-control @error('gebelik_kilosu') is-invalid @enderror" value="{{ old('gebelik_kilosu') }}">
                @error('gebelik_kilosu')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label for="mevcut_kilo" class="form-label">Mevcut kilo <span class="text-danger">*</span></label>
                <input type="number" step="1" min="30" max="250" name="mevcut_kilo" id="mevcut_kilo" class="form-control @error('mevcut_kilo') is-invalid @enderror" value="{{ old('mevcut_kilo') }}" required>
                @error('mevcut_kilo')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="row mt-3">
            <label class="fw-bold text-primary">Yaşam bulguları:</label>
            <div class="col-md-3">
                <label for="ates" class="form-label">Ateş (°C) <span class="text-danger">*</span></label>
                <input type="number" step="0.1" min="34" max="42" name="ates" id="ates" class="form-control @error('ates') is-invalid @enderror" value="{{ old('ates') }}" required>
                @error('ates')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label for="nabiz" class="form-label">Nabız</label>
                <input type="number" step="1" min="40" max="250" name="nabiz" id="nabiz" class="form-control @error('nabiz') is-invalid @enderror" value="{{ old('nabiz') }}">
                @error('nabiz')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label for="solunum" class="form-label">Solunum</label>
                <input type="number" step="1" min="8" max="60" name="solunum" id="solunum" class="form-control @error('solunum') is-invalid @enderror" value="{{ old('solunum') }}">
                @error('solunum')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label for="tansiyon" class="form-label">Tansiyon <span class="text-danger">*</span></label>
                <input type="text" name="tansiyon" id="tansiyon" class="form-control @error('tansiyon') is-invalid @enderror" value="{{ old('tansiyon') }}" placeholder="120/80" required>
                @error('tansiyon')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
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

        <div class="mt-4">
            <h5>Baş</h5>
            @foreach ($basFields as $i => $field)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="bas_bulgular[]" id="bas_{{ $i }}" value="{{ $field }}" class="form-check-input" @checked(in_array($field, old('bas_bulgular', [])))>
                    <label class="form-check-label" for="bas_{{ $i }}">{{ $field }}</label>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            <h5>Saçlı deri</h5>
            @foreach ($sacliDeriFields as $i => $field)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="sacli_deri_bulgular[]" id="sacli_{{ $i }}" value="{{ $field }}" class="form-check-input" @checked(in_array($field, old('sacli_deri_bulgular', [])))>
                    <label class="form-check-label" for="sacli_{{ $i }}">{{ $field }}</label>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            <h5>Yüz</h5>
            @foreach ($yuzFields as $i => $field)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="yuz_bulgular[]" id="yuz_{{ $i }}" value="{{ $field }}" class="form-check-input" @checked(in_array($field, old('yuz_bulgular', [])))>
                    <label class="form-check-label" for="yuz_{{ $i }}">{{ $field }}</label>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            <h5>Gözler</h5>
            @foreach ($gozlerFields as $i => $field)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="goz_bulgular[]" id="goz_{{ $i }}" value="{{ $field }}" class="form-check-input" @checked(in_array($field, old('goz_bulgular', [])))>
                    <label class="form-check-label" for="goz_{{ $i }}">{{ $field }}</label>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            <h5>Burun</h5>
            @foreach ($burunFields as $i => $field)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="burun_bulgular[]" id="burun_{{ $i }}" value="{{ $field }}" class="form-check-input" @checked(in_array($field, old('burun_bulgular', [])))>
                    <label class="form-check-label" for="burun_{{ $i }}">{{ $field }}</label>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            <h5>Ağız / Dişler</h5>
            @foreach ($agizDisferFields as $i => $field)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="agiz_disfer_bulgular[]" id="agiz_{{ $i }}" value="{{ $field }}" class="form-check-input" @checked(in_array($field, old('agiz_disfer_bulgular', [])))>
                    <label class="form-check-label" for="agiz_{{ $i }}">{{ $field }}</label>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            <h5>Boğaz</h5>
            @foreach ($bogazFields as $i => $field)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="bogaz_bulgular[]" id="bogaz_{{ $i }}" value="{{ $field }}" class="form-check-input" @checked(in_array($field, old('bogaz_bulgular', [])))>
                    <label class="form-check-label" for="bogaz_{{ $i }}">{{ $field }}</label>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            <h5>Solunum sistemi / KVS</h5>
            @foreach ($solunumFields as $i => $field)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="solunum_bulgular[]" id="solunum_{{ $i }}" value="{{ $field }}" class="form-check-input" @checked(in_array($field, old('solunum_bulgular', [])))>
                    <label class="form-check-label" for="solunum_{{ $i }}">{{ $field }}</label>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            <h5>Göğüs</h5>
            @foreach ($goguslerFields as $i => $field)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="gogus_bulgular[]" id="gogus_{{ $i }}" value="{{ $field }}" class="form-check-input" @checked(in_array($field, old('gogus_bulgular', [])))>
                    <label class="form-check-label" for="gogus_{{ $i }}">{{ $field }}</label>
                </div>
            @endforeach
        </div>

        <div class="mt-3">
            <label for="meme_ucu" class="form-label">Meme ucu tipi:</label>
            <select name="meme_ucu" id="meme_ucu" class="form-select @error('meme_ucu') is-invalid @enderror">
                <option value="">Seçiniz</option>
                <option value="Normal" @selected(old('meme_ucu') === 'Normal')>Normal</option>
                <option value="Düz" @selected(old('meme_ucu') === 'Düz')>Düz</option>
                <option value="İçe çökük" @selected(old('meme_ucu') === 'İçe çökük')>İçe çökük</option>
                <option value="Büyük" @selected(old('meme_ucu') === 'Büyük')>Büyük</option>
            </select>
            @error('meme_ucu')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <label>Emzirmeye uygunluk:</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('emzirmeye_uygun') is-invalid @enderror" type="radio" name="emzirmeye_uygun" id="uygun_evet" value="Uygun" @checked(old('emzirmeye_uygun') === 'Uygun')>
                <label class="form-check-label" for="uygun_evet">Uygun</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('emzirmeye_uygun') is-invalid @enderror" type="radio" name="emzirmeye_uygun" id="uygun_hayir" value="Uygun değil" @checked(old('emzirmeye_uygun') === 'Uygun değil')>
                <label class="form-check-label" for="uygun_hayir">Uygun değil</label>
            </div>
            @error('emzirmeye_uygun')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <label for="meme_bakimi" class="form-label">Meme bakımı:</label>
            <select name="meme_bakimi" id="meme_bakimi" class="form-select @error('meme_bakimi') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach (MedicalFormOptions::breastCareOptions() as $option)
                    <option value="{{ $option }}" @selected(old('meme_bakimi') === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('meme_bakimi')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <label for="sutyen_kullanimi" class="form-label">Sütyen kullanımı:</label>
            <select name="sutyen_kullanimi" id="sutyen_kullanimi" class="form-select @error('sutyen_kullanimi') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach (MedicalFormOptions::braUsageOptions() as $option)
                    <option value="{{ $option }}" @selected(old('sutyen_kullanimi') === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('sutyen_kullanimi')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <label>Fundus:</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('fundus_palpe_ediliyor') is-invalid @enderror" type="radio" name="fundus_palpe_ediliyor" id="fundus_evet" value="Palpe ediliyor" @checked(old('fundus_palpe_ediliyor') === 'Palpe ediliyor')>
                <label class="form-check-label" for="fundus_evet">Palpe ediliyor</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('fundus_palpe_ediliyor') is-invalid @enderror" type="radio" name="fundus_palpe_ediliyor" id="fundus_hayir" value="Palpe edilmiyor" @checked(old('fundus_palpe_ediliyor') === 'Palpe edilmiyor')>
                <label class="form-check-label" for="fundus_hayir">Palpe edilmiyor</label>
            </div>
            @error('fundus_palpe_ediliyor')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <label for="losia_tipi" class="form-label">Loşi tipi:</label>
            <select name="losia_tipi" id="losia_tipi" class="form-select @error('losia_tipi') is-invalid @enderror">
                <option value="">Seçiniz</option>
                <option value="Rubra" @selected(old('losia_tipi') === 'Rubra')>Rubra</option>
                <option value="Seroza" @selected(old('losia_tipi') === 'Seroza')>Seroza</option>
                <option value="Alba" @selected(old('losia_tipi') === 'Alba')>Alba</option>
            </select>
            @error('losia_tipi')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <label class="fw-bold">Loşi ve ilgili bulgular:</label><br>
            @foreach ($losiaFields as $i => $field)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="losia_bulgulari[]" id="losia_{{ $i }}" value="{{ $field }}" class="form-check-input" @checked(in_array($field, old('losia_bulgulari', [])))>
                    <label class="form-check-label" for="losia_{{ $i }}">{{ $field }}</label>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            <label class="fw-bold">Abdomen bulguları:</label><br>
            @foreach ($abdomenFields as $i => $field)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="abdomen_bulgulari[]" id="abdomen_{{ $i }}" value="{{ $field }}" class="form-check-input" @checked(in_array($field, old('abdomen_bulgulari', [])))>
                    <label class="form-check-label" for="abdomen_{{ $i }}">{{ $field }}</label>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            <label class="fw-bold">Üriner sistem bulguları:</label><br>
            @foreach ($urinerFields as $i => $field)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="uriner_bulgular[]" id="uriner_{{ $i }}" value="{{ $field }}" class="form-check-input" @checked(in_array($field, old('uriner_bulgular', [])))>
                    <label class="form-check-label" for="uriner_{{ $i }}">{{ $field }}</label>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            <label class="fw-bold">Bağırsak fonksiyonları:</label><br>
            @foreach ($barsakFields as $i => $field)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="barsak_bulgular[]" id="barsak_{{ $i }}" value="{{ $field }}" class="form-check-input" @checked(in_array($field, old('barsak_bulgular', [])))>
                    <label class="form-check-label" for="barsak_{{ $i }}">{{ $field }}</label>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            <label class="fw-bold">Alt ekstremite bulguları:</label><br>
            @foreach ($altExtremiteFields as $i => $field)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="alt_ekstremite[]" id="alt_{{ $i }}" value="{{ $field }}" class="form-check-input" @checked(in_array($field, old('alt_ekstremite', [])))>
                    <label class="form-check-label" for="alt_{{ $i }}">{{ $field }}</label>
                </div>
            @endforeach
        </div>

        <div class="mt-3">
            <label class="fw-bold">Uyku / dinlenme durumu:</label><br>
            <div class="form-check form-check-inline">
                <input type="checkbox" name="uykusuzluk[]" id="uykusuzluk" value="Uykusuzluk" class="form-check-input" @checked(in_array('Uykusuzluk', old('uykusuzluk', [])))>
                <label class="form-check-label" for="uykusuzluk">Uykusuzluk</label>
            </div>
        </div>
        <div class="mt-3">
            <label for="hemoglobin" class="form-label">Hemoglobin:</label>
            <input type="number" step="0.1" min="5" max="20" name="hemoglobin" id="hemoglobin" class="form-control @error('hemoglobin') is-invalid @enderror" value="{{ old('hemoglobin') }}" placeholder="12">
            @error('hemoglobin')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <label class="fw-bold">Beslenme durumu:</label><br>
            <label>Herhangi bir nedenle diyet uyguluyor musunuz?</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('diyet_var_mi') is-invalid @enderror" type="radio" name="diyet_var_mi" id="diyet_evet" value="Evet" @checked(old('diyet_var_mi') === 'Evet')>
                <label class="form-check-label" for="diyet_evet">Evet</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('diyet_var_mi') is-invalid @enderror" type="radio" name="diyet_var_mi" id="diyet_hayir" value="Hayır" @checked(old('diyet_var_mi') === 'Hayır')>
                <label class="form-check-label" for="diyet_hayir">Hayır</label>
            </div>
            @error('diyet_var_mi')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <label for="kilo_sorunu_tipi" class="form-label">Kilo ile ilgili sorununuz var mı?</label>
            <select name="kilo_sorunu_tipi" id="kilo_sorunu_tipi" class="form-select @error('kilo_sorunu_tipi') is-invalid @enderror">
                <option value="">Yok</option>
                <option value="Zayıflık" @selected(old('kilo_sorunu_tipi') === 'Zayıflık')>Zayıflık</option>
                <option value="Şişmanlık" @selected(old('kilo_sorunu_tipi') === 'Şişmanlık')>Şişmanlık</option>
                <option value="Diğer" @selected(old('kilo_sorunu_tipi') === 'Diğer')>Diğer</option>
            </select>
            @error('kilo_sorunu_tipi')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <label>İştahsızlık sorununuz var mı?</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('istahsizlik') is-invalid @enderror" type="radio" name="istahsizlik" id="istahsizlik_evet" value="Evet" @checked(old('istahsizlik') === 'Evet')>
                <label class="form-check-label" for="istahsizlik_evet">Evet</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('istahsizlik') is-invalid @enderror" type="radio" name="istahsizlik" id="istahsizlik_hayir" value="Hayır" @checked(old('istahsizlik') === 'Hayır')>
                <label class="form-check-label" for="istahsizlik_hayir">Hayır</label>
            </div>
            @error('istahsizlik')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <label class="fw-bold">Yeme alışkanlığı:</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('yeme_aliskanligi') is-invalid @enderror" type="radio" name="yeme_aliskanligi" id="yeme_duzenli" value="Düzenli" @checked(old('yeme_aliskanligi') === 'Düzenli')>
                <label class="form-check-label" for="yeme_duzenli">Düzenli (açıklayınız)</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('yeme_aliskanligi') is-invalid @enderror" type="radio" name="yeme_aliskanligi" id="yeme_duzensiz" value="Düzensiz" @checked(old('yeme_aliskanligi') === 'Düzensiz')>
                <label class="form-check-label" for="yeme_duzensiz">Düzensiz (açıklayınız)</label>
            </div>
            @error('yeme_aliskanligi')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            <textarea name="yeme_aliskanligi_aciklama" id="yeme_aliskanligi_aciklama" class="form-control mt-2 @error('yeme_aliskanligi_aciklama') is-invalid @enderror" placeholder="Açıklama yazınız...">{{ old('yeme_aliskanligi_aciklama') }}</textarea>
            @error('yeme_aliskanligi_aciklama')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <label>Vitamin / mineral desteği:</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('vitamin_destegi') is-invalid @enderror" type="radio" name="vitamin_destegi" id="vitamin_evet" value="Evet" @checked(old('vitamin_destegi') === 'Evet')>
                <label class="form-check-label" for="vitamin_evet">Evet</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('vitamin_destegi') is-invalid @enderror" type="radio" name="vitamin_destegi" id="vitamin_hayir" value="Hayır" @checked(old('vitamin_destegi') === 'Hayır')>
                <label class="form-check-label" for="vitamin_hayir">Hayır</label>
            </div>
            @error('vitamin_destegi')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            <br>
            <label for="vitamin_icerigi" class="form-label mt-2">İçerik</label>
            <select name="vitamin_icerigi" id="vitamin_icerigi" class="form-select @error('vitamin_icerigi') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach (MedicalFormOptions::supplementContentOptions() as $option)
                    <option value="{{ $option }}" @selected(old('vitamin_icerigi') === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('vitamin_icerigi')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <label class="fw-bold">Yiyemediğiniz yiyecek var mı?</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('yiyemedigi_yiyecek') is-invalid @enderror" type="radio" name="yiyemedigi_yiyecek" id="yiyemedigi_evet" value="Evet" @checked(old('yiyemedigi_yiyecek') === 'Evet')>
                <label class="form-check-label" for="yiyemedigi_evet">Evet</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('yiyemedigi_yiyecek') is-invalid @enderror" type="radio" name="yiyemedigi_yiyecek" id="yiyemedigi_hayir" value="Hayır" @checked(old('yiyemedigi_yiyecek') === 'Hayır')>
                <label class="form-check-label" for="yiyemedigi_hayir">Hayır</label>
            </div>
            @error('yiyemedigi_yiyecek')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            <textarea name="yiyemedigi_yiyecek_aciklama" id="yiyemedigi_yiyecek_aciklama" class="form-control mt-2 @error('yiyemedigi_yiyecek_aciklama') is-invalid @enderror" placeholder="Varsa açıklayınız...">{{ old('yiyemedigi_yiyecek_aciklama') }}</textarea>
            @error('yiyemedigi_yiyecek_aciklama')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <label class="fw-bold">Evde alınan besin grupları:</label><br>
            @foreach (MedicalFormOptions::foodGroupOptions() as $i => $option)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="alinan_besin_gruplari[]" id="besin_{{ $i }}" value="{{ $option }}" class="form-check-input @error('alinan_besin_gruplari') is-invalid @enderror" @checked(in_array($option, old('alinan_besin_gruplari', []), true))>
                    <label class="form-check-label" for="besin_{{ $i }}">{{ $option }}</label>
                </div>
            @endforeach
            @error('alinan_besin_gruplari')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>
        <div class="mt-3">
            <label for="bebek_beslenmesi" class="form-label">Bebeğinizi nasıl besliyorsunuz?</label>
            <select name="bebek_beslenmesi" id="bebek_beslenmesi" class="form-select @error('bebek_beslenmesi') is-invalid @enderror">
                <option value="">Seçiniz</option>
                <option value="Emzirme" @selected(old('bebek_beslenmesi') === 'Emzirme')>Emzirme</option>
                <option value="Ticari mama" @selected(old('bebek_beslenmesi') === 'Ticari mama')>Ticari mama</option>
                <option value="Süt" @selected(old('bebek_beslenmesi') === 'Süt')>Süt</option>
                <option value="Diğer" @selected(old('bebek_beslenmesi') === 'Diğer')>Diğer</option>
            </select>
            @error('bebek_beslenmesi')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>
