@extends('layouts.app')

@section('title', 'Giriş Yap')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="hero-panel p-4 p-lg-5 mb-4" style="position:relative;z-index:1">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle" style="width:40px;height:40px;background:rgba(255,255,255,0.12)">
                        <i data-lucide="shield-check" style="width:20px;height:20px;color:#93c5fd"></i>
                    </div>
                    <span class="badge text-bg-light text-uppercase fw-bold" style="font-size:0.72rem;letter-spacing:0.08em">Yetkili Erişim</span>
                </div>
                <h1 class="display-6 fw-bold mb-3" style="letter-spacing:-0.03em">Klinik paneline giriş yapın</h1>
                <p class="mb-0" style="color:rgba(255,255,255,0.6)">Rol bazlı yetkilendirme ile korunan panele giriş yapın. API erişimi için Sanctum token üretebilirsiniz.</p>
            </div>

            <div class="card p-4">
                <h2 class="h4 fw-bold mb-1 d-flex align-items-center gap-2">
                    <i data-lucide="log-in" style="width:22px;height:22px;color:var(--brand-700)"></i> Oturum Aç
                </h2>
                <p class="text-muted small mb-4">İlk kurulumda <code>php artisan db:seed</code> ile admin hesabı oluşturabilirsiniz.</p>

                <form method="POST" action="{{ route('login.store', [], false) }}" class="d-grid gap-3">
                    @csrf
                    <div>
                        <label for="email" class="form-label d-flex align-items-center gap-2">
                            <i data-lucide="mail" style="width:15px;height:15px;color:var(--ink-500)"></i> E-posta
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="kullanici@ornek.com" required autofocus>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label for="password" class="form-label d-flex align-items-center gap-2">
                            <i data-lucide="lock" style="width:15px;height:15px;color:var(--ink-500)"></i> Şifre
                        </label>
                        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Beni hatırla</label>
                    </div>
                    <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center gap-2">
                        <i data-lucide="arrow-right" style="width:16px;height:16px"></i> Giriş yap
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
