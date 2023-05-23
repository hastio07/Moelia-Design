@extends('dashboard.user.layouts.UserScreen')
@section('title', 'About Us')

@push('styles')
<link href="{{ asset('templates') }}/assets/css-modif/AboutUs.css" rel="stylesheet">
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
                    <img alt="foto_bersama" class="left-image" src="/storage/{{ $offers->foto_bersama }}">
                </div>
            </div>
            <div class="col-md-5" data-aos="fade-down">
                <h5 class="text-center">Moelia Design</h5>
                <div class="line"></div><br>
                <h6 class="card-subtitle">
                    Apa saja yang akan anda dapatkan dari kami?
                </h6>
                {!! $offers->penawaran !!}
            </div>
        </div>
    </div>
    <!-- end konten -->

    <!-- konten3 -->
    <div class="third-content mt-5">
        <h1 class="text-center head-ourt fw-bold">Our Team</h1>
        <div class="line"></div>
        <div class="owner-profile">
            <div class="card">
                <div class="imgBX">
                    @if (!empty($owners->foto_owner))
                    <img alt="{{ $owners->nama_owner }}" class="rounded img-owner" src="/storage/{{ $owners->foto_owner }}">
                    @endif
                </div>
                <div class="content">
                    <div class="details">
                        <h2 class="mb-5">{{ $owners->nama_owner }}<br><span>owner</span></h2>
                        <div class="data">
                            <p>{{ $owners->kata_sambutan }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="body-ourt mt-5">
        <div class="our-team">
            <div class="div card">
                <div class="imgOT">
                    <img alt="" src="img/cover-1.jpg">
                </div>
                <div class="content-ourt">
                    <h2>sayid mufaqih</h2>
                    <p>Marketing</p>
                </div>
            </div>
            <div class="div card">
                <div class="imgOT">
                    <img alt="" src="img/cover-1.jpg">
                </div>
                <div class="content-ourt">
                    <h2>sayid mufaqih</h2>
                    <p>Marketing</p>
                </div>
            </div>
            <div class="div card">
                <div class="imgOT">
                    <img alt="" src="img/cover-1.jpg">
                </div>
                <div class="content-ourt">
                    <h2>sayid mufaqih</h2>
                    <p>dekorasi</p>
                </div>
            </div>
            <div class="div card">
                <div class="imgOT">
                    <img alt="" src="img/cover-1.jpg">
                </div>
                <div class="content-ourt">
                    <h2>sayid mufaqih</h2>
                    <p>make up</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end konten -->

    <!-- konten 5 -->
    <div class="container four-content mb-5" data-aos="fade-down">
        <div class="content">
            <div class="left-side">
                <div class="address details">
                    <i class="bi bi-geo-alt-fill"></i>
                    <div class="topic">Alamat</div>
                    <div class="text-one">{{ $addresses->alamat_perusahaan }}</div>
                </div>
                @if (!empty($contacts->telephone))
                <div class="phone details">
                    <i class="bi bi-whatsapp"></i>
                    <div class="topic">Whatsapp</div>
                    <div class="text-one">{{$contacts->telephone}}</div>
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
</section>

@endsection