<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Moelia | @yield('title') | {{ ucwords(str_replace('_', ' ', auth()->user()->role->level)) }}</title>
    <link crossorigin="anonymous" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" rel="stylesheet" />

    <link href="{{ asset('templates') }}/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('templates') }}/vendor/themify-icons/themify-icons.css" rel="stylesheet">
    <link href="{{ asset('templates') }}/vendor/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="{{ asset('templates') }}/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <!-- CSS for manage jadwal only -->
    <link href="{{ asset('templates') }}/vendor/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="{{ asset('templates') }}/vendor/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet" />
    <!-- End CSS  -->

    <!-- CSS for all page -->
    {{-- <link rel="stylesheet" href="{{ asset('templates') }}/vendor/chart.js/dist/Chart.min.css"> --}}
    <!-- End CSS  -->

    <!-- css edit  -->
    <link href="{{ asset('templates') }}/assets/css-modif/manageakun.css" rel="stylesheet">
    <link href="{{ asset('templates') }}/assets/css-modif/ManageProduk.css" rel="stylesheet">
    <link href="{{ asset('templates') }}/assets/css-modif/ManagePerusahaan.css" rel="stylesheet">
    <link href="{{ asset('templates') }}/assets/css-modif/Gallery.css" rel="stylesheet">
    <!-- end css -->

    <link href="{{ asset('templates') }}/assets/css/style.min.css" rel="stylesheet">
    <link href="{{ asset('templates') }}/assets/css/bootstrap-override.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" id="theme-color" href="template/assets/css/dark.min.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">

    <link crossorigin="anonymous" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" referrerpolicy="no-referrer" rel="stylesheet" />

    @stack('head-scripts')
</head>

<body>
    <div id="app">
        <div class="shadow-header"></div>
        <header class="header-navbar fixed">
            <div class="toggle-mobile action-toggle"><i class="fas fa-bars"></i></div>
            <div class="header-wrapper">
                <div class="header-left">
                </div>
                <div class="header-content">
                    <div class="notification dropdown">
                        <a aria-expanded="false" data-bs-toggle="dropdown" href="#" style="left: 200px;">
                            <i class="far fa-envelope"></i>
                        </a>
                        <ul class="dropdown-menu medium">
                            <li class="menu-header">
                                <a class="dropdown-item" href="#">Message</a>
                            </li>
                            <li class="menu-content ps-menu">
                                <a href="#">
                                    <div class="message-image">
                                        <img alt="user1" class="rounded-circle w-100" src="{{ asset('templates') }}/assets/images/avatar1.png">
                                    </div>
                                    <div class="message-content read">
                                        <div class="subject">
                                            John
                                        </div>
                                        <div class="body">
                                            Please call me at 9pm
                                        </div>
                                        <div class="time">Just now</div>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="message-image">
                                        <img alt="user1" class="rounded-circle w-100" src="{{ asset('templates') }}/assets/images/avatar2.png">
                                    </div>
                                    <div class="message-content">
                                        <div class="subject">
                                            Michele
                                        </div>
                                        <div class="body">
                                            Please come to my party
                                        </div>
                                        <div class="time">3 hours ago</div>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="message-image">
                                        <img alt="user1" class="rounded-circle w-100" src="{{ asset('templates') }}/assets/images/avatar1.png">
                                    </div>
                                    <div class="message-content read">
                                        <div class="subject">
                                            Brad
                                        </div>
                                        <div class="body">
                                            I have something to discuss, please call me soon
                                        </div>
                                        <div class="time">3 hours ago</div>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="message-image">
                                        <img alt="user1" class="rounded-circle w-100" src="{{ asset('templates') }}/assets/images/avatar2.png">
                                    </div>
                                    <div class="message-content">
                                        <div class="subject">
                                            Anel
                                        </div>
                                        <div class="body">
                                            Sorry i'm late
                                        </div>
                                        <div class="time">8 hours ago</div>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="message-image">
                                        <img alt="user1" class="rounded-circle w-100" src="{{ asset('templates') }}/assets/images/avatar2.png">
                                    </div>
                                    <div class="message-content">
                                        <div class="subject">
                                            Mary
                                        </div>
                                        <div class="body">
                                            Please answer my question last night
                                        </div>
                                        <div class="time">Last month</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="notification dropdown">
                        <a aria-expanded="false" data-bs-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge">12</span>
                        </a>
                        <ul class="dropdown-menu medium">
                            <li class="menu-header">
                                <a class="dropdown-item" href="#">Notification</a>
                            </li>
                            <li class="menu-content ps-menu">
                                <a href="#">
                                    <div class="message-icon text-danger">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="message-content read">
                                        <div class="body">
                                            There's incoming event, don't miss it!!
                                        </div>
                                        <div class="time">Just now</div>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="message-icon text-info">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="message-content read">
                                        <div class="body">
                                            Your licence will expired soon
                                        </div>
                                        <div class="time">3 hours ago</div>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="message-icon text-success">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="message-content">
                                        <div class="body">
                                            Successfully register new user
                                        </div>
                                        <div class="time">8 hours ago</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="dropdown dropdown-menu-end">
                        <a aria-expanded="false" class="user-dropdown" data-bs-toggle="dropdown" href="#">
                            <div class="label">
                                <span></span>
                                @auth<div>{{ auth()->user()->nama_depan . ' ' . auth()->user()->nama_belakang }}</div>
                                @endauth
                            </div>
                            <img alt="user" class="img-user" src="{{ asset('templates') }}/assets/images/avatar1.png" srcset="">
                        </a>
                        <ul class="dropdown-menu small">
                            <li class="menu-content ps-menu">
                                <a href="#">
                                    <div class="description">
                                        <i class="ti-user"></i> Profile
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="description">
                                        <i class="ti-settings"></i> Setting
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
                    <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                        <a class="link" href="/dashboard">
                            <i class="ti-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    @can('view', App\Models\Admin::class)
                        <li class="{{ Request::is('dashboard/manage-akun') || Request::is('dashboard/manage-akun/*/edit') ? 'active' : '' }}">
                            <a class="link" href="/dashboard/manage-akun">
                                <i class="ti-id-badge"></i>
                                <span>Manage Akun</span>
                            </a>
                        </li>
                    @endcan
                    <li>
                        <a class="link" href="/dashboard/manage-perusahaan">
                            <i class="ti-home"></i>
                            <span>Manage Perusahaan</span>
                        </a>
                    </li>
                    <li>
                        <a class="link" href="/dashboard/manage-produk">
                            <i class="ti-view-grid"></i>
                            <span>Manage Produk</span>
                        </a>
                    </li>
                    <li>
                        <a class="link" href="/dashboard/manage-jadwal">
                            <i class="ti-agenda"></i>
                            <span>Manage Jadwal</span>
                        </a>
                    </li>
                    <li>
                        <a class="main-menu has-dropdown" href="#">
                            <i class="ti-shopping-cart-full"></i>
                            <span>Manage Pesanan</span>
                        </a>
                        <ul class="sub-menu ">
                            <li><a class="link" href="/manage-pesanan"><span>Selesai Dikerjakan</span></a></li>
                            <li><a class="link" href="/manage-pesanan"><span>Belum Dikerjakan</span></a></li>
                        </ul>
                    </li>
                    <li class="{{ Request::is('dashboard/manage-gallery*') ? 'active' : '' }}">
                        <a class="link" href="/dashboard/manage-gallery">
                            <i class="ti-gallery"></i>
                            <span>Manage Gallery</span>
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

    {{-- js for all page --}}
    <script src="{{ asset('templates') }}/vendor/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script src="{{ asset('templates') }}/vendor/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('templates') }}/assets/js/main.js"></script>
    {{-- ======= --}}

    {{-- script for manageproduk page --}}
    @stack('manageproduk-scripts')
    @stack('manageperusahaan-scripts')
    {{-- ======= --}}

    {{-- js for page table --}}
    <script src="{{ asset('templates') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('templates') }}/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('templates') }}/vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('templates') }}/assets/js/page/datatables.js"></script>
    {{-- =======  --}}

    {{-- script for table --}}
    <script>
        DataTable.init()
    </script>
    @stack('managegallery-scripts')
    {{-- =======  --}}

    <script>
        Main.init()
    </script>

</body>

</html>
