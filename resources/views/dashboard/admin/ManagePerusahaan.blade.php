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
                                            <div class="container border mt-3 shadow p-3 mb-5 bg-body rounded">
                                                <h5 class="text-center">
                                                    Logo & Nama Perusahaan
                                                </h5>
                                                <form action="{{ route('manage-perusahaan.updateorcreatecompany') }}" class="formstyle" enctype="multipart/form-data" id="formCompany" method="POST">
                                                    <div class="flex-item form">
                                                        @csrf
                                                        <input name="id_perusahaan" type="hidden" value="{{ $companies->id ?? null }}">
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
                                            <div class="container border mt-3 shadow p-3 mb-5 bg-body rounded">
                                                <div class="flex-item label">Alamat Perusahaan</div>
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
                                            <div class="container border mt-3 shadow p-3 mb-5 bg-body rounded">
                                                <h5 class="text-center">
                                                    Kontak
                                                </h5>
                                                <form action="{{ route('manage-perusahaan.updateorcreatecontact') }}" class="formstyle" enctype="multipart/form-data" id="formContact" method="POST">
                                                    <div class="flex-item form">
                                                        @csrf
                                                        <input name="id_contact" type="hidden" value="{{ $contacts->id ?? null }}">
                                                        <label class="form-label" for="telephone">Telephone</label>
                                                        <input class="form-control" id="telephone" name="telephone" placeholder="Masukkan nomor telephone" type="text" value="{{ $contacts->telephone ?? null }}">
                                                        <label class="form-label" for="whatsapp">Whatsapp</label>
                                                        <input class="form-control" id="whatsapp" name="whatsapp" placeholder="Masukkan nomor whatsapp" type="text" value="{{ $contacts->whatsapp ?? null }}">
                                                        <label class="form-label" for="email">Email</label>
                                                        <input class="form-control" id="email" name="email" placeholder="Masukkan email" type="email" value="{{ $contacts->email ?? null }}">
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
                                            <div class="container border mt-3 shadow p-3 mb-5 bg-body rounded">
                                                <h5 class="text-center">
                                                    Social Media
                                                </h5>
                                                <form action="{{ route('manage-perusahaan.updateorcreatesosmed') }}" class="formstyle" enctype="multipart/form-data" id="formSosmed" method="POST">
                                                    <div class="flex-item form">
                                                        @csrf
                                                        <input name="id_sosmed" type="hidden" value="{{ $sosmeds->id ?? null }}">
                                                        <label class="form-label mt-2" for="instagram">Instagram</label>
                                                        <input class="form-control" id="instagram" name="u_instagram" placeholder="Masukkan username instagram" type="text" value="{{ $sosmeds->u_instagram ?? null }}">
                                                        <input class="form-control mt-1" id="l_instagram" name="l_instagram" placeholder="Masukkan link instagram" type="text" value="{{ $sosmeds->l_instagram ?? null }}">
                                                        <label class="form-label mt-2" for="facebook">Facebook</label>
                                                        <input class="form-control" id="facebook" name="u_facebook" placeholder="Masukkan username facebook" type="text" value="{{ $sosmeds->u_facebook ?? null }}">
                                                        <input class="form-control mt-1" id="l_facebook" name="l_facebook" placeholder="Masukkan link Facebook" type="text" value="{{ $sosmeds->l_facebook ?? null }}">
                                                        <label class="form-label mt-2" for="twitter">Twitter</label>
                                                        <input class="form-control" id="twitter" name="u_twitter" placeholder="Masukkan username twitter" type="text" value="{{ $sosmeds->u_twitter ?? null }}">
                                                        <input class="form-control mt-1" id="l_twitter" name="l_twitter" placeholder="Masukkan link twitter" type="text" value="{{ $sosmeds->l_twitter ?? null }}">
                                                        <label class="form-label mt-2" for="youtube">Youtube</label>
                                                        <input class="form-control" id="youtube" name="u_youtube" placeholder="Masukkan link channel youtube" type="text" value="{{ $sosmeds->u_youtube ?? null }}">
                                                        <input class="form-control mt-1" id="l_youtube" name="l_youtube" placeholder="Masukkan link youtube" type="text" value="{{ $sosmeds->l_youtube ?? null }}">
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
                                                </form>
                                            </div>
                                            <div class="container border mt-3 shadow p-3 mb-5 bg-body rounded">
                                                <h5 class="text-center">
                                                    Siapa Kami?
                                                </h5>
                                                <form action="{{ route('manage-perusahaan.updateorcreateabout') }}" class="formstyle" enctype="multipart/form-data" id="formAbout" method="POST">
                                                    @csrf
                                                    <input name="id_about" type="hidden" value="{{ $abouts->id ?? null }}">
                                                    <input name="oldfotobersama" type="hidden" value="{{ $abouts->fotobersama ?? null }}">
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
                                            <div class="container border mt-3 shadow p-3 mb-5 bg-body rounded">
                                                <h5 class="text-center">
                                                    Apa Saja Yang Didapatkan?
                                                </h5>
                                                <form action="{{ route('manage-perusahaan.updateorcreateoffer') }}" class="formstyle" enctype="multipart/form-data" id="formOffer" method="POST">
                                                    @csrf
                                                    <input name="id_offer" type="hidden" value="{{ $offers->id ?? null }}">
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
                                            <h4 class="card-title text-center">Alamat, Kontak & Sosial Media Perusahaan</h4>
                                            <div class="d-flex mt-3">
                                                <i class="fa-sharp fa-solid fa-map-location-dot fa-2xl"></i>
                                                <p>{{ $addresses->alamat_perusahaan ?? null }}</p>
                                            </div>
                                            <div class="d-flex mt-3">
                                                <i class="fa-solid fa-phone-volume fa-2xl"></i>
                                                <p>{{ $contacts->telephone ?? null }}</p>
                                            </div>
                                            <div class="d-flex mt-3">
                                                <i class="fa-brands fa-whatsapp fa-2xl"></i>
                                                <p>{{ $contacts->whatsapp ?? null }}</p>
                                            </div>
                                            <div class="d-flex mt-3"> <i class="fa-brands fa-instagram fa-2xl"></i>
                                                <p>{{ $sosmeds->u_instagram ?? null }}</p>
                                            </div>
                                            <div class="d-flex mt-3">
                                                <i class="fa-brands fa-facebook fa-2xl"></i>
                                                <p>{{ $sosmeds->u_facebook ?? null }}</p>
                                            </div>
                                            <div class="d-flex mt-3">
                                                <i class="fa-brands fa-twitter fa-2xl"></i>
                                                <p>{{ $sosmeds->u_twitter ?? null }}</p>
                                            </div>
                                            <div class="d-flex mt-3">
                                                <i class="fa-brands fa-youtube fa-2xl"></i>
                                                <p>{{ $sosmeds->u_youtube ?? null }}</p>
                                            </div>
                                        </div>
                                        <div class="left border text-center bg-white shadow p-3 mb-5 bg-body rounded">
                                            {{-- perhatikan tanda (!) pembalik logika --}}
                                            {{-- empty aslinya menghasilkan nilai false jika sebuah variabel telah diisi, dan bernilai true jika variabel tersebut belum diisi.  --}}
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
                                                        <img alt="fotobersama" class="rounded img-owner" src="/storage/{{ $offers->foto_bersama }}">
                                                    @endif
                                                </div>
                                                <div class="p-2">
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
