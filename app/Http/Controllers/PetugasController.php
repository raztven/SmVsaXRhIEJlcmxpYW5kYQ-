<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function index()
    {

        $peminjaman = Peminjaman::with(['user', 'alat'])->latest()->get();
        return view('petugas.peminjaman', compact('peminjaman'));
    }


    public function edit($id)
    {
        $peminjaman = Peminjaman::with(['user', 'alat'])->findOrFail($id);

        return view('petugas.peminjaman.konfirmasi', compact('peminjaman'));
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak,dikembalikan',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $alat = Alat::findOrFail($peminjaman->alat_id);


        if ($request->status == 'disetujui' && $peminjaman->status != 'disetujui') {
            if ($alat->stok < $peminjaman->jumlah_pinjam) {
                return back()->with('error', 'Stok alat tidak mencukupi untuk disetujui!');
            }
            $alat->decrement('stok', $peminjaman->jumlah_pinjam);
        }

        if ($request->status == 'dikembalikan' && $peminjaman->status == 'disetujui') {
            $alat->increment('stok', $peminjaman->jumlah_pinjam);
        }

        $peminjaman->update([
            'status' => $request->status
        ]);

        return redirect('/petugas/peminjaman')->with('success', 'Status peminjaman berhasil diperbarui');
    }



    function pengembalian()
    {
        $pengembalian = Pengembalian::with('peminjaman.user', 'peminjaman.alat')->get();
        return view('petugas.pengembalian', compact('pengembalian'));
    }

    public function laporan(Request $request)
    {
        $tgl_pinjam = $request->tgl_pinjam;
        $tgl_kembali = $request->tgl_kembali;

        $query = Peminjaman::with(['user', 'alat', 'pengembalian'])->orderBy('created_at', 'desc');

        if ($tgl_pinjam && $tgl_kembali) {
            $query->whereBetween('tgl_pinjam', [$tgl_pinjam, $tgl_kembali]);
        }

        $peminjaman = $query->get();
    }

    public function cetakLaporan()
    {
        $peminjaman = Peminjaman::with(['user', 'alat'])->latest()->get();

        return view('petugas.laporan', compact('peminjaman'));
    }
}
