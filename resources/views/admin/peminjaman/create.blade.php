@extends('layouts.app')
@section('content')
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="d-flex justify-content-between mb-4">
                <h2>Tambah Alat</h2>
            </div>
            <div class="form">
                <form action="/admin/peminjaman/store" method="post">
                    @csrf
                    <label>Peminjam</label>
                    <select name="user_id" id="" class="mt-2 mb-2">
                        @foreach($users as $u)
                        <option value="{{$u->id}}">{{$u->name}}</option>
                        @endforeach
                    </select>

                    <label>Alat</label>
                    <select name="alat_id" id="" class="mt-2 mb-2">
                        @foreach($alat as $k)
                        <option value="{{$k->id}}">{{$k->nama_alat}}</option>
                        @endforeach
                    </select>
                    <br>
                    <label>Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" class="mt-2 mb-2"><br>

                    <label>Tanggal Rencana Kembali</label>
                    <input type="date" name="tanggal_rencana" class="mt-2 mb-2"><br>

                    <label>Jumlah</label>
                    <input type="number" name="jumlah_pinjam" placeholder="Masukkan Nama Lengkap" class="mt-2 mb-2"><br>

                    <div class="d-flex mt-4">
                        <button type="submit" class="btn btn-info">Submit</button>
                        <a href="/admin/peminjaman" class="btn btn-danger">kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection