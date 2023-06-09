@extends('user.layouts.UserScreen')
@section('title', 'Gallery Vidio')

@push('styles')
<link href="{{ asset('templates') }}/assets/css-modif/user/UserGallery.css" rel="stylesheet">
@endpush
@section('konten')
<section>
    <div class="head-gallery text-center align-self-center">
        <h1>Gallery Vidio</h1>
        <div class="d-flex justify-content-center">
            {{ Breadcrumbs::render('vidio') }}
        </div>
    </div>
    <div class="container gallery mt-5 mb-5">
        <div class="row">
            @if($videos->isEmpty())
            <div class="container d-flex justify-content-center align-items-center" style="height: 50vh;">
                <div class="text-center">
                    <h5 class="fw-bold text-secondary">Opss!! Vidio Saat Ini Belum Tesedia!!</h5>
                    <a class="btn btn-warning mt-3" href="/"><i class="bi bi-arrow-left me-2"></i> Back To Home</a>
                </div>
            </div>
            @else
            @foreach ($videos as $value)
            <a class="col-sm-3 mb-4" data-gallery="youtubevideos" data-toggle="lightbox" href="{{ $value->video_path }}">
                <img alt="{{ $value->video_name }}" class="img-fluid" src="{{ $value->video_thumbnail }}">
            </a>
            @endforeach
            @endif
        </div>
        {!! $videos->links('pagination::bootstrap-5') !!}
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
@endpush
