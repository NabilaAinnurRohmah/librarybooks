@extends('layouts')

@section('content')
    <h2 class="page-title">Data Peminjaman (Admin)</h2>

    <div class="card">
        <table class="table-modern">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Durasi</th>
                    <TH>Jatuh Tempo</TH>
                    <th>Keterlambatan</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td>{{ optional($item->anggota)->nama ?? '-' }}</td>

                        <td class="judul">
                            {{ optional($item->buku)->judul_buku ?? '-' }}
                        </td>

                        <td>{{ $item->tanggal_pinjam }}</td>

                        <td>{{ $item->tanggal_kembali }}</td>

                        <td>
                            <span class="badge-durasi">
                                {{ $item->durasi ?? 0 }} hari
                            </span>
                        </td>


                        <td>
                            {{ $item->jatuh_tempo ?? '-' }}
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
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty">
                            Tidak ada data peminjaman
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
