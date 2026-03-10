@extends('layouts.app')

@section('title', 'Lohusa ve Bebek Takip Ana Paneli')

@section('content')
<div class="container">
    {{-- Hero Panel --}}
    <section class="hero-panel p-4 p-lg-5 mb-4 mb-lg-5" style="position:relative;z-index:1">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span class="section-label mb-3" style="background:rgba(255,255,255,0.12);color:#93c5fd;border-color:transparent">
                    <i data-lucide="heart-pulse" style="width:14px;height:14px"></i> Klinik takip paneli
                </span>
                <h1 class="display-6 fw-bold mb-3" style="letter-spacing:-0.03em">
                    Lohusa ve bebek izlemlerini tek ekrandan yönetin
                </h1>
                <p class="lead mb-4" style="color:rgba(255,255,255,0.6)">
                    Yaklaşan kontroller, klinik dağılımlar ve kalite metrikleri — tüm izlem verileriniz bu panelde.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    @can('create', App\Models\LohusaForm::class)
                        <a href="{{ route('lohusa.create') }}" class="btn btn-light btn-lg rounded-pill px-4 fw-bold d-flex align-items-center gap-2">
                            <i data-lucide="clipboard-plus" style="width:18px;height:18px"></i> Lohusa formu
                        </a>
                    @endcan
                    @can('create', App\Models\BebekForm::class)
                        <a href="{{ route('bebek.create') }}" class="btn btn-outline-light btn-lg rounded-pill px-4 fw-bold d-flex align-items-center gap-2">
                            <i data-lucide="baby" style="width:18px;height:18px"></i> Bebek formu
                        </a>
                    @endcan
                    @cannot('create', App\Models\LohusaForm::class)
                        <span class="badge text-bg-light align-self-center py-2 px-3">
                            <i data-lucide="eye" style="width:14px;height:14px"></i> Salt okunur erişim
                        </span>
                    @endcannot
                </div>
            </div>
            <div class="col-lg-5">
                <div class="glass-panel p-4 text-dark h-100" style="background:rgba(255,255,255,0.92);">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h5 mb-0">Platform özellikleri</h2>
                        <span class="badge-soft"><i data-lucide="sparkles" style="width:12px;height:12px"></i> Güncel</span>
                    </div>
                    <ul class="list-clean d-grid gap-3" style="font-size:0.95rem">
                        <li class="d-flex align-items-start gap-2">
                            <i data-lucide="filter" class="text-primary flex-shrink-0 mt-1" style="width:16px;height:16px"></i>
                            Klinik filtreler ile hızlı listeleme ve arama
                        </li>
                        <li class="d-flex align-items-start gap-2">
                            <i data-lucide="calendar-clock" class="text-primary flex-shrink-0 mt-1" style="width:16px;height:16px"></i>
                            Otomatik kontrol tarihi hesaplama ve hatırlatma
                        </li>
                        <li class="d-flex align-items-start gap-2">
                            <i data-lucide="save" class="text-primary flex-shrink-0 mt-1" style="width:16px;height:16px"></i>
                            Tarayıcı taslağı ile form kaybını önleme
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Metrics --}}
    <section class="row g-3 g-lg-4 mb-4 mb-lg-5">
        @php
            $metrics = [
                ['icon' => 'users', 'value' => $stats['total_lohusa'], 'label' => 'Lohusa', 'color' => '#3b82f6'],
                ['icon' => 'baby', 'value' => $stats['total_bebek'], 'label' => 'Bebek', 'color' => '#8b5cf6'],
                ['icon' => 'calendar-range', 'value' => $stats['last_30_days'], 'label' => 'Son 30 gün', 'color' => '#10b981'],
                ['icon' => 'bell-ring', 'value' => $stats['upcoming_follow_ups'], 'label' => 'Planlı takip', 'color' => '#f59e0b'],
                ['icon' => 'alert-triangle', 'value' => $stats['overdue_follow_ups'], 'label' => 'Geciken', 'color' => '#ef4444'],
                ['icon' => 'gauge', 'value' => (int) round(($stats['avg_lohusa_completion'] + $stats['avg_bebek_completion']) / 2) . '%', 'label' => 'Ort. kalite', 'color' => '#06b6d4'],
            ];
        @endphp
        @foreach($metrics as $m)
        <div class="col-6 col-xl-2">
            <div class="metric-card glass-panel">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <div class="d-flex align-items-center justify-content-center rounded-circle"
                         style="width:36px;height:36px;background:{{ $m['color'] }}15;">
                        <i data-lucide="{{ $m['icon'] }}" style="width:18px;height:18px;color:{{ $m['color'] }}"></i>
                    </div>
                </div>
                <div class="metric-value">{{ $m['value'] }}</div>
                <div class="metric-label">{{ $m['label'] }}</div>
            </div>
        </div>
        @endforeach
    </section>

    {{-- Follow-up Sections --}}
    <section class="row g-4 mb-4 mb-lg-5">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="d-flex align-items-center gap-2">
                        <i data-lucide="clock" style="width:18px;height:18px;color:var(--brand-700)"></i>
                        Yaklaşan lohusa kontrolleri
                    </span>
                    <a href="{{ route('lohusa.index') }}" class="btn btn-sm btn-outline-primary">Listeye git</a>
                </div>
                <div class="card-body d-grid gap-3">
                    @forelse($upcomingLohusaFollowUps as $kayit)
                        <article class="glass-panel p-3 d-flex justify-content-between align-items-center gap-3">
                            <div>
                                <div class="fw-bold">{{ $kayit->ad_soyad }}</div>
                                <div class="text-secondary small">{{ $kayit->suggested_follow_up_label ?? 'Takip' }}</div>
                            </div>
                            <span class="badge text-bg-{{ $kayit->follow_up_tone }}">{{ $kayit->suggested_follow_up_date->format('d.m.Y') }}</span>
                        </article>
                    @empty
                        <p class="text-secondary mb-0 d-flex align-items-center gap-2">
                            <i data-lucide="check-circle" style="width:16px;height:16px"></i> Gösterilecek takip yok.
                        </p>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="d-flex align-items-center gap-2">
                        <i data-lucide="clock" style="width:18px;height:18px;color:var(--accent)"></i>
                        Yaklaşan bebek kontrolleri
                    </span>
                    <a href="{{ route('bebek.index') }}" class="btn btn-sm btn-outline-primary">Listeye git</a>
                </div>
                <div class="card-body d-grid gap-3">
                    @forelse($upcomingBebekFollowUps as $kayit)
                        <article class="glass-panel p-3 d-flex justify-content-between align-items-center gap-3">
                            <div>
                                <div class="fw-bold">{{ $kayit->cinsiyet ?? 'Bebek kaydı' }}</div>
                                <div class="text-secondary small">İzlem {{ $kayit->izlem_sayisi ?? '-' }} · {{ optional($kayit->muayene_tarihi)->format('d.m.Y') ?? '-' }}</div>
                            </div>
                            <span class="badge text-bg-{{ $kayit->follow_up_tone }}">{{ $kayit->suggested_follow_up_date->format('d.m.Y') }}</span>
                        </article>
                    @empty
                        <p class="text-secondary mb-0 d-flex align-items-center gap-2">
                            <i data-lucide="check-circle" style="width:16px;height:16px"></i> Gösterilecek takip yok.
                        </p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    {{-- Distribution Charts --}}
    <section class="row g-4 mb-4 mb-lg-5">
        <div class="col-lg-6">
            <div class="glass-panel h-100 p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h5 mb-0 d-flex align-items-center gap-2">
                        <i data-lucide="pie-chart" style="width:20px;height:20px;color:var(--success)"></i>
                        Termin dağılımı
                    </h2>
                    <span class="badge-soft">Bebek</span>
                </div>
                <div class="d-grid gap-3">
                    @forelse($termBreakdown as $label => $count)
                        <div>
                            <div class="d-flex justify-content-between small mb-1 fw-medium"><span>{{ $label }}</span><span class="fw-bold">{{ $count }}</span></div>
                            <div class="progress" style="height:8px;border-radius:999px;background:rgba(0,0,0,0.04)">
                                <div class="progress-bar" style="width:{{ max(8, $stats['total_bebek'] ? round(($count / $stats['total_bebek']) * 100) : 0) }}%;background:linear-gradient(90deg,#10b981,#34d399);border-radius:999px"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-secondary mb-0">Termin verisi yok.</p>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="glass-panel h-100 p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h5 mb-0 d-flex align-items-center gap-2">
                        <i data-lucide="utensils" style="width:20px;height:20px;color:var(--brand-700)"></i>
                        Beslenme dağılımı
                    </h2>
                    <span class="badge-soft">Lohusa</span>
                </div>
                <div class="d-grid gap-3">
                    @forelse($feedingBreakdown as $label => $count)
                        <div>
                            <div class="d-flex justify-content-between small mb-1 fw-medium"><span>{{ $label }}</span><span class="fw-bold">{{ $count }}</span></div>
                            <div class="progress" style="height:8px;border-radius:999px;background:rgba(0,0,0,0.04)">
                                <div class="progress-bar" style="width:{{ max(8, $stats['total_lohusa'] ? round(($count / $stats['total_lohusa']) * 100) : 0) }}%;background:linear-gradient(90deg,#3b82f6,#60a5fa);border-radius:999px"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-secondary mb-0">Beslenme dağılımı için yeterli veri yok.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    {{-- Recent Records --}}
    <section class="row g-4">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="d-flex align-items-center gap-2">
                        <i data-lucide="file-text" style="width:18px;height:18px;color:var(--brand-700)"></i>
                        Son lohusa kayıtları
                    </span>
                    <a href="{{ route('lohusa.index') }}" class="btn btn-sm btn-outline-primary">Tümünü gör</a>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        @forelse($sonLohusaKayitlar as $kayit)
                            <article class="glass-panel p-3">
                                <div class="d-flex flex-column flex-md-row justify-content-between gap-2 align-items-md-center">
                                    <div>
                                        <div class="fw-bold">{{ $kayit->ad_soyad }}</div>
                                        <div class="text-secondary small">{{ $kayit->created_at->format('d.m.Y') }} tarihinde eklendi</div>
                                    </div>
                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                        <span class="badge text-bg-{{ $kayit->completion_tone }}">%{{ $kayit->completion_score }}</span>
                                        <a href="{{ route('lohusa.show', $kayit) }}" class="btn btn-sm btn-outline-primary">Detay</a>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <p class="text-secondary mb-0">Henüz lohusa kaydı yok.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="d-flex align-items-center gap-2">
                        <i data-lucide="file-text" style="width:18px;height:18px;color:var(--accent)"></i>
                        Son bebek kayıtları
                    </span>
                    <a href="{{ route('bebek.index') }}" class="btn btn-sm btn-outline-primary">Tümünü gör</a>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        @forelse($sonBebekKayitlar as $kayit)
                            <article class="glass-panel p-3">
                                <div class="d-flex flex-column flex-md-row justify-content-between gap-2 align-items-md-center">
                                    <div>
                                        <div class="fw-bold">{{ $kayit->cinsiyet ?? 'Kayıt' }} bebek</div>
                                        <div class="text-secondary small">Muayene: {{ optional($kayit->muayene_tarihi)->format('d.m.Y') ?? '-' }}</div>
                                    </div>
                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                        <span class="badge text-bg-{{ $kayit->completion_tone }}">%{{ $kayit->completion_score }}</span>
                                        <a href="{{ route('bebek.show', $kayit) }}" class="btn btn-sm btn-outline-primary">Detay</a>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <p class="text-secondary mb-0">Henüz bebek kaydı yok.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
