@extends('admin.layouts.layouts')
@section('title', 'Manage Perusahaan')
@push('styles')
    <link href="{{ asset('templates') }}/assets/css-modif/admin/ManagePerusahaan.css" rel="stylesheet">
@endpush
@section('content')
    <section>
        <div class="content-wrapper container">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div aria-labelledby="home-tab" class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" tabindex="0">
                            <div class="content-wrapper">
                                <div class="row same-height">
                                    <div class="flex-header border text-center">
                                        <h3 class="fw-bold">Manage Perusahaan</h3>
                                    </div>
                                    <div class="wrapper-list mt-3">
                                        <!-- foto owner dan sambutan owner -->
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="bg-body h-100 container mb-3 rounded border p-3 shadow">
                                                    <h4 class="text-center">
                                                        Foto & Nama Owner
                                                    </h4>
                                                    @if (session('success_owner'))
                                                        <div class="alert alert-success text-center" id="success-alert">
                                                            {{ session('success_owner') }}
                                                        </div>
                                                    @endif
                                                    @if ($errors->has('nama_owner') || $errors->has('kata_sambutan') || $errors->has('foto_owner') || $errors->has('oldfoto_owner'))
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
                                                    <form action="{{ route('manage-perusahaan.updateorcreateowner') }}" class="formstyle" enctype="multipart/form-data" id="formOwner" method="POST">
                                                        <div class="flex-item">
                                                            @csrf
                                                            <input name="id_owner" type="hidden" value="{{ $owners->id ?? null }}">
                                                            <input name="oldfoto_owner" type="hidden" value="{{ $owners->foto_owner ?? null }}">
                                                            <label class="form-label" for="nama_owner">Nama Owner</label>
                                                            <input class="form-control" id="nama_owner" name="nama_owner" placeholder="Masukkan nama owner" type="text" value="{{ $owners->nama_owner ?? null }}">
                                                            <label class="form-label" for="kata_sambutan">Kata Sambutan/Motto</label>
                                                            <textarea class="form-control" id="kata_sambutan" name="kata_sambutan" oninput="autoResizeTextarea(this)" rows="3">{{ $owners->kata_sambutan ?? null }}</textarea>
                                                            <label class="form-label" for="foto_owner">Foto Owner</label>
                                                            <input class="form-control" id="foto_owner" name="foto_owner" type="file">
                                                        </div>
                                                        <div class="flex-item button">
                                                            <div class="d-grid d-md-flex justify-content-md-center gap-2">
                                                                <button class="btn btn-success" type="submit">Upload</button>
                                                                @if (!empty($owners) && ($owners->nama_owner || $owners->foto_owner || $owners->kata_sambutan))
                                                                    <button class="btn btn-danger" data-bs-route="{{ route('manage-perusahaan.deleteowner', $owners->id) }}" id="btnDelete" type="submit">Hapus</i></button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="left bg-body h-100 mb-3 rounded border bg-white p-3 text-center shadow">
                                                    <h4>Owner Perusahaan</h4>
                                                    @if (!empty($owners->foto_owner) || !empty($owners->kata_sambutan) || !empty($owners->nama_owner))
                                                        <div class="text-center">
                                                            @if (!empty($owners->foto_owner))
                                                                <img alt="{{ $owners->nama_owner }}" class="img-owner rounded" src="{{ asset('storage/' . $owners->foto_owner) }}">
                                                            @else
                                                                <p class="bg-warning mt-3 rounded border p-3 text-white">-- Foto Kosong --</p>
                                                            @endif
                                                        </div>
                                                        <h6 class="fw-bolder text-capitalize mb-4">
                                                            @if (!empty($owners->nama_owner))
                                                                {{ $owners->nama_owner }}
                                                            @else
                                                                <p class="bg-warning mt-3 rounded border p-3 text-white">-- Nama Kosong --</p>
                                                            @endif
                                                        </h6>
                                                        <p style="text-align: justify;">
                                                            @if (!empty($owners->kata_sambutan))
                                                                {{ $owners->kata_sambutan }}
                                                            @else
                                                                <p class="bg-warning mt-3 rounded border p-3 text-white">-- Kata Sambutan/Motto Kosong --</p>
                                                            @endif
                                                        </p>
                                                    @else
                                                        <p class="bg-warning mt-3 rounded border p-3 text-white">-- Data Owner Harap di Isi --</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- logo dan nama perusahaan -->
                                        <div class="row mt-3">
                                            <div class="col-md-7">
                                                <div class="bg-body container mb-3 rounded border p-3 shadow">
                                                    <h4 class="text-center">
                                                        Logo & Nama Perusahaan
                                                    </h4>
                                                    @if (session('success_company'))
                                                        <div class="alert alert-success text-center" id="success-alert">
                                                            {{ session('success_company') }}
                                                        </div>
                                                    @endif
                                                    @if ($errors->has('nama_perusahaan') || $errors->has('logo_perusahaan') || $errors->has('oldlogo_perusahaan'))
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
                                                    <form action="{{ route('manage-perusahaan.updateorcreatecompany') }}" class="formstyle" enctype="multipart/form-data" id="formCompany" method="POST">
                                                        <div class="flex-item">
                                                            @csrf
                                                            <input name="id_perusahaan" readonly type="hidden" value="{{ $companies->id ?? null }}">
                                                            <input name="oldlogo_perusahaan" type="hidden" value="{{ $companies->logo_perusahaan ?? null }}">
                                                            <label class="form-label" for="nama_perusahaan">Nama
                                                                Perusahaan</label>
                                                            <input class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Masukkan nama perusahaan" type="text" value="{{ old('username', $companies->nama_perusahaan ?? null) }}">
                                                            <label class="form-label" for="logo">Logo Perusahaan</label>
                                                            <input accept="image/jpg, image/png, image/jpeg" class="form-control" id="logo" name="logo_perusahaan" type="file">
                                                        </div>
                                                        <div class="flex-item button">
                                                            <div class="d-grid d-md-flex justify-content-md-center gap-2">
                                                                <button class="btn btn-success" type="submit">Upload</button>
                                                                @if (!empty($companies) && ($companies->nama_perusahaan || $companies->logo_perusahaan))
                                                                    <button class="btn btn-danger" data-bs-route="{{ route('manage-perusahaan.deletecompany', $companies->id) }}" id="btnDelete" type="submit">Hapus</button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="left bg-body mb-3 rounded border bg-white p-3 text-center shadow">
                                                    <h4 class="card-title">Logo & Nama Perusahaan</h4>
                                                    @if (!empty($companies) && ($companies->logo_perusahaan || $companies->nama_perusahaan))
                                                        <div class="text-center">
                                                            @if (!empty($companies->logo_perusahaan))
                                                                <img alt="{{ $companies->nama_perusahaan }}" class="rounded-circle" src="/storage/{{ $companies->logo_perusahaan }}">
                                                            @else
                                                                <p class="bg-warning mt-3 rounded border p-3 text-white">-- Logo Kosong --</p>
                                                            @endif
                                                        </div>
                                                        <h6 class="fw-bolder">
                                                            @if (!empty($companies->nama_perusahaan))
                                                                {{ $companies->nama_perusahaan }}
                                                            @else
                                                                <p class="bg-warning mt-3 rounded border p-3 text-white">-- Nama Perusahaan Kosong --</p>
                                                            @endif
                                                        </h6>
                                                    @else
                                                        <p class="bg-warning mt-3 rounded border p-3 text-white">-- Logo dan Nama Perusahaan Harap di Isi --
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- video promosi -->
                                        <div class="row mt-3">
                                            <div class="col-md-7">
                                                <div class="bg-body h-100 container mb-3 rounded border p-3 shadow">
                                                    <h4 class="text-center">
                                                        Video Promosi
                                                    </h4>
                                                    @if (session('success_promosi'))
                                                        <div class="alert alert-success text-center" id="success-alert">
                                                            {{ session('success_promosi') }}
                                                        </div>
                                                    @endif
                                                    @if ($errors->has('judul-video-promosi') || $errors->has('link-video-promosi'))
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
                                                    <form action="{{ route('manage-perusahaan.updateorcreatevideopromosi') }}" enctype="multipart/form-data" method="post">
                                                        @csrf
                                                        <input name="id_video" type="hidden" value="{{ $videopromosi->id ?? null }}">
                                                        <label class="form-label" for="judul_promosi">Judul Vidio</label>
                                                        <input class="form-control" id="judul_promosi" name="judul-video-promosi" placeholder="Masukkan Judul/Intro" type="text" value="{{ $videopromosi->judul ?? null }}">
                                                        <label class="form-label" for="video_promosi">Link vidio</label>
                                                        <input class="form-control" id="video_promosi" name="link-video-promosi" placeholder="Link Vidio" type="text" value="{{ $videopromosi->link_video ?? null }}">
                                                        <div class="mt-3 text-center">
                                                            <button class="btn btn-success" type="submit">Upload</button>
                                                            @if (!empty($videopromosi) && ($videopromosi->judul || $videopromosi->link_video))
                                                                <button class="btn btn-danger" data-bs-route="{{ route('manage-perusahaan.deletevideopromosi', $videopromosi->id) }}" id="btnDelete" type="submit">Hapus</i></button>
                                                            @endif
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="left vidio-pro bg-body h-100 mb-3 rounded border bg-white p-3 text-center shadow">
                                                    <h4>Vidio Promosi</h4>
                                                    @if (empty($videopromosi->judul) || empty($videopromosi->link_video))
                                                        <div class="bg-warning mt-3 rounded border p-3 text-white">
                                                            <p>Data video promosi belum tersedia. Silakan unggah judul dan link
                                                                video untuk menampilkan promosi.</p>
                                                        </div>
                                                    @else
                                                        <div class="mt-3">
                                                            <h6 class="fw-bold my-3">{{ $videopromosi->judul }}</h6>
                                                            <iframe allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen frameborder="0" src="https://www.youtube-nocookie.com/embed/{{ $videopromosi->link_video }}" title="YouTube video player"></iframe>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- alamat perusahaan -->
                                        <div class="row mt-3">
                                            <div class="col-md-7">
                                                <div class="bg-body h-100 container mb-3 rounded border p-3 shadow">
                                                    <h4 class="text-center">Alamat Perusahaan</h4>
                                                    @if (session('success_address'))
                                                        <div class="alert alert-success text-center" id="success-alert">
                                                            {{ session('success_address') }}
                                                        </div>
                                                    @endif
                                                    @if ($errors->has('alamat_perusahaan') || $errors->has('link_gmap'))
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
                                                    <form action="{{ route('manage-perusahaan.updateorcreateaddress') }}" class="formstyle" enctype="multipart/form-data" id="formAlamat" method="POST">
                                                        <div class="flex-item">
                                                            @csrf
                                                            <label class="form-label" for="alamat_perusahaan">Alamat</label>
                                                            <input name="id_alamat" type="hidden" value="{{ $addresses->id ?? null }}">
                                                            <input class="form-control" id="alamat_perusahaan" name="alamat_perusahaan" placeholder="Masukkan alamat perusahaan" type="text" value="{{ $addresses->alamat_perusahaan ?? null }}">
                                                            <label class="form-label" for="link_gmap">Link Google Maps</label>
                                                            <input aria-label="default input example" class="form-control" id="link_gmap" name="link_gmap" placeholder="Link Google Maps" type="text" value="{{ $addresses->link_gmap ?? null }}">
                                                        </div>
                                                        <div class="flex-item button">
                                                            <div class="d-grid d-md-flex justify-content-md-center gap-2">
                                                                <button class="btn btn-success" type="submit">Upload</button>
                                                                @if (!empty($addresses) && ($addresses->alamat_perusahaan || $addresses->link_gmap))
                                                                    <button class="btn btn-danger" data-bs-route="{{ route('manage-perusahaan.deleteaddress', $addresses->id) }}" id="btnDelete" type="submit">Hapus</i></button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="h-100 rounded border p-3 shadow">
                                                    <div class="mb-4 mt-3">
                                                        <h4 class="text-center">Alamat Perusahaan</h4>
                                                    </div>
                                                    <div class="bg-danger rounded border p-3 text-white">
                                                        <h6 class="fw-bold mb-2 text-center">Cara Upload Link Maps !!</h6>
                                                        <ol>
                                                            <li>Buka Google Maps</li>
                                                            <li>Cari Alamat</li>
                                                            <li>Klik Icon Share</li>
                                                            <li>Klik Menu Embed a map</li>
                                                            <li>Copy Link HTML</li>
                                                            <li>Paste Kedalam Form Link Google Maps</li>
                                                        </ol>
                                                    </div>
                                                    <div class="my-4">
                                                        @if (!empty($addresses) && ($addresses->alamat_perusahaan || $addresses->link_gmap))
                                                            <div class="d-flex mb-3">
                                                                <i class="bi bi-geo-alt-fill me-1" style="font-size: 2rem; height: 32px; width: 32px;"></i>
                                                                {!! $addresses->alamat_perusahaan ?? '<p class="bg-warning rounded p-3 border text-white text-center mt-3">-- Alamat Kosong --</p>' !!}
                                                            </div>
                                                            <div class="maps text danger" style="max-width: 100%; max-height: 300px; overflow: hidden;">
                                                                {!! $addresses->link_gmap ?? ' <p class="bg-warning rounded p-3 border text-white r text-center mt-3">-- Link Google Maps Kosong --</p>' !!}
                                                            </div>
                                                        @else
                                                            <p class="bg-warning rounded border p-3 text-center text-white">-- Data Alamat Kosong --</p>
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        {{-- visi misi --}}
                                        <div class="row mt-3">
                                            <div class="col-md-7">
                                                <div class="bg-body h-100 container mb-3 rounded border p-3 shadow">
                                                    <h4 class="text-center">Visi&Misi</h4>
                                                    @if (session('success_visimisis'))
                                                        <div class="alert alert-success text-center" id="success-alert">
                                                            {{ session('success_visimisis') }}
                                                        </div>
                                                    @endif
                                                    @if ($errors->has('visi') || $errors->has('misi'))
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
                                                    <form action="{{ route('manage-perusahaan.updateorcreatevisimisi') }}" class="formstyle" enctype="multipart/form-data" id="formAlamat" method="POST">
                                                        <div class="flex-item">
                                                            @csrf
                                                            <label class="form-label" for="visi">Visi</label>
                                                            <input name="id_visimisi" type="hidden" value="{{ $visi_misis->id ?? null }}">
                                                            <textarea class="form-control" id="visi" name="visi" oninput="autoResizeTextarea(this)" rows="3">{{ $visi_misis->visi ?? null }}</textarea>
                                                            <label class="form-label" for="misi">Misi</label>
                                                            {{-- <textarea class="form-control" id="misi" name="misi" oninput="autoResizeTextarea(this)" rows="3">{{ $visi_misis->misi?? null }}</textarea> --}}
                                                            <textarea id="misi" name="misi">{{ $visi_misis->misi ?? null }}</textarea>
                                                        </div>
                                                        <div class="flex-item button">
                                                            <div class="d-grid d-md-flex justify-content-md-center gap-2">
                                                                <button class="btn btn-success" type="submit">Upload</button>
                                                                @if (!empty($visi_misis) && ($visi_misis->visi || $visi_misis->misi))
                                                                    <button class="btn btn-danger" data-bs-route="{{ route('manage-perusahaan.deletevisimisi', $visi_misis->id) }}" id="btnDelete" type="submit">Hapus</i></button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="h-100 rounded border p-3 shadow">
                                                    <div class="my-4">
                                                        @if (!empty($visi_misis) && ($visi_misis->visi || $visi_misis->misi))
                                                            <div class="mb-3">
                                                                <div class="mb-4 mt-3">
                                                                    <h4 class="text-center">Visi</h4>
                                                                </div>
                                                                {!! $visi_misis->visi ?? '<p class="bg-warning rounded p-3 border text-white text-center mt-3">-- Visi Kosong --</p>' !!}
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="mb-4 mt-3">
                                                                    <h4 class="text-center">Misi</h4>
                                                                </div>
                                                                {!! $visi_misis->misi ?? ' <p class="bg-warning rounded p-3 border text-white text-center mt-3">-- Misi Kosong --</p>' !!}
                                                            </div>
                                                        @else
                                                            <p class="bg-warning rounded border p-3 text-center text-white">-- Data Alamat Kosong --</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- telephone dan whatsapp perusahaan -->
                                        <div class="row mt-3">
                                            <div class="col-md-7">
                                                <div class="bg-body h-100 container mb-3 rounded border p-3 shadow">
                                                    <h4 class="text-center">
                                                        Kontak
                                                    </h4>
                                                    @if (session('success_contact'))
                                                        <div class="alert alert-success text-center" id="success-alert">
                                                            {{ session('success_contact') }}
                                                        </div>
                                                    @endif
                                                    @if ($errors->has('telephone1_name') || $errors->has('telephone1_number') || $errors->has('telephone2_name') || $errors->has('telephone2_number') || $errors->has('whatsapp1_name') || $errors->has('whatsapp1_number') || $errors->has('whatsapp2_name') || $errors->has('whatsapp2_number') || $errors->has('whatsapp3_name') || $errors->has('whatsapp3_number') || $errors->has('whatsapp4_name') || $errors->has('whatsapp4_number') || $errors->has('email'))
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
                                                    <form action="{{ route('manage-perusahaan.updateorcreatecontact') }}" class="formstyle" enctype="multipart/form-data" id="formContact" method="POST">
                                                        <div class="flex-item">
                                                            @csrf
                                                            <input name="id_contact" readonly type="hidden" value="{{ $contacts->id ?? null }}">
                                                            <label class="form-label fw-bold" for="telephone1">Telephone 1</label>
                                                            <input class="form-control" id="telephone1" name="telephone1_name" placeholder="Nama nomor telephone 1" type="text" value="{{ $contacts->telephone1_name ?? null }}">
                                                            <input class="form-control mt-2" id="telephone1_number" name="telephone1_number" placeholder="Masukkan nomor telephone 1" type="text" value="{{ $contacts->telephone1_number ?? null }}">

                                                            <label class="form-label fw-bold mt-3" for="telephone2">Telephone 2</label>
                                                            <input class="form-control" id="telephone2" name="telephone2_name" placeholder="Nama nomor telephone 2" type="text" value="{{ $contacts->telephone2_name ?? null }}">
                                                            <input class="form-control mt-2" id="telephone2_number" name="telephone2_number" placeholder="Masukkan nomor telephone 2" type="text" value="{{ $contacts->telephone2_number ?? null }}">

                                                            <div class="bg-danger mb-0 mt-4 rounded p-3 text-white">
                                                                <p>Whatsapp 1 adalah whatsapp utama yang akan dijadikan sebagai redirect whatsapp yang akan langsung terhubung kewhatsapp kantor</p>
                                                            </div>
                                                            <label class="form-label fw-bold" for="whatsapp1">Whatsapp 1 (utama)</label>
                                                            <input class="form-control" id="whatsapp1" name="whatsapp1_name" placeholder="Nama Whatsapp 1" type="text" value="{{ $contacts->whatsapp1_name ?? null }}">
                                                            <input class="form-control mt-2" id="whatsapp1_number" name="whatsapp1_number" placeholder="Masukkan nomor whatsapp 1" type="text" value="{{ $contacts->whatsapp1_number ?? null }}">

                                                            <label class="form-label fw-bold mt-3" for="whatsapp2">Whatsapp 2</label>
                                                            <input class="form-control" id="whatsapp2" name="whatsapp2_name" placeholder="Nama Whatsapp 2" type="text" value="{{ $contacts->whatsapp2_name ?? null }}">
                                                            <input class="form-control mt-2" id="whatsapp2_number" name="whatsapp2_number" placeholder="Masukkan nomor whatsapp 2" type="text" value="{{ $contacts->whatsapp2_number ?? null }}">

                                                            <label class="form-label fw-bold mt-3" for="whatsapp3">Whatsapp 3</label>
                                                            <input class="form-control" id="whatsapp3" name="whatsapp3_name" placeholder="Nama Whatsapp 3" type="text" value="{{ $contacts->whatsapp3_name ?? null }}">
                                                            <input class="form-control mt-2" id="whatsapp3_number" name="whatsapp3_number" placeholder="Masukkan nomor whatsapp 3" type="text" value="{{ $contacts->whatsapp3_number ?? null }}">

                                                            <label class="form-label fw-bold mt-3" for="whatsapp4">Whatsapp 4 </label>
                                                            <input class="form-control" id="whatsapp4" name="whatsapp4_name" placeholder="Nama Whatsapp 4" type="text" value="{{ $contacts->whatsapp4_name ?? null }}">
                                                            <input class="form-control mt-2" id="whatsapp4_number" name="whatsapp4_number" placeholder="Masukkan nomor whatsapp 4" type="text" value="{{ $contacts->whatsapp4_number ?? null }}">

                                                            <label class="form-label fw-bold mt-3" for="email">Email</label>
                                                            <input autocomplete="email" class="form-control mt-2" id="email" name="email" placeholder="Masukkan email" type="email" value="{{ $contacts->email ?? null }}">
                                                        </div>
                                                        <div class="flex-item button">
                                                            <div class="d-grid d-md-flex justify-content-md-center gap-2">
                                                                <button class="btn btn-success" type="submit">Upload</button>
                                                                @php
                                                                    $kontak = ['telephone1_name', 'telephone1_number', 'telephone2_name', 'telephone2_number', 'whatsapp1_name', 'whatsapp1_number', 'whatsapp2_name', 'whatsapp2_number', 'whatsapp3_name', 'whatsapp3_number', 'whatsapp4_name', 'whatsapp4_number', 'email'];
                                                                    $show_button = false;
                                                                    foreach ($kontak as $media) {
                                                                        if (!empty($contacts->$media)) {
                                                                            $show_button = true;
                                                                            break;
                                                                        }
                                                                    }
                                                                @endphp
                                                                @if (!empty($contacts) && $show_button)
                                                                    <button class="btn btn-danger" data-bs-route="{{ route('manage-perusahaan.deletecontact', $contacts->id) }}" id="btnDelete" type="submit">Hapus</button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="h-100 rounded border p-3 shadow">
                                                    <h4 class="text-center">Kontak Perusahaan</h4>
                                                    <div class="my-4">
                                                        <div class="rounded border p-3 shadow">
                                                            <div class="d-flex" style="min-height: 30px; align-items: center;">
                                                                <i class="bi bi-telephone-plus-fill me-1" style="font-size: 2rem; height: 32px; width: 32px;"></i>
                                                                <span class="ms-3">Telephone</span>
                                                            </div>
                                                            <ol style="margin-left: 2.3rem; padding-left: 2.1rem;">
                                                                @if (!empty($contacts))
                                                                    @php
                                                                        $data_contact_telephone = [['name' => $contacts->telephone1_name, 'number' => $contacts->telephone1_number], ['name' => $contacts->telephone2_name, 'number' => $contacts->telephone2_number]];
                                                                    @endphp
                                                                    @foreach ($data_contact_telephone as $contact)
                                                                        @if ($contact['name'] || $contact['number'])
                                                                            <li>{{ $contact['number'] ?? null }} ({{ $contact['name'] ?? null }})</li>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <div class="rounded border p-3 shadow">
                                                        <div class="mb-4">
                                                            <div class="d-flex" style="min-height: 30px; align-items: center;">
                                                                <i class="bi bi-whatsapp me-1" style="font-size: 2rem; height: 32px; width: 32px;"></i>
                                                                <span class="ms-3">Whatsapp</span>
                                                            </div>
                                                            <ol style="margin-left: 2.3rem; padding-left: 2.1rem;">
                                                                @if (!empty($contacts))
                                                                    @php
                                                                        $data_contact_whatsapp = [['name' => $contacts->whatsapp1_name, 'number' => $contacts->whatsapp1_number], ['name' => $contacts->whatsapp2_name, 'number' => $contacts->whatsapp2_number], ['name' => $contacts->whatsapp3_name, 'number' => $contacts->whatsapp3_number], ['name' => $contacts->whatsapp4_name, 'number' => $contacts->whatsapp4_number]];
                                                                    @endphp
                                                                    @foreach ($data_contact_whatsapp as $contact)
                                                                        @if ($contact['name'] || $contact['number'])
                                                                            <li>{{ $contact['number'] ?? null }} ({{ $contact['name'] ?? null }})</li>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <div class="mt-4 rounded border p-3 shadow">
                                                        <div class="mb-4">
                                                            <div class="d-flex" style="min-height: 30px; align-items: center;">
                                                                <i class="bi bi-envelope me-1" style="font-size: 2rem; height: 32px; width: 32px;"></i>
                                                                <span class="ms-3">Email</span>
                                                            </div>
                                                            <ol style="margin-left: 2.3rem; padding-left: 2.1rem;">
                                                                @if (!empty($contacts->email))
                                                                    <li>{{ $contacts->email }}</li>
                                                                @endif
                                                            </ol>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- sosial media -->
                                        <div class="row mt-3">
                                            <div class="col-md-7">
                                                <div class="bg-body h-100 container mb-3 rounded border p-3 shadow">
                                                    <h4 class="text-center">
                                                        Social Media
                                                    </h4>
                                                    @if (session('success_sosmed'))
                                                        <div class="alert alert-success text-center" id="success-alert">
                                                            {{ session('success_sosmed') }}
                                                        </div>
                                                    @endif
                                                    @if ($errors->has('u_instagram') || $errors->has('l_instagram') || $errors->has('u_facebook') || $errors->has('l_facebook') || $errors->has('u_twitter') || $errors->has('l_twitter') || $errors->has('u_tiktok') || $errors->has('l_tiktok') || $errors->has('u_youtube') || $errors->has('l_youtube'))
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
                                                    <form action="{{ route('manage-perusahaan.updateorcreatesosmed') }}" class="formstyle" enctype="multipart/form-data" id="formSosmed" method="POST">
                                                        <div class="flex-item form">
                                                            @csrf
                                                            <input name="id_sosmed" readonly type="hidden" value="{{ $sosmeds->id ?? null }}">
                                                            <div class="mb-3">
                                                                <h6 class="fw-bold">Instagram</h6>
                                                                <div class="col-auto mb-2">
                                                                    <label class="sr-only" for="u_instagram">Username
                                                                        Instagram</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">@</div>
                                                                        </div>
                                                                        <input class="form-control" id="u_instagram" name="u_instagram" placeholder="Masukkan username instagram" type="text" value="{{ $sosmeds->u_instagram ?? null }}">
                                                                        <span class="bi-question-help-circle-fill"><i class="bi bi-question-circle-fill" data-bs-toggle="tooltip" title="Username"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <label class="sr-only" for="l_instagram">Link
                                                                        Instagram</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text"><i class="bi bi-link-45deg" style="font-size: 1rem;"></i></span>
                                                                        <input class="form-control" id="l_instagram" name="l_instagram" placeholder="Masukkan link instagram" type="text" value="{{ $sosmeds->l_instagram ?? null }}">
                                                                        <span class="bi-question-help-circle-fill"><i class="bi bi-question-circle-fill" data-bs-toggle="tooltip" title="Link"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <h6 class="fw-bold">Facebook</h6>
                                                                <div class="col-auto mb-2">
                                                                    <label class="sr-only" for="u_facebook">Username
                                                                        Facebook</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">@</div>
                                                                        </div>
                                                                        <input class="form-control" id="u_facebook" name="u_facebook" placeholder="Masukkan username facebook" type="text" value="{{ $sosmeds->u_facebook ?? null }}">
                                                                        <span class="bi-question-help-circle-fill"><i class="bi bi-question-circle-fill" data-bs-toggle="tooltip" title="Username"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <label class="sr-only" for="l_facebook">Link
                                                                        Facebook</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text"><i class="bi bi-link-45deg" style="font-size: 1rem;"></i></span>
                                                                        <input class="form-control" id="l_facebook" name="l_facebook" placeholder="Masukkan link Facebook" type="text" value="{{ $sosmeds->l_facebook ?? null }}">
                                                                        <span class="bi-question-help-circle-fill"><i class="bi bi-question-circle-fill" data-bs-toggle="tooltip" title="Link"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <h6 class="fw-bold">Twitter</h6>
                                                                <div class="col-auto mb-2">
                                                                    <label class="sr-only" for="u_twitter">Username
                                                                        Twitter</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">@</div>
                                                                        </div>
                                                                        <input class="form-control" id="u_twitter" name="u_twitter" placeholder="Masukkan username twitter" type="text" value="{{ $sosmeds->u_twitter ?? null }}">
                                                                        <span class="bi-question-help-circle-fill"><i class="bi bi-question-circle-fill" data-bs-toggle="tooltip" title="Username"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <label class="sr-only" for="l_twitter">Link
                                                                        Twitter</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text"><i class="bi bi-link-45deg" style="font-size: 1rem;"></i></span>
                                                                        <input class="form-control" id="l_twitter" name="l_twitter" placeholder="Masukkan link twitter" type="text" value="{{ $sosmeds->l_twitter ?? null }}">
                                                                        <span class="bi-question-help-circle-fill"><i class="bi bi-question-circle-fill" data-bs-toggle="tooltip" title="Link"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <h6 class="fw-bold">Tiktok</h6>
                                                                <div class="col-auto mb-2">
                                                                    <label class="sr-only" for="u_tiktok">Username
                                                                        Tiktok</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">@</div>
                                                                        </div>
                                                                        <input class="form-control" id="u_tiktok" name="u_tiktok" placeholder="Masukkan username tiktok" type="text" value="{{ $sosmeds->u_tiktok ?? null }}">
                                                                        <span class="bi-question-help-circle-fill"><i class="bi bi-question-circle-fill" data-bs-toggle="tooltip" title="Username"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <label class="sr-only" for="l_tiktok">Link
                                                                        Tiktok</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text"><i class="bi bi-link-45deg" style="font-size: 1rem;"></i></span>
                                                                        <input class="form-control" id="l_tiktok" name="l_tiktok" placeholder="Masukkan link tiktok" type="text" value="{{ $sosmeds->l_tiktok ?? null }}">
                                                                        <span class="bi-question-help-circle-fill"><i class="bi bi-question-circle-fill" data-bs-toggle="tooltip" title="Link"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <h6 class="fw-bold">Youtube</h6>
                                                                <div class="col-auto mb-2">
                                                                    <label class="sr-only" for="u_youtube">Username
                                                                        Youtube</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">@</div>
                                                                        </div>
                                                                        <input class="form-control" id="u_youtube" name="u_youtube" placeholder="Masukkan username youtube" type="text" value="{{ $sosmeds->u_youtube ?? null }}">
                                                                        <span class="bi-question-help-circle-fill"><i class="bi bi-question-circle-fill" data-bs-toggle="tooltip" title="Username"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <label class="sr-only" for="l_youtube">Link
                                                                        Youtube</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text"><i class="bi bi-link-45deg" style="font-size: 1rem;"></i></span>
                                                                        <input class="form-control" id="youtube" name="l_youtube" placeholder="Masukkan link youtube" type="text" value="{{ $sosmeds->l_youtube ?? null }}">
                                                                        <span class="bi-question-help-circle-fill"><i class="bi bi-question-circle-fill" data-bs-toggle="tooltip" title="Link"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="flex-item button">
                                                                <div class="d-grid d-md-flex justify-content-md-center gap-2">
                                                                    <button class="btn btn-success" type="submit">Upload</i></button>
                                                                    @php
                                                                        $social_media = ['u_instagram', 'l_instagram', 'u_facebook', 'l_facebook', 'u_twitter', 'l_twitter', 'u_youtube', 'l_youtube', 'u_tiktok', 'l_tiktok'];
                                                                        $show_button = false;
                                                                        foreach ($social_media as $media) {
                                                                            if (!empty($sosmeds->$media)) {
                                                                                $show_button = true;
                                                                                break;
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    @if (!empty($sosmeds) && $show_button)
                                                                        <button class="btn btn-danger" data-bs-route="{{ route('manage-perusahaan.deletesosmed', $sosmeds->id) }}" id="btnDelete" type="submit">Hapus</button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="h-100 rounded border p-3 shadow">
                                                    <h4 class="text-center">
                                                        Social Media
                                                    </h4>
                                                    <div class="my-4">
                                                        <div class="d-flex" style="min-height: 30px; align-items: center;">
                                                            <i class="bi bi-instagram me-1" style="font-size: 2rem; height: 32px; width: 32px;"></i>
                                                            @if (!empty($sosmeds) && $sosmeds->u_instagram)
                                                                <span class="ms-3">{{ $sosmeds->u_instagram ?? null }}</span>
                                                            @else
                                                                <span class="bg-warning ms-3 rounded border p-3 text-white">-- data kosong, harap isi data
                                                                    instagram --</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="d-flex" style="min-height: 30px; align-items: center;">
                                                            <i class="bi bi-facebook me-1" style="font-size: 2rem; height: 32px; width: 32px;"></i>
                                                            @if (!empty($sosmeds) && $sosmeds->u_facebook)
                                                                <span class="ms-3">{{ $sosmeds->u_facebook ?? null }}</span>
                                                            @else
                                                                <span class="bg-warning ms-3 rounded border p-3 text-white">-- data kosong, harap isi data
                                                                    facebook --</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="d-flex" style="min-height: 30px; align-items: center;">
                                                            <i class="bi bi-twitter me-1" style="font-size: 2rem; height: 32px; width: 32px;"></i>
                                                            @if (!empty($sosmeds) && $sosmeds->u_twitter)
                                                                <span class="ms-3">{{ $sosmeds->u_twitter ?? null }}</span>
                                                            @else
                                                                <span class="bg-warning ms-3 rounded border p-3 text-white">-- data kosong, harap isi data
                                                                    twitter --</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="d-flex" style="min-height: 30px; align-items: center;">
                                                            <i class="bi bi-tiktok me-1" style="font-size: 2rem; height: 32px; width: 32px;"></i>
                                                            @if (!empty($sosmeds) && $sosmeds->u_tiktok)
                                                                <span class="ms-3">{{ $sosmeds->u_tiktok ?? null }}</span>
                                                            @else
                                                                <span class="bg-warning ms-3 rounded border p-3 text-white">-- data kosong, harap isi data
                                                                    tiktok --</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="d-flex" style="min-height: 30px; align-items: center;">
                                                            <i class="bi bi-youtube me-1" style="font-size: 2rem; height: 32px; width: 32px;"></i>
                                                            @if (!empty($sosmeds) && $sosmeds->u_youtube)
                                                                <span class="ms-3">{{ $sosmeds->u_youtube ?? null }}</span>
                                                            @else
                                                                <span class="bg-warning ms-3 rounded border p-3 text-white">-- data kosong, harap isi data
                                                                    youtube --</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- konten siapa kami -->
                                        <div class="row mt-3">
                                            <div class="col-md-7">
                                                <div class="bg-body h-100 container mb-3 rounded border p-3 shadow">
                                                    <h4 class="text-center">
                                                        Siapa Kami?
                                                    </h4>
                                                    @if (session('success_about'))
                                                        <div class="alert alert-success text-center" id="success-alert">
                                                            {{ session('success_about') }}
                                                        </div>
                                                    @endif
                                                    @if ($errors->has('katasambutan') || $errors->has('judul_siapa') || $errors->has('fotobersama') || $errors->has('oldfotobersama'))
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
                                                    <form action="{{ route('manage-perusahaan.updateorcreateabout') }}" class="formstyle" enctype="multipart/form-data" id="formAbout" method="POST">
                                                        @csrf
                                                        <input name="id_about" readonly type="hidden" value="{{ $abouts->id ?? null }}">
                                                        <input name="oldfotobersama" type="hidden" value="{{ $abouts->fotobersama ?? null }}">
                                                        <label class="form-label mt-2" for="judul_siapa">Judul</label>
                                                        <input class="form-control" id="judul_siapa" name="judul_siapa" placeholder="Masukan Judul" type="text" value="{{ $abouts->judul ?? null }}">
                                                        <label class="form-label" for="katasambutan">Kata Sambutan</label>
                                                        <textarea class="form-control" id="katasambutan" name="katasambutan" oninput="autoResizeTextarea(this)" rows="3">{{ $abouts->katasambutan ?? null }}</textarea>
                                                        <label class="form-label" for="fotobersama">Foto Bersama</label>
                                                        <input accept="image/jpg, image/png, image/jpeg" class="form-control" id="fotobersama" name="fotobersama" type="file">
                                                        <div class="mt-2 text-center">
                                                            <button class="btn btn-success" type="submit">Upload</button>
                                                            @if (!empty($abouts) && ($abouts->katasambutan || $abouts->fotobersama || $abouts->judul))
                                                                <button class="btn btn-danger" data-bs-route="{{ route('manage-perusahaan.deleteabout', $abouts->id) }}" id="btnDelete" type="submit">hapus</button>
                                                            @endif
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <!-- output siapa kami? -->
                                                <div class="left bg-body h-100 mb-3 rounded border bg-white p-3 text-center shadow">
                                                    <h4 class="card-title text-center">Siapa Kami?</h4>
                                                    @if (!empty($abouts) && ($abouts->katasambutan || $abouts->fotobersama || $abouts->judul))
                                                        @if (!empty($abouts->fotobersama))
                                                            <img alt="fotobersama" class="img-owner rounded" src="/storage/{{ $abouts->fotobersama }}">
                                                        @else
                                                            <p class="bg-warning mt-4 rounded border p-3 text-center text-white">Foto Bersama Kosong!!</p>
                                                        @endif

                                                        @if (!empty($abouts->judul))
                                                            <h6 class="fw-bold">{{ $abouts->judul }}</h6>
                                                        @else
                                                            <p class="bg-warning mt-4 rounded border p-3 text-center text-white">Judul Kosong!!</p>
                                                        @endif

                                                        @if (!empty($abouts->katasambutan))
                                                            <p class="mt-3" style="text-align: justify;">{{ $abouts->katasambutan }}</p>
                                                        @else
                                                            <p class="bg-warning mt-4 rounded border p-3 text-center text-white">Kata Sambutan Kosong!!</p>
                                                        @endif
                                                    @else
                                                        <p class="bg-warning mt-4 rounded border p-3 text-center text-white">Siapa Kami Kosong!!<br>Isi pada bagian form input Siapa Kami</p>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>

                                        <!-- keunggulan perusahaan -->
                                        <div class="row mt-3">
                                            <div class="col-md-7">
                                                <div class="bg-body h-100 container mb-3 rounded border p-3 shadow">
                                                    <h4 class="text-center">
                                                        Apa Saja Yang Didapatkan?
                                                    </h4>
                                                    @if (session('success_offer'))
                                                        <div class="alert alert-success text-center" id="success-alert">
                                                            {{ session('success_offer') }}
                                                        </div>
                                                    @endif
                                                    @if ($errors->has('penawaran') || $errors->has('foto_bersama') || $errors->has('oldfoto_bersama'))
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
                                                    <form action="{{ route('manage-perusahaan.updateorcreateoffer') }}" class="formstyle" enctype="multipart/form-data" id="formOffer" method="POST">
                                                        @csrf
                                                        <input name="id_offer" readonly type="hidden" value="{{ $offers->id ?? null }}">
                                                        <input name="oldfoto_bersama" type="hidden" value="{{ $offers->foto_bersama ?? null }}">
                                                        <label class="form-label" for="foto_bersama">Foto Konten</label>
                                                        <input accept="image/jpg, image/png, image/jpeg" class="form-control mb-3" id="foto_bersama" name="foto_bersama" type="file">
                                                        <label class="form-label" for="Penawaran">Penawaran</label>
                                                        <textarea id="penawaran" name="penawaran">{{ $offers->penawaran ?? null }}</textarea>
                                                        <div class="mt-2 text-center">
                                                            <button class="btn btn-success" type="submit">Upload</button>
                                                            @if (!empty($offers) && ($offers->penawaran || $offers->foto_bersama))
                                                                <button class="btn btn-danger" data-bs-route="{{ route('manage-perusahaan.deleteoffer', $offers->id) }}" id="btnDelete" type="submit">hapus</button>
                                                            @endif
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <!-- output apa saja yang didapatkan -->
                                                <div class="left bg-body h-100 mb-3 rounded border bg-white p-3 shadow">
                                                    <h4 class="card-title text-center">Apa saja yang didapatkan?</h4>
                                                    @if (!empty($offers) && ($offers->penawaran || $offers->foto_bersama))
                                                        <div class="text-center">
                                                            @if (!empty($offers->foto_bersama))
                                                                <img alt="fotobersama" class="img-services mt-3 rounded" src="/storage/{{ $offers->foto_bersama }}">
                                                            @else
                                                                <p class="bg-warning mt-4 rounded border p-3 text-center text-white">-- Foto Kosong --</p>
                                                            @endif
                                                        </div>
                                                        <div class="p-5">
                                                            {!! $offers->penawaran ?? '<p class="text-center bg-warning rounded p-3 border text-white">-- Penawaran kosong --</p>' !!}
                                                        </div>
                                                    @else
                                                        <p class="bg-warning mt-4 rounded border p-3 text-center text-white"> Data Kosong!!<br> isi pada
                                                            bagian form input "Apa saja yang didapatkan?"</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Sertifikat legalitas perusahaan --}}
                                        <div class="row mt-3">
                                            <div class="col-md-7">
                                                <div class="h-100 rounded border p-3 shadow">
                                                    <h4 class="text-center">Sertifikat Legalitas Perusahaan</h4>
                                                    <p class="bg-danger mt-2 rounded border p-3 text-center text-white">Jika tidak ingin menampilkan sertifikat legalitas kosongkan form dibawah ini !</p>
                                                    @if (session('success_certificate'))
                                                        <div class="alert alert-success text-center" id="success-alert">
                                                            {{ session('success_certificate') }}
                                                        </div>
                                                    @endif
                                                    @if ($errors->has('pengantar') || $errors->has('foto_sertifikat') || $errors->has('oldfoto_sertifikat'))
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
                                                    <form action="{{ route('manage-perusahaan.updateorcreatecertificate') }}" class="formstyle" enctype="multipart/form-data" id="formCertificate" method="POST">
                                                        @csrf
                                                        <input name="id_certificate" readonly type="hidden" value="{{ $certificates->id ?? null }}">
                                                        <input name="oldfoto_sertifikat" type="hidden" value="{{ $certificates->foto_bersama ?? null }}">
                                                        <label class="form-label" for="foto_sertifikat">Foto Konten</label>
                                                        <input accept="image/jpg, image/png, image/jpeg" class="form-control mb-3" id="foto_sertifikat" name="foto_sertifikat" type="file">
                                                        <label class="form-label" for="Pengantar">Penjelasan Sertifikat</label>
                                                        <textarea class="form-control" id="pengantar" name="pengantar">{{ $certificates->pengantar ?? null }}</textarea>
                                                        <div class="mt-2 text-center">
                                                            <button class="btn btn-success" type="submit">Upload</button>
                                                            @if (!empty($certificates) && ($certificates->pengantar || $certificates->foto_sertifikat))
                                                                <button class="btn btn-danger" data-bs-route="{{ route('manage-perusahaan.deletecertificate', $certificates->id) }}" id="btnDelete" type="submit">hapus</button>
                                                            @endif
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="h-100 rounded border p-3 text-center shadow">
                                                    <div class="left bg-body h-100 mb-3 rounded border bg-white p-3 shadow">
                                                        <h4 class="text-center">Sertifikat Legalitas Perusahaan</h4>
                                                        @if (!empty($certificates->foto_sertifikat) || !empty($certificates->pengantar))
                                                            <div class="text-center">
                                                                @if (!empty($certificates->foto_sertifikat))
                                                                    <img alt="fotosertifikat" class="img-services mt-3 rounded" src="/storage/{{ $certificates->foto_sertifikat }}">
                                                                @else
                                                                    <p class="bg-warning mt-4 rounded border p-3 text-center text-white">-- Foto Kosong --</p>
                                                                @endif
                                                            </div>
                                                            <div class="p-3">
                                                                {!! $certificates->pengantar ?? '<p class="text-center bg-warning rounded p-3 border text-white">-- Penjelasan Sertifikat Kosong --</p>' !!}
                                                            </div>
                                                        @else
                                                            <p class="bg-warning mt-4 rounded border p-3 text-center text-white"> Data Kosong!!<br> Isi pada bagian form input "Sertifikat Legalitas Perusahaan"</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- jam operasional -->
                                        <div class="bg-body container mb-3 mt-3 rounded border p-3 shadow">
                                            <h4 class="text-center">
                                                Jam Operasional Perusahaan
                                            </h4>
                                            @if (session('success_jo'))
                                                <div class="alert alert-success text-center" id="success-alert">
                                                    {{ session('success_jo') }}
                                                </div>
                                            @endif
                                            @if ($errors->has('day') || $errors->has('from') || $errors->has('to'))
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
                                            <div class="hours-operation ms-3 mt-5">
                                                <form action="{{ route('manage-perusahaan.updateorcreatejo') }}" id="formJamOperasional" method="POST">
                                                    @csrf
                                                    @foreach ($workinghours as $i => $value)
                                                        <div class="row px-3">
                                                            <div class="col-sm-2">
                                                                <div class="form-check form-switch me-5">
                                                                    <input @checked($value->status) class="form-check-input" id="switch{{ $i }}" name="day[{{ $value->id }}][]" role="switch" type="checkbox" value="true">
                                                                    <label class="form-check-label @if ($value->day == 'Minggu') text-danger @endif" for="switch{{ $i }}">
                                                                        {{ $value->day }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="switch-text ms-4">Buka</div>
                                                            </div>
                                                            <div class="col-sm-7 d-flex time">
                                                                <div class="mob">
                                                                    <label class="mr-1" for="from{{ $i }}">From</label>
                                                                    <input class="ml-1" id="from{{ $i }}" name="from[{{ $value->id }}][]" type="time" value={{ old('', $value->time_from_format) }}>
                                                                </div>
                                                                <div class="mob mb-2">
                                                                    <label class="mr-4" for="to{{ $i }}">To</label>
                                                                    <input class="ml-1" id="to{{ $i }}" name="to[{{ $value->id }}][]" type="time" value={{ old('', $value->time_to_format) }}>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div class="row justify-content-center mt-3 px-3">
                                                        <button class="btn btn-success ml-2" type="submit">Upload</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        function autoResizeTextarea(textarea) {
            textarea.style.height = 'auto';
            textarea.style.height = textarea.scrollHeight + 'px';
        }
    </script>

    {{-- script untuk seluruh tombol hapus --}}
    <script>
        let btnDelete = document.querySelectorAll('#btnDelete');
        btnDelete.forEach((btn) => {
            btn.addEventListener('click', function(e) {
                console.log(e.currentTarget);
                const formCompany = e.currentTarget.closest('form');
                console.log(formCompany);
                formCompany.action = e.currentTarget.getAttribute('data-bs-route');
                const createField = document.createElement('input');
                createField.type = 'hidden';
                createField.name = '_method';
                createField.value = 'delete';
                formCompany.appendChild(createField);
            })
        })
    </script>
    {{-- TinyMCE --}}
    <script src="{{ asset('templates') }}/vendor/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    {{-- script untuk textarea form penawaran --}}
    <script>
        tinymce.init({
            selector: 'textarea#penawaran, textarea#misi',
            plugins: ['lists', 'wordcount'],
            menubar: 'edit insert format',
            toolbar: 'bullist numlist',
            content_style: 'body { font-family:Suwannaphum, serif; font-size:16px }'
        });
    </script>
    {{-- script untuk tooltip icon help info --}}
    <script>
        // Initialize tooltips
        let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        let tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Mendapatkan semua elemen switch dan input waktu
            let switches = document.querySelectorAll("input[type='checkbox'][role='switch']");

            switches.forEach(function(switchElement) {
                // Menambahkan event listener ke setiap switch
                switchElement.addEventListener("change", function(e) {
                    // Mendapatkan elemen teks status terkait
                    let switchText = this.closest(".row").querySelector(".switch-text");
                    // Mendapatkan input waktu terkait
                    let parentRow = this.closest(".row");
                    let inputs = parentRow.querySelectorAll("input[type='time']");
                    // Memeriksa status tombol switch
                    if (this.checked) {
                        // Mengaktifkan input waktu terkait
                        inputs.forEach(function(input) {
                            input.disabled = false;
                        });
                        // Mengubah teks status menjadi "Buka"
                        switchText.textContent = "Buka";
                        // Mengubah warna teks menjadi biru
                        switchText.style.color = "blue";
                        // Membuat attribute checked elemen switch
                        e.target.setAttribute('checked', '');
                        // Mengubah nilai elemen switch
                        e.target.value = 'true';
                    } else {
                        // Menonaktifkan input waktu terkait
                        inputs.forEach(function(input) {
                            input.disabled = true;
                        });
                        // Mengubah teks status menjadi "Tutup"
                        switchText.textContent = "Tutup";
                        // Mengubah warna teks menjadi merah
                        switchText.style.color = "red";
                        // Menghapus attribute checked elemen switch
                        e.target.removeAttribute('checked');
                        // Mengubah nilai elemen switch
                        e.target.value = 'false';
                    }
                });

                // Inisialisasi status switch saat halaman dimuat
                let switchText = switchElement.closest(".row").querySelector(".switch-text");
                let parentRow = switchElement.closest(".row");
                let inputs = parentRow.querySelectorAll("input[type='time']");
                // Memeriksa status tombol switch
                if (switchElement.checked) {
                    // Mengaktifkan input waktu terkait
                    inputs.forEach(function(input) {
                        input.disabled = false;
                    });
                    // Mengubah teks status menjadi "Buka"
                    switchText.textContent = "Buka";
                    // Mengubah warna teks menjadi biru
                    switchText.style.color = "blue";
                    // Mengubah nilai elemen switch
                    switchElement.value = 'true';
                } else {
                    // Menonaktifkan input waktu terkait
                    inputs.forEach(function(input) {
                        input.disabled = true;
                    });
                    // Mengubah teks status menjadi "Tutup"
                    switchText.textContent = "Tutup";
                    // Mengubah warna teks menjadi merah
                    switchText.style.color = "red";
                    // Mengubah nilai elemen switch
                    switchElement.value = 'false';
                }
            });
        });
    </script>
@endpush
