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
                @if (session('success'))
                <div id="success-alert" class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
                @endif
                <h6 class="fw-bold">Account Settings</h6>
                <form method="POST" action="{{ route('user.profile') }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <input type="text" name="nama_depan" class="form-control" placeholder="First name" aria-label="First name" value="{{ $user->nama_depan }}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <input type="text" name="nama_belakang" class="form-control" placeholder="Last name" aria-label="Last name" value="{{ $user->nama_belakang }}">
                        </div>
                    </div>
                    <label for="inputEmail" class="col-form-label mt-2">Email</label>
                    <input type="email" name="email" class="form-control" id="inputEmail" value="{{ $user->email }}">
                    <label for="inputPhone" class="col-form-label mt-2">Phone Number</label>
                    <input type="number" name="phone" class="form-control" id="inputPhone" value="{{ $user->phone }}">
                    <label for="inputPassword" class="col-form-label mt-2">Password</label>
                    <input type="Password" name="phone" class="form-control" id="inputPhone" value="{{ $user->phone }}">
                    <input type="text" hidden value="{{$user->id}}" name="id">
                    <button type="submit" class="btn btn-warning mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection