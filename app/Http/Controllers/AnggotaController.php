<?php

namespace App\Http\Controllers;

use App\Helpers\XorCipher;
use App\Models\Anggota;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    private function decryptAnggota($anggota)
    {
        if (! $anggota) {
            return $anggota;
        }

        if (! empty($anggota->alamat)) {
            $anggota->alamat = XorCipher::decrypt($anggota->alamat);
        }

        return $anggota;
    }

    public function index()
    {
        $data = Anggota::all();

        foreach ($data as $anggota) {
            $this->decryptAnggota($anggota);
        }

        return view('anggota.index', compact('data'));
    }

    public function create()
    {
        $anggota = Anggota::whereNull('id_pengguna')->get();

        return view('anggota.create', compact('anggota'));
    }

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
            'password' => XorCipher::encrypt($request->password),
            'role' => 'peminjam',
        ]);

        if ($request->id_anggota) {

            $anggota = Anggota::findOrFail($request->id_anggota);

            $anggota->update([
                'id_pengguna' => $pengguna->id_pengguna,
            ]);

        } else {

            Anggota::create([
                'nama' => $request->nama,

                'alamat' => $request->alamat
                    ? XorCipher::encrypt($request->alamat)
                    : null,

                'no_hp' => $request->no_hp,

                'id_pengguna' => $pengguna->id_pengguna,
            ]);
        }

        return redirect()->route('anggota.index');
    }

    public function show(string $id)
    {
        $data = Anggota::findOrFail($id);

        $this->decryptAnggota($data);

        return view('anggota.show', compact('data'));
    }

    public function edit(string $id)
    {
        $data = Anggota::findOrFail($id);

        $this->decryptAnggota($data);

        return view('anggota.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $data = Anggota::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:pengguna,username,'.
                ($data->id_pengguna ?? 'NULL').',id_pengguna',
            'password' => 'nullable|min:4',
            'alamat' => 'nullable',
            'no_hp' => 'nullable',
        ]);

        $data->update([
            'nama' => $request->nama,

            'alamat' => $request->alamat
                ? XorCipher::encrypt($request->alamat)
                : null,

            'no_hp' => $request->no_hp,
        ]);

        if (! $data->id_pengguna) {

            $pengguna = Pengguna::create([
                'username' => $request->username,
                'password' => XorCipher::encrypt($request->password),
                'role' => 'peminjam',
            ]);

            $data->update([
                'id_pengguna' => $pengguna->id_pengguna,
            ]);

        } else {

            $pengguna = Pengguna::find($data->id_pengguna);

            if ($pengguna) {

                $pengguna->username = $request->username;

                if ($request->password) {
                    $pengguna->password = XorCipher::encrypt($request->password);
                }

                $pengguna->save();
            }
        }

        return redirect()->route('anggota.index');
    }

    public function destroy(string $id)
    {
        Anggota::destroy($id);

        return redirect()->route('anggota.index');
    }

    public function cetakKartu($id)
    {
        $anggota = Anggota::findOrFail($id);

        return redirect()
            ->route('anggota.index')
            ->with('success', 'Kartu anggota '.$anggota->nama.' berhasil dicetak.');
    }
}
