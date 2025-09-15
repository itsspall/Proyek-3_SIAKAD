<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SIAKAD') }}</title>

    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> optional: project css -->

    <style>
        .brand-highlight { font-weight: 700; color: #0d6efd; }
        .brand-sub { font-weight: 500; color: #212529; }
        .nav-link { position: relative; transition: color .18s ease-in-out, transform .18s ease-in-out; }
        .nav-link::after { content: ''; position: absolute; left: 50%; bottom: -6px; transform: translateX(-50%) scaleX(0); transform-origin: center; width: 60%; height: 3px; background: linear-gradient(90deg, rgba(13,110,253,0.9), rgba(0,123,255,0.6)); border-radius: 2px; transition: transform .2s ease; }
        .nav-link:hover { color: #0b5ed7; transform: translateY(-2px); }
        .nav-link:hover::after { transform: translateX(-50%) scaleX(1); }
        .navbar-brand:hover .brand-highlight { text-shadow: 0 2px 8px rgba(13,110,253,0.18); }
        /* small controlled gap between brand segments */
        .brand-gap { margin: 0 4px; }
        @media (max-width: 575px) { .navbar-nav { margin-top: .5rem; } }
    </style>

    @stack('head')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-baseline" href="/">
                <div class="brand-title fade-up delay-1">
                    <span class="brand-highlight">Si</span><span class="brand-sub">stem</span>
                    <span class="brand-gap"></span>
                    <span class="brand-highlight">Akad</span><span class="brand-sub">emik</span>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @auth
                        <li class="nav-item"><a class="nav-link" href="/home">Dashboard</a></li>
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item"><a class="nav-link" href="/students">Students</a></li>
                            <li class="nav-item"><a class="nav-link" href="/courses">Courses</a></li>
                        @endif

                        @if(auth()->user()->role === 'student')
                            <li class="nav-item"><a class="nav-link" href="/courses">Courses</a></li>
                        @endif
                        <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
