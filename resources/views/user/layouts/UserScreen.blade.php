<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css" rel="stylesheet">
    <!-- end bootstrap -->

    <!-- Font Awesome CDN Link -->
    <link crossorigin="anonymous" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" referrerpolicy="no-referrer" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.css" rel="stylesheet" />

    <!-- Animate On Scroll Library -->
    <link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet" />

    <!-- Google Fonts CDN Link -->
    <link href="{{ asset('templates/assets/css/fonts.css') }}" rel="stylesheet" />

    <!-- Css Modif -->
    <link href="{{ asset('templates') }}/assets/css-modif/user/UserLayout.css" rel="stylesheet">

    <!-- Css for spesific page -->
    @stack('styles')
    @Stack('head-scripts')

    <title>Moelia | @yield('title')</title>
</head>

<body>

    <Header>
        <!-- icon wa -->
        <a href="">
            <div class="floating-icon">
                <i class="bi bi-whatsapp"></i>
            </div>
        </a>
        <!-- batas icon wa -->
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg bg-white shadow-sm rounded-bottom fixed-top">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img alt="{{ $companies->nama_perusahaan ?? 'logo' }}" class="d-inline-block align-text-top rounded-circle me-3" src="/storage/{{ $companies->logo_perusahaan ?? '#' }}" width="30">{{ $companies->nama_perusahaan ?? 'Moelia Design' }}
                </a>
                <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler border-0" data-bs-target="#navbarSupportedContent" data-bs-toggle="collapse" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                        <li class="nav-item">
                            <a @class(['nav-link', 'active'=> Route::is('home')]) aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a @class(['nav-link', 'active'=> Route::is('produk.*')]) href="/produk">Produk</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a @class([ 'nav-link' , 'dropdown-toggle' , 'active'=> Route::is('foto') || Route::is('vidio'),
                                ]) aria-expanded="false" data-bs-toggle="dropdown" href="#" role="button">
                                Gallery
                            </a>
                            <ul class="dropdown-menu">
                                <li><a @class([ 'nav-link' , 'dropdown-item' , 'bg-light active'=> Route::is('foto'),
                                        ]) href="/foto">Foto</a></li>
                                <li><a @class([ 'nav-link' , 'dropdown-item' , 'bg-light active'=> Route::is('vidio'),
                                        ]) href="/vidio">Vidio</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/wedding-calculator">Wedding Calculator</a>
                        </li>
                        <li class="nav-item">
                            <a @class(['nav-link', 'active'=> Route::is('aboutus')]) href="/aboutus">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/pembayaran">Pembayaran</a>
                        </li>
                    </ul>
                    <div class="d-flex center">
                        @auth
                        <a href="{{ route('dashboard') }}"><button class="btn btn-color text-capitalize">{{ auth()->user()->nama_depan . ' ' . auth()->user()->nama_belakang }}</button></a>
                        @else

                        <a href="{{ route('login') }}">
                            <button class="btn btn-color" type="submit">Login <i class="fa-solid fa-right-to-bracket"></i></button>
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
        <!-- end navbar -->
    </Header>

    <!-- konten -->
    <section class="isi-konten"> @yield('konten')</section>
    <!-- end konten -->

    <!-- footer -->
    <footer class="text-center mt-5 pt-5">
        <h1>{{ $companies->nama_perusahaan ?? 'Moelia Design' }}</h1>
        <div class="line-footer"></div><br>

        @if (!empty($addresses->alamat_perusahaan))
        <p>{{ $addresses->alamat_perusahaan }}</p>
        @endif

        <div class="icon-socmed text-center my-4">
            @foreach($sosmed as $sosmed)
            <a href="{{ $sosmed -> l_instagram }}"><i class="bi bi-instagram"></i></a>
            <a href="{{ $sosmed -> l_facebook }}"><i class="bi bi-facebook"></i></a>
            <a href="{{ $sosmed -> l_twitter }}"><i class="bi bi-twitter"></i></a>
            <a href="{{ $sosmed -> l_youtube }}"><i class="bi bi-youtube"></i></a>
            <a href="{{ $sosmed -> l_tiktok }}"><i class="bi bi-tiktok"></i></a>
            @endforeach
        </div>
        <div class="d-flex flex-column flex-sm-row justify-content-center mb-3 fw-bold">
            <a href="/" class="me-sm-3 mb-2 mb-sm-0 menu-link">Home</a>
            <a href="/foto" class="me-sm-3 mb-2 mb-sm-0 menu-link">Foto</a>
            <a href="vidio" class="me-sm-3 mb-2 mb-sm-0 menu-link">Vidio</a>
            <a href="/wedding-calculator" class="me-sm-3 mb-2 mb-sm-0 menu-link">Wedding Calculator</a>
            <a href="/aboutus" class="me-sm-3 mb-2 mb-sm-0 menu-link">Tentang Kami</a>
            <a href="" class="me-sm-3 mb-2 mb-sm-0 menu-link">Pembayaran</a>
        </div>

        <div class="copyright-wrapper">
            <p>
                Copyright © 2023 &nbsp<a class="ml-1" href="https://www.instagram.com/moeliadesign/" target="_blank">Moelia Design</a> <span> . All rights Reserved</span>
            </p>
        </div>
    </footer>
    <!-- end footer -->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <!-- end bootstrap -->
    @stack('scripts')
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            offset: 400,
            duration: 1000
        });
    </script>

</body>

</html>