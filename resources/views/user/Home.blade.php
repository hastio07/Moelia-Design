@extends('user.layouts.UserScreen')
@section('title', 'Home')

@push('styles')
    <link href="{{ asset('templates') }}/assets/css-modif/user/UserHome.css" rel="stylesheet">
    <!-- Swiper CSS -->
    <link href="{{ asset('templates') }}/assets/css/swiper-bundle.min.css" rel="stylesheet">
    <!-- CSS swiper card -->
@endpush

@section('konten')
    <section>

        <!-- bagian carousel -->
        <div class="carousel-home">
            <div class="carousel slide" data-bs-ride="false" id="carouselExampleCaptions">
                <div class="carousel-indicators">
                    <button aria-current="true" aria-label="Slide 1" class="active" data-bs-slide-to="0" data-bs-target="#carouselExampleCaptions" type="button"></button>
                    <button aria-label="Slide 2" data-bs-slide-to="1" data-bs-target="#carouselExampleCaptions" type="button"></button>
                    <button aria-label="Slide 3" data-bs-slide-to="2" data-bs-target="#carouselExampleCaptions" type="button"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-aos="fade-up">
                        <img alt="{{ $galleries[0]->photo_name ?? null }}" class="d-block w-100 h-100 image-carausel" src="/storage/{{ $galleries[0]->photo_path ?? '#' }}">
                        <div class="carousel-caption">
                            <h5 class="caption-text">{{ $companies->nama_perusahaan ?? null }}</h5>
                            <h4>Wedding Organizer</h4>
                            <p>Bersama Kami mewujudkan impian pernikahan anda</p>
                            <a class="btn btn fw-bold mt-3 px-5" href="/aboutus">About Us <i class="bi bi-box-arrow-up-right ms-2"></i></a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img alt="{{ $galleries[1]->photo_name ?? null }}" class="d-block w-100 h-100 image-carausel" src="/storage/{{ $galleries[1]->photo_path ?? '#' }}">
                        <div class="carousel-caption">
                            <h5>{{ $companies->nama_perusahaan ?? null }}</h5>
                            <h4>Wedding Organizer</h4>
                            <p>Bersama Kami mewujudkan impian pernikahan anda</p>
                            <a class="btn btn fw-bold mt-3 px-5" href="/aboutus">About Us <i class="bi bi-box-arrow-up-right ms-2"></i></a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img alt="{{ $galleries[2]->photo_name ?? null }}" class="d-block w-100 h-100 image-carausel" src="/storage/{{ $galleries[2]->photo_path ?? '#' }}">
                        <div class="carousel-caption">
                            <h5>{{ $companies->nama_perusahaan ?? null }}</h5>
                            <h4>Wedding Organizer</h4>
                            <p>Bersama Kami mewujudkan impian pernikahan anda</p>
                            <a class="btn btn fw-bold mt-3 px-5" href="/aboutus">About Us <i class="bi bi-box-arrow-up-right ms-2"></i></a>
                        </div>
                    </div>
                    <button class="carousel-control-prev" data-bs-slide="prev" data-bs-target="#carouselExampleCaptions" type="button">
                        <span aria-hidden="true" class="carousel-control-prev-icon"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" data-bs-slide="next" data-bs-target="#carouselExampleCaptions" type="button">
                        <span aria-hidden="true" class="carousel-control-next-icon"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <!-- konten 2 bigrafi-->
            <div class="second-konten container">
                <div class="row same-height">
                    <div class="col-lg-8 col-md-12 order-sm-2 order-lg-1 mt-4">
                        <div class="card h-100 mb-5 bg-white text-center">
                            <div class="card-body">
                                <h5 class="card-title card-perusahaan">Moelia Design</h5>
                                @if (!empty($abouts) && ($abouts->judul || $abouts->katasambutan))
                                    <h6 class="card-subtitle mb-4">{{ $abouts->judul }}</h6>
                                    <p class="card-text text-muted" style="text-align: justify; text-indent: 30px;">{{ $abouts->katasambutan }} </p>
                                @else
                                    <p class="fw-bold text-secondary mt-5"><i class="bi bi-exclamation-triangle-fill fs-3 text-warning"></i><br>Data Kosong</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 order-sm-1 order-lg-2 mt-4">
                        <div class="card h-100 image-konten-dua cover-img-dua border border-0 bg-transparent">
                            @if (!empty($abouts) && $abouts->fotobersama)
                                <img alt="fotobersama" class="image-konten-dua" src="{{ asset('storage') }}/{{ $abouts->fotobersama }}">
                            @else
                                <img alt="fotobersama" class="image-konten-dua my-5" src="{{ asset('templates') }}/assets/images/data-kosong.jpg">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- akhir konten 2 -->

            <!-- konten 3 layanan-->
            <!-- link download gambar https://www.flaticon.com/ -->
            <h5 class="card-perusahaan text-center">Moelia Design</h5>
            <h6 class="card-subtitle text-center">Layanan Yang Kami Sediakan</h6>
            <div class="slide-container swiper">
                <div class="slide-content" data-aos="fade-up">
                    <div class="card-wrapper swiper-wrapper my-5">
                        @if ($services->isEmpty())
                            <div class="d-flex justify-content-center align-items-center container" style="height: 10vh;">
                                <div class="text-center">
                                    <i class="bi bi-exclamation-triangle-fill fs-3 text-warning"></i>
                                    <h6 class="fw-bold text-secondary">Maaf!!<br>Saat Ini Layanan Belum Tersedia</h6>
                                </div>
                            </div>
                        @else
                            @foreach ($services as $value)
                                <div class="card swiper-slide">
                                    <div class="image-content">
                                        <div class="card-image">
                                            <img alt="{{ $value->tipe_layanan }}" class="card-img" src="/storage/service-images/{{ $value->gambar }}">
                                        </div>
                                    </div>
                                    <div class="card-content">
                                        <h6 class="name fw-bold text-capitalize">{{ $value->tipe_layanan }}</h6>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <br>
            </div>
            <!-- akhir konten 3 -->

            <!-- konten 4 vidio promosi-->
            <div class="row same-height mt-5 mb-5 p-3">
                <div class="col-md-6 align-self-center text-center" data-aos="fade-up">
                    <h5 class="card-title card-perusahaan">Moelia Design</h5>
                    <img alt="" class="image-garis" src="img/gariskonten.png">
                    <h6 class="card-subtitle">
                        sebelum melakukan pemesanan kepada kami alangkah baiknya untuk melihat vidio kami terlebih dahulu.
                    </h6>
                </div>
                <div class="col-md-6" data-aos="fade-down">
                    <div class="embed-responsive embed-responsive-16by9 video-container">
                        @if (!empty($videopromosi->judul) || !empty($videopromosi->link_video))
                            <iframe allowfullscreen class="embed-responsive-item" src="https://www.youtube-nocookie.com/embed/{{ $videopromosi->link_video }}"></iframe>
                        @endif
                    </div>
                </div>
            </div>
            <!-- akhir konten 4 -->

            <!-- konten 5 produk terbaru -->
            <div class="mb-5 pt-5">
                <h5 class="card-perusahaan text-center">Moelia Design</h5>
                <h6 class="card-subtitle text-center">Produk Terbaru Kami</h6>
                <div class="container pb-5">
                    <div class="row justify-content-center mb-3">
                        @if ($products->isEmpty())
                            <div class="d-flex justify-content-center align-items-center container" style="height: 10vh;">
                                <div class="text-center">
                                    <i class="bi bi-exclamation-triangle-fill fs-3 text-warning"></i>
                                    <h6 class="fw-bold text-secondary">Maaf!!<br>Saat Ini Tidak Ada Produk Terbaru</h6>
                                </div>
                            </div>
                        @else
                            @foreach ($products as $value)
                                <div class="col-md-12 col-xl-10">
                                    <div class="card rounded-3 mt-3 border shadow" data-aos="fade-down">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 col-lg-3 col-xl-3 mb-lg-0 mb-4">
                                                    <div class="bg-image hover-zoom ripple ripple-surface rounded">
                                                        <img alt="{{ $value->nama_produk }}" class="w-100" src="/storage/post-images{{ $value->gambar }}">
                                                        <a href={{ route('produk.show', $value->id) }}>
                                                            <div class="hover-overlay">
                                                                <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <h5 class="text-capitalize">{{ Str::words($value->nama_produk, 5) }}</h5>
                                                    <div class="d-flex flex-row">
                                                        <div class="kategori d-flex">
                                                            <i class="bi bi-calendar-event d-flex me-2">
                                                                <p class="ms-1">{{ $value->created_at->format('d/m/y') }}</p>
                                                            </i>
                                                            <i class="bi bi-bookmark-fill ms-2 d-flex">
                                                                <p class="ms-1">{{ Str::words($value->category_products->nama_kategori) }}</p>
                                                            </i>
                                                        </div>
                                                    </div>
                                                    <div class="text-muted small d-flex time mb-0">
                                                        <i class="bi bi-clock-history me-1"></i>
                                                        <p>
                                                            {{ $value->updated_at->diffForHumans() }}
                                                        </p>
                                                    </div>
                                                    <p class="mb-md-0 h-100 mb-4" style="text-align: justify;">
                                                        {!! Str::words($value->deskripsi, 20) !!}.
                                                    </p>
                                                </div>
                                                <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                                    <div class="d-flex text-success harga">
                                                        <i class="bi bi-tags-fill me-1"></i>
                                                        <h6 class="fw-bold">Harga Sewa</h6>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-1 flex-row">
                                                        <h5 class="me-1 mb-1">{{ $value->formatRupiah('harga_sewa') }}</h5>
                                                    </div>
                                                    <div class="d-flex flex-column mt-4">
                                                        <a class="btn btn-primary btn-sm button-product" href={{ route('produk.show', $value->id) }}>Selengkapnya</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <!-- akhir konten 5 -->

            <!-- konten 6 gallery -->
            <div data-aos="fade-down">
                <h5 class="card-perusahaan text-center">Moelia Design</h5>
                <h6 class="card-subtitle text-center">Foto Kami</h6>
                <div class="gallery container">
                    @if ($photos->isEmpty())
                        <div class="d-flex justify-content-center align-items-center container" style="height: 10vh;">
                            <div class="text-center">
                                <i class="bi bi-exclamation-triangle-fill fs-3 text-warning"></i>
                                <h6 class="fw-bold text-secondary">Maaf!!<br>Saat Ini Tidak Ada Foto Terbaru</h6>
                            </div>
                        </div>
                    @else
                        @foreach ($photos as $value)
                            <div class="d-flex justify-content-center align-items-center">
                                <a data-gallery="photo-gallery" data-toggle="lightbox" href="/storage/{{ $value->photo_path }}">
                                    <img class="img-fluid item" height="600" src="/storage/{{ $value->photo_path }}" width="600">
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <!-- akhir konten 6 gallery -->

    </section>
@endsection

@push('scripts')
    <script src="{{ asset('templates') }}/assets/js/page/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".slide-content", {
            slidesPerView: 3,
            spaceBetween: 25,
            loop: true,
            centerSlide: 'true',
            fade: 'true',
            grabCursor: 'true',
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true,
            },

            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                520: {
                    slidesPerView: 2,
                },
                950: {
                    slidesPerView: 3,
                },
            },
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
@endpush
