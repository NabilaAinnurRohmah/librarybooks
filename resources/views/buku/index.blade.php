@extends('layouts')

@section('content')
    <h2 class="page-title">Data Buku</h2>

    <a href="{{ route('buku.create') }}" class="btn-add">+ Tambah Buku</a>

    <div class="card">
        <form action="{{ route('buku.index') }}" method="GET" class="search-box">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari judul, pengarang, kategori...">
            <button type="submit">Cari</button>
        </form>
        <table class="table-modern">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($buku as $b)
                    <tr>
                        <td class="judul">{{ $b->judul_buku }}</td>
                        <td>{{ $b->pengarang }}</td>
                        <td>
                            <span class="badge">
                                {{ $b->kategori->nama_kategori ?? '-' }}
                            </span>
                        </td>
                        <td>{{ $b->stok }}</td>
                        <td class="aksi">
                            <a href="{{ route('buku.show', $b->id_buku) }}" class="btn-detail">Detail</a>
                            <a href="{{ route('buku.edit', $b->id_buku) }}" class="btn-edit">Edit</a>

                            <form action="{{ route('buku.destroy', $b->id_buku) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn-delete" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
