@extends('layouts.app')

@section('title', 'Yeni Kullanıcı Oluştur')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 d-flex align-items-center gap-2">
                        <i data-lucide="user-plus" style="width:20px;height:20px;color:var(--brand-700)"></i>
                        Yeni Kullanıcı Oluştur
                    </h5>
                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-secondary">Geri Dön</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Ad Soyad</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-posta Adresi</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Kullanıcı Rolü</label>
                            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                <option value="" disabled selected>Rol Seçiniz</option>
                                @foreach($roles as $value => $label)
                                    <option value="{{ $value }}" {{ old('role') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Şifre</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Şifre (Tekrar)</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                                <i data-lucide="save" style="width:18px;height:18px"></i> Kaydet
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
