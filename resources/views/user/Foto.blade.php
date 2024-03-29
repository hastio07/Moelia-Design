@extends('user.layouts.UserScreen')
@section('title', 'Home')

@push('styles')
<link href="{{ asset('templates') }}/assets/css-modif/user/UserGallery.css" rel="stylesheet">
@endpush
@section('konten')
<section>
    <div class="head-gallery text-center align-self-center">
        <h1>Gallery Foto</h1>
        <div class="d-flex justify-content-center">
            {{ Breadcrumbs::render('foto') }}
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div class="row g-2">
            @if ($photos -> isEmpty())
            <div class="container d-flex justify-content-center align-items-center" style="height: 50vh;">
                <div class="text-center">
                    <div class="container">
                        <img src="{{ asset('templates') }}/assets/images/data-kosong.jpg" class="img-fluid" alt="Phone image" style="max-width: 200px; max-height: 200px;">
                    </div>
                    <h5 class="fw-bold text-secondary mt-2">Opss!! Foto Saat Ini Belum Tesedia!!</h5>
                    <a class="btn btn-warning mt-3" href="/"><i class="bi bi-arrow-left me-2"></i> Back To Home</a>
                </div>
            </div>
            @else
            <!--kelompokkan fotoberdasarkan photo_name -->
            @php
            $groupedPhotos = $photos->groupBy('photo_name');
            @endphp
            <!-- Tampilkan foto yang dikelompokkan -->
            @foreach ($groupedPhotos as $photoName => $group)
            <div class="photo-group mb-5">
                <h4 class="text-capitalize text-center fw-bold">{{ $photoName }}</h4>
                <div class="line"></div>
                <div class="row">
                    @foreach ($group as $photo)
                    <div class="col-sm-4">
                        <a data-gallery="photo-gallery" data-toggle="lightbox" href="/storage/{{ $photo->photo_path }}">
                            <img alt="foto-{{ $loop->index }}" class="img-fluid mt-4" height="600" src="/storage/{{ $photo->photo_path }}" width="600">
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach

            @endif
        </div>
        {!! $photos->links('pagination::bootstrap-5') !!}
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
@endpush
