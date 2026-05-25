<?php

namespace App\Http\Controllers;

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
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'id_pengguna' => null,
        ]);

        return redirect()->route('login')
            ->with('success', 'Pendaftaran berhasil, Silahkan mendatangi petugas untuk mendapatkan akun');
    }
}
