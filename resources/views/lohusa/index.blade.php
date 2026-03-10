@extends('layouts.app')

@section('title', 'Lohusa Kayitlari')

@section('content')
<div class="container">
    <section class="d-flex flex-column flex-lg-row justify-content-between gap-3 align-items-lg-center mb-4">
        <div>
            <span class="badge-soft mb-2">Lohusa workflow</span>
            <h1 class="h2 mb-1">Lohusa kayitlari</h1>
            <p class="text-secondary mb-0">Arama, kalite takibi ve PDF export tek ekranda.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('lohusa.create') }}" class="btn btn-primary">Yeni kayit</a>
            <a href="{{ route('home') }}" class="btn btn-outline-primary">Dashboard</a>
        </div>
    </section>

    @if (session('success'))
        <div class="alert alert-success glass-panel border-0">{{ session('success') }}</div>
    @endif

    <div class="card table-card">
        <div class="card-body p-3 p-lg-4">
            <form method="GET" class="row g-3 align-items-end mb-4">
                <div class="col-lg-9">
                    <label for="q" class="form-label">Kayit ara</label>
                    <input type="text" id="q" name="q" class="form-control" placeholder="Ad soyada gore arayin" value="{{ request('q') }}">
                </div>
                <div class="col-lg-3">
                    <button type="submit" class="btn btn-primary w-100">Ara</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Danisan</th>
                            <th>Tarih</th>
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
                                    <div class="text-secondary small">Yas: {{ $form->yas ?? '-' }}</div>
                                </td>
                                <td>{{ $form->created_at->format('d.m.Y') }}</td>
                                <td><span class="badge text-bg-{{ $form->completion_tone }}">%{{ $form->completion_score }}</span></td>
                                <td>
                                    <div class="d-flex justify-content-end flex-wrap gap-2">
                                        <a href="{{ route('lohusa.show', $form) }}" class="btn btn-sm btn-outline-primary">Detay</a>
                                        <a href="{{ route('lohusa.pdf', $form->id) }}" class="btn btn-sm btn-outline-secondary">PDF</a>
                                        <form action="{{ route('lohusa.destroy', $form->id) }}" method="POST" onsubmit="return confirm('Bu kaydi silmek istiyor musunuz?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Sil</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-secondary py-5">Henuz lohusa kaydi bulunmuyor.</td>
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
