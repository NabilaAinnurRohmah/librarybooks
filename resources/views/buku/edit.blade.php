@extends('layouts')

@section('content')
    <h2 class="page-title">Edit Buku</h2>

    <div class="form-card">
        <form action="{{ route('buku.update', $buku->id_buku) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" name="judul_buku" value="{{ $buku->judul_buku }}">
            </div>

            <div class="form-group">
                <label>Pengarang</label>
                <input type="text" name="pengarang" value="{{ $buku->pengarang }}">
            </div>

            <div class="form-group">
                <label>Tahun Terbit</label>
                <input type="text" name="tahun_terbit" value="{{ $buku->tahun_terbit }}">
            </div>

            <div class="form-group">
                <label>Penerbit</label>
                <input type="text" name="penerbit" value="{{ $buku->penerbit }}">
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <select name="id_kategori">
                    @foreach ($kategori as $k)
                        <option value="{{ $k->id_kategori }}" {{ $buku->id_kategori == $k->id_kategori ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- SINOPSIS --}}
            <div class="form-group">
                <label>Sinopsis</label>
                <textarea name="sinopsis" rows="4" placeholder="Masukkan sinopsis buku">{{ $buku->sinopsis }}</textarea>
            </div>

            <button type="submit" class="btn-submit">Update</button>
        </form>
    </div>
@endsection
