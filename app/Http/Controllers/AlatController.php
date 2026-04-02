<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    function index()
    {
        $alat = Alat::with('kategori')->get();
        return view('admin.alat.alat', compact('alat'));
    }

    function create()
    {
        $kategori = Kategori::all();
        return view('admin.alat.create', compact('kategori'));
    }

    function edit($id)
    {
        $alat = Alat::findOrFail($id);
        $kategori = Kategori::all();
        return view('admin.alat.edit', compact('alat', 'kategori'));
    }

    function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required',
            'nama_alat' => 'required|string|max:255',
            'deskripsi' => 'required',
            'stok' => 'required|integer'
        ]);

        Alat::create($request->all());

        return redirect('/admin/alat');
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'kategori_id' => 'required',
            'nama_alat' => 'required|string|max:255',
            'deskripsi' => 'required',
            'stok' => 'required|integer'
        ]);

        $alat = Alat::findOrFail($id);
        $alat->update($request->all());

        return redirect('/admin/alat');
    }

    function destroy($id)
    {
        $alat = Alat::findOrFail($id);
        $name = $alat->nama_alat;
        $alat->delete();

        return redirect()->back();
    }
}
