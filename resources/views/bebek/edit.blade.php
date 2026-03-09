@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">✏️ Bebek İzlem Formu Düzenle</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('bebek.update', $bebekForm) }}">
        @csrf
        @method('PUT')

        {{-- Temel Bilgiler --}}
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">👶 Temel Bilgiler</div>
            <div class="card-body row g-3">
                <div class="col-md-3">
                    <label>Doğum Tarihi</label>
                    <input type="date" name="dogum_tarihi" class="form-control" value="{{ old('dogum_tarihi', $bebekForm->dogum_tarihi?->format('Y-m-d')) }}">
                </div>
                <div class="col-md-3">
                    <label>Kaç Haftalık</label>
                    <input type="text" name="kac_haftalik" class="form-control" value="{{ old('kac_haftalik', $bebekForm->kac_haftalik) }}">
                </div>
                <div class="col-md-3">
                    <label>Muayene Tarihi</label>
                    <input type="date" name="muayene_tarihi" class="form-control" value="{{ old('muayene_tarihi', $bebekForm->muayene_tarihi?->format('Y-m-d')) }}">
                </div>
                <div class="col-md-3">
                    <label>İzlem Sayısı</label>
                    <input type="number" name="izlem_sayisi" class="form-control" value="{{ old('izlem_sayisi', $bebekForm->izlem_sayisi) }}">
                </div>
                <div class="col-md-3">
                    <label>Termin Durumu</label>
                    <select name="termin_durumu" class="form-control">
                        @foreach(['Term', 'Prematür', 'Postmatür'] as $opt)
                            <option value="{{ $opt }}" {{ old('termin_durumu', $bebekForm->termin_durumu) == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Cinsiyet</label>
                    <select name="cinsiyet" class="form-control">
                        @foreach(['Erkek', 'Kız'] as $opt)
                            <option value="{{ $opt }}" {{ old('cinsiyet', $bebekForm->cinsiyet) == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Kaçıncı Çocuk</label>
                    <input type="number" name="kacinci_cocuk" class="form-control" value="{{ old('kacinci_cocuk', $bebekForm->kacinci_cocuk) }}">
                </div>
                <div class="col-md-3">
                    <label>Kan Grubu</label>
                    <select name="kan_grubu" class="form-control">
                        <option value="">Seçiniz</option>
                        @foreach(['A Rh+', 'A Rh-', 'B Rh+', 'B Rh-', 'AB Rh+', 'AB Rh-', '0 Rh+', '0 Rh-'] as $opt)
                            <option value="{{ $opt }}" {{ old('kan_grubu', $bebekForm->kan_grubu) == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- Vital Bulgular --}}
        <div class="card shadow mb-4">
            <div class="card-header bg-success text-white">💓 Vital Bulgular</div>
            <div class="card-body row g-3">
                <div class="col-md-2"><label>Ateş (°C)</label><input type="number" step="0.1" name="ates" class="form-control" value="{{ old('ates', $bebekForm->ates) }}"></div>
                <div class="col-md-2"><label>Nabız</label><input type="number" name="nabiz" class="form-control" value="{{ old('nabiz', $bebekForm->nabiz) }}"></div>
                <div class="col-md-2"><label>Solunum</label><input type="number" name="solunum" class="form-control" value="{{ old('solunum', $bebekForm->solunum) }}"></div>
                <div class="col-md-2"><label>Kilo (kg)</label><input type="number" step="0.01" name="kilo" class="form-control" value="{{ old('kilo', $bebekForm->kilo) }}"></div>
                <div class="col-md-2"><label>Boy (cm)</label><input type="number" step="0.01" name="boy" class="form-control" value="{{ old('boy', $bebekForm->boy) }}"></div>
                <div class="col-md-2"><label>Baş Çevresi (cm)</label><input type="number" step="0.01" name="bas_cevresi" class="form-control" value="{{ old('bas_cevresi', $bebekForm->bas_cevresi) }}"></div>
                <div class="col-md-2"><label>Göğüs Çevresi (cm)</label><input type="number" step="0.01" name="gogus_cevresi" class="form-control" value="{{ old('gogus_cevresi', $bebekForm->gogus_cevresi) }}"></div>
            </div>
        </div>

        {{-- Gözlem Alanları --}}
        @php
            $kategoriler = [
                'deri' => '🩸 Deri', 'bas' => '🧠 Baş', 'gozler' => '👁️ Gözler', 'burun' => '👃 Burun', 'agiz' => '👄 Ağız',
                'kulak' => '👂 Kulak', 'boyun' => '🧍‍♂️ Boyun', 'gogus' => '🫁 Göğüs', 'abdomen' => '🩻 Abdomen',
                'kasik' => '🦵 Kasık', 'genital' => '🍑 Genital', 'solunum_sistemi' => '🌬️ Solunum Sistemi',
                'kvs' => '❤️ Kardiyovasküler Sistem', 'gis' => '🍽️ Gastrointestinal Sistem',
                'uriner' => '💧 Üriner Sistem', 'kas_iskelet' => '🦴 Kas-İskelet Sistemi', 'norolojik' => '🧠 Nörolojik Sistem'
            ];
            $secenekler = [
                'deri' => ['Pembe,gergin,pürüzsüz', 'İşilik','Pişik', 'Sarılık', 'Siyanoz', 'Diğer'],
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
                'solunum_sistemi' => ['Solunum sıkıntısı', 'Siyanoz', 'Apne', 'Pnomoni', 'Diğer'],
                'kvs' => ['Taşikardi', 'Bradikardi', 'Siyanoz', 'Diğer'],
                'gis' => ['Gaita yapma sıklığı','Kusma', 'Konstipasyon', 'Diare', 'Dehidratasyon', 'Diğer'],
                'uriner' => ['İdrar yapma sıklığı','İdrar yaparken zorluk,sınıtı,ağlama', 'İdrar renginde değişiklik','İdrarın damla damla yapılması', 'Diğer'],
                'kas_iskelet' => ['DKÇ', 'Ekstremite anomalisi', 'Diğer'],
                'norolojik' => ['Konvülsiyon', 'Diğer']
            ];
        @endphp

        @foreach ($kategoriler as $alan => $baslik)
            <div class="card shadow mb-4">
                <div class="card-header bg-secondary text-white">{{ $baslik }}</div>
                <div class="card-body">
                    @php $mevcut = old($alan, $bebekForm->$alan ?? []); $mevcut = is_array($mevcut) ? $mevcut : []; @endphp
                    @foreach ($secenekler[$alan] as $opt)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="{{ $alan }}[]" value="{{ $opt }}" class="form-check-input" {{ in_array($opt, $mevcut) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $opt }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success btn-lg">✅ Güncelle</button>
            <a href="{{ route('bebek.index') }}" class="btn btn-secondary btn-lg">İptal</a>
        </div>
    </form>
</div>
@endsection
