@extends('layouts')

@section('content')
    <h2 class="page-title">Edit Peminjaman</h2>

    <div class="form-transaksi">
        <form action="{{ route('peminjaman.update', $data->id_peminjaman) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Nama</label>
            <input type="text" name="nama_peminjam" value="{{ $data->nama_peminjam }}">

            <label>Buku</label>
            <select name="id_buku">
                @foreach ($buku as $b)
                    <option value="{{ $b->id_buku }}" {{ $data->id_buku == $b->id_buku ? 'selected' : '' }}>
                        {{ $b->judul_buku }}
                    </option>
                @endforeach
            </select>

            <button type="submit">Update</button>
        </form>
    </div>
@endsection
