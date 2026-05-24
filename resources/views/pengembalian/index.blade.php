@extends('layouts')

@section('content')
    <h2 class="page-title">Data Pengembalian</h2>

    <div class="card">

        <form action="{{ route('pengembalian.index') }}" method="GET" class="search-box">

            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau buku...">

            <button type="submit">
                Cari
            </button>

        </form>

        <table class="table-transaksi">

            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kode Buku</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Tanggal Dikembalikan</th>
                    <th>Terlambat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($data as $item)
                    <tr
                        class="
                            {{ $item->status == 'dikembalikan' ? 'sudah-kembali' : '' }}
                            {{ $item->keterlambatan > 0 ? 'terlambat' : '' }}
                        ">

                        <td>{{ $item->anggota->nama ?? '-' }}</td>

                        <td>{{ $item->id_buku }}</td>

                        <td>{{ $item->buku->judul_buku }}</td>

                        <td>{{ $item->tanggal_pinjam }}</td>

                        <td>{{ $item->jatuh_tempo ?? '-' }}</td>

                        <td>
                            {{ $item->tanggal_kembali ?? '-' }}
                        </td>

                        <td>

                            @if ($item->keterlambatan > 0)
                                <span class="badge-terlambat">
                                    {{ $item->keterlambatan }} hari
                                </span>
                            @else
                                <span class="badge-tepat">
                                    Tepat waktu
                                </span>
                            @endif

                        </td>

                        <td>

                            <span class="{{ $item->status == 'dipinjam' ? 'status-dipinjam' : 'status-kembali' }}">

                                {{ $item->status }}

                            </span>

                        </td>

                        <td class="aksi">

                            <form action="{{ route('peminjaman.destroy', $item->id_peminjaman) }}" method="POST"
                                style="display:inline;">

                                @csrf
                                @method('DELETE')

                                <button class="btn-delete">
                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>
@endsection
