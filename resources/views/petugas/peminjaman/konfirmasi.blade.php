@extends('layouts.gas')

@section('content')
<div class="body-wrapper">
    <div class="container-fluid" style="padding: 45px;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Konfirmasi Peminjaman</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th width="150">Peminjam</th>
                                <td>: {{ $peminjaman->user->name }}</td>
                            </tr>
                            <tr>
                                <th>Alat</th>
                                <td>: {{ $peminjaman->alat->nama_alat }}</td>
                            </tr>
                            <tr>
                                <th>Jumlah Pinjam</th>
                                <td>: {{ $peminjaman->jumlah_pinjam }} Unit</td>
                            </tr>
                            <tr>
                                <th>Tgl Pinjam</th>
                                <td>: {{ $peminjaman->tanggal_pinjam }}</td>
                            </tr>
                            <tr>
                                <th>Rencana Kembali</th>
                                <td>: {{ $peminjaman->tanggal_rencana }}</td>
                            </tr>
                        </table>

                        <hr>

                        <form action="/petugas/peminjaman/{{ $peminjaman->id }}/update" method="POST">
                            @csrf
                            @method('PATCH')
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Pilih Aksi</label>
                                <select name="status" class="form-select" required>
                                    <option value="" selected disabled>-- Pilih Status --</option>
                                    <option value="disetujui">Setujui Peminjaman</option>
                                    <option value="ditolak">Tolak Peminjaman</option>
                                </select>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                                <a href="/petugas/peminjaman" class="btn btn-outline-secondary w-100">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
