@extends('layouts.main')

@section('content')
    <h2 class="page-title">Detail Rak</h2>

    <div class="detail-card">

        <div class="detail-row">
            <div class="label">Nama Rak</div>
            <div class="value">{{ $rak->nama_rak }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Lokasi</div>
            <div class="value">{{ $rak->lokasi }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Jumlah Buku</div>
            <div class="value">{{ $buku->count() }} Buku</div>
        </div>

        <hr>

        <h3>Daftar Buku</h3>

        <table class="table-transaksi">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                </tr>
            </thead>

            <tbody>

                @forelse($buku as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item->judul_buku }}</td>

                        <td>
                            {{ $item->nama_kategori ?? '-' }}
                        </td>

                        <td>
                            <span class="badge-durasi">
                                {{ $item->stok }}
                            </span>
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="4">
                            Tidak ada buku
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

        <a href="{{ route('rak.index') }}" class="btn-back">
            Kembali
        </a>

    </div>
@endsection
