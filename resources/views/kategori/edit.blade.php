@extends('layouts')

@section('content')
    <h2 class="page-title">Edit Kategori</h2>

    <div class="form-card">
        <form action="{{ route('kategori.update', $kategori->id_kategori) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" name="nama_kategori" value="{{ $kategori->nama_kategori }}">
            </div>

            <div class="form-group">
                <label>Detail Kategori</label>
                <input type="text" name="detail_kategori" value="{{ $kategori->detail_kategori }}">
            </div>

            <button type="submit" class="btn-submit">Update</button>
        </form>
    </div>
@endsection
