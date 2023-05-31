@extends('dashboard.admin.layouts.layouts')
@section('title', 'Manage Pegawai')
@push('styles')
    <link href="{{ asset('templates') }}/assets/css-modif/ManagePegawai.css" rel="stylesheet">
@endpush
@section('content')
    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-sm-9">
                <div aria-hidden="true" aria-labelledby="largeModalLabel" class="modal fade" id="largeModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <form action="" method="post">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="largeModalLabel">Tambah Pegawai</h5>
                                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="p-3 mb-5">
                                        <div class="add-jadwal">
                                            <div class="form-inpt">
                                                <label class="form-label" for="basicInput">Nama</label>
                                                <input class="form-control" id="nama" name="nama" placeholder="Masukan Nama" type="text" value="">
                                            </div>
                                            <div class="form-inpt mt-3">
                                                <label class="form-label" for="basicInput">Alamat Domisili</label>
                                                <input class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat Pegawai" type="text" value="">
                                            </div>
                                            <div class="form-inpt mt-3">
                                                <label class="form-label" for="basicInput">No. Telephone</label>
                                                <input class="form-control" id="telephone" name="telephonr" placeholder="Masukan Nomor Telephone" type="text" value="">
                                            </div>
                                            <div class="form-inpt mt-3">
                                                <label class="form-label" for="basicInput">Gaji</label>
                                                <input class="form-control" id="gaji" name="telephone" placeholder="Masukan Jumlah Gaji" type="text" value="">
                                            </div>
                                            <div class="form-inpt mt-3">
                                                <label class="form-label" for="basicInput">Jabatan</label>
                                                <select aria-label="Default select example" class="form-select">
                                                    <option selected>Pilih sesuai jabatan pegawai</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                            <div class="mt-3">
                                                <label class="form-label" for="fotopegawai">Foto Pegawai</label>
                                                <input class="form-control" id="fotopegawau" multiple type="file">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="submit">Close</button>
                                    <button class="btn mb-2 icon-left  btn-success" name="submit" type="submit"><i class="ti-plus"></i>Tambah</button>
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
                            <button class="btn mb-2 icon-left  btn-success" data-bs-target="#largeModal" data-bs-toggle="modal" type="button "><i class="bi bi-plus-lg"></i>Tambah Pegawai</i></button>
                        </div>
                        <table class="table display" id="table-pegawai">
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
                                            <button class="btn btn-danger" data-bs-target="#smallModal" data-bs-toggle="modal" type="button"><i class="bi bi-trash"></i></button>
                                            <button class="btn btn-warning" data-bs-target="#UpdateModal" data-bs-toggle="modal" type="button"><i class="bi bi-pencil-square"></i></button>
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
                                <input class="form-control" id="telephone" name="telephonr" placeholder="Masukan jabatan" type="text" value="">
                                <button class="btn btn-success" data-bs-target="" data-bs-toggle="modal" type="button"><i class="bi bi-plus-lg"></i></button>
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
        $(document).ready(function() {
            $('#table-pegawai').DataTable({
                responsive: true,
            });
        })
    </script>
@endpush
