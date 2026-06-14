<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $data = Anggota::getAll();

        foreach ($data as $anggota) {

            if (! empty($anggota->alamat)) {

                $anggota->alamat = Pengguna::decrypt( $anggota->alamat );
            }
        }

        return view( 'anggota.index', compact('data'));
    }

    public function create()
    {
        $anggota = Anggota::getWithoutPengguna();

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
        ],
        ['username.unique' => 'Username sudah digunakan.',]);

        $id_pengguna = Pengguna::insertData([
            'username' => $request->username,
            'password' => Pengguna::encrypt($request->password),
            'role' => 'peminjam',
        ]);

        if ($request->id_anggota) {

            Anggota::updateData(
                $request->id_anggota,
                [
                    'id_pengguna' => $id_pengguna,
                ]
            );

        } else {

            Anggota::insertData([
                'nama' => $request->nama,
                'alamat' => $request->alamat ? Pengguna::encrypt($request->alamat) : null,
                'no_hp' => $request->no_hp,
                'id_pengguna' => $id_pengguna,
            ]);

        }

        return redirect()->route('anggota.index');
    }

    public function show(string $id)
    {
        $data = Anggota::getById($id);

        if (! $data) {
            abort(404);
        }

        if (! empty($data->alamat)) {

            $data->alamat = Pengguna::decrypt( $data->alamat );
        }

        return view('anggota.show', compact('data'));
    }

    public function edit(string $id)
    {
        $data = Anggota::getById($id);

        if (! $data) {
            abort(404);
        }

        if (! empty($data->alamat)) {

            $data->alamat = Pengguna::decrypt( $data->alamat );
        }

        return view('anggota.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $data = Anggota::getById($id);

        if (! $data) {
            abort(404);
        }

        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:pengguna,username,'. ($data->id_pengguna ?? 'NULL'). ',id_pengguna',
            'password' => 'nullable|min:4',
            'alamat' => 'nullable',
            'no_hp' => 'nullable',
        ]);

        Anggota::updateData($id, [
            'nama' => $request->nama,
            'alamat' => $request->alamat ? Pengguna::encrypt($request->alamat) : null,
            'no_hp' => $request->no_hp,
        ]);

        if (! $data->id_pengguna) {

            $id_pengguna = Pengguna::insertData([
                'username' => $request->username,
                'password' => Pengguna::encrypt($request->password),
                'role' => 'peminjam',
            ]);

            Anggota::updateData($id, [
                'id_pengguna' => $id_pengguna,
            ]);

        } else {

            $pengguna = Pengguna::getById($data->id_pengguna);

            if ($pengguna) {

                $updateData = [
                    'username' => $request->username,
                ];

                if ($request->password) {

                    $updateData['password'] = Pengguna::encrypt( $request->password );
                }

                Pengguna::updateData(
                    $data->id_pengguna,
                    $updateData
                );
            }
        }

        return redirect()->route('anggota.index');
    }

    public function destroy(string $id)
    {
        Anggota::deleteData($id);

        return redirect()->route('anggota.index');
    }

    public function cetakKartu($id)
    {
        $anggota = Anggota::getById($id);

        if (! $anggota) {
            abort(404);
        }

        return redirect()
            ->route('anggota.index')
            ->with(
                'success', 'Kartu anggota '. $anggota->nama.' berhasil dicetak.'
            );
    }
}
