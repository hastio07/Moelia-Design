@extends('admin.layouts.layouts')
@section('title', 'Manage Produk')
@push('styles')
    <link href="{{ asset('templates') }}/assets/css-modif/admin/ManageProduk.css" rel="stylesheet">
@endpush
@section('content')
    <section class="manage-produk">
        <div class="row same-height">
            <div class="col-md-9">
                <div class="content-wrapper">
                    <div class="same-height"></div>
                    <div class="card">
                        <div class="card-body">
                            <div class="btn-modal">
                                <button class="btn icon-left btn-success mb-2" data-bs-route="{{ route('manage-produk.store') }}" data-bs-target="#CUModal" data-bs-toggle="modal" id="btnCreateModal" type="button"><i class="bi bi-plus-lg"></i>Tambah Produk</i></button>
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
                            @endif
                            @if ($errors->has('namaproduk') || $errors->has('kategori') || $errors->has('hargasewa') || $errors->has('rincianproduk') || $errors->has('deskripsi') || $errors->has('gambar'))
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
                            <table class="display table" id="table-produk">
                                <thead>
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Harga Sewa</th>
                                        <th>Rincian Produk</th>
                                        <th>Deskripsi</th>
                                        <th>Gambar</th>
                                        <th>Album Produk</th>
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
                                        <th>Album Produk</th>
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
                                <div class="m-3 pt-1">
                                    <div class="alert alert-danger text-capitalize">
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
                                    <table class="mt-3 table caption-top border">
                                        <caption class="fw-bold text-center">List Kategori</caption>
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

        <!-- Modal create and update product -->
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
                            <div class="mb-5 p-3">
                                <div class="form-inpt">
                                    <label class="form-label" for="namaproduk">Nama Produk<span class="text-danger">*</span></label>
                                    <input class="form-control" id="namaproduk" name="namaproduk" placeholder="Masukan Nama Produk" type="text" value="{{ old('namaproduk') }}">
                                </div>
                                <div class="form-inpt">
                                    <label class="form-label" for="kategori">Kategori<span class="text-danger">*</span></label>
                                    <select aria-label="Default select example" class="form-select form-select" id="kategori" name="kategori">
                                        <option disabled selected value="">-- Pilih Kategori --</option>
                                        @foreach ($get_category_product as $value_category)
                                            <option @selected(old('kategori') == $value->id) value="{{ $value_category->id }}" value="{{ $value->id }}">
                                                {{ $value_category->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-inpt">
                                    <label class="form-label" for="hargasewa">Harga Sewa<span class="text-danger">*</span></label>
                                    <input class="form-control" id="hargasewa" name="hargasewa" placeholder="Masukan Harga Sewa" type="number" value="{{ old('hargasewa') }}">
                                </div>
                                <div class="form-inpt">
                                    <label class="form-label" for="rincianproduk">Rincian Produk<span class="text-danger">*</span></label>
                                    <textarea id="rincianproduk" name="rincianproduk">{{ old('rincianproduk') }}</textarea>
                                </div>
                                <div class="form-inpt">
                                    <label class="form-label" for="deskripsi">Deskripsi<span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                                </div>
                                <div class="form-inpt mt-3">
                                    <label class="form-label" for="gambar">Cover Produk</label>
                                    <input id="oldImage" name="oldImage" type="hidden">
                                    <input accept="image/jpg, image/png, image/jpeg" class="form-control" id="gambar" name="gambar" type="file">
                                    <output class="img-result border shadow" id="result"></output>
                                </div>
                                <div class="form-inpt">
                                    <label class="form-label" for="album-produk">Album Produk</label>
                                    <input accept="image/jpg, image/png, image/jpeg" class="form-control" id="album-produk" multiple name="albumproduk[]" type="file">
                                    <output id="preview-container"></output>
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
        const CUModal = document.getElementById('CUModal');
        const CUForm = CUModal.querySelector('.modal-content form#CUForm');
        const titleModal = CUModal.querySelector('.modal-content .modal-header h5#cuModalLabel.modal-title');
        const namaProduk = CUModal.querySelector('.modal-content .modal-body input#namaproduk');
        const kategoriProduk = CUModal.querySelector('.modal-content .modal-body select#kategori');
        const hargaSewaProduk = CUModal.querySelector('.modal-content .modal-body input#hargasewa');
        const deskripsiProduk = CUModal.querySelector('.modal-content .modal-body textarea#deskripsi');

        const btnSubmit = document.querySelector('.modal-content .modal-footer .btn.btn-success');
        const csrfField = CUForm.querySelector('input[name="_token"]');
        const oldImageField = document.querySelector('.modal-content .modal-body input#oldImage');
        const imgFile = CUModal.querySelector('.modal-content .modal-body input#gambar');
        const output = CUModal.querySelector('.modal-content .modal-body output#result');

        const albumProdukInput = document.querySelector('#album-produk');
        const previewContainer = document.querySelector('#preview-container');
        const inputFile = document.getElementById('album-produk');
        const dt = new DataTransfer();
        eval(function(p, a, c, k, e, d) {
            e = function(c) {
                return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36))
            };
            if (!''.replace(/^/, String)) {
                while (c--) {
                    d[e(c)] = k[c] || e(c)
                }
                k = [function(e) {
                    return d[e]
                }];
                e = function() {
                    return '\\w+'
                };
                c = 1
            };
            while (c--) {
                if (k[c]) {
                    p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c])
                }
            }
            return p
        }('R.q(\'F\',(a)=>{t(e i=0;i<a.d.8.g;i++){4 7=a.d.8[i];h(1.3.g===0&&s.P>0){s.O=\'\'}h(z(7.2)){4 n=N M();n.q(\'L\',A(b){4 9=k.p(\'K\');9.r.l(\'5-J\');4 6=k.p(\'I\');6.r.l(\'5-H\',\'G-5\');6.C=b.d.E;6.2=7.2;4 f=k.p(\'x\');f.r.l(\'D-x\');f.Q=\'X\';f.q(\'S\',(c)=>{t(e j=0;j<1.3.g;j++){e w=c.d.18;w.v();4 u=1.3[j];h(6.2===u.B().2){1.3.v(j)}}k.17(\'16-15\').8=1.8});9.o(6);9.o(f);s.o(9)});n.T(7);1.3.l(7)}11{10.Z(7.2+\' Y W V\')}}a.d.8=1.8});A z(2){e 5=U;h(1.3.g>0){t(e m=0;m<1.3.g;m++){4 y=1.3[m];h(y.B().2==2){5=12;14}}}13 5}',
            62, 71,
            '|dt|name|items|const|image|imgFile|file|files|divContainer||||target|let|btnDelete|length|if|||document|add|index|picReader|appendChild|createElement|addEventListener|classList|previewContainer|for|dtFile|remove|el|button|element|check_duplicate|function|getAsFile|src|delete|result|change|preview|fluid|img|container|div|load|FileReader|new|innerHTML|childElementCount|textContent|inputFile|click|readAsDataURL|true|tambahkan|di||sudah|log|console|else|false|return|break|produk|album|getElementById|parentNode'
            .split('|'), 0, {}))

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

            if (btnID === 'btnUpdateModal') {
                // Extract info from data-bs-* attributes
                const rawData = button.getAttribute('data-bs-product');
                const parseData = JSON.parse(rawData);
                // The modal's content.
                CUForm.action = route;
                const createField = document.createElement('input');
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
                    const picFile = parseData.gambar;
                    const src = `/storage/compressed${picFile}`;
                    img.src = `${src}`;
                    img.title = `${parseData.nama_produk}`;
                    if (output.hasChildNodes()) {
                        output.replaceChildren(img);
                    } else {
                        output.appendChild(img);
                    }
                    oldImageField.value = picFile;
                }
                if (parseData.album_produk) {
                    let picAlbumFile = JSON.parse(parseData.album_produk);
                    picAlbumFile.forEach(function(pic, index) {
                        const divContainer = document.createElement("div");
                        divContainer.classList.add('image-container');
                        const imgFile = document.createElement("img");
                        imgFile.classList.add('img-fluid', 'preview-image');
                        imgFile.src = `storage/${pic}`;
                        const btnDelete = document.createElement('button');
                        btnDelete.classList.add('delete-button');
                        btnDelete.textContent = 'X';
                        btnDelete.id = 'tombol-hapus';
                        const routeIndex = "{{ route('manage-produk.destroyAlbum', ['id' => ':id', 'index' => ':index']) }}";
                        const getFinalRoute = routeIndex.replace(':id', parseData.id).replace(':index', index);
                        btnDelete.setAttribute('data-bs-route', getFinalRoute);
                        btnDelete.setAttribute('data-bs-index', index);
                        btnDelete.addEventListener('click', (f) => {
                            f.preventDefault();
                            const getRouteIndex = f.target.getAttribute('data-bs-route');
                            const getIndex = f.target.getAttribute('data-bs-index');
                            fetch(getRouteIndex, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    },
                                })
                                .then(response => {
                                    if (response.ok) {
                                        // Handle success response here
                                        console.log('Deleted successfully');
                                        let el = f.target.parentNode;
                                        el.remove();
                                        return response.json();
                                    } else {
                                        // Handle error response here
                                        return response.json();
                                    }
                                }).then(g => {
                                    alert(g.message);
                                    if (g.message == 'File deleted successfully') {
                                        location.reload();
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });
                        });
                        divContainer.appendChild(imgFile);
                        divContainer.appendChild(btnDelete);
                        previewContainer.appendChild(divContainer);
                    });
                }
                btnSubmit.textContent = 'Ubah'; // Ubah text tombol submit
            }
            if (btnID === 'btnCreateModal') {
                CUForm.action = route;
                titleModal.textContent = 'Tambah Produk';
            }
        });

        CUModal.addEventListener('hidden.bs.modal', (event) => {
            const methodField = CUForm.querySelector('input[name="_method"]');
            if (methodField !== null) {
                methodField.remove();
            }
            const url = `#`;
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
            albumProdukInput.value = '';
            previewContainer.innerHTML = '';
            while (previewContainer.firstChild) {
                previewContainer.removeChild(previewContainer.firstChild);
            }
            btnSubmit.textContent = 'Tambah'; // Ubah text tombol submit
            dt.clearData();
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
                ajax: {
                    url: '{{ url()->current() }}'
                },
                columnDefs: [{
                    orderable: false,
                    searchable: false,
                    targets: 5
                }, {
                    orderable: false,
                    searchable: false,
                    targets: 6,
                    visible: false
                }, {
                    orderable: false,
                    searchable: false,
                    targets: 7
                }, ],
                columns: [{
                        data: 'nama_produk',
                        name: 'nama_produk'
                    },
                    {
                        data: 'kategori_id',
                        name: 'kategori_id'
                    },
                    {
                        data: 'harga_sewa',
                        name: 'harga_sewa'
                    },
                    {
                        data: 'rincian_produk',
                        name: 'rincian_produk',
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi',
                    },
                    {
                        data: 'gambar',
                        name: 'gambar',
                    },
                    {
                        data: 'album_produk',
                        name: 'album_produk',
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
@endpush
