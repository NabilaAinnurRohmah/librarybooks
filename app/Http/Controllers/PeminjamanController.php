<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with('buku');

        if ($request->search) {
            $query->search($request->search);
        }

        $data = $query->get();

        return view('peminjaman.index', compact('data'));
    }

    public function create()
    {
        $buku = Buku::all();

        return view('peminjaman.create', compact('buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam' => 'required',
            'id_buku' => 'required',
            'tanggal_pinjam' => 'required|date',
            'jatuh_tempo' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $buku = Buku::findOrFail($request->id_buku);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis!');
        }

        $buku->decrement('stok');

        Peminjaman::create([
            'nama_peminjam' => $request->nama_peminjam,
            'id_buku' => $request->id_buku,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'jatuh_tempo' => $request->jatuh_tempo,
            'status' => 'dipinjam',
        ]);

        return redirect()->route('peminjaman.index');
    }

    public function show(string $id)
    {
        $data = Peminjaman::with('buku')->findOrFail($id);

        return view('peminjaman.show', compact('data'));
    }

    public function edit(string $id)
    {
        $data = Peminjaman::find($id);
        $buku = Buku::all();

        return view('peminjaman.edit', compact('data', 'buku'));
    }

    public function update(Request $request, string $id)
    {
        $data = Peminjaman::findOrFail($id);

        $request->validate([
            'nama_peminjam' => 'required',
            'id_buku' => 'required',
            'tanggal_pinjam' => 'required|date',
            'jatuh_tempo' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $data->update([
            'nama_peminjam' => $request->nama_peminjam,
            'id_buku' => $request->id_buku,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'jatuh_tempo' => $request->jatuh_tempo,
        ]);

        return redirect()->route('peminjaman.index');
    }

    public function destroy(string $id)
    {
        Peminjaman::destroy($id);

        return redirect()->route('peminjaman.index');
    }
}
