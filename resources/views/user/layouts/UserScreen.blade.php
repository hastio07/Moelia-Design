<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- bootstrap -->
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css" rel="stylesheet">
    <!-- end bootstrap -->

    <!-- Font Awesome CDN Link -->
    <link crossorigin="anonymous" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" referrerpolicy="no-referrer" rel="stylesheet" />

    <!-- Animate On Scroll Library -->
    <link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet" />

    <!-- Google Fonts CDN Link -->
    <link href="{{ asset('templates/assets/css/fonts.css') }}" rel="stylesheet" />

    <!-- Css Modif -->
    <link href="{{ asset('templates') }}/assets/css-modif/user/UserLayout.css" rel="stylesheet">

    <!-- Css for spesific page -->
    @stack('styles')

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
                            <a class="nav-link" href="/maintenance">Wedding Calculator</a>
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
                        <a href="/dashboard"><button class="btn btn-color text-capitalize">{{ auth()->user()->nama_depan . ' ' . auth()->user()->nama_belakang }}</button></a>
                        <a href="{{ route('dashboard') }}"><button class="btn btn-color text-capitalize">{{ auth()->user()->nama_depan . ' ' . auth()->user()->nama_belakang }}</button></a>
                        @else
                        <a href="/login">
                            <button class="btn btn-color" type="submit">Login <i class="fa-solid fa-right-to-bracket"></i></button>
                        </a>
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
    <div class="body-footer">
        <footer>
            <div class="container">
                <div class="text-center">
                    <h1 class="fw-bolder">Moelia Design</h1>
                </div>
                <div class="icon-socmed text-center">
                    <i class="bi bi-instagram"></i>
                    <i class="bi bi-facebook"></i>
                    <i class="bi bi-twitter"></i>
                    <i class="bi bi-youtube"></i>
                </div>
                <div class="copyright-wrapper">
                    <p>
                        Copyright © 2023 &nbsp<a class="ml-1" href="https://www.instagram.com/moeliadesign/" target="_blank">Moelia Design</a> <span> . All rights Reserved</span>
                    </p>
                </div>
            </div>
        </footer>
    </div>
    <!-- end footer -->
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

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
