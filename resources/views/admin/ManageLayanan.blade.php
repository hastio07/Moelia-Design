@extends('admin.layouts.layouts')
@section('title', 'Manage Layanan')
@push('styles')
    <link href="{{ asset('templates') }}/assets/css-modif/admin/ManageLayanan.css" rel="stylesheet">
@endpush
@section('content')
    <section class="container">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
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
                    <div class="btn-modal">
                        <button class="btn icon-left btn-success mb-2" data-bs-route="{{ route('manage-layanan.store') }}" data-bs-target="#CUModal" data-bs-toggle="modal" id="btnCreateModal" type="button"><i class="bi bi-plus-lg"></i>Tambah Layanan</i></button>
                    </div>
                    <table class="display table text-center" id="table-layanan">
                        <thead>
                            <tr>
                                <th>Tipe Layanan</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
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

        {{-- Modal create and update layanan --}}
        <div aria-hidden="true" aria-labelledby="cuModalLabel" class="modal fade" id="CUModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cuModalLabel">Tambah Layanan</h5>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                    </div>

                    <form enctype="multipart/form-data" id="CUForm" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-5 p-3">
                                <div class="add-services">
                                    <div class="link-png">
                                        <p class="text-capitalize">Untuk PNG logo layanan dapat didownload <a href="https://www.flaticon.com">disini</a></p>
                                    </div>
                                    <div class="form-inpt">
                                        <label class="form-label" for="tipe_layanan">Tipe Layanan</label>
                                        <input class="form-control" id="tipe_layanan" name="tipe_layanan" placeholder="Masukan Layanan" type="text">
                                    </div>
                                    <div class="form-inpt">
                                        <label class="form-label" for="deskripsi">Deskripsi</label>
                                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                                    </div>
                                    <div class="form-inpt">
                                        <label class="form-label" for="gambar">Upload Gambar</label>
                                        <input id="oldImage" name="oldImage" type="hidden">
                                        <input accept="image/jpg, image/png, image/jpeg" class="form-control" id="gambar" name="gambar" type="file">
                                        <output class="img-result" id="result">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal" type="submit">Tutup</button>
                            <button class="btn icon-left btn-success mb-2" type="button "><i class="ti-check"></i>selesai</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Modal delete layanan --}}
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

    </section>
@endsection

@push('scripts')
    <script>
        /**
         * Buat Layanan & Ubah Layanan
         */
        let CUModal = document.getElementById('CUModal');
        let CUForm = CUModal.querySelector('.modal-content form#CUForm');
        let titleModal = CUModal.querySelector('.modal-content .modal-header h5#cuModalLabel.modal-title');
        let tipeLayanan = CUModal.querySelector('.modal-content form#CUForm .modal-body input#tipe_layanan');
        let deskripsiLayanan = CUModal.querySelector('.modal-content form#CUForm .modal-body textarea#deskripsi');
        let csrfField = CUForm.querySelector('input[name="_token"]');
        let oldImageField = CUModal.querySelector('.modal-content form#CUForm .modal-body input#oldImage');
        let imgFile = CUModal.querySelector('.modal-content form#CUForm .modal-body input#gambar');
        let output = CUModal.querySelector('.modal-content form#CUForm .modal-body output#result');
        let btnSubmit = document.querySelector('.modal-content .modal-footer .btn.btn-success');
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
                let rawData = button.getAttribute('data-bs-layanan');
                let parseData = JSON.parse(rawData);
                // The modal's content.
                CUForm.action = route;
                let createField = document.createElement('input');
                createField.type = 'hidden';
                createField.name = '_method';
                createField.value = 'PUT';
                csrfField.insertAdjacentElement('beforebegin', createField);
                titleModal.textContent = 'Ubah Layanan';
                tipeLayanan.value = parseData.tipe_layanan;
                deskripsiLayanan.value = parseData.deskripsi;
                if (parseData.gambar) {
                    let picFile = parseData.gambar;
                    let src = `/storage/compressed/${picFile}`;
                    img.src = `${src}`;
                    img.title = `${parseData.tipe_layanan}`;
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
                titleModal.textContent = 'Tambah Layanan';
            }
        });

        CUModal.addEventListener('hidden.bs.modal', () => {
            let methodField = CUForm.querySelector('input[name="_method"]');
            if (methodField !== null) {
                methodField.remove();
            }
            let url = `#`;
            CUForm.action = url;
            tipeLayanan.value = null;
            deskripsiLayanan.value = null;
            if (output.hasChildNodes()) {
                imgFile.value = null;
                output.removeChild(output.firstChild);
            }
            btnSubmit.textContent = 'Tambah'; // Ubah text tombol submit
        });

        /**
         * Hapus Produk
         */
        let deleteModal = document.getElementById('DeleteModal');
        deleteModal.addEventListener('show.bs.modal', (event) => {
            let button = event.relatedTarget;
            let route = button.getAttribute('data-bs-route');
            deleteModal.querySelector('.modal-content .modal-footer form').setAttribute('action', route);
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#table-layanan').DataTable({
                processing: true,
                searching: true,
                serverSide: true,
                responsive: true,
                ordering: true,
                search: {
                    regex: true
                },
                ajax: {
                    url: '{{ url()->current() }}'
                },
                columnDefs: [{
                    targets: 0,
                    className: "fw-bolder",
                }, {
                    orderable: false,
                    searchable: false,
                    targets: 2
                }, {
                    orderable: false,
                    searchable: false,
                    targets: 3
                }],
                columns: [{
                        data: 'tipe_layanan',
                        name: 'tipe_layanan',
                    },
                    {
                        data: 'deskripsi',
                        name: 'Deskripsi'
                    },
                    {
                        data: 'gambar',
                        name: 'gambar'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ],
                order: [],
            })
        })
    </script>
@endpush
