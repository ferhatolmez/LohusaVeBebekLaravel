@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h2 class="mb-0">🧒 Bebek İzlem Formları</h2>
            <div>
                <a href="{{ route('bebek.create') }}" class="btn btn-light btn-sm me-2">➕ Yeni Form</a>
                <a href="{{ url('/') }}" class="btn btn-light btn-sm">🏠 Ana Sayfa</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form method="GET" class="row mb-3 g-2">
                <div class="col-md-6">
                    <input type="text" name="q" class="form-control" placeholder="Cinsiyet, termin veya haftalık ara..." value="{{ request('q') }}">
                </div>
                <div class="col-md-3">
                    <select name="cinsiyet" class="form-select">
                        <option value="">Tüm Cinsiyetler</option>
                        <option value="Erkek" {{ request('cinsiyet') == 'Erkek' ? 'selected' : '' }}>Erkek</option>
                        <option value="Kız" {{ request('cinsiyet') == 'Kız' ? 'selected' : '' }}>Kız</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-outline-success w-100">🔍 Filtrele</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover table-striped border">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Doğum Tarihi</th>
                            <th>Cinsiyet</th>
                            <th>Kaçıncı Çocuk</th>
                            <th class="text-center">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($forms as $form)
                            <tr>
                                <td>{{ $form->id }}</td>
                                <td>{{ $form->dogum_tarihi?->format('d.m.Y') }}</td>
                                <td>{{ $form->cinsiyet }}</td>
                                <td>{{ $form->kacinci_cocuk }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                                        <a href="{{ route('bebek.show', $form) }}" class="btn btn-info btn-sm">🔍 Detay</a>
                                        <a href="{{ route('bebek.edit', $form) }}" class="btn btn-warning btn-sm">✏️ Düzenle</a>
                                        <form action="{{ route('bebek.destroy', $form) }}" method="POST" onsubmit="return confirm('Silmek istediğinize emin misiniz?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">🗑️ Sil</button>
                                        </form>
                                        <a href="{{ route('bebek.pdf', $form->id) }}" class="btn btn-outline-primary btn-sm" target="_blank">🖨️ PDF</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Henüz bebek formu bulunmuyor.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $forms->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

