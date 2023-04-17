@extends('dashboard.user.layouts.UserScreen')
@section('title', 'Produk')

@push('styles')
<link href="{{ asset('templates') }}/assets/css-modif/Produk.css" rel="stylesheet">
@endpush

@section('konten')
<section>
    <div class="head-product text-center align-self-center">
        <h1>Product</h1>
        <p> Home/Product</p>
    </div>
    <div class="container  py-5">
        <h1 class="text-center">Make Up</h1>
        <div class="line"></div>
        <div class="row row-cols-1 row-cols-md-2 g-4 py-5">
            <div class="col">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="img/cover-2.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body pb-0">
                                <h5 class="card-title">Ervin Howell</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, est?</p>
                                <div class="category d-flex">
                                    <i class="bi bi-calendar-event d-flex me-2">
                                        <p class="ms-1">20/1/2023</p>
                                    </i>
                                    <i class="bi bi-tag-fill ms-2 d-flex">
                                        <p class="ms-1">Make Up</p>
                                    </i>
                                </div>
                            </div>
                            <div class="btn btn ms-3">selengkapnnya</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="img/cover-2.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body pb-0">
                                <h5 class="card-title">Ervin Howell</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, est?</p>
                                <div class="category d-flex">
                                    <i class="bi bi-calendar-event d-flex me-2">
                                        <p class="ms-1">20/1/2023</p>
                                    </i>
                                    <i class="bi bi-tag-fill ms-2 d-flex">
                                        <p class="ms-1">Make Up</p>
                                    </i>
                                </div>
                            </div>
                            <div class="btn btn ms-3">selengkapnnya</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="img/cover-2.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body pb-0">
                                <h5 class="card-title">Ervin Howell</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, est?</p>
                                <div class="category d-flex">
                                    <i class="bi bi-calendar-event d-flex me-2">
                                        <p class="ms-1">20/1/2023</p>
                                    </i>
                                    <i class="bi bi-tag-fill ms-2 d-flex">
                                        <p class="ms-1">Make Up</p>
                                    </i>
                                </div>
                            </div>
                            <div class="btn btn ms-3">selengkapnnya</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="img/cover-2.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body pb-0">
                                <h5 class="card-title">Ervin Howell</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, est?</p>
                                <div class="category d-flex">
                                    <i class="bi bi-calendar-event d-flex me-2">
                                        <p class="ms-1">20/1/2023</p>
                                    </i>
                                    <i class="bi bi-tag-fill ms-2 d-flex">
                                        <p class="ms-1">Make Up</p>
                                    </i>
                                </div>
                            </div>
                            <div class="btn btn ms-3">selengkapnnya</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button class="btn btn" id="load-more">Load More</button>
        </div>
    </div>
</section>
@endsection