@extends('layouts')

@section('content')
    <h2 class="page-title">Detail Kategori</h2>

    <div class="detail-card">

        <div class="detail-row">
            <div class="label">Nama Kategori</div>
            <div class="value">📂 {{ $kategori->nama_kategori }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Detail</div>
            <div class="value long-text">
                {{ $kategori->detail_kategori }}
            </div>
        </div>

        <a href="{{ route('kategori.index') }}" class="btn-back">← Kembali</a>

    </div>
@endsection
