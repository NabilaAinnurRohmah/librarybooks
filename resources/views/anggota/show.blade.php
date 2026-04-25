@extends('layouts')

@section('content')
    <h2 class="page-title">Detail Anggota</h2>

    <div class="detail-card">
        <div class="detail-row">
            <div class="label">Nama</div>
            <div class="value">{{ $data->nama }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Alamat</div>
            <div class="value">{{ $data->alamat ?? '-' }}</div>
        </div>

        <div class="detail-row">
            <div class="label">No HP</div>
            <div class="value">{{ $data->no_hp ?? '-' }}</div>
        </div>

        <a href="{{ route('anggota.index') }}" class="btn-back">Kembali</a>
    </div>
@endsection
