@extends('layouts.app')
@section('content')
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="d-flex justify-content-between mb-4">
                <h2>Edit USER:{{$kategori ->nama_kategori}}</h2>
            </div>
            <div class="form">
                <form action="/admin/kategori/update/{{$kategori->id}}" method="post">
                    @csrf
                    @method('PUT')
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_kategori" value="{{$kategori->nama_kategori}}" placeholder="Masukkan Nama Lengkap">
                    <div class="d-flex mt-4">
                        <button type="submit" class="btn btn-info">Submit</button>
                        <a href="/admin/kategori" class="btn btn-danger">kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection