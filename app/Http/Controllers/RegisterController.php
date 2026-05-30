<?php

namespace App\Http\Controllers;

use App\Helpers\XorCipher;
use App\Models\Anggota;
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

        Anggota::create([
            'nama' => $request->nama,

            'alamat' => $request->alamat
                ? XorCipher::encrypt($request->alamat)
                : null,

            'no_hp' => $request->no_hp,

            'id_pengguna' => null,
        ]);

        return redirect()->route('login')
            ->with('success', 'Pendaftaran berhasil, silahkan mendatangi petugas untuk mendapatkan akun');
    }
}
