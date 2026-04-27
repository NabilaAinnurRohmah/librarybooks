<?php

namespace App\Http\Controllers;

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

        if ($pengguna) {
            session([
                'user' => $pengguna->username,
                'role' => $pengguna->role,
            ]);

            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Username atau Password salah');
    }

    public function logout()
    {
        session()->flush();

        return redirect()->route('login');
    }
}
