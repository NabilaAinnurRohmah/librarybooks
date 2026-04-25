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
                    <th>Tanggal Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Tanggal Dikembalikan</th>
                    <th>Durasi</th>
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
                        <td>{{ $item->anggota->nama }}</td>
                        <td>{{ $item->id_buku }}</td>
                        <td>{{ $item->buku->judul_buku }}</td>

                        <td>{{ $item->tanggal_pinjam }}</td>

                        <td>{{ $item->jatuh_tempo ?? '-' }}</td>

                        <td>
                            @if ($item->tanggal_kembali)
                                {{ $item->tanggal_kembali }}
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            @if ($item->durasi)
                                <span class="badge-durasi">
                                    {{ $item->durasi ?? 0 }} hari
                                </span>
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            @if ($item->keterlambatan > 0)
                                <span class="badge-terlambat">
                                    {{ $item->keterlambatan }} hari
                                </span>
                            @else
                                <span class="badge-tepat">Tepat waktu</span>
                            @endif
                        </td>

                        <td>
                            <span class="{{ $item->status == 'dipinjam' ? 'status-dipinjam' : 'status-kembali' }}">
                                {{ $item->status }}
                            </span>
                        </td>

                        <td class="aksi">

                            @if ($item->status == 'dipinjam')
                                <form action="{{ route('pengembalian.kembali', $item->id_peminjaman) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button class="btn-kembali">Kembalikan</button>
                                </form>
                            @endif

                            <a href="{{ route('peminjaman.show', $item->id_peminjaman) }}" class="btn-detail">Detail</a>

                            <a href="{{ route('peminjaman.edit', $item->id_peminjaman) }}" class="btn-edit">Edit</a>

                            <form action="{{ route('peminjaman.destroy', $item->id_peminjaman) }}" method="POST"
                                style="display:inline;">
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
