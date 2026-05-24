@extends('layouts')

@section('content')
    <h2 class="page-title">Edit Rak</h2>

    <div class="form-transaksi">

        <form action="{{ route('rak.update', $rak->id_rak) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Nama Rak</label>

            <input type="text" name="nama_rak" value="{{ $rak->nama_rak }}">

            <label>Lokasi</label>

            <input type="text" name="lokasi" value="{{ $rak->lokasi }}">

            <button type="submit">
                Update
            </button>

        </form>

    </div>
@endsection
