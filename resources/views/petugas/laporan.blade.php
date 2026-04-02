@extends('layouts.petugas')

@section('title', 'Laporan Peminjaman')

@section('content')
<div class="header">
    <h2>LAPORAN PEMINJAMAN ALAT</h2>
    <p>Tanggal Cetak: {{ date('d-m-Y H:i') }}</p>
</div>

<button onclick="window.print()" class="no-print" style="margin-bottom: 20px; padding: 10px; cursor: pointer;">
    Klik untuk Cetak / Save PDF
</button>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
            <th>Nama Alat</th>
            <th>Tgl Pinjam</th>
            <th>Tgl Kembali</th>
            <th>Jumlah</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($peminjaman as $i)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $i->user->name }}</td>
            <td>{{ $i->alat->nama_alat }}</td>
            <td>{{ $i->tanggal_pinjam }}</td>
            <td>{{ $i->tanggal_rencana }}</td>
            <td>{{ $i->jumlah_pinjam }}</td>
            <td class="status">{{ $i->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div style="margin-top: 50px; float: right; text-align: center;">
    <p>Dicetak oleh,</p>
    <br><br><br>
    <p><strong>{{ Auth::user()->name }}</strong></p>
</div>
@endsection