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

            <label>Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam"
                value="{{ \Carbon\Carbon::parse($data->tanggal_pinjam)->format('d-m-Y') }}">

            <label>Jatuh Tempo</label>
            <input type="date" name="jatuh_tempo"
                value="{{ $data->jatuh_tempo ? \Carbon\Carbon::parse($data->jatuh_tempo)->format('d-m-Y') : '' }}">

            <button type="submit">Update</button>
        </form>
    </div>
@endsection
