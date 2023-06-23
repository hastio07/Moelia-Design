@extends('admin.layouts.layouts')
@section('title', 'Manage Akun')
@push('styles')
    <link href="{{ asset('templates') }}/assets/css-modif/admin/ManageAkun.css" rel="stylesheet">
@endpush

@section('content')
    <section class="">
        <div class="card p-3">
            <div class="btn-modal">
                <button class="btn icon-left btn-success mb-2" data-bs-route="" data-bs-target="#CUModal" data-bs-toggle="modal" id="btnCreateModal" type="button"><i class="bi bi-plus-lg"></i>Tambah Data</i></button>
            </div>

            <div class="all-in-paket">
                <div class="card p-4">
                    <h5 class="fw-bold">Paket AllIn</h5>
                    <table class="display mt-2 table" id="table-admins">
                        <thead>
                            <tr>
                                <th>Nama Paket</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td>Paket Allin 1</td>
                            <td>135.000.000</td>
                            <td><button class="btn btn-danger"><i class="bi bi-trash3-fill"></i></button> <button class="btn btn-warning"><i class="bi bi-pencil-square"></i></button></td>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nama Paket</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="custom-paket">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card p-4">
                            <h5 class="fw-bold">Custom Venue</h5>
                            <table class="display mt-2 table" id="table-admins">
                                <thead>
                                    <tr>
                                        <th>Nama Paket</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td>Paket Allin 1</td>
                                    <td>135.000.000</td>
                                    <td><button class="btn btn-danger"><i class="bi bi-trash3-fill"></i></button> <button class="btn btn-warning"><i class="bi bi-pencil-square"></i></button></td>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nama Paket</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3">
                            <h6 class="fw-bold text-center">Kategori Custom Venue</h6>
                            <form action="" class="text-center" method="POST">
                                <input class="form-control mb-3" id="kategori-custom" name="nama_kategori" placeholder="Buat kategori" required type="text" value="">
                                <button class="btn btn-success" type="submit">Tambah</button>
                            </form>
                            <div class="list-kategori mt-2">
                                <table class="caption-top mt-3 table border">
                                    <tbody>
                                        <tr>
                                            <td class="">Gedung</td>
                                            <td class="text-end">
                                                <button class="btn text-danger" data-bs-route="" data-bs-target="#DeleteModal" data-bs-toggle="modal" id="btnDeleteModal" type="button"><i class="bi bi-trash"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="additional-venue">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card p-4">
                            <h5 class="fw-bold">Additional Venue</h5>
                            <table class="display mt-2 table" id="table-admins">
                                <thead>
                                    <tr>
                                        <th>Nama Paket</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td>Paket Allin 1</td>
                                    <td>135.000.000</td>
                                    <td><button class="btn btn-danger"><i class="bi bi-trash3-fill"></i></button> <button class="btn btn-warning"><i class="bi bi-pencil-square"></i></button></td>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nama Paket</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card p-3">
                            <h6 class="fw-bold text-center">Kategori Additional Vanue</h6>
                            <form action="" class="text-center" method="POST">
                                <input class="form-control mb-3" id="kategori-aditional" name="nama_kategori" placeholder="Buat kategori" required type="text" value="">
                                <button class="btn btn-success" type="submit">Tambah</button>
                            </form>
                            <div class="list-kategori mt-2">
                                <table class="caption-top mt-3 table border">
                                    <tbody>
                                        <tr>
                                            <td class="">Gedung</td>
                                            <td class="text-end">
                                                <button class="btn text-danger" data-bs-route="" data-bs-target="#DeleteModal" data-bs-toggle="modal" id="btnDeleteModal" type="button"><i class="bi bi-trash"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div aria-hidden="true" aria-labelledby="cuModalLabel" class="modal fade" id="CUModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cuModalLabel">Tambah Produk</h5>
                            <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                        </div>
                        <form enctype="multipart/form-data" id="CUForm" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-5 p-3">
                                    <div class="form-inpt">
                                        <label class="form-label" for="namaproduk">Nama Produk<span class="text-danger">*</span></label>
                                        <input class="form-control" id="namaproduk" name="namaproduk" placeholder="Masukan Nama Produk" type="text" value="">
                                    </div>
                                    <div class="form-inpt">
                                        <label class="form-label" for="kategori">Kategori<span class="text-danger">*</span></label>
                                        <select aria-label="Default select example" class="form-select form-select" id="kategori" name="kategori">
                                            <option disabled selected value="">-- Pilih Kategori --</option>
                                        </select>
                                    </div>
                                    <div class="form-inpt">
                                        <label class="form-label" for="hargasewa">Harga Sewa<span class="text-danger">*</span></label>
                                        <input class="form-control" id="hargasewa" name="hargasewa" placeholder="Masukan Harga Sewa" type="number" value="">
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Tutup</button>
                                <button class="btn icon-left btn-success mb-2" type="submit"><i class="ti-check"></i>Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
