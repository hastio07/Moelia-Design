@extends('admin.layouts.layouts')
@section('title', 'Manage Produk')
@push('styles')
<link href="{{ asset('templates') }}/assets/css-modif/admin/ManageProduk.css" rel="stylesheet">
@endpush
@section('content')
<section class="manage-produk">
    <div class="title">
        <h5>Manage Produk</h5>
    </div>
    <div class="row same-height">
        <div class="col-md-9">
            <div class="content-wrapper">
                <div class="same-height"></div>
                <div class="card">
                    <div class="card-header">
                        <h4>List Produk</h4>
                    </div>
                    <div class="card-body">
                        <div class="btn-modal">
                            <button class="btn mb-2 icon-left  btn-success" data-bs-route="{{ route('manage-produk.store') }}" data-bs-target="#CUModal" data-bs-toggle="modal" id="btnCreateModal" type="button"><i class="bi bi-plus-lg"></i>Tambah Produk</i></button>
                        </div>
                        @if (session()->has('success_add_product'))
                        <div class="alert alert-success m-3">{{ session()->get('success_add_product') }}</div>
                        @elseif (session()->has('error_add_product'))
                        <div class="alert alert-danger m-3">{{ session()->get('error_add_product') }}</div>
                        @elseif (session()->has('success_edit_product'))
                        <div class="alert alert-success m-3">{{ session()->get('success_edit_product') }}</div>
                        @elseif (session()->has('error_edit_product'))
                        <div class="alert alert-danger m-3">{{ session()->get('error_edit_product') }}</div>
                        @elseif (session()->has('success_delete_product'))
                        <div class="alert alert-success m-3">{{ session()->get('success_delete_product') }}</div>
                        @elseif (session()->has('error_delete_product'))
                        <div class="alert alert-danger m-3">{{ session()->get('error_delete_product') }}</div>
                        @endif
                        @if ($errors->has('namaproduk') || $errors->has('kategori') || $errors->has('hargasewa') || $errors->has('rincianproduk') || $errors->has('deskripsi') || $errors->has('gambar'))
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
                        <table class="table display" id="table-produk">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Harga Sewa</th>
                                    <th>Rincian Produk</th>
                                    <th>Deskripsi</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Harga Sewa</th>
                                    <th>Rincian Produk</th>
                                    <th>Deskripsi</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="content-wrapper add-categories">
                <div class="same-height">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4>Tambah Kategori</h4>
                        </div>
                        @if (session()->has('success_add_categoryproduct'))
                        <div class="alert alert-success m-3">{{ session()->get('success_add_categoryproduct') }}</div>
                        @elseif (session()->has('error_add_categoryproduct'))
                        <div class="alert alert-danger m-3">{{ session()->get('error_add_categoryproduct') }}</div>
                        @elseif (session()->has('success_delete_categoryproduct'))
                        <div class="alert alert-success m-3">{{ session()->get('success_delete_categoryproduct') }}</div>
                        @elseif (session()->has('error_delete_categoryproduct'))
                        <div class="alert alert-danger m-3">{{ session()->get('error_delete_categoryproduct') }}</div>
                        @endif
                        @if ($errors->has('nama_kategori'))
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
                        <div class="card-body text-center">
                            <form action="{{ route('manage-produk.createcategory') }}" method="POST">
                                @csrf
                                <input class="form-control mb-3" id="nama_kategori" name="nama_kategori" placeholder="Buat kategori" required type="text" value="{{ old('nama_kategori') }}">
                                <button class="btn btn-success" type="submit">Tambah</button>
                            </form>
                            <div class="list-kategori mt-4">
                                <table class="table mt-3 caption-top border">
                                    <caption class="text-center fw-bold">List Kategori</caption>
                                    <tbody>
                                        @foreach ($get_category_product as $value)
                                        <tr>
                                            <td>{{ $value->nama_kategori }}</td>
                                            <td>
                                                <button class="btn text-danger" data-bs-route="{{ route('manage-produk.destroycategory', $value->id) }}" data-bs-target="#DeleteModal" data-bs-toggle="modal" id="btnDeleteModal" type="button"><i class="bi bi-trash"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal add and update product -->
    <div aria-hidden="true" aria-labelledby="cuModalLabel" class="modal fade" id="CUModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cuModalLabel">Tambah Produk</h5>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <form enctype="multipart/form-data" id="CUForm" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="p-3 mb-5">
                            <div class="form-inpt">
                                <label class="form-label" for="namaproduk">Nama Produk<span class="text-danger">*</span></label>
                                <input class="form-control" id="namaproduk" name="namaproduk" placeholder="Masukan Nama Produk" type="text">
                            </div>
                            <div class="form-inpt">
                                <label class="form-label" for="kategori">Kategori<span class="text-danger">*</span></label>
                                <select aria-label="Default select example" class="form-select form-select" id="kategori" name="kategori">
                                    <option disabled selected value="">-- Pilih Kategori --</option>
                                    @foreach ($get_category_product as $value_category)
                                    <option value="{{ $value_category->id }}">
                                        {{ $value_category->nama_kategori }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-inpt">
                                <label class="form-label" for="hargasewa">Harga Sewa<span class="text-danger">*</span></label>
                                <input class="form-control" id="hargasewa" name="hargasewa" placeholder="Masukan Harga Sewa" type="number">
                            </div>
                            <div class="form-inpt">
                                <label class="form-label" for="rincianproduk">Rincian Produk<span class="text-danger">*</span></label>
                                <textarea id="rincianproduk" name="rincianproduk"></textarea>
                            </div>
                            <div class="form-inpt">
                                <label class="form-label" for="deskripsi">Deskripsi<span class="text-danger">*</span></label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                            </div>
                            <div class="form-inpt">
                                <label class="form-label" for="gambar">Upload Gambar</label>
                                <input id="oldImage" name="oldImage" type="hidden">
                                <input accept="image/jpg, image/png, image/jpeg" class="form-control" id="gambar" name="gambar" type="file">
                                <output class="img-result" id="result"></output>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Tutup</button>
                        <button class="btn mb-2 icon-left  btn-success" type="submit"><i class="ti-check"></i>Tambah</button>
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

</section>
@endsection

@push('scripts')
<script>
    /**
     * Buat Produk & Ubah Produk
     */
    let CUModal = document.getElementById('CUModal');
    let CUForm = CUModal.querySelector('.modal-content form#CUForm');
    let titleModal = CUModal.querySelector('.modal-content .modal-header h5#cuModalLabel.modal-title');
    let namaProduk = CUModal.querySelector('.modal-content .modal-body input#namaproduk');
    let kategoriProduk = CUModal.querySelector('.modal-content .modal-body select#kategori');
    let hargaSewaProduk = CUModal.querySelector('.modal-content .modal-body input#hargasewa');
    let deskripsiProduk = CUModal.querySelector('.modal-content .modal-body textarea#deskripsi');

    let btnSubmit = document.querySelector('.modal-content .modal-footer .btn.btn-success');
    let csrfField = CUForm.querySelector('input[name="_token"]');
    let oldImageField = document.querySelector('.modal-content .modal-body input#oldImage');
    let imgFile = CUModal.querySelector('.modal-content .modal-body input#gambar');
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
            titleModal.textContent = 'Ubah Produk';
            namaProduk.value = parseData.nama_produk;
            kategoriProduk.value = parseData.kategori_id;
            hargaSewaProduk.value = parseData.harga_sewa;
            tinymce.get('rincianproduk').setContent(parseData.rincian_produk);
            deskripsiProduk.value = parseData.deskripsi;
            if (parseData.gambar) {
                let picFile = parseData.gambar;
                let src = `/storage/compressed${picFile}`;
                img.src = `${src}`;
                img.title = `${parseData.nama_produk}`;
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
        namaProduk.value = null;
        kategoriProduk.value = '';
        hargaSewaProduk.value = null;
        tinymce.activeEditor.setContent('');
        deskripsiProduk.value = null;
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
<script>
    $(document).ready(function() {
        $('#table-produk').DataTable({
            processing: true,
            searching: true,
            serverSide: true,
            responsive: true,
            ajax: '{{ url()->current() }}',
            columns: [{
                    data: 'nama_produk',
                    name: 'nama_produk'
                },
                {
                    data: 'Kategori',
                    name: 'Kategori'
                },
                {
                    data: 'Harga Sewa',
                    name: 'Harga Sewa'
                },
                {
                    data: 'Rincian Produk',
                    name: 'Rincian Produk',
                },
                {
                    data: 'Deskripsi',
                    name: 'Deskripsi',
                },
                {
                    data: 'Gambar',
                    name: 'Gambar',
                },
                {
                    data: 'Aksi',
                    name: 'Aksi'
                },

            ],
            order: [
                [0, 'asc']
            ],
        });
    });
</script>
@endpush