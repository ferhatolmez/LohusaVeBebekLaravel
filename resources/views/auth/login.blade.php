@extends('layouts.app')

@section('title', 'Giriş Yap')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="hero-panel p-4 p-lg-5 mb-4">
                <span class="badge text-bg-light text-uppercase">Yetkili Erişim</span>
                <h1 class="display-6 fw-bold mt-3 mb-3">Klinik paneline giriş yapın</h1>
                <p class="mb-0">Web paneli rol bazlı yetkilendirme ile korunur. API erişimi için oturum açtıktan sonra Sanctum token üretebilirsiniz.</p>
            </div>

            <div class="card p-4">
                <h2 class="h4 fw-bold mb-3">Oturum Aç</h2>
                <p class="text-muted small mb-4">Demo kullanıcılar: <code>admin@example.com</code>, <code>ebe@example.com</code>, <code>student@example.com</code> · şifre: <code>password</code></p>

                <form method="POST" action="{{ route('login.store') }}" class="d-grid gap-3">
                    @csrf
                    <div>
                        <label for="email" class="form-label">E-posta</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required autofocus>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label for="password" class="form-label">Şifre</label>
                        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Beni hatırla</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Giriş yap</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
