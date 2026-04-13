@extends('layouts')

@section('content')
    <h2 class="page-title">Tambah Buku</h2>

    <div class="form-card">
        <form action="{{ route('buku.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" name="judul_buku" placeholder="Masukkan judul buku">
            </div>

            <div class="form-group">
                <label>Pengarang</label>
                <input type="text" name="pengarang" placeholder="Masukkan nama pengarang">
            </div>

            <div class="form-group">
                <label>Tahun Terbit</label>
                <input type="text" name="tahun_terbit" placeholder="Contoh: 2024">
            </div>

            <div class="form-group">
                <label>Penerbit</label>
                <input type="text" name="penerbit" placeholder="Masukkan penerbit">
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <select name="id_kategori">
                    @foreach ($kategori as $k)
                        <option value="{{ $k->id_kategori }}">
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Sinopsis</label>
                <textarea name="sinopsis" rows="4" placeholder="Masukkan sinopsis buku"></textarea>
            </div>

            <button type="submit" class="btn-submit">Simpan</button>
        </form>
    </div>
@endsection
