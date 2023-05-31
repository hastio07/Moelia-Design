@extends('dashboard.admin.layouts.layouts')
@section('title', 'Manage Layanan')
@push('styles')
    <link href="{{ asset('templates') }}/assets/css-modif/admin/ManageLayanan.css" rel="stylesheet">
@endpush
@section('content')
    <section class="container">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-header ">
                    <h4>List Layanan</h4>
                </div>
                <div class="card-body">
                    <div class="btn-modal">
                        <button class="btn mb-2 icon-left btn-success" data-bs-route="{{ route('manage-layanan.store') }}" data-bs-target="#CUModal" data-bs-toggle="modal" id="btnCreate" type="button"><i class="bi bi-plus-lg"></i>Tambah Layanan</i></button>
                    </div>
                    <table class="table display text-center" id="table-layanan">
                        <thead>
                            <tr>
                                <th>Tipe Layanan</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $value)
                                <tr>
                                    <td>{{ $value->tipe_layanan }}</td>
                                    <td>{{ $value->deskripsi }}</td>
                                    <td>
                                        @if ($value->gambar)
                                            <img alt="{{ $value->tipe_layanan }}" height="150" src="/storage/compressed/{{ $value->gambar }}" width="180">
                                        @else
                                            <img alt="gambar" height="150" src="https://dummyimage.com/180x150.png" width="180">
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                            <button class="btn btn-warning" data-bs-layanan="{{ $value }}" data-bs-route="{{ route('manage-layanan.update', $value->id) }}" data-bs-target="#CUModal" data-bs-toggle="modal" id="btnUpdate" type="button"><i class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger" data-bs-route="{{ route('manage-layanan.destroy', $value->id) }}" data-bs-target="#DeleteModal" data-bs-toggle="modal" id="btnDelete" type="button"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
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
                            <div class="p-3 mb-5">
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
                            <button class="btn btn-secondary" data-bs-dismiss="modal" type="submit">Close</button>
                            <button class="btn mb-2 icon-left  btn-success" type="button "><i class="ti-check"></i>selesai</button>
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

    </section>
@endsection

@push('scripts')
    <script>
        /**
         * Buat Layanan & Ubah Layanan
         */
        const CUModal = document.getElementById('CUModal');
        const CUForm = CUModal.querySelector('.modal-content form#CUForm');
        const titleModal = CUModal.querySelector('.modal-content .modal-header h5#cuModalLabel.modal-title');
        const tipeLayanan = CUModal.querySelector('.modal-content form#CUForm .modal-body input#tipe_layanan');
        const deskripsiLayanan = CUModal.querySelector('.modal-content form#CUForm .modal-body textarea#deskripsi');
        const csrfField = CUForm.querySelector('input[name="_token"]');
        const oldImageField = CUModal.querySelector('.modal-content form#CUForm .modal-body input#oldImage');
        const imgFile = CUModal.querySelector('.modal-content form#CUForm .modal-body input#gambar');
        const output = CUModal.querySelector('.modal-content form#CUForm .modal-body output#result');

        CUModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget;
            const btnID = button.getAttribute('id');
            const route = button.getAttribute('data-bs-route');
            const img = document.createElement('img');
            img.className = 'thumbnail';
            img.height = 240;
            img.width = 320;
            imgFile.addEventListener('change', (e) => {
                if (window.File && window.FileReader && window.FileList && window.Blob) {
                    const file = e.target.files;

                    // if files is image
                    if (file[0].type.match('image')) {
                        const picReader = new FileReader();
                        picReader.addEventListener('load', function(event) {
                            const picFile = event.target;
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

            if (btnID === 'btnUpdate') {
                // Extract info from data-bs-* attributes
                const rawData = button.getAttribute('data-bs-layanan');
                const parseData = JSON.parse(rawData);
                // The modal's content.
                CUForm.action = route;
                const createField = document.createElement('input');
                createField.type = 'hidden';
                createField.name = '_method';
                createField.value = 'PUT';
                csrfField.insertAdjacentElement('beforebegin', createField);
                titleModal.textContent = 'Ubah Layanan';
                tipeLayanan.value = parseData.tipe_layanan;
                deskripsiLayanan.value = parseData.deskripsi;
                if (parseData.gambar) {
                    const picFile = parseData.gambar;
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
            }
            if (btnID === 'btnCreate') {
                CUForm.action = route;
                titleModal.textContent = 'Tambah Layanan';
            }
        });

        CUModal.addEventListener('hidden.bs.modal', () => {
            const methodField = CUForm.querySelector('input[name="_method"]');
            if (methodField !== null) {
                methodField.remove();
            }
            const url = `#`;
            CUForm.action = url;
            tipeLayanan.value = null;
            deskripsiLayanan.value = null;
            if (output.hasChildNodes()) {
                imgFile.value = null;
                output.removeChild(output.firstChild);
            }
        });

        /**
         * Hapus Produk
         */
        const deleteModal = document.getElementById('DeleteModal');
        deleteModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget;
            const route = button.getAttribute('data-bs-route');
            deleteModal.querySelector('.modal-content .modal-footer form').setAttribute('action', route);
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#table-layanan').DataTable({
                responsive: true
            });
        })
    </script>
@endpush
