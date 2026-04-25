<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalBuku' => Buku::count(),
            'totalKategori' => Kategori::count(),

            'totalDipinjam' => Peminjaman::where('status', 'dipinjam')->count(),
            'totalDikembalikan' => Peminjaman::where('status', 'dikembalikan')->count(),

            'bukuTerbaru' => Buku::latest()->take(5)->get(),
        ]);
    }
}
