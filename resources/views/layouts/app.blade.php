<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Lohusa İzlem Platformu')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Rol bazlı erişim, API ve test altyapısı olan lohusa ve bebek izlem uygulaması.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --brand-900: #103b36;
            --brand-700: #146c63;
            --brand-500: #1f9d8f;
            --brand-100: #d9f3ef;
            --ink-900: #16212b;
            --ink-600: #546272;
            --surface: #f4f8fb;
            --card: rgba(255,255,255,0.94);
            --shadow-lg: 0 20px 60px rgba(15, 23, 42, 0.12);
            --shadow-sm: 0 10px 30px rgba(15, 23, 42, 0.08);
            --radius-xl: 24px;
            --radius-lg: 18px;
        }

        body {
            font-family: 'Manrope', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(31, 157, 143, 0.18), transparent 28%),
                radial-gradient(circle at top right, rgba(37, 99, 235, 0.10), transparent 22%),
                linear-gradient(180deg, #f8fbfd 0%, var(--surface) 100%);
            color: var(--ink-900);
            min-height: 100vh;
        }

        .site-shell { min-height: 100vh; display: flex; flex-direction: column; }
        .navbar { backdrop-filter: blur(18px); background: rgba(16, 59, 54, 0.88); border-bottom: 1px solid rgba(255,255,255,0.08); }
        .navbar-brand, .nav-link, .navbar-text { color: #fff !important; }
        .navbar-brand { font-weight: 800; letter-spacing: -0.02em; }
        .page-wrap { flex: 1; padding: 32px 0 56px; }
        .glass-panel, .card { border: 1px solid rgba(203, 213, 225, 0.8); background: var(--card); box-shadow: var(--shadow-sm); border-radius: var(--radius-lg); }
        .hero-panel { background: linear-gradient(135deg, rgba(16, 59, 54, 0.96), rgba(20, 108, 99, 0.92)); color: #fff; border-radius: var(--radius-xl); box-shadow: var(--shadow-lg); }
        .btn-primary { background: linear-gradient(135deg, var(--brand-700), var(--brand-500)); border: none; border-radius: 999px; padding: 0.85rem 1.4rem; font-weight: 700; box-shadow: 0 10px 30px rgba(31, 157, 143, 0.28); }
        .btn-outline-primary { color: var(--brand-700); border-color: rgba(20, 108, 99, 0.35); border-radius: 999px; font-weight: 700; }
        .form-control, .form-select, textarea.form-control { border-radius: 14px; padding: 0.85rem 1rem; border-color: rgba(148, 163, 184, 0.45); background: rgba(255,255,255,0.92); }
        .footer { padding: 24px 0 36px; color: var(--ink-600); }
    </style>
    @stack('styles')
</head>
<body>
    <div class="site-shell">
        <nav class="navbar navbar-expand-lg sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ auth()->check() ? route('home') : route('login') }}">Lohusa ve Bebek Takip</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Navigasyonu aç">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNav">
                    @auth
                        <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                            <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Panel</a></li>
                            @can('viewAny', App\Models\LohusaForm::class)
                                <li class="nav-item"><a href="{{ route('lohusa.index') }}" class="nav-link">Lohusa kayıtları</a></li>
                            @endcan
                            @can('viewAny', App\Models\BebekForm::class)
                                <li class="nav-item"><a href="{{ route('bebek.index') }}" class="nav-link">Bebek kayıtları</a></li>
                            @endcan
                            @can('create', App\Models\LohusaForm::class)
                                <li class="nav-item mt-3 mt-lg-0"><a href="{{ route('lohusa.create') }}" class="btn btn-primary">Yeni lohusa formu</a></li>
                            @endcan
                            <li class="nav-item ms-lg-3">
                                <span class="navbar-text small d-block">{{ auth()->user()->name }} · {{ auth()->user()->getRoleNames()->implode(', ') }}</span>
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-light rounded-pill">Çıkış</button>
                                </form>
                            </li>
                        </ul>
                    @endauth
                </div>
            </div>
        </nav>

        <main class="page-wrap">
            @yield('content')
        </main>

        <footer class="footer">
            <div class="container d-flex flex-column flex-lg-row justify-content-between gap-2">
                <p class="mb-0">&copy; {{ date('Y') }} Lohusa ve Bebek İzlem Platformu</p>
                <p class="mb-0">Laravel 12, Sanctum API, Spatie Permission, Pest ve CI odaklı portföy sürümü.</p>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
