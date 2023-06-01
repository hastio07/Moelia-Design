@extends('admin.layouts.layouts')
@section('title', 'Manage Gudang')

@section('content')
    <div class="content-wrapper container">
        <div class="row same-height">
            <div class="col-sm-9">
                <div aria-hidden="true" aria-labelledby="largeModalLabel" class="modal fade" id="largeModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <form action="" method="post">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="largeModalLabel">Tambah Barang</h5>
                                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="p-3 mb-5">
                                        <div class="add-jadwal">
                                            <div class="form-inpt">
                                                <label class="form-label" for="basicInput">Nama Barang</label>
                                                <input class="form-control" id="nama" name="nama" placeholder="Masukan Nama Barang" type="text" value="">
                                            </div>
                                            <div class="form-inpt mt-3">
                                                <label class="form-label" for="basicInput">Jenis Barang</label>
                                                <select aria-label="Default select example" class="form-select">
                                                    <option selected>Pilih sesuai jenis barang</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                            <div class="form-inpt mt-3">
                                                <label class="form-label" for="basicInput">Stok Barang</label>
                                                <input class="form-control" id="alamat" name="alamat" placeholder="Masukan jumlah stok" type="number" value="">
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
                        <h4>Daftar Barang</h4>
                    </div>
                    <div class="card-body">
                        <div class="btn-modal mt-3 mb-2">
                            <button class="btn mb-2 icon-left  btn-success" data-bs-target="#largeModal" data-bs-toggle="modal" type="button "><i class="bi bi-plus-lg"></i>Tambah Barang</i></button>
                        </div>
                        <table class="table display" id="table-barang">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Ktegori Barang</th>
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
                                            <button class="btn btn-danger" data-bs-target="#smallModal" data-bs-toggle="modal" type="button"><i class="bi bi-trash"></i></button>
                                            <button class="btn btn-warning" data-bs-target="#UpdateModal" data-bs-toggle="modal" type="button"><i class="bi bi-pencil-square"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Kategori Barang</th>
                                    <th>Stok</th>
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
                            <h5 class="fw-bold">Kategori Barang</h5>
                            <div class="form-inpt mt-3 d-flex">
                                <input class="form-control" id="telephone" name="telephonr" placeholder="Masukan Kategori" type="text" value="">
                                <button class="btn btn-success" data-bs-target="" data-bs-toggle="modal" type="button"><i class="bi bi-plus-lg"></i></button>
                            </div>
                            <div class="mt-4">
                                @foreach ($get_categories as $value)
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $value->nama_kategori_barang }}
                                            <span><button class="btn text-danger" data-bs-route="" data-bs-target="#DeleteModal" data-bs-toggle="modal" id="btnDeleteModal" type="button"><i class="bi bi-trash"></i></button></span>
                                        </li>
                                    </ul>
                                @endforeach
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
            $('#table-barang').DataTable({
                responsive: true,
            });
        })
    </script>
@endpush
