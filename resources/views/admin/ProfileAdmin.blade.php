@extends('admin.layouts.layouts')
@section('title', 'Profile')

@section('content')
<div class="container card mb-4 p-4">
    <h5 class="fw-bold ms-3">Pengaturan Akun</h5>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3">
                <p class="mb-0">Nama Depan</p>
            </div>
            <div class="col-lg-8">
                <p class="text-muted mb-0">Johnatan Smith</p>
            </div>
            <div class="col-lg-1">
                <button class="btn shadow-0"><i class="bi bi-pencil"></i></button>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-3">
                <p class="mb-0">Nama Belakang</p>
            </div>
            <div class="col-lg-8">
                <p class="text-muted mb-0">Johnatan Smith</p>
            </div>
            <div class="col-lg-1">
                <button class="btn shadow-0"><i class="bi bi-pencil"></i></button>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-3">
                <p class="mb-0">Email</p>
            </div>
            <div class="col-lg-8">
                <p class="text-muted mb-0">example@example.com</p>
            </div>
            <div class="col-lg-1">
                <button class="btn shadow-0"><i class="bi bi-pencil"></i></button>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-3">
                <p class="mb-0">No. Handphone</p>
            </div>
            <div class="col-lg-8">
                <p class="text-muted mb-0">082376545678</p>
            </div>
            <div class="col-lg-1">
                <button class="btn shadow-0"><i class="bi bi-pencil"></i></button>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-3">
                <p class="mb-0">Password</p>
            </div>
            <div class="col-lg-8">
                <p class="text-muted mb-0">**********</p>
            </div>
            <div class="col-lg-1">
                <button class="btn shadow-0"><i class="bi bi-pencil"></i></button>
            </div>
        </div>
    </div>
</div>
</div>
@endsection