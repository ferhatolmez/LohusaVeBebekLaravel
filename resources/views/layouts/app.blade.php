<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Lohusa Izlem Formu')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Lohusa ve bebek izlem formlari icin validation odakli, responsive Laravel uygulamasi.">
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
            --ink-300: #cbd5e1;
            --surface: #f4f8fb;
            --card: rgba(255,255,255,0.92);
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

        .site-shell {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            backdrop-filter: blur(18px);
            background: rgba(16, 59, 54, 0.88);
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .navbar-brand {
            color: #fff !important;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .navbar-toggler {
            border-color: rgba(255,255,255,0.25);
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .nav-link {
            color: rgba(255,255,255,0.86) !important;
            font-weight: 600;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #fff !important;
        }

        .page-wrap {
            flex: 1;
            padding: 32px 0 56px;
        }

        .glass-panel,
        .card {
            border: 1px solid rgba(203, 213, 225, 0.8);
            background: var(--card);
            box-shadow: var(--shadow-sm);
            border-radius: var(--radius-lg);
        }

        .hero-panel {
            background: linear-gradient(135deg, rgba(16, 59, 54, 0.96), rgba(20, 108, 99, 0.92));
            color: #fff;
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-lg);
        }

        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,0.12);
            color: inherit;
            font-size: 0.86rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            text-transform: uppercase;
        }

        .metric-card {
            height: 100%;
            padding: 24px;
        }

        .metric-value {
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            font-weight: 800;
            line-height: 1;
            letter-spacing: -0.04em;
        }

        .metric-label {
            color: var(--ink-600);
            font-weight: 600;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--brand-700), var(--brand-500));
            border: none;
            border-radius: 999px;
            padding: 0.85rem 1.4rem;
            font-weight: 700;
            box-shadow: 0 10px 30px rgba(31, 157, 143, 0.28);
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background: linear-gradient(135deg, var(--brand-900), var(--brand-700));
        }

        .btn-outline-primary {
            color: var(--brand-700);
            border-color: rgba(20, 108, 99, 0.35);
            border-radius: 999px;
            font-weight: 700;
        }

        .btn-outline-primary:hover,
        .btn-outline-primary:focus {
            background: var(--brand-700);
            border-color: var(--brand-700);
        }

        .badge-soft {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 0.45rem 0.75rem;
            border-radius: 999px;
            font-weight: 700;
            background: var(--brand-100);
            color: var(--brand-900);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid rgba(203, 213, 225, 0.75);
            font-weight: 800;
        }

        .table thead th {
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: var(--ink-600);
            border-bottom-width: 1px;
        }

        .table > :not(caption) > * > * {
            padding: 1rem 0.9rem;
            vertical-align: middle;
        }

        .form-control,
        .form-select,
        textarea.form-control {
            border-radius: 14px;
            padding: 0.85rem 1rem;
            border-color: rgba(148, 163, 184, 0.45);
            background: rgba(255,255,255,0.92);
        }

        .form-control:focus,
        .form-select:focus,
        textarea.form-control:focus {
            border-color: rgba(31, 157, 143, 0.6);
            box-shadow: 0 0 0 0.3rem rgba(31, 157, 143, 0.16);
        }

        .form-label {
            font-weight: 700;
            color: var(--ink-900);
            margin-bottom: 0.45rem;
        }

        .footer {
            padding: 24px 0 36px;
            color: var(--ink-600);
        }

        .footer a {
            color: var(--brand-700);
            text-decoration: none;
            font-weight: 700;
        }

        .list-clean {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .table-card {
            overflow: hidden;
        }

        @media (max-width: 991.98px) {
            .page-wrap {
                padding-top: 24px;
            }

            .hero-panel {
                border-radius: 20px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="site-shell">
        <nav class="navbar navbar-expand-lg sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">Lohusa ve Bebek Takip</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Navigasyonu ac">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNav">
                    <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Ana sayfa</a></li>
                        <li class="nav-item"><a href="{{ route('lohusa.index') }}" class="nav-link">Lohusa kayitlari</a></li>
                        <li class="nav-item"><a href="{{ route('bebek.index') }}" class="nav-link">Bebek kayitlari</a></li>
                        <li class="nav-item mt-3 mt-lg-0"><a href="{{ route('lohusa.create') }}" class="btn btn-primary">Yeni lohusa formu</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="page-wrap">
            @yield('content')
        </main>

        <footer class="footer">
            <div class="container d-flex flex-column flex-lg-row justify-content-between gap-2">
                <p class="mb-0">&copy; {{ date('Y') }} Lohusa ve Bebek Izlem Platformu</p>
                <p class="mb-0">Laravel 12, server-side validation, PDF export ve responsive dashboard.</p>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
