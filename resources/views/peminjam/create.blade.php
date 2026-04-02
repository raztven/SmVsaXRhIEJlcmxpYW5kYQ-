@extends('layouts.jam')

@section('content')
<div class="container mt-4">
    <div class="mb-4 text-center">
        <h2 class="fw-bold">Form Peminjaman Alat</h2>
        <p class="text-muted">Silakan pilih alat dan tentukan durasi peminjaman</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="/peminjam/store" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Pilih Alat</label>
                            <select name="alat_id" class="form-select" required>
                                <option value="" selected disabled>-- Pilih Alat --</option>
                                @foreach($alat as $a)
                                <option value="{{ $a->id }}">
                                    {{ $a->nama_alat }} (Tersedia: {{ $a->stok }})
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Jumlah Pinjam</label>
                            <input type="number" name="jumlah_pinjam" class="form-control" min="1" placeholder="Masukkan jumlah unit" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tanggal Pinjam</label>
                                <input type="date" name="tanggal_pinjam" class="form-control" value="{{ date('Y-m-d') }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Rencana Kembali</label>
                                <input type="date" name="tanggal_rencana" class="form-control" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-100 py-2">
                                <i class="ti ti-send"></i> Ajukan Peminjaman
                            </button>
                            <a href="/peminjam" class="btn btn-outline-secondary w-100 mt-2 py-2">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
