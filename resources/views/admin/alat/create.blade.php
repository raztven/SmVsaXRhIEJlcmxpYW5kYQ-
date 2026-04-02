@extends('layouts.app')
@section('content')
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="d-flex justify-content-between mb-4">
                <h2>Tambah Alat</h2>
            </div>
            <div class="form">
                <form action="/admin/alat/store" method="post">
                    @csrf
                    <label>Nama Alat</label>
                    <input type="text" name="nama_alat" placeholder="Masukkan Nama Lengkap" class="mt-2 mb-2"><br>

                    <label>Kategori</label>
                    <select name="kategori_id" id="" class="mt-2 mb-2">
                        @foreach($kategori as $k)
                        <option value="{{$k->id}}">{{$k->nama_kategori}}</option>
                        @endforeach
                    </select>
                    <br>
                    <label>Deskirpsi</label>
                    <textarea name="deskripsi" id="" class="mt-2 mb-2 "></textarea><br>

                    <label>Stok</label>
                    <input type="number" name="stok" placeholder="Masukkan Nama Lengkap" class="mt-2 mb-2"><br>
                    <div class="d-flex mt-4">
                        <button type="submit" class="btn btn-info">Submit</button>
                        <a href="/admin/alat" class="btn btn-danger">kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection