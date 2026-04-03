@extends('layouts.app')
@section('content')
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="d-flex justify-content-between mb-4">
                <h2>Edit Peminjaman</h2>
            </div>
            <div class="form">
                <form action="/admin/peminjaman/update/{{ $peminjaman->id }}" method="post">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label">Peminjam</label>
                        <select name="user_id" class="form-control" required>
                            @foreach($users as $u)
                            <option value="{{ $u->id }}" {{ $peminjaman->user_id == $u->id ? 'selected' : '' }}>
                                {{ $u->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alat</label>
                        <select name="alat_id" class="form-control" required>
                            @foreach($alat as $a)
                            <option value="{{ $a->id }}" {{ $peminjaman->alat_id == $a->id ? 'selected' : '' }}>
                                {{ $a->nama_alat }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Pinjam</label>
                        <input type="date" name="tanggal_pinjam" value="{{ $peminjaman->tanggal_pinjam->format('Y-m-d') }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Rencana Kembali</label>
                        <input type="date" name="tanggal_rencana" value="{{ $peminjaman->tanggal_rencana->format('Y-m-d') }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jumlah Pinjam</label>
                        <input type="number" name="jumlah_pinjam" value="{{ $peminjaman->jumlah_pinjam }}" class="form-control" required min="1">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="pending" {{ $peminjaman->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="disetujui" {{ $peminjaman->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="ditolak" {{ $peminjaman->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            <option value="dikembalikan" {{ $peminjaman->status == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                        </select>
                    </div>

                    <div class="d-flex mt-4 gap-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="/admin/peminjaman" class="btn btn-danger">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection