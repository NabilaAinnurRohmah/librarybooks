<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Rak;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::getAll();

        return view( 'buku.index', compact('buku')
        );
    }

    public function create()
    {
        $kategori = Kategori::getAll();

        $rak = Rak::getAll();

        return view('buku.create', compact( 'kategori', 'rak')
        );
    }

    public function store(Request $request)
    {
        Buku::insertData( $request->except('_token') );

        return redirect()->route('buku.index');
    }

    public function show($id)
    {
        $buku = Buku::getById($id);

        if (! $buku) {
            abort(404);
        }

        return view( 'buku.show', compact('buku') );
    }

    public function edit($id)
    {
        $buku = Buku::getById($id);

        if (! $buku) {
            abort(404);
        }

        $kategori = Kategori::getAll();

        $rak = Rak::getAll();

        return view( 'buku.edit', compact( 'buku', 'kategori', 'rak') );
    }

    public function update( Request $request, $id)
    {
        Buku::updateData( $id, $request->except('_token', '_method') );

        return redirect()->route('buku.index');
    }

    public function destroy($id)
    {
        Buku::deleteData($id);

        return redirect()->route('buku.index');
    }
}
