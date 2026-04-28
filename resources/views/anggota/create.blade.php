@extends('layouts')

@section('content')
    <h2 class="page-title">Tambah Anggota</h2>

    <div class="form-card">
        <form action="{{ route('anggota.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" required>
            </div>

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat">
            </div>

            <div class="form-group">
                <label>No HP</label>
                <input type="text" name="no_hp">
            </div>

            <button type="submit" class="btn-submit">Simpan</button>
        </form>

        <a href="{{ route('anggota.index') }}" class="btn-back">Kembali</a>
    </div>
@endsection
