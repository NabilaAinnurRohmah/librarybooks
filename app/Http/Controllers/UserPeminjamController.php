<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class UserPeminjamController extends Controller
{
    public function index()
    {
        return view('peminjam.buku', [
            'buku' => Buku::with(['kategori', 'rak'])->get(),
        ]);
    }

    public function show($id)
    {
        return view('peminjam.detail', [
            'buku' => Buku::with(['kategori', 'rak'])
                ->findOrFail($id),
        ]);
    }

    public function store(Request $request)
    {
        $buku = Buku::findOrFail($request->id_buku);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis');
        }

        $buku->decrement('stok');

        Peminjaman::create([
            'id_buku' => $request->id_buku,
            'id_anggota' => session('id_anggota'),
            'tanggal_pinjam' => now(),
            'jatuh_tempo' => now()->addDays(3),
            'status' => 'dipinjam',
        ]);

        return back()->with('success', 'Buku berhasil dipinjam');
    }

    public function peminjaman()
    {
        return view('peminjam.peminjaman', [
            'data' => Peminjaman::with('buku')
                ->where('id_anggota', session('id_anggota'))
                ->where('status', 'dipinjam')
                ->latest()
                ->get(),
        ]);
    }

    public function pengembalian()
    {
        return view('peminjam.pengembalian', [
            'data' => Peminjaman::with('buku')
                ->where('id_anggota', session('id_anggota'))
                ->where('status', 'dikembalikan')
                ->latest()
                ->get(),
        ]);
    }
}
