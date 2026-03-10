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
            --brand-050: #eefaf8;
            --ink-900: #16212b;
            --ink-600: #546272;
            --ink-500: #6b7b8d;
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

        a { text-decoration: none; }
        .skip-link {
            position: absolute;
            left: 16px;
            top: -48px;
            z-index: 1050;
            background: #fff;
            color: var(--brand-900);
            padding: 0.75rem 1rem;
            border-radius: 999px;
            box-shadow: var(--shadow-sm);
            transition: top 0.2s ease;
        }
        .skip-link:focus { top: 16px; }
        .site-shell { min-height: 100vh; display: flex; flex-direction: column; }
        .navbar { backdrop-filter: blur(18px); background: rgba(16, 59, 54, 0.88); border-bottom: 1px solid rgba(255,255,255,0.08); }
        .navbar-brand, .nav-link, .navbar-text { color: #fff !important; }
        .navbar-brand { font-weight: 800; letter-spacing: -0.02em; }
        .navbar-toggler { border-color: rgba(255,255,255,0.3); padding: 0.45rem 0.65rem; }
        .navbar-toggler:focus { box-shadow: 0 0 0 0.2rem rgba(217, 243, 239, 0.3); }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255,255,255,0.95%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        .nav-link {
            border-radius: 999px;
            padding: 0.55rem 0.9rem !important;
            font-weight: 600;
            transition: background-color 0.2s ease, color 0.2s ease;
        }
        .nav-link:hover, .nav-link.active { background: rgba(255,255,255,0.12); }
        .page-wrap { flex: 1; padding: 32px 0 56px; }
        .glass-panel, .card { border: 1px solid rgba(203, 213, 225, 0.8); background: var(--card); box-shadow: var(--shadow-sm); border-radius: var(--radius-lg); }
        .card-header {
            background: transparent;
            border-bottom: 1px solid rgba(203, 213, 225, 0.8);
            font-weight: 700;
            padding: 1rem 1.25rem;
        }
        .hero-panel { background: linear-gradient(135deg, rgba(16, 59, 54, 0.96), rgba(20, 108, 99, 0.92)); color: #fff; border-radius: var(--radius-xl); box-shadow: var(--shadow-lg); }
        .btn-primary { background: linear-gradient(135deg, var(--brand-700), var(--brand-500)); border: none; border-radius: 999px; padding: 0.85rem 1.4rem; font-weight: 700; box-shadow: 0 10px 30px rgba(31, 157, 143, 0.28); }
        .btn-outline-primary { color: var(--brand-700); border-color: rgba(20, 108, 99, 0.35); border-radius: 999px; font-weight: 700; }
        .btn-outline-primary:hover, .btn-outline-primary:focus { background: var(--brand-050); color: var(--brand-900); border-color: rgba(20, 108, 99, 0.45); }
        .form-control, .form-select, textarea.form-control { border-radius: 14px; padding: 0.85rem 1rem; border-color: rgba(148, 163, 184, 0.45); background: rgba(255,255,255,0.92); }
        .form-control:focus, .form-select:focus { border-color: rgba(20, 108, 99, 0.5); box-shadow: 0 0 0 0.2rem rgba(31, 157, 143, 0.16); }
        .form-label { font-weight: 700; color: var(--ink-900); margin-bottom: 0.45rem; }
        .form-text, .text-secondary { color: var(--ink-500) !important; }
        .section-label, .badge-soft {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--brand-700);
            background: var(--brand-100);
            border-radius: 999px;
            padding: 0.45rem 0.8rem;
        }
        .list-clean { list-style: none; padding: 0; margin: 0; }
        .metric-card { padding: 1.25rem; height: 100%; }
        .metric-value { font-size: clamp(1.8rem, 2vw, 2.4rem); font-weight: 800; letter-spacing: -0.04em; }
        .metric-label { color: var(--ink-500); font-weight: 600; }
        .page-header { display: flex; flex-direction: column; gap: 1rem; margin-bottom: 1.5rem; }
        .page-header-row { display: flex; justify-content: space-between; align-items: flex-start; gap: 1rem; }
        .page-header p { max-width: 64ch; }
        .status-strip {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
            gap: 0.9rem;
        }
        .status-chip {
            padding: 1rem 1.1rem;
            border-radius: 18px;
            background: rgba(255,255,255,0.88);
            border: 1px solid rgba(203, 213, 225, 0.85);
        }
        .status-chip strong { display: block; font-size: 1.3rem; letter-spacing: -0.03em; }
        .status-chip span { color: var(--ink-500); font-size: 0.92rem; }
        .filter-panel { padding: 1.25rem; }
        .filter-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        .filter-summary {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 0.85rem;
        }
        .filter-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.45rem 0.75rem;
            background: var(--brand-050);
            border: 1px solid rgba(20, 108, 99, 0.18);
            color: var(--brand-900);
            border-radius: 999px;
            font-size: 0.86rem;
            font-weight: 700;
        }
        .table-card { overflow: hidden; }
        .table thead th {
            color: var(--ink-500);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            font-weight: 800;
            border-bottom-width: 1px;
        }
        .table > :not(caption) > * > * { padding: 1rem 0.9rem; }
        .step-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 1.5rem;
            align-items: start;
        }
        .sticky-panel { position: sticky; top: 96px; }
        .step-overview { display: flex; flex-direction: column; gap: 0.75rem; }
        .step-chip {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            width: 100%;
            text-align: left;
            border-radius: 16px;
            padding: 0.9rem 1rem;
        }
        .step-chip small {
            display: block;
            color: inherit;
            opacity: 0.78;
            font-weight: 500;
        }
        .step-chip-index {
            width: 2rem;
            height: 2rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            background: rgba(20, 108, 99, 0.1);
            font-weight: 800;
            flex-shrink: 0;
        }
        .step-chip.active .step-chip-index { background: rgba(255,255,255,0.2); }
        .record-form-section { scroll-margin-top: 112px; }
        .record-form-section .card-header { display: flex; justify-content: space-between; align-items: center; gap: 1rem; }
        .section-note {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            font-size: 0.88rem;
            color: var(--ink-500);
        }
        .form-check-choice {
            border: 1px solid rgba(148, 163, 184, 0.35);
            background: rgba(255,255,255,0.78);
            border-radius: 999px;
            padding: 0.7rem 1rem;
            margin: 0;
        }
        .form-actions {
            position: sticky;
            bottom: 16px;
            z-index: 20;
            box-shadow: var(--shadow-lg);
        }
        .footer { padding: 24px 0 36px; color: var(--ink-600); }

        @media (max-width: 991.98px) {
            .page-header-row, .filter-toolbar, .step-layout { display: block; }
            .sticky-panel { position: static; top: auto; margin-top: 1rem; }
        }

        @media (max-width: 767.98px) {
            .page-wrap { padding-top: 24px; }
            .table-responsive-stack thead { display: none; }
            .table-responsive-stack,
            .table-responsive-stack tbody,
            .table-responsive-stack tr,
            .table-responsive-stack td {
                display: block;
                width: 100%;
            }
            .table-responsive-stack tr {
                padding: 0.9rem;
                border-bottom: 1px solid rgba(203, 213, 225, 0.8);
            }
            .table-responsive-stack td {
                padding: 0.45rem 0;
                border: 0;
            }
            .table-responsive-stack td::before {
                content: attr(data-label);
                display: block;
                font-size: 0.72rem;
                font-weight: 800;
                letter-spacing: 0.05em;
                text-transform: uppercase;
                color: var(--ink-500);
                margin-bottom: 0.25rem;
            }
            .table-responsive-stack td[data-label="İşlemler"]::before { display: none; }
            .form-actions {
                left: 0;
                right: 0;
                bottom: 0;
                border-radius: 22px 22px 0 0;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <a href="#main-content" class="skip-link">İçeriğe geç</a>
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
                            <li class="nav-item"><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Panel</a></li>
                            @can('viewAny', App\Models\LohusaForm::class)
                                <li class="nav-item"><a href="{{ route('lohusa.index') }}" class="nav-link {{ request()->routeIs('lohusa.*') ? 'active' : '' }}">Lohusa kayıtları</a></li>
                            @endcan
                            @can('viewAny', App\Models\BebekForm::class)
                                <li class="nav-item"><a href="{{ route('bebek.index') }}" class="nav-link {{ request()->routeIs('bebek.*') ? 'active' : '' }}">Bebek kayıtları</a></li>
                            @endcan
                            @can('create', App\Models\LohusaForm::class)
                                <li class="nav-item mt-3 mt-lg-0"><a href="{{ route('lohusa.create') }}" class="btn btn-primary">Yeni lohusa formu</a></li>
                            @endcan
                            <li class="nav-item ms-lg-3">
                                <span class="navbar-text small d-block">{{ auth()->user()->name }} · {{ auth()->user()->getRoleNames()->implode(', ') }}</span>
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('logout', [], false) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-light rounded-pill">Çıkış</button>
                                </form>
                            </li>
                        </ul>
                    @endauth
                </div>
            </div>
        </nav>

        <main id="main-content" class="page-wrap">
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
