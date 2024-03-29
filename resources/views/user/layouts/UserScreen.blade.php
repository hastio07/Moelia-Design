<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <meta content="{{ csrf_token() }}" name="csrf-token">

    <!-- bootstrap -->
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" rel="stylesheet">
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
        @if (!empty($contact) && $contact->whatsapp1_number)
            <a href="https://wa.me/+62{{ $contact->whatsapp1_number }}?text=Selamat Datang DiMoelia Design">
                <div class="floating-icon">
                    <i class="bi bi-whatsapp"></i>
                </div>
            </a>
        @endif
        <!-- batas icon wa -->
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg rounded-bottom fixed-top bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="/">
                    @if (!empty($companies) && $companies->logo_perusahaan)
                        <img alt="{{ $companies->nama_perusahaan ?? 'logo' }}" class="d-inline-block rounded-circle me-3 align-text-top" src="/storage/{{ $companies->logo_perusahaan }}" width="30">
                    @else
                        <h5 class="me-3">logo</h5>
                    @endif
                    {{ $companies->nama_perusahaan ?? 'Nama perusahaan' }}
                </a>
                <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler border-0" data-bs-target="#navbarSupportedContent" data-bs-toggle="collapse" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-lg-0 mx-auto mb-2 me-auto">
                        <li class="nav-item">
                            <a @class(['nav-link', 'active' => Route::is('home')]) aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a @class(['nav-link', 'active' => Route::is('produk.*')]) href="/produk">Produk</a>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <a @class([
                                    'nav-link',
                                    'dropdown-toggle',
                                    'active' => Route::is('foto') || Route::is('vidio'),
                                ]) aria-expanded="false" data-bs-toggle="dropdown" href="#" role="button">
                                    Gallery
                                </a>
                                <ul class="dropdown-menu dropdown-gallery text-center">
                                    <li>
                                        <a @class([
                                            'nav-link',
                                            'dropdown-item',
                                            'bg-light active' => Route::is('foto'),
                                        ]) href="/foto">Foto</a>
                                    </li>
                                    <li>
                                        <a @class([
                                            'nav-link',
                                            'dropdown-item',
                                            'bg-light active' => Route::is('vidio'),
                                        ]) href="/vidio">Vidio</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a @class([
                                'nav-link',
                                'active' => Route::is('wedding-calculator.index'),
                            ]) aria-current="page" href="/wedding-calculator">Wedding Calculator</a>
                        </li>
                        <li class="nav-item">
                            <a @class(['nav-link', 'active' => Route::is('aboutus')]) href="/aboutus">Tentang Kami</a>
                        </li>
                        @auth('web')
                            <li class="nav-item">
                                <a class="nav-link" href="/pembayaran">Pembayaran</a>
                            </li>
                        @endauth
                    </ul>
                    <div class="text-center">
                        @auth
                            @if (auth()->user()->role_id == 3)
                                <a aria-expanded="false" class="btn btn-color dropdown-toggle text-capitalize" data-bs-toggle="dropdown" href="{{ route('dashboard') }}" id="logoutDropdown" role="button">
                                    {{ auth()->user()->nama_depan . ' ' . auth()->user()->nama_belakang }}
                                </a>
                                <div class="dropdown">
                                    <ul class="dropdown-menu dropdown-gallery mt-1">
                                        <li><a class="dropdown-item" href="/profile"><i class="bi bi-person"></i> Profil</a></li>
                                        <li>
                                            <form action="{{ route('logout') }}" id="logout" method="post">
                                                @csrf
                                                <a class="dropdown-item" href="#" onclick="document.getElementById('logout').submit();">
                                                    <div class="text-dark">
                                                        <i class="bi bi-box-arrow-left"></i> Logout
                                                    </div>
                                                </a>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <a class="btn btn-color text-capitalize" href="{{ route('dashboard') }}">
                                    {{ auth()->user()->nama_depan . ' ' . auth()->user()->nama_belakang }}
                                </a>
                            @endif
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
    <section> @yield('konten')</section>
    <!-- end konten -->

    <!-- footer -->
    <footer class="mt-5 pt-5 text-center">
        <h1>{{ $companies->nama_perusahaan ?? 'Moelia Design' }}</h1>
        <div class="line-footer"></div><br>

        @if (!empty($addresses) && $addresses->alamat_perusahaan)
            <p>{{ $addresses->alamat_perusahaan }}</p>
        @else
            <p class="text-secondary"><i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>Alamat Belum Tesedia</p>
        @endif

        <div class="icon-socmed my-4 text-center">
            @foreach ($sosmed as $sosmed)
                <a href="{{ $sosmed->l_instagram }}"><i class="bi bi-instagram"></i></a>
                <a href="{{ $sosmed->l_facebook }}"><i class="bi bi-facebook"></i></a>
                <a href="{{ $sosmed->l_twitter }}"><i class="bi bi-twitter"></i></a>
                <a href="{{ $sosmed->l_youtube }}"><i class="bi bi-youtube"></i></a>
                <a href="{{ $sosmed->l_tiktok }}"><i class="bi bi-tiktok"></i></a>
            @endforeach
        </div>
        <div class="d-flex flex-column flex-sm-row justify-content-center fw-bold mb-3">
            <a class="me-sm-3 mb-sm-0 menu-link mb-2" href="/">Home</a>
            <a class="me-sm-3 mb-sm-0 menu-link mb-2" href="/foto">Foto</a>
            <a class="me-sm-3 mb-sm-0 menu-link mb-2" href="vidio">Vidio</a>
            <a class="me-sm-3 mb-sm-0 menu-link mb-2" href="/wedding-calculator">Wedding Calculator</a>
            <a class="me-sm-3 mb-sm-0 menu-link mb-2" href="/aboutus">Tentang Kami</a>
            <a class="me-sm-3 mb-sm-0 menu-link mb-2" href="">Pembayaran</a>
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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- end bootstrap -->
    @stack('scripts')
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            offset: 400,
            duration: 1000
        });
    </script>
    <script>
        $(document).ready(function() {
            // Munculkan dropdown saat kursor diarahkan
            $(".dropdown").hover(
                function() {
                    $(this).find(".dropdown-menu").addClass("show");
                },
                function() {
                    $(this).find(".dropdown-menu").removeClass("show");
                }
            );
        });
    </script>
</body>

</html>
