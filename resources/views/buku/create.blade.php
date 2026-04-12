@extends('layouts')

@section('content')
    <h2>Tambah Buku</h2>

    <form action="{{ route('buku.store') }}" method="POST">
        @csrf

        <input type="text" name="judul_buku" placeholder="Judul"><br><br>
        <input type="text" name="pengarang" placeholder="Pengarang"><br><br>
        <input type="text" name="tahun_terbit" placeholder="Tahun"><br><br>
        <input type="text" name="penerbit" placeholder="Penerbit"><br><br>

        <select name="id_kategori">
            @foreach ($kategori as $k)
                <option value="{{ $k->id_kategori }}">
                    {{ $k->nama_kategori }}
                </option>
            @endforeach
        </select><br><br>

        <button type="submit">Simpan</button>
    </form>
@endsection
