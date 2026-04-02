@extends('layouts.app')
@section('content')
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="d-flex justify-content-between mb-4">
                <h2>Tambah USER</h2>
            </div>
            <div class="form">
                <form action="/admin/user/store" method="post">
                    @csrf
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" placeholder="Masukkan Nama Lengkap" class="mt-2 mb-2"><br>

                    <label>Email</label>
                    <input type="email" name="email" placeholder="Masukkan Email" class="mt-2 mb-2"><br>

                    <label>Password</label>
                    <input type="password" name="password" placeholder="Masukkan Password" class="mt-2 mb-2"><br>

                    <select name="role" id="" class="mt-2 mb-2">
                        <option value="admin">Admin</option>
                        <option value="petugas">Petugas</option>
                        <option value="peminjam">Peminjam</option>
                    </select>

                    <div class="d-flex mt-4">
                        <button type="submit" class="btn btn-info">Submit</button>
                        <a href="/admin/user" class="btn btn-danger">kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection