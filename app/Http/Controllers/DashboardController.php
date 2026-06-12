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
            'totalBuku' => Buku::countData(),

            'totalKategori' => Kategori::countData(),

            'totalDipinjam' => Peminjaman::countByStatus(
                'dipinjam'
            ),

            'totalDikembalikan' => Peminjaman::countByStatus(
                'dikembalikan'
            ),

            'bukuTerbaru' => Buku::getLatest(5),
        ]);
    }
}
