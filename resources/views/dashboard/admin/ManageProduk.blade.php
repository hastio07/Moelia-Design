@extends('dashboard.admin.layouts.layouts')
@section('title', 'Manage Produk')
@push('StylesAdmin')
<link href="{{ asset('templates') }}/assets/css-modif/ManageProduk.css" rel="stylesheet">
@endpush

@push('head-scripts')
<script src="{{ asset('templates') }}/vendor/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
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
                        @if (session()->has('success_add_category'))
                        <div class="alert alert-success">{{ session()->get('success_add_category') }}</div>
                        @elseif (session()->has('error_add_category'))
                        <div class="alert alert-danger">{{ session()->get('error_add_category') }}</div>
                        @endif
                        @if ($errors->any())
                        <div class="pt-3">
                            <div class="alert alert-danger">
                                <p>Lengkapi Data!</p>
                                <ul class="pt=10" style="list-style:none;">
                                    @foreach ($errors->all() as $item)
                                    <li>{{ $item }}</li>
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
                                    @if (session()->has('success_category'))
                                    <div class="alert alert-success">{{ session()->get('success_category') }}</div>
                                    @elseif (session()->has('error_category'))
                                    <div class="alert alert-danger">{{ session()->get('error_category') }}</div>
                                    @endif
                                    <caption class="text-center fw-bold">List Kategori</caption>
                                    <tbody>
                                        @foreach ($get_categories as $value)
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
                                    @foreach ($get_categories as $value_category)
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
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                        <button class="btn mb-2 icon-left  btn-success" type="submit"><i class="ti-check"></i>selesai</button>
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

@push('manageproduk-scripts')
<script src="{{ asset('templates') }}/assets/js/page/crudproduk.js"></script>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#table-produk').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '{{ url()->current() }}',
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
                    data: 'aksi',
                    name: 'aksi'
                },

            ],
            order: [
                [3, 'desc']
            ],
        });
    });
</script>
@endpush