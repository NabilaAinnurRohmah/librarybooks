<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="login-page">

    <div class="login-box">
        <h1>📚 Perpustakaan</h1>
        <p class="subtitle">Silakan login untuk melanjutkan</p>

        @if (session('error'))
            <p class="error">{{ session('error') }}</p>
        @endif

        <form method="POST" action="{{ route('login.process') }}">
            @csrf

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Masukkan username" required>
            </div>

            <div class="form-group password-box">
                <label>Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                <button type="button" onclick="showPassword()">👁</button>
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>

</body>

</html>

<script>
    function showPassword() {
        var x = document.getElementById("password");
        x.type = (x.type === "password") ? "text" : "password";
    }
</script>
