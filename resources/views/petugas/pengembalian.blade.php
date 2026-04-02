@extends('layouts.gas')
@section('content')
<div class="body-wrapper">
    <div class="container-fluid" style="padding: 45px;">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="d-flex justify-content-between align-item-center mt-4 mb-3">
            <h2>Daftar Pengembalian</h2>
        </div>

        <div class="table-responsive">
            <table class="table border table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Peminjam</th>
                        <th>Nama Alat</th>
                        <th>Tgl Kembali</th>
                        <th>Denda</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengembalian as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->peminjaman->user->name }}</td>
                        <td>{{ $p->peminjaman->alat->nama_alat }}</td>
                        <td>{{ $p->tanggal_kembali }}</td>
                        <td>Rp {{ number_format($p->denda, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection