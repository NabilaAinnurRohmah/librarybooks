@extends('layouts_peminjam')

@section('content')
    <h2 class="section-title">📚 Daftar Buku</h2>

    <div class="buku-grid">
        @foreach ($buku as $b)
            <div class="buku-card">
                <h3>{{ $b->judul_buku }}</h3>

                <p class="stok">
                    Stok:
                    <span class="{{ $b->stok > 0 ? 'text-success' : 'text-danger' }}">
                        {{ $b->stok }}
                    </span>
                </p>

                <form method="POST" action="{{ route('peminjam.pinjam') }}">
                    @csrf
                    <input type="hidden" name="id_buku" value="{{ $b->id_buku }}">
                    <button type="submit" {{ $b->stok == 0 ? 'disabled' : '' }}>
                        Pinjam
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
