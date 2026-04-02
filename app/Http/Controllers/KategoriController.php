<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    function index()
    {
        $kategori = Kategori::all();
        return view('admin.kategori.kategori', compact('kategori'));
    }

    function create()
    {
        return view('admin.kategori.create');
    }

    function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        $kategori = Kategori::create($request->all());
        return redirect('/admin/kategori');
    }

    function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        $kategori->nama_kategori = $request->nama_kategori;

        $kategori->save();

        return redirect('/admin/kategori');
    }

    function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $name = $kategori->nama_kategori;

        $kategori->delete();
        return redirect('/admin/kategori');
    }
}
