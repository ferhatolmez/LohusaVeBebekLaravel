@extends('layouts.app')

@section('content')
<style>
    .form-card {
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-card:hover {
        border-color: #0d9488;
        box-shadow: 0 4px 12px rgba(13, 148, 136, 0.12);
    }
    .page-header {
        background: #fff;
        border: 1px solid #e2e8f0;
        color: #334155;
        padding: 2rem;
        border-radius: 8px;
    }
    .page-header h1 { color: #0f766e; font-weight: 700; }
</style>

<div class="container py-5">
    <div class="page-header text-center mb-5">
        <h1 class="h2 mb-2">Atatürk Üniversitesi</h1>
        <p class="h5 text-muted mb-1">Sağlık Bilimleri Fakültesi · Ebelik Bölümü</p>
        <p class="text-muted mb-0 mt-3">Lohusa ve Bebek İzlem Formlarını doldurmak için aşağıdan seçim yapınız.</p>
    </div>

    <div class="row justify-content-center g-4">
        <div class="col-md-5">
            <div class="card form-card text-center h-100">
                <div class="card-header bg-primary text-white">Lohusa İzlem Formu</div>
                <div class="card-body">
                    <p class="card-text text-muted">Lohusa kadınlara yönelik izlem formu.</p>
                    <a href="{{ route('lohusa.create') }}" class="btn btn-primary">Formu Aç</a>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card form-card text-center h-100">
                <div class="card-header bg-success text-white">Bebek İzlem Formu</div>
                <div class="card-body">
                    <p class="card-text text-muted">Yenidoğan bebek izlem formu.</p>
                    <a href="{{ route('bebek.create') }}" class="btn btn-success">Formu Aç</a>
                </div>
            </div>
        </div>
        <div class="row mt-5 g-4">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-primary text-white">Son Lohusa Kayıtları</div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @forelse($sonLohusaKayitlar as $kayit)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $kayit->ad_soyad }} · {{ $kayit->created_at->format('d.m.Y') }}</span>
                                    <a href="{{ route('lohusa.pdf', $kayit->id) }}" class="btn btn-sm btn-outline-primary">PDF</a>
                                </li>
                            @empty
                                <li class="list-group-item text-muted">Henüz kayıt yok</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-success text-white">Son Bebek Kayıtları</div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @forelse($sonBebekKayitlar as $kayit)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $kayit->cinsiyet ?? 'Bebek' }} · {{ $kayit->dogum_tarihi?->format('d.m.Y') ?? $kayit->created_at->format('d.m.Y') }}</span>
                                    <a href="{{ route('bebek.pdf', $kayit->id) }}" class="btn btn-sm btn-outline-success">PDF</a>
                                </li>
                            @empty
                                <li class="list-group-item text-muted">Henüz kayıt yok</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


