@extends('layouts')

@section('content')
    <h2 class="page-title">Data Kategori</h2>

    <a href="{{ route('kategori.create') }}" class="btn-add">+ Tambah Kategori</a>

    <div class="card">
        <form action="{{ route('kategori.index') }}" method="GET" class="search-box">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori...">
            <button type="submit">Cari</button>
        </form>
        <table class="table-modern">
            <thead>
                <tr>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($kategori as $k)
                    <tr>
                        <td class="judul">📂 {{ $k->nama_kategori }}</td>
                        <td class="aksi">
                            <a href="{{ route('kategori.show', $k->id_kategori) }}" class="btn-detail">Detail</a>
                            <a href="{{ route('kategori.edit', $k->id_kategori) }}" class="btn-edit">Edit</a>

                            <form action="{{ route('kategori.destroy', $k->id_kategori) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn-delete" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="empty">
                            Belum ada data kategori
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
