@extends('layouts.app')
@section('content')
<div class="body-wrapper">
    <div class="container-fluid" style="padding: 45px;">
        <div class="d-flex justify-content-between align-item-center mt-4 mb-3">
            <h2>Daftar Kategori</h2>
            <a href="/admin/kategori/create" class="btn btn-primary">
                <i class="ti ti-plus"></i> Tambah Kategori
            </a>
        </div>

        <div class="table-responsive">
            <table class="table border table-hover">
                <thead class="table-dark ">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Kategori</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategori as $k)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$k->nama_kategori}}</td>>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="/admin/kategori/edit/{{$k->id}}" class="btn btn-warning btn-sm text-dark">
                                    Edit
                                </a>
                                <form action="/admin/kategori/delete/{{$k->id}}" method="POST" onsubmit="return confirm('Hapus kategori {{ $k->nama_kategori }}?')">
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