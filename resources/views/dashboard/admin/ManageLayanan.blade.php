@extends('dashboard.admin.layouts.layouts')
@section('title', 'Manage Layanan')

@section('content')
<section>
    <div class="content-wrapper">
        <div class="same-height">
            <div class="modal fade" id="largeModal" tabindex="-1" aria-labelledby="largeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="largeModalLabel">Tambah Layanan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="p-3 mb-5">
                                <div class="add-services">
                                    <div class="link-png">
                                        <p class="text-capitalize">Untuk PNG logo layanan dapat didownload <a href="https://www.flaticon.com">disini</a></p>
                                    </div>
                                    <div class="form-inpt">
                                        <label for="basicInput" class="form-label">Tipe Layanan</label>
                                        <input type="text" placeholder="Masukan Layanan" class="form-control" id="basicInput">
                                    </div>
                                    <div class="form-inpt">
                                        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                    <div class="form-inpt">
                                        <label for="formFile" class="form-label">Upload Gambar</label>
                                        <input class="form-control" type="file" id="files" multiple="multiple" accept="image/jpg, image/png, image/jpeg">
                                        <output id="result" class="img-result">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn mb-2 icon-left  btn-success" type="button "><i class="ti-check"></i>selesai</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="card">
                    <div class="card-header ">
                        <h4>List Layanan</h4>
                    </div>
                    <div class="card-body">
                        <div class="btn-modal">
                            <button class="btn mb-2 icon-left  btn-success" data-bs-toggle="modal" data-bs-target="#largeModal" type="button "><i class="bi bi-plus-lg"></i>Tambah Layanan</i></button>
                        </div>
                        <table id="example2" class="table display text-center">
                            <thead>
                                <tr>
                                    <th>Tipe Layanan</th>
                                    <th>Deskripsi</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit...</td>
                                    <td>img1.jpg</td>
                                    <td>
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                            <button class="btn btn-warning" type="button"><i class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#smallModal" type="button"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <td>Garrett Winters</td>
                                    <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit...</td>
                                    <td>img1.jpg</td>
                                    <td>
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                            <button class="btn btn-warning" type="button"><i class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#smallModal" type="button"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Tipe Layanan</th>
                                    <th>Deskripsi</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection