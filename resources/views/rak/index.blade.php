@extends('layouts')

@section('content')
    <h2 class="page-title">Data Rak</h2>

    <a href="{{ route('rak.create') }}" class="btn-add">
        + Tambah Rak
    </a>

    <div class="card">

        <form action="{{ route('rak.index') }}" method="GET" class="search-box">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari rak...">

            <button type="submit">Cari</button>
        </form>

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table-transaksi">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Rak</th>
                    <th>Lokasi</th>
                    <th>Jumlah Buku</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($rak as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item->nama_rak }}</td>

                        <td>{{ $item->lokasi }}</td>

                        <td>
                            <span class="badge-durasi">
                                {{ $item->buku->count() }} Buku
                            </span>
                        </td>

                        <td class="aksi">

                            <a href="{{ route('rak.show', $item->id_rak) }}" class="btn-detail">
                                Detail
                            </a>

                            <a href="{{ route('rak.edit', $item->id_rak) }}" class="btn-edit">
                                Edit
                            </a>

                            <form action="{{ route('rak.destroy', $item->id_rak) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-delete">
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
