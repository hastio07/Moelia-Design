@extends('user.layouts.UserScreen')
@section('title', 'Produk')

@push('styles')
<link href="{{ asset('templates') }}/assets/css-modif/user/UserProduk.css" rel="stylesheet">
@endpush

@section('konten')
<div class="container d-flex justify-content-center align-items-center" style="margin-top: 70px; height:90vh;">
    <div class="row shadow p-4 d-flex justify-content-center align-items-center">
        <div class="col-md-5">
            <div class="content shadow rounded-5 border-5 p-3 mt-3 d-flex align-items-center">
                <div class="people-wraper me-3">
                    <i class="bi bi-person-vcard-fill fs-1"></i>
                </div>
                <div class="namemail">
                    <h6 class="fw-bold mb-0  text-capitalize">{{ $user->nama_depan }} {{ $user->nama_belakang }}</h6>
                    <p class="text-muted mb-0">{{ $user->email }}</p>
                </div>
            </div>

            <div class="bio shadow rounded-5 border-5 p-3 mt-3">
                <div class="row  text-capitalize">
                    <div class="col-md-6">
                        <p class="fw-bold mb-0">Nama Depan</p>
                        <p>{{ $user->nama_depan }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="fw-bold mb-0">Nama Belakang</p>
                        <p class="text-muted">{{ $user->nama_belakang }}</p>
                    </div>
                </div>
                <p class="fw-bold mb-0">Email</p>
                <p class="text-muted">{{ $user->email }}</p>
                <p class="fw-bold mb-0">No. Handphone</p>
                <p class="text-muted">{{ $user->phone }}</p>
            </div>
        </div>
        <div class="col-md-7">
            <div class="content shadow rounded-5 border-5 p-3">
                <h6 class="fw-bold">Account Settings</h6>
                <div class="row">
                    <div class="col-md-6 mt-2">
                        <input type="text" class="form-control" placeholder="First name" aria-label="First name" value="{{ $user->nama_depan }}">
                    </div>
                    <div class="col-md-6 mt-2">
                        <input type="text" class="form-control" placeholder="Last name" aria-label="Last name" value="{{ $user->nama_belakang }}">
                    </div>
                </div>
                <label for="inputEmail" class="col-form-label mt-2">Email</label>
                <input type="email" class="form-control" id="inputEmail" value="{{ $user->email }}">
                <label for="inputPhone" class="col-form-label mt-2">Phone Number</label>
                <input type="number" class="form-control" id="inputPhone" value="{{ $user->phone }}">
                <button class="btn btn-warning mt-3">Submit</button>
                <button class="btn btn-info">Ubah Password</button>
            </div>
        </div>
    </div>
</div>

@endsection