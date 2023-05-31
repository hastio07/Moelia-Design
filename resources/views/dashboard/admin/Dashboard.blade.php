@extends('dashboard.admin.layouts.layouts')
@section('title', 'Dashboard')
@push('styles')
    <link href="{{ asset('templates') }}/assets/css-modif/admin/AdminDashboard.css" rel="stylesheet">
@endpush

@section('content')
    <div class="dashboard">
        <div class="content-wrapper">
            <div class="row same-height">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-10 mx-auto">
                            <div class="row ">
                                <div class="col-xl-3 col-lg-6">
                                    <div class="card l-bg-cherry">
                                        <div class="card-statistic-3 p-4">
                                            <div class="card-icon card-icon-large"><i class="fas fa-shopping-cart"></i></div>
                                            <div class="mb-4">
                                                <h5 class="card-title mb-0">New Orders</h5>
                                            </div>
                                            <div class="row align-items-center mb-2 d-flex">
                                                <div class="col-8">
                                                    <h2 class="d-flex align-items-center mb-0">
                                                        3,243
                                                    </h2>
                                                </div>
                                                <div class="col-4 text-right">
                                                    <span>12.5% <i class="fa fa-arrow-up"></i></span>
                                                </div>
                                            </div>
                                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                                <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="25" class="progress-bar l-bg-cyan" data-width="25%" role="progressbar" style="width: 25%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6">
                                    <div class="card l-bg-blue-dark">
                                        <div class="card-statistic-3 p-4">
                                            <div class="card-icon card-icon-large"><i class="fas fa-users"></i></div>
                                            <div class="mb-4">
                                                <h5 class="card-title mb-0">Customers</h5>
                                            </div>
                                            <div class="row align-items-center mb-2 d-flex">
                                                <div class="col-8">
                                                    <h2 class="d-flex align-items-center mb-0">
                                                        15.07k
                                                    </h2>
                                                </div>
                                                <div class="col-4 text-right">
                                                    <span>9.23% <i class="fa fa-arrow-up"></i></span>
                                                </div>
                                            </div>
                                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                                <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="25" class="progress-bar l-bg-green" data-width="25%" role="progressbar" style="width: 25%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6">
                                    <div class="card l-bg-green-dark">
                                        <div class="card-statistic-3 p-4">
                                            <div class="card-icon card-icon-large"><i class="fas fa-ticket-alt"></i></div>
                                            <div class="mb-4">
                                                <h5 class="card-title mb-0">Ticket Resolved</h5>
                                            </div>
                                            <div class="row align-items-center mb-2 d-flex">
                                                <div class="col-8">
                                                    <h2 class="d-flex align-items-center mb-0">
                                                        578
                                                    </h2>
                                                </div>
                                                <div class="col-4 text-right">
                                                    <span>10% <i class="fa fa-arrow-up"></i></span>
                                                </div>
                                            </div>
                                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                                <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="25" class="progress-bar l-bg-orange" data-width="25%" role="progressbar" style="width: 25%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6">
                                    <div class="card l-bg-orange-dark">
                                        <div class="card-statistic-3 p-4">
                                            <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                                            <div class="mb-4">
                                                <h5 class="card-title mb-0">Revenue Today</h5>
                                            </div>
                                            <div class="row align-items-center mb-2 d-flex">
                                                <div class="col-8">
                                                    <h2 class="d-flex align-items-center mb-0">
                                                        $11.61k
                                                    </h2>
                                                </div>
                                                <div class="col-4 text-right">
                                                    <span>2.5% <i class="fa fa-arrow-up"></i></span>
                                                </div>
                                            </div>
                                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                                <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="25" class="progress-bar l-bg-cyan" data-width="25%" role="progressbar" style="width: 25%;"></div>
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
            <div class="row same-height">
                <div class="card">
                    <div class="card-body">
                        <div class="event-schedule-area-two bg-color">
                            <div class="row">
                                <div class="col-lg-12">
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
                                            <div class="col-lg-4">
                                                <li class="date">
                                                    <h3>Senin</h3>
                                                    <p>23-01-2024</p>
                                                </li>
                                                <li class="events">
                                                    <ul class="events-detail">
                                                        <li>
                                                            <a href="#">
                                                                <span class="event-time">2:00pm - </span>
                                                                <span class="event-name">Kickoff Ceremony</span>
                                                                <br />
                                                                <span class="event-location">Headquarters</span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#">
                                                                <span class="event-time">2:00pm - </span>
                                                                <span class="event-name">Kickoff Ceremony</span>
                                                                <br />
                                                                <span class="event-location">Headquarters</span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#">
                                                                <span class="event-time">2:00pm - </span>
                                                                <span class="event-name">Kickoff Ceremony</span>
                                                                <br />
                                                                <span class="event-location">Headquarters</span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#">
                                                                <span class="event-time">2:00pm - </span>
                                                                <span class="event-name">Kickoff Ceremony</span>
                                                                <br />
                                                                <span class="event-location">Headquarters</span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#">
                                                                <span class="event-time">2:00pm - </span>
                                                                <span class="event-name">Kickoff Ceremony</span>
                                                                <br />
                                                                <span class="event-location">Headquarters</span>
                                                            </a>
                                                        </li>
                                                    </ul>

                                                </li>
                                            </div>
                                            <div class="col-lg-4">
                                                <li class="date">
                                                    <h3>Selasa</h3>
                                                    <p>24-01-2024</p>
                                                </li>
                                                <li class="events">
                                                    <ul class="events-detail text-capitalize">
                                                        <li>
                                                            <a href="#">
                                                                <span class="event-time">2:00pm - </span>
                                                                <span class="event-name">Kickoff Ceremony</span>
                                                                <br />
                                                                <span class="event-owner">akhbarona</span>
                                                                <br />
                                                                <span class="event-location">jl. purnawirawan</span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#">
                                                                <span class="event-time">2:00pm - </span>
                                                                <span class="event-name">Kickoff Ceremony</span>
                                                                <br />
                                                                <span class="event-location">Headquarters</span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#">
                                                                <span class="event-time">2:00pm - </span>
                                                                <span class="event-name">Kickoff Ceremony</span>
                                                                <br />
                                                                <span class="event-location">Headquarters</span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#">
                                                                <span class="event-time">2:00pm - </span>
                                                                <span class="event-name">Kickoff Ceremony</span>
                                                                <br />
                                                                <span class="event-location">Headquarters</span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#">
                                                                <span class="event-time">2:00pm - </span>
                                                                <span class="event-name">Kickoff Ceremony</span>
                                                                <br />
                                                                <span class="event-location">Headquarters</span>
                                                            </a>
                                                        </li>
                                                    </ul>

                                                </li>
                                            </div>
                                            <div class="col-lg-4">
                                                <li class="date">
                                                    <h3>Rabu</h3>
                                                    <p>25-01-2024</p>
                                                </li>
                                                <li class="events">
                                                    <ul class="events-detail">
                                                        <li>
                                                            <a href="#">
                                                                <span class="event-time">2:00pm - </span>
                                                                <span class="event-name">Kickoff Ceremony</span>
                                                                <br />
                                                                <span class="event-location">Headquarters</span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#">
                                                                <span class="event-time">2:00pm - </span>
                                                                <span class="event-name">Kickoff Ceremony</span>
                                                                <br />
                                                                <span class="event-location">Headquarters</span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#">
                                                                <span class="event-time">2:00pm - </span>
                                                                <span class="event-name">Kickoff Ceremony</span>
                                                                <br />
                                                                <span class="event-location">Headquarters</span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#">
                                                                <span class="event-time">2:00pm - </span>
                                                                <span class="event-name">Kickoff Ceremony</span>
                                                                <br />
                                                                <span class="event-location">Headquarters</span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#">
                                                                <span class="event-time">2:00pm - </span>
                                                                <span class="event-name">Kickoff Ceremony</span>
                                                                <br />
                                                                <span class="event-location">Headquarters</span>
                                                            </a>
                                                        </li>
                                                    </ul>

                                                </li>
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

@endsection
@push('scripts')
@endpush
