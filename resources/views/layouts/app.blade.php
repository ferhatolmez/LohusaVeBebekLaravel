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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --brand-900: #0f172a;
            --brand-700: #3b82f6;
            --brand-500: #60a5fa;
            --brand-400: #93c5fd;
            --brand-100: #eff6ff;
            --brand-050: #f8fafc;
            --accent: #8b5cf6;
            --accent-light: #ede9fe;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --ink-900: #1e293b;
            --ink-600: #475569;
            --ink-500: #64748b;
            --ink-400: #94a3b8;
            --surface: #f1f5f9;
            --card-bg: rgba(255, 255, 255, 0.72);
            --shadow-xs: 0 1px 2px rgba(0,0,0,0.04);
            --shadow-sm: 0 4px 6px -1px rgba(0,0,0,0.06), 0 2px 4px -2px rgba(0,0,0,0.04);
            --shadow-md: 0 10px 15px -3px rgba(0,0,0,0.07), 0 4px 6px -4px rgba(0,0,0,0.04);
            --shadow-lg: 0 20px 25px -5px rgba(0,0,0,0.08), 0 8px 10px -6px rgba(0,0,0,0.03);
            --radius-xl: 24px;
            --radius-lg: 16px;
            --radius-md: 12px;
            --radius-sm: 8px;
            --glass-border: 1px solid rgba(255,255,255,0.65);
            --glass-blur: blur(20px);
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #e0f2fe 0%, #f0fdf4 25%, #eff6ff 50%, #faf5ff 75%, #f1f5f9 100%);
            background-attachment: fixed;
            color: var(--ink-900);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        h1, h2, h3, h4, h5, h6, .navbar-brand, .metric-value {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            letter-spacing: -0.025em;
        }

        a { text-decoration: none; transition: color 0.2s ease; }

        /* ─── Skip Link ─── */
        .skip-link {
            position: absolute; left: 16px; top: -48px; z-index: 1050;
            background: #fff; color: var(--brand-900);
            padding: 0.75rem 1rem; border-radius: 999px;
            box-shadow: var(--shadow-sm); transition: top 0.2s ease;
        }
        .skip-link:focus { top: 16px; }

        /* ─── Shell ─── */
        .site-shell { min-height: 100vh; display: flex; flex-direction: column; }

        /* ─── Navbar ─── */
        .navbar {
            backdrop-filter: var(--glass-blur);
            -webkit-backdrop-filter: var(--glass-blur);
            background: rgba(15, 23, 42, 0.88);
            border-bottom: 1px solid rgba(255,255,255,0.08);
            padding: 0.75rem 0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12);
        }
        .navbar-brand {
            font-weight: 800; letter-spacing: -0.03em;
            color: #fff !important; font-size: 1.2rem;
        }
        .nav-link, .navbar-text { color: rgba(255,255,255,0.85) !important; font-family: 'Inter', sans-serif; }
        .navbar-toggler { border-color: rgba(255,255,255,0.2); padding: 0.45rem; border-radius: var(--radius-sm); }
        .navbar-toggler:focus { box-shadow: 0 0 0 0.2rem rgba(255,255,255,0.2); }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255,255,255,0.95%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        .nav-link {
            border-radius: 999px; padding: 0.5rem 0.9rem !important;
            font-weight: 500; font-size: 0.92rem;
            transition: all 0.2s ease;
        }
        .nav-link:hover, .nav-link.active {
            background: rgba(255,255,255,0.14); color: #fff !important;
        }
        .user-avatar {
            width: 30px; height: 30px;
            background: linear-gradient(135deg, var(--brand-700), var(--accent));
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 700; font-family: 'Outfit'; font-size: 0.8rem;
            flex-shrink: 0;
        }

        /* ─── Page Wrap ─── */
        .page-wrap { flex: 1; padding: 36px 0 60px; }

        /* ─── Glassmorphism Cards ─── */
        .glass-panel, .card {
            background: var(--card-bg);
            backdrop-filter: var(--glass-blur);
            -webkit-backdrop-filter: var(--glass-blur);
            border: var(--glass-border);
            box-shadow: var(--shadow-sm);
            border-radius: var(--radius-lg);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .card:hover { box-shadow: var(--shadow-md); transform: translateY(-2px); }
        .card-header {
            background: rgba(255,255,255,0.45);
            border-bottom: 1px solid rgba(255,255,255,0.7);
            font-family: 'Outfit', sans-serif; font-weight: 700;
            font-size: 1.05rem; padding: 1.1rem 1.4rem;
            color: var(--brand-900);
            border-top-left-radius: calc(var(--radius-lg) - 1px);
            border-top-right-radius: calc(var(--radius-lg) - 1px);
        }

        /* ─── Hero Panel ─── */
        .hero-panel {
            background: linear-gradient(135deg, var(--brand-900) 0%, #1e293b 100%);
            color: #fff; border-radius: var(--radius-xl);
            box-shadow: var(--shadow-lg); position: relative; overflow: hidden;
        }
        .hero-panel::after {
            content: ''; position: absolute;
            top: -60%; right: -30%; width: 80%; height: 200%;
            background: radial-gradient(circle, rgba(96,165,250,0.12) 0%, transparent 70%);
            pointer-events: none;
        }

        /* ─── Buttons ─── */
        .btn-primary {
            background: linear-gradient(135deg, var(--brand-700), var(--brand-500));
            border: none; border-radius: 999px;
            padding: 0.7rem 1.4rem; font-weight: 600;
            letter-spacing: 0.01em;
            box-shadow: 0 6px 16px rgba(59,130,246,0.28);
            transition: all 0.25s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(59,130,246,0.38);
            background: linear-gradient(135deg, #2563eb, #3b82f6);
        }
        .btn-outline-primary {
            background: rgba(255,255,255,0.75); color: var(--brand-700);
            border: 1px solid rgba(59,130,246,0.2); border-radius: 999px;
            font-weight: 600; padding: 0.7rem 1.4rem;
            box-shadow: var(--shadow-xs); backdrop-filter: blur(4px);
            transition: all 0.25s ease;
        }
        .btn-outline-primary:hover, .btn-outline-primary:focus {
            background: var(--brand-100); color: var(--brand-900);
            border-color: rgba(59,130,246,0.3); transform: translateY(-1px);
        }

        /* ─── Forms ─── */
        .form-control, .form-select, textarea.form-control {
            border-radius: var(--radius-md);
            padding: 0.75rem 1rem; border: 2px solid transparent;
            background: rgba(255,255,255,0.88);
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.03);
            font-size: 0.95rem; transition: all 0.2s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--brand-500); background: #fff;
            box-shadow: 0 0 0 4px rgba(96,165,250,0.12);
        }
        .form-label {
            font-family: 'Outfit', sans-serif; font-weight: 600;
            color: var(--ink-900); margin-bottom: 0.45rem; font-size: 0.92rem;
        }
        .form-text, .text-secondary { color: var(--ink-500) !important; }

        /* ─── Badges ─── */
        .section-label, .badge-soft {
            display: inline-flex; align-items: center; gap: 0.4rem;
            font-size: 0.75rem; font-weight: 700;
            letter-spacing: 0.08em; text-transform: uppercase;
            color: var(--brand-700); background: var(--brand-100);
            border-radius: 999px; padding: 0.4rem 0.8rem;
            border: 1px solid rgba(59,130,246,0.15);
        }

        /* ─── Metrics ─── */
        .list-clean { list-style: none; padding: 0; margin: 0; }
        .metric-card { padding: 1.4rem; height: 100%; border-radius: var(--radius-lg); }
        .metric-value {
            font-size: clamp(2rem, 3vw, 2.6rem); font-weight: 800;
            letter-spacing: -0.04em; color: var(--brand-900);
            line-height: 1.1; margin-bottom: 0.35rem;
        }
        .metric-label { color: var(--ink-500); font-weight: 500; font-size: 0.9rem; }

        /* ─── Page Header ─── */
        .page-header { display: flex; flex-direction: column; gap: 1rem; margin-bottom: 2rem; }
        .page-header-row { display: flex; justify-content: space-between; align-items: flex-start; gap: 1rem; }
        .page-header p { max-width: 64ch; color: var(--ink-600); }

        /* ─── Status Strip ─── */
        .status-strip {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(175px, 1fr));
            gap: 1rem;
        }
        .status-chip {
            padding: 1.15rem 1.35rem; border-radius: var(--radius-lg);
            background: rgba(255,255,255,0.65); backdrop-filter: var(--glass-blur);
            border: var(--glass-border); box-shadow: var(--shadow-xs);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .status-chip:hover { transform: translateY(-2px); box-shadow: var(--shadow-sm); }
        .status-chip strong {
            display: block; font-family: 'Outfit', sans-serif;
            font-size: 1.4rem; letter-spacing: -0.03em; color: var(--brand-900);
        }
        .status-chip span { color: var(--ink-500); font-size: 0.88rem; font-weight: 500; }

        /* ─── Filters ─── */
        .filter-panel {
            padding: 1.4rem;
            background: rgba(255,255,255,0.35);
            border-bottom: 1px solid rgba(255,255,255,0.6);
        }
        .filter-toolbar {
            display: flex; justify-content: space-between;
            align-items: flex-start; gap: 1rem; margin-bottom: 1.25rem;
        }
        .filter-summary { display: flex; flex-wrap: wrap; gap: 0.5rem; margin-top: 1rem; }
        .filter-pill {
            display: inline-flex; align-items: center; gap: 0.35rem;
            padding: 0.38rem 0.75rem;
            background: #fff; border: 1px solid rgba(59,130,246,0.15);
            box-shadow: var(--shadow-xs); color: var(--brand-700);
            border-radius: 999px; font-size: 0.82rem; font-weight: 600;
            transition: all 0.2s ease;
        }
        .filter-pill:hover { background: var(--brand-100); }

        /* ─── Tables ─── */
        .table-card { overflow: hidden; }
        .table { margin-bottom: 0; }
        .table thead th {
            background: rgba(255,255,255,0.35);
            color: var(--ink-600); font-size: 0.78rem;
            text-transform: uppercase; letter-spacing: 0.05em;
            font-weight: 700; border-bottom: 2px solid rgba(255,255,255,0.7);
            padding: 0.9rem 1.25rem;
        }
        .table tbody tr { transition: background 0.2s ease; border-bottom: 1px solid rgba(0,0,0,0.03); }
        .table tbody tr:hover { background: rgba(255,255,255,0.55); }
        .table > :not(caption) > * > * { padding: 0.9rem 1.25rem; background: transparent; }

        /* ─── Step Layout (Create form) ─── */
        .step-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 300px;
            gap: 2rem; align-items: start;
        }
        .sticky-panel { position: sticky; top: 100px; }
        .step-overview { display: flex; flex-direction: column; gap: 0.75rem; }
        .step-chip {
            display: flex; align-items: flex-start; gap: 0.9rem;
            width: 100%; text-align: left;
            border-radius: var(--radius-md); padding: 0.9rem 1rem;
            background: rgba(255,255,255,0.45);
            border: 1px solid rgba(255,255,255,0.7);
            transition: all 0.2s ease;
        }
        .step-chip:hover { background: rgba(255,255,255,0.75); transform: translateX(3px); }
        .step-chip small { display: block; color: var(--ink-500); font-weight: 500; margin-top: 0.15rem; }
        .step-chip-index {
            width: 2.25rem; height: 2.25rem;
            display: inline-flex; align-items: center; justify-content: center;
            border-radius: 50%; background: var(--brand-100);
            color: var(--brand-700); font-weight: 700;
            font-family: 'Outfit', sans-serif; flex-shrink: 0;
            transition: all 0.25s ease; font-size: 0.9rem;
        }
        .step-chip.active {
            background: #fff; border-color: var(--brand-400);
            box-shadow: var(--shadow-sm);
        }
        .step-chip.active .step-chip-index {
            background: linear-gradient(135deg, var(--brand-700), var(--brand-500));
            color: #fff; box-shadow: 0 4px 12px rgba(59,130,246,0.3);
        }

        /* ─── Form Sections ─── */
        .record-form-section { scroll-margin-top: 116px; }
        .record-form-section .card-header { display: flex; justify-content: space-between; align-items: center; gap: 1rem; }
        .section-note {
            display: inline-flex; align-items: center;
            gap: 0.45rem; font-size: 0.85rem; color: var(--ink-500);
        }
        .form-check-choice {
            border: 1px solid rgba(255,255,255,0.7);
            background: rgba(255,255,255,0.5);
            border-radius: 999px; padding: 0.7rem 1.1rem; margin: 0;
            transition: all 0.2s ease; box-shadow: var(--shadow-xs); cursor: pointer;
        }
        .form-check-choice:hover { background: rgba(255,255,255,0.85); transform: translateY(-1px); }
        .form-check-input:checked + .form-check-label { font-weight: 600; color: var(--brand-700); }
        .form-actions {
            position: sticky; bottom: 20px; z-index: 20;
            box-shadow: 0 -8px 30px rgba(0,0,0,0.06);
            border-radius: var(--radius-lg);
        }

        /* ─── Footer ─── */
        .footer { padding: 28px 0 40px; color: var(--ink-500); font-size: 0.9rem; }
        .footer p { margin-bottom: 0.35rem; }

        /* ─── Alert enhancements ─── */
        .alert { border-radius: var(--radius-md); border: none; font-weight: 500; }
        .alert-success {
            background: rgba(16,185,129,0.1);
            color: #065f46; border-left: 4px solid var(--success);
        }

        /* ─── Responsive ─── */
        @media (max-width: 991.98px) {
            .page-header-row, .filter-toolbar, .step-layout { display: block; }
            .sticky-panel { position: static; top: auto; margin-top: 1rem; }
        }
        @media (max-width: 767.98px) {
            .page-wrap { padding-top: 20px; }
            .table-responsive-stack thead { display: none; }
            .table-responsive-stack,
            .table-responsive-stack tbody,
            .table-responsive-stack tr,
            .table-responsive-stack td { display: block; width: 100%; }
            .table-responsive-stack tr {
                padding: 0.85rem; border-bottom: 1px solid rgba(0,0,0,0.05);
            }
            .table-responsive-stack td { padding: 0.4rem 0; border: 0; }
            .table-responsive-stack td::before {
                content: attr(data-label); display: block;
                font-family: 'Outfit', sans-serif;
                font-size: 0.72rem; font-weight: 700;
                letter-spacing: 0.05em; text-transform: uppercase;
                color: var(--ink-500); margin-bottom: 0.3rem;
            }
            .table-responsive-stack td[data-label="İşlemler"]::before { display: none; }
            .form-actions { left: 0.75rem; right: 0.75rem; bottom: 0.75rem; }
            .navbar-brand { font-size: 1.05rem; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <a href="#main-content" class="skip-link">İçeriğe geç</a>
    <div class="site-shell">
        <nav class="navbar navbar-expand-lg sticky-top">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ auth()->check() ? route('home') : route('login') }}">
                    <i data-lucide="activity" style="width:22px;height:22px;color:#60a5fa"></i>
                    Lohusa & Bebek
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Navigasyonu aç">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNav">
                    @auth
                        <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1 mt-3 mt-lg-0">
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('home') ? 'active' : '' }}">
                                    <i data-lucide="layout-dashboard" style="width:16px;height:16px"></i> Panel
                                </a>
                            </li>
                            @can('viewAny', App\Models\LohusaForm::class)
                                <li class="nav-item">
                                    <a href="{{ route('lohusa.index') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('lohusa.*') ? 'active' : '' }}">
                                        <i data-lucide="users" style="width:16px;height:16px"></i> Lohusa
                                    </a>
                                </li>
                            @endcan
                            @can('viewAny', App\Models\BebekForm::class)
                                <li class="nav-item">
                                    <a href="{{ route('bebek.index') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('bebek.*') ? 'active' : '' }}">
                                        <i data-lucide="baby" style="width:16px;height:16px"></i> Bebek
                                    </a>
                                </li>
                            @endcan
                            @can('create', App\Models\LohusaForm::class)
                                <li class="nav-item ms-lg-2">
                                    <a href="{{ route('lohusa.create') }}" class="btn btn-primary btn-sm rounded-pill px-3 d-flex align-items-center gap-2">
                                        <i data-lucide="plus" style="width:15px;height:15px"></i> Yeni Kayıt
                                    </a>
                                </li>
                            @endcan
                            <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                                <span class="navbar-text small d-block">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                                        <div>
                                            <div class="fw-semibold text-white lh-1" style="font-size:0.88rem">{{ auth()->user()->name }}</div>
                                            @php
                                                $roleName = auth()->user()->getRoleNames()->first() ?? 'user';
                                                $roleColors = [
                                                    'admin' => 'background:#ef4444;color:#fff',
                                                    'ebe' => 'background:#3b82f6;color:#fff',
                                                    'student' => 'background:#f59e0b;color:#1e293b',
                                                ];
                                                $roleLabels = [
                                                    'admin' => 'Yönetici',
                                                    'ebe' => 'Ebe',
                                                    'student' => 'Öğrenci',
                                                ];
                                                $roleIcons = [
                                                    'admin' => 'shield',
                                                    'ebe' => 'stethoscope',
                                                    'student' => 'graduation-cap',
                                                ];
                                            @endphp
                                            <span class="d-inline-flex align-items-center gap-1 rounded-pill px-2 mt-1"
                                                  style="{{ $roleColors[$roleName] ?? 'background:#64748b;color:#fff' }};font-size:0.68rem;font-weight:700;letter-spacing:0.04em">
                                                <i data-lucide="{{ $roleIcons[$roleName] ?? 'user' }}" style="width:10px;height:10px"></i>
                                                {{ strtoupper($roleLabels[$roleName] ?? $roleName) }}
                                            </span>
                                        </div>
                                    </div>
                                </span>
                            </li>
                            <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                                <form action="{{ route('logout', [], false) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-light btn-sm rounded-pill d-flex align-items-center gap-1" style="font-size:0.82rem">
                                        <i data-lucide="log-out" style="width:14px;height:14px"></i> Çıkış
                                    </button>
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
                <p class="mb-0 opacity-75">Laravel 12 · Sanctum API · Spatie Permission · Pest</p>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof lucide !== 'undefined') lucide.createIcons();
        });
    </script>
    @stack('scripts')
</body>
</html>