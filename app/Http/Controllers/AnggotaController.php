<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Anggota::all();

        if (session('role') == 'admin') {
            return view('anggota.index_admin', compact('data'));
        }

        return view('anggota.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'nullable',
            'no_hp' => 'nullable',
        ]);

        Anggota::create($request->all());

        return redirect()->route('anggota.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Anggota::findOrFail($id);

        return view('anggota.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Anggota::findOrFail($id);

        return view('anggota.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Anggota::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'alamat' => 'nullable',
            'no_hp' => 'nullable',
        ]);

        $data->update($request->all());

        return redirect()->route('anggota.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Anggota::destroy($id);

        return redirect()->route('anggota.index');
    }
}
