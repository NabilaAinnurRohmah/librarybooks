<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'nullable',
            'no_hp' => 'nullable',
        ]);

        Anggota::insertData([
            'nama' => $request->nama,
            'alamat' => $request->alamat ? Pengguna::encrypt($request->alamat) : null,
            'no_hp' => $request->no_hp,
            'id_pengguna' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('login')->with(
                'success', 'Pendaftaran berhasil, silahkan mendatangi petugas untuk mendapatkan akun');
    }
}
