<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Rak;
use Illuminate\Http\Request;

class RakController extends Controller
{
    public function index()
    {
        $rak = Rak::getAllWithBuku();

        return view(
            'rak.index',
            compact('rak')
        );
    }

    public function create()
    {
        return view('rak.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_rak' => 'required',
            'lokasi' => 'required',
        ]);

        Rak::insertData([
            'nama_rak' => $request->nama_rak,
            'lokasi' => $request->lokasi,
        ]);

        return redirect()
            ->route('rak.index');
    }

    public function show($id)
    {
        $rak = Rak::getById($id);

        $buku = Buku::getByRak($id);

        return view(
            'rak.show',
            compact('rak', 'buku')
        );
    }

    public function edit($id)
    {
        $rak = Rak::getById($id);

        if (! $rak) {
            abort(404);
        }

        return view(
            'rak.edit',
            compact('rak')
        );
    }

    public function update(
        Request $request,
        $id
    ) {
        $request->validate([
            'nama_rak' => 'required',
            'lokasi' => 'required',
        ]);

        Rak::updateData(
            $id,
            [
                'nama_rak' => $request->nama_rak,
                'lokasi' => $request->lokasi,
            ]
        );

        return redirect()
            ->route('rak.index');
    }

    public function destroy($id)
    {
        Rak::deleteData($id);

        return redirect()
            ->route('rak.index');
    }
}
