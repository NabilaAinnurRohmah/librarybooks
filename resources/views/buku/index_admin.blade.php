@extends('layouts')

@section('content')
    <h2 class="page-title">Data Buku (Admin)</h2>

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
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Sinopsis</th>
                    <th>Stok</th>
                    <th>Info</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($buku as $b)
                    <tr>
                        <td class="judul">
                            {{ $b->judul_buku }}
                        </td>

                        <td>{{ $b->pengarang }}</td>

                        <td>
                            <span class="badge">
                                {{ optional($b->kategori)->nama_kategori ?? '-' }}
                            </span>
                        </td>
                        <td>{{ $b->penerbit }}</td>
                        <td>{{ $b->tahun_terbit }}</td>
                        <td>{{ $b->sinopsis }}</td>

                        <td>

                            @if ($b->stok <= 0)
                                <span class="badge-terlambat">Habis</span>
                            @elseif($b->stok <= 3)
                                <span class="badge-durasi">{{ $b->stok }}</span>
                            @else
                                <span class="badge-tepat">{{ $b->stok }}</span>
                            @endif
                        </td>

                        <td style="font-size:13px; color:#777;">
                            ID: {{ $b->id_buku }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty">
                            Tidak ada data buku
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
@endsection
