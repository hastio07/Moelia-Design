@extends('dashboard.admin.layouts.layouts')
@section('title', 'Manage Perusahaan')

@push('head-scripts')
    <script src="{{ asset('templates') }}/vendor/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
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
                                    <div class="col-md-8">
                                        <div class="wrapper-list">
                                            <div class="flex-header text-center border">
                                                <h5 class="fw-bold">Manage Perusahaan</h5>
                                            </div>
                                            <div class="container border mt-3 shadow p-3 mb-5 bg-body rounded">
                                                <h5 class="text-center">
                                                    Foto & Nama Owner
                                                </h5>
                                                <form action="{{ route('manage-perusahaan.updateorcreateowner') }}" class="formstyle" enctype="multipart/form-data" id="formOwner" method="POST">
                                                    <div class="flex-item form">
                                                        @csrf
                                                        <input name="id_owner" type="hidden" value="{{ $owners->id ?? '' }}">
                                                        <input name="oldfoto_owner" type="hidden" value="{{ $owners->foto_owner ?? '' }}">
                                                        <label class="form-label" for="nama_owner">Nama Owner</label>
                                                        <input class="form-control" id="nama_owner" name="nama_owner" placeholder="Masukkan nama owner" type="text" value="{{ $owners->nama_owner ?? '' }}">
                                                        <label class="form-label" for="kata_sambutan">Kata Sambutan</label>
                                                        <textarea class="form-control" id="kata_sambutan" name="kata_sambutan" rows="3">{{ $abouts->kata_sambutan }}</textarea>
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
                                            <div class="container border mt-3 shadow p-3 mb-5 bg-body rounded">
                                                <h5 class="text-center">
                                                    Logo & Nama Perusahaan
                                                </h5>
                                                <form action="{{ route('manage-perusahaan.updateorcreatecompany') }}" class="formstyle" enctype="multipart/form-data" id="formCompany" method="POST">
                                                    <div class="flex-item form">
                                                        @csrf
                                                        <input name="id_perusahaan" type="hidden" value="{{ $companies->id ?? '' }}">
                                                        <input name="oldlogo_perusahaan" type="hidden" value="{{ $companies->logo_perusahaan ?? '' }}">
                                                        <label class="form-label" for="nama_perusahaan">Nama Perusahaan</label>
                                                        <input class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Masukkan nama perusahaan" type="text" value="{{ old('username', $companies->nama_perusahaan ?? '') }}">
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
                                            <div class="container border mt-3 shadow p-3 mb-5 bg-body rounded">
                                                <div class="flex-item label">Alamat Perusahaan</div>
                                                <form action="{{ route('manage-perusahaan.updateorcreateaddress') }}" class="formstyle" enctype="multipart/form-data" id="formAlamat" method="POST">
                                                    <div class="flex-item form">
                                                        @csrf
                                                        <label class="form-label" for="telephone_1">Alamat</label>
                                                        <input name="id_alamat" type="hidden" value="{{ $addresses->id ?? '' }}">
                                                        <input class="form-control" id="alamat_perusahaan" name="alamat_perusahaan" placeholder="Masukkan alamat perusahaan" type="text" value="{{ $addresses->alamat_perusahaan ?? '' }}">
                                                        <label class="form-label" for="link_gmap">Link Google Maps</label>
                                                        <input aria-label="default input example" class="form-control" id="link_gmap" name="link_gmap" placeholder="Link Google Maps" type="text">
                                                    </div>
                                                    <div class="flex-item button">
                                                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                            <button class="btn btn-success" type="submit">Upload</button>
                                                            @if (!empty($addresses) && $addresses->alamat_perusahaan)
                                                                <button class="btn btn-danger" data-bs-route="{{ route('manage-perusahaan.deleteaddress', $addresses->id) }}" id="btnDelete" type="submit">Hapus</i></button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="container border mt-3 shadow p-3 mb-5 bg-body rounded">
                                                <h5 class="text-center">
                                                    Kontak
                                                </h5>
                                                <form action="{{ route('manage-perusahaan.updateorcreatecontact') }}" class="formstyle" enctype="multipart/form-data" id="formContact" method="POST">
                                                    <div class="flex-item form">
                                                        @csrf
                                                        <input name="id_contact" type="hidden" value="{{ $contacts->id ?? '' }}">
                                                        <label class="form-label" for="telephone">Telephone</label>
                                                        <input class="form-control" id="telephone" name="telephone" placeholder="Masukkan nomor telephone" type="text" value="{{ $contacts->telephone_1 ?? '' }}">
                                                        <label class="form-label" for="whatsapp">Whatsapp</label>
                                                        <input class="form-control" id="whatsapp" name="whatsapp" placeholder="Masukkan nomor whatsapp" type="text" value="{{ $contacts->whatsapp_1 ?? '' }}">
                                                        <label class="form-label" for="email">Email</label>
                                                        <input class="form-control" id="email" name="email" placeholder="Masukkan email" type="email" value="{{ $contacts->email ?? '' }}">
                                                    </div>
                                                    <div class="flex-item button">
                                                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                            <button class="btn btn-success" type="submit">Upload</button>
                                                            @if (!empty($contacts) && ($contacts->telephone_1 || $contacts->telephone_2 || $contacts->whatsapp_1 || $contacts->whatsapp_2 || $contacts->email))
                                                                <button class="btn btn-danger" data-bs-route="{{ route('manage-perusahaan.deletecontact', $contacts->id) }}" id="btnDelete" type="submit">Hapus</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="container border mt-3 shadow p-3 mb-5 bg-body rounded">
                                                <h5 class="text-center">
                                                    Social Media
                                                </h5>
                                                <form action="{{ route('manage-perusahaan.updateorcreatesosmed') }}" class="formstyle" enctype="multipart/form-data" id="formSosmed" method="POST">
                                                    <div class="flex-item form">
                                                        @csrf
                                                        <input name="id_sosmed" type="hidden" value="{{ $sosmeds->id ?? '' }}">
                                                        <label class="form-label mt-2" for="instagram">Instagram</label>
                                                        <input class="form-control" id="instagram" name="u_instagram" placeholder="Masukkan username instagram" type="text" value="{{ $sosmeds->instagram ?? '' }}">
                                                        <input class="form-control mt-1" id="instagram" name="l_instagram" placeholder="Masukkan link instagram" type="text" value="">
                                                        <label class="form-label mt-2" for="facebook">Facebook</label>
                                                        <input class="form-control" id="facebook" name="u_facebook" placeholder="Masukkan username facebook" type="text" value="{{ $sosmeds->facebook ?? '' }}">
                                                        <input class="form-control mt-1" id="facebook" name="l_instagram" placeholder="Masukkan link Facebook" type="text" value="">
                                                        <label class="form-label mt-2" for="twitter">Twitter</label>
                                                        <input class="form-control" id="twitter" name="u_twitter" placeholder="Masukkan username twitter" type="text" value="{{ $sosmeds->twitter ?? '' }}">
                                                        <input class="form-control mt-1" id="twitter" name="l_instagram" placeholder="Masukkan link twitter" type="text" value="">
                                                        <label class="form-label mt-2" for="youtube">Youtube</label>
                                                        <input class="form-control" id="youtube" name="u_youtube" placeholder="Masukkan link channel youtube" type="text" value="{{ $sosmeds->youtube ?? '' }}">
                                                        <input class="form-control mt-1" id="instagram" name="l_youtube" placeholder="Masukkan link youtube" type="text" value="">
                                                    </div>
                                                    <div class="flex-item button">
                                                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                            <button class="btn btn-success" type="submit">Upload</i></button>
                                                            @if (!empty($sosmeds) && ($sosmeds->instagram || $sosmeds->facebook || $sosmeds->twitter || $sosmeds->youtube))
                                                                <button class="btn btn-danger" data-bs-route="{{ route('manage-perusahaan.deletesosmed', $sosmeds->id) }}" id="btnDelete" type="submit">Hapus</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="container border mt-3 shadow p-3 mb-5 bg-body rounded">
                                                <h5 class="text-center">
                                                    Siapa Kami?
                                                </h5>
                                                <form action="{{ route('manage-perusahaan.updateorcreateabout') }}" class="formstyle" enctype="multipart/form-data" id="formAbout" method="POST">
                                                    @csrf
                                                    <input name="id_about" type="hidden" value="{{ $abouts->id ?? '' }}">
                                                    <input name="oldfotobersama" type="hidden" value="{{ $abouts->fotobersama ?? '' }}">
                                                    <label class="form-label" for="katasambutan">Kata Sambutan</label>
                                                    <textarea class="form-control" id="katasambutan" name="katasambutan" rows="3">{{ $abouts->katasambutan }}</textarea>
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
                                            <div class="container border mt-3 shadow p-3 mb-5 bg-body rounded">
                                                <h5 class="text-center">
                                                    Apa Saja Yang Didapatkan?
                                                </h5>
                                                <form action="{{ route('manage-perusahaan.updateorcreateoffer') }}" class="formstyle" enctype="multipart/form-data" id="formOffer" method="POST">
                                                    @csrf
                                                    <input name="id_offer" type="hidden" value="{{ $offers->id ?? '' }}">
                                                    <input name="oldfoto_bersama" type="hidden" value="{{ $offers->foto_bersama ?? '' }}">
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
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="left border text-center bg-white shadow p-3 mb-5 bg-body rounded">
                                            <h4>Owner Perusahaan</h4>
                                            @if (!empty($owners))
                                                <div class="text-center">
                                                    @if (!empty($owners->foto_owner))
                                                        <img alt="{{ $owners->nama_owner }}" class="rounded img-owner" src="/storage/{{ $owners->foto_owner }}">
                                                    @endif
                                                </div>
                                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sunt, minus sint eveniet maiores nobis laudantium vel obcaecati aliquam consequuntur amet ab similique fugiat placeat? Ullam, iure ducimus. Eius, id sunt.</p>
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
                                            <h4 class="card-title text-center">Alamat, Kontak & Sosial Media Perusahaan</h4>
                                            <div class="d-flex mt-3">
                                                <i class="fa-sharp fa-solid fa-map-location-dot fa-2xl"></i>
                                                <p>{{ $addresses->alamat_perusahaan ?? '' }}</p>
                                            </div>
                                            <div class="d-flex mt-3">
                                                <i class="fa-solid fa-phone-volume fa-2xl"></i>
                                                <p>{{ $contacts->telephone ?? '' }}</p>
                                            </div>
                                            <div class="d-flex mt-3">
                                                <i class="fa-brands fa-whatsapp fa-2xl"></i>
                                                <p>{{ $contacts->whatsapp ?? '' }}</p>
                                            </div>
                                            <div class="d-flex mt-3"> <i class="fa-brands fa-instagram fa-2xl"></i>
                                                <p>{{ $sosmeds->u_instagram ?? '' }}</p>
                                            </div>
                                            <div class="d-flex mt-3">
                                                <i class="fa-brands fa-facebook fa-2xl"></i>
                                                <p>{{ $sosmeds->u_facebook ?? '' }}</p>
                                            </div>
                                            <div class="d-flex mt-3">
                                                <i class="fa-brands fa-twitter fa-2xl"></i>
                                                <p>{{ $sosmeds->u_twitter ?? '' }}</p>
                                            </div>
                                            <div class="d-flex mt-3">
                                                <i class="fa-brands fa-youtube fa-2xl"></i>
                                                <p>{{ $sosmeds->u_youtube ?? '' }}</p>
                                            </div>
                                        </div>
                                        <div class="left border text-center bg-white shadow p-3 mb-5 bg-body rounded">
                                            <h4 class="card-title text-center">Siapa Kami?</h4>
                                            <img alt="img/cover-2.jpg" class="rounded img-owner" src="">
                                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sunt, minus sint eveniet maiores nobis laudantium vel obcaecati aliquam consequuntur amet ab similique fugiat placeat? Ullam, iure ducimus. Eius, id sunt.</p>
                                        </div>
                                        <div class="left border text-center bg-white shadow p-3 mb-5 bg-body rounded">
                                            <h4 class="card-title text-center">Apa saja yang didapatkan?</h4>
                                            <img alt="img/cover-2.jpg" class="rounded img-owner" src="">
                                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sunt, minus sint eveniet maiores nobis laudantium vel obcaecati aliquam consequuntur amet ab similique fugiat placeat? Ullam, iure ducimus. Eius, id sunt.</p>
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

@push('manageperusahaan-scripts')
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
@endpush
