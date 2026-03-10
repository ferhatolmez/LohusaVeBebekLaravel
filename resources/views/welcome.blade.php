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

    {{-- Interactive Charts --}}
    <section class="row g-4 mb-4 mb-lg-5">
        <div class="col-12">
            <div class="glass-panel p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h5 mb-0 d-flex align-items-center gap-2">
                        <i data-lucide="trending-up" style="width:20px;height:20px;color:var(--brand-700)"></i>
                        Aylık kayıt trendi
                    </h2>
                    <span class="badge-soft">Son 6 ay</span>
                </div>
                <div style="position:relative;height:280px">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>
        </div>
    </section>

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
                @if(count($termBreakdown) > 0)
                    <div style="position:relative;height:240px;max-width:320px;margin:0 auto">
                        <canvas id="termChart"></canvas>
                    </div>
                @else
                    <p class="text-secondary mb-0">Termin verisi yok.</p>
                @endif
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
                @if(count($feedingBreakdown) > 0)
                    <div style="position:relative;height:240px;max-width:320px;margin:0 auto">
                        <canvas id="feedingChart"></canvas>
                    </div>
                @else
                    <p class="text-secondary mb-0">Beslenme verisi yok.</p>
                @endif
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const fontFamily = "'Inter', sans-serif";
    Chart.defaults.font.family = fontFamily;
    Chart.defaults.font.size = 12;
    Chart.defaults.color = '#64748b';

    // Monthly Trend
    const trendData = @json($monthlyTrend);
    new Chart(document.getElementById('trendChart'), {
        type: 'bar',
        data: {
            labels: trendData.map(d => d.label),
            datasets: [
                {
                    label: 'Lohusa',
                    data: trendData.map(d => d.lohusa),
                    backgroundColor: 'rgba(59,130,246,0.7)',
                    borderRadius: 8,
                    borderSkipped: false,
                },
                {
                    label: 'Bebek',
                    data: trendData.map(d => d.bebek),
                    backgroundColor: 'rgba(139,92,246,0.7)',
                    borderRadius: 8,
                    borderSkipped: false,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'top', labels: { usePointStyle: true, padding: 20 } },
            },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: 'rgba(0,0,0,0.04)' } },
                x: { grid: { display: false } }
            }
        }
    });

    // Term Doughnut
    @if(count($termBreakdown) > 0)
    const termLabels = @json($termBreakdown->keys());
    const termValues = @json($termBreakdown->values());
    new Chart(document.getElementById('termChart'), {
        type: 'doughnut',
        data: {
            labels: termLabels,
            datasets: [{
                data: termValues,
                backgroundColor: ['#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#06b6d4'],
                borderWidth: 0,
                hoverOffset: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 16 } } }
        }
    });
    @endif

    // Feeding Doughnut
    @if(count($feedingBreakdown) > 0)
    const feedLabels = @json($feedingBreakdown->keys());
    const feedValues = @json($feedingBreakdown->values());
    new Chart(document.getElementById('feedingChart'), {
        type: 'doughnut',
        data: {
            labels: feedLabels,
            datasets: [{
                data: feedValues,
                backgroundColor: ['#3b82f6', '#60a5fa', '#93c5fd', '#bfdbfe', '#dbeafe'],
                borderWidth: 0,
                hoverOffset: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 16 } } }
        }
    });
    @endif
});
</script>
@endpush

