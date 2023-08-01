@extends('admin.layouts.layouts')
@section('title', 'Pesanan-Selesai')
@section('content')
<div class="container">
    <div class="bg-danger rounded p-3 mb-3 text-white">
        <p class="fw-bold mb-0">Info <i class="bi bi-info-circle"></i></p>
        <p class="mb-0">Data yang terdapat didalam tabel dibawahadalah data yang sudah selesai dari proeses pembayaran <a href="/pesanan-selesai" class="btn btn-light text-decoration-none">Pesanan Selesai</a></p>
    </div>
    <div class="card p-2">
        <table class="display table" id="table-pesanan">
            <thead>
                <tr>
                    <th>Nama Pemesan</th>
                    <th>Telp/HP</th>
                    <th>Hari/Tgl Pemesanan</th>
                    <th>Status Pembayaran(DP)</th>
                    <th>Status Pelunasan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th><a href="">Hastio</a></th>
                    <th>081258655551</th>
                    <th>Jumat, 30/01/2023</th>
                    <th class="text-success">Lunas</th>
                    <th class="text-success">Lunas</th>
                    <th><button class="btn btn-danger"><i class="bi bi-trash3"></i></button></th>
                </tr>
            </tbody>
            <tfoot>
                <th>Nama Pemesan</th>
                <th>Telp/HP</th>
                <th>Hari/Tgl Pemesanan</th>
                <th>Status Pembayaran(DP)</th>
                <th>Status Pelunasan</th>
                <th class="text-center">Aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
