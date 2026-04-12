@extends('layouts')

@section('content')
    <h2>Detail Buku</h2>

    <p><b>Judul:</b> {{ $buku->judul_buku }}</p>
    <p><b>Pengarang:</b> {{ $buku->pengarang }}</p>
    <p><b>Tahun:</b> {{ $buku->tahun_terbit }}</p>
    <p><b>Penerbit:</b> {{ $buku->penerbit }}</p>
    <p><b>Kategori:</b> {{ $buku->kategori->nama_kategori ?? '-' }}</p>

    <a href="{{ route('buku.index') }}">Kembali</a>
@endsection
