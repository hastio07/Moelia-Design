<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link crossorigin="anonymous" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" referrerpolicy="no-referrer" rel="stylesheet" />
    <link href="{{ asset('templates/vendor/themify-icons/themify-icons.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset('templates/vendor/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('templates/assets/css/bootstrap-override.min.css') }}" rel="stylesheet">

    <link href="{{ asset('templates/vendor/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">

    <link href="{{ asset('templates/vendor/DataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('templates/vendor/DataTables/DataTables-1.13.4/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('templates/vendor/DataTables/Responsive-2.4.1/css/responsive.dataTables.min.css') }}" rel="stylesheet">

    <link href="{{ asset('templates/assets/css/style.min.css') }}" rel="stylesheet">

    <link href="{{ asset('templates/assets/css-modif/admin/AdminLayout.css') }}" rel="stylesheet">

    @stack('styles')

    <title>Moelia | @yield('title') | {{ ucwords(str_replace('_', ' ', auth()->user()->role->level)) }}</title>
</head>

<body>
    <div id="app">
        <div class="shadow-header"></div>
        <header class="header-navbar fixed">
            <div class="toggle-mobile action-toggle"><i class="fas fa-bars"></i></div>

            <div class="header-wrapper">
                <div class="header-left text-capitalize fs-6 text-success ms-5 mt-1 pt-2">
                    <p id="informasi-hari"></p>
                    <p>,</p>
                    <p id="tanggal-hari-ini"></p>
                </div>
                <div class="header-content">
                    <div class="notification dropdown">
                        <a aria-expanded="false" href="/" style="left: 200px;">
                            <i class="fa-solid fa-tv"></i>
                        </a>
                    </div>
                    <div class="notification dropdown">
                        <a aria-expanded="false" data-bs-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge">{{ auth()->user()->unreadNotifications->count() }}</span>
                        </a>
                        <ul class="dropdown-menu medium">
                            <li class="menu-header">
                                <a class="dropdown-item" href="#">Notification</a>
                            </li>
                            <li class="menu-content ps-menu">
                                @foreach (auth()->user()->unreadNotifications as $notification)
                                    {{-- <a href="{{ url($notification->data['url'] . '?ntf=' . $notification->id) }}"> --}}
                                    <a href="{{ route('manage-pesanan-proses.detail', ['id_detail_pesanan' => $notification->data['pembayaran_id'], 'ntf' => $notification->id]) }}">
                                        <div class="message-icon text-info">
                                            <i class="fas fa-info"></i>
                                        </div>
                                        <div class="message-content read">
                                            <div class="body">
                                                {{ $notification->data['messages'] }}
                                            </div>
                                            <div class="time">{{ $notification->created_at->diffForHumans() }}</div>
                                        </div>
                                    </a>
                                @endforeach
                                <a class="text-center italic" href="/daftar-notifikasi" style="font-size:small;">Lihat Semua Pesan <i class="bi bi-arrow-right text-primary ms-1 mt-1"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="dropdown dropdown-menu-end">
                        <a aria-expanded="false" class="user-dropdown" data-bs-toggle="dropdown" href="#">
                            <div class="label text-capitalize">
                                <span></span>
                                @auth<div>{{ auth()->user()->nama_depan . ' ' . auth()->user()->nama_belakang }}</div>
                                @endauth
                            </div>
                            <img alt="user" class="img-user" src="{{ asset('templates') }}/assets/images/avatar1.png" srcset="">
                        </a>
                        <ul class="dropdown-menu small">
                            <li class="menu-content ps-menu">
                                <a href="{{ route('profile-admin') }}">
                                    <div class="description">
                                        <i class="ti-user"></i> Profile
                                    </div>
                                </a>
                                <form action="{{ route('logout') }}" id="logout" method="post">
                                    @csrf
                                    <a href="#" onclick="document.getElementById('logout').submit();">
                                        <div class="description">
                                            <i class="ti-power-off"></i>Logout
                                        </div>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <nav class="main-sidebar ps-menu">
            <div class="sidebar-toggle action-toggle">
                <a href="#">
                    <i class="fas fa-bars"></i>
                </a>
            </div>
            <div class="sidebar-opener action-toggle">
                <a href="#">
                    <i class="ti-angle-right"></i>
                </a>
            </div>
            <div class="sidebar-header">
                <div class="text">MD</div>
                <div class="close-sidebar action-toggle">
                    <i class="ti-close"></i>
                </div>
            </div>
            <div class="sidebar-content">
                <ul>
                    <li class="{{ Route::is('dashboard') ? 'active' : '' }}">
                        <a class="link" href="{{ route('dashboard') }}">
                            <i class="ti-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    @can('view', [auth()->user()])
                        <li class="{{ Route::is('manage-admin.*') ? 'active' : '' }}">
                            <a class="link" href="{{ route('manage-admin.index') }}">
                                <i class="ti-id-badge"></i>
                                <span>Manage Akun</span>
                            </a>
                        </li>
                    @endcan
                    <li class="{{ Route::is('manage-perusahaan.*') ? 'active' : '' }}">
                        <a class="link" href="{{ route('manage-perusahaan.index') }}">
                            <i class="ti-home"></i>
                            <span>Manage Perusahaan</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('manage-produk.*') ? 'active' : '' }}">
                        <a class="link" href="{{ route('manage-produk.index') }}">
                            <i class="ti-view-grid"></i>
                            <span>Manage Produk</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('manage-jadwal.*') ? 'active' : '' }}">
                        <a class="link" href="{{ route('manage-jadwal.index') }}">
                            <i class="ti-agenda"></i>
                            <span>Manage Jadwal</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('manage-pesanan-proses.*') ? 'open' : '' }}">
                        <a class="main-menu has-dropdown" href="#">
                            <i class="ti-shopping-cart-full"></i>
                            <span>Manage Pesanan</span>
                        </a>
                        <ul class="sub-menu {{ Route::is('manage-pesanan-proses.*') ? 'expand' : '' }}">
                            <li class="{{ Route::is('manage-pesanan-proses.*') ? 'active' : '' }}">
                                <a class="link" href="{{ route('manage-pesanan-proses.index') }}">
                                    <span>Pesanan Diproses</span>
                                </a>
                            </li>
                            <li class="{{ Route::is('manage-pesanan-selesai.*') ? 'active' : '' }}">
                                <a class="link" href="{{route('manage-pesanan-selesai.index')}}">
                                    <span>Pesanan Selesai</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ Route::is('manage-gallery.*') ? 'active' : '' }}">
                        <a class="link" href="{{ route('manage-gallery.index') }}">
                            <i class="ti-gallery"></i>
                            <span>Manage Gallery</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('manage-layanan.*') ? 'active' : '' }}">
                        <a class="link" href="{{ route('manage-layanan.index') }}">
                            <i class="ti-bookmark-alt"></i>
                            <span>Manage Layanan</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('manage-pegawai.*') ? 'active' : '' }}">
                        <a class="link" href="/manage-pegawai">
                            <i class="ti-user"></i>
                            <span>Manage Pegawai</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('manage-gudang.*') ? 'active' : '' }}">
                        <a class="link" href="{{ route('manage-gudang.index') }}">
                            <i class="ti-package"></i>
                            <span>Manange Gudang</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('manage-wedding-calculator.*') ? 'active' : '' }}">
                        <a class="link" href="{{ route('manage-wedding-calculator.index') }}">
                            <i class="ti-pencil-alt"></i>
                            <span>Wedding Calculator</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="main-content">
            @yield('content')
        </div>
        <div class="settings">
            <div class="settings-icon-wrapper">
                <div class="settings-icon">
                    <i class="ti ti-settings"></i>
                </div>
            </div>
        </div>
    </div>
    <footer>
        Copyright © 2023 &nbsp <a class="ml-1" href="https://www.instagram.com/moeliadesign/" target="_blank">Moelia
            Design</a> <span> . All rights Reserved</span>
    </footer>
    <div class="overlay action-toggle">
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="{{ asset('templates/vendor/bootstrap/dist/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('templates/vendor/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('templates/vendor/DataTables/DataTables-1.13.4/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('templates/vendor/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('templates/vendor/DataTables/Responsive-2.4.1/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('templates/assets/js/main.js') }}"></script>

    <script>
        Main.init()
    </script>
    <script>
        var today = new Date();
        var options = {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        };
        var formatter = new Intl.DateTimeFormat('id-ID', options);
        var formattedDate = formatter.format(today);
        document.getElementById('tanggal-hari-ini').innerHTML = formattedDate;

        var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        var dayIndex = today.getDay();
        var dayName = days[dayIndex];
        document.getElementById('informasi-hari').innerHTML = dayName;
    </script>
    @stack('scripts')
</body>

</html>
