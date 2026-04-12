@extends('layouts')

@section('content')
    <h2>Edit Buku</h2>

    <form action="{{ route('buku.update', $buku->id_buku) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" name="judul_buku" value="{{ $buku->judul_buku }}"><br><br>
        <input type="text" name="pengarang" value="{{ $buku->pengarang }}"><br><br>
        <input type="text" name="tahun_terbit" value="{{ $buku->tahun_terbit }}"><br><br>
        <input type="text" name="penerbit" value="{{ $buku->penerbit }}"><br><br>

        <select name="id_kategori">
            @foreach ($kategori as $k)
                <option value="{{ $k->id_kategori }}" {{ $buku->id_kategori == $k->id_kategori ? 'selected' : '' }}>
                    {{ $k->nama_kategori }}
                </option>
            @endforeach
        </select><br><br>

        <button type="submit">Update</button>
    </form>
@endsection
