@extends('layouts.app')

@section('title', 'Lohusa ve Bebek Takip ana panel')

@section('content')
<div class="container">
    <section class="hero-panel p-4 p-lg-5 mb-4 mb-lg-5">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span class="section-label mb-3">Klinik odakli takip paneli</span>
                <h1 class="display-5 fw-bold mb-3">Lohusa ve bebek izlemlerini daha görünür, filtrelenebilir ve takip edilebilir hale getiren ana panel</h1>
                <p class="lead mb-4 text-white-50">Bu sürüm, yaklaşan kontrolleri öne çıkarıyor, klinik dağılımları özetliyor ve saha kullanımında veri kaybını azaltan bir taslak deneyimi sunuyor.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('lohusa.create') }}" class="btn btn-light btn-lg rounded-pill px-4 fw-bold">Lohusa formu başlat</a>
                    <a href="{{ route('bebek.create') }}" class="btn btn-outline-light btn-lg rounded-pill px-4 fw-bold">Bebek formu başlat</a>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="glass-panel p-4 text-dark h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h5 mb-0">Bu sürümde eklenenler</h2>
                        <span class="badge-soft">Klinik katkı</span>
                    </div>
                    <ul class="list-clean d-grid gap-3">
                        <li>Lohusa ve bebek kayıtlarında klinik filtreler ile hızlı listeleme.</li>
                        <li>Yaklaşan veya geciken kontrol tarihleri artık kayıt bazında hesaplanır.</li>
                        <li>16 adımlı lohusa formunda tarayıcı taslağı ile veri kaybı azaltılır.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="row g-3 g-lg-4 mb-4 mb-lg-5">
        <div class="col-6 col-xl-2">
            <div class="metric-card glass-panel">
                <div class="metric-value">{{ $stats['total_lohusa'] }}</div>
                <div class="metric-label mt-2">Toplam lohusa</div>
            </div>
        </div>
        <div class="col-6 col-xl-2">
            <div class="metric-card glass-panel">
                <div class="metric-value">{{ $stats['total_bebek'] }}</div>
                <div class="metric-label mt-2">Toplam bebek</div>
            </div>
        </div>
        <div class="col-6 col-xl-2">
            <div class="metric-card glass-panel">
                <div class="metric-value">{{ $stats['last_30_days'] }}</div>
                <div class="metric-label mt-2">Son 30 gun</div>
            </div>
        </div>
        <div class="col-6 col-xl-2">
            <div class="metric-card glass-panel">
                <div class="metric-value">{{ $stats['upcoming_follow_ups'] }}</div>
                <div class="metric-label mt-2">Planli takip</div>
            </div>
        </div>
        <div class="col-6 col-xl-2">
            <div class="metric-card glass-panel">
                <div class="metric-value">{{ $stats['overdue_follow_ups'] }}</div>
                <div class="metric-label mt-2">Geciken takip</div>
            </div>
        </div>
        <div class="col-6 col-xl-2">
            <div class="metric-card glass-panel">
                <div class="metric-value">{{ (int) round(($stats['avg_lohusa_completion'] + $stats['avg_bebek_completion']) / 2) }}%</div>
                <div class="metric-label mt-2">Ortalama kalite</div>
            </div>
        </div>
    </section>

    <section class="row g-4 mb-4 mb-lg-5">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Yaklaşan lohusa kontrolleri</span>
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
                        <p class="text-secondary mb-0">Gösterilecek lohusa takibi yok.</p>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Yaklaşan bebek kontrolleri</span>
                    <a href="{{ route('bebek.index') }}" class="btn btn-sm btn-outline-primary">Listeye git</a>
                </div>
                <div class="card-body d-grid gap-3">
                    @forelse($upcomingBebekFollowUps as $kayit)
                        <article class="glass-panel p-3 d-flex justify-content-between align-items-center gap-3">
                            <div>
                                <div class="fw-bold">{{ $kayit->cinsiyet ?? 'Bebek kaydı' }}</div>
                                <div class="text-secondary small">İzlem {{ $kayit->izlem_sayisi ?? '-' }} | {{ optional($kayit->muayene_tarihi)->format('d.m.Y') ?? '-' }}</div>
                            </div>
                            <span class="badge text-bg-{{ $kayit->follow_up_tone }}">{{ $kayit->suggested_follow_up_date->format('d.m.Y') }}</span>
                        </article>
                    @empty
                        <p class="text-secondary mb-0">Gösterilecek bebek takibi yok.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <section class="row g-4 mb-4 mb-lg-5">
        <div class="col-lg-6">
            <div class="glass-panel h-100 p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h4 mb-0">Termin dağılımı</h2>
                    <span class="badge-soft">Bebek</span>
                </div>
                <div class="d-grid gap-3">
                    @forelse($termBreakdown as $label => $count)
                        <div>
                            <div class="d-flex justify-content-between small mb-1">
                                <span>{{ $label }}</span>
                                <span>{{ $count }}</span>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-success" style="width: {{ max(8, $stats['total_bebek'] ? round(($count / $stats['total_bebek']) * 100) : 0) }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-secondary mb-0">Termin verisi henüz yok.</p>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="glass-panel h-100 p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h4 mb-0">Beslenme dağılımı</h2>
                    <span class="badge-soft">Lohusa</span>
                </div>
                <div class="d-grid gap-3">
                    @forelse($feedingBreakdown as $label => $count)
                        <div>
                            <div class="d-flex justify-content-between small mb-1">
                                <span>{{ $label }}</span>
                                <span>{{ $count }}</span>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar" style="width: {{ max(8, $stats['total_lohusa'] ? round(($count / $stats['total_lohusa']) * 100) : 0) }}%; background-color: var(--brand-500);"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-secondary mb-0">Beslenme dağılımı icin yeterli veri yok.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <section class="row g-4">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Son lohusa kayıtları</span>
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
                                        <span class="badge text-bg-{{ $kayit->completion_tone }}">Tamamlılık %{{ $kayit->completion_score }}</span>
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
                    <span>Son bebek kayıtları</span>
                    <a href="{{ route('bebek.index') }}" class="btn btn-sm btn-outline-primary">Tümünü gör</a>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        @forelse($sonBebekKayitlar as $kayit)
                            <article class="glass-panel p-3">
                                <div class="d-flex flex-column flex-md-row justify-content-between gap-2 align-items-md-center">
                                    <div>
                                        <div class="fw-bold">{{ $kayit->cinsiyet ?? 'Kayit' }} bebek</div>
                                        <div class="text-secondary small">Muayene: {{ optional($kayit->muayene_tarihi)->format('d.m.Y') ?? '-' }}</div>
                                    </div>
                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                        <span class="badge text-bg-{{ $kayit->completion_tone }}">Tamamlılık %{{ $kayit->completion_score }}</span>
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



