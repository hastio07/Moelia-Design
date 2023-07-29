@extends('admin.layouts.layouts')
@section('title', 'Dashboard')
@push('styles')
    <link href="{{ asset('templates') }}/assets/css-modif/admin/AdminDashboard.css" rel="stylesheet">
@endpush

@section('content')
    <div class="dashboard">
        <div class="content-wrapper">
            <div class="row same-height">
                <div class="card">
                    <div class="card-body pt-5">
                        <div class="col-md-10 mx-auto">
                            <div class="row">
                                <div class="col-xl-3 col-lg-6 col-md-6">
                                    <div class="card bg-danger text-white">
                                        <div class="card-statistic-3 p-4">
                                            <div class="card-icon card-icon-large"><i class="bi bi-cart4"></i></div>
                                            <div class="mb-4">
                                                <h5 class="card-title mb-0"><a href="/manage-pesanan-proses" class="text-white text-decoration-none">Pesanan Baru</a></h5>
                                            </div>
                                            <div class="row align-items-center d-flex mb-2">
                                                <div class="col-8">
                                                    <h2 class="d-flex align-items-center mb-0">
                                                        {{ $managePesanan }}
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6">
                                    <div class="card bg-primary text-white">
                                        <div class="card-statistic-3 p-4">
                                            <div class="card-icon card-icon-large"><i class="bi bi-cart-check"></i></div>
                                            <div class="mb-4">
                                                <h5 class="card-title mb-0"><a href="/PesananSelesai" class="text-white text-decoration-none">Pesanan Selesai</a></h5>
                                            </div>
                                            <div class="row align-items-center d-flex mb-2">
                                                <div class="col-8">
                                                    <h2 class="d-flex align-items-center mb-0">
                                                        -
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6">
                                    <div class="card bg-warning text-white">
                                        <div class="card-statistic-3 p-4">
                                            <div class="card-icon card-icon-large"><i class="bi bi-gear-wide-connected"></i></div>
                                            <div class="mb-4">
                                                <h5 class="card-title mb-0"><a href="/manage-layanan" class="text-white text-decoration-none">Layanan</a></h5>
                                            </div>
                                            <div class="row align-items-center d-flex mb-2">
                                                <div class="col-8">
                                                    <h2 class="d-flex align-items-center mb-0">
                                                        {{ $jumlahLayanan }}
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6">
                                    <div class="card bg-info text-white">
                                        <div class="card-statistic-3 p-4">
                                            <div class="card-icon card-icon-large"><i class="bi bi-universal-access"></i></div>
                                            <div class="mb-4">
                                                <h5 class="card-title mb-0"><a href="/manage-pegawai" class="text-white text-decoration-none">Pegawai</a></h5>
                                            </div>
                                            <div class="row align-items-center d-flex mb-2">
                                                <div class="col-8">
                                                    <h2 class="d-flex align-items-center mb-0">
                                                        {{ $jumlahPegawai }}
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6">
                                    <div class="card bg-info text-white">
                                        <div class="card-statistic-3 p-4">
                                            <div class="card-icon card-icon-large"><i class="bi bi-tags-fill"></i></div>
                                            <div class="mb-4">
                                                <h5 class="card-title mb-0"><a href="/manage-produk" class="text-white text-decoration-none">Produk</a></h5>
                                            </div>
                                            <div class="row align-items-center d-flex mb-2">
                                                <div class="col-8">
                                                <h2 class="d-flex align-items-center mb-0">
                                                    {{ $jumlahProduk }}
                                                </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6">
                                    <div class="card bg-warning text-white">
                                        <div class="card-statistic-3 p-4">
                                            <div class="card-icon card-icon-large"><i class="bi bi-card-image"></i></div>
                                            <div class="mb-4">
                                                <h5 class="card-title mb-0"><a href="/manage-gallery/photo-tab" class="text-white text-decoration-none">Foto</a></h5>
                                            </div>
                                            <div class="row align-items-center d-flex mb-2">
                                                <div class="col-8">
                                                    <h2 class="d-flex align-items-center mb-0">
                                                        {{ $jumlahPhoto }}
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6">
                                    <div class="card bg-primary text-white">
                                        <div class="card-statistic-3 p-4">
                                            <div class="card-icon card-icon-large"><i class="bi bi-camera-reels-fill"></i></div>
                                            <div class="mb-4">
                                                <h5 class="card-title mb-0"><a href="/manage-gallery/video-tab" class="text-white text-decoration-none">Video</a></h5>
                                            </div>
                                            <div class="row align-items-center d-flex mb-2">
                                                <div class="col-8">
                                                    <h2 class="d-flex align-items-center mb-0">
                                                        {{ $jumlahVideo }}
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6">
                                    <div class="card bg-danger text-white">
                                        <div class="card-statistic-3 p-4">
                                            <div class="card-icon card-icon-large"><i class="bi bi-calendar-week"></i></div>
                                            <div class="mb-4">
                                                <h5 class="card-title mb-0"><a href="/manage-jadwal" class="text-white text-decoration-none">Jadwal</a></h5>
                                            </div>
                                            <div class="row align-items-center d-flex mb-2">
                                                <div class="col-8">
                                                    <h2 class="d-flex align-items-center mb-0">
                                                        {{ $jumlahJadwal }}
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-wrapper">
            <div class="same-height">
                <div class="card">
                    <div class="card-body">
                        <div class="event-schedule-area-two bg-color">
                            <div class="section-title text-center">
                                <div class="title-text">
                                    <h2>Event Schedule</h2>
                                </div>
                                <p>
                                    Harap selalu perhatikan jadwal kegiatan guna meminimalisisr terlewatnya suatu kegiatan
                                </p>
                            </div>
                            <div class="line">
                            </div>
                            <ul class="main mt-5">
                                <div class="row">
                                    @php
                                        $groupedJadwal = $jadwal
                                            ->groupBy(function ($item) {
                                                return \Carbon\Carbon::parse($item->waktu)->format('Y-m-d');
                                            })
                                            ->sortBy(function ($group, $date) {
                                                return \Carbon\Carbon::parse($date);
                                            });

                                        $startDate = \Carbon\Carbon::now()->subDay(2); // Tanggal 1 hari sebelumnya
                                        $endDate = \Carbon\Carbon::now()->addDays(4); // Tanggal 4 hari ke depan
                                        $today = \Carbon\Carbon::now()->format('Y-m-d'); // Tanggal hari ini
                                    @endphp

                                    @foreach ($groupedJadwal as $date => $group)
                                        @php
                                            $carbonDate = \Carbon\Carbon::parse($date);
                                            $isToday = $carbonDate->format('Y-m-d') === $today;
                                        @endphp

                                        @if ($carbonDate >= $startDate && $carbonDate <= $endDate)
                                            <div class="col-md-4 @if ($isToday) ps-4 today shadow @endif mt-3 p-3">
                                                <li class="date">
                                                    <h3>{{ $carbonDate->locale('id')->dayName }}</h3>
                                                    <p>{{ $carbonDate->format('d-m-Y') }}</p>
                                                </li>

                                                <li class="events">
                                                    <ul class="events-detail">
                                                        @php
                                                            $sortedGroup = $group->sortBy(function ($jadwal) {
                                                                return \Carbon\Carbon::parse($jadwal->waktu)->format('H:i');
                                                            });
                                                        @endphp

                                                        @foreach ($sortedGroup as $jadwal)
                                                            <li style="list-style:none;">
                                                                <a href="#">
                                                                    <span class="event-time">{{ date('H:i', strtotime($jadwal->waktu)) }} WIB - </span>
                                                                    <span class="event-name">{{ $jadwal->kegiatan }}</span>
                                                                    <br />
                                                                    <span class="event-location">{{ $jadwal->lokasi }}</span>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
