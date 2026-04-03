<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\LogAktivitas;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PeminjamController extends Controller
{
    function index()
    {
        $peminjaman = Peminjaman::where('user_id', Auth::id())->latest()->get();
        return view('peminjam.index', compact('peminjaman'));
    }

    function alat()
    {
        $alat = Alat::with('kategori')->get();
        return view('peminjam.alat', compact('alat'));
    }

    function create()
    {
        $alat = Alat::where('stok', '>', 0)->get();
        return view('peminjam.create', compact('alat'));
    }

    function store(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:alat,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_rencana' => 'required|date|after:tanggal_pinjam',
            'jumlah_pinjam' => 'required|integer|min:1'
        ]);

        $alat = Alat::findOrFail($request->alat_id);

        if ($request->jumlah_pinjam > $alat->stok) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        Peminjaman::create([
            'user_id' => Auth::id(),
            'alat_id' => $request->alat_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_rencana' => $request->tanggal_rencana,
            'jumlah_pinjam' => $request->jumlah_pinjam,
            'status' => 'pending'
        ]);

        LogAktivitas::record('Peminjaman', 'User ' . Auth::user()->name . ' mengajukan peminjaman alat ' . $alat->nama_alat);

        return redirect('/peminjam')->with('success', 'Pengajuan berhasil dikirim.');
    }

    function kembali($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        // Tambah stok alat kembali
        $peminjaman->alat->increment('stok', $peminjaman->jumlah_pinjam);
        
        $peminjaman->update(['status' => 'dikembalikan']);

        LogAktivitas::record('Pengembalian', 'User ' . Auth::user()->name . ' mengembalikan alat ' . $peminjaman->alat->nama_alat);

        return redirect()->back()->with('success', 'Berhasil dikembalikan.');
    }
}
