@extends('layouts')

@section('content')
    <h2>Data Kategori</h2>

    <a href="{{ route('kategori.create') }}">+ Tambah Kategori</a>

    <table border="1" cellpadding="10">
        <tr>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>

        @foreach ($kategori as $k)
            <tr>
                <td>{{ $k->nama_kategori }}</td>
                <td>
                    <a href="{{ route('kategori.show', $k->id_kategori) }}">Detail</a> |
                    <a href="{{ route('kategori.edit', $k->id_kategori) }}">Edit</a> |

                    <form action="{{ route('kategori.destroy', $k->id_kategori) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach

    </table>
@endsection
