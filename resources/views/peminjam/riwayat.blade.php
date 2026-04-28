@extends('layouts_peminjam')

@section('content')
    <h2 class="section-title">📖 Riwayat Peminjaman</h2>

    <div class="riwayat-card">
        @forelse ($data as $p)
            <div class="riwayat-item">
                <div>
                    <strong>{{ $p->buku->judul_buku }}</strong>

                    <p class="tanggal">
                        📅 Pinjam: {{ $p->tanggal_pinjam }}
                    </p>

                    <p>
                        ⏳ Durasi:
                        <span class="badge-durasi">
                            {{ $p->durasi }} hari
                        </span>
                    </p>

                    <p>
                        ⏰ Jatuh Tempo: {{ $p->jatuh_tempo }}
                    </p>

                    @if ($p->keterlambatan > 0)
                        <p class="text-danger">
                            ⚠ Terlambat {{ $p->keterlambatan }} hari
                        </p>
                    @endif
                </div>

                <span
                    class="
                    {{ $p->status == 'menunggu' ? 'status-dipinjam' : '' }}
                    {{ $p->status == 'dipinjam' ? 'status-dipinjam' : '' }}
                    {{ $p->status == 'kembali' ? 'status-kembali' : '' }}
                ">
                    @if ($p->status == 'menunggu')
                        ⏳ Menunggu
                    @elseif ($p->status == 'dipinjam')
                        📚 Dipinjam
                    @else
                        ✅ Kembali
                    @endif
                </span>
            </div>
        @empty
            <p class="empty">Belum ada riwayat peminjaman</p>
        @endforelse
    </div>
@endsection
