@extends('layouts')

@section('content')
    <h2 class="page-title">Edit Anggota</h2>

    <div class="form-card">
        <form action="{{ route('anggota.update', $data->id_anggota) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" value="{{ $data->nama }}">
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" value="{{ $data->alamat }}">
            </div>

            <div class="form-group">
                <label>No HP</label>
                <input type="text" name="no_hp" value="{{ $data->no_hp }}">
            </div>

            <button type="submit" class="btn-submit">Update</button>
        </form>

        <a href="{{ route('anggota.index') }}" class="btn-back">Kembali</a>
    </div>
@endsection
