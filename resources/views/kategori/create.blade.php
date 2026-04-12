@extends('layouts')

@section('content')
    <h2>Tambah Kategori</h2>

    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf

        <input type="text" name="nama_kategori" placeholder="Nama"><br><br>
        <input type="text" name="detail_kategori" placeholder="Detail"><br><br>

        <button type="submit">Simpan</button>
    </form>
@endsection
