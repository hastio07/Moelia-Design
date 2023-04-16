@extends('dashboard.user.layouts.UserScreen')
@section('title', 'Detail Item')

@push('styles')
<link href="{{ asset('templates') }}/assets/css-modif/DetailItem.css" rel="stylesheet">
@endpush

@section('konten')
<section class="container details-item d-flex align-items-center">
    <div class="card mx-auto mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="img/cover-2.jpg" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection