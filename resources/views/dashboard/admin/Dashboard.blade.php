@extends('dashboard.admin.layouts.layouts')
@section('title', 'Dashboard')
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
                                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
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
                                            <div class="progress-bar l-bg-green" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
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
                                            <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
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
                                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
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
                    <div class="event-schedule-area-two bg-color pad100">
                        <div class="container">
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
                                </div>
                                <!-- /.col end-->
                            </div>
                            <!-- row end-->
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="nav custom-tab" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active show" id="home-taThursday" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Day 1</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Day 2</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Day 3</a>
                                        </li>
                                        <li class="nav-item d-none d-lg-block">
                                            <a class="nav-link" id="sunday-tab" data-toggle="tab" href="#sunday" role="tab" aria-controls="sunday" aria-selected="false">Day 4</a>
                                        </li>
                                        <li class="nav-item mr-0 d-none d-lg-block">
                                            <a class="nav-link" id="monday-tab" data-toggle="tab" href="#monday" role="tab" aria-controls="monday" aria-selected="false">Day 5</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade active show" id="home" role="tabpanel">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" scope="col">Date</th>
                                                            <th scope="col">Speakers</th>
                                                            <th scope="col">Session</th>
                                                            <th scope="col">Venue</th>
                                                            <th class="text-center" scope="col">Venue</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="inner-box">
                                                            <th scope="row">
                                                                <div class="event-date">
                                                                    <span>16</span>
                                                                    <p>Novembar</p>
                                                                </div>
                                                            </th>
                                                            <td>
                                                                <div class="event-img">
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="event-wrap">
                                                                    <h3><a href="#">Harman Kardon</a></h3>
                                                                    <div class="meta">
                                                                        <div class="organizers">
                                                                            <a href="#">Aslan Lingker</a>
                                                                        </div>
                                                                        <div class="categories">
                                                                            <a href="#">Inspire</a>
                                                                        </div>
                                                                        <div class="time">
                                                                            <span>05:35 AM - 08:00 AM 2h 25'</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="r-no">
                                                                    <span>Room B3</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="primary-btn">
                                                                    <a class="btn btn-primary" href="#">Read More</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="inner-box">
                                                            <th scope="row">
                                                                <div class="event-date">
                                                                    <span>20</span>
                                                                    <p>Novembar</p>
                                                                </div>
                                                            </th>
                                                            <td>
                                                                <div class="event-img">
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="event-wrap">
                                                                    <h3><a href="#">Toni Duggan</a></h3>
                                                                    <div class="meta">
                                                                        <div class="organizers">
                                                                            <a href="#">Aslan Lingker</a>
                                                                        </div>
                                                                        <div class="categories">
                                                                            <a href="#">Inspire</a>
                                                                        </div>
                                                                        <div class="time">
                                                                            <span>05:35 AM - 08:00 AM 2h 25'</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="r-no">
                                                                    <span>Room D3</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="primary-btn">
                                                                    <a class="btn btn-primary" href="#">Read More</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="inner-box border-bottom-0">
                                                            <th scope="row">
                                                                <div class="event-date">
                                                                    <span>18</span>
                                                                    <p>Novembar</p>
                                                                </div>
                                                            </th>
                                                            <td>
                                                                <div class="event-img">
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="event-wrap">
                                                                    <h3><a href="#">Billal Hossain</a></h3>
                                                                    <div class="meta">
                                                                        <div class="organizers">
                                                                            <a href="#">Aslan Lingker</a>
                                                                        </div>
                                                                        <div class="categories">
                                                                            <a href="#">Inspire</a>
                                                                        </div>
                                                                        <div class="time">
                                                                            <span>05:35 AM - 08:00 AM 2h 25'</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="r-no">
                                                                    <span>Room A3</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="primary-btn">
                                                                    <a class="btn btn-primary" href="#">Read More</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Speakers</th>
                                                            <th scope="col">Session</th>
                                                            <th scope="col">Venue</th>
                                                            <th scope="col">Venue</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="inner-box">
                                                            <th scope="row">
                                                                <div class="event-date">
                                                                    <span>16</span>
                                                                    <p>Novembar</p>
                                                                </div>
                                                            </th>
                                                            <td>
                                                                <div class="event-img">
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="event-wrap">
                                                                    <h3><a href="#">Toni Duggan</a></h3>
                                                                    <div class="meta">
                                                                        <div class="organizers">
                                                                            <a href="#">Aslan Lingker</a>
                                                                        </div>
                                                                        <div class="categories">
                                                                            <a href="#">Inspire</a>
                                                                        </div>
                                                                        <div class="time">
                                                                            <span>05:35 AM - 08:00 AM 2h 25'</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="r-no">
                                                                    <span>Room B3</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="primary-btn">
                                                                    <a class="btn btn-primary" href="#">Read More</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="inner-box">
                                                            <th scope="row">
                                                                <div class="event-date">
                                                                    <span>16</span>
                                                                    <p>Novembar</p>
                                                                </div>
                                                            </th>
                                                            <td>
                                                                <div class="event-img">
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="event-wrap">
                                                                    <h3><a href="#">Harman Kardon</a></h3>
                                                                    <div class="meta">
                                                                        <div class="organizers">
                                                                            <a href="#">Aslan Lingker</a>
                                                                        </div>
                                                                        <div class="categories">
                                                                            <a href="#">Inspire</a>
                                                                        </div>
                                                                        <div class="time">
                                                                            <span>05:35 AM - 08:00 AM 2h 25'</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="r-no">
                                                                    <span>Room B3</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="primary-btn">
                                                                    <a class="btn btn-primary" href="#">Read More</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="inner-box border-bottom-0">
                                                            <th scope="row">
                                                                <div class="event-date">
                                                                    <span>16</span>
                                                                    <p>Novembar</p>
                                                                </div>
                                                            </th>
                                                            <td>
                                                                <div class="event-img">
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="event-wrap">
                                                                    <h3><a href="#">Billal Hossain</a></h3>
                                                                    <div class="meta">
                                                                        <div class="organizers">
                                                                            <a href="#">Aslan Lingker</a>
                                                                        </div>
                                                                        <div class="categories">
                                                                            <a href="#">Inspire</a>
                                                                        </div>
                                                                        <div class="time">
                                                                            <span>05:35 AM - 08:00 AM 2h 25'</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="r-no">
                                                                    <span>Room B3</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="primary-btn">
                                                                    <a class="btn btn-primary" href="#">Read More</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Speakers</th>
                                                            <th scope="col">Session</th>
                                                            <th scope="col">Venue</th>
                                                            <th scope="col">Venue</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="inner-box">
                                                            <th scope="row">
                                                                <div class="event-date">
                                                                    <span>16</span>
                                                                    <p>Novembar</p>
                                                                </div>
                                                            </th>
                                                            <td>
                                                                <div class="event-img">
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="event-wrap">
                                                                    <h3><a href="#">Harman Kardon</a></h3>
                                                                    <div class="meta">
                                                                        <div class="organizers">
                                                                            <a href="#">Aslan Lingker</a>
                                                                        </div>
                                                                        <div class="categories">
                                                                            <a href="#">Inspire</a>
                                                                        </div>
                                                                        <div class="time">
                                                                            <span>05:35 AM - 08:00 AM 2h 25'</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="r-no">
                                                                    <span>Room B3</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="primary-btn">
                                                                    <a class="btn btn-primary" href="#">Read More</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="inner-box">
                                                            <th scope="row">
                                                                <div class="event-date">
                                                                    <span>16</span>
                                                                    <p>Novembar</p>
                                                                </div>
                                                            </th>
                                                            <td>
                                                                <div class="event-img">
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="event-wrap">
                                                                    <h3><a href="#">Billal Hossain</a></h3>
                                                                    <div class="meta">
                                                                        <div class="organizers">
                                                                            <a href="#">Aslan Lingker</a>
                                                                        </div>
                                                                        <div class="categories">
                                                                            <a href="#">Inspire</a>
                                                                        </div>
                                                                        <div class="time">
                                                                            <span>05:35 AM - 08:00 AM 2h 25'</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="r-no">
                                                                    <span>Room B3</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="primary-btn">
                                                                    <a class="btn btn-primary" href="#">Read More</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="inner-box border-bottom-0">
                                                            <th scope="row">
                                                                <div class="event-date">
                                                                    <span>16</span>
                                                                    <p>Novembar</p>
                                                                </div>
                                                            </th>
                                                            <td>
                                                                <div class="event-img">
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="event-wrap">
                                                                    <h3><a href="#">Toni Duggan</a></h3>
                                                                    <div class="meta">
                                                                        <div class="organizers">
                                                                            <a href="#">Aslan Lingker</a>
                                                                        </div>
                                                                        <div class="categories">
                                                                            <a href="#">Inspire</a>
                                                                        </div>
                                                                        <div class="time">
                                                                            <span>05:35 AM - 08:00 AM 2h 25'</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="r-no">
                                                                    <span>Room B3</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="primary-btn">
                                                                    <a class="btn btn-primary" href="#">Read More</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="sunday" role="tabpanel" aria-labelledby="sunday-tab">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Speakers</th>
                                                            <th scope="col">Session</th>
                                                            <th scope="col">Venue</th>
                                                            <th scope="col">Venue</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="inner-box">
                                                            <th scope="row">
                                                                <div class="event-date">
                                                                    <span>16</span>
                                                                    <p>Novembar</p>
                                                                </div>
                                                            </th>
                                                            <td>
                                                                <div class="event-img">
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="event-wrap">
                                                                    <h3><a href="#">Toni Duggan</a></h3>
                                                                    <div class="meta">
                                                                        <div class="organizers">
                                                                            <a href="#">Aslan Lingker</a>
                                                                        </div>
                                                                        <div class="categories">
                                                                            <a href="#">Inspire</a>
                                                                        </div>
                                                                        <div class="time">
                                                                            <span>05:35 AM - 08:00 AM 2h 25'</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="r-no">
                                                                    <span>Room B3</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="primary-btn">
                                                                    <a class="btn btn-primary" href="#">Read More</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="inner-box">
                                                            <th scope="row">
                                                                <div class="event-date">
                                                                    <span>16</span>
                                                                    <p>Novembar</p>
                                                                </div>
                                                            </th>
                                                            <td>
                                                                <div class="event-img">
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="event-wrap">
                                                                    <h3><a href="#">Harman Kardon</a></h3>
                                                                    <div class="meta">
                                                                        <div class="organizers">
                                                                            <a href="#">Aslan Lingker</a>
                                                                        </div>
                                                                        <div class="categories">
                                                                            <a href="#">Inspire</a>
                                                                        </div>
                                                                        <div class="time">
                                                                            <span>05:35 AM - 08:00 AM 2h 25'</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="r-no">
                                                                    <span>Room B3</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="primary-btn">
                                                                    <a class="btn btn-primary" href="#">Read More</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="inner-box border-bottom-0">
                                                            <th scope="row">
                                                                <div class="event-date">
                                                                    <span>16</span>
                                                                    <p>Novembar</p>
                                                                </div>
                                                            </th>
                                                            <td>
                                                                <div class="event-img">
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="event-wrap">
                                                                    <h3><a href="#">Billal Hossain</a></h3>
                                                                    <div class="meta">
                                                                        <div class="organizers">
                                                                            <a href="#">Aslan Lingker</a>
                                                                        </div>
                                                                        <div class="categories">
                                                                            <a href="#">Inspire</a>
                                                                        </div>
                                                                        <div class="time">
                                                                            <span>05:35 AM - 08:00 AM 2h 25'</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="r-no">
                                                                    <span>Room B3</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="primary-btn">
                                                                    <a class="btn btn-primary" href="#">Read More</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="monday" role="tabpanel" aria-labelledby="monday-tab">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Speakers</th>
                                                            <th scope="col">Session</th>
                                                            <th scope="col">Venue</th>
                                                            <th scope="col">Venue</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="inner-box">
                                                            <th scope="row">
                                                                <div class="event-date">
                                                                    <span>16</span>
                                                                    <p>Novembar</p>
                                                                </div>
                                                            </th>
                                                            <td>
                                                                <div class="event-img">
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="event-wrap">
                                                                    <h3><a href="#">Harman Kardon</a></h3>
                                                                    <div class="meta">
                                                                        <div class="organizers">
                                                                            <a href="#">Aslan Lingker</a>
                                                                        </div>
                                                                        <div class="categories">
                                                                            <a href="#">Inspire</a>
                                                                        </div>
                                                                        <div class="time">
                                                                            <span>05:35 AM - 08:00 AM 2h 25'</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="r-no">
                                                                    <span>Room B3</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="primary-btn">
                                                                    <a class="btn btn-primary" href="#">Read More</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="inner-box">
                                                            <th scope="row">
                                                                <div class="event-date">
                                                                    <span>18</span>
                                                                    <p>Novembar</p>
                                                                </div>
                                                            </th>
                                                            <td>
                                                                <div class="event-img">
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="event-wrap">
                                                                    <h3><a href="#">Toni Duggan</a></h3>
                                                                    <div class="meta">
                                                                        <div class="organizers">
                                                                            <a href="#">Aslan Lingker</a>
                                                                        </div>
                                                                        <div class="categories">
                                                                            <a href="#">Inspire</a>
                                                                        </div>
                                                                        <div class="time">
                                                                            <span>05:35 AM - 08:00 AM 2h 25'</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="r-no">
                                                                    <span>Room B3</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="primary-btn">
                                                                    <a class="btn btn-primary" href="#">Read More</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="inner-box border-bottom-0">
                                                            <th scope="row">
                                                                <div class="event-date">
                                                                    <span>20</span>
                                                                    <p>Novembar</p>
                                                                </div>
                                                            </th>
                                                            <td>
                                                                <div class="event-img">
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="event-wrap">
                                                                    <h3><a href="#">Billal Hossain</a></h3>
                                                                    <div class="meta">
                                                                        <div class="organizers">
                                                                            <a href="#">Aslan Lingker</a>
                                                                        </div>
                                                                        <div class="categories">
                                                                            <a href="#">Inspire</a>
                                                                        </div>
                                                                        <div class="time">
                                                                            <span>05:35 AM - 08:00 AM 2h 25'</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="r-no">
                                                                    <span>Room B3</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="primary-btn">
                                                                    <a class="btn btn-primary" href="#">Read More</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /col end-->
                            </div>
                            <!-- /row end-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection