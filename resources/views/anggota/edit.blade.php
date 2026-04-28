@extends('layouts')

@section('content')
    <h2 class="page-title">Edit Anggota</h2>

    <div class="form-card">
        <form action="{{ route('anggota.update', $data->id_anggota) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" value="{{ $data->nama }}" required>
            </div>

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" value="{{ $data->pengguna->username ?? '' }}" required>
            </div>

            <div class="form-group">
                <label>Password (Kosongkan jika tidak diubah)</label>
                <input type="password" name="password">
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
