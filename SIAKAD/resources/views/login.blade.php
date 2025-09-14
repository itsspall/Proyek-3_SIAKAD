<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Akademik</title>

    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
</head>
<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-4" style="width: 400px;">
            <h3 class="text-center mb-4">Login</h3>

            {{-- Tampilkan pesan error --}}
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="username" 
                        name="username" 
                        required 
                        autofocus
                    >
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        type="password" 
                        class="form-control" 
                        id="password" 
                        name="password" 
                        required
                    >
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>

</body>
</html>
