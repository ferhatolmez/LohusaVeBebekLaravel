@extends('layouts.app')

@section('title', 'Bebek kayitlari')

@section('content')
<div class="container">
    <section class="d-flex flex-column flex-lg-row justify-content-between gap-3 align-items-lg-center mb-4">
        <div>
            <span class="badge-soft mb-2">Bebek takip listesi</span>
            <h1 class="h2 mb-1">Bebek kayitlari</h1>
            <p class="text-secondary mb-0">Klinik filtreler, izlem seviyesi ve bir sonraki kontrol görünürlüğü eklendi.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('bebek.create') }}" class="btn btn-primary">Yeni kayıt</a>
            <a href="{{ route('home') }}" class="btn btn-outline-primary">Ana panel</a>
        </div>
    </section>

    @if (session('success'))
        <div class="alert alert-success glass-panel border-0">{{ session('success') }}</div>
    @endif

    <div class="card table-card">
        <div class="card-body p-3 p-lg-4">
            <form method="GET" class="row g-3 align-items-end mb-4">
                <div class="col-lg-3">
                    <label for="q" class="form-label">Metin filtrele</label>
                    <input type="text" id="q" name="q" class="form-control" placeholder="Cinsiyet, termin, hafta veya kan grubu" value="{{ request('q') }}">
                </div>
                <div class="col-lg-2">
                    <label for="cinsiyet" class="form-label">Cinsiyet</label>
                    <select id="cinsiyet" name="cinsiyet" class="form-select">
                        <option value="">Tüm cinsiyetler</option>
                        <option value="Erkek" @selected(request('cinsiyet') === 'Erkek')>Erkek</option>
                        <option value="Kız" @selected(request('cinsiyet') === 'Kız')>Kız</option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="termin_durumu" class="form-label">Termin</label>
                    <select id="termin_durumu" name="termin_durumu" class="form-select">
                        <option value="">Tüm terminler</option>
                        <option value="Term" @selected(request('termin_durumu') === 'Term')>Term</option>
                        <option value="Prematür" @selected(request('termin_durumu') === 'Prematür')>Prematür</option>
                        <option value="Postmatür" @selected(request('termin_durumu') === 'Postmatür')>Postmatür</option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="izlem_min" class="form-label">Min. izlem</label>
                    <input type="number" id="izlem_min" name="izlem_min" min="1" max="20" class="form-control" value="{{ request('izlem_min') }}">
                </div>
                <div class="col-lg-1">
                    <label for="muayene_from" class="form-label">Başlangıç</label>
                    <input type="date" id="muayene_from" name="muayene_from" class="form-control" value="{{ request('muayene_from') }}">
                </div>
                <div class="col-lg-1">
                    <label for="muayene_to" class="form-label">Bitiş</label>
                    <input type="date" id="muayene_to" name="muayene_to" class="form-control" value="{{ request('muayene_to') }}">
                </div>
                <div class="col-lg-1 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">Filtrele</button>
                </div>
                <div class="col-lg-12">
                    <a href="{{ route('bebek.index') }}" class="btn btn-outline-primary">Filtreleri sıfırla</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Doğum tarihi</th>
                            <th>Cinsiyet</th>
                            <th>İzlem</th>
                            <th>Sonraki kontrol</th>
                            <th>Kalite</th>
                            <th class="text-end">Islemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($forms as $form)
                            <tr>
                                <td>#{{ $form->id }}</td>
                                <td>{{ optional($form->dogum_tarihi)->format('d.m.Y') ?? '-' }}</td>
                                <td>
                                    <div>{{ $form->cinsiyet ?? '-' }}</div>
                                    <div class="text-secondary small">{{ $form->termin_durumu ?? 'Termin yok' }}</div>
                                </td>
                                <td>{{ $form->izlem_sayisi ?? '-' }}</td>
                                <td>
                                    @if ($form->suggested_follow_up_date)
                                        <span class="badge text-bg-{{ $form->follow_up_tone }}">{{ $form->suggested_follow_up_date->format('d.m.Y') }}</span>
                                    @else
                                        <span class="text-secondary small">Hesaplanamadı</span>
                                    @endif
                                </td>
                                <td><span class="badge text-bg-{{ $form->completion_tone }}">%{{ $form->completion_score }}</span></td>
                                <td>
                                    <div class="d-flex justify-content-end flex-wrap gap-2">
                                        <a href="{{ route('bebek.show', $form) }}" class="btn btn-sm btn-outline-primary">Detay</a>
                                        <a href="{{ route('bebek.edit', $form) }}" class="btn btn-sm btn-outline-secondary">Düzenle</a>
                                        <a href="{{ route('bebek.pdf', $form->id) }}" class="btn btn-sm btn-outline-secondary">PDF</a>
                                        <form action="{{ route('bebek.destroy', $form) }}" method="POST" onsubmit="return confirm('Bu kaydı silmek istiyor musunuz?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Sil</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-secondary py-5">Henüz bebek kaydı bulunmuyor.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $forms->links() }}</div>
        </div>
    </div>
</div>
@endsection



