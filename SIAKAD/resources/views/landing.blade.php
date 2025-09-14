<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>

    <style>
        :root{ --primary: #0d6efd; --dark: #212529 }
        body{ min-height:100vh; display:flex; align-items:center; justify-content:center; background: linear-gradient(180deg,#f8fbff, #ffffff); }

        .brand { text-align:center; }
        .brand-title { font-size: clamp(2rem, 6vw, 4rem); font-weight:700; letter-spacing: -1px; line-height:1; }
        .brand-title .brand-highlight { color: var(--primary); display:inline-block; transform-origin:center; }
        .brand-title .brand-sub { color: var(--dark); display:inline-block; }

        /* Reduce space between parts while keeping readable separation */
        .brand-title .gap { display:inline-block; width: 0.35   rem; }

        /* Welcome animation (fade up) */
        .fade-up { opacity:0; transform: translateY(10px); animation: fadeUp .7s ease-out forwards; }
        .fade-up.delay-1 { animation-delay: .15s; }
        .fade-up.delay-2 { animation-delay: .32s; }
        @keyframes fadeUp {
            to { opacity:1; transform: translateY(0); }
        }

        .subtitle { color: #495057; margin-top:.75rem; font-size:1.05rem; }
        .cta { margin-top:1.25rem; }

        /* subtle hover for CTA */
        .btn-primary { transition: transform .12s ease, box-shadow .12s ease; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(13,110,253,0.12); }
    </style>
</head>
<body>
    <div class="brand">
        <div class="brand-title fade-up delay-1">
            <span class="brand-highlight">Si</span><span class="brand-sub">stem</span>
            <span class="gap"></span>
            <span class="brand-highlight">Akad</span><span class="brand-sub">emik</span>
        </div>

        <p class="subtitle fade-up delay-2">Welcome to the academic information system — fast, simple, and reliable.</p>

        <div class="cta fade-up delay-2">
            <a href="/login" class="btn btn-primary btn-lg">Get Started</a>
        </div>
    </div>
</body>
</html>