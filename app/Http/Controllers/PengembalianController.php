<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;

class PengembalianController extends Controller
{
    public function index()
    {
        $data = Peminjaman::getAllDikembalikan();

        foreach ($data as $item) {

            $item->durasi =
                Peminjaman::getDurasi($item);

            $item->keterlambatan =
                Peminjaman::getKeterlambatan($item);
        }

        return view(
            'pengembalian.index',
            compact('data')
        );
    }

    public function kembali($id)
    {
        $hasil = Peminjaman::prosesPengembalian(
            $id
        );

        if (! $hasil) {

            return redirect()
                ->route('pengembalian.index')
                ->with(
                    'error',
                    'Data tidak ditemukan'
                );
        }

        return redirect()
            ->route('pengembalian.index')
            ->with(
                'success',
                'Buku berhasil dikembalikan'
            );
    }

    public function destroy($id)
    {
        $data = Peminjaman::getById($id);

        if (! $data) {
            abort(404);
        }

        Peminjaman::deleteData($id);

        return redirect()
            ->route('pengembalian.index')
            ->with(
                'success',
                'Data pengembalian berhasil dihapus'
            );
    }
}
