@extends('dashboard.user.layouts.UserScreen')
@section('title', 'Gallery Vidio')

@push('styles')
    <link href="{{ asset('templates') }}/assets/css-modif/Home-Gallery.css" rel="stylesheet">
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
                @foreach ($videos as $value)
                    <a class="col-sm-3 mb-4" data-gallery="youtubevideos" data-toggle="lightbox" href="https://youtu.be/{{ $value->video_path }}">
                        <img alt="{{ $value->video_name }}" class="img-fluid" src="{{ $value->video_thumbnail }}">
                    </a>
                @endforeach
                {{-- <a href="https://youtu.be/iQ4D273C7Ac?start=30" data-toggle="lightbox" data-gallery="youtubevideos" class="col-sm-3 mb-4">
                <img src="https://i1.ytimg.com/vi/iQ4D273C7Ac/mqdefault.jpg" class="img-fluid">
            </a>
            <a href="//www.youtube.com/embed/dQw4w9WgXcQ" data-toggle="lightbox" data-gallery="youtubevideos" class="col-sm-3 mb-4">
                <img src="https://i1.ytimg.com/vi/dQw4w9WgXcQ/mqdefault.jpg" class="img-fluid">
            </a>
            <a href="//www.youtube.com/embed/dQw4w9WgXcQ" data-toggle="lightbox" data-gallery="youtubevideos" class="col-sm-3 mb-4">
                <img src="https://i1.ytimg.com/vi/dQw4w9WgXcQ/mqdefault.jpg" class="img-fluid">
            </a>
            <a href="//www.youtube.com/embed/dQw4w9WgXcQ" data-toggle="lightbox" data-gallery="youtubevideos" class="col-sm-3 mb-4">
                <img src="https://i1.ytimg.com/vi/dQw4w9WgXcQ/mqdefault.jpg" class="img-fluid">
            </a> --}}
            </div>
            {!! $videos->links('pagination::bootstrap-5') !!}
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
@endpush
