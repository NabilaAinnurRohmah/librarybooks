@extends('layouts')

@section('content')
    <h2 class="page-title">Pinjam Buku</h2>

    <div class="form-transaksi">
        <form action="{{ route('peminjaman.store') }}" method="POST">
            @csrf

            <label>Nama</label>
            <input type="text" name="nama_peminjam">

            <label>Buku</label>
            <select name="id_buku">
                @foreach ($buku as $b)
                    <option value="{{ $b->id_buku }}">
                        {{ $b->judul_buku }}
                    </option>
                @endforeach
            </select>

            <button type="submit">Pinjam Buku</button>
        </form>
    </div>
@endsection
