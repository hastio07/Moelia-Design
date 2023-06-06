@extends('user.layouts.UserScreen')
@section('title', 'Produk')

@push('styles')
<link href="{{ asset('templates') }}/assets/css-modif/user/UserProduk.css" rel="stylesheet">
@endpush

@section('konten')
<section style="padding-top: 80px;">
    <div class="container">
        <div class="row height d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="form">
                    <i class="fa fa-search"></i>
                    <input type="text" class="form-control form-input" placeholder="Search anything...">
                    <span class="left-pan"><i class="fa fa-microphone"></i></span>
                </div>

            </div>

        </div>

    </div>
    <nav class="navbar navbar-expand-lg container mt-4">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                {{ Breadcrumbs::render('produk') }}
            </nav>
            <div class="navbar-nav ml-auto">
                <div class="btn-group shadow-0">
                    <button class="btn btn-link btn-lg dropdown-toggle" type="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-funnel-fill"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="#">Separated link</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container shadow pt-2 pb-5">
        <div class="row justify-content-center mb-3">
            @foreach ($products as $key => $value)
            <div class="col-md-12 col-xl-10">
                <div class="card shadow border-0 rounded-3 mt-3" data-aos="fade-right">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                    <img src="storage/post-images/{{ $value->gambar }}" class="w-100" alt="produk-{{ $key }}" />
                                    <a href={{ route('produk.show', $value->id) }}>
                                        <div class="hover-overlay">
                                            <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <a class="text-dark" href={{ route('produk.show', $value->id) }}>
                                    <h5>{{ Str::words($value->nama_produk) }}</h5>
                                </a>
                                <div class="d-flex flex-row kategori">
                                    <i class="bi bi-calendar-event-fill d-flex me-2">
                                        <p class="ms-1">{{ $value->created_at->format('d/m/y') }}</p>
                                    </i>
                                    <i class="bi bi-bookmark-fill ms-2 d-flex">
                                        <p class="ms-1">{{ Str::words($value->category_products->nama_kategori) }}</p>
                                    </i>
                                </div>
                                <div class="mb-0 text-muted small d-flex time">
                                    <i class="bi bi-clock-history me-1"></i>
                                    <p>
                                        {{ $value->updated_at->diffForHumans() }}
                                    </p>
                                </div>
                                <p class="mb-4 mb-md-0 h-100">
                                    {!! Str::words($value->deskripsi, 20) !!}
                                </p>
                            </div>
                            <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                <div class="d-flex text-success harga">
                                    <i class="bi bi-tags-fill me-1"></i>
                                    <h6 class="fw-bold">Harga Sewa</h6>
                                </div>
                                <div class="align-items-center mb-1">
                                    <h4 class="mb-1 me-1">{{$value->formatRupiah('harga_sewa')}}</h4>
                                </div>
                                <div class="d-flex flex-column mt-4">
                                    <a class="btn btn-primary btn-sm button-product" href={{ route('produk.show', $value->id) }}>Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="px-5 pt-4 text-center">
                {!! $products->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</section>
@endsection