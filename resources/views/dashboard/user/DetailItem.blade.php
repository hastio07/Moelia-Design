@extends('dashboard.user.layouts.UserScreen')
@section('title', 'Detail Item')

@push('styles')
    <link href="{{ asset('templates') }}/assets/css-modif/user/UserDetailProduk.css" rel="stylesheet">
@endpush

@section('konten')
    <section class="container details-item d-flex align-items-center">
        <div class="card mx-auto mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img alt="{{ $products->slug_produk }}" class="img-fluid rounded-start" src="/storage/post-images/{{ $products->gambar }}">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $products->nama_produk }}</h5>
                        <p class="card-text">{!! $products->deskripsi !!}</p>
                        <p class="card-text">{!! $products->rincian_produk !!}</p>
                        <p class="card-text"><small class="text-muted">{{ $products->updated_at->diffForHumans() }}</small></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
