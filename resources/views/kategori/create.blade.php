@extends('layouts')

@section('content')
    <h2 class="page-title">Tambah Kategori</h2>

    <div class="form-card">
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" name="nama_kategori" placeholder="Masukkan nama kategori">
            </div>

            <div class="form-group">
                <label>Detail Kategori</label>
                <input type="text" name="detail_kategori" placeholder="Masukkan detail kategori">
            </div>

            <button type="submit" class="btn-submit">Simpan</button>
        </form>
    </div>
@endsection
