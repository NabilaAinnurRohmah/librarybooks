@extends('layouts')

@section('content')
    <h2 class="page-title">Pengembalian Buku</h2>

    <div class="card">
        <form action="{{ route('pengembalian.index') }}" method="GET" class="search-box">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari nama, judul buku, kode buku....">
            <button type="submit">Cari</button>
        </form>
        <table class="table-transaksi">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kode Buku</th>
                    <th>Buku</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->nama_peminjam }}</td>
                        <td>{{ $item->id_buku }}</td>
                        <td>{{ $item->buku->judul_buku }}</td>
                        <td>
                            <span class="status-dipinjam">Dipinjam</span>
                        </td>
                        <td>
                            <form action="{{ route('pengembalian.kembali', $item->id_peminjaman) }}" method="POST">
                                @csrf
                                <button class="btn-kembali">Kembalikan</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
