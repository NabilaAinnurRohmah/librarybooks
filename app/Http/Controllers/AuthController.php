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

        if ($username == 'nabila' && $password == '1020') {
            session(['user' => $username]);

            return redirect()->route('dashboard');
        } else {
            return back()->with('error', 'Username atau Password Salah, Silahkan Cek Kembali');
        }
    }

    public function logout()
    {
        session()->forget('user');

        return redirect()->route('login');
    }
}
