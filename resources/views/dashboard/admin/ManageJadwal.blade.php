@extends('dashboard.admin.layouts.layouts')
@section('title','Manage Jadwal')

@section('content')
<section class="manage-akun container">
    <div class="title">
        <h5>Manage Jadwal</h5>
    </div>
    @if ($errors->any())
    <div class="pt-3">
        <div class="alert alert-danger">
            <p>Lengkapi Data Secara lengkap!</p>
            <ul style="list-style:none;" class="pt=10">
                @foreach ($errors->all() as $item)
                <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    @if (session()->has('success'))
    <div class="alert alert-sucess">
        {{ session()->get('success') }}
    </div>
    @endif
    <div class="content-wrapper">
        <div class="row same-height">
            <div class="modal fade" id="largeModal" tabindex="-1" aria-labelledby="largeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <form action="/managejadwal" method="post">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="largeModalLabel">Tambah Jadwal</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="p-3 mb-5">
                                    <div class="add-jadwal">
                                        <div class="form-inpt">
                                            <label for="basicInput" class="form-label">Nama</label>
                                            <input type="text" placeholder="Masukan Nama" class="form-control" id="nama" name="nama" value="{{ Session::get('nama') }}">
                                        </div>
                                        <div class="form-inpt">
                                            <label for="basicInput" class="form-label">Lokasi</label>
                                            <input type="text" placeholder="Masukan Lokasi Kegiatan" class="form-control" id="lokasi" name="lokasi" value="{{ Session::get('lokasi') }}">
                                        </div>
                                        <div class="form-inpt">
                                            <label for="basicInput" class="form-label">Jam Kegiatan</label>
                                            <input type="time" id="appt" class="form-control" id="jam" name="jam" value="{{ Session::get('jam') }}">
                                        </div>
                                        <div class="form-inpt">
                                            <label for="datepicker-icon" class="form-label">Tentukan Tanggal</label>
                                            <div class="input-group input-append date" data-date-format="dd-mm-yyyy">
                                                <input class="form-control" type="text" readonly="" autocomplete="off" placeholder="Masukan Tanggal" id="tanggal" name="tanggal" value="{{ Session::get('tanggal') }}">
                                                <button class="btn btn-outline-secondary" type="button">
                                                    <i class="far fa-calendar-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-inpt">
                                            <label for="exampleFormControlTextarea1" class="form-label">Kegiatan</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" id="kegiatan" name="kegiatan">{{ Session::get('kegiatan') }}</textarea>
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
                        <button class="btn mb-2 icon-left  btn-success" data-bs-toggle="modal" data-bs-target="#largeModal" type="button "><i class="bi bi-plus-lg"></i>Tambah Jadwal</i></button>
                    </div>
                    <table id="tabelJadwal" class="table display text-center">
                        <thead>
                            <tr>
                                <th>Nama Customer</th>
                                <th>Kegiatan</th>
                                <th>Lokasi</th>
                                <th>Jam</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_jadwal as $value)
                            <tr>
                                <td>{{ $value->nama }}</td>
                                <td>{{ $value->kegiatan }}</td>
                                <td>{{ $value->lokasi }}</td>
                                <td>{{ $value->jam }}</td>
                                <td>{{ $value->tanggal }}</td>
                                <td>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#smallModaljadwal{{ $value->id }}" type="button"><i class="bi bi-trash"></i></button>
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#UpdateModaljadwal{{ $value->id }}" type="button"><i class="bi bi-pencil-square"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nama Customer</th>
                                <th>Kegiatan</th>
                                <th>Lokasi</th>
                                <th>Jam</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@push("scripts")
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