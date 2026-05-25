<div class="sidebar">

    <h2 class="sidebar-title">Menu</h2>

    <br>

    <a href="{{ route('dashboard') }}">
        Dashboard
    </a>

    <a href="{{ route('anggota.index') }}">
        Data Pengguna
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
