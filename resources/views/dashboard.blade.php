@extends('layouts')

@section('content')
    <h2 class="dashboard-title">Dashboard Perpustakaan</h2>

    <div class="card-container">

        <div class="card-box blue">
            <h3>Total Buku</h3>
            <h1>{{ $totalBuku }}</h1>
        </div>

        <div class="card-box green">
            <h3>Total Kategori</h3>
            <h1>{{ $totalKategori }}</h1>
        </div>

    </div>

    <h3 class="section-title">Buku Terbaru</h3>

    <div class="card">
        <table class="table-modern">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Kategori</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($bukuTerbaru as $b)
                    <tr>
                        <td class="judul">📘 {{ $b->judul_buku }}</td>
                        <td>
                            <span class="badge">
                                {{ $b->kategori->nama_kategori ?? '-' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="empty">
                            Belum ada data buku
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
