<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Absensi | SMAN 1 Jenamas</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="login-page">
        <div class="login-container">

            <div class="welcome-panel">
                <h1>Absensi Digital<br>SMAN 1 Jenamas</h1>
                <p>
                    Sistem informasi kehadiran sekolah
                    untuk guru dan siswa.
                </p>
            </div>

            <div class="login-panel">
                <h2>Selamat Datang</h2>
                <p class="login-subtitle">
                    Silakan masuk ke akun Anda.
                </p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login.process') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input
                            type="text"
                            class="form-control"
                            id="username"
                            name="username"
                            placeholder="Masukkan username"
                            value="{{ old('username') }}"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            required
                        >
                    </div>

                    <button type="submit" class="login-button">
                        Masuk
                    </button>
                </form>

                <div class="login-footer">
                    &copy; {{ date('Y') }} SMAN 1 Jenamas
                </div>
            </div>

        </div>
    </div>
</body>
</html>
