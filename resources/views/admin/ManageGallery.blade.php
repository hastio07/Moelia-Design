@extends('admin.layouts.layouts')
@section('title', 'Manage Gallery')
@push('styles')
    <link href="{{ asset('templates') }}/assets/css-modif/admin/ManageGallery.css" rel="stylesheet">
@endpush
@section('content')
    <section class="container">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button @class(['nav-link', 'active' => $activeTab === 'photo-tab']) aria-controls="photo-tab-pane" aria-selected="{{ $activeTab === 'photo-tab' ? 'true' : 'false' }}" data-bs-route="{{ route('manage-gallery.phototab') }}" data-bs-target="#photo-tab-pane" data-bs-toggle="tab" id="photo-tab" role="tab" type="button">Foto</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button @class(['nav-link', 'active' => $activeTab === 'video-tab']) aria-controls="video-tab-pane" aria-selected="{{ $activeTab === 'video-tab' ? 'true' : 'false' }}" data-bs-route="{{ route('manage-gallery.videotab') }}" data-bs-target="#video-tab-pane" data-bs-toggle="tab" id="video-tab" role="tab" type="button">Vidio</button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div @class([
                            'tab-pane',
                            'fade',
                            'show active' => $activeTab === 'photo-tab',
                        ]) aria-labelledby="photo-tab" id="photo-tab-pane" role="tabpanel" tabindex="0">
                            @if ($errors->any())
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
                            <form action="{{ route('manage-gallery.createphoto') }}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="form-inpt">
                                    <label class="form-label" for="namagambar">Judul/Album foto<span class="text-danger">*</span></label>
                                    <input class="form-control" id="namagambar" name="namagambar" placeholder="Masukan Judul Gambar" required type="text" value="{{ old('namagambar') }}">
                                </div>
                                <div class="form-inpt">
                                    <label class="form-label" for="gambar">Upload Gambar <span class="text-danger">*</span></label>
                                    <div class="d-flex">
                                        <input accept="image/jpg, image/png, image/jpeg" class="form-control me-3" id="gambar" multiple name="gambar[]" required type="file">
                                        <button class="btn btn-success" type="submit"><i class="bi bi-upload"></i></button>
                                    </div>
                                </div>
                            </form>
                            <div class="row mt-3">
                                @if (isset($photos))
                                    @php
                                        // Mengelompokkan foto berdasarkan photo_name
                                        $groupedPhotos = $photos->groupBy('photo_name');
                                    @endphp

                                    @foreach ($groupedPhotos as $photoName => $groupedPhotosByName)
                                        <div class="col-12">
                                            <h5 class="fw-bold mb-3 text-capitalize">{{ $photoName }}</h5>
                                        </div>

                                        @foreach ($groupedPhotosByName as $photo)
                                            <div class="col-12 col-md-3 col-lg-2">
                                                <div class="card card-gallery">
                                                    <img alt="{{ $photo->photo_name }}" class="card-img-top" src="/storage/{{ $photo->photo_path }}">
                                                    <button class="btn btn-danger" data-bs-route="{{ route('manage-gallery.destroyphoto', $photo->id) }}" data-bs-target="#DeleteModal" data-bs-toggle="modal" type="button"><i class="bi bi-trash"></i></button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach

                                    {!! $photos->links('pagination::bootstrap-5') !!}
                                @endif
                            </div>

                        </div>
                        <div @class([
                            'tab-pane',
                            'fade',
                            'show active' => $activeTab === 'video-tab',
                        ]) aria-labelledby="video-tab" id="video-tab-pane" role="tabpanel" tabindex="0">

                            <form action="{{ route('manage-gallery.createvideo') }}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="form-inpt">
                                    <label class="form-label" for="namavideo">Judul video <span class="text-danger">*</span></label>
                                    <input class="form-control" id="namavideo" name="namavideo" placeholder="Masukan Judul Video" required type="text" value="{{ old('namavideo') }}">
                                </div>
                                <div class="form-inpt">
                                    <label class="form-label" for="linkvideo">Link video <span class="text-danger">*</span></label>
                                    <input class="form-control" id="linkvideo" name="linkvideo" placeholder="Masukan Link Video" required type="text" value="{{ old('linkvideo') }}">
                                </div>
                                <div class="d-flex justify-content-end py-3">
                                    <button class="btn btn-success" type="submit">Simpan</button>
                                </div>
                            </form>
                            <table class="display table" id="table-video">
                                <thead>
                                    <tr>
                                        <th>Judul Video</th>
                                        <th>Thumbnail Video</th>
                                        <th>Link</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Delete --}}
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
        const tabEls = document.querySelectorAll('button[data-bs-toggle="tab"]')
        tabEls.forEach(function(tabEl) {
            tabEl.addEventListener('show.bs.tab', function(event) {
                // location.href = `/manage-gallery/${event.target.id}`
                location.href = `${event.target.getAttribute('data-bs-route')}`
            })
        });
    </script>
    <script>
        const deleteModal = document.getElementById('DeleteModal');
        deleteModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget;
            const route = button.getAttribute('data-bs-route');
            deleteModal.querySelector('.modal-content .modal-footer > form').setAttribute('action', route);
        });
    </script>
    @if ($activeTab === 'video-tab')
        <script type="text/javascript">
            $(document).ready(function() {
                $('#table-video').DataTable({
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
                            targets: 1
                        },
                        {
                            orderable: false,
                            searchable: false,
                            targets: 4
                        }
                    ],
                    columns: [{
                            data: 'video_name',
                            name: 'video_name',
                        },
                        {
                            data: 'video_thumbnail',
                            name: 'video_thumbnail'
                        },
                        {
                            data: 'video_path',
                            name: 'video_path'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at',
                        },
                        {
                            data: 'aksi',
                            name: 'aksi'
                        },
                    ],
                    order: [],
                });
            });
        </script>
    @endif
@endpush
