<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;

class PengembalianController extends Controller
{
    public function index()
    {
        $data = Peminjaman::with(['buku', 'anggota'])
            ->where('status', 'dikembalikan')
            ->get();

        return view('pengembalian.index', compact('data'));
    }

    public function kembali($id)
    {
        $data = Peminjaman::with('buku')->findOrFail($id);

        $data->prosesPengembalian();

        return redirect()
            ->route('pengembalian.index')
            ->with('success', 'Buku berhasil dikembalikan');
    }

    public function destroy($id)
    {
        $data = Peminjaman::findOrFail($id);

        $data->delete();

        return redirect()
            ->route('pengembalian.index')
            ->with('success', 'Data pengembalian berhasil dihapus');
    }
}
