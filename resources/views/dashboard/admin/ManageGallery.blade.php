@extends('dashboard.admin.layouts.layouts')
@section('title', 'Manage Gallery')
@section('content')
    <section>
        <div class="content-wrapper">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        {{-- @dd($activeTab) --}}
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
                            <form action="{{ route('manage-gallery.createphoto') }}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="form-inpt">
                                    <label class="form-label" for="namagambar">Judul foto<span class="text-danger">*</span></label>
                                    <input class="form-control" id="namagambar" name="namagambar" placeholder="Masukan Judul Gambar" required type="text">
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
                                    @foreach ($photos as $photo)
                                        <div class="col-12 col-md-3 col-lg-2">
                                            <div class="card card-gallery">
                                                <img alt="{{ $photo->photo_name }}" class="card-img-top" src="/storage/{{ $photo->photo_path }}">
                                                <button class="btn btn-danger" data-bs-route="{{ route('manage-gallery.destroyphoto', $photo->id) }}" data-bs-target="#DeleteModal" data-bs-toggle="modal" type="button"><i class="bi bi-trash"></i></button>
                                            </div>
                                        </div>
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
                                    <input class="form-control" id="namavideo" name="namavideo" placeholder="Masukan Judul Video" required type="text">
                                </div>
                                <div class="form-inpt">
                                    <label class="form-label" for="linkvideo">Link video <span class="text-danger">*</span></label>
                                    <input class="form-control" id="linkvideo" name="linkvideo" placeholder="Masukan Link Video" required type="text">
                                </div>
                                <div class="d-flex justify-content-end py-3">
                                    <button class="btn btn-success" type="submit">Simpan</button>
                                </div>
                            </form>
                            <table class="table display" id="table-video">
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
                                    {{-- @foreach ($videos as $value)
                                        <tr>
                                            <td>{{ $value->video_name }}</td>
                                            <td>
                                                @if ($value->video_thumbnail)
                                                    <img alt="{{ $value->nama_produk }}" height="150" src="{{ $value->video_thumbnail }}" width="180">
                                                @else
                                                    <img alt="{{ $value->nama_produk }}" height="150" src="https://dummyimage.com/180x150.png" width="180">
                                                @endif
                                            </td>
                                            <td>{{ $value->video_path }}</td>
                                            <td>{{ $value->created_at }}</td>
                                            <td>
                                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                    <button class="btn btn-danger" data-bs-route="{{ route('manage-gallery.destroyvideo', $value->id) }}" data-bs-target="#DeleteModal" data-bs-toggle="modal" id="btnDeleteModal" type="button"><i class="bi bi-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                            {{-- {!! $videos->links('pagination::bootstrap-5') !!} --}}
                        </div>
                    </div>
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

@push('managegallery-scripts')
    <script>
        const tabEls = document.querySelectorAll('button[data-bs-toggle="tab"]')
        tabEls.forEach(function(tabEl) {
            tabEl.addEventListener('show.bs.tab', function(event) {
                // location.href = `/dashboard/manage-gallery/${event.target.id}`
                location.href = `${event.target.getAttribute('data-bs-route')}`
            })
        });
    </script>
    <script src="{{ asset('templates') }}/assets/js/page/crudgallery.js"></script>
    @if ($activeTab === 'video-tab')
        <script type="text/javascript">
            $(document).ready(function() {
                $('#table-video').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ url()->current() }}',
                    columns: [{
                            data: 'video_name',
                            name: 'video_name'
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
                    order: [
                        [3, 'desc']
                    ],
                });
            });
        </script>
    @endif
@endpush
