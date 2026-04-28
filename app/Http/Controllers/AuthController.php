<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $pengguna = Pengguna::cekLogin($request->username, $request->password);

        if (! $pengguna) {
            return back()->with('error', 'Username atau Password salah');
        }

        $anggota = null;

        if ($pengguna->role === 'peminjam') {
            $anggota = Anggota::where('id_pengguna', $pengguna->id_pengguna)->first();

            if (! $anggota) {
                return back()->with('error', 'Akun peminjam belum terhubung dengan data anggota');
            }
        }

        session([
            'id_user' => $pengguna->id_pengguna,
            'user' => $pengguna->username,
            'role' => $pengguna->role,
            'id_anggota' => $anggota->id_anggota ?? null,
            'nama' => $anggota->nama ?? null,
        ]);

        return redirect()->route(
            $pengguna->role == 'admin' ? 'dashboard' : 'peminjam.buku'
        );
    }

    public function logout()
    {
        session()->flush();

        return redirect()->route('login');
    }
}
