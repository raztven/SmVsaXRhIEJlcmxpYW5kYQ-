@extends('layouts.app')
@section('content')
<div class="body-wrapper">
    <div class="container-fluid" style="padding: 45px;">
        <div class="d-flex justify-content-between align-item-center mt-4 mb-3">
            <h2>LOG AKTIVITAS</h2>
        </div>

        <div class="table-responsive">
            <table class="table border table-hover">
                <thead class="table-dark ">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Aktivitas</th>
                        <th scope="col">Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $i)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$i->user->name}}</td>
                        <td>{{$i->aktivitas}}</td>
                        <td>{{$i->deskripsi}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection