@extends('layouts.main')

@section('content')
    <h2 class="page-title">Detail Peminjaman</h2>

    <div class="detail-card">
        <div class="detail-row">
            <div class="label">Nama</div>
            <div class="value">{{ $data->nama }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Kode Buku</div>
            <div class="value">{{ $data->id_buku }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Buku</div>
            <div class="value">{{ $data->judul_buku }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Tanggal Pinjam</div>
            <div class="value">{{ $data->tanggal_pinjam }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Jatuh Tempo</div>
            <div class="value">{{ $data->jatuh_tempo ?? '-' }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Durasi</div>
            <div class="value">{{ $data->durasi ? $data->durasi . ' hari' : '-' }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Status</div>
            <div class="value">{{ $data->status }}</div>
        </div>

        <a href="{{ route('peminjaman.index') }}" class="btn-back">Kembali</a>
    </div>
@endsection
