<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!session()->has('user')){
            return redirect('/login');
        }
        $buku = Buku::with('kategori')->get();
        return view('buku.index', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori= Kategori::all();
        return view('buku.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Buku::create($request->all());
        return redirect()->route('buku.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
         $buku = Buku::with('kategori')->find($id);
    return view('buku.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $buku = Buku::find($id);
        $kategori = Kategori::all();
        return view('buku.edit', compact('buku', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $buku = Buku::find($id);
        $buku->update($request->all());

        return redirect()->route('buku.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Buku::destroy($id);
        return redirect()->route('buku.index');
    }
}
