<?php $this->section('header') ?>
    <!-- Bootstrap CSS/JS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-..." crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-..." crossorigin="anonymous" defer></script>

    <style>
        /* Brand highlight for 'Si' and 'Akad' */
        .brand-highlight { font-weight: 700; color: #0d6efd; }
        .brand-sub { font-weight: 500; color: #212529; }

        /* Nav link hover animations */
        .nav-link {
            position: relative;
            transition: color .18s ease-in-out, transform .18s ease-in-out;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: -6px;
            transform: translateX(-50%) scaleX(0);
            transform-origin: center;
            width: 60%;
            height: 3px;
            background: linear-gradient(90deg, rgba(13,110,253,0.9), rgba(0,123,255,0.6));
            border-radius: 2px;
            transition: transform .2s ease;
        }
        .nav-link:hover { color: #0b5ed7; transform: translateY(-2px); }
        .nav-link:hover::after { transform: translateX(-50%) scaleX(1); }

        /* Subtle hover on brand */
        .navbar-brand:hover .brand-highlight { text-shadow: 0 2px 8px rgba(13,110,253,0.18); }

        /* Responsive spacing tweak */
        @media (max-width: 575px) {
            .navbar-nav { margin-top: .5rem; }
        }
    </style>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-baseline" href="/">
                    <span class="brand-highlight me-1">Si</span>
                    <span class="brand-sub">stem</span>
                    <span class="ms-2 brand-highlight me-1">Akad</span>
                    <span class="brand-sub">emik</span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="mainNavbar">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="/dashboard">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="/students">Students</a></li>
                        <li class="nav-item"><a class="nav-link" href="/courses">Courses</a></li>
                        <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

<?php $this->endSection() ?>