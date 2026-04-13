@extends('layouts')

@section('content')
    <h2 class="page-title">Detail Buku</h2>

    <div class="detail-card">

        <div class="detail-row">
            <div class="label">Judul</div>
            <div class="value">📘 {{ $buku->judul_buku }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Pengarang</div>
            <div class="value">{{ $buku->pengarang }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Tahun Terbit</div>
            <div class="value">{{ $buku->tahun_terbit }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Penerbit</div>
            <div class="value">{{ $buku->penerbit }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Kategori</div>
            <div>
                <span class="badge">
                    {{ $buku->kategori->nama_kategori ?? '-' }}
                </span>
            </div>
        </div>

        {{-- SINOPSIS --}}
        <div class="detail-row">
            <div class="label">Sinopsis</div>
            <div class="value long-text">
                {{ $buku->sinopsis ?? '-' }}
            </div>
        </div>

        <a href="{{ route('buku.index') }}" class="btn-back">← Kembali</a>

    </div>
@endsection
