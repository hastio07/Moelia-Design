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
                <form action="{{ route('produk.search') }}" method="GET" class="d-flex p-1 rounded-3 border shadow">
                    <input type="text" class="form-control form-input bg-transparent border-0 btn-outline-info" name="searchInput" placeholder="Cari produk, kategori, atau harga...">
                    <button type="submit" class="btn bg-transparent ms-1 shadow-0"><i class="bi bi-search fs-6"></i></button>
                </form>
            </div>
        </div>
    </div>
    <div class=" container product-wraper shadow">
        <nav class="navbar navbar-expand-lg container mt-4 shadow-0 border-bottom">
            <div class="container-fluid">
                <nav aria-label="breadcrumb">
                    {{ Breadcrumbs::render('produk') }}
                </nav>
                <div class="navbar-nav ml-auto">
                    <div class="dropdown">
                        <a href="{{ route('dashboard') }}" class="btn btn-link btn-lg dropdown-toggle text-secondary" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-funnel-fill"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('produk.sort', 'harga-tertinggi') }}"><i class="bi bi-arrow-up"></i> Harga Tertinggi</a></li>
                            <li><a class="dropdown-item" href="{{ route('produk.sort', 'harga-terendah') }}"><i class="bi bi-arrow-down"></i> Harga Terendah</a></li>
                            <li><a class="dropdown-item" href="{{ route('produk.sort', 'kategori') }}"><i class="bi bi-bookmark"></i> Kategori</a></li>
                            <li><a class="dropdown-item" href="{{ route('produk.sort', 'tanggal') }}"><i class="bi bi-calendar-event"></i> Tanggal</a></li>

                        </ul>
                    </div>
                </div>
            </div>

        </nav>
        <div class="pt-2 pb-5">
            <div class="row justify-content-center mb-3" id="cardContainer">
                @if ($products->isEmpty())
                <div class="container d-flex justify-content-center align-items-center" style="height: 50vh;">
                    <div class="text-center">
                        <div class="container">
                            <img src="{{ asset('templates') }}/assets/images/data-kosong.jpg" class="img-fluid" alt="Phone image" style="max-width: 200px; max-height: 200px;">
                        </div>
                        <h5 class="fw-bold text-secondary mt-2">Opss!! Produk Saat Ini Belum Tesedia!!</h5>
                        <a class="btn btn-warning mt-3" href="/"><i class="bi bi-arrow-left me-2"></i> Back To Home</a>
                    </div>
                </div>
                @else
                @foreach ($products as $key => $value)
                <div class="col-md-12 col-xl-10">
                    <div class="card shadow border-0 rounded-3 mt-3" data-aos="fade-right">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                    <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                        <img src="{{ asset('storage/post-images/' . $value->gambar) }}" class="w-100" alt="produk-{{ $key }}" />
                                        <a href={{ route('produk.show', $value->id) }}>
                                            <div class="hover-overlay">
                                                <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <a class="text-dark" href={{ route('produk.show', $value->id) }}>
                                        <h5 class="text-capitalize">{{ Str::words($value->nama_produk) }}</h5>
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
                                    <p class="mb-4 mb-md-0 h-100" style="text-align: justify;">
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
                @endif
                <div class="px-5 pt-4 text-center">
                    {!! $products->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
</section>
@section('scripts')
<script>
    function searchProducts() {
        var input, filter, cards, cardContainer, title, category, price, i;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        cardContainer = document.getElementById("cardContainer");
        cards = cardContainer.getElementsByClassName("card");

        for (i = 0; i < cards.length; i++) {
            title = cards[i].querySelector(".card-body h5.text-capitalize");
            category = cards[i].querySelector(".card-body .kategori p");
            price = cards[i].querySelector(".card-body .harga h4");

            var titleText = title.innerText.toUpperCase();
            var categoryText = category.innerText.toUpperCase();
            var priceText = price.innerText.toUpperCase().replace(/[^0-9.]/g, '');

            if (titleText.includes(filter) || categoryText.includes(filter) || priceText.includes(filter)) {
                cards[i].style.display = "";
            } else {
                cards[i].style.display = "none";
            }
        }
    }

    var searchInput = document.getElementById("searchInput");
    searchInput.addEventListener("input", function() {
        searchProducts();
    });
</script>
@endsection


@endsection