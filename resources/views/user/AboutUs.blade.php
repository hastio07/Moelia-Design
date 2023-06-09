@extends('user.layouts.UserScreen')
@section('title', 'About Us')

@push('styles')
<link href="{{ asset('templates') }}/assets/css-modif/user/UserAboutUs.css" rel="stylesheet">
@endpush

@section('konten')
<section>
    <!-- konten 1 about us -->
    <div class="first-content text-center align-self-center">
        <h1>Tentang Kami</h1>
        <div class="d-flex justify-content-center">
            {{ Breadcrumbs::render('aboutus') }}
        </div>
    </div>
    <!-- end konten -->

    <!-- konten2 -->
    <div class="div second-contents container">
        <div class="row same-height mt-3 p-3">
            <div class="col-md-7 text-center align-self-center" data-aos="fade-up">
                <div class="card bg-transparent border border-0 h-100" data-aos="flip-up">
                    @if (!empty($offers->foto_bersama))
                    <img alt="foto_bersama" class="left-image" src="/storage/{{ $offers->foto_bersama }}">
                    @endif
                </div>
            </div>
            <div class="col-md-5" data-aos="fade-down">
                <h5 class="text-center">Moelia Design</h5>
                <div class="line"></div><br>
                <h4 class="card-subtitle fw-bold my-3">
                    Apa saja yang akan anda dapatkan dari kami?
                </h4>
                <p class="a">
                    @if (!empty($offers->penawaran))
                    {!! $offers->penawaran !!}
                    @endif
                </p>
            </div>
        </div>
    </div>
    <!-- end konten -->

    <!-- konten3 -->
    <div class="third-content mt-5 shadow pt-4">
        <h1 class="text-center head-ourt fw-bold">Our Team</h1>
        <div class="line"></div>
        <div class="container-fluid container-team py-5 mt-3">
            <div class="container">
                <div class="row g-5 align-items-center" data-aos="fade-down">
                    <div class="col-md-6 wow fadeIn">
                        @if (!empty($owners->foto_owner))
                        <!-- <img alt="{{ $owners->nama_owner }}" class="rounded img-fluid" src="/storage/{{ $owners->foto_owner }}"> -->
                        <img class="img-fluid w-100 rounded" src="/storage/{{ $owners->foto_owner }}" alt="{{ $owners->nama_owner }}">
                        @endif
                    </div>
                    <div class="col-md-6 wow fadeIn">
                        @if (!empty($owners->nama_owner))
                        <h4 class="display-6 mb-3 fw-bold">{{ $owners->nama_owner }}</h4>
                        <p class="mb-1">CEO & Founder</p>
                        @endif
                        @if (!empty($owners->kata_sambutan))
                        <p class="mb-4 mt-3">{{ $owners->kata_sambutan }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="container my-3">
                <div class="row">
                    @if($employe->isEmpty())
                    <div class="container d-flex justify-content-center align-items-center" style="height: 10vh;">
                        <div class="text-center">
                            <h6 class="fw-bold text-secondary">Data Pegawai Belum Diinputkan!</h6>
                        </div>
                    </div>
                    @else
                    @foreach($employe as $employe)
                    <div class="col-lg-3 col-md-6 col-sm-6 mt-3">
                        <div class="card card-pegawai h-100">
                            <div class="p-2">
                                <img src="/storage/employee-images{{ $employe->foto }}" class="card-img-top rounded-3" alt="{{ $employe->foto }}">
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

    <!-- konten 5 -->
    <div class="container four-content mb-5 mt-5" data-aos="fade-down">
        <div class="content">
            <div class="left-side">
                <div class="address details">
                    <i class="bi bi-geo-alt-fill"></i>
                    <div class="topic">Alamat</div>
                    @if (!empty($addresses->alamat_perusahaan))
                    <div class="text-one">{{ $addresses->alamat_perusahaan }}</div>
                    @endif
                </div>
                @if (!empty($contacts->whatsapp))
                <div class="phone details">
                    <i class="bi bi-whatsapp"></i>
                    <div class="topic">Whatsapp</div>
                    <div class="text-one">{{$contacts->whatsapp}}</div>
                </div>
                @endif
                @if (!empty($contacts->email))
                <div class="email details">
                    <i class="fas fa-envelope"></i>
                    <div class="topic">Email</div>
                    <div class="text-one">{{ $contacts->email }}</div>
                </div>
                @endif
            </div>
            <div class="right-side">
                @if (!empty($addresses->link_gmap))
                <div class="embed-responsive embed-responsive-16by9 location-container">
                    {!! $addresses->link_gmap !!}
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- end konten -->

    <!-- content jam operasional -->
    <div class="container back-bg shadow mb-5">
        <div class="row">
            <div class="col-sm-4"><img src="{{ asset('templates') }}/assets/images/time.jpg" class="img-fluid" alt="Phone image"></div>
            <div class="col-sm-8">
                <div class="business-hours" data-aos="fade-down">
                    <h2 class="title fw-bold">Jam Operasional</h2>
                    @foreach($workinghour as $workinghour)
                    <div class="row fw-bold">
                        <div class="col col-lg-2">
                            {{ $workinghour->day }}
                        </div>
                        <div class="col col-lg-10">
                            @if($workinghour-> status == 1)
                            {{$workinghour->time_from_format}} - {{ $workinghour->time_to_format }}

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
    <!-- content follow social media -->
    <div class="container text-center socmed rounded-4 shadow p-5 text-capitalize">
        <h4 class="fw-bold">Follow Us On Social Media</h4>
        <p>untuk mendapatkan informasi lebih banayak ikuti sosial media kami</p>
        <div class="row justify-content-center text-white" data-aos="fade-up">
            @foreach($sosmed as $sosmed)
            <div class="col-auto d-flex justify-content-center mt-3">
                <a href="{{ $sosmed -> l_instagram }}">
                    <div class="p-3 shadow rounded-circle icon-wrapper instagram">
                        <i class="bi bi-instagram fs-2"></i>
                    </div>
                </a>
            </div>
            <div class="col-auto d-flex justify-content-center mt-3">
                <a href="">
                    <div class="p-3 shadow rounded-circle icon-wrapper" style="background-color: #3b5998;">
                        <i class="bi bi-facebook fs-2"></i>
                    </div>
                </a>
            </div>
            <div class="col-auto d-flex justify-content-center mt-3">
                <a href="">
                    <div class="p-3 shadow rounded-circle icon-wrapper" style="background-color:#55acee;">
                        <i class="bi bi-twitter fs-2"></i>
                    </div>
                </a>
            </div>
            <div class="col-auto d-flex justify-content-center mt-3">
                <a href="">
                    <div class="p-3 shadow rounded-circle icon-wrapper bg-dark">
                        <i class="bi bi-tiktok fs-2"></i>
                    </div>
                </a>
            </div>
            <div class="col-auto d-flex justify-content-center mt-3">
                <a href="">
                    <div class="p-3 shadow rounded-circle icon-wrapper" style="background-color: #cd201f;">
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