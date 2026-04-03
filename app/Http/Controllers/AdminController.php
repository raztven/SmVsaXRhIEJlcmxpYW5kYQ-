<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\LogAktivitas;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index()
    {
        return view('admin.index');
    }

    public function logs()
    {
        $logs = LogAktivitas::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.logaktivitas', compact('logs'));
    }


    function pindex()
    {
        $peminjaman = Peminjaman::with(['user', 'alat'])->get();
        return view('admin.peminjaman.peminjaman', compact('peminjaman'));
    }

    function pincreate()
    {
        $users = User::all();
        $alat = Alat::all();
        return view('admin.peminjaman.create', compact('users', 'alat'));
    }

    function pinedit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $users = User::all();
        $alat = Alat::all();
        return view('admin.peminjaman.edit', compact('peminjaman', 'users', 'alat'));
    }

    function pinstore(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'alat_id' => 'required|exists:alat,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_rencana' => 'required|date',
            'jumlah_pinjam' => 'required|integer|min:1'
        ]);

        $alat = Alat::findOrFail($request->alat_id);

        if ($request->jumlah_pinjam > $alat->stok) {
            return back()->withInput()->withErrors(['jumlah_pinjam' => 'Stok alat tidak mencukupi! Tersedia: ' . $alat->stok]);
        }

        $peminjaman = Peminjaman::create([
            'user_id' => $request->user_id,
            'alat_id' => $request->alat_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_rencana' => $request->tanggal_rencana,
            'jumlah_pinjam' => $request->jumlah_pinjam,
            'status' => 'disetujui'
        ]);

        return redirect('/admin/peminjaman/');
    }


    function pinupdate(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'alat_id' => 'required|exists:alat,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_rencana' => 'required|date',
            'jumlah_pinjam' => 'required|integer|min:1',
            'status' => 'required'
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update($request->all());

        return redirect('/admin/peminjaman')->with('success', 'Data peminjaman berhasil diubah');
    }

    function pindestroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect('/admin/peminjaman')->with('success', 'Data peminjaman berhasil dihapus');
    }

    function kembali(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status === 'dikembalikan') {
            return back()->with('error', 'Alat ini sudah dikembalikan sebelumnya.');
        }

        $peminjaman->update([
            'status' => 'dikembalikan'
        ]);

        $alat = Alat::find($peminjaman->alat_id);
        if ($alat) {
            $alat->increment('stok', $peminjaman->jumlah_pinjam);
        }

        Pengembalian::create([
            'peminjaman_id' => $peminjaman->id,
            'tanggal_kembali' => now(),
            'denda' => 0
        ]);

        return redirect('/admin/pengembalian')->with('success', 'Alat berhasil dikembalikan dan stok telah diperbarui');
    }

    function penindex()
    {
        $pengembalian = Pengembalian::with('peminjaman.user', 'peminjaman.alat')->get();
        return view('admin.pengembalian.pengembalian', compact('pengembalian'));
    }

    function pencreate()
    {
        $peminjaman = Peminjaman::where('status', '!=', 'dikembalikan')->get();
        return view('admin.pengembalian.create', compact('peminjaman'));
    }

    function penstore(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjaman,id',
            'tanggal_kembali' => 'required|date',
            'denda' => 'required|numeric'
        ]);

        $peminjaman = Peminjaman::findOrFail($request->peminjaman_id);

        if ($peminjaman->status === 'dikembalikan') {
            return back()->with('error', 'Peminjaman ini sudah dikembalikan.');
        }

        $peminjaman->update(['status' => 'dikembalikan']);

        $alat = Alat::find($peminjaman->alat_id);
        if ($alat) {
            $alat->increment('stok', $peminjaman->jumlah_pinjam);
        }

        Pengembalian::create($request->all());

        return redirect('/admin/pengembalian')->with('success', 'Data pengembalian berhasil ditambah');
    }

    function penedit($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $peminjaman = Peminjaman::all();
        return view('admin.pengembalian.edit', compact('pengembalian', 'peminjaman'));
    }

    function penupdate(Request $request, $id)
    {
        $request->validate([
            'peminjaman_id' => 'required',
            'tanggal_kembali' => 'required|date',
            'denda' => 'required|numeric'
        ]);

        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->update($request->all());

        return redirect('/admin/pengembalian')->with('success', 'Data pengembalian berhasil diubah');
    }

    function pendestroy($id)
    {
        Pengembalian::findOrFail($id)->delete();
        return redirect('/admin/pengembalian')->with('success', 'Data pengembalian berhasil dihapus');
    }
}
