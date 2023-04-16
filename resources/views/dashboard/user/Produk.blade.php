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
                            <div class="card-body">
                                <h5 class="card-title">Ervin Howell</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, est?</p>
                            </div>
                            <div class="btn btn-primary ms-3 mt-3">selengkapnnya</div>
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
                            <div class="card-body">
                                <h5 class="card-title">Ervin Howell</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, est?</p>
                            </div>
                            <div class="btn btn-primary ms-3 mt-3">selengkapnnya</div>
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
                            <div class="card-body">
                                <h5 class="card-title">Ervin Howell</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, est?</p>
                            </div>
                            <div class="btn btn-primary ms-3 mt-3">selengkapnnya</div>
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
                            <div class="card-body">
                                <h5 class="card-title">Ervin Howell</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, est?</p>
                            </div>
                            <div class="btn btn-primary ms-3 mt-3">selengkapnnya</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection