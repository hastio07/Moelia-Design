@extends('admin.layouts.layouts')
@section('title', 'Manage Akun')
@push('styles')
    <link href="{{ asset('templates') }}/assets/css-modif/admin/ManageAkun.css" rel="stylesheet">
@endpush

@section('content')
    <section class="">
        <div class="card p-3">
            <div class="btn-modal">
                <button class="btn icon-left btn-success mb-2" data-bs-name="All-In" data-bs-route="{{ route('manage-wedding-calculator.catAllIn') }}" data-bs-target="#CUModal" data-bs-toggle="modal" id="btnCreateModal" type="button"><i class="bi bi-plus-lg"></i>Tambah Data</i></button>
            </div>
            <div class="all-in-paket">
                @php
                    $messages = [
                        'success_add_paket_allin' => ['type' => 'success', 'message' => session()->get('success_add_paket_allin')],
                        'error_add_paket_allin' => ['type' => 'danger', 'message' => session()->get('error_add_paket_allin')],
                        'success_edit_paket_allin' => ['type' => 'success', 'message' => session()->get('success_edit_paket_allin')],
                        'error_edit_paket_allin' => ['type' => 'danger', 'message' => session()->get('error_edit_paket_allin')],
                        'success_delete_allin' => ['type' => 'success', 'message' => session()->get('success_delete_allin')],
                    ];
                @endphp

                @foreach ($messages as $key => $message)
                    @isset($message['message'])
                        <div class="alert alert-{{ $message['type'] }} m-3">{{ $message['message'] }}</div>
                    @endisset
                @endforeach
                @if ($errors->has('nama-paket-allin') || $errors->has('harga-paket-allin'))
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
                <div class="card p-4">
                    <h5 class="fw-bold">Paket All-In</h5>
                    <table class="display mt-2 table" id="table-paket-all-in">
                        <thead>
                            <tr>
                                <th>Nama Paket</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <td>Paket Allin 1</td>
                            <td>135.000.000</td>
                            <td><button class="btn btn-danger"><i class="bi bi-trash3-fill"></i></button> <button class="btn btn-warning"><i class="bi bi-pencil-square"></i></button></td> --}}
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nama Paket</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="btn-modal">
                <button class="btn icon-left btn-success mb-2" data-bs-category="{{ route('manage-wedding-calculator.dataCategoryCustomVenue') }}" data-bs-name="Custom Venue" data-bs-route="{{ route('manage-wedding-calculator.catCustomVenue') }}" data-bs-target="#CUModal" data-bs-toggle="modal" id="btnCreateModal" type="button"><i class="bi bi-plus-lg"></i>Tambah Data</i></button>
            </div>
            <div class="custom-paket">
                @php
                    $messages = [
                        'success_add_paket_customvenue' => ['type' => 'success', 'message' => session()->get('success_add_paket_customvenue')],
                        'error_add_paket_customvenue' => ['type' => 'danger', 'message' => session()->get('error_add_paket_customvenue')],
                        'success_edit_paket_customvenue' => ['type' => 'success', 'message' => session()->get('success_edit_paket_customvenue')],
                        'error_edit_paket_customvenue' => ['type' => 'danger', 'message' => session()->get('error_edit_paket_customvenue')],
                        'success_delete_customvenue' => ['type' => 'success', 'message' => session()->get('success_delete_customvenue')],
                    ];
                @endphp

                @foreach ($messages as $key => $message)
                    @isset($message['message'])
                        <div class="alert alert-{{ $message['type'] }} m-3">{{ $message['message'] }}</div>
                    @endisset
                @endforeach
                @if ($errors->has('nama-paket-customvenue') || $errors->has('kategori-customvenue') || $errors->has('harga-paket-customvenue'))
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
                <div class="row">
                    <div class="col-md-9">
                        <div class="card p-4">
                            <h5 class="fw-bold">Custom Venue</h5>
                            <table class="display mt-2 table" id="table-paket-custom-venue">
                                <thead>
                                    <tr>
                                        <th>Nama Paket</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nama Paket</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3">
                            <h6 class="fw-bold text-center">Kategori Custom Venue</h6>
                            @if (session()->has('success_add_category_paket_customvenue'))
                                <div class="alert alert-success m-3">{{ session()->get('success_add_category_paket_customvenue') }}</div>
                            @elseif (session()->has('error_add_category_paket_customvenue'))
                                <div class="alert alert-danger m-3">{{ session()->get('error_add_category_paket_customvenue') }}</div>
                            @elseif (session()->has('success_delete_category_customvenue'))
                                <div class="alert alert-success m-3">{{ session()->get('success_delete_category_customvenue') }}</div>
                            @elseif (session()->has('error_delete_category_customvenue'))
                                <div class="alert alert-danger m-3">{{ session()->get('error_delete_category_customvenue') }}</div>
                            @endif
                            @if ($errors->has('nama-kategori-customvenue'))
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
                            <form action="{{ route('manage-wedding-calculator.catCategoryCustomVenue') }}" class="text-center" method="POST">
                                @csrf
                                <input class="form-control mb-3" id="kategori-customvenue" name="nama-kategori-customvenue" placeholder="Buat kategori" required type="text" value="{{ old('nama-kategori') }}">
                                <button class="btn btn-success" type="submit">Tambah</button>
                            </form>
                            <div class="list-kategori mt-2">
                                <table class="caption-top mt-3 table border" id="table-category-custom-venue">
                                    <thead>
                                        <tr>
                                            <th>Nama Kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- <tr>
                                            <td class="">Gedung</td>
                                            <td class="text-end">
                                                <button class="btn text-danger" data-bs-route="" data-bs-target="#DeleteModal" data-bs-toggle="modal" id="btnDeleteModal" type="button"><i class="bi bi-trash"></i></button>
                                            </td>
                                        </tr> --}}
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nama Kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-modal">
                <button class="btn icon-left btn-success mb-2" data-bs-category="{{ route('manage-wedding-calculator.dataCategoryAdditionalVenue') }}" data-bs-name="Additional Venue" data-bs-route="{{ route('manage-wedding-calculator.catAdditionalVenue') }}" data-bs-target="#CUModal" data-bs-toggle="modal" id="btnCreateModal" type="button"><i class="bi bi-plus-lg"></i>Tambah Data</i></button>
            </div>
            <div class="additional-venue">
                @php
                    $messages = [
                        'success_add_paket_additionalvenue' => ['type' => 'success', 'message' => session()->get('success_add_paket_additionalvenue')],
                        'error_add_paket_additionalvenue' => ['type' => 'danger', 'message' => session()->get('error_add_paket_additionalvenue')],
                        'success_edit_paket_additionalvenue' => ['type' => 'success', 'message' => session()->get('success_edit_paket_additionalvenue')],
                        'error_edit_paket_additionalvenue' => ['type' => 'danger', 'message' => session()->get('error_edit_paket_additionalvenue')],
                        'success_delete_additionalvenue' => ['type' => 'success', 'message' => session()->get('success_delete_additionalvenue')],
                    ];
                @endphp

                @foreach ($messages as $key => $message)
                    @isset($message['message'])
                        <div class="alert alert-{{ $message['type'] }} m-3">{{ $message['message'] }}</div>
                    @endisset
                @endforeach
                @if ($errors->has('nama-paket-additionalvenue') || $errors->has('kategori-additionalvenue') || $errors->has('harga-paket-additionalvenue'))
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
                <div class="row">
                    <div class="col-md-9">
                        <div class="card p-4">
                            <h5 class="fw-bold">Additional Venue</h5>
                            <table class="display mt-2 table" id="table-paket-additional-venue">
                                <thead>
                                    <tr>
                                        <th>Nama Paket</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nama Paket</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card p-3">
                            <h6 class="fw-bold text-center">Kategori Additional Venue</h6>
                            @if (session()->has('success_add_category_paket_additionalvenue'))
                                <div class="alert alert-success m-3">{{ session()->get('success_add_category_paket_additionalvenue') }}</div>
                            @elseif (session()->has('error_add_category_paket_additionalvenue'))
                                <div class="alert alert-danger m-3">{{ session()->get('error_add_category_paket_additionalvenue') }}</div>
                            @elseif (session()->has('success_delete_category_additionalvenue'))
                                <div class="alert alert-success m-3">{{ session()->get('success_delete_category_additionalvenue') }}</div>
                            @elseif (session()->has('error_delete_category_additionalvenue'))
                                <div class="alert alert-danger m-3">{{ session()->get('error_delete_category_additionalvenue') }}</div>
                            @endif
                            @if ($errors->has('nama-kategori-additionalvenue'))
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
                            <form action="{{ route('manage-wedding-calculator.catCategoryAdditionalVenue') }}" class="text-center" method="POST">
                                @csrf
                                <input class="form-control mb-3" id="kategori-additionalvenue" name="nama-kategori-additionalvenue" placeholder="Buat kategori" required type="text" value="{{ old('nama-kategori') }}">
                                <button class="btn btn-success" type="submit">Tambah</button>
                            </form>
                            <div class="list-kategori mt-2">
                                <table class="caption-top mt-3 table border" id="table-category-additional-venue">
                                    <thead>
                                        <tr>
                                            <th>Nama Kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nama Kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div aria-hidden="true" aria-labelledby="cuModalLabel" class="modal fade" id="CUModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cuModalLabel">Tambah Paket</h5>
                            <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                        </div>
                        <form enctype="multipart/form-data" id="CUForm" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-5 p-3">
                                    <div class="form-inpt">
                                        <label class="form-label" for="nama-paket">Nama Paket<span class="text-danger">*</span></label>
                                        <input class="form-control" id="nama-paket" name="nama-paket" placeholder="Masukan nama paket" type="text" value="{{ old('nama-paket') }}">
                                    </div>
                                    <div id="pilih-kategori">
                                    </div>
                                    {{-- <div class="form-inpt">
                                        <label class="form-label" for="kategori">Kategori<span class="text-danger">*</span></label>
                                        <select aria-label="Default select example" class="form-select form-select" id="kategori" name="kategori">
                                            <option disabled selected value="">-- Pilih Kategori --</option>
                                        </select>
                                    </div> --}}
                                    <div class="form-inpt">
                                        <label class="form-label" for="harga-paket">Harga Paket<span class="text-danger">*</span></label>
                                        <input class="form-control" id="harga-paket" name="harga-paket" placeholder="Masukan harga paket" type="number" value="{{ old('harga-paket') }}">
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Tutup</button>
                                <button class="btn icon-left btn-success mb-2" type="submit"><i class="ti-check"></i>Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

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
    </section>
@endsection

@push('scripts')
    <script>
        // Mendapatkan data dari server
        $(document).ready(function() {
            $('#table-paket-all-in').DataTable({
                processing: true,
                searching: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: '{{ route('manage-wedding-calculator.getAllIn') }}'
                },
                columnDefs: [{
                    orderable: false,
                    searchable: false,
                    targets: 2
                }],
                columns: [{
                        data: 'nama_paket',
                        name: 'nama_paket'
                    },
                    {
                        data: 'harga',
                        name: 'harga'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                    },

                ],
                order: [],
            });

            $('#table-paket-custom-venue').DataTable({
                processing: true,
                searching: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: '{{ route('manage-wedding-calculator.getCustomVenue') }}'
                },
                columnDefs: [{
                    orderable: false,
                    searchable: false,
                    targets: 3
                }],
                columns: [{
                        data: 'nama_paket',
                        name: 'nama_paket'
                    },
                    {
                        data: 'kategori_id',
                        name: 'kategori_id'
                    },
                    {
                        data: 'harga',
                        name: 'harga'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                    },

                ],
                order: [],
            });

            $('#table-paket-additional-venue').DataTable({
                processing: true,
                searching: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: '{{ route('manage-wedding-calculator.getAdditionalVenue') }}'
                },
                columnDefs: [{
                    orderable: false,
                    searchable: false,
                    targets: 3
                }],
                columns: [{
                        data: 'nama_paket',
                        name: 'nama_paket',
                    },
                    {
                        data: 'kategori_id',
                        name: 'kategori_id',
                    },
                    {
                        data: 'harga',
                        name: 'harga',
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                    },

                ],
                order: [],
            });

            $('#table-category-custom-venue').DataTable({
                processing: true,
                searching: true,
                serverSide: true,
                responsive: true,
                /* drawCallback: function() {
                     $(this.api().table().header()).hide();
                     $(this.api().table().footer()).hide();
                 }, */
                ajax: {
                    url: '{{ route('manage-wedding-calculator.getCategoryCustomVenue') }}'
                },
                columnDefs: [{
                    orderable: false,
                    searchable: false,
                    targets: 1,
                    className: "text-end"
                }],
                columns: [{
                        data: 'nama',
                        name: 'nama',
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                    },

                ],
                order: [],
            });
            $('#table-category-additional-venue').DataTable({
                processing: true,
                searching: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: '{{ route('manage-wedding-calculator.getCategoryAdditionalVenue') }}'
                },
                columnDefs: [{
                    orderable: false,
                    searchable: false,
                    targets: 1,
                    className: "text-end"
                }],
                columns: [{
                        data: 'nama',
                        name: 'nama',
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
        /**
         * Buat paket & Ubah Paket
         */
        const CUModal = document.getElementById('CUModal'); // abmil elemen div modal-nya
        const CUForm = CUModal.querySelector('.modal-content form#CUForm'); // ambil elemen form-nya
        const titleModal = CUModal.querySelector('.modal-content .modal-header h5#cuModalLabel.modal-title'); // abmil elemen h5 judul form-nya
        const csrfField = CUForm.querySelector('input[name="_token"]'); // ambil elemen input csrf
        const selectCategory = document.querySelector('.modal-content .modal-body div#pilih-kategori');
        const btnSubmit = document.querySelector('.modal-content .modal-footer .btn.btn-success'); // ambil elemen button submit-nya

        /* Select input untuk diisi ketika update */
        const InputNamaPaketElement = document.querySelector('.modal-content .modal-body input#nama-paket'); // ambil elemen input
        const InputHargaPaketElement = document.querySelector('.modal-content .modal-body input#harga-paket'); // ambil elemen input

        CUModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget; // ambil elemen button yang berelasi
            const btnID = button.getAttribute('id'); // ambil attribute id
            const btnName = button.getAttribute('data-bs-name') // ambil attribute data-bs-name
            const route = button.getAttribute('data-bs-route'); // ambil attribute data-bs-route

            /* Create */
            if (btnID == 'btnCreateModal') {
                CUForm.action = route;
                titleModal.textContent = 'Tambah Data Paket ' + btnName;

                if (btnName == 'All-In') {
                    InputNamaPaketElement.name = 'nama-paket-allin';
                    InputHargaPaketElement.name = 'harga-paket-allin';
                }

                /* Jika btnName bukan paket all-in*/
                if (!(btnName == 'All-In')) {

                    if (btnName == 'Custom Venue') {
                        InputNamaPaketElement.name = 'nama-paket-customvenue';
                        InputHargaPaketElement.name = 'harga-paket-customvenue';
                    }

                    if (btnName == 'Additional Venue') {
                        InputNamaPaketElement.name = 'nama-paket-additionalvenue';
                        InputHargaPaketElement.name = 'harga-paket-additionalvenue';
                    }

                    const btnRouteCategory = button.getAttribute('data-bs-category');

                    selectCategory.classList.add('form-inpt');
                    const createLabel = document.createElement('label');
                    createLabel.classList.add('form-label');
                    createLabel.setAttribute('for', 'kategori');
                    createLabel.textContent = 'Kategori';

                    const createSpan = document.createElement('span');
                    createSpan.classList.add('text-danger');
                    createSpan.textContent = '*';

                    createLabel.appendChild(createSpan);

                    const createSelect = document.createElement('select');
                    createSelect.classList.add('form-select', 'form-select');
                    createSelect.setAttribute('aria-label', 'Default select example');
                    createSelect.setAttribute('id', 'kategori');

                    if (btnName == 'Custom Venue') {
                        createSelect.setAttribute('name', 'kategori-customvenue');
                    }

                    if (btnName == 'Additional Venue') {
                        createSelect.setAttribute('name', 'kategori-additionalvenue');
                    }

                    const defaultOption = document.createElement('option');
                    defaultOption.setAttribute('disabled', 'true');
                    defaultOption.setAttribute('selected', 'true');
                    defaultOption.setAttribute('value', '');
                    defaultOption.textContent = '-- Pilih Kategori --';

                    createSelect.appendChild(defaultOption);
                    console.log(btnRouteCategory);
                    fetch(btnRouteCategory, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data); // Periksa data di konsol
                            if (data != []) {
                                data.forEach(category => {
                                    const option = document.createElement('option');
                                    option.setAttribute('value', category.id);
                                    option.textContent = category.nama;
                                    createSelect.appendChild(option);
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });

                    selectCategory.appendChild(createLabel);
                    selectCategory.appendChild(createSelect);
                }
            }

            /* Update */
            if (btnID == 'btnUpdateModal') {
                const btnRouteCategory = button.getAttribute('data-bs-category');

                const rawData = button.getAttribute('data-bs-paket');
                const parseData = JSON.parse(rawData);

                titleModal.textContent = 'Ubah Paket ' + btnName;
                CUForm.action = route;
                btnSubmit.textContent = 'Ubah';

                const createField = document.createElement('input');
                createField.type = 'hidden';
                createField.name = '_method';
                createField.value = 'PUT';
                csrfField.insertAdjacentElement('beforebegin', createField);

                if (btnName == 'All-In') {
                    InputNamaPaketElement.name = 'nama-paket-allin';
                    InputHargaPaketElement.name = 'harga-paket-allin';
                }

                InputNamaPaketElement.value = parseData.nama_paket;
                if (!(btnName == 'All-In')) {

                    if (btnName == 'Custom Venue') {
                        InputNamaPaketElement.name = 'nama-paket-customvenue';
                        InputHargaPaketElement.name = 'harga-paket-customvenue';
                    }

                    if (btnName == 'Additional Venue') {
                        InputNamaPaketElement.name = 'nama-paket-additionalvenue';
                        InputHargaPaketElement.name = 'harga-paket-additionalvenue';
                    }
                    selectCategory.classList.add('form-inpt');
                    const createLabel = document.createElement('label');
                    createLabel.classList.add('form-label');
                    createLabel.setAttribute('for', 'kategori');
                    createLabel.textContent = 'Kategori';

                    const createSpan = document.createElement('span');
                    createSpan.classList.add('text-danger');
                    createSpan.textContent = '*';

                    createLabel.appendChild(createSpan);

                    const createSelect = document.createElement('select');
                    createSelect.classList.add('form-select', 'form-select');
                    createSelect.setAttribute('aria-label', 'Default select example');
                    createSelect.setAttribute('id', 'kategori');
                    if (btnName == 'Custom Venue') {
                        createSelect.setAttribute('name', 'kategori-customvenue');
                    }

                    if (btnName == 'Additional Venue') {
                        createSelect.setAttribute('name', 'kategori-additionalvenue');
                    }

                    const defaultOption = document.createElement('option');
                    defaultOption.setAttribute('disabled', 'true');
                    defaultOption.setAttribute('selected', 'true');
                    defaultOption.setAttribute('value', '');
                    defaultOption.textContent = '-- Pilih Kategori --';

                    createSelect.appendChild(defaultOption);
                    console.log(btnRouteCategory);
                    fetch(btnRouteCategory, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data); // Periksa data di konsol
                            if (data != []) {
                                data.forEach(category => {
                                    const option = document.createElement('option');
                                    option.setAttribute('value', category.id);
                                    option.textContent = category.nama;
                                    if (parseData.kategori_id == category.id) {
                                        option.selected = true;
                                    }
                                    createSelect.appendChild(option);
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });

                    selectCategory.appendChild(createLabel);
                    selectCategory.appendChild(createSelect);
                }
                InputHargaPaketElement.value = parseData.harga;
            }
        });

        CUModal.addEventListener('hidden.bs.modal', (event) => {
            /* Hapus input name method di dalam elemen form*/
            const methodField = CUForm.querySelector('input[name="_method"]');
            if (methodField !== null) {
                methodField.remove();
            }

            CUForm.action = '#';

            InputNamaPaketElement.value = null;
            InputNamaPaketElement.name = 'nama-paket';
            selectCategory.innerHTML = '';
            InputHargaPaketElement.value = null;
            InputHargaPaketElement.name = 'harga-paket';
            btnSubmit.textContent = 'Tambah';
        });

        /* Delete */
        const deleteModal = document.getElementById('DeleteModal');
        deleteModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget;
            const route = button.getAttribute('data-bs-route');
            deleteModal.querySelector('.modal-content .modal-footer form').setAttribute('action', route);
        });
    </script>
@endpush
