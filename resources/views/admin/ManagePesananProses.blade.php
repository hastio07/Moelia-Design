@extends('admin.layouts.layouts')
@section('title', 'Pesanan')
@push('styles')
    <link href="{{ asset('templates') }}/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="{{ asset('templates') }}/assets/css-modif/admin/ManagePesanan.css" rel="stylesheet">
@endpush
@section('content')
    <div class="content-wrapper">
        <div class="row same-height">
            <div class="card">
                <div class="card-header">
                    <h4>Rincian Jadwal Kegiatan</h4>
                </div>
                <div class="card-body">
                    <div class="btn-modal d-flex mt-3 mb-2 gap-3">
                        <button class="btn icon-left btn-success d-flex" data-bs-target="#CUModal" data-bs-toggle="modal" type="button "><i class="bi bi-plus-lg"></i>
                            Pesanan
                        </button>
                        <button class="btn btn-primary icon-left d-flex" data-bs-target="#FilterModal" data-bs-toggle="modal" type="button "><i class="bi bi-filter"></i>
                            Tanggal
                        </button>
                        <button class="btn btn-secondary icon-left d-flex" id="refresh" type="button "><i class="bi bi-arrow-clockwise"></i>
                            Reset
                        </button>
                    </div>
                    <table class="display table" id="table-pesanan">
                        <thead>
                            <tr>
                                <th>Nama Pemesan</th>
                                <th>Telp/HP</th>
                                <th>Hari/Tgl</th>
                                <th>Tempat/Gedung</th>
                                <th>Total Biaya Awal</th>
                                <th>Total Biaya Seluruh</th>
                                <th>DP1</th>
                                <th>Status Pembayaran(DP)</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bolder"><a href="/detail-pesanan">Muhammad & aisyah</a></td>
                                <td>08125865551</td>
                                <td>Jumat/30-01-2023</td>
                                <td>Bagas Raya</td>
                                <td>Rp.150.000.000</td>
                                <td>Rp.180.000.000;- </td>
                                <td>Rp.18.000.000;- </td>
                                <td class="text-success">
                                    <div class="spinner-grow spinner-grow-sm text-success" role="status"></div>
                                    Dibayar
                                </td>
                                <td>
                                    <div class="d-grid d-md-flex justify-content-md-center gap-2">
                                        <button class="btn btn-danger" data-bs-target="#smallModaljadwal" data-bs-toggle="modal" type="button"><i class="bi bi-trash"></i></button>
                                        <button class="btn btn-warning" data-bs-target="#UpdateModaljadwal" data-bs-toggle="modal" type="button"><i class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-secondary" data-bs-target="#UpdateModaljadwal" data-bs-toggle="modal" type="button"><i class="bi bi-check2"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="text center">
                                <th>Nama Pemesan</th>
                                <th>Telp/HP</th>
                                <th>Hari/Tgl</th>
                                <th>Tempat/Gedung</th>
                                <th>Total Biaya Awal</th>
                                <th>Total Biaya Seluruh</th>
                                <th>DP1</th>
                                <th>Status Pembayaran(DP)</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        {{-- Modal Create Pesanan --}}
        <div aria-hidden="true" aria-labelledby="cuModalLabel" class="modal fade" id="CUModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cuModalLabel">Tambah Pesanan</h5>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                    </div>
                    <form method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-5 p-3">
                                <div class="form-inpt mt-1">
                                    <label class="form-label" for="nama">Nama Pemesan<span class="text-danger">*</span></label>
                                    <input class="form-control" id="nama" name="nama" placeholder="Masukkan nama" required type="text" value="{{ old('nama') }}">
                                </div>
                                <div class="form-inpt mt-1">
                                    <label class="form-label" for="nama-pesanan">Nama Pesanan<span class="text-danger">*</span></label>
                                    <input class="form-control" id="nama-pesanan" name="nama-pesanan" placeholder="Masukkan nama pesanan" required type="text" value="{{ old('nama-pesanan') }}">
                                </div>
                                <div class="form-inpt mt-1">
                                    <label class="form-label" for="telp">Telp/HP<span class="text-danger">*</span></label>
                                    <input class="form-control" id="telp" name="telp" placeholder="Masukkan nomor telephone" required type="number" value="{{ old('telp') }}">
                                </div>
                                <div class="form-inpt mt-1">
                                    <label class="form-label" for="tanggal">Tanggal Akad & Resepsi<span class="text-danger">*</span></label>
                                    <div class="input-group input-append date" data-date-format="dd-mm-yyyy">
                                        <input class="form-control" id="tanggal" name="tanggal" placeholder="Masukan tanggal acara" required type="text" value="{{ old('tanggal') }}">
                                        <button class="btn btn-outline-secondary" type="button">
                                            <i class="far fa-calendar-alt"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-inpt mt-1">
                                    <label class="form-label" for="alamat">Alamat Akad & Resepsi<span class="text-danger">*</span></label>
                                    <input class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat" required type="text" value="{{ old('alamat') }}">
                                </div>
                                <div class="form-inpt mt-1">
                                    <label class="form-label" for="biaya-awal">Total Biaya Awal<span class="text-danger">*</span></label>
                                    <input class="form-control" id="biaya-awal" name="biaya-awal" placeholder="Masukkan biaya sewa" required type="number" value="{{ old('biaya-awal') }}">
                                </div>
                                <div class="form-inpt mt-1">
                                    <label class="form-label" for="biaya-seluruh">Total Biaya Seluruh<span class="text-danger">*</span></label>
                                    <input class="form-control" id="biaya-seluruh" name="biaya-seluruh" placeholder="Masukkan biaya sewa" required type="number" value="{{ old('biaya-seluruh') }}">
                                </div>
                                <div class="form-inpt mt-1">
                                    <label class="form-label" for="dp">Uang Muka(DP) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="dp" name="uang" placeholder="Masukkan uang muka" required type="number" value="{{ old('uang') }}">
                                </div>
                                <div class="form-inpt mt-1">
                                    <label class="form-label" for="materikerja">Materi Kerja<span class="text-danger">*</span></label>
                                    <textarea id="rincianproduk" name="materikerja" required>{{ old('materikerja') }}</textarea>
                                </div>
                                <div class="form-inpt mt-2">
                                    <label class="form-label" for="rincianproduk">Additional<span class="text-danger">*</span></label>
                                    <textarea id="rincianproduk" name="additional" required>{{ old('additional') }}</textarea>
                                </div>
                                <div class="form-inpt mt-2">
                                    <label class="form-label" for="rincianproduk">Bonus<span class="text-danger">*</span></label>
                                    <textarea id="rincianproduk" name="materikerja" required>{{ old('materikerja') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Tutup</button>
                            <button class="btn icon-left btn-success mb-2" type="submit"><i class="ti-plus"></i>Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Modal Date Filter Pesanan --}}
        <div aria-hidden="true" aria-labelledby="filterModalLabel" class="modal fade" id="FilterModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="filterModalLabel">Cari Data Pesanan</h1>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            {{-- DATE RANGE PICKER --}}
                            <div class="input-group input-daterange datepicker date mb-3" data-date-format="dd-mm-yyyy">
                                <input class="form-control" id="start_date" name="start_date" readonly="" required="" type="text" value="">
                                <span class="bg-primary text-light justify-content-center align-items-center d-flex px-3">to</span>
                                <input class="form-control" id="end_date" name="end_date" readonly="" required="" type="text" value="">
                            </div>
                            {{-- DATE RANGE PICKER --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="filter" type="button">Cari Pesanan <i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('templates') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            //Iniliasi datepicker pada class input
            $('.date').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'dd-mm-yyyy'
            }).on('changeDate', function(e) {
                console.log(e.target.value);
            });

            //LOAD DATATABLE
            //script untuk memanggil data json dari server dan menampilkannya berupa datatable
            //load data menggunakan parameter tanggal dari dan tanggal hingga
            function load_data(start_date = '', end_date = '') {
                $('#table-pesanan').DataTable({
                    url: '{{ url()->current() }}',
                    responsive: true,
                })

                // Script untuk dari server
                /*  $('#table-pesanan').DataTable({
                      processing: true,
                      responsive: true,
                      //  serverSide: true, //aktifkan server-side
                      ajax: {
                          url: '{{ url()->current() }}',
                          type: 'GET',
                          data: {
                              start_date: start_date,
                              end_date: end_date
                          } //jangan lupa kirim parameter tanggal
                      },
                      columns: [{
                                   data: 'nama_customer',
                                   name: 'nama_customer'
                               },
                               {
                                   data: 'alamat',
                                   name: 'alamat'
                               },
                               {
                                   data: 'Tanggal Acara',
                                   name: 'Tanggal Acara'
                               },
                               {
                                   data: 'Detail Pesanan',
                                   name: 'Detail Pesanan'
                               },
                               {
                                   data: 'Biaya Sewa',
                                   name: 'Biaya Sewa'
                               },
                               {
                                   data: 'Uang Muka',
                                   name: 'Uang Muka'
                               },
                               {
                                   data: 'Aksi',
                                   name: 'Aksi'
                               },
                           ],
                      order: [
                          [0, 'asc']
                      ]

                  });*/
            }
            load_data();

            // Ketika button filter diklik
            /* document.getElementById('filter').addEventListener('click', function() {
                var start_date = document.getElementById('start_date').value;
                var end_date = document.getElementById('end_date').value;
                if (start_date !== '' && end_date !== '') {
                    document.getElementById('table-pesanan').DataTable().destroy();
                    load_data(start_date, end_date);
                } else {
                    alert('Both Date is required');
                }
            });
                */
            // Ketika button reset diklik
            /* document.getElementById('refresh').addEventListener('click', function() {
                 document.getElementById('start_date').value = '';
                 document.getElementById('end_date').value = '';
                 document.getElementById('table-pesanan').DataTable().destroy();
                 load_data();
             });
             */
        })
    </script>
    <script src="{{ asset('templates') }}/vendor/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
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
