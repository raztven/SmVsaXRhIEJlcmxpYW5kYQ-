@extends('layouts.app')
@section('content')
<div class="body-wrapper">
    <div class="container-fluid" style="padding: 45px;">
        <div class="d-flex justify-content-between align-item-center mt-4 mb-3">
            <h2>Daftar Alat</h2>
            <a href="/admin/alat/create" class="btn btn-primary">
                <i class="ti ti-plus"></i> Tambah Alat
            </a>
        </div>

        <div class="table-responsive">
            <table class="table border table-hover">
                <thead class="table-dark ">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Alat</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alat as $a)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$a->nama_alat}}</td>>
                        <td>{{$a->kategori->nama_kategori}}</td>>
                        <td>{{$a->deskripsi}}</td>>
                        <td>{{$a->stok}}</td>>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="/admin/alat/edit/{{$a->id}}" class="btn btn-warning btn-sm text-dark">
                                    Edit
                                </a>
                                <form action="/admin/alat/delete/{{$a->id}}" method="POST" onsubmit="return confirm('Hapus alat {{ $a->nama_kategori }}?')">
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