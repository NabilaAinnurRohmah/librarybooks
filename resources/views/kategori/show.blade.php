@extends('layouts')

@section('content')
    <h2>Detail Kategori</h2>

    <p><b>Nama:</b> {{ $kategori->nama_kategori }}</p>
    <p><b>Detail:</b> {{ $kategori->detail_kategori }}</p>

    <a href="{{ route('kategori.index') }}">Kembali</a>
@endsection
