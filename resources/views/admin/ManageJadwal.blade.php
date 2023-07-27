@extends('admin.layouts.layouts')
@section('title', 'Manage Jadwal')
@push('styles')
    <link href="{{ asset('templates') }}/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
@endpush
@section('content')
    <section class="manage-akun container">
        <div class="content-wrapper">
            <div class="row same-height">
                <div class="card">
                    @if ($errors->any())
                        <div class="pt-3">
                            <div class="alert alert-danger text-capitalize">
                                <p>Lengkapi Data Secara lengkap!</p>
                                <ul class="pt=10" style="list-style:none;">
                                    @foreach ($errors->all() as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="btn-modal mb-2 mt-3">
                            <button class="btn icon-left btn-success mb-2" data-bs-route="{{ route('manage-jadwal.store') }}" data-bs-target="#jadwalModal" data-bs-toggle="modal" id="create-button" type="button"><i class="bi bi-plus-lg"></i>Tambah Jadwal</button>
                        </div>
                        <table class="display table" id="table-jadwal">
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
                            <tbody></tbody>
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

        {{-- Modal CRUD Jadwal --}}
        <div aria-hidden="true" aria-labelledby="jadwalModalLabel" class="modal fade" id="jadwalModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="jadwalModalLabel">Tambah Jadwal</h5>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-5 p-3">
                            <form id="jadwalForm" method="post">
                                @csrf
                                <div class="form-inpt">
                                    <label class="form-label" for="nama">Nama</label>
                                    <input class="form-control" id="nama" name="nama" placeholder="Masukan Nama" type="text" value="{{ old('nama') }}">
                                </div>
                                <div class="form-inpt">
                                    <label class="form-label" for="lokasi">Lokasi</label>
                                    <input class="form-control" id="lokasi" name="lokasi" placeholder="Masukan Lokasi Kegiatan" type="text" value="{{ old('lokasi') }}">
                                </div>
                                <div class="form-inpt">
                                    <label class="form-label" for="jam">Jam Kegiatan</label>
                                    <input class="form-control" id="jam" name="jam" type="time" value="{{ old('jam') }}">
                                </div>
                                <div class="form-inpt">
                                    <label class="form-label" for="tanggal">Tentukan Tanggal</label>
                                    <div class="input-group input-append date" data-date-format="dd-mm-yyyy">
                                        <input autocomplete="off" class="form-control" id="tanggal" name="tanggal" placeholder="Masukan Tanggal" type="text" value="{{ old('tanggal') }}">
                                        <button class="btn btn-outline-secondary" type="button">
                                            <i class="far fa-calendar-alt"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-inpt">
                                    <label class="form-label" for="kegiatan">Kegiatan</label>
                                    <textarea class="form-control" id="kegiatan" name="kegiatan" rows="3">{{ old('kegiatan') }}</textarea>
                                </div>
                            </form>
                        </div>
                        <h6 id="deleteConfirmationText"></h6>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" form="jadwalForm" type="button">Tutup</button>
                        <button class="btn icon-left btn-success mb-2" form="jadwalForm" name="submit" type="submit"><i class="ti-plus"></i>Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')
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
    <script>
        $(document).ready(function() {
            $('#table-jadwal').DataTable({
                processing: true,
                searching: true,
                serverSide: true,
                responsive: true,
                ordering: true,
                ajax: {
                    url: '{{ url()->current() }}'
                },
                columnDefs: [{
                    orderable: false,
                    searchable: false,
                    targets: 5
                }],
                columns: [{
                        data: 'nama',
                        name: 'nama',
                    },
                    {
                        data: 'kegiatan',
                        name: 'kegiatan'
                    },
                    {
                        data: 'lokasi',
                        name: 'lokasi'
                    },
                    {
                        data: 'jam',
                        name: 'jam',
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal',
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                    },
                ],
                order: [],
            });
        });
    </script>
    <script>
        let jadwalModal = document.getElementById('jadwalModal');
        let jadwalForm = document.querySelector('.modal-content #jadwalForm');
        let jadwalTitleModal = document.querySelector('.modal-content .modal-header h5#jadwalModalLabel');
        let namaField = document.querySelector('.modal-content .modal-body input#nama');
        let kegiatanField = document.querySelector('.modal-content .modal-body input#nama');
        let lokasiField = document.querySelector('.modal-content .modal-body input#lokasi')
        let jamField = document.querySelector('.modal-content .modal-body input#jam');
        let tanggalField = document.querySelector('.modal-content .modal-body input#tanggal');
        let csrfField = jadwalForm.querySelector('input[name="_token"]');
        let childModalBody = document.querySelector('.modal-content .modal-body .p-3.mb-5');
        let deleteConfirmationMessage = jadwalForm.querySelector('.modal-content .modal-body #deleteConfirmationText');
        let modalDialog = document.querySelector('.modal-dialog');
        let btnSubmit = document.querySelector('.modal-content .modal-footer .btn.btn-success');
        // Saat modal ditampilkan
        jadwalModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget; // Ambil elemen yang berhubungan
            const btnID = button.getAttribute('id'); // Ambil attribut id
            const route = button.getAttribute('data-bs-route'); // Ambil attribut data-bs-route

            //Create
            if (btnID === 'create-button') {
                jadwalForm.action = route; // Ambil route dari tombol dengan id create-button
                jadwalTitleModal.textContent = 'Tambah Jadwal' // Ubah Title-nya
            }
            //Edit
            if (btnID === 'edit-button') {
                jadwalForm.action = route; // Ambil route dari tombol dengan id edit-button
                jadwalTitleModal.textContent = 'Ubah Jadwal'; // Ubah Title-nya
                const rawData = button.getAttribute('data-bs-jadwal'); // Ambil data dari tombol dengan id edit-button
                const parseData = JSON.parse(rawData); // parse data ke bentuk json js
                // Membuat method support
                const createField = document.createElement('input'); // Buat input field
                createField.type = 'hidden'; // tipe hidden
                createField.name = '_method'; // nama _method
                createField.value = 'PUT'; // nilai PUT
                csrfField.insertAdjacentElement('beforebegin', createField); // Taruh sebelum csrf field
                // Isi field hasil parseData
                const convertTimeStampToTimeJS = new Date(parseData.waktu); // konversi timestamp db ke timejs
                const hour = convertTimeStampToTimeJS.getHours().toString().padStart(2, '0'); // Ambil jam
                const minute = convertTimeStampToTimeJS.getMinutes().toString().padStart(2, '0'); // Ambil menit
                const year = convertTimeStampToTimeJS.getFullYear(); // Ambil tahun
                const month = (convertTimeStampToTimeJS.getMonth() + 1).toString().padStart(2, '0'); // Ambil bulan
                const day = convertTimeStampToTimeJS.getDate().toString().padStart(2, '0'); // Ambil Tanggal
                const convertJam = `${hour}:${minute}` // Buat format jam menjadi 23:00
                const convertTanggal = `${day}-${month}-${year}`; //  Buat format tanggal menjadi 23-06-2023
                nama.value = parseData.nama; // Isi field nama
                lokasi.value = parseData.lokasi; // Isi field lokasi
                jam.value = convertJam; // Isi field jam
                tanggal.value = convertTanggal; // Isi field tanggal
                kegiatan.value = parseData.kegiatan; // Isi field kegiatan
                btnSubmit.textContent = 'Ubah'; // Ubah text tombol submit
            }
            //Delete
            if (btnID === 'delete-button') {
                jadwalForm.action = route; // Ambil route dari tombol dengan id delete-button
                modalDialog.classList.remove('modal-lg'); // Hapus class
                modalDialog.classList.add('modal-sm'); // Tambah class
                jadwalTitleModal.textContent = 'Hapus Jadwal'; // Ubah Title-nya
                // Membuat method support
                const createField = document.createElement('input'); // Buat input field
                createField.type = 'hidden'; // tipe hidden
                createField.name = '_method'; // nama _method
                createField.value = 'DELETE'; // nilai DELETE
                csrfField.insertAdjacentElement('beforebegin', createField); // Taruh sebelum csrf field
                childModalBody.style.display = 'none'; // Sembunyikan child modal body
                deleteConfirmationText.textContent = 'Yakin ingin menghapus jadwal ini?'; // Tambah text
                btnSubmit.textContent = 'YA'; // Ubah text tombol submit
            }
        })
        // Saat modal disembunyikan
        jadwalModal.addEventListener('hidden.bs.modal', (event) => {
            childModalBody.style.display = 'block'; // Tampilkan child modal body
            jadwalForm.reset(); // Reset input field
            deleteConfirmationText.textContent = ''; // Ubah text
            modalDialog.classList.remove('modal-sm'); // Hapus class
            modalDialog.classList.add('modal-lg'); // Tambah class
            btnSubmit.textContent = 'Tambah'; // Ubah text tombol submit
        });
    </script>
@endpush
