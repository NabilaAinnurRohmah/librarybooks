<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;

class PengembalianController extends Controller
{
    public function kembali($id)
    {
        $data = Peminjaman::with('buku')->findOrFail($id);

        $result = $data->prosesPengembalian();

        if (! $result) {
            return redirect()->back()->with('error', 'Buku sudah dikembalikan!');
        }

        return redirect()->route('peminjaman.index')
            ->with('success', 'Buku berhasil dikembalikan');
    }
}
