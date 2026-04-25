@extends('layouts')

@section('content')
    <h2 class="page-title">Data Kategori (Admin)</h2>

    <div class="card">

        <form action="{{ route('kategori.index') }}" method="GET" class="search-box">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori...">
            <button type="submit">Cari</button>
        </form>

        <table class="table-modern">
            <thead>
                <tr>
                    <th>Nama Kategori</th>
                    <th>Detail Kategori</th>
                    <th>Info</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($kategori as $k)
                    <tr>
                        <td class="judul">
                            📂 {{ $k->nama_kategori }}
                        </td>

                        <td>{{ $k->detail_kategori }}</td>

                        <td style="font-size:13px; color:#777;">
                            ID: {{ $k->id_kategori }}
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
