<!DOCTYPE html>
<html>

<head>
    <title>Perpustakaan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="sidebar">
        <h2 class="sidebar-title">Menu</h2>

        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('buku.index') }}">Buku</a>
        <a href="{{ route('kategori.index') }}">Kategori</a>
        <a href="{{ route('peminjaman.index') }}">Peminjaman</a>
        <a href="{{ route('logout') }}">Logout</a>
    </div>

    <div class="main">

        <div class="topbar">
            Welcome {{ session('user') }} 👋
        </div>

        <div class="content">
            @yield('content')
        </div>

    </div>

</body>

</html>
