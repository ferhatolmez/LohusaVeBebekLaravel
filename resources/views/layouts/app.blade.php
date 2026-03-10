<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Lohusa İzlem Formu')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --medical-teal: #0d9488;
            --medical-teal-dark: #0f766e;
            --medical-slate: #334155;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
            color: #334155;
        }

        .navbar {
            background: var(--medical-teal-dark);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .navbar-brand {
            color: #fff !important;
            font-weight: 600;
        }

        .navbar-brand:hover {
            color: #e2e8f0 !important;
        }

        .nav-link {
            color: rgba(255,255,255,0.9) !important;
        }

        .nav-link:hover {
            color: #fff !important;
        }

        .card {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        }

        .card-header {
            font-weight: 600;
        }

        .bg-primary { background-color: var(--medical-teal) !important; }
        .btn-primary { background-color: var(--medical-teal); border-color: var(--medical-teal); }
        .btn-primary:hover { background-color: var(--medical-teal-dark); border-color: var(--medical-teal-dark); }
        .btn-outline-primary { border-color: var(--medical-teal); color: var(--medical-teal); }
        .btn-outline-primary:hover { background-color: var(--medical-teal); color: #fff; }
        .border-primary { border-color: var(--medical-teal) !important; }

        footer {
            background: var(--medical-slate);
            color: #94a3b8;
            padding: 20px 0;
            margin-top: 40px;
        }

        footer a {
            color: #cbd5e1;
            text-decoration: none;
        }

        footer a:hover {
            color: #fff;
        }

        .container {
            padding-bottom: 60px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg shadow">
        <div class="container">
            <a class="navbar-brand" href="{{ route('lohusa.index') }}">🩺 Lohusa ve Bebek Takip</a>

            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link text-white">🏠 Ana Sayfa</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('lohusa.index') }}" class="nav-link text-white">👩‍🍼 Lohusa</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('bebek.index') }}" class="nav-link text-white">🧒 Bebek</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('lohusa.create') }}" class="nav-link text-white">➕ Yeni Form</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p class="mb-1">© {{ date('Y') }} Lohusa ve Bebek İzlem Formu</p>
            <p class="small">Geliştiren: <a href="https://github.com" target="_blank">ferhad ÖLMEZ</a></p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


