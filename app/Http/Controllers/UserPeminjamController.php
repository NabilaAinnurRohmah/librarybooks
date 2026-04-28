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
            'buku' => Buku::all(),
        ]);
    }

    public function show($id)
    {
        return view('peminjam.detail', [
            'buku' => Buku::findOrFail($id),
        ]);
    }

    public function store(Request $request)
    {
        $buku = Buku::findOrFail($request->id_buku);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis');
        }

        $buku->stok -= 1;
        $buku->save();

        Peminjaman::create([
            'id_buku' => $request->id_buku,
            'id_anggota' => session('id_anggota'),
            'tanggal_pinjam' => now(),
            'jatuh_tempo' => now()->addDays(3),
            'status' => 'menunggu',
        ]);

        return back()->with('success', 'Buku berhasil dipinjam');
    }

    public function riwayat()
    {
        return view('peminjam.riwayat', [
            'data' => Peminjaman::with('buku')
                ->where('id_anggota', session('id_anggota'))
                ->get(),
        ]);
    }
}
