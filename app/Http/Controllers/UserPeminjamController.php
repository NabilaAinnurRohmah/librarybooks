<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class UserPeminjamController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {

            $buku = Buku::search(
                $request->search
            );

        } else {

            $buku = Buku::getAll();
        }

        return view(
            'peminjam.buku',
            compact('buku')
        );
    }

    public function show($id)
    {
        $buku = Buku::getById($id);

        if (! $buku) {
            abort(404);
        }

        return view(
            'peminjam.detail',
            compact('buku')
        );
    }

    public function store(Request $request)
    {
        $buku = Buku::getById(
            $request->id_buku
        );

        if (! $buku) {
            abort(404);
        }

        if ($buku->stok <= 0) {

            return back()->with(
                'error',
                'Stok buku habis'
            );
        }

        Buku::kurangiStok(
            $request->id_buku
        );

        Peminjaman::insertData([
            'id_buku' => $request->id_buku,
            'id_anggota' => session('id_anggota'),
            'tanggal_pinjam' => now(),
            'jatuh_tempo' => now()->addDays(3),
            'status' => 'dipinjam',
        ]);

        return back()->with(
            'success',
            'Buku berhasil dipinjam'
        );
    }

    public function peminjaman()
    {
        $data = Peminjaman::getByAnggotaDipinjam(
            session('id_anggota')
        );

        foreach ($data as $item) {

            $item->durasi =
                Peminjaman::getDurasi($item);

            $item->keterlambatan =
                Peminjaman::getKeterlambatan($item);
        }

        return view(
            'peminjam.peminjaman',
            compact('data')
        );
    }

    public function pengembalian()
    {
        $data = Peminjaman::getByAnggotaDikembalikan(
            session('id_anggota')
        );

        foreach ($data as $item) {

            $item->durasi =
                Peminjaman::getDurasi($item);

            $item->keterlambatan =
                Peminjaman::getKeterlambatan($item);
        }

        return view(
            'peminjam.pengembalian',
            compact('data')
        );
    }
}
