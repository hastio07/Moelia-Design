@extends('dashboard.admin.layouts.layouts')
@section('title', 'Pesanan')
@push('styles')
    <link href="{{ asset('templates') }}/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="{{ asset('templates') }}/assets/css-modif/admin/ManagePesanan.css" rel="stylesheet">
@endpush
@section('content')
    <div class="content-wrapper">
        <div class="row same-height">
            <div aria-hidden="true" aria-labelledby="largeModalLabel" class="modal fade" id="largeModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <form action="" method="post">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="largeModalLabel">Tambah Pesanan</h5>
                                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                            </div>
                            <div class="modal-body">
                                <div class="p-3 mb-5">
                                    <div class="add-jadwal">
                                        <div class="form-inpt">
                                            <label class="form-label" for="basicInput">Nama</label>
                                            <input class="form-control" id="nama" name="nama" placeholder="John Doe" type="text" value="">
                                        </div>
                                        <div class="form-inpt">
                                            <label class="form-label" for="basicInput">Alamat</label>
                                            <input class="form-control" id="lokasi" name="Alamat" placeholder="Jl. Nangka" type="text" value="">
                                        </div>
                                        <div class="form-inpt">
                                            <label class="form-label" for="rincianproduk">Rincian Produk<span class="text-danger">*</span></label>
                                            <textarea id="rincianproduk" name="rincianproduk"></textarea>
                                        </div>
                                        <div class="form-inpt">
                                            <label class="form-label" for="basicInput">Biaya Sewa</label>
                                            <input class="form-control" id="lokasi" name="Alamat" placeholder="Rp.100.000.000" type="number" value="">
                                        </div>
                                        <div class="form-inpt">
                                            <label class="form-label" for="basicInput">Uang Muka</label>
                                            <input class="form-control" id="lokasi" name="Alamat" placeholder="Rp.10.000.000" type="number" value="">
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
            <!-- Modal -->
            <div aria-hidden="true" aria-labelledby="staticBackdropLabel" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modalshowpesanan" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Cari Data Pesanan</h1>
                            <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="input-group mb-3 input-daterange datepicker date" data-date-format="dd-mm-yyyy">
                                    <input class="form-control" id="start_date" name="start_date" readonly="" required="" type="text" value="">
                                    <span class="bg-primary text-light px-3 justify-content-center align-items-center d-flex">to</span>
                                    <input class="form-control" id="end_date" name="end_date" readonly="" required="" type="text" value="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="button">Cari Pesanan <i class="bi bi-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Rincian Jadwal Kegiatan</h4>
                </div>
                <div class="card-body">
                    <div class="btn-modal mt-3 mb-2 gap-3 d-flex">
                        <button class="btn icon-left btn-success d-flex" data-bs-target="#largeModal" data-bs-toggle="modal" type="button "><i class="bi bi-plus-lg"></i>
                            <p>Pesanan</p></i>
                        </button>
                        <button class="btn btn-primary icon-left d-flex" data-bs-target="#modalshowpesanan" data-bs-toggle="modal" type="button "><i class="bi bi-filter"></i>
                            <p>Tanggal</p>
                        </button>
                    </div>
                    <table class="table display" id="table-pesanan">
                        <thead>
                            <tr>
                                <th>Nama Customer</th>
                                <th>Alamat</th>
                                <th>Tanggal Acara</th>
                                <th>Detail Pesanan</th>
                                <th>Biaya Sewa</th>
                                <th>Uang Muka</th>
                                <th>Status Pembayaran(DP)</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bolder">Lutfi Aziz</td>
                                <td>Jl. Purnawirawan</td>
                                <td>30/06/2023</td>
                                <td></td>
                                <td>Rp.100.000.000</td>
                                <td>Rp.10.000.000;- </td>
                                <td class="text-danger">
                                    <div class="spinner-grow spinner-grow-sm text-danger" role="status"></div>
                                    Belum Dibayar
                                </td>
                                <td>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                        <button class="btn btn-danger" data-bs-target="#smallModaljadwal" data-bs-toggle="modal" type="button"><i class="bi bi-trash"></i></button>
                                        <button class="btn btn-warning" data-bs-target="#UpdateModaljadwal" data-bs-toggle="modal" type="button"><i class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-info" data-bs-target="#UpdateModaljadwal" data-bs-toggle="modal" type="button"><i class="bi bi-send"></i></button>
                                        <button class="btn btn-secondary" data-bs-target="#UpdateModaljadwal" data-bs-toggle="modal" type="button"><i class="bi bi-check2"></i></i></button>
                                        <button class="btn btn-success" data-bs-target="#UpdateModaljadwal" data-bs-toggle="modal" type="button"><i class="bi bi-printer"></i></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bolder">Muhammad</td>
                                <td>Jl. Purnawirawan Gg. Man 1</td>
                                <td>30/01/2023</td>
                                <td></td>
                                <td>Rp.150.000.000</td>
                                <td>Rp.15.000.000;- </td>
                                <td class="text-success">
                                    <div class="spinner-grow spinner-grow-sm text-success" role="status"></div>
                                    Dibayar
                                </td>
                                <td>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                        <button class="btn btn-danger" data-bs-target="#smallModaljadwal" data-bs-toggle="modal" type="button"><i class="bi bi-trash"></i></button>
                                        <button class="btn btn-warning" data-bs-target="#UpdateModaljadwal" data-bs-toggle="modal" type="button"><i class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-info" data-bs-target="#UpdateModaljadwal" data-bs-toggle="modal" type="button"><i class="bi bi-send"></i></button>
                                        <button class="btn btn-secondary" data-bs-target="#UpdateModaljadwal" data-bs-toggle="modal" type="button"><i class="bi bi-check2"></i></i></button>
                                        <button class="btn btn-success" data-bs-target="#UpdateModaljadwal" data-bs-toggle="modal" type="button"><i class="bi bi-printer"></i></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nama Customer</th>
                                <th>Alamat</th>
                                <th>Tanggal Acara</th>
                                <th>Detail Pesanan</th>
                                <th>Biaya Sewa</th>
                                <th>Uang Muka</th>
                                <th>Status Pembayaran(DP)</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        DataTable.init()
    </script>
    <script src="{{ asset('templates') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
        $('.date').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd-mm-yyyy'
        }).on('changeDate', function(e) {
            console.log(e.target.value);
        });
    </script>
@endpush

@push('scripts')
    <script src="{{ asset('templates') }}/vendor/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        $(document).ready(function() {
            $('#table-pesanan').DataTable({
                responsive: true,
            });
        })
    </script>
    <script>
        tinymce.init({
            selector: 'textarea#rincianproduk',
            plugins: [
                'lists', 'wordcount'
            ],
            menubar: 'edit insert format',
            toolbar: 'bullist numlist',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
        });
    </script>
@endpush
