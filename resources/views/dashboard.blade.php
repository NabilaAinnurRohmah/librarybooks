@extends('layouts')

@section('content')
    <h2>Dashboard Perpustakaan</h2>

    <div style="display:flex; gap:20px;">

        <div style="background:#3498db; color:white; padding:20px; border-radius:10px; width:200px;">
            <h3>Total Buku</h3>
            <h1>{{ $totalBuku }}</h1>
        </div>

        <div style="background:#2ecc71; color:white; padding:20px; border-radius:10px; width:200px;">
            <h3>Total Kategori</h3>
            <h1>{{ $totalKategori }}</h1>
        </div>

    </div>

    <h3 style="margin-top:30px;">Buku Terbaru</h3>

    <table border="1" cellpadding="10">
        <tr>
            <th>Judul</th>
            <th>Kategori</th>
        </tr>

        @foreach ($bukuTerbaru as $b)
            <tr>
                <td>{{ $b->judul_buku }}</td>
                <td>{{ $b->kategori->nama_kategori ?? '-' }}</td>
            </tr>
        @endforeach

    </table>
@endsection
