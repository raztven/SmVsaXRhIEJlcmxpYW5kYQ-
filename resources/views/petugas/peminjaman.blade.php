@extends('layouts.gas')

@section('content')
<div class="body-wrapper">
    <div class="container-fluid" style="padding: 45px;">
        <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
            <div>
                <h2 class="fw-bold">Persetujuan Peminjaman Alat</h2>
                <p class="text-muted">Kelola pengajuan dan proses pengembalian alat oleh user.</p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table border table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Peminjam</th>
                        <th scope="col">Alat</th>
                        <th scope="col">Tgl Pinjam</th>
                        <th scope="col">Batas Kembali</th>
                        <th scope="col" class="text-center">Jumlah</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Aksi Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjaman as $i)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $i->user->name }}</strong></td>
                        <td>{{ $i->alat->nama_alat }}</td>
                        <td>{{ $i->tanggal_pinjam }}</td>
                        <td>{{ $i->tanggal_rencana }}</td>
                        <td class="text-center">{{ $i->jumlah_pinjam }}</td>
                        <td>
                            @if($i->status == 'pending')
                            <span class="badge bg-warning text-dark">Menunggu</span>
                            @elseif($i->status == 'disetujui')
                            <span class="badge bg-success">Dipinjam</span>
                            @elseif($i->status == 'dikembalikan')
                            <span class="badge bg-primary">Selesai</span>
                            @else
                            <span class="badge bg-danger">{{ $i->status }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                {{-- Tombol untuk Menyetujui Pengajuan Baru --}}
                                @if($i->status == 'pending')
                                <a href="/petugas/peminjaman/{{ $i->id }}/konfirmasi" class="btn btn-primary btn-sm">
                                    <i class="ti ti-check"></i> Konfirmasi
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection