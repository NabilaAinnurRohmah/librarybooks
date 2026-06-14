<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::getAll();

        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        Kategori::insertData($request->except('_token'));

        return redirect()->route('kategori.index');
    }

    public function show($id)
    {
        $kategori = Kategori::getById($id);

        if (! $kategori) {
            abort(404);
        }

        return view('kategori.show', compact('kategori'));
    }

    public function edit($id)
    {
        $kategori = Kategori::getById($id);

        if (! $kategori) {
            abort(404);
        }

        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request,$id)
    {
        Kategori::updateData($id, $request->except('_token', '_method'));

        return redirect()->route('kategori.index');
    }

    public function destroy($id)
    {
        Kategori::deleteData($id);

        return redirect()->route('kategori.index');
    }
}
