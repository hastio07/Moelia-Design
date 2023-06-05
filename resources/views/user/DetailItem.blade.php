@extends('user.layouts.UserScreen')
@section('title', 'Detail Item')

@push('styles')
<link href="{{ asset('templates') }}/assets/css-modif/user/UserDetailProduk.css" rel="stylesheet">
@endpush

@section('konten')
<section class="container p-5 shadow detail-item">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <img alt="{{ $products->slug_produk }}" class="img-fluid rounded-start" src="/storage/post-images/{{ $products->gambar }}">
            </div>
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
                <div class="d-flex align-items-center mt-5 delivery">{{ $products->updated_at->diffForHumans() }}</div>
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
        </div>
    </div>
</section>
@endsection