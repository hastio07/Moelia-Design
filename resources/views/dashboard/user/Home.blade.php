@extends('dashboard.user.layouts.UserScreen')
@section('title', 'Home')

@push('styles')
    <link href="{{ asset('templates') }}/assets/css-modif/Home.css" rel="stylesheet">
    <!-- Swiper CSS -->
    <link href="{{ asset('templates') }}/assets/css/swiper-bundle.min.css" rel="stylesheet">
    <!-- CSS swiper card -->
@endpush

@push('navbar-brand')
    <a class="navbar-brand" href="/">
        <img alt="{{ $companies->nama_perusahaan ?? 'logo' }}" class="d-inline-block align-text-top rounded-circle me-3" src="/storage/{{ $companies->logo_perusahaan ?? '#' }}" width="30">{{ $companies->nama_perusahaan ?? 'Moelia Design' }}
    </a>
@endpush

@section('konten')
    <section>
        <!-- bagian carousel -->
        <div class=" carousel-home">
            <div class="carousel slide" data-bs-ride="false" id="carouselExampleCaptions">
                <div class="carousel-indicators">
                    <button aria-current="true" aria-label="Slide 1" class="active" data-bs-slide-to="0" data-bs-target="#carouselExampleCaptions" type="button"></button>
                    <button aria-label="Slide 2" data-bs-slide-to="1" data-bs-target="#carouselExampleCaptions" type="button"></button>
                    <button aria-label="Slide 3" data-bs-slide-to="2" data-bs-target="#carouselExampleCaptions" type="button"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-aos="fade-up">
                        <img alt="{{ $galleries[0]->photo_name ?? null }}" class="d-block w-100 h-100" src="/storage/{{ $galleries[0]->photo_path ?? '#' }}">
                        <div class="carousel-caption">
                            <h5>Moelia Design</h5>
                            <h4>Wedding Organizer</h4>
                            <p>Bersama Kami mewujudkan impian pernikahan anda</p>
                            <button class="mt-3 px-5 btn btn fw-bold">About Us <i class="bi bi-box-arrow-up-right ms-2"></i></button>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img alt="{{ $galleries[1]->photo_name ?? null }}" class="d-block w-100 h-100" src="/storage/{{ $galleries[1]->photo_path ?? '#' }}">
                        <div class="carousel-caption">
                            <h5>Moelia Design</h5>
                            <h4>Wedding Organizer</h4>
                            <p>Bersama Kami mewujudkan impian pernikahan anda</p>
                            <button class="mt-3 px-5 btn btn fw-bold">About Us<i class="bi bi-box-arrow-up-right ms-2"></i></button>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img alt="{{ $galleries[2]->photo_name ?? null }}" class="d-block w-100 h-100" src="/storage/{{ $galleries[2]->photo_path ?? '#' }}">
                        <div class="carousel-caption">
                            <h5>Moelia Design</h5>
                            <h4>Wedding Organizer</h4>
                            <p>Bersama Kami mewujudkan impian pernikahan anda</p>
                            <button class="mt-3 px-5 btn btn fw-bold">About Us<i class="bi bi-box-arrow-up-right ms-2"></i></button>
                        </div>
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
            <div class="row same-height" data-aos="fade-down-right">
                <div class="col-md-8">
                    <div class="card text-center mb-5 bg-white h-100" data-aos="flip-down">
                        <div class=" card-body">
                            <h5 class="card-title card-perusahaan">Moelia Design</h5>
                            <h6 class="card-subtitle mb-2">Sekarang saatnya anda tidak perlu repot lagi mempersiapkan pernikahan, Anda dapat menikah dengan biaya yang terjangkau</h6>
                            <p class="card-text  text-muted">Perkenalkan kami Mawar wedding service salah satu penyedia jasa pernikahan yang menjadi tempat dimana segala kebutuhan pernikahan calon perngantin tersedia disini. Dari mulai Tim Wedding organizer Bandung yang profesional dan komunikatif, menu catering yang lezat dan beraneka ragam, dekorasi yang elegan dan inovatif, tata rias & busana pengantin yang cantik, tim dokumentasi yang berpengalaman dan kreatif,serta tim hiburan dan upacara adat yang memberi tuntunan sekaligus tontonan semuanya lengkap dalam satu paket pernikahan bandung . Adapun jasa yang kami tawarkan dapat diperoleh secara satuan ataupun keseluruhan ( paket All in ) tergantung kepada kebutuhan calon pengantin. Dengan moto ” nikah ga harus ribet, nikah ga harus mahal”. Kami berupaya membantu klien-klien kami untuk melaksanakan pernikahannya dengan terencana dan tentunya dengan biaya yang terjangkau. </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-transparent border border-0 h-100 image-konten-dua cover-img-dua" data-aos="flip-up">
                        <img alt="" class="image-konten-dua" src=" ">
                    </div>
                </div>
            </div>
        </div>
        <!-- akhir konten 2 -->

        <!-- konten 3 layanan-->
        <!-- link download gambar https://www.flaticon.com/ -->
        <h5 class="text-center card-perusahaan">Moelia Design</h5>
        <h6 class="text-center card-subtitle">Layanan Yang Kami Sediakan</h6>
        <div class="slide-container swiper">
            <div class="slide-content" data-aos="fade-up">
                <div class="card-wrapper swiper-wrapper">
                    <div class="card swiper-slide">
                        <div class="image-content">
                            <div class="card-image">
                                <img alt="wedding" class="card-img" src="img/wedding.png">
                            </div>
                        </div>
                        <div class="card-content">
                            <h6 class="name fw-bold">Rias Pengantin</h6>
                            <p class="description">The lorem text the section that contains header with having open functionality. Lorem dolor sit amet consectetur adipisicing elit.</p>
                            <button class="button">Selengkapnya</button>
                        </div>
                    </div>
                    <div class="card swiper-slide">
                        <div class="image-content">
                            <div class="card-image">
                                <img alt="couple" class="card-img" src="img/couple.png">
                            </div>
                        </div>
                        <div class="card-content">
                            <h6 class="name fw-bold">Rias Make Up</h6>
                            <p class="description">The lorem text the section that contains header with having open functionality. Lorem dolor sit amet consectetur adipisicing elit.</p>
                            <button class="button">Selengkapnya</button>
                        </div>
                    </div>
                    <div class="card swiper-slide">
                        <div class="image-content">
                            <div class="card-image">
                                <img alt="wedding-arch" class="card-img" src="img/wedding-arch.png">
                            </div>
                        </div>
                        <div class="card-content">
                            <h6 class="name fw-bold">Katering</h6>
                            <p class="description">The lorem text the section that contains header with having open functionality. Lorem dolor sit amet consectetur adipisicing elit.</p>
                            <button class="button">Selengkapnya</button>
                        </div>
                    </div>
                    <div class="card swiper-slide">
                        <div class="image-content">
                            <div class="card-image">
                                <img alt="makeover" class="card-img" src="img/makeover.png">
                            </div>
                        </div>
                        <div class="card-content">
                            <h6 class="name fw-bold">Make Up</h6>
                            <p class="description">The lorem text the section that contains header with having open functionality. Lorem dolor sit amet consectetur adipisicing elit.</p>
                            <button class="button">Selengkapnya</button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="swiper-pagination"></div>
        </div>
        <!-- akhir konten 3 -->

        <!-- konten 4 vidio promosi-->
        <div class="row same-height mt-5 shadow p-3 mb-5">
            <div class="col-md-6 text-center align-self-center" data-aos="fade-up">
                <h5 class="card-title card-perusahaan">Moelia Design</h5>
                <img alt="" class="image-garis" src="img/gariskonten.png">
                <h6 class="card-subtitle">
                    sebelum melakukan pemesanan kepada kami alangkah baiknya untuk melihat vidio kami terlebih dahulu.
                </h6>
            </div>
            <div class="col-md-6" data-aos="fade-down">
                <div class="embed-responsive embed-responsive-16by9 video-container">
                    <iframe allowfullscreen class="embed-responsive-item" src="https://www.youtube-nocookie.com/embed/1-GLrbJzG3A"></iframe>
                </div>
            </div>
        </div>
        <!-- akhir konten 4 -->

        <!-- konten 5 produk terbaru -->
        <div class="container mb-5 new-product" data-aos="fade-down">
            <h5 class="text-center card-perusahaan">Moelia Design</h5>
            <h6 class="text-center card-subtitle">Produk Terbaru Kami</h6>
            <div class="row">
                @foreach ($products as $value)
                    <div class="col-md-4">
                        <div class="card card-new-prdct" data-aos="fade-down">
                            <img alt="{{ $value->nama_produk }}" class="card-img-top" src="/storage/post-images{{ $value->gambar }}">
                            <div class="card-body">
                                <div class="kategori d-flex">
                                    <i class="bi bi-calendar-event d-flex me-2">
                                        <p class="ms-1">{{ $value->created_at->format('d/m/y') }}</p>
                                    </i>
                                    <i class="bi bi-tag-fill ms-2 d-flex">
                                        <p class="ms-1">{{ $value->category->nama_kategori }}</p>
                                    </i>
                                </div>
                                <h6 class="card-title fw-bold">{{ $value->nama_produk }}</h6>
                                <p class="card-text text-center">{{ $value->deskripsi }}</p>
                                <a class="btn" href="#">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <!-- akhir konte 5 -->
        <!-- konten 6 gallery -->
        <div data-aos="fade-down">
            <h5 class="text-center card-perusahaan">Moelia Design</h5>
            <h6 class="text-center card-subtitle">Foto Kami</h6>
            <div class="gallery container">
                @foreach ($photos as $value)
                    <div class="item" data-aos="fade-down"><img alt="{{ $value->photo_name }}" src="/storage/{{ $value->photo_path }}"></div>
                @endforeach
            </div>
        </div>

        <!-- akhir konten 6 gallery -->

        <!-- konten 7 alamat-->
        <div class="row same-height mt-5" data-aos="fade-up">
            <div class="text-center align-self-center">
                <h5 class="card-title card-perusahaan">{{ $companies->nama_perusahaan ?? null }}</h5>
                <h6 class="card-subtitle">
                    {{ $addresses->alamat_perusahaan ?? null }}
                </h6>
            </div>
        </div>
        <!-- akhir konten 7 -->

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
@endpush
