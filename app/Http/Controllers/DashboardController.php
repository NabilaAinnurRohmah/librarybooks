<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;

class DashboardController extends Controller
{
    public function index()
    {
        if (! session()->has('user')) {
            return redirect('/login');
        }

        return view('dashboard',
            [
                'totalBuku' => Buku::count(),
                'totalKategori' => Kategori::count(),
                'bukuTerbaru' => Buku::latest()->take(5)->get(),
            ]);

    }
}
