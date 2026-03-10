@extends('layouts.app')

@section('title', 'Profil Bilgileri')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('success_password'))
                <div class="alert alert-success">{{ session('success_password') }}</div>
            @endif

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 d-flex align-items-center gap-2">
                        <i data-lucide="user" style="width:20px;height:20px;color:var(--brand-700)"></i>
                        Profil Bilgileri
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')

                        <div class="mb-3">
                            <label for="name" class="form-label">Ad Soyad</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">E-posta Adresi</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                                <i data-lucide="save" style="width:18px;height:18px"></i> Kaydet
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 d-flex align-items-center gap-2">
                        <i data-lucide="lock" style="width:20px;height:20px;color:var(--brand-700)"></i>
                        Şifre Değiştir
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.password') }}">
                        @csrf
                        @method('put')

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Mevcut Şifre</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
                            @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Yeni Şifre</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Yeni Şifre (Tekrar)</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                                <i data-lucide="save" style="width:18px;height:18px"></i> Şifreyi Güncelle
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
