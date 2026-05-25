@extends('layouts.main')

@section('content')
    <h2 class="page-title">Tambah Rak</h2>

    <div class="form-transaksi">

        <form action="{{ route('rak.store') }}" method="POST">
            @csrf

            <label>Nama Rak</label>
            <input type="text" name="nama_rak">

            <label>Lokasi</label>
            <input type="text" name="lokasi">

            <button type="submit">
                Simpan
            </button>

        </form>

    </div>
@endsection
