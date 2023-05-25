@extends('dashboard.admin.layouts.layouts')
@section('title', 'Manage Pegawai')
@push('StylesAdmin')
<link href="{{ asset('templates') }}/assets/css-modif/ManagePegawai.css" rel="stylesheet">
@endpush
@section('content')
<div class="content-wrapper">
    <div class="row same-height">
        <div class="col-sm-9">
            <div class="modal fade" id="largeModal" tabindex="-1" aria-labelledby="largeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <form action="" method="post">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="largeModalLabel">Tambah Pegawai</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="p-3 mb-5">
                                    <div class="add-jadwal">
                                        <div class="form-inpt">
                                            <label for="basicInput" class="form-label">Nama</label>
                                            <input type="text" placeholder="Masukan Nama" class="form-control" id="nama" name="nama" value="">
                                        </div>
                                        <div class="form-inpt mt-3">
                                            <label for="basicInput" class="form-label">Alamat Domisili</label>
                                            <input type="text" placeholder="Masukan Alamat Pegawai" class="form-control" id="alamat" name="alamat" value="">
                                        </div>
                                        <div class="form-inpt mt-3">
                                            <label for="basicInput" class="form-label">No. Telephone</label>
                                            <input type="text" placeholder="Masukan Nomor Telephone" class="form-control" id="telephone" name="telephonr" value="">
                                        </div>
                                        <div class="form-inpt mt-3">
                                            <label for="basicInput" class="form-label">Gaji</label>
                                            <input type="text" placeholder="Masukan Jumlah Gaji" class="form-control" id="gaji" name="telephone" value="">
                                        </div>
                                        <div class="form-inpt mt-3">
                                            <label for="basicInput" class="form-label">Jabatan</label>
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected>Pilih sesuai jabatan pegawai</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                        <div class="mt-3">
                                            <label for="fotopegawai" class="form-label">Foto Pegawai</label>
                                            <input class="form-control" type="file" id="fotopegawau" multiple>
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
                    <h4>Daftar Pegawai</h4>
                </div>
                <div class="card-body">
                    <div class="btn-modal mt-3 mb-2">
                        <button class="btn mb-2 icon-left  btn-success" data-bs-toggle="modal" data-bs-target="#largeModal" type="button "><i class="bi bi-plus-lg"></i>Tambah Pegawai</i></button>
                    </div>
                    <table class="table display" id="tabelPesananProses">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Alamat Domisili</th>
                                <th>Kontak</th>
                                <th>Besaran Gaji</th>
                                <th>Jabatan</th>
                                <th>Foto</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bolder">Muhammad</td>
                                <td>Jl. Purnawirawan Gg. Man 1</td>
                                <td>081256766661</td>
                                <td>Rp.1.000.000</td>
                                <td>Owner</td>
                                <td>img1.jpg</td>
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
                                <th>Nama</th>
                                <th>Alamat Domisili</th>
                                <th>No. Telephone</th>
                                <th>Besaran Gaji</th>
                                <th>Jabatan</th>
                                <th>Foto</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="content-wrapper">
                <div class="same-height">
                    <div class="card p-3 text-center">
                        <h5>Tambah Jabatan</h5>
                        <div class="form-inpt mt-3 d-flex">
                            <input type="text" placeholder="Masukan jabatan" class="form-control" id="telephone" name="telephonr" value="">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="" type="button"><i class="bi bi-plus-lg"></i></button>
                        </div>
                        <div class="mt-4">
                            <p class="fw-bold">Daftar Jabatan</p>
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