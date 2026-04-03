@extends('layouts.app')
@section('content')
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="d-flex justify-content-between mb-4">
                <h2>Edit Alat</h2>
            </div>
            <div class="form">
                <form action="/admin/alat/update/{{ $alat->id }}" method="post">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label">Nama Alat</label>
                        <input type="text" name="nama_alat" value="{{ $alat->nama_alat }}" placeholder="Masukkan Nama Alat" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori_id" class="form-control" required>
                            @foreach($kategori as $k)
                            <option value="{{ $k->id }}" {{ $alat->kategori_id == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3" required>{{ $alat->deskripsi }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" value="{{ $alat->stok }}" placeholder="Masukkan Jumlah Stok" class="form-control" required>
                    </div>

                    <div class="d-flex mt-4 gap-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="/admin/alat" class="btn btn-danger">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection