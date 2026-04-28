<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Anggota::all();

        return view('anggota.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:pengguna,username',
            'password' => 'required|min:4',
            'alamat' => 'nullable',
            'no_hp' => 'nullable',
        ]);

        $pengguna = Pengguna::create([
            'username' => $request->username,
            'password' => $request->password,
            'role' => 'peminjam',
        ]);

        Anggota::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'id_pengguna' => $pengguna->id_pengguna,
        ]);

        return redirect()->route('anggota.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Anggota::findOrFail($id);

        return view('anggota.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Anggota::findOrFail($id);

        return view('anggota.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Anggota::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:pengguna,username,'.$data->id_pengguna.',id_pengguna',
            'password' => 'nullable|min:4',
            'alamat' => 'nullable',
            'no_hp' => 'nullable',
        ]);

        $data->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        $pengguna = Pengguna::find($data->id_pengguna);

        if ($pengguna) {
            $pengguna->username = $request->username;

            if ($request->password) {
                $pengguna->password = $request->password;
            }

            $pengguna->save();
        }

        return redirect()->route('anggota.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Anggota::destroy($id);

        return redirect()->route('anggota.index');
    }
}
