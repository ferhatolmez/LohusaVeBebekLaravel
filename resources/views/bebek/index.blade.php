@extends('layouts.app')

@section('title', 'Bebek Kayitlari')

@section('content')
<div class="container">
    <section class="d-flex flex-column flex-lg-row justify-content-between gap-3 align-items-lg-center mb-4">
        <div>
            <span class="badge-soft mb-2">Bebek workflow</span>
            <h1 class="h2 mb-1">Bebek kayitlari</h1>
            <p class="text-secondary mb-0">Temel filtreler, kayit kalite skoru ve hizli aksiyonlar.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('bebek.create') }}" class="btn btn-primary">Yeni kayit</a>
            <a href="{{ route('home') }}" class="btn btn-outline-primary">Dashboard</a>
        </div>
    </section>

    @if (session('success'))
        <div class="alert alert-success glass-panel border-0">{{ session('success') }}</div>
    @endif

    <div class="card table-card">
        <div class="card-body p-3 p-lg-4">
            <form method="GET" class="row g-3 align-items-end mb-4">
                <div class="col-lg-6">
                    <label for="q" class="form-label">Metin filtrele</label>
                    <input type="text" id="q" name="q" class="form-control" placeholder="Cinsiyet, termin veya haftalik bilgi" value="{{ request('q') }}">
                </div>
                <div class="col-lg-3">
                    <label for="cinsiyet" class="form-label">Cinsiyet</label>
                    <select id="cinsiyet" name="cinsiyet" class="form-select">
                        <option value="">Tum cinsiyetler</option>
                        <option value="Erkek" @selected(request('cinsiyet') === 'Erkek')>Erkek</option>
                        <option value="Kiz" @selected(request('cinsiyet') === 'Kiz')>Kiz</option>
                    </select>
                </div>
                <div class="col-lg-3">
                    <button type="submit" class="btn btn-primary w-100">Filtrele</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Dogum tarihi</th>
                            <th>Cinsiyet</th>
                            <th>Izlem</th>
                            <th>Kalite</th>
                            <th class="text-end">Islemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($forms as $form)
                            <tr>
                                <td>#{{ $form->id }}</td>
                                <td>{{ optional($form->dogum_tarihi)->format('d.m.Y') ?? '-' }}</td>
                                <td>{{ $form->cinsiyet ?? '-' }}</td>
                                <td>{{ $form->izlem_sayisi ?? '-' }}</td>
                                <td><span class="badge text-bg-{{ $form->completion_tone }}">%{{ $form->completion_score }}</span></td>
                                <td>
                                    <div class="d-flex justify-content-end flex-wrap gap-2">
                                        <a href="{{ route('bebek.show', $form) }}" class="btn btn-sm btn-outline-primary">Detay</a>
                                        <a href="{{ route('bebek.edit', $form) }}" class="btn btn-sm btn-outline-secondary">Duzenle</a>
                                        <a href="{{ route('bebek.pdf', $form->id) }}" class="btn btn-sm btn-outline-secondary">PDF</a>
                                        <form action="{{ route('bebek.destroy', $form) }}" method="POST" onsubmit="return confirm('Bu kaydi silmek istiyor musunuz?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Sil</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-secondary py-5">Henuz bebek kaydi bulunmuyor.</td>
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
