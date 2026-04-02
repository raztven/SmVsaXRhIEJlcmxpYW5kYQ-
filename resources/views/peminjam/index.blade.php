@extends('layouts.jam')

@section('content')
<div class="body-wrapper">
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between mb-4">
            <h2 class="fw-bold">Riwayat Peminjaman</h2>
            <a href="/peminjam/create" class="btn btn-primary shadow-sm">
                <i class="ti ti-plus"></i> Ajukan Pinjam
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Alat</th>
                                <th>Jumlah</th>
                                <th>Tgl Pinjam</th>
                                <th>Tgl Kembali</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peminjaman as $i)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $i->alat->nama_alat }}</td>
                                <td>{{ $i->jumlah_pinjam }} Unit</td>
                                <td>{{ $i->tanggal_pinjam }}</td>
                                <td>{{ $i->tanggal_rencana }}</td>
                                <td>
                                    @if($i->status == 'pending')
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                    @elseif($i->status == 'disetujui')
                                    <span class="badge bg-success">Dipinjam</span>
                                    @elseif($i->status == 'ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                    @else
                                    <span class="badge bg-secondary">Dikembalikan</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($i->status == 'disetujui')
                                    <form action="/peminjam/kembali/{{ $i->id }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-info btn-sm text-white" onclick="return confirm('Kembalikan alat?')">Kembalikan</button>
                                    </form>
                                    @else
                                    -
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada riwayat peminjaman.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection