@extends('layouts.main')

@section('content')
    <h2 class="section-title">
        📖 Buku Dipinjam
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

                    <p>
                        ⏳ Durasi:

                        <span class="badge-durasi">
                            {{ $p->durasi }} hari
                        </span>
                    </p>

                </div>

                <span class="status-dipinjam">
                    📚 Dipinjam
                </span>

            </div>

        @empty

            <p class="empty">
                Belum ada buku dipinjam
            </p>
        @endforelse

    </div>
@endsection
