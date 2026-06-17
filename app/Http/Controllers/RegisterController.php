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
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        Anggota::insertData([
            'nama' => $request->nama,
            'alamat' => Pengguna::encrypt($request->alamat),
            'no_hp' => $request->no_hp,
            'id_pengguna' => null,
        ]);

        return redirect()->route('login')->with(
                'success', 'Pendaftaran berhasil, silahkan mendatangi petugas untuk mendapatkan akun');
    }
}
