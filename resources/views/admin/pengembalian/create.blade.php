@extends('layouts.app')
@section('content')
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="d-flex justify-content-between mb-4">
                <h2>Tambah Pengembalian</h2>
            </div>
            <div class="form">
                <form action="/admin/pengembalian/store" method="post">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Peminjaman (Peminjam - Alat)</label>
                        <select name="peminjaman_id" class="form-control" required>
                            <option value="">-- Pilih Peminjaman --</option>
                            @foreach($peminjaman as $p)
                            <option value="{{ $p->id }}">
                                {{ $p->user->name }} - {{ $p->alat->nama_alat }} (Pinjam: {{ $p->tanggal_pinjam->format('Y-m-d') }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Kembali</label>
                        <input type="date" name="tanggal_kembali" value="{{ date('Y-m-d') }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Denda</label>
                        <input type="number" name="denda" value="0" class="form-control" required min="0">
                    </div>

                    <div class="d-flex mt-4 gap-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="/admin/pengembalian" class="btn btn-danger">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection