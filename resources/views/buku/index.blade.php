@extends('layouts')

@section('content')
    <h2>Data Buku</h2>

    <a href="{{ route('buku.create') }}">+ Tambah Buku</a>

    <table border="1" cellpadding="10">
        <tr>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>

        @foreach ($buku as $b)
            <tr>
                <td>{{ $b->judul_buku }}</td>
                <td>{{ $b->pengarang }}</td>
                <td>{{ $b->kategori->nama_kategori ?? '-' }}</td>
                <td>
                    <a href="{{ route('buku.show', $b->id_buku) }}">Detail</a> |
                    <a href="{{ route('buku.edit', $b->id_buku) }}">Edit</a> |

                    <form action="{{ route('buku.destroy', $b->id_buku) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach

    </table>
@endsection
