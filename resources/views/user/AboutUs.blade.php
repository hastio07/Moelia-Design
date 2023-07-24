@extends('user.layouts.UserScreen')
@section('title', 'About Us')

@push('styles')
    <link href="{{ asset('templates') }}/assets/css-modif/user/UserAboutUs.css" rel="stylesheet">
@endpush

@section('konten')
    <section style="padding-top:100px";>
        <!-- konten apa yang didapatkan?-->
        <div class="second-contents container" data-aos="fade-down">
            <div class="row same-height mt-3 p-3">
                <div class="col-md-7 align-self-center text-center">
                    <div class="card h-100 shadow-0 border border-0 bg-transparent">
                        @if (!empty($offers) && $offers->foto_bersama)
                            <img alt="foto_bersama" class="left-image" src="/storage/{{ $offers->foto_bersama }}">
                        @else
                            <img class="left-image mt-5" src="{{ asset('templates') }}/assets/images/data-kosong.jpg">
                        @endif
                    </div>
                </div>
                <div class="col-md-5" data-aos="fade-down">
                    <h5 class="text-center">Moelia Design</h5>
                    <div class="line"></div><br>
                    <h4 class="card-subtitle fw-bold my-2 text-center">
                        Apa saja yang akan anda dapatkan dari kami?
                    </h4>
                    @if (!empty($offers) && $offers->penawaran)
                        <p> {!! $offers->penawaran !!}</p>
                    @else
                        <div class="mt-5 text-center">
                            <i class="bi bi-exclamation-triangle-fill fs-3 text-warning"></i>
                            <p class="fw-bold text-secondary">Maaf!!<br>Saat ini penawaran belum tersedia</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
        <!-- end konten -->

        <!-- konten our team-->
        <div class="third-content mt-5 pt-4">
            <h3 class="head-ourt fw-bold text-center">Our Team</h3>
            <div class="line"></div>
            <div class="container-fluid container-team mt-3 py-5">
                <div class="container">
                    <div class="row g-5 align-items-center" data-aos="fade-down">
                        <div class="col-md-6">
                            @if (!empty($owners->foto_owner))
                                <img alt="{{ $owners->nama_owner }}" class="img-fluid w-100 rounded" src="/storage/{{ $owners->foto_owner }}">
                            @endif
                        </div>
                        <div class="col-md-6 text-center">
                            @if (!empty($owners->nama_owner))
                                <h4 class="fw-bold mb-3">{{ $owners->nama_owner }}</h4>
                                <p class="mb-1">CEO & Founder</p>
                            @endif
                            @if (!empty($owners->kata_sambutan))
                                <p class="mb-4 mt-3">{{ $owners->kata_sambutan }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="employes container my-3">
                    <div class="row">
                        @if ($employe->isEmpty())
                            <div class="d-flex justify-content-center align-items-center container" style="height: 10vh;">
                                <div class="text-center">
                                    <i class="bi bi-exclamation-triangle-fill fs-3 text-warning"></i>
                                    <h6 class="fw-bold text-secondary">Maaf!!<br>Pegawai Belum Diinputkan!</h6>
                                </div>
                            </div>
                        @else
                            @foreach ($employe as $employe)
                                <div class="col-lg-3 col-md-6 col-sm-6 mt-3">
                                    <div class="card card-pegawai h-100">
                                        <div class="p-2">
                                            <img alt="{{ $employe->foto }}" class="card-img-top rounded-3" src="/storage/employee-images{{ $employe->foto }}">
                                        </div>
                                        <div class="card-body text-center">
                                            <h5 class="card-title">{{ $employe->nama }}</h5>
                                            <p class="card-text">{{ $employe->categoryjabatan->nama_jabatan }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- end konten -->

        {{-- konten visi & misi --}}
        @if (!empty($visi_misis) && ($visi_misis->visi || $visi_misis->misi))
        <div class="container" data-aos="fade-down">
            <div class="row same-height mt-3 p-3 border">
                <div class="col-md-7 text-center">
                    <div class="card h-100 shadow-0 border border-0 bg-transparent">
                        <h4 class="card-subtitle fw-bold my-2 text-center">
                            Visi
                        </h4>
                        {!! $visi_misis->visi ?? '<p class="text-center bg-danger rounded p-3 border text-white fw-bold">Harap Isi <a class="text-info text-decoration-underline" href="/manage-perusahaan"> Visi !!</a></p>' !!}
                    </div>
                </div>
                <div class="col-md-5" data-aos="fade-down">
                    <h4 class="card-subtitle fw-bold my-2 text-center">
                        Misi
                    </h4>
                    {!! $visi_misis->misi ?? '<p class="text-center bg-danger rounded p-3 border text-white fw-bold">Harap Isi <a class="text-info text-decoration-underline" href="/manage-perusahaan"> Misi !!</a></p>' !!}
                </div>
            </div>
        </div>
        @endif
        {{-- end konten --}}

        <!-- konten google maps-->
        <div class="four-content container mb-5 mt-5" data-aos="fade-down">
            <div class="content">
                <div class="left-side text-center">
                    <div class="p-3">
                        <i class="bi bi-geo-alt-fill fs-2"></i>
                        <h6 class="fw-bold">Alamat</h6>
                        @if (!empty($addresses) && $addresses->alamat_perusahaan)
                            <div class="alamat">{{ $addresses->alamat_perusahaan }}</div>
                        @else
                            <p class="text-secondary"><i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>Alamat Belum Tesedia</p>
                        @endif
                    </div>
                </div>
                <div class="right-side">
                    @if (!empty($addresses) && $addresses->link_gmap)
                        <div class="embed-responsive embed-responsive-16by9 location-container">
                            {!! $addresses->link_gmap !!}
                        </div>
                    @else
                        <div class="d-flex justify-content-center align-items-center container" style="height: 10vh;">
                            <div class="text-center">
                                <div class="container">
                                    <img alt="Phone image" class="mt-5" src="{{ asset('templates') }}/assets/images/route-notfound.png" style="max-width: 100px; max-height: 100px;">
                                </div>
                                <h6 class="fw-bold text-secondary mt-2">Maaf!!<br>Maps Belum Tersedia</h6>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- end konten -->

        {{-- content sertifikat legalitas --}}
        @if (!empty($certificates) && ($certificates->foto_sertifikat || $certificates->pengantar))
            <div class="container mt-3 rounded border">
                <div class="row">
                    <div class="col-md-4 d-flex justify-content-center align-items-center container">
                        @if (!empty($certificates) && $certificates->foto_sertifikat)
                            <img alt="foto_sertifikat" class="image-fluid" src="/storage/{{ $certificates->foto_sertifikat }}" style="max-width: 90%; max-height: 90%;">
                        @else
                            <p class="bg-danger fw-bold rounded border p-3 text-center text-white">Harap Upload <a class="text-info text-decoration-underline" href="/manage-perusahaan"> Foto Sertifikat !!</a> !!</p>
                        @endif
                    </div>
                    <div class="col-md-8 p-3">
                        <h4 class="head-ourt fw-bold text-center">Sertifikat/Piagam Kami</h4>
                        <div class="line"></div>
                        <div class="mt-3">
                            <p> {!! $certificates->pengantar ?? '<p class="text-center bg-danger rounded p-3 border text-white fw-bold">Harap Isi Penjelasan <a class="text-info text-decoration-underline" href="/manage-perusahaan"> Terkait Sertifikat !!</a></p>' !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{-- end content --}}

        <!-- content jam operasional -->
        <div class="back-bg hours container mb-5 mt-5">
            <div class="row">
                <div class="col-sm-4"><img alt="Phone image" class="img-fluid" src="{{ asset('templates') }}/assets/images/time.jpg"></div>
                <div class="col-sm-8">
                    <div class="business-hours" data-aos="fade-down">
                        <h2 class="title fw-bold">Jam Operasional</h2>
                        @foreach ($workinghour as $workinghour)
                            <div class="row fw-bold">
                                <div class="col col-lg-2">
                                    {{ $workinghour->day }}
                                </div>
                                <div class="col col-lg-10">
                                    @if ($workinghour->status == 1)
                                        {{ $workinghour->time_from_format }} - {{ $workinghour->time_to_format }}
                                    @else
                                        Closed
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- end konten -->

        <!-- content contact us -->
        <div class="contactUs container py-3 text-center">
            <h4 class="fw-bold">Contact Us</h4>
            <div class="line"></div>
            <div class="row mt-3" data-aos="fade-down">
                <div class="col-md-4 mt-3">
                    <div class="h-100 contact-wraper p-3">
                        <i class="bi bi-telephone-plus-fill fs-2" style="color: #00abe9;"></i>
                        <h6 class="fw-bold">Telephone</h6>
                        <div class="d-flex justify-content-center mt-3">
                            <div class="text-start">
                                @if (!empty($contacts))
                                    @php
                                        $data_contact_whatsapp = [['name' => $contacts->telephone1_name, 'number' => $contacts->telephone1_number], ['name' => $contacts->telephone2_name, 'number' => $contacts->telephone2_number]];
                                    @endphp
                                    @foreach ($data_contact_whatsapp as $contact)
                                        @if ($contact['name'] || $contact['number'])
                                            <p class="text-capitalize m-0">{{ $contact['number'] ?? null }} ({{ $contact['name'] ?? null }})</p>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="h-100 contact-wraper p-3 text-center">
                        <i class="bi bi-whatsapp fs-2" style="color: #25d366;"></i>
                        <h6 class="fw-bold">Whatsapp</h6>
                        <div class="d-flex justify-content-center mt-3">
                            <div class="text-start">
                                @if (!empty($contacts))
                                    @php
                                        $data_contact_whatsapp = [['name' => $contacts->whatsapp1_name, 'number' => $contacts->whatsapp1_number], ['name' => $contacts->whatsapp2_name, 'number' => $contacts->whatsapp2_number], ['name' => $contacts->whatsapp3_name, 'number' => $contacts->whatsapp3_number], ['name' => $contacts->whatsapp4_name, 'number' => $contacts->whatsapp4_number]];
                                    @endphp
                                    @foreach ($data_contact_whatsapp as $contact)
                                        @if ($contact['name'] || $contact['number'])
                                            <p class="text-capitalize m-0">{{ $contact['number'] ?? null }} ({{ $contact['name'] ?? null }})</p>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="h-100 contact-wraper p-3 text-center">
                        <i class="bi bi-envelope fs-2" style="color: #f84437;"></i>
                        <h6 class="fw-bold">Email</h6>
                        @if (!empty($contacts) && $contacts->email)
                            <div class="text-one">{{ $contacts->email }}</div>
                        @else
                            <p class="text-secondary"><i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>Kontak EMail Belum Tesedia</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
        <!-- endcontent -->

        <!-- content follow social media -->
        <div class="socmed text-capitalize container p-5 text-center">
            <h4 class="fw-bold">Follow Us On Social Media</h4>
            <p>untuk mendapatkan informasi lebih banayak ikuti sosial media kami</p>
            <div class="row justify-content-center text-white" data-aos="fade-up">
                @foreach ($sosmed as $sosmed)
                    <div class="d-flex justify-content-center col-auto mt-3">
                        <a href="{{ $sosmed->l_instagram }}">
                            <div class="rounded-circle icon-wrapper instagram shadow">
                                <i class="bi bi-instagram fs-4"></i>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-center col-auto mt-3">
                        <a href="{{ $sosmed->l_facebook }}">
                            <div class="rounded-circle icon-wrapper shadow" style="background-color: #3b5998;">
                                <i class="bi bi-facebook fs-4"></i>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-center col-auto mt-3">
                        <a href="{{ $sosmed->l_twitter }}">
                            <div class="rounded-circle icon-wrapper shadow" style="background-color:#55acee;">
                                <i class="bi bi-twitter fs-4"></i>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-center col-auto mt-3">
                        <a href="{{ $sosmed->l_tiktok }}">
                            <div class="rounded-circle icon-wrapper bg-dark shadow">
                                <i class="bi bi-tiktok fs-4"></i>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-center col-auto mt-3">
                        <a href="{{ $sosmed->l_youtube }}">
                            <div class="rounded-circle icon-wrapper p-3 shadow" style="background-color: #cd201f;">
                                <i class="bi bi-youtube fs-2"></i>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- end content -->
    </section>
    @push('scripts')
        <script>
            function revealCards() {
                const cards = document.querySelectorAll('.card');
                cards.forEach((card, index) => {
                    const cardPosition = card.getBoundingClientRect().top;
                    const windowHeight = window.innerHeight;
                    if (cardPosition < windowHeight) {
                        setTimeout(() => {
                            card.classList.add('visible');
                        }, index * 500);
                    }
                });
            }

            function handleScroll() {
                revealCards();
            }

            window.addEventListener('scroll', handleScroll);
            window.addEventListener('DOMContentLoaded', revealCards);
        </script>
    @endpush

@endsection
