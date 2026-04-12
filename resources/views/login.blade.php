<!DOCTYPE html>
<html>

<head>
    <title>
        Login
    </title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="login-page">
    <div class="login-box">
        <h1>PLEASE LOGIN</h1>

        @if (session('error'))
            <p class="error">{{ session('error') }}</p>
        @endif

        <form method="POST" action="/login">
            @csrf

            <label>Username</label>
            <input type="text" name="username" placeholder="username...." required>

            <div class="password-box">
                <label>Password</label>
                <input type="password" id="password" name="password" placeholder="password..." required>
                <button type="button" onclick="showPassword()">Lihat</button>
            </div>
            <button type="submit">LOGIN</button>
        </form>
    </div>
</body>

</html>

<script>
    function showPassword() {
        var x = document.getElementById("password");

        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
