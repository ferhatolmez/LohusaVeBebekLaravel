@extends('layouts.app')

@section('title', 'Lohusa Kayıtları')

@section('content')
<div class="container">
    <section class="d-flex flex-column flex-lg-row justify-content-between gap-3 align-items-lg-center mb-4">
        <div>
            <span class="badge-soft mb-2">Lohusa takip listesi</span>
            <h1 class="h2 mb-1">Lohusa kayıtları</h1>
            <p class="text-secondary mb-0">Arama, takip filtreleri ve yaklaşan kontroller tek ekranda.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('lohusa.create') }}" class="btn btn-primary">Yeni kayıt</a>
            <a href="{{ route('home') }}" class="btn btn-outline-primary">Ana panel</a>
        </div>
    </section>

    @if (session('success'))
        <div class="alert alert-success glass-panel border-0">{{ session('success') }}</div>
    @endif

    <div class="card table-card">
        <div class="card-body p-3 p-lg-4">
            <form method="GET" class="row g-3 align-items-end mb-4">
                <div class="col-lg-4">
                    <label for="q" class="form-label">Kayıt ara</label>
                    <input type="text" id="q" name="q" class="form-control" placeholder="Ad soyad, doğum yeri veya meslek" value="{{ request('q') }}">
                </div>
                <div class="col-lg-2">
                    <label for="dogum_yeri" class="form-label">Doğum yeri</label>
                    <select id="dogum_yeri" name="dogum_yeri" class="form-select">
                        <option value="">Tümleri</option>
                        @foreach ($filterOptions['dogumYerleri'] as $dogumYeri)
                            <option value="{{ $dogumYeri }}" @selected(request('dogum_yeri') === $dogumYeri)>{{ $dogumYeri }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="bebek_beslenmesi" class="form-label">Beslenme</label>
                    <select id="bebek_beslenmesi" name="bebek_beslenmesi" class="form-select">
                        <option value="">Tümleri</option>
                        @foreach ($filterOptions['bebekBeslenmeSekilleri'] as $beslenme)
                            <option value="{{ $beslenme }}" @selected(request('bebek_beslenmesi') === $beslenme)>{{ $beslenme }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="postpartum_hafta_min" class="form-label">Min. hafta</label>
                    <input type="number" id="postpartum_hafta_min" name="postpartum_hafta_min" min="0" max="8" class="form-control" value="{{ request('postpartum_hafta_min') }}">
                </div>
                <div class="col-lg-2">
                    <label for="created_from" class="form-label">Başlangıç</label>
                    <input type="date" id="created_from" name="created_from" class="form-control" value="{{ request('created_from') }}">
                </div>
                <div class="col-lg-2">
                    <label for="created_to" class="form-label">Bitiş</label>
                    <input type="date" id="created_to" name="created_to" class="form-control" value="{{ request('created_to') }}">
                </div>
                <div class="col-lg-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">Filtrele</button>
                    <a href="{{ route('lohusa.index') }}" class="btn btn-outline-primary">Sıfırla</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Danışan</th>
                            <th>Tarih</th>
                            <th>Takip</th>
                            <th>Kalite</th>
                            <th class="text-end">Islemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($forms as $form)
                            <tr>
                                <td>#{{ $form->id }}</td>
                                <td>
                                    <div class="fw-bold">{{ $form->ad_soyad }}</div>
                                    <div class="text-secondary small">Yaş: {{ $form->yas ?? '-' }} | Doğum yeri: {{ $form->dogum_yeri ?? '-' }}</div>
                                </td>
                                <td>{{ $form->created_at->format('d.m.Y') }}</td>
                                <td>
                                    @if ($form->suggested_follow_up_date)
                                        <div class="fw-semibold">{{ $form->suggested_follow_up_label }}</div>
                                        <span class="badge text-bg-{{ $form->follow_up_tone }}">{{ $form->suggested_follow_up_date->format('d.m.Y') }}</span>
                                    @else
                                        <span class="text-secondary small">Takip hedefi yok</span>
                                    @endif
                                </td>
                                <td><span class="badge text-bg-{{ $form->completion_tone }}">%{{ $form->completion_score }}</span></td>
                                <td>
                                    <div class="d-flex justify-content-end flex-wrap gap-2">
                                        <a href="{{ route('lohusa.show', $form) }}" class="btn btn-sm btn-outline-primary">Detay</a>
                                        <a href="{{ route('lohusa.pdf', $form->id) }}" class="btn btn-sm btn-outline-secondary">PDF</a>
                                        <form action="{{ route('lohusa.destroy', $form->id) }}" method="POST" onsubmit="return confirm('Bu kaydı silmek istiyor musunuz?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Sil</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-secondary py-5">Henüz lohusa kaydı bulunmuyor.</td>
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




