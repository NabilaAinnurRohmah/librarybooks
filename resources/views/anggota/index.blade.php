@extends('layouts.main')

@section('content')
    <h2 class="page-title">
        Data Anggota
    </h2>

    <a href="{{ route('anggota.create') }}" class="btn-add">
        + Tambah Anggota
    </a>

    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">

        <table class="table-modern">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Status Akun</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($data as $i => $a)
                    <tr>

                        <td>
                            {{ $i + 1 }}
                        </td>

                        <td class="judul">
                            {{ $a->nama }}
                        </td>

                        <td>
                            {{ $a->alamat ?? '-' }}
                        </td>

                        <td>
                            {{ $a->no_hp ?? '-' }}
                        </td>

                        <td>

                            @if ($a->id_pengguna)
                                <span class="status-dipinjam">
                                    Sudah Punya Akun
                                </span>
                            @else
                                <span class="status-kembali">
                                    Belum Punya Akun
                                </span>
                            @endif

                        </td>

                        <td class="aksi">

                            @if (!$a->id_pengguna)
                                <a href="{{ route('anggota.edit', $a->id_anggota) }}" class="btn-buat-akun">

                                    Buat Akun

                                </a>
                            @endif

                            @if ($a->id_pengguna)
                                <a href="{{ route('anggota.cetak-kartu', $a->id_anggota) }}" class="btn-cetak">
                                    Cetak Kartu
                                </a>
                            @endif

                            <a href="{{ route('anggota.show', $a->id_anggota) }}" class="btn-detail">

                                Detail

                            </a>

                            <a href="{{ route('anggota.edit', $a->id_anggota) }}" class="btn-edit">

                                Edit

                            </a>

                            <form action="{{ route('anggota.destroy', $a->id_anggota) }}" method="POST">

                                @csrf
                                @method('DELETE')

                                <button class="btn-delete">
                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>
@endsection
