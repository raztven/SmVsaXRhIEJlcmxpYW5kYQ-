@extends('layouts.app')
@section('content')
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="d-flex justify-content-between mb-4">
                <h2>Edit USER:{{$user ->name}}</h2>
            </div>
            <div class="form">
                <form action="/admin/user/update/{{$user->id}}" method="post">
                    @csrf
                    @method('PUT')
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" value="{{$user->name}}" placeholder="Masukkan Nama Lengkap">

                    <label>Email</label>
                    <input type="email" name="email" value="{{$user->email}}" placeholder="Masukkan Email">

                    <label>Password</label>
                    <input type="password" name="password" placeholder="Masukkan Password">

                    <label class="form-label">Role</label>
                    <select name="role" class="form-select">
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
                        <option value="peminjam" {{ $user->role == 'peminjam' ? 'selected' : '' }}>Peminjam</option>
                    </select>

                    <button type="submit" class="btn btn-info">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection