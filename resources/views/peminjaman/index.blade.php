@extends('layouts')

@section('content')
    <h2 class="page-title">Data Peminjaman</h2>

    <a href="{{ route('peminjaman.create') }}" class="btn-add">+ Pinjam Buku</a>

    <div class="card">
        <form action="{{ route('peminjaman.index') }}" method="GET" class="search-box">
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
                    <th>Tanggal</th>
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
                        <td>{{ $item->tanggal_pinjam }}</td>
                        <td>
                            <span class="{{ $item->status == 'dipinjam' ? 'status-dipinjam' : 'status-kembali' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="aksi">
                            <a href="{{ route('peminjaman.show', $item->id_peminjaman) }}" class="btn-detail">Detail</a>
                            <a href="{{ route('peminjaman.edit', $item->id_peminjaman) }}" class="btn-edit">Edit</a>

                            <form action="{{ route('peminjaman.destroy', $item->id_peminjaman) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
