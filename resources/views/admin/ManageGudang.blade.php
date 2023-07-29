@extends('admin.layouts.layouts')
@section('title', 'Manage Gudang')

@section('content')
    <div class="content-wrapper container">
        <div class="row same-height">
            <div class="col-sm-9">
                <div class="card">
                    @if (session()->has('success_add_barang'))
                        <div class="alert alert-success m-3">{{ session()->get('success_add_barang') }}</div>
                    @elseif (session()->has('error_add_barang'))
                        <div class="alert alert-danger m-3">{{ session()->get('error_add_barang') }}</div>
                    @elseif(session()->has('success_edit_barang'))
                        <div class="alert alert-success m-3">{{ session()->get('success_edit_barang') }}</div>
                    @elseif(session()->has('error_edit_barang'))
                        <div class="alert alert-danger m-3">{{ session()->get('error_edit_barang') }}</div>
                    @elseif(session()->has('success_delete_barang'))
                        <div class="alert alert-success m-3">{{ session()->get('success_delete_barang') }}</div>
                    @elseif(session()->has('error_delete_barang'))
                        <div class="alert alert-danger m-3">{{ session()->get('error_delete_barang') }}</div>
                    @endif
                    @if ($errors->has('nama') || $errors->has('kategori') || $errors->has('stok'))
                        <div class="pt-1 m-3">
                            <div class="alert alert-danger text-capitalize">
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
                            <button class="btn mb-2 icon-left  btn-success" data-bs-route="{{ route('manage-gudang.store') }}" data-bs-target="#CUModal" data-bs-toggle="modal" id="btnCreateModal" type="button"><i class="bi bi-plus-lg"></i>Tambah Barang</i></button>
                        </div>
                        <table class="table display" id="table-barang">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Kategori Barang</th>
                                    <th>Stok</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
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
                            @if (session()->has('success_add_categorybarang'))
                                <div class="alert alert-success m-3">{{ session()->get('success_add_categorybarang') }}</div>
                            @elseif (session()->has('error_add_categorybarang'))
                                <div class="alert alert-danger m-3">{{ session()->get('error_add_categorybarang') }}</div>
                            @elseif (session()->has('success_delete_categorybarang'))
                                <div class="alert alert-success m-3">{{ session()->get('success_delete_categorybarang') }}</div>
                            @elseif (session()->has('error_delete_categorybarang'))
                                <div class="alert alert-danger m-3">{{ session()->get('error_delete_categorybarang') }}</div>
                            @endif
                            @if ($errors->has('nama_kategori_barang'))
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
                            <form action="{{ route('manage-gudang.createcategorybarang') }}" class="mt-3" method="POST">
                                <div class="form-inpt d-flex">
                                    @csrf
                                    <input class="form-control" id="nama_kategori_barang" name="nama_kategori_barang" placeholder="Masukan nama kategori barang" type="text" value="{{ old('nama_kategori_barang') }}">
                                    <button class="btn btn-success" type="submit"><i class="bi bi-plus-lg"></i></button>
                                </div>
                            </form>
                            <div class="mt-4">
                                @foreach ($get_category_barang as $value)
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $value->nama_kategori_barang }}
                                            <button class="btn text-danger" data-bs-route="{{ route('manage-gudang.destroycategorybarang', $value->id) }}" data-bs-target="#DeleteModal" data-bs-toggle="modal" id="btnDeleteModal" type="button"><i class="bi bi-trash"></i></button>
                                        </li>
                                    </ul>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal create and update barang -->
        <div aria-hidden="true" class="modal fade" id="CUModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cuModalLabel">Tambah Barang</h5>
                        <button class="btn-close" data-bs-dismiss="modal" type="button"></button>
                    </div>
                    <form id="CUForm" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="p-3 mb-5">
                                <div class="form-inpt">
                                    <label class="form-label" for="nama">Nama Barang</label>
                                    <input class="form-control" id="nama" name="nama" placeholder="Masukan Nama Barang" type="text" value="{{ old('nama') }}">
                                </div>
                                <div class="form-inpt mt-3">
                                    <label class="form-label" for="kategori">Jenis Barang</label>
                                    <select class="form-select" id="kategori" name="kategori">
                                        <option disabled selected value="">Pilih kategori barang</option>
                                        @foreach ($get_category_barang as $value)
                                            <option @selected(old('kategori') == $value->id) value="{{ $value->id }}">
                                                {{ $value->nama_kategori_barang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-inpt mt-3">
                                    <label class="form-label" for="stok">Stok Barang</label>
                                    <input class="form-control" id="stok" name="stok" placeholder="Masukan jumlah stok" type="number" value="{{ old('stok') }}">
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

        <!-- Modal delete barang dan category barang -->
        <div aria-hidden="true" class="modal fade" id="DeleteModal" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="deleteModalLabel">Peringatan!</h5>
                        <button class="btn-close" data-bs-dismiss="modal" type="button"></button>
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
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table-barang').DataTable({
                processing: true,
                searching: true,
                serverSide: true,
                responsive: true,
                ordering: true,
                ajax: {
                    url: '{{ url()->current() }}'
                },
                columnDefs: [{
                    targets: 0,
                    className: "fw-bolder"
                }, {
                    orderable: false,
                    searchable: false,
                    targets: 3
                }],
                columns: [{
                        data: 'nama_barang',
                        name: 'nama_barang'
                    },
                    {
                        data: 'kategori_id',
                        name: 'kategori_id'
                    },
                    {
                        data: 'stok',
                        name: 'stok'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ],
                order: [],
            });
        })
    </script>

    <script>
        /**
         * Buat Barang & Ubah Barang
         */
        let CUModal = document.getElementById('CUModal');
        let CUForm = CUModal.querySelector('.modal-content form#CUForm');
        let titleModal = CUModal.querySelector('.modal-content .modal-header h5#cuModalLabel.modal-title');
        let namaBarang = CUModal.querySelector('.modal-content .modal-body input#nama');
        let kategoriBarang = CUModal.querySelector('.modal-content .modal-body select#kategori');
        let stokBarang = CUModal.querySelector('.modal-content .modal-body input#stok');
        let btnSubmit = document.querySelector('.modal-content .modal-footer .btn.btn-success');
        let csrfField = CUForm.querySelector('input[name="_token"]');

        CUModal.addEventListener('show.bs.modal', (event) => {
            let button = event.relatedTarget;
            let btnID = button.getAttribute('id');
            let route = button.getAttribute('data-bs-route');
            if (btnID === 'btnUpdateModal') {
                // Extract info from data-bs-* attributes
                let rawData = button.getAttribute('data-bs-barang');
                let parseData = JSON.parse(rawData);
                // The modal's content.
                CUForm.action = route;
                let createField = document.createElement('input');
                createField.type = 'hidden';
                createField.name = '_method';
                createField.value = 'PUT';
                csrfField.insertAdjacentElement('beforebegin', createField);
                titleModal.textContent = 'Ubah Barang';
                namaBarang.value = parseData.nama_barang;
                kategoriBarang.value = parseData.kategori_id;
                stokBarang.value = parseData.stok;
                btnSubmit.textContent = 'Ubah'; // Ubah text tombol submit
            }
            if (btnID === 'btnCreateModal') {
                CUForm.action = route;
                titleModal.textContent = 'Tambah Barang';
            }
        });

        CUModal.addEventListener('hidden.bs.modal', (event) => {
            let methodField = CUForm.querySelector('input[name="_method"]');
            if (methodField !== null) {
                methodField.remove();
            }
            let url = `#`;
            CUForm.action = url;
            namaBarang.value = '';
            kategoriBarang.value = '';
            stokBarang.value = ''
            btnSubmit.textContent = 'Tambah'; // Ubah text tombol submit
        });

        /**
         * Hapus Barang
         */
        let deleteModal = document.getElementById('DeleteModal');
        deleteModal.addEventListener('show.bs.modal', (event) => {
            let button = event.relatedTarget;
            let route = button.getAttribute('data-bs-route');
            deleteModal.querySelector('.modal-content .modal-footer form').setAttribute('action', route);
        });
    </script>
@endpush
