@extends('layouts')

@section('content')
    <h2 class="page-title">Data Anggota (Admin)</h2>

    <div class="card">

        <table class="table-modern">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Info</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($data as $i => $a)
                    <tr>
                        <td>{{ $i + 1 }}</td>

                        <td class="judul">
                            {{ $a->nama }}
                        </td>

                        <td>{{ $a->alamat ?? '-' }}</td>

                        <td>{{ $a->no_hp ?? '-' }}</td>

                        <td style="font-size:13px; color:#777;">
                            ID: {{ $a->id_anggota }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty">
                            Tidak ada data anggota
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
@endsection
