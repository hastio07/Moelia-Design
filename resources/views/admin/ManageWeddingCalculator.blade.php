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
            <div class="row mt-2">
                <div class="col-md-4">
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
                </div>
                <div class="col-md-4">
                    <div class="custom-paket">
                        <div class="card p-4">
                            <h5 class="fw-bold">Custom Paket</h5>
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
                </div>
                <div class="col-md-4">
                    <div class="additional-venue">
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
