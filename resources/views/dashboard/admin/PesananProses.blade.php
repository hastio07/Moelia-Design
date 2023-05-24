@extends('dashboard.admin.layouts.layouts')
@section('title', 'Pesanan')
@push('StylesAdmin')
<link href="{{ asset('templates') }}/assets/css-modif/managepesanan.css" rel="stylesheet">
@endpush

@section('content')
<div class="content-wrapper">
    <div class="row same-height">
        <div class="modal fade" id="largeModal" tabindex="-1" aria-labelledby="largeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="largeModalLabel">Tambah Pesanan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="p-3 mb-5">
                                <div class="add-jadwal">
                                    <div class="form-inpt">
                                        <label for="basicInput" class="form-label">Nama</label>
                                        <input type="text" placeholder="Masukan Nama" class="form-control" id="nama" name="nama" value="">
                                    </div>
                                    <div class="form-inpt">
                                        <label for="basicInput" class="form-label">Lokasi</label>
                                        <input type="text" placeholder="Masukan Lokasi Kegiatan" class="form-control" id="lokasi" name="lokasi" value="">
                                    </div>
                                    <div class="form-inpt">
                                        <label for="basicInput" class="form-label">Jam Kegiatan</label>
                                        <input type="time" id="appt" class="form-control" id="jam" name="jam" value="">
                                    </div>
                                    <div class="form-inpt">
                                        <label for="datepicker-icon" class="form-label">Tentukan Tanggal</label>
                                        <div class="input-group input-append date" data-date-format="dd-mm-yyyy">
                                            <input class="form-control" type="text" readonly="" autocomplete="off" placeholder="Masukan Tanggal" id="tanggal" name="tanggal" value="">
                                            <button class="btn btn-outline-secondary" type="button">
                                                <i class="far fa-calendar-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-inpt">
                                        <label for="exampleFormControlTextarea1" class="form-label">Kegiatan</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" id="kegiatan" name="kegiatan"></textarea>
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
                <h4>Rincian Jadwal Kegiatan</h4>
            </div>
            <div class="card-body">
                <div class="btn-modal mt-3 mb-2">
                    <button class="btn mb-2 icon-left  btn-success" data-bs-toggle="modal" data-bs-target="#largeModal" type="button "><i class="bi bi-plus-lg"></i>Tambah Pesanan</i></button>
                </div>
                <table class="table display" id="tabelPesananProses">
                    <thead>
                        <tr>
                            <th>Nama Customer</th>
                            <th>Alamat</th>
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
                            <td></td>
                            <td>Rp.100.000.000</td>
                            <td>Rp.10.000.000;- </td>
                            <td class="text-danger">
                                <div class="spinner-grow spinner-grow-sm text-danger" role="status"></div>
                                Belum Dibayar
                            </td>
                            <td>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#smallModaljadwal" type="button"><i class="bi bi-trash"></i></button>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#UpdateModaljadwal" type="button"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#UpdateModaljadwal" type="button"><i class="bi bi-send"></i></button>
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#UpdateModaljadwal" type="button"><i class="bi bi-printer"></i></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bolder">Muhammad</td>
                            <td>Jl. Purnawirawan Gg. Man 1</td>
                            <td></td>
                            <td>Rp.150.000.000</td>
                            <td>Rp.15.000.000;- </td>
                            <td class="text-success">
                                <div class="spinner-grow spinner-grow-sm text-success" role="status"></div>
                                Dibayar
                            </td>
                            <td>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#smallModaljadwal" type="button"><i class="bi bi-trash"></i></button>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#UpdateModaljadwal" type="button"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#UpdateModaljadwal" type="button"><i class="bi bi-send"></i></button>
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#UpdateModaljadwal" type="button"><i class="bi bi-printer"></i></i></button>
                                </div>
                            </td>

                        </tr>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nama Customer</th>
                            <th>Alamat</th>
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
@endpush