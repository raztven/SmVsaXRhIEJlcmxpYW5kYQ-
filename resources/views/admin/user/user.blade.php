@extends('layouts.app')
@section('content')
<div class="body-wrapper">
    <div class="container-fluid" style="padding: 45px;">
        <div class="d-flex justify-content-between align-item-center mt-4 mb-3">
            <h2>Daftar User</h2>
            <a href="/admin/user/create" class="btn btn-primary">
                <i class="ti ti-plus"></i> Tambah User
            </a>
        </div>

        <div class="table-responsive">
            <table class="table border table-hover">
                <thead class="table-dark ">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user as $i)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$i->name}}</td>
                        <td>{{$i->email}}</td>
                        <td>{{$i->role}}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="/admin/user/edit/{{$i->id}}" class="btn btn-warning btn-sm text-dark">
                                    Edit
                                </a>
                                <form action="/admin/user/delete/{{$i->id}}" method="POST" onsubmit="return confirm('Hapus user {{ $i->name }}?')">
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