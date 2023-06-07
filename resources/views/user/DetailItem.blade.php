@extends('user.layouts.UserScreen')
@section('title', 'Detail Item')

@push('styles')
<link href="{{ asset('templates') }}/assets/css-modif/user/UserDetailProduk.css" rel="stylesheet">
@endpush

@section('konten')
<section class="container p-5 shadow detail-item">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7">
                <h4>{{ $products->nama_produk }}</h4>
                <div class="price text-success fw-bold mt-4"><i class="bi bi-tags-fill me-1"></i>{{$products->formatRupiah('harga_sewa')}}</div>
                <div class="flex-row mt-4">
                    <h5 class="fw-bold">Deskripsi Produk</h5>
                    {!! $products->deskripsi !!}
                </div>
                <div class="align-items-center mt-4 offers mb-1">
                    <h6 class="fw-bold">Rician Produk</h6>
                    <p>{!! $products->rincian_produk !!}</p>
                </div>
                <div class="d-flex align-items-center mt-5 delivery">
                    <div class="d-flex">
                        <i class="bi bi-clock-history me-2"></i>
                        <p>{{ $products->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
                <hr>
                <div class="d-flex flex-row kategori">
                    <i class="bi bi-calendar-event-fill d-flex me-2">
                        <p class="ms-1">{{ $products->created_at->format('d/m/y') }}</p>
                    </i>
                    <i class="bi bi-bookmark-fill ms-2 d-flex">
                        <p class="ms-1">{{ Str::words($products->category_products->nama_kategori) }}</p>
                    </i>
                </div>
            </div>
            <div class="col-md-5">
                <img alt="{{ $products->slug_produk }}" class="img-fluid rounded" src="/storage/post-images/{{ $products->gambar }}">
                <div class="row mt-1 photo-product">
                    <div class="col-lg-4 col-md-4 col-sm-6 mt-2 px-2">
                        <a data-gallery="photo-gallery" data-toggle="lightbox" href="/storage/post-images/{{ $products->gambar }}">
                            <img alt="{{ $products->slug_produk }}" class="img-fluid rounded" height="600" src="/storage/post-images/{{ $products->gambar }}" width="600">
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 mt-2 px-2">
                        <a data-gallery="photo-gallery" data-toggle="lightbox" href="/storage/post-images/{{ $products->gambar }}">
                            <img alt="{{ $products->slug_produk }}" class="img-fluid rounded" height="600" src="/storage/post-images/{{ $products->gambar }}" width="600">
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 mt-2 px-2">
                        <a data-gallery="photo-gallery" data-toggle="lightbox" href="/storage/post-images/{{ $products->gambar }}">
                            <img alt="{{ $products->slug_produk }}" class="img-fluid rounded" height="600" src="/storage/post-images/{{ $products->gambar }}" width="600">
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
@endpush

@endsection