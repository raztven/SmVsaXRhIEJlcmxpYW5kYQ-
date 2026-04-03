@extends('layouts.app')
@section('content')
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="d-flex justify-content-between mb-4">
                <h2>Edit Pengembalian</h2>
            </div>
            <div class="form">
                <form action="/admin/pengembalian/update/{{ $pengembalian->id }}" method="post">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label">Peminjaman</label>
                        <select name="peminjaman_id" class="form-control" required>
                            @foreach($peminjaman as $p)
                            <option value="{{ $p->id }}" {{ $pengembalian->peminjaman_id == $p->id ? 'selected' : '' }}>
                                {{ $p->user->name }} - {{ $p->alat->nama_alat }} (Pinjam: {{ $p->tanggal_pinjam->format('Y-m-d') }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Kembali</label>
                        <input type="date" name="tanggal_kembali" value="{{ \Carbon\Carbon::parse($pengembalian->tanggal_kembali)->format('Y-m-d') }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Denda</label>
                        <input type="number" name="denda" value="{{ $pengembalian->denda }}" class="form-control" required min="0">
                    </div>

                    <div class="d-flex mt-4 gap-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="/admin/pengembalian" class="btn btn-danger">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection