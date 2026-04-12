@extends('layouts')

@section('content')
    <h2>Edit Kategori</h2>

    <form action="{{ route('kategori.update', $kategori->id_kategori) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" name="nama_kategori" value="{{ $kategori->nama_kategori }}"><br><br>
        <input type="text" name="detail_kategori" value="{{ $kategori->detail_kategori }}"><br><br>

        <button type="submit">Update</button>
    </form>
@endsection
