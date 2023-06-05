@extends('admin.layouts.layouts')
@section('title', 'Manage Perusahaan')
@push('styles')
<link href="{{ asset('templates') }}/assets/css-modif/admin/ManagePerusahaan.css" rel="stylesheet">
@endpush
@section('content')
<section>
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div aria-labelledby="home-tab" class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" tabindex="0">
                        <div class="content-wrapper">
                            <div class="row same-height">

                                <!-- left content -->
                                <div class="col-md-8">
                                    <div class="wrapper-list">
                                        <div class="flex-header text-center border">
                                            <h3 class="fw-bold">Manage Perusahaan</h3>
                                        </div>

                                        <!-- foto owner -->
                                        <div class="container border mt-3 shadow p-3 mb-5 bg-body rounded">
                                            <h4 class="text-center">
                                                Foto & Nama Owner
                                            </h4>
                                            <form action="{{ route('manage-perusahaan.updateorcreateowner') }}" class="formstyle" enctype="multipart/form-data" id="formOwner" method="POST">
                                                <div class="flex-item form">
                                                    @csrf
                                                    <input name="id_owner" type="hidden" value="{{ $owners->id ?? null }}">
                                                    <input name="oldfoto_owner" type="hidden" value="{{ $owners->foto_owner ?? null }}">
                                                    <label class="form-label" for="nama_owner">Nama Owner</label>
                                                    <input class="form-control" id="nama_owner" name="nama_owner" placeholder="Masukkan nama owner" type="text" value="{{ $owners->nama_owner ?? null }}">
                                                    <label class="form-label" for="kata_sambutan">Kata Sambutan</label>
                                                    <textarea class="form-control" id="kata_sambutan" name="kata_sambutan" rows="3">{{ $owners->kata_sambutan ?? null }}</textarea>
                                                    <label class="form-label" for="foto_owner">Foto Owner</label>
                                                    <input class="form-control" id="foto_owner" name="foto_owner" type="file">
                                                </div>
                                                <div class="flex-item button">
                                                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                        <button class="btn btn-success" type="submit">Upload</button>
                                                        @if (!empty($owners) && ($owners->nama_owner || $owners->foto_owner || $owners->kata_sambutan))
                                                        <button class="btn btn-danger" data-bs-route="{{ route('manage-perusahaan.deleteowner', $owners->id) }}" id="btnDelete" type="submit">Hapus</i></button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <!-- logo dan nama perusahaan -->
                                        <div class="container border mt-3 shadow p-3 mb-5 bg-body rounded">
                                            <h4 class="text-center">
                                                Logo & Nama Perusahaan
                                            </h4>
                                            <form action="{{ route('manage-perusahaan.updateorcreatecompany') }}" class="formstyle" enctype="multipart/form-data" id="formCompany" method="POST">
                                                <div class="flex-item form">
                                                    @csrf
                                                    <input name="id_perusahaan" readonly type="hidden" value="{{ $companies->id ?? null }}">
                                                    <input name="oldlogo_perusahaan" type="hidden" value="{{ $companies->logo_perusahaan ?? null }}">
                                                    <label class="form-label" for="nama_perusahaan">Nama Perusahaan</label>
                                                    <input class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Masukkan nama perusahaan" type="text" value="{{ old('username', $companies->nama_perusahaan ?? null) }}">
                                                    <label class="form-label" for="logo">Logo Perusahaan</label>
                                                    <input accept="image/jpg, image/png, image/jpeg" class="form-control" id="logo" name="logo_perusahaan" type="file">
                                                </div>
                                                <div class="flex-item button">
                                                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                        <button class="btn btn-success" type="submit">Upload</button>
                                                        @if (!empty($companies) && ($companies->nama_perusahaan || $companies->logo_perusahaan))
                                                        <button class="btn btn-danger" data-bs-route="{{ route('manage-perusahaan.deletecompany', $companies->id) }}" id="btnDelete" type="submit">Hapus</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <!-- alamat perusahaan -->
                                        <div class="container border mt-3 shadow p-3 mb-5 bg-body rounded">
                                            <h4 class="text-center">Alamat Perusahaan</h4>
                                            <form action="{{ route('manage-perusahaan.updateorcreateaddress') }}" class="formstyle" enctype="multipart/form-data" id="formAlamat" method="POST">
                                                <div class="flex-item form">
                                                    @csrf
                                                    <label class="form-label" for="alamat_perusahaan">Alamat</label>
                                                    <input name="id_alamat" type="hidden" value="{{ $addresses->id ?? null }}">
                                                    <input class="form-control" id="alamat_perusahaan" name="alamat_perusahaan" placeholder="Masukkan alamat perusahaan" type="text" value="{{ $addresses->alamat_perusahaan ?? null }}">
                                                    <label class="form-label" for="link_gmap">Link Google Maps</label>
                                                    <input aria-label="default input example" class="form-control" id="link_gmap" name="link_gmap" placeholder="Link Google Maps" type="text" value="{{ $addresses->link_gmap ?? null }}">
                                                </div>
                                                <div class="flex-item button">
                                                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                        <button class="btn btn-success" type="submit">Upload</button>
                                                        @if ((!empty($addresses) && $addresses->alamat_perusahaan) || $addresses->link_gmap)
                                                        <button class="btn btn-danger" data-bs-route="{{ route('manage-perusahaan.deleteaddress', $addresses->id) }}" id="btnDelete" type="submit">Hapus</i></button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <!-- telephone dan whatsapp perusahaan -->
                                        <div class="container border mt-3 shadow p-3 mb-5 bg-body rounded">
                                            <h4 class="text-center">
                                                Kontak
                                            </h4>
                                            <form action="{{ route('manage-perusahaan.updateorcreatecontact') }}" class="formstyle" enctype="multipart/form-data" id="formContact" method="POST">
                                                <div class="flex-item form">
                                                    @csrf
                                                    <input name="id_contact" readonly type="hidden" value="{{ $contacts->id ?? null }}">
                                                    <label class="form-label fw-bold" for="telephone1">Telephone 1</label>
                                                    <input class="form-control" id="telephone1" name="telephone1_name" placeholder="Nama nomor telephone 1" type="text" value="{{ $contacts->telephone1_name ?? null }}">
                                                    <input class="form-control mt-2" id="telephone1" name="telephone1_number" placeholder="Masukkan nomor telephone 1" type="text" value="{{ $contacts->telephone1_number ?? null }}">

                                                    <label class="form-label mt-3 fw-bold" for="telephone2">Telephone 2</label>
                                                    <input class="form-control" id="telephone2" name="telephone2_name" placeholder="Nama nomor telephone 2" type="text" value="{{ $contacts->telephone2_name ?? null }}">
                                                    <input class="form-control mt-2" id="telephone2" name="telephone2_number" placeholder="Masukkan nomor telephone 2" type="text" value="{{ $contacts->telephone2_number ?? null }}">

                                                    <label class="form-label mt-4 fw-bold" for="whatsapp1">Whatsapp 1</label>
                                                    <input class="form-control" id="whatsapp1" name="whatsapp1_name" placeholder="Nama Whatsapp 1" type="text" value="{{ $contacts->whatsapp1_name ?? null }}">
                                                    <input class="form-control mt-2" id="whatsapp1" name="whatsapp1_number" placeholder="Masukkan nomor whatsapp 1" type="text" value="{{ $contacts->whatsapp1_number ?? null }}">

                                                    <label class="form-label mt-3 fw-bold" for="whatsapp2">Whatsapp 2</label>
                                                    <input class="form-control" id="whatsapp2" name="whatsapp2_name" placeholder="Nama Whatsapp 2" type="text" value="{{ $contacts->whatsapp2_name ?? null }}">
                                                    <input class="form-control mt-2" id="whatsapp2" name="whatsapp2_number" placeholder="Masukkan nomor whatsapp 2" type="text" value="{{ $contacts->whatsapp2_number ?? null }}">

                                                    <label class="form-label mt-3 fw-bold" for="whatsapp3">Whatsapp 3</label>
                                                    <input class="form-control" id="whatsapp3" name="whatsapp3_name" placeholder="Nama Whatsapp 3" type="text" value="{{ $contacts->whatsapp3_name ?? null }}">
                                                    <input class="form-control mt-2" id="whatsapp3" name="whatsapp3_number" placeholder="Masukkan nomor whatsapp 3" type="text" value="{{ $contacts->whatsapp3_number ?? null }}">

                                                    <label class="form-label mt-3 fw-bold" for="whatsapp4">Whatsapp 4</label>
                                                    <input class="form-control" id="whatsapp4" name="whatsapp4_name" placeholder="Nama Whatsapp 4" type="text" value="{{ $contacts->whatsapp4_name ?? null }}">
                                                    <input class="form-control mt-2" id="whatsapp4" name="whatsapp4_number" placeholder="Masukkan nomor whatsapp 4" type="text" value="{{ $contacts->whatsapp4_number ?? null }}">

                                                    <label class="form-label mt-3 fw-bold" for="email">Email</label>
                                                    <input class="form-control mt-2" id="email" name="email" placeholder="Masukkan email" type="email" value="{{ $contacts->email ?? null }}">
                                                </div>
                                                <div class="flex-item button">
                                                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                        <button class="btn btn-success" type="submit">Upload</button>
                                                        @if (!empty($contacts) && ($contacts->telephone || $contacts->whatsapp || $contacts->email))
                                                        <button class="btn btn-danger" data-bs-route="{{ route('manage-perusahaan.deletecontact', $contacts->id) }}" id="btnDelete" type="submit">Hapus</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <!-- sosial media -->
                                        <div class="container border mt-3 shadow p-3 mb-5 bg-body rounded">
                                            <h4 class="text-center">
                                                Social Media
                                            </h4>
                                            <form action="{{ route('manage-perusahaan.updateorcreatesosmed') }}" class="formstyle" enctype="multipart/form-data" id="formSosmed" method="POST">
                                                <div class="flex-item form">
                                                    @csrf
                                                    <input name="id_sosmed" readonly type="hidden" value="{{ $sosmeds->id ?? null }}">
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Instagram</h6>
                                                        <div class="col-auto mb-2">
                                                            <label class="sr-only" for="u_instagram">Username Instagram</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">@</div>
                                                                </div>
                                                                <input class="form-control" id="instagram" name="u_instagram" placeholder="Masukkan username instagram" type="text" value="{{ $sosmeds->u_instagram ?? null }}">
                                                                <span class="fa-circle-info-help"><i class="fa-sharp fa-solid fa-circle-question" data-bs-toggle="tooltip" title="Username"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <label class="sr-only" for="l_instagram">Link Instagram</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="fa fa-link" style="font-size: .8rem;"></i></span>
                                                                <input class="form-control" id="l_instagram" name="l_instagram" placeholder="Masukkan link instagram" type="text" value="{{ $sosmeds->l_instagram ?? null }}">
                                                                <span class="fa-circle-info-help"><i class="fa-sharp fa-solid fa-circle-question" data-bs-toggle="tooltip" title="Link"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Facebook</h6>
                                                        <div class="col-auto mb-2">
                                                            <label class="sr-only" for="u_facebook">Username Facebook</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">@</div>
                                                                </div>
                                                                <input class="form-control" id="facebook" name="u_facebook" placeholder="Masukkan username facebook" type="text" value="{{ $sosmeds->u_facebook ?? null }}">
                                                                <span class="fa-circle-info-help"><i class="fa-sharp fa-solid fa-circle-question" data-bs-toggle="tooltip" title="Username"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <label class="sr-only" for="l_facebook">Link Facebook</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="fa fa-link" style="font-size: .8rem;"></i></span>
                                                                <input class="form-control" id="facebook" name="l_facebook" placeholder="Masukkan link Facebook" type="text" value="{{ $sosmeds->l_facebook ?? null }}">
                                                                <span class="fa-circle-info-help"><i class="fa-sharp fa-solid fa-circle-question" data-bs-toggle="tooltip" title="Link"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Twitter</h6>
                                                        <div class="col-auto mb-2">
                                                            <label class="sr-only" for="u_twitter">Username Twitter</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">@</div>
                                                                </div>
                                                                <input class="form-control" id="twitter" name="u_twitter" placeholder="Masukkan username twitter" type="text" value="{{ $sosmeds->u_twitter ?? null }}">
                                                                <span class="fa-circle-info-help"><i class="fa-sharp fa-solid fa-circle-question" data-bs-toggle="tooltip" title="Username"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <label class="sr-only" for="l_twitter">Link Twitter</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="fa fa-link" style="font-size: .8rem;"></i></span>
                                                                <input class="form-control" id="twitter" name="l_twitter" placeholder="Masukkan link twitter" type="text" value="{{ $sosmeds->l_twitter ?? null }}">
                                                                <span class="fa-circle-info-help"><i class="fa-sharp fa-solid fa-circle-question" data-bs-toggle="tooltip" title="Link"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Tiktok</h6>
                                                        <div class="col-auto mb-2">
                                                            <label class="sr-only" for="u_twitter">Username Tiktok</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">@</div>
                                                                </div>
                                                                <input class="form-control" id="twitter" name="u_twitter" placeholder="Masukkan username tiktok" type="text" value="">
                                                                <span class="fa-circle-info-help"><i class="fa-sharp fa-solid fa-circle-question" data-bs-toggle="tooltip" title="Username"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <label class="sr-only" for="l_twitter">Link Tiktok</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="fa fa-link" style="font-size: .8rem;"></i></span>
                                                                <input class="form-control" id="twitter" name="l_tiktok" placeholder="Masukkan link tiktok" type="text" value="">
                                                                <span class="fa-circle-info-help"><i class="fa-sharp fa-solid fa-circle-question" data-bs-toggle="tooltip" title="Link"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Youtube</h6>
                                                        <div class="col-auto mb-2">
                                                            <label class="sr-only" for="u_youtube">Username Youtube</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">@</div>
                                                                </div>
                                                                <input class="form-control" id="youtube" name="u_youtube" placeholder="Masukkan link channel youtube" type="text" value="{{ $sosmeds->u_youtube ?? null }}">
                                                                <span class="fa-circle-info-help"><i class="fa-sharp fa-solid fa-circle-question" data-bs-toggle="tooltip" title="Username"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <label class="sr-only" for="l_youtube">Link Youtube</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="fa fa-link" style="font-size: .8rem;"></i></span>
                                                                <input class="form-control" id="youtube" name="l_youtube" placeholder="Masukkan link youtube" type="text" value="{{ $sosmeds->l_youtube ?? null }}">
                                                                <span class="fa-circle-info-help"><i class="fa-sharp fa-solid fa-circle-question" data-bs-toggle="tooltip" title="Link"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-item button">
                                                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                            <button class="btn btn-success" type="submit">Upload</i></button>
                                                            @php
                                                            $social_media = ['u_instagram', 'l_instagram', 'u_facebook', 'l_facebook', 'u_twitter', 'l_twitter', 'u_youtube', 'l_youtube'];
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

                                        <!-- konten siapa kami -->
                                        <div class="container border mt-3 shadow p-3 mb-5 bg-body rounded">
                                            <h4 class="text-center">
                                                Siapa Kami?
                                            </h4>
                                            <form action="{{ route('manage-perusahaan.updateorcreateabout') }}" class="formstyle" enctype="multipart/form-data" id="formAbout" method="POST">
                                                @csrf
                                                <input name="id_about" readonly type="hidden" value="{{ $abouts->id ?? null }}">
                                                <input name="oldfotobersama" type="hidden" value="{{ $abouts->fotobersama ?? null }}">
                                                <label class="form-label mt-2" for="youtube">Judul</label>
                                                <input class="form-control" id="youtube" name="" placeholder="Masukan Judul" type="text" value="">
                                                <label class="form-label" for="katasambutan">Kata Sambutan</label>
                                                <textarea class="form-control" id="katasambutan" name="katasambutan" rows="3">{{ $abouts->katasambutan ?? null }}</textarea>
                                                <label class="form-label" for="fotobersama">Foto Bersama</label>
                                                <input accept="image/jpg, image/png, image/jpeg" class="form-control" id="fotobersama" name="fotobersama" type="file">
                                                <div class="mt-2 text-center">
                                                    <button class="btn btn-success" type="submit">Upload</button>
                                                    @if (!empty($abouts) && ($abouts->katasambutan || $abouts->fotobersama))
                                                    <button class="btn btn-danger" data-bs-route="{{ route('manage-perusahaan.deleteabout', $abouts->id) }}" id="btnDelete" type="submit">hapus</button>
                                                    @endif
                                                </div>
                                            </form>
                                        </div>

                                        <!-- keunggulan perusahaan -->
                                        <div class="container border mt-3 shadow p-3 mb-5 bg-body rounded">
                                            <h4 class="text-center">
                                                Apa Saja Yang Didapatkan?
                                            </h4>
                                            <form action="{{ route('manage-perusahaan.updateorcreateoffer') }}" class="formstyle" enctype="multipart/form-data" id="formOffer" method="POST">
                                                @csrf
                                                <input name="id_offer" readonly type="hidden" value="{{ $offers->id ?? null }}">
                                                <input name="oldfoto_bersama" type="hidden" value="{{ $offers->foto_bersama ?? null }}">
                                                <label class="form-label" for="foto_bersama">Foto Bersama</label>
                                                <input accept="image/jpg, image/png, image/jpeg" class="form-control mb-3" id="foto_bersama" name="foto_bersama" type="file">
                                                <textarea id="penawaran" name="penawaran">{{ $offers->penawaran ?? null }}</textarea>
                                                <div class="mt-2 text-center">
                                                    <button class="btn btn-success" type="submit">Upload</button>
                                                    @if (!empty($offers) && ($offers->penawaran || $offers->foto_bersama))
                                                    <button class="btn btn-danger" data-bs-route="{{ route('manage-perusahaan.deleteoffer', $offers->id) }}" id="btnDelete" type="submit">hapus</button>
                                                    @endif
                                                </div>
                                            </form>
                                        </div>

                                        <!-- jam operasional -->
                                        <div class="container border mt-3 shadow p-3 mb-5 bg-body rounded">
                                            <h4 class="text-center">
                                                Jam Operasional Perusahaan
                                            </h4>
                                            <div class="mt-5 ms-3 hours-operation">
                                                <div class="row px-3">
                                                    <div class="col-sm-2 list">
                                                        <div class="form-check form-switch me-5">
                                                            <input class="form-check-input" type="checkbox" role="switch" id="switch1">
                                                            <label class="form-check-label" for="switch1">
                                                                Senin
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="switch-text ms-4">Buka</div>
                                                    </div>
                                                    <div class="col-sm-7 d-flex time">
                                                        <div class="mob">
                                                            <label class="mr-1">From</label>
                                                            <input class="ml-1" type="time" name="from">
                                                        </div>
                                                        <div class="mob mb-2">
                                                            <label class="mr-4">To</label>
                                                            <input class="ml-1" type="time" name="to">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row px-3">
                                                    <div class="col-sm-2 list">
                                                        <div class="form-check form-switch me-5">
                                                            <input class="form-check-input" type="checkbox" role="switch" id="switch2">
                                                            <label class="form-check-label" for="switch2">
                                                                Selasa
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="switch-text ms-4">Buka</div>
                                                    </div>
                                                    <div class="col-sm-7 d-flex time">
                                                        <div class="mob">
                                                            <label class="mr-1">From</label>
                                                            <input class="ml-1" type="time" name="from">
                                                        </div>
                                                        <div class="mob mb-2">
                                                            <label class="mr-4">To</label>
                                                            <input class="ml-1" type="time" name="to">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row px-3">
                                                    <div class="col-sm-2 list">
                                                        <div class="form-check form-switch me-5">
                                                            <input class="form-check-input" type="checkbox" role="switch" id="switch3">
                                                            <label class="form-check-label" for="switch3">
                                                                Rabu
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="switch-text ms-4">Buka</div>
                                                    </div>
                                                    <div class="col-sm-7 d-flex time">
                                                        <div class="mob">
                                                            <label class="mr-1">From</label>
                                                            <input class="ml-1" type="time" name="from">
                                                        </div>
                                                        <div class="mob mb-2">
                                                            <label class="mr-4">To</label>
                                                            <input class="ml-1" type="time" name="to">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row px-3">
                                                    <div class="col-sm-2 list">
                                                        <div class="form-check form-switch me-5">
                                                            <input class="form-check-input" type="checkbox" role="switch" id="switch4">
                                                            <label class="form-check-label" for="switch4">
                                                                Kamis
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="switch-text ms-4">Buka</div>
                                                    </div>
                                                    <div class="col-sm-7 d-flex time">
                                                        <div class="mob">
                                                            <label class="mr-1">From</label>
                                                            <input class="ml-1" type="time" name="from">
                                                        </div>
                                                        <div class="mob mb-2">
                                                            <label class="mr-4">To</label>
                                                            <input class="ml-1" type="time" name="to">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row px-3">
                                                    <div class="col-sm-2 list">
                                                        <div class="form-check form-switch me-5">
                                                            <input class="form-check-input" type="checkbox" role="switch" id="switch5">
                                                            <label class="form-check-label" for="switch5">
                                                                Jumat
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="switch-text ms-4">Buka</div>
                                                    </div>
                                                    <div class="col-sm-7 d-flex time">
                                                        <div class="mob">
                                                            <label class="mr-1">From</label>
                                                            <input class="ml-1" type="time" name="from">
                                                        </div>
                                                        <div class="mob mb-2">
                                                            <label class="mr-4">To</label>
                                                            <input class="ml-1" type="time" name="to">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row px-3">
                                                    <div class="col-sm-2 list">
                                                        <div class="form-check form-switch me-5">
                                                            <input class="form-check-input" type="checkbox" role="switch" id="switch6">
                                                            <label class="form-check-label" for="switch6">
                                                                Sabtu
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="switch-text ms-4">Buka</div>
                                                    </div>
                                                    <div class="col-sm-7 d-flex time">
                                                        <div class="mob">
                                                            <label class="mr-1">From</label>
                                                            <input class="ml-1" type="time" name="from">
                                                        </div>
                                                        <div class="mob mb-2">
                                                            <label class="mr-4">To</label>
                                                            <input class="ml-1" type="time" name="to">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row px-3">
                                                    <div class="col-sm-2 list">
                                                        <div class="form-check form-switch me-5">
                                                            <input class="form-check-input" type="checkbox" role="switch" id="switch7">
                                                            <label class="form-check-label text-danger" for="switch7">
                                                                Minggu
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="switch-text ms-4">Buka</div>
                                                    </div>
                                                    <div class="col-sm-7 d-flex time">
                                                        <div class="mob">
                                                            <label class="mr-1">From</label>
                                                            <input class="ml-1" type="time" name="from">
                                                        </div>
                                                        <div class="mob mb-2">
                                                            <label class="mr-4">To</label>
                                                            <input class="ml-1" type="time" name="to">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row px-3 mt-3 justify-content-center">
                                                    <button class="btn btn-success ml-2">Upload</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- right konten -->
                                <div class="col-md-4">
                                    <div class="left border text-center bg-white shadow p-3 mb-5 bg-body rounded">
                                        <h4>Owner Perusahaan</h4>
                                        {{-- empty aslinya false jika tidak kosong, true jika kosong --}}
                                        {{-- !empty menjadi true jika false, false jika true --}}
                                        @if (!empty($owners))
                                        <div class="text-center">
                                            @if (!empty($owners->foto_owner))
                                            <img alt="{{ $owners->nama_owner }}" class="rounded img-owner" src="/storage/{{ $owners->foto_owner }}">
                                            @endif
                                        </div>
                                        <p>{{ $owners->kata_sambutan }}</p>
                                        <h6 class="fw-bolder text-capitalize">{{ $owners->nama_owner }}</h6>
                                        @endif
                                    </div>
                                    <div class="left border text-center bg-white shadow p-3 mb-5 bg-body rounded">
                                        <h4 class="card-title">Logo & Nama Perusahaan</h4>
                                        @if (!empty($companies))
                                        <div class="text-center">
                                            @if (!empty($companies->logo_perusahaan))
                                            <img alt="{{ $companies->nama_perusahaan }}" class="rounded-circle" src="/storage/{{ $companies->logo_perusahaan }}">
                                            @endif
                                        </div>
                                        <h6 class="fw-bolder">{{ $companies->nama_perusahaan }}</h6>
                                        @endif
                                    </div>
                                    <div class="left border bg-white shadow p-3 mb-5 bg-body rounded">
                                        <div class="mt-3 mb-4">
                                            <h4 class="text-center">Alamat, Kontak & Sosial Media Perusahaan</h4>
                                        </div>
                                        <div class="mb-4">
                                            <div class="d-flex" style="min-height: 30px; align-items: center;">
                                                <i class="fa-sharp fa-solid fa-map-location-dot me-1" style="font-size: 2rem; height: 32px; width: 32px;"></i>
                                                <span class="ms-3">{{ $addresses->alamat_perusahaan ?? null }}</span>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <div class="d-flex" style="min-height: 30px; align-items: center;">
                                                <i class="fa-solid fa-phone-volume me-1" style="font-size: 2rem; height: 32px; width: 32px;"></i>
                                                <span class="ms-3">Telephone</span>
                                            </div>
                                            <ol style="margin-left: 2.3rem; padding-left: 2.1rem;">
                                                @php
                                                $data_contact_telephone = [['name' => $contacts->telephone1_name, 'number' => $contacts->telephone1_number], ['name' => $contacts->telephone2_name, 'number' => $contacts->telephone2_number]];
                                                @endphp
                                                @foreach ($data_contact_telephone as $contact)
                                                @if ($contact['name'] || $contact['number'])
                                                <li>{{ $contact['number'] ?? null }} ({{ $contact['name'] ?? null }})</li>
                                                @endif
                                                @endforeach
                                            </ol>
                                        </div>
                                        <div class="mb-4">
                                            <div class="d-flex" style="min-height: 30px; align-items: center;">
                                                <i class="fa-brands fa-whatsapp me-1" style="font-size: 2rem; height: 32px; width: 32px;"></i>
                                                <span class="ms-3">Whatsapp</span>
                                            </div>
                                            <ol style="margin-left: 2.3rem; padding-left: 2.1rem;">
                                                @php
                                                $data_contact_whatsapp = [['name' => $contacts->whatsapp1_name, 'number' => $contacts->whatsapp1_number], ['name' => $contacts->whatsapp2_name, 'number' => $contacts->whatsapp2_number], ['name' => $contacts->whatsapp3_name, 'number' => $contacts->whatsapp3_number], ['name' => $contacts->whatsapp4_name, 'number' => $contacts->whatsapp4_number]];
                                                @endphp
                                                @foreach ($data_contact_whatsapp as $contact)
                                                @if ($contact['name'] || $contact['number'])
                                                <li>{{ $contact['number'] ?? null }} ({{ $contact['name'] ?? null }})</li>
                                                @endif
                                                @endforeach
                                            </ol>
                                        </div>
                                        <div class="mb-4">
                                            <div class="d-flex" style="min-height: 30px; align-items: center;">
                                                <i class="fa-brands fa-instagram me-1" style="font-size: 2rem; height: 32px; width: 32px;"></i>
                                                <span class="ms-3">{{ $sosmeds->u_instagram ?? null }}</span>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <div class="d-flex" style="min-height: 30px; align-items: center;">
                                                <i class="fa-brands fa-facebook me-1" style="font-size: 2rem; height: 32px; width: 32px;"></i>
                                                <span class="ms-3">{{ $sosmeds->u_facebook ?? null }}</span>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <div class="d-flex" style="min-height: 30px; align-items: center;">
                                                <i class="fa-brands fa-twitter me-1" style="font-size: 2rem; height: 32px; width: 32px;"></i>
                                                <span class="ms-3">{{ $sosmeds->u_twitter ?? null }}</span>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <div class="d-flex" style="min-height: 30px; align-items: center;">
                                                <i class="fa-brands fa-tiktok me-1" style="font-size: 2rem; height: 32px; width: 32px;"></i>
                                                <span class="ms-3"></span>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <div class="d-flex" style="min-height: 30px; align-items: center;">
                                                <i class="fa-brands fa-youtube me-1" style="font-size: 2rem; height: 32px; width: 32px;"></i>
                                                <span class="ms-3">{{ $sosmeds->u_youtube ?? null }}</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="left border text-center bg-white shadow p-3 mb-5 bg-body rounded">
                                        @if (!empty($abouts) && ($abouts->katasambutan || $abouts->fotobersama))
                                        <h4 class="card-title text-center">Siapa Kami?</h4>
                                        @if (!empty($abouts->fotobersama))
                                        <img alt="fotobersama" class="rounded img-owner" src="/storage/{{ $abouts->fotobersama }}">
                                        @endif
                                        <p>{{ $abouts->katasambutan }}</p>
                                        @endif
                                    </div>
                                    <div class="left border bg-white shadow p-3 mb-5 bg-body rounded">
                                        @if (!empty($offers) && ($offers->penawaran || $offers->foto_bersama))
                                        <div class="text-center">
                                            <h4 class="card-title text-center">Apa saja yang didapatkan?</h4>
                                            @if (!empty($offers->foto_bersama))
                                            <img alt="fotobersama" class="rounded img-services mt-3" src="/storage/{{ $offers->foto_bersama }}">
                                            @endif
                                        </div>
                                        <div class="p-5">
                                            {!! $offers->penawaran !!}
                                        </div>
                                        @endif
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
{{-- TinyMCE --}}
<script src="{{ asset('templates') }}/vendor/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
{{-- script untuk seluruh tombol hapus  --}}
<script>
    btnDelete = document.querySelectorAll('#btnDelete');
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
{{-- script untuk textarea form penawaran --}}
<script>
    tinymce.init({
        selector: 'textarea#penawaran',
        plugins: [
            'lists', 'wordcount'
        ],
        menubar: 'edit insert format',
        toolbar: 'bullist numlist',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
    });
</script>
{{-- script untuk tooltip icon help info --}}
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

<!-- script untuk menonaktifkan jam operasinya -->
<script>
    // Mendapatkan semua elemen switch dan input waktu
    var switches = document.querySelectorAll("input[type='checkbox'][role='switch']");
    var timeInputs = document.querySelectorAll("input[type='time']");

    // Menambahkan event listener ke setiap switch
    switches.forEach(function(switchElement) {
        switchElement.addEventListener("change", function() {
            // Mendapatkan elemen teks status terkait
            var switchText = this.closest(".row").querySelector(".switch-text");

            // Mendapatkan input waktu terkait
            var parentRow = this.closest(".row");
            var inputs = parentRow.querySelectorAll("input[type='time']");

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
            } else {
                // Menonaktifkan input waktu terkait
                inputs.forEach(function(input) {
                    input.disabled = true;
                });

                // Mengubah teks status menjadi "Tutup"
                switchText.textContent = "Tutup";
                // Mengubah warna teks menjadi merah
                switchText.style.color = "red";
            }
        });

        // Mengatur status awal menjadi "Tutup"
        switchElement.checked = false;

        // Mendapatkan elemen teks status terkait
        var switchText = switchElement.closest(".row").querySelector(".switch-text");

        // Menonaktifkan input waktu terkait
        var parentRow = switchElement.closest(".row");
        var inputs = parentRow.querySelectorAll("input[type='time']");
        inputs.forEach(function(input) {
            input.disabled = true;
        });

        // Mengubah teks status menjadi "Tutup"
        switchText.textContent = "Tutup";
        // Mengubah warna teks menjadi merah
        switchText.style.color = "red";
    });
</script>

<!-- script tambah jam operasional -->
@endpush
