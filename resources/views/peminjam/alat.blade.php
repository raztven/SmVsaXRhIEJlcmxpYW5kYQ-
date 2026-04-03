@extends('layouts.jam')

@section('content')
<div class="body-wrapper">
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between mb-4">
            <h2 class="fw-bold">Daftar Alat</h2>
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
                                <th>Nama Alat</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th>Stok</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($alat as $a)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $a->nama_alat }}</td>
                                <td>{{ $a->kategori->nama_kategori }}</td>
                                <td>{{ $a->deskripsi }}</td>
                                <td>{{ $a->stok }} Unit</td>
                                <td class="text-center">
                                    @if($a->stok > 0)
                                    <a href="/peminjam/create?alat_id={{ $a->id }}" class="btn btn-outline-primary btn-sm">Pinjam</a>
                                    @else
                                    <span class="badge bg-danger">Habis</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data alat.</td>
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
