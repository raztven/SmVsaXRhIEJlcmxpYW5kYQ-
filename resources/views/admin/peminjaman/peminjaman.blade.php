@extends('layouts.app')
@section('content')
<div class="body-wrapper">
    <div class="container-fluid" style="padding: 45px;">
        <div class="d-flex justify-content-between align-item-center mt-4 mb-3">
            <h2>Daftar Peminjam</h2>
            <a href="/admin/peminjaman/create" class="btn btn-primary">
                <i class="ti ti-plus"></i> Tambah Peminjam
            </a>
        </div>

        <div class="table-responsive">
            <table class="table border table-hover">
                <thead class="table-dark ">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Peminjam</th>
                        <th scope="col">Alat</th>
                        <th scope="col">Tgl Pinjam</th>
                        <th scope="col">Batas Kembali</th>
                        <th scope="col">Jumlah Pinjam</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjaman as $i)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$i->user ->name}}</td>
                        <td>{{$i->alat ->nama_alat}}</td>
                        <td>{{$i->tanggal_pinjam}}</td>
                        <td>{{$i->tanggal_rencana}}</td>
                        <td>{{$i->jumlah_pinjam}}</td>
                        <td>{{$i->status}}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                @if($i->status == 'disetujui')
                                <form action="/admin/kembali/{{$i->id}}" method="POST" onsubmit="return confirm('Proses pengembalian alat ini?')">
                                    @csrf
                                    <button type="submit" class="btn btn-info btn-sm text-white">
                                        Kembalikan
                                    </button>
                                </form>
                                @endif
                                <a href="/admin/peminjaman/edit/{{$i->id}}" class="btn btn-warning btn-sm text-dark">
                                    Edit
                                </a>
                                <form action="/admin/peminjaman/delete/{{$i->id}}" method="POST" onsubmit="return confirm('Hapus peminjaman {{ $i->user->name  }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
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