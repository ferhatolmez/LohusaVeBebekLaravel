@extends('layouts.app')

@section('title', 'Bebek Kayıtları')

@section('content')
@php
    $activeFilters = array_filter([
        'Arama: ' . request('q') => filled(request('q')),
        'Cinsiyet: ' . request('cinsiyet') => filled(request('cinsiyet')),
        'Termin: ' . request('termin_durumu') => filled(request('termin_durumu')),
        'Min. izlem: ' . request('izlem_min') => filled(request('izlem_min')),
        'Başlangıç: ' . request('muayene_from') => filled(request('muayene_from')),
        'Bitiş: ' . request('muayene_to') => filled(request('muayene_to')),
    ]);
@endphp
<div class="container">
    <section class="page-header">
        <div class="page-header-row">
            <div>
                <span class="badge-soft mb-2"><i data-lucide="baby" style="width:14px;height:14px"></i> Bebek takip listesi</span>
                <h1 class="h2 mb-2">Bebek kayıtları</h1>
                <p class="text-secondary mb-0">Aktif seçimler üstte görünür, tablo mobilde kart benzeri akışla okunabilir.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                @can('create', App\Models\BebekForm::class)
                    <a href="{{ route('bebek.create') }}" class="btn btn-primary d-flex align-items-center gap-2"><i data-lucide="plus" style="width:16px;height:16px"></i> Yeni kayıt</a>
                @endcan
                <a href="{{ route('home') }}" class="btn btn-outline-primary d-flex align-items-center gap-2"><i data-lucide="layout-dashboard" style="width:16px;height:16px"></i> Ana panel</a>
            </div>
        </div>

        <div class="status-strip">
            <div class="status-chip">
                <strong>{{ $forms->total() }}</strong>
                <span>Toplam sonuç</span>
            </div>
            <div class="status-chip">
                <strong>{{ count($activeFilters) }}</strong>
                <span>Aktif filtre</span>
            </div>
            <div class="status-chip">
                <strong>{{ $forms->firstItem() ?? 0 }}-{{ $forms->lastItem() ?? 0 }}</strong>
                <span>Gösterilen aralık</span>
            </div>
        </div>
    </section>

    @if (session('success'))
        <div class="alert alert-success glass-panel border-0">{{ session('success') }}</div>
    @endif

    <div class="card table-card mb-4">
        <div class="filter-panel">
            <div class="filter-toolbar">
                <div>
                    <h2 class="h5 mb-1 d-flex align-items-center gap-2"><i data-lucide="filter" style="width:18px;height:18px;color:var(--brand-700)"></i> Filtreler</h2>
                    <p class="text-secondary mb-0">İzlem, termin ve muayene tarihi kombinasyonlarını daraltın.</p>
                </div>
                <div class="text-secondary small">{{ $forms->total() }} kayıt bulundu</div>
            </div>

            <form method="GET" class="row g-3 align-items-end">
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
                <div class="col-lg-12 d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-primary d-flex align-items-center gap-2"><i data-lucide="search" style="width:15px;height:15px"></i> Filtrele</button>
                    <a href="{{ route('bebek.index') }}" class="btn btn-outline-primary d-flex align-items-center gap-2"><i data-lucide="x" style="width:15px;height:15px"></i> Filtreleri sıfırla</a>
                </div>
            </form>

            @if (count($activeFilters))
                <div class="filter-summary">
                    @foreach (array_keys($activeFilters) as $filter)
                        <span class="filter-pill">{{ $filter }}</span>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-responsive-stack align-middle mb-0">
                    <thead><tr><th>ID</th><th>Doğum tarihi</th><th>Cinsiyet</th><th>İzlem</th><th>Sonraki kontrol</th><th>Kalite</th><th class="text-end">İşlemler</th></tr></thead>
                    <tbody>
                        @forelse ($forms as $form)
                            <tr>
                                <td data-label="ID">#{{ $form->id }}</td>
                                <td data-label="Doğum tarihi">{{ optional($form->dogum_tarihi)->format('d.m.Y') ?? '-' }}</td>
                                <td data-label="Cinsiyet"><div>{{ $form->cinsiyet ?? '-' }}</div><div class="text-secondary small">{{ $form->termin_durumu ?? 'Termin yok' }}</div></td>
                                <td data-label="İzlem">{{ $form->izlem_sayisi ?? '-' }}</td>
                                <td data-label="Sonraki kontrol">
                                    @if ($form->suggested_follow_up_date)
                                        <span class="badge text-bg-{{ $form->follow_up_tone }}">{{ $form->suggested_follow_up_date->format('d.m.Y') }}</span>
                                    @else
                                        <span class="text-secondary small">Hesaplanamadı</span>
                                    @endif
                                </td>
                                <td data-label="Kalite"><span class="badge text-bg-{{ $form->completion_tone }}">%{{ $form->completion_score }}</span></td>
                                <td data-label="İşlemler">
                                    <div class="d-flex justify-content-end flex-wrap gap-2">
                                        <a href="{{ route('bebek.show', $form) }}" class="btn btn-sm btn-outline-primary">Detay</a>
                                        @can('update', $form)
                                            <a href="{{ route('bebek.edit', $form) }}" class="btn btn-sm btn-outline-secondary">Düzenle</a>
                                        @endcan
                                        @can('export', $form)
                                            <a href="{{ route('bebek.pdf', $form->id) }}" class="btn btn-sm btn-outline-secondary">PDF</a>
                                        @endcan
                                        @can('delete', $form)
                                            <form action="{{ route('bebek.destroy', $form) }}" method="POST" onsubmit="return confirm('Bu kaydı silmek istiyor musunuz?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Sil</button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center text-secondary py-5">Henüz bebek kaydı bulunmuyor.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div>{{ $forms->links() }}</div>
</div>
@endsection
