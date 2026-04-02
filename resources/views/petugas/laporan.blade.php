@extends('layouts.gas')

@section('content')
<style>
    @media print {
        .no-print, .left-sidebar, .header-navbar {
            display: none !important;
        }
        .body-wrapper {
            margin-left: 0 !important;
            padding: 0 !important;
        }
        .container-fluid {
            padding: 0 !important;
        }
        .card {
            border: none !important;
            box-shadow: none !important;
        }
        .table-dark {
            background-color: #fff !important;
            color: #000 !important;
        }
        th, td {
            border: 1px solid #000 !important;
        }
    }
</style>

<div class="body-wrapper">
    <div class="container-fluid" style="padding: 45px;">
        <div class="d-flex justify-content-between align-items-center mt-4 mb-3 no-print">
            <div>
                <h2 class="fw-bold">Laporan Peminjaman Alat</h2>
                <p class="text-muted">Filter dan cetak laporan peminjaman alat.</p>
            </div>
            <div>
                <button onclick="window.print()" class="btn btn-primary">
                    <i class="ti ti-printer"></i> Cetak Laporan
                </button>
            </div>
        </div>

        <div class="card no-print mb-4">
            <div class="card-body">
                <form action="/petugas/laporan" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <label for="tgl_pinjam" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" value="{{ request('tgl_pinjam') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="tgl_kembali" class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" value="{{ request('tgl_kembali') }}">
                    </div>
                    <div class="col-md-4 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-secondary">Filter</button>
                        <a href="/petugas/laporan" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <div class="text-center mb-4 d-none d-print-block">
                    <h2 class="fw-bold">LAPORAN PEMINJAMAN ALAT</h2>
                    <p>Periode: {{ request('tgl_pinjam') ?? 'Semua' }} s/d {{ request('tgl_kembali') ?? 'Semua' }}</p>
                    <hr>
                </div>

                <div class="table-responsive">
                    <table class="table border table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Peminjam</th>
                                <th scope="col">Nama Alat</th>
                                <th scope="col">Tgl Pinjam</th>
                                <th scope="col">Tgl Kembali</th>
                                <th scope="col" class="text-center">Jumlah</th>
                                <th scope="col">Realisasi Kembali</th>
                                <th scope="col">Denda</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peminjaman as $i)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $i->user->name }}</strong></td>
                                <td>{{ $i->alat->nama_alat }}</td>
                                <td>{{ $i->tanggal_pinjam->format('d/m/Y') }}</td>
                                <td>{{ $i->tanggal_rencana->format('d/m/Y') }}</td>
                                <td class="text-center">{{ $i->jumlah_pinjam }}</td>
                                <td>
                                    @if($i->pengembalian)
                                        {{ \Carbon\Carbon::parse($i->pengembalian->tanggal_kembali)->format('d/m/Y') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($i->pengembalian)
                                        Rp {{ number_format($i->pengembalian->denda, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($i->status == 'pending')
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                    @elseif($i->status == 'disetujui')
                                    <span class="badge bg-success">Dipinjam</span>
                                    @elseif($i->status == 'dikembalikan')
                                    <span class="badge bg-primary">Selesai</span>
                                    @else
                                    <span class="badge bg-danger text-uppercase">{{ $i->status }}</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">Tidak ada data peminjaman ditemukan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-5 d-none d-print-block">
                    <div class="float-end text-center" style="width: 250px;">
                        <p>Dicetak pada: {{ date('d/m/Y H:i') }}</p>
                        <p>Petugas,</p>
                        <br><br><br>
                        <p class="fw-bold mb-0">{{ Auth::user()->name }}</p>
                        <p class="text-muted">NIP. .........................</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
