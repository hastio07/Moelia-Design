@extends('dashboard.admin.layouts.layouts')
@section('title', 'Manage Gudang')

@section('content')
<div class="content-wrapper container">
    <div class="row same-height">
        <div class="col-sm-9">
            <div class="modal fade" id="largeModal" tabindex="-1" aria-labelledby="largeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <form action="" method="post">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="largeModalLabel">Tambah Barang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="p-3 mb-5">
                                    <div class="add-jadwal">
                                        <div class="form-inpt">
                                            <label for="basicInput" class="form-label">Nama Barang</label>
                                            <input type="text" placeholder="Masukan Nama Barang" class="form-control" id="nama" name="nama" value="">
                                        </div>
                                        <div class="form-inpt mt-3">
                                            <label for="basicInput" class="form-label">Jenis Barang</label>
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected>Pilih sesuai jenis barang</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                        <div class="form-inpt mt-3">
                                            <label for="basicInput" class="form-label">Stok Barang</label>
                                            <input type="number" placeholder="Masukan jumlah stok" class="form-control" id="alamat" name="alamat" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button class="btn mb-2 icon-left  btn-success" type="submit" name="submit"><i class="ti-plus"></i>Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Barang</h4>
                </div>
                <div class="card-body">
                    <div class="btn-modal mt-3 mb-2">
                        <button class="btn mb-2 icon-left  btn-success" data-bs-toggle="modal" data-bs-target="#largeModal" type="button "><i class="bi bi-plus-lg"></i>Tambah Barang</i></button>
                    </div>
                    <table class="table display" id="tabelPesananProses">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jenis Barang</th>
                                <th>Stok</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bolder">Tenda</td>
                                <td>dekorasi</td>
                                <td>100</td>
                                <td>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#smallModal" type="button"><i class="bi bi-trash"></i></button>
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#UpdateModal" type="button"><i class="bi bi-pencil-square"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jenis Barang</th>
                                <th>Stok</th>
                                <th class="text-center">Aksi</th </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="content-wrapper">
                <div class="same-height">
                    <div class="card p-3 text-center">
                        <h5 class="fw-bold">Kategori Barang</h5>
                        <div class="form-inpt mt-3 d-flex">
                            <input type="text" placeholder="Masukan Kategori" class="form-control" id="telephone" name="telephonr" value="">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="" type="button"><i class="bi bi-plus-lg"></i></button>
                        </div>
                        <div class="mt-4">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    A list item
                                    <span><a href=""><i class="bi bi-trash text-danger"></i></a></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    A second list item
                                    <span><a href=""><i class="bi bi-trash text-danger"></i></a></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    A third list item
                                    <span><a href=""><i class="bi bi-trash text-danger"></i></a></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    DataTable.init()
</script>
@endpush