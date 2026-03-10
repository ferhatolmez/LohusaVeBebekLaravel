@extends('layouts.app')

@section('title', 'Lohusa ve Bebek Takip Dashboard')

@section('content')
<div class="container">
    <section class="hero-panel p-4 p-lg-5 mb-4 mb-lg-5">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span class="section-label mb-3">Portfolio-ready Laravel project</span>
                <h1 class="display-5 fw-bold mb-3">Validation, veri kalitesi ve mobil deneyimi on plana cikan saglik takip uygulamasi</h1>
                <p class="lead mb-4 text-white-50">Bu proje lohusa ve bebek izlem surecini tek bir platformda yonetir. Guclu form dogrulama, PDF export, veri tamamlilik skoru ve responsive arayuz ile repo kalitesini gorunur hale getirir.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('lohusa.create') }}" class="btn btn-light btn-lg rounded-pill px-4 fw-bold">Lohusa formu baslat</a>
                    <a href="{{ route('bebek.create') }}" class="btn btn-outline-light btn-lg rounded-pill px-4 fw-bold">Bebek formu baslat</a>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="glass-panel p-4 text-dark h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h5 mb-0">Proje guc noktalarI</h2>
                        <span class="badge-soft">Hiring signal</span>
                    </div>
                    <ul class="list-clean d-grid gap-3">
                        <li>Server-side validation ile bos, tip hatali ve aralik disi veriler engellenir.</li>
                        <li>Kayit listelerinde veri tamamlilik skoru gorunur, kalite takibi saglanir.</li>
                        <li>Responsive dashboard, filtreler ve PDF export ile uretim hissi veren deneyim sunulur.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="row g-3 g-lg-4 mb-4 mb-lg-5">
        <div class="col-6 col-xl-3">
            <div class="metric-card glass-panel">
                <div class="metric-value">{{ $stats['total_lohusa'] }}</div>
                <div class="metric-label mt-2">Toplam lohusa kaydi</div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="metric-card glass-panel">
                <div class="metric-value">{{ $stats['total_bebek'] }}</div>
                <div class="metric-label mt-2">Toplam bebek kaydi</div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="metric-card glass-panel">
                <div class="metric-value">{{ $stats['last_30_days'] }}</div>
                <div class="metric-label mt-2">Son 30 gunde olusturulan kayit</div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="metric-card glass-panel">
                <div class="metric-value">{{ (int) round(($stats['avg_lohusa_completion'] + $stats['avg_bebek_completion']) / 2) }}%</div>
                <div class="metric-label mt-2">Ortalama veri tamamliligi</div>
            </div>
        </div>
    </section>

    <section class="row g-4 mb-4 mb-lg-5">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Son lohusa kayitlari</span>
                    <a href="{{ route('lohusa.index') }}" class="btn btn-sm btn-outline-primary">Tumunu gor</a>
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
                                        <span class="badge text-bg-{{ $kayit->completion_tone }}">Tamamlilik %{{ $kayit->completion_score }}</span>
                                        <a href="{{ route('lohusa.show', $kayit) }}" class="btn btn-sm btn-outline-primary">Detay</a>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <p class="text-secondary mb-0">Henuz lohusa kaydi yok.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Son bebek kayitlari</span>
                    <a href="{{ route('bebek.index') }}" class="btn btn-sm btn-outline-primary">Tumunu gor</a>
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
                                        <span class="badge text-bg-{{ $kayit->completion_tone }}">Tamamlilik %{{ $kayit->completion_score }}</span>
                                        <a href="{{ route('bebek.show', $kayit) }}" class="btn btn-sm btn-outline-primary">Detay</a>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <p class="text-secondary mb-0">Henuz bebek kaydi yok.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="row g-4">
        <div class="col-lg-4">
            <div class="glass-panel h-100 p-4">
                <span class="badge-soft mb-3">Validation</span>
                <h2 class="h4">Tip kontrolu ve zorunlu alanlar</h2>
                <p class="text-secondary mb-0">Yas alanina harf, metin alanina sayi ya da tamamen bos form gonderimi artik server tarafinda reddediliyor. Bu, repo kalitesini dogrudan yukseltiyor.</p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="glass-panel h-100 p-4">
                <span class="badge-soft mb-3">UX</span>
                <h2 class="h4">Mobil odakli akis</h2>
                <p class="text-secondary mb-0">Yeni kart yapisi, yumuak spacing, okunur tipografi ve daha net CTA'lar ile mobil cihazlarda kullanim kolaylasti.</p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="glass-panel h-100 p-4">
                <span class="badge-soft mb-3">Product thinking</span>
                <h2 class="h4">Veri tamamlilik skoru</h2>
                <p class="text-secondary mb-0">Kayitlar sadece depolanmiyor; kalite seviyesi de olculuyor. Bu tur dokunuslar isverenlere urun dusuncesi gosteren detaylardir.</p>
            </div>
        </div>
    </section>
</div>
@endsection
