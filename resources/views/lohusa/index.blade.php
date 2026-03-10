@extends('layouts.app')

@section('title', 'Lohusa Kayıtları')

@section('content')
@php
    $activeFilters = array_filter([
        'Arama: ' . request('q') => filled(request('q')),
        'Doğum yeri: ' . request('dogum_yeri') => filled(request('dogum_yeri')),
        'Beslenme: ' . request('bebek_beslenmesi') => filled(request('bebek_beslenmesi')),
        'Min. hafta: ' . request('postpartum_hafta_min') => filled(request('postpartum_hafta_min')),
        'Başlangıç: ' . request('created_from') => filled(request('created_from')),
        'Bitiş: ' . request('created_to') => filled(request('created_to')),
    ]);
@endphp
<div class="container">
    <section class="page-header">
        <div class="page-header-row">
            <div>
                <span class="badge-soft mb-2"><i data-lucide="users" style="width:14px;height:14px"></i> Lohusa takip listesi</span>
                <h1 class="h2 mb-2">Lohusa kayıtları</h1>
                <p class="text-secondary mb-0">Filtreler, sonuç sayısı ve mobil okunabilirlik tek bakışta görülüyor.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('lohusa.create') }}" class="btn btn-primary d-flex align-items-center gap-2"><i data-lucide="plus" style="width:16px;height:16px"></i> Yeni kayıt</a>
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
                    <p class="text-secondary mb-0">Ara, daralt ve tek tıkla sıfırla.</p>
                </div>
                <div class="text-secondary small">{{ $forms->total() }} kayıt bulundu</div>
            </div>

            <form method="GET" class="row g-3 align-items-end">
                <div class="col-lg-4">
                    <label for="q" class="form-label">Kayıt ara</label>
                    <input type="text" id="q" name="q" class="form-control" placeholder="Ad soyad, doğum yeri veya meslek" value="{{ request('q') }}">
                </div>
                <div class="col-lg-2">
                    <label for="dogum_yeri" class="form-label">Doğum yeri</label>
                    <select id="dogum_yeri" name="dogum_yeri" class="form-select">
                        <option value="">Tümü</option>
                        @foreach ($filterOptions['dogumYerleri'] as $dogumYeri)
                            <option value="{{ $dogumYeri }}" @selected(request('dogum_yeri') === $dogumYeri)>{{ $dogumYeri }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="bebek_beslenmesi" class="form-label">Beslenme</label>
                    <select id="bebek_beslenmesi" name="bebek_beslenmesi" class="form-select">
                        <option value="">Tümü</option>
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
                <div class="col-lg-4 d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-primary d-flex align-items-center gap-2"><i data-lucide="search" style="width:15px;height:15px"></i> Filtrele</button>
                    <a href="{{ route('lohusa.index') }}" class="btn btn-outline-primary d-flex align-items-center gap-2"><i data-lucide="x" style="width:15px;height:15px"></i> Sıfırla</a>
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
                    <thead>
                        <tr><th>ID</th><th>Danışan</th><th>Tarih</th><th>Takip</th><th>Kalite</th><th class="text-end">İşlemler</th></tr>
                    </thead>
                    <tbody>
                        @forelse ($forms as $form)
                            <tr>
                                <td data-label="ID">#{{ $form->id }}</td>
                                <td data-label="Danışan"><div class="fw-bold">{{ $form->ad_soyad }}</div><div class="text-secondary small">Yaş: {{ $form->yas ?? '-' }} | Doğum yeri: {{ $form->dogum_yeri ?? '-' }}</div></td>
                                <td data-label="Tarih">{{ $form->created_at->format('d.m.Y') }}</td>
                                <td data-label="Takip">
                                    @if ($form->suggested_follow_up_date)
                                        <div class="fw-semibold">{{ $form->suggested_follow_up_label }}</div>
                                        <span class="badge text-bg-{{ $form->follow_up_tone }}">{{ $form->suggested_follow_up_date->format('d.m.Y') }}</span>
                                    @else
                                        <span class="text-secondary small">Takip hedefi yok</span>
                                    @endif
                                </td>
                                <td data-label="Kalite"><span class="badge text-bg-{{ $form->completion_tone }}">%{{ $form->completion_score }}</span></td>
                                <td data-label="İşlemler">
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
                            <tr><td colspan="6" class="text-center text-secondary py-5">Henüz lohusa kaydı bulunmuyor.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div>{{ $forms->links() }}</div>
</div>
@endsection
