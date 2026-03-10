@extends('layouts.app')

@section('content')
@php
    $defaults = $clinicalDefaults['bebek'];
@endphp
<div class="container py-4 form-page-bebek">
    <div class="form-header mb-4">
        <h1 class="h3 mb-1 fw-600">🍼 Bebek İzlem Formu (Evde)</h1>
        <p class="text-muted mb-0">Bebek bilgilerini tek sayfada, rahatça doldurun.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger rounded-3 shadow-sm">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="bebekForm" method="POST" action="{{ route('bebek.store') }}">
        @csrf

        {{-- Temel Bilgiler --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">👶 Temel Bilgiler</div>
            <div class="card-body">
                <p class="text-muted small mb-4">Doğum ve izlem ile ilgili temel bilgileri girin.</p>
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="dogum_tarihi" class="form-label">Doğum Tarihi</label>
                        <input type="date" name="dogum_tarihi" id="dogum_tarihi" class="form-control form-control-lg" value="{{ old('dogum_tarihi') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="kac_haftalik" class="form-label">Kaç Haftalık</label>
                        <input type="text" name="kac_haftalik" id="kac_haftalik" class="form-control form-control-lg" value="{{ old('kac_haftalik', $defaults['kac_haftalik']) }}" placeholder="Örn: 40">
                    </div>
                    <div class="col-md-3">
                        <label for="muayene_tarihi" class="form-label">Muayene Tarihi</label>
                        <input type="date" name="muayene_tarihi" id="muayene_tarihi" class="form-control form-control-lg" value="{{ old('muayene_tarihi', now()->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-3">
                        <label for="izlem_sayisi" class="form-label">İzlem Sayısı</label>
                        <input type="number" name="izlem_sayisi" id="izlem_sayisi" class="form-control form-control-lg" value="{{ old('izlem_sayisi', $defaults['izlem_sayisi']) }}" placeholder="0" min="0">
                    </div>
                    <div class="col-md-3">
                        <label for="termin_durumu" class="form-label">Termin Durumu</label>
                        <select name="termin_durumu" id="termin_durumu" class="form-select form-select-lg">
                            <option value="Term" {{ old('termin_durumu') == 'Term' ? 'selected' : '' }}>Term</option>
                            <option value="Prematür" {{ old('termin_durumu') == 'Prematür' ? 'selected' : '' }}>Prematür</option>
                            <option value="Postmatür" {{ old('termin_durumu') == 'Postmatür' ? 'selected' : '' }}>Postmatür</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="cinsiyet" class="form-label">Cinsiyet</label>
                        <select name="cinsiyet" id="cinsiyet" class="form-select form-select-lg">
                            <option value="Erkek" {{ old('cinsiyet') == 'Erkek' ? 'selected' : '' }}>Erkek</option>
                            <option value="Kız" {{ old('cinsiyet') == 'Kız' ? 'selected' : '' }}>Kız</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="kacinci_cocuk" class="form-label">Kaçıncı Çocuk</label>
                        <input type="number" name="kacinci_cocuk" id="kacinci_cocuk" class="form-control form-control-lg" value="{{ old('kacinci_cocuk') }}" placeholder="1" min="1">
                    </div>
                    <div class="col-md-3">
                        <label for="kan_grubu" class="form-label">Kan Grubu</label>
                        <select name="kan_grubu" id="kan_grubu" class="form-select form-select-lg">
                            <option value="">Seçiniz</option>
                            @foreach(['A Rh+','A Rh-','B Rh+','B Rh-','AB Rh+','AB Rh-','0 Rh+','0 Rh-'] as $g)
                                <option value="{{ $g }}" {{ old('kan_grubu') == $g ? 'selected' : '' }}>{{ $g }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- Vital Bulgular --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">💓 Vital Bulgular</div>
            <div class="card-body">
                <p class="text-muted small mb-4">Olcum degerleri tipik yenidogan ortalamalariyla gelir; muayene sonucuna gore degistirebilirsiniz.</p>
                <div class="row g-3">
                    <div class="col-6 col-md-2">
                        <label for="ates" class="form-label">Ateş (°C)</label>
                        <input type="number" step="0.1" name="ates" id="ates" class="form-control form-control-lg" value="{{ old('ates', $defaults['ates']) }}" placeholder="36.5">
                    </div>
                    <div class="col-6 col-md-2">
                        <label for="nabiz" class="form-label">Nabız</label>
                        <input type="number" name="nabiz" id="nabiz" class="form-control form-control-lg" value="{{ old('nabiz', $defaults['nabiz']) }}" placeholder="120">
                    </div>
                    <div class="col-6 col-md-2">
                        <label for="solunum" class="form-label">Solunum</label>
                        <input type="number" name="solunum" id="solunum" class="form-control form-control-lg" value="{{ old('solunum', $defaults['solunum']) }}" placeholder="40">
                    </div>
                    <div class="col-6 col-md-2">
                        <label for="kilo" class="form-label">Kilo (kg)</label>
                        <input type="number" step="0.01" name="kilo" id="kilo" class="form-control form-control-lg" value="{{ old('kilo', $defaults['kilo']) }}" placeholder="3.2">
                    </div>
                    <div class="col-6 col-md-2">
                        <label for="boy" class="form-label">Boy (cm)</label>
                        <input type="number" step="0.01" name="boy" id="boy" class="form-control form-control-lg" value="{{ old('boy', $defaults['boy']) }}" placeholder="50">
                    </div>
                    <div class="col-6 col-md-2">
                        <label for="bas_cevresi" class="form-label">Baş Çevresi (cm)</label>
                        <input type="number" step="0.01" name="bas_cevresi" id="bas_cevresi" class="form-control form-control-lg" value="{{ old('bas_cevresi', $defaults['bas_cevresi']) }}" placeholder="34">
                    </div>
                    <div class="col-6 col-md-2">
                        <label for="gogus_cevresi" class="form-label">Göğüs Çevresi (cm)</label>
                        <input type="number" step="0.01" name="gogus_cevresi" id="gogus_cevresi" class="form-control form-control-lg" value="{{ old('gogus_cevresi', $defaults['gogus_cevresi']) }}" placeholder="32">
                    </div>
                </div>
            </div>
        </div>

        {{-- Gözlem Alanları --}}
        @php
            $kategoriler = [
                'deri' => '🩸 Deri',
                'bas' => '🧠 Baş',
                'gozler' => '👁️ Gözler',
                'burun' => '👃 Burun',
                'agiz' => '👄 Ağız',
                'kulak' => '👂 Kulak',
                'boyun' => '🧍‍♂️ Boyun',
                'gogus' => '🫁 Göğüs',
                'abdomen' => '🩻 Abdomen',
                'kasik' => '🦵 Kasık',
                'genital' => '🍑 Genital',
                'solunum_sistemi' => '🌬️ Solunum Sistemi',
                'kvs' => '❤️ Kardiyovasküler Sistem',
                'gis' => '🍽️ Gastrointestinal Sistem',
                'uriner' => '💧 Üriner Sistem',
                'kas_iskelet' => '🦴 Kas-İskelet Sistemi',
                'norolojik' => '🧠 Nörolojik Sistem'
            ];
            $secenekler = [
                'deri' => ['Pembe, gergin, pürüzsüz', 'İsilik', 'Pişik', 'Sarılık', 'Siyanoz', 'Diğer'],
                'bas' => ['Fontaneller de açıklık', 'Konak', 'Bit', 'Sefal hematom', 'Diğer'],
                'gozler' => ['Çapaklanma', 'Kızarıklık', 'İltihaplanma','Akıntı', 'Şaşılık','Ödem','Sulanma', 'Diğer'],
                'burun' => ['Akıntı', 'Tıkanıklık', 'Burun kanallarının solunuma katılması', 'Diğer'],
                'agiz' => ['Pamukçuk', 'Yarık damak', 'Yarık dudak', 'Diğer'],
                'kulak' => ['Ağrı','Akıntı', 'Düşük kulak', 'Diğer'],
                'boyun' => ['Şişlik', 'Tortikolis', 'Diğer'],
                'gogus' => ['Şişlik', 'Süt akması', 'Diğer'],
                'abdomen' => ['Kanama', 'Akıntı','Kızarıklık','Isı artışı','Göbek granülomu', 'Distansiyon', 'Göbek fıtığı', 'Diğer'],
                'kasik' => ['Kasık fıtığı', 'Diğer'],
                'genital' => ['Fimozis', 'İnmemiş testis', 'Hipospadias', 'Epispadias','Anuste açıklık','Vajinal akıntı', 'Diğer'],
                'solunum_sistemi' => ['Solunum sıkıntısı', 'Siyanoz', 'Apne', 'Pnömoni', 'Diğer'],
                'kvs' => ['Taşikardi', 'Bradikardi', 'Siyanoz', 'Diğer'],
                'gis' => ['Gaita yapma sıklığı','Kusma', 'Konstipasyon', 'Diare', 'Dehidratasyon', 'Diğer'],
                'uriner' => ['İdrar yapma sıklığı','İdrar yaparken zorluk,sınıtı,ağlama', 'İdrar renginde değişiklik','İdrarın damla damla yapılması', 'Diğer'],
                'kas_iskelet' => ['DKÇ', 'Ekstremite anomalisi', 'Diğer'],
                'norolojik' => ['Konvülsiyon', 'Diğer']
            ];
        @endphp

        @foreach ($kategoriler as $alan => $baslik)
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-secondary text-white">{{ $baslik }}</div>
                <div class="card-body">
                    <p class="text-muted small mb-3">Varsa ilgili bulguları işaretleyin.</p>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($secenekler[$alan] as $idx => $opt)
                            <div class="form-check form-check-inline form-check-card">
                                <input type="checkbox" name="{{ $alan }}[]" value="{{ $opt }}" id="cb_{{ $alan }}_{{ $idx }}" class="form-check-input" {{ is_array(old($alan)) && in_array($opt, old($alan)) ? 'checked' : '' }}>
                                <label class="form-check-label" for="cb_{{ $alan }}_{{ $idx }}">{{ $opt }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach

        <div class="form-actions mt-4 pt-4 border-top">
            <button type="submit" class="btn btn-success btn-lg px-5 w-100 w-md-auto">✅ Kaydet</button>
        </div>
    </form>
</div>

<style>
    .form-page-bebek .form-header { max-width: 720px; }
    .form-page-bebek .card { border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; }
    .form-page-bebek .card-header { padding: 1rem 1.25rem; font-size: 1rem; }
    .form-page-bebek .card-body { padding: 1.25rem 1.5rem; }
    .form-page-bebek .form-label { font-weight: 500; color: #475569; margin-bottom: 0.35rem; }
    .form-page-bebek .form-control, .form-page-bebek .form-select { border-radius: 8px; padding: 0.5rem 0.75rem; border: 1px solid #e2e8f0; }
    .form-page-bebek .form-control:focus, .form-page-bebek .form-select:focus { border-color: #0d9488; box-shadow: 0 0 0 3px rgba(13,148,136,0.15); }
    .form-page-bebek .form-check-card { padding: 0.5rem 0.75rem; border-radius: 8px; transition: background 0.2s; margin: 0; }
    .form-page-bebek .form-check-card:hover { background: #f1f5f9; }
    .form-page-bebek .form-check-input:checked + .form-check-label { font-weight: 500; }
    .form-page-bebek .form-actions { background: linear-gradient(to top, #f8fafc, transparent); padding: 1.25rem 0; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('bebekForm');
    if (!form) return;
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        fetch('{{ route("lohusa.csrf-refresh") }}', { credentials: 'same-origin' })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                var tokenInput = form.querySelector('input[name="_token"]');
                if (tokenInput && data.token) tokenInput.value = data.token;
                form.submit();
            })
            .catch(function () { form.submit(); });
    });
});
</script>
@endsection
