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
                @if (!empty($photos))
                    @foreach ($photos as $key => $value)
                        <div class="col-sm-4">
                            <a data-gallery="photo-gallery" data-toggle="lightbox" href="/storage/{{ $value->photo_path }}">
                                <img alt="foto-{{ $key }}" class="img-fluid" height="600" src="/storage/{{ $value->photo_path }}" width="600">
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="text-center">
                        <h2>Foto Tidak ada</h2>
                    </div>
                @endif
            </div>
            {!! $photos->links('pagination::bootstrap-5') !!}
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
@endpush
