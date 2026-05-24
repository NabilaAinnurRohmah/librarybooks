<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use Illuminate\Http\Request;

class RakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rak = Rak::with('buku');

        if ($request->search) {
            $rak->search($request->search);
        }

        $rak = $rak->get();

        return view('rak.index', compact('rak'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rak.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_rak' => 'required',
            'lokasi' => 'required',
        ]);

        Rak::create($request->all());

        return redirect()->route('rak.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rak = Rak::with('buku')->findOrFail($id);

        return view('rak.show', compact('rak'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rak = Rak::findOrFail($id);

        return view('rak.edit', compact('rak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rak = Rak::findOrFail($id);

        $request->validate([
            'nama_rak' => 'required',
            'lokasi' => 'required',
        ]);

        $rak->update($request->all());

        return redirect()->route('rak.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Rak::destroy($id);

        return redirect()->route('rak.index');
    }
}
