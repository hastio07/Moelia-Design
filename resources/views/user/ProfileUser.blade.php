@extends('user.layouts.UserScreen')
@section('title', 'Produk')

@push('styles')
    <link href="{{ asset('templates') }}/assets/css-modif/user/UserProduk.css" rel="stylesheet">
@endpush

@section('konten')
    <div class="d-flex justify-content-center align-items-center container" style="margin-top: 120px; height:90vh;">
        <div class="row d-flex justify-content-center align-items-center p-4 shadow">
            <div class="col-md-5">
                <div class="content rounded-5 border-5 d-flex align-items-center mt-3 p-3 shadow">
                    <div class="people-wraper me-3">
                        <i class="bi bi-person-vcard-fill fs-1"></i>
                    </div>
                    <div class="namemail">
                        <h6 class="fw-bold text-capitalize mb-0">{{ $user->nama_depan }} {{ $user->nama_belakang }}</h6>
                        <p class="text-muted mb-0">{{ $user->email }}</p>
                    </div>
                </div>
                <div class="bio rounded-5 border-5 mt-3 p-3 shadow">
                    <div class="row text-capitalize">
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
            <div class="col-md-7 mt-3">
                <div class="content rounded-5 border-5 p-3 shadow">
                    @if (session('success'))
                        <div class="alert alert-success text-center" id="success-alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session()->has('status'))
                        <div class="alert alert-danger">{{ session('status') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="pt-3">
                            <div class="alert alert-danger">
                                <ul class="pt=10" style="list-style:none;">
                                    @foreach ($errors->all() as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    <h6 class="fw-bold">Account Settings</h6>
                    <form action="{{ route('user-profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <input aria-label="First name" class="form-control" name="nama_depan" placeholder="First name" type="text" value="{{ $user->nama_depan }}">
                            </div>
                            <div class="col-md-6 mt-2">
                                <input aria-label="Last name" class="form-control" name="nama_belakang" placeholder="Last name" type="text" value="{{ $user->nama_belakang }}">
                            </div>
                        </div>
                        <label class="col-form-label mt-2" for="inputEmail">Email</label>
                        <input class="form-control" id="inputEmail" name="email" type="email" value="{{ $user->email }}">
                        <label class="col-form-label mt-2" for="inputPhone">Phone Number</label>
                        <input class="form-control" id="inputPhone" name="phone" type="phone" value="{{ $user->phone }}">
                        <div class="input-group d-flex justify-content-center align-items-center">
                            <div class="row">
                                <div class="col-sm-6 mt-1">
                                    <label class="col-form-label" for="inputPassword1">Password Lama</label>
                                    <input class="form-control border-1 me-2 rounded" id="inputPassword1" name="old_password" type="password">
                                </div>
                                <div class="col-sm-6 mt-1">
                                    <label class="col-form-label" for="inputPassword2">Password Baru</label>
                                    <input class="form-control border-1 rounded" id="inputPassword2" name="new_password" type="password">
                                </div>
                            </div>
                        </div>
                        <input hidden name="id" type="text" value="{{ $user->id }}">
                        <button class="btn btn-warning mt-3" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
