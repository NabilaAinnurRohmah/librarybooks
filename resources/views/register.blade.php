<!DOCTYPE html>
<html>

<head>
    <title>Register Anggota</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body class="login-page">

    <div class="login-box">

        <h1>
            📚 Register Anggota
        </h1>

        <p class="subtitle">
            Isi data diri terlebih dahulu
        </p>

        @if ($errors->any())

            <div class="error">

                @foreach ($errors->all() as $error)
                    <div>
                        {{ $error }}
                    </div>
                @endforeach

            </div>

        @endif

        <form action="{{ route('register') }}" method="POST">

            @csrf

            <div class="form-group">

                <label>
                    Nama
                </label>

                <input type="text" name="nama" placeholder="Masukkan nama" required>

            </div>

            <div class="form-group">

                <label>
                    Alamat
                </label>

                <textarea name="alamat" placeholder="Masukkan alamat"></textarea>

            </div>

            <div class="form-group">

                <label>
                    No HP
                </label>

                <input type="text" name="no_hp" placeholder="Masukkan nomor HP">

            </div>

            <button type="submit" class="btn-login">

                Daftar

            </button>

        </form>

        <div class="register-link">

            <a href="{{ route('login') }}" class="btn-register">

                ← Kembali Login

            </a>

        </div>

    </div>

</body>

</html>
