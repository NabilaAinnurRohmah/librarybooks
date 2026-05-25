@extends('layouts.main')

@section('content')
    <h2 class="section-title">
        📚 Daftar Buku
    </h2>

    <div class="buku-grid">

        @foreach ($buku as $b)
            <div class="buku-card">

                <div>

                    <h3>
                        {{ $b->judul_buku }}
                    </h3>

                    <div class="buku-info">

                        <p>
                            <b>Kategori:</b>
                            {{ $b->kategori->nama_kategori ?? '-' }}
                        </p>

                        <p>
                            <b>Rak:</b>
                            {{ $b->rak->nama_rak ?? '-' }}
                        </p>

                        <p>
                            <b>Pengarang:</b>
                            {{ $b->pengarang }}
                        </p>

                    </div>

                    <div class="sinopsis">
                        {{ $b->sinopsis }}
                    </div>

                    <p class="stok">
                        Stok:
                        <span class="{{ $b->stok > 0 ? 'text-success' : 'text-danger' }}">
                            {{ $b->stok }}
                        </span>
                    </p>

                </div>

                <form method="POST" action="{{ route('peminjam.pinjam') }}">

                    @csrf

                    <input type="hidden" name="id_buku" value="{{ $b->id_buku }}">

                    <button type="submit" {{ $b->stok == 0 ? 'disabled' : '' }}>
                        Pinjam Buku
                    </button>

                </form>

            </div>
        @endforeach

    </div>
@endsection
