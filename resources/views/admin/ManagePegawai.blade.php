@extends('admin.layouts.layouts')
@section('title', 'Manage Pegawai')
@push('styles')
    {{-- <link href="{{ asset('templates') }}/assets/css-modif/admin/ManagePegawai.css" rel="stylesheet"> --}}
@endpush
@section('content')
    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Pegawai</h4>
                    </div>
                    @if (session()->has('success_add_employee'))
                        <div class="alert alert-success m-3">{{ session()->get('success_add_employee') }}</div>
                    @elseif (session()->has('error_add_employee'))
                        <div class="alert alert-danger m-3">{{ session()->get('error_add_employee') }}</div>
                    @elseif(session()->has('success_edit_employee'))
                        <div class="alert alert-success m-3">{{ session()->get('success_edit_employee') }}</div>
                    @elseif(session()->has('error_edit_employee'))
                        <div class="alert alert-danger m-3">{{ session()->get('error_edit_employee') }}</div>
                    @elseif(session()->has('success_delete_employee'))
                        <div class="alert alert-success m-3">{{ session()->get('success_delete_employee') }}</div>
                    @elseif(session()->has('error_delete_employee'))
                        <div class="alert alert-danger m-3">{{ session()->get('error_delete_employee') }}</div>
                    @endif
                    @if ($errors->has('nama') || $errors->has('alamat') || $errors->has('kontak') || $errors->has('gaji') || $errors->has('jabatan') || $errors->has('foto'))
                        <div class="pt-1 m-3">
                            <div class="alert alert-danger">
                                <ul style="list-style:none;">
                                    @foreach ($errors->all() as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="btn-modal mt-3 mb-2">
                            <button class="btn mb-2 icon-left  btn-success" data-bs-route="{{ route('manage-pegawai.store') }}" data-bs-target="#CUModal" data-bs-toggle="modal" id="btnCreateModal" type="button"><i class="bi bi-plus-lg"></i>Tambah Pegawai</i></button>
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
                            @if (session()->has('success_add_categoryjabatan'))
                                <div class="alert alert-success m-3">{{ session()->get('success_add_categoryjabatan') }}</div>
                            @elseif (session()->has('error_add_categoryjabatan'))
                                <div class="alert alert-danger m-3">{{ session()->get('error_add_categoryjabatan') }}</div>
                            @elseif (session()->has('success_delete_categoryjabatan'))
                                <div class="alert alert-success m-3">{{ session()->get('success_delete_categoryjabatan') }}</div>
                            @elseif (session()->has('error_delete_categoryjabatan'))
                                <div class="alert alert-danger m-3">{{ session()->get('error_delete_categoryjabatan') }}</div>
                            @endif
                            @if ($errors->has('nama_jabatan'))
                                <div class="pt-1 m-3">
                                    <div class="alert alert-danger">
                                        <ul style="list-style:none;">
                                            @foreach ($errors->all() as $message)
                                                <li>{{ $message }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            <form action="{{ route('manage-pegawai.createjabatan') }}" class="mt-3" method="POST">
                                <div class="form-inpt  d-flex">
                                    @csrf
                                    <input class="form-control" id="nama_jabatan" name="nama_jabatan" placeholder="Masukan jabatan" type="text" type="submit" value="{{ old('nama_jabatan') }}">
                                    <button class="btn btn-success" type="submit"><i class="bi bi-plus-lg"></i></button>
                                </div>
                            </form>
                            <div class="mt-4">
                                <p class="fw-bold">Daftar Jabatan</p>
                                <ul class="list-group">
                                    @foreach ($get_jabatan as $value)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $value->nama_jabatan }}
                                            <button class="btn text-danger" data-bs-route="{{ route('manage-pegawai.destroyjabatan', $value->id) }}" data-bs-target="#DeleteModal" data-bs-toggle="modal" id="btnDeleteModal" type="button"><i class="bi bi-trash text-danger"></i></button>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal add and update employee -->
        <div aria-hidden="true" aria-labelledby="cuModalLabel" class="modal fade" id="CUModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cuModalLabel">Tambah Pegawai</h5>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                    </div>
                    <form enctype="multipart/form-data" id="CUForm" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="p-3 mb-5">
                                <div class="form-inpt">
                                    <label class="form-label" for="nama">Nama</label>
                                    <input class="form-control" id="nama" name="nama" placeholder="Masukan Nama" type="text">
                                </div>
                                <div class="form-inpt mt-3">
                                    <label class="form-label" for="alamat">Alamat Domisili</label>
                                    <input class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat Pegawai" type="text" value="">
                                </div>
                                <div class="form-inpt mt-3">
                                    <label class="form-label" for="kontak">No. Telephone</label>
                                    <input class="form-control" id="kontak" name="kontak" placeholder="Masukan Nomor Telephone" type="text" value="">
                                </div>
                                <div class="form-inpt mt-3">
                                    <label class="form-label" for="gaji">Gaji</label>
                                    <input class="form-control" id="gaji" name="gaji" placeholder="Masukan Besaran Gaji" type="number" value="">
                                </div>
                                <div class="form-inpt mt-3">
                                    <label class="form-label" for="jabatan">Jabatan</label>
                                    <select class="form-select" id="jabatan" name="jabatan">
                                        <option disabled selected value="">Pilih sesuai jabatan pegawai</option>
                                        @foreach ($get_jabatan as $value)
                                            <option value="{{ $value->id }}">
                                                {{ $value->nama_jabatan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <label class="form-label" for="foto">Foto Pegawai</label>
                                    <input id="oldImage" name="oldImage" type="hidden">
                                    <input accept="image/jpg, image/png, image/jpeg" class="form-control" id="foto" name="foto" type="file">
                                    <output class="img-result" id="result"></output>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Tutup</button>
                            <button class="btn mb-2 icon-left  btn-success" type="submit"><i class="ti-plus"></i>Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- modal delete employee dan category jabatan -->
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
    </div>

    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table-pegawai').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ url()->current() }}',
                columnDefs: [{
                    targets: 0,
                    className: "fw-bolder"
                }],
                columns: [{
                        data: 'nama', // db
                        name: 'nama'
                    },
                    {
                        data: 'alamat_domisili', // db
                        name: 'alamat_domisili'
                    },
                    {
                        data: 'kontak',
                        name: 'kontak'
                    },
                    {
                        data: 'Besaran Gaji',
                        name: 'Besaran Gaji',
                    },
                    {
                        data: 'Jabatan',
                        name: 'Jabatan'
                    },
                    {
                        data: 'Foto',
                        name: 'Foto'
                    },
                    {
                        data: 'Aksi',
                        name: 'Aksi'
                    },
                ],
                order: [
                    [1, 'asc']
                ],
            });
        })
    </script>
    <script>
        /**
         * Buat Pegawai & Ubah Pegawai
         */
        let CUModal = document.getElementById('CUModal');
        let CUForm = CUModal.querySelector('.modal-content form#CUForm');
        let titleModal = CUModal.querySelector('.modal-content .modal-header h5#cuModalLabel.modal-title');
        let namaPegawai = CUModal.querySelector('.modal-content .modal-body input#nama');
        let alamatPegawai = CUModal.querySelector('.modal-content .modal-body input#alamat');
        let kontakPegawai = CUModal.querySelector('.modal-content .modal-body input#kontak');
        let gajiPegawai = CUModal.querySelector('.modal-content .modal-body input#gaji');
        let jabatanPegawai = CUModal.querySelector('.modal-content .modal-body select#jabatan');

        let btnSubmit = document.querySelector('.modal-content .modal-footer .btn.btn-success');
        let csrfField = CUForm.querySelector('input[name="_token"]');
        let oldImageField = document.querySelector('.modal-content .modal-body input#oldImage');
        let imgFile = CUModal.querySelector('.modal-content .modal-body input#foto');
        let output = CUModal.querySelector('.modal-content .modal-body output#result');

        CUModal.addEventListener('show.bs.modal', (event) => {
            let button = event.relatedTarget;
            let btnID = button.getAttribute('id');
            let route = button.getAttribute('data-bs-route');
            let img = document.createElement('img');
            img.className = 'thumbnail';
            img.height = 240;
            img.width = 320;
            imgFile.addEventListener('change', (e) => {
                if (window.File && window.FileReader && window.FileList && window.Blob) {
                    let file = e.target.files;

                    // if files is image
                    if (file[0].type.match('image')) {
                        let picReader = new FileReader();
                        picReader.addEventListener('load', function(event) {
                            let picFile = event.target;
                            img.src = `${picFile.result}`;
                            img.title = `${picFile.name}`;
                            // cek apakah ada/belum child-nya
                            if (output.hasChildNodes()) {
                                output.replaceChildren(img);
                            } else {
                                output.appendChild(img);
                            }
                        });
                        picReader.readAsDataURL(file[0]);
                    }
                } else {
                    alert('your browswer does not support the file API');
                }
            });
            if (btnID === 'btnUpdateModal') {
                // Extract info from data-bs-* attributes
                let rawData = button.getAttribute('data-bs-product');
                let parseData = JSON.parse(rawData);
                // The modal's content.
                CUForm.action = route;
                let createField = document.createElement('input');
                createField.type = 'hidden';
                createField.name = '_method';
                createField.value = 'PUT';
                csrfField.insertAdjacentElement('beforebegin', createField);
                titleModal.textContent = 'Ubah Pegawai';
                namaPegawai.value = parseData.nama;
                alamatPegawai.value = parseData.alamat_domisili;
                kontakPegawai.value = parseData.kontak;
                gajiPegawai.value = parseData.besaran_gaji;
                jabatanPegawai.value = parseData.jabatan;

                if (parseData.foto) {
                    let picFile = parseData.foto;
                    let src = `/storage/compressed${picFile}`;
                    img.src = `${src}`;
                    img.title = `${parseData.nama}`;
                    if (output.hasChildNodes()) {
                        output.replaceChildren(img);
                    } else {
                        output.appendChild(img);
                    }
                    oldImageField.value = picFile;
                }
                btnSubmit.textContent = 'Ubah'; // Ubah text tombol submit
            }
            if (btnID === 'btnCreateModal') {
                CUForm.action = route;
                titleModal.textContent = 'Tambah Produk';
            }
        });

        CUModal.addEventListener('hidden.bs.modal', (event) => {
            let methodField = CUForm.querySelector('input[name="_method"]');
            if (methodField !== null) {
                methodField.remove();
            }
            let url = `#`;
            CUForm.action = url;
            namaPegawai.value = null;
            alamatPegawai.value = '';
            kontakPegawai.value = null;
            gajiPegawai.value = null;
            if (output.hasChildNodes()) {
                imgFile.value = null;
                output.removeChild(output.firstChild);
            }
            btnSubmit.textContent = 'Tambah'; // Ubah text tombol submit
        });

        /**
         * Hapus Pegawai
         */
        let deleteModal = document.getElementById('DeleteModal');
        deleteModal.addEventListener('show.bs.modal', (event) => {
            let button = event.relatedTarget;
            let route = button.getAttribute('data-bs-route');
            deleteModal.querySelector('.modal-content .modal-footer form').setAttribute('action', route);
        });
    </script>
@endpush
