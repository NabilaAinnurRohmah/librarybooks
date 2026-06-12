@extends('layouts.main')

@section('content')
    <h2 class="section-title">
        ✅ Buku Dikembalikan
    </h2>

    <div class="riwayat-card">

        @forelse ($data as $p)
            <div class="riwayat-item">

                <div>

                    <h3>
                        {{ $p->judul_buku }}
                    </h3>

                    <p class="tanggal">
                        📅 Pinjam:
                        {{ $p->tanggal_pinjam }}
                    </p>

                    <p>
                        ⏰ Jatuh Tempo:
                        {{ $p->jatuh_tempo }}
                    </p>

                    @if ($p->keterlambatan > 0)
                        <p class="text-danger">
                            ⚠ Terlambat
                            {{ $p->keterlambatan }} hari
                        </p>
                    @endif

                </div>

                <span class="status-kembali">
                    ✅ Dikembalikan
                </span>

            </div>

        @empty

            <p class="empty">
                Belum ada buku dikembalikan
            </p>
        @endforelse

    </div>
@endsection
