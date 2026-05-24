<!DOCTYPE html>
<html>

<head>
    <title>Perpustakaan</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        .menu-group {
            margin-top: 20px;
        }

        .menu-title {
            font-size: 14px;
            font-weight: bold;
            color: #999;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
    </style>
</head>

<body>

    <div class="sidebar">

        <h2 class="sidebar-title">Menu</h2>

        <br>
        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>

        <a href="{{ route('anggota.index') }}">
            Data Anggota
        </a>

        <div class="menu-group">

            <div class="menu-title">
                Data
            </div>

            <a href="{{ route('buku.index') }}">
                Data Buku
            </a>

            <a href="{{ route('kategori.index') }}">
                Kategori
            </a>

            <a href="{{ route('rak.index') }}">
                Rak
            </a>

        </div>

        <div class="menu-group">

            <div class="menu-title">
                Transaksi
            </div>

            <a href="{{ route('peminjaman.index') }}">
                Peminjaman
            </a>

            <a href="{{ route('pengembalian.index') }}">
                Pengembalian
            </a>

        </div>

        <br><br>

        <a href="{{ route('logout') }}">
            Logout
        </a>

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
