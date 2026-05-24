<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['buku', 'anggota'])
            ->where('status', 'dikembalikan');

        if ($request->search) {
            $query->search($request->search);
        }

        $data = $query->get();

        return view('pengembalian.index', compact('data'));
    }

    public function kembali($id)
    {
        $data = Peminjaman::with('buku')->findOrFail($id);

        $result = $data->prosesPengembalian();

        if (! $result) {
            return redirect()->back()
                ->with('error', 'Buku sudah dikembalikan!');
        }

        return redirect()->route('pengembalian.index')
            ->with('success', 'Buku berhasil dikembalikan');
    }
}
