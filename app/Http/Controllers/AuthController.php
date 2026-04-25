<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        if ($username == 'admin' && $password == '123') {
            session([
                'user' => $username,
                'role' => 'admin',
            ]);

            return redirect()->route('dashboard');
        }

        if ($username == 'petugas' && $password == '1020') {
            session([
                'user' => $username,
                'role' => 'petugas',
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
