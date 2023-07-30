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
                <div class="card-body">
                    <div class="btn-modal d-flex mb-2 mt-3 gap-3">
                        <button class="btn icon-left btn-success d-flex" data-bs-route="{{ route('manage-pesanan-proses.create') }}" data-bs-target="#CUModal" data-bs-toggle="modal" id="btnCreateModal" type="button "><i class="bi bi-plus-lg"></i>
                            Pesanan
                        </button>
                        <button class="btn btn-primary icon-left d-flex" data-bs-target="#FilterModal" data-bs-toggle="modal" type="button "><i class="bi bi-filter"></i>
                            Tanggal
                        </button>
                        <button class="btn btn-secondary icon-left d-flex" id="refresh" type="button "><i class="bi bi-arrow-clockwise"></i>
                            Reset
                        </button>
                    </div>
                    @if (session()->has('success_add_pesanan'))
                        <div class="alert alert-success m-3">{{ session()->get('success_add_pesanan') }}</div>
                    @elseif (session()->has('error_add_pesanan'))
                        <div class="alert alert-danger m-3">{{ session()->get('error_add_pesanan') }}</div>
                    @elseif (session()->has('success_edit_pesanan'))
                        <div class="alert alert-success m-3">{{ session()->get('success_edit_pesanan') }}</div>
                    @elseif (session()->has('error_edit_pesanan'))
                        <div class="alert alert-danger m-3">{{ session()->get('error_edit_pesanan') }}</div>
                    @elseif (session()->has('success_delete_pesanan'))
                        <div class="alert alert-success m-3">{{ session()->get('success_delete_pesanan') }}</div>
                    @endif
                    @if ($errors->has('nama-pemesan') || $errors->has('email-pemesan') || $errors->has('nama-pesanan') || $errors->has('telepon-pemesan') || $errors->has('tanggal') || $errors->has('alamat') || $errors->has('biaya-awal') || $errors->has('biaya-additional') || $errors->has('biaya-seluruh') || $errors->has('uang-muka') || $errors->has('materi-kerja') || $errors->has('additional') || $errors->has('bonus'))
                        <div class="m-3 pt-1">
                            <div class="alert alert-danger">
                                <ul style="list-style:none;">
                                    @foreach ($errors->all() as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
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
                                <th>Status Konfirmasi</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
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
                                <th>Status Konfirmasi</th>
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
                    <form autocomplete="on" id="CUForm" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-5 p-3">
                                <div class="form-inpt mt-1">
                                    <label class="form-label" for="nama-pemesan">Nama Pemesan<span class="text-danger">*</span></label>
                                    <input class="form-control" id="nama-pemesan" name="nama-pemesan" required type="text" value="{{ old('nama-pemesan') }}">
                                </div>
                                <div class="form-inpt mt-1">
                                    <p class="p-3 mb-0 bg-danger text-white rounded mt-3">Pastikan bahwa email yang dimasukan sudah terdaftar sebagai user. Daftar akun dapat dilihat di <a href="/manage-admin" class="">Manage Akun</a> pada daftar akun masyarakat</p>
                                    <label class="form-label" for="email-pemesan">Email Pemesan<span class="text-danger">*</span></label>
                                    <input class="form-control" id="email-pemesan" name="email-pemesan"required type="email" value="{{ old('email-pemesan') }}">
                                </div>
                                <div class="form-inpt mt-1">
                                    <label class="form-label" for="nama-pesanan">Nama Pesanan<span class="text-danger">*</span></label>
                                    <input class="form-control" id="nama-pesanan" name="nama-pesanan" required type="text" value="{{ old('nama-pesanan') }}">
                                </div>
                                <div class="form-inpt mt-1">
                                    <label class="form-label" for="telepon-pemesan">Telepon/HP<span class="text-danger">*</span></label>
                                    <input class="form-control" id="telepon-pemesan" name="telepon-pemesan" required type="tel" value="{{ old('telepon-pemesan') }}">
                                </div>
                                <div class="form-inpt mt-1">
                                    <label class="form-label" for="tanggal">Tanggal Akad & Resepsi<span class="text-danger">*</span></label>
                                    <div class="input-group input-datecreate input-append date" data-date-format="dd-mm-yyyy">
                                        <input class="form-control" id="tanggal" name="tanggal" required type="text" value="{{ old('tanggal') }}">
                                        <button class="btn btn-outline-secondary" type="button">
                                            <i class="far fa-calendar-alt"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-inpt mt-1">
                                    <label class="form-label" for="alamat">Alamat Akad & Resepsi<span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="alamat" name="alamat" required>{{ old('alamat') }}</textarea>
                                </div>
                                <div class="form-inpt mt-1">
                                    <label class="form-label" for="biaya-awal">Total Biaya Awal<span class="text-danger">*</span></label>
                                    <input class="form-control" id="biaya-awal" name="biaya-awal" required type="number" value="{{ old('biaya-awal') }}">
                                </div>
                                <div class="form-inpt mt-1">
                                    <label class="form-label" for="biaya-additional">Total Biaya Additional<span class="text-danger">*</span></label>
                                    <input class="form-control" id="biaya-additional" name="biaya-additional" required type="number" value="{{ old('biaya-additional') }}">
                                </div>
                                <div class="form-inpt mt-1">
                                    <label class="form-label" for="biaya-seluruh">Total Biaya Seluruh<span class="text-danger">*</span></label>
                                    <input class="form-control" id="biaya-seluruh" name="biaya-seluruh" required type="number" value="{{ old('biaya-seluruh') }}">
                                </div>
                                <div class="form-inpt mt-1">
                                    <label class="form-label" for="uang-muka">Uang Muka(DP) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="uang-muka" name="uang-muka" required type="number" value="{{ old('uang-muka') }}">
                                </div>
                                <div class="form-inpt mt-1">
                                    <label class="form-label" for="materi-kerja">Materi Kerja<span class="text-danger">*</span></label>
                                    <textarea id="materi-kerja" name="materi-kerja">{{ old('materi-kerja') }}</textarea>
                                </div>
                                <div class="form-inpt mt-2">
                                    <label class="form-label" for="additional">Additional<span class="text-danger">*</span></label>
                                    <textarea id="additional" name="additional">{{ old('additional') }}</textarea>
                                </div>
                                <div class="form-inpt mt-2">
                                    <label class="form-label" for="bonus">Bonus<span class="text-danger">*</span></label>
                                    <textarea id="bonus" name="bonus">{{ old('bonus') }}</textarea>
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

        <!-- modal delete product dan category -->
        <div aria-hidden="true" aria-labelledby="deleteModalLabel" class="modal fade" id="DeleteModal" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="deleteModalLabel">Peringatan!</h5>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                    </div>
                    <div class="modal-body">
                        <h6>Yakin Ingin Menghapusnya?</h6>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" id="closeModal" type="button">Tutup</button>
                        <form method="post">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger" type="submit">YA</button>
                        </form>
                    </div>
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
    <script src="{{ asset('templates') }}/vendor/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js" charset="UTF-8"></script>
    <script>
        $(document).ready(function() {
            //Iniliasi datepicker pada class input
            $('.input-datecreate').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'dd-mm-yyyy',
                language: 'id-ID'
            });

            $('.input-daterange').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd',
                language: 'id-ID'
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            //LOAD DATATABLE
            //script untuk memanggil data json dari server dan menampilkannya berupa datatable
            //load data menggunakan parameter tanggal dari dan tanggal hingga
            function load_data(start_date = '', end_date = '') {
                // Script untuk dari server
                $('#table-pesanan').DataTable({
                    processing: true,
                    responsive: true,
                    //  serverSide: true, //aktifkan server-side
                    ajax: {
                        url: "{{ route('manage-pesanan-proses.index') }}",
                        type: 'GET',
                        data: {
                            start_date: start_date,
                            end_date: end_date
                        } //jangan lupa kirim parameter tanggal
                    },
                    columnDefs: [{
                        targets: 0,
                        className: "fw-bolder"
                    }, {
                        targets: 8,
                        className: "text-success"
                    }, {
                        orderable: false,
                        searchable: false,
                        targets: 9
                    }],
                    columns: [{
                            data: 'nama_pemesan',
                            name: 'nama_pemesan'
                        },
                        {
                            data: 'telepon_pemesan',
                            name: 'telepon_pemesan'
                        },
                        {
                            data: 'tanggal_akad_dan_resepsi',
                            name: 'tanggal_akad_dan_resepsi'
                        },
                        {
                            data: 'alamat_akad_dan_resepsi',
                            name: 'alamat_akad_dan_resepsi'
                        },
                        {
                            data: 'total_biaya_awal',
                            name: 'total_biaya_awal'
                        },
                        {
                            data: 'total_biaya_seluruh',
                            name: 'total_biaya_seluruh'
                        },
                        {
                            data: 'uang_muka',
                            name: 'uang_muka'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'status_konfirmasi',
                            name: 'status_konfirmasi'
                        },
                        {
                            data: 'aksi',
                            name: 'aksi'
                        },
                    ],
                    order: []

                });
            }
            load_data();

            // Ketika button filter diklik
            document.getElementById('filter').addEventListener('click', function() {
                const start_date = document.getElementById('start_date').value;
                const end_date = document.getElementById('end_date').value;
                if (start_date != '' && end_date != '') {
                    document.getElementById('table-pesanan').DataTable().destroy();
                    load_data(start_date, end_date);
                } else {
                    alert('Both Date is required');
                }
            });

            // Ketika button reset diklik
            document.getElementById('refresh').addEventListener('click', function() {
                document.getElementById('start_date').value = '';
                document.getElementById('end_date').value = '';
                document.getElementById('table-pesanan').DataTable().destroy();
                load_data();
            });
        })
    </script>
    <script src="{{ asset('templates') }}/vendor/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#materi-kerja',
            plugins: [
                'lists', 'wordcount'
            ],
            menubar: 'edit insert format',
            toolbar: 'bullist numlist',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
        });
        tinymce.init({
            selector: 'textarea#additional',
            plugins: [
                'lists', 'wordcount'
            ],
            menubar: 'edit insert format',
            toolbar: 'bullist numlist',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
        });
        tinymce.init({
            selector: 'textarea#bonus',
            plugins: [
                'lists', 'wordcount'
            ],
            menubar: 'edit insert format',
            toolbar: 'bullist numlist',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
        });
    </script>
    <script>
        /**
         * Buat pesanan & Ubah Pesanan
         */
        const CUModal = document.getElementById('CUModal'); // abmil elemen div modal-nya
        const CUForm = CUModal.querySelector('.modal-content form#CUForm'); // ambil elemen form-nya
        const titleModal = CUModal.querySelector('.modal-content .modal-header h5#cuModalLabel.modal-title'); // abmil elemen h5 judul form-nya
        const csrfField = CUForm.querySelector('#CUForm input[name="_token"]'); // ambil elemen input csrf
        const btnSubmit = document.querySelector('#CUForm div.modal-footer button.btn.icon-left.btn-success.mb-2'); // ambil elemen button submit-nya

        /* Select input untuk diisi ketika update */
        const InputNamaPemesanElement = document.querySelector('.modal-content .modal-body input#nama-pemesan'); // ambil elemen input
        const InputEmailPemesanElement = document.querySelector('.modal-content .modal-body input#email-pemesan'); // ambil elemen input
        const InputNamaPesananElement = document.querySelector('.modal-content .modal-body input#nama-pesanan'); // ambil elemen input
        const InputTeleponPemesanElement = document.querySelector('.modal-content .modal-body input#telepon-pemesan'); // ambil elemen input
        const InputTanggalElement = document.querySelector('.modal-content .modal-body input#tanggal'); // ambil elemen input
        const InputAlamatElement = document.querySelector('.modal-content .modal-body textarea#alamat'); // ambil elemen input
        const InputBiayaAwalElement = document.querySelector('.modal-content .modal-body input#biaya-awal'); // ambil elemen input
        const InputBiayaAdditionalElement = document.querySelector('.modal-content .modal-body input#biaya-additional'); // ambil elemen input
        const InputBiayaSeluruhElement = document.querySelector('.modal-content .modal-body input#biaya-seluruh'); // ambil elemen input
        const InputUangMukaElement = document.querySelector('.modal-content .modal-body input#uang-muka'); // ambil elemen input
        const InputMateriKerjaElement = document.querySelector('.modal-content .modal-body textarea#materi-kerja'); // ambil elemen input
        const InputAdditionalElement = document.querySelector('.modal-content .modal-body textarea#additional'); // ambil elemen input
        const InputBonusElement = document.querySelector('.modal-content .modal-body textarea#bonus'); // ambil elemen input

        CUModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget; // ambil elemen button yang berelasi
            const btnID = button.getAttribute('id'); // ambil attribute id
            const route = button.getAttribute('data-bs-route'); // ambil attribute data-bs-route
            if (btnID === 'btnCreateModal') {
                CUForm.action = route;
                titleModal.textContent = 'Tambah Pesanan';
            }

            if (btnID === 'btnUpdateModal') {
                // Extract info from data-bs-* attributes
                const rawData = button.getAttribute('data-bs-pesanan');
                const parseData = JSON.parse(rawData);
                // The modal's content.
                CUForm.action = route;
                const createField = document.createElement('input');
                createField.type = 'hidden';
                createField.name = '_method';
                createField.value = 'PUT';
                csrfField.insertAdjacentElement('beforebegin', createField);
                titleModal.textContent = 'Ubah Pesanan';
                btnSubmit.textContent = 'Ubah'; // Ubah text tombol submit

                InputNamaPemesanElement.value = parseData.nama_pemesan;
                InputEmailPemesanElement.value = parseData.email_pemesan;
                InputNamaPesananElement.value = parseData.nama_pesanan;
                InputTeleponPemesanElement.value = parseData.telepon_pemesan;
                InputTanggalElement.value = parseData.tanggal_akad_dan_resepsi;
                InputAlamatElement.value = parseData.alamat_akad_dan_resepsi;
                InputBiayaAwalElement.value = parseData.total_biaya_awal;
                InputBiayaAdditionalElement.value = parseData.total_biaya_additional;
                InputBiayaSeluruhElement.value = parseData.total_biaya_seluruh;
                InputUangMukaElement.value = parseData.uang_muka;
                tinymce.get('materi-kerja').setContent(parseData.materi_kerja);
                tinymce.get('additional').setContent(parseData.additional);
                tinymce.get('bonus').setContent(parseData.bonus);
            }
        });

        CUModal.addEventListener('hidden.bs.modal', (event) => {
            const methodField = CUForm.querySelector('input[name="_method"]');
            if (methodField !== null) {
                methodField.remove();
            }
            CUForm.action = '#';
            InputNamaPemesanElement.value = '';
            InputEmailPemesanElement.value = '';
            InputNamaPesananElement.value = '';
            InputTeleponPemesanElement.value = '';
            InputTanggalElement.value = '';
            InputAlamatElement.value = '';
            InputBiayaAwalElement.value = null;
            InputBiayaAdditionalElement.value = null;
            InputBiayaSeluruhElement.value = null;
            InputUangMukaElement.value = null;
            tinymce.activeEditor.setContent('');
            btnSubmit.textContent = 'Tambah'; // Ubah text tombol submit
        });

        /**
         * Hapus Pesanan
         */
        const deleteModal = document.getElementById('DeleteModal');
        deleteModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget;
            const route = button.getAttribute('data-bs-route');
            deleteModal.querySelector('.modal-content .modal-footer form').setAttribute('action', route);
        });
    </script>
@endpush
