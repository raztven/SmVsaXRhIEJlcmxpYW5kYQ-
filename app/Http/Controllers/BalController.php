namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamController extends Controller
{
/**
* Menampilkan daftar alat yang tersedia untuk dipinjam
*/
public function indexAlat()
{
$alats = Alat::where('stok', '>', 0)->get();
return view('peminjam.alat.index', compact('alats'));
}

/**
* Form pengajuan peminjaman untuk alat tertentu
*/
public function formPinjam($id)
{
$alat = Alat::findOrFail($id);
return view('peminjam.peminjaman.create', compact('alat'));
}

/**
* Menyimpan pengajuan peminjaman (Status default: pending)
*/
public function storePeminjaman(Request $request)
{
$request->validate([
'alat_id' => 'required|exists:alat,id',
'tanggal_pinjam' => 'required|date|after_or_equal:today',
'tanggal_rencana' => 'required|date|after:tanggal_pinjam',
'jumlah_pinjam' => 'required|integer|min:1'
]);

$alat = Alat::findOrFail($request->alat_id);

// Cek apakah stok mencukupi
if ($request->jumlah_pinjam > $alat->stok) {
return back()->withErrors(['jumlah_pinjam' => 'Stok tidak mencukupi. Tersedia: ' . $alat->stok]);
}

Peminjaman::create([
'user_id' => Auth::id(), // Otomatis mengambil ID user yang login
'alat_id' => $request->alat_id,
'tanggal_pinjam' => $request->tanggal_pinjam,
'tanggal_rencana' => $request->tanggal_rencana,
'jumlah_pinjam' => $request->jumlah_pinjam,
'status' => 'pending' // Status awal selalu pending agar disetujui petugas nanti
]);

return redirect('/peminjam/riwayat')->with('success', 'Pengajuan berhasil dikirim. Tunggu konfirmasi petugas.');
}

/**
* Melihat riwayat peminjaman milik user yang sedang login
*/
public function riwayat()
{
$riwayat = Peminjaman::with('alat')
->where('user_id', Auth::id())
->latest()
->get();

return view('peminjam.peminjaman.riwayat', compact('riwayat'));
}
}