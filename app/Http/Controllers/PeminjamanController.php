<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $data = Peminjaman::getAllDipinjam();

        foreach ($data as $item) {

            $item->durasi = Peminjaman::getDurasi($item);

            $item->keterlambatan = Peminjaman::getKeterlambatan($item);
        }

        return view( 'peminjaman.index', compact('data'));
    }

    public function create()
    {
        $anggota = Anggota::getAll();

        $buku = Buku::getAll();

        return view('peminjaman.create', compact('anggota', 'buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_anggota' => 'required',
            'id_buku' => 'required',
            'tanggal_pinjam' => 'required|date',
            'jatuh_tempo' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $buku = Buku::getById($request->id_buku);

        if ($buku->stok <= 0) {

            return back()->with(
                'error', 'Stok buku habis!');
        }

        Buku::kurangiStok( $request->id_buku);

        Peminjaman::insertData([
            'id_anggota' => $request->id_anggota,
            'id_buku' => $request->id_buku,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'jatuh_tempo' => $request->jatuh_tempo,
            'status' => 'dipinjam',
        ]);

        return redirect()->route('peminjaman.index');
    }

    public function show($id)
    {
        $data = Peminjaman::getById($id);

        if (! $data) {
            abort(404);
        }

        $data->durasi = Peminjaman::getDurasi($data);

        $data->keterlambatan = Peminjaman::getKeterlambatan($data);

        return view('peminjaman.show', compact('data'));
    }

    public function edit($id)
    {
        $data = Peminjaman::getById($id);

        if (! $data) {
            abort(404);
        }

        $anggota = Anggota::getAll();

        $buku = Buku::getAll();

        return view('peminjaman.edit', compact('data', 'anggota','buku'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'id_anggota' => 'required',
            'id_buku' => 'required',
            'tanggal_pinjam' => 'required|date',
            'jatuh_tempo' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        Peminjaman::updateData($id,
            [
                'id_anggota' => $request->id_anggota,
                'id_buku' => $request->id_buku,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'jatuh_tempo' => $request->jatuh_tempo,
            ]
        );

        return redirect() ->route('peminjaman.index');
    }

    public function destroy($id)
    {
        $data = Peminjaman::getById($id);

        if (! $data) {
            abort(404);
        }

        if ($data->status == 'dipinjam') {

            Buku::tambahStok($data->id_buku);
        }

        Peminjaman::deleteData($id);

        return redirect() ->route('peminjaman.index')->with(
                'success', 'Data peminjaman berhasil dihapus'
            );
    }
}
