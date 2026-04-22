<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Peminjaman::with('buku')->dipinjam();

        if ($request->search) {
            $query->search($request->search);
        }

        $data = $query->get();

        return view('pengembalian.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function kembali($id)
    {
        $data = Peminjaman::findOrFail($id);
        $buku = Buku::find($data->id_buku);
        $buku->increment('stok');

        $data->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now(),
        ]);

        return redirect()->route('pengembalian.index');
    }
}
