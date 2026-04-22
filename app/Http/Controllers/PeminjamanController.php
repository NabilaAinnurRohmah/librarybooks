<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Peminjaman::with('buku');

        if ($request->search) {
            $query->search($request->search);
        }

        $data = $query->get();

        return view('peminjaman.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $buku = Buku::all();

        return view('peminjaman.create', compact('buku'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam' => 'required',
            'id_buku' => 'required',
        ]);

        $buku = Buku::findOrFail($request->id_buku);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis!');
        }

        $buku->decrement('stok');

        Peminjaman::create([
            'nama_peminjam' => $request->nama_peminjam,
            'id_buku' => $request->id_buku,
            'tanggal_pinjam' => now(),
            'status' => 'dipinjam',
        ]);

        return redirect()->route('peminjaman.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Peminjaman::with('buku')->findOrFail($id);

        return view('peminjaman.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Peminjaman::find($id);
        $buku = Buku::all();

        return view('peminjaman.edit', compact('data', 'buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Peminjaman::find($id);

        $request->validate([
            'nama_peminjam' => 'required',
            'id_buku' => 'required',
        ]);

        $data->update([
            'nama_peminjam' => $request->nama_peminjam,
            'id_buku' => $request->id_buku,
        ]);

        return redirect()->route('peminjaman.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Peminjaman::destroy($id);

        return redirect()->route('peminjaman.index');
    }
}
