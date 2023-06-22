@extends('authenticate.layouts.layouts')

@section('content')
    <section class="h-100 container">
        <div class="row justify-content-sm-center h-100 align-items-center">
            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-8">
                <div class="card shadow-lg">
                    <div class="card-body p-4">
                        <h1 class="fs-4 fw-bold mb-3 text-center">Register</h1>
                        <div class="back">
                            <a href="/login">
                                <i class="bi bi-arrow-left fs-4"></i>
                            </a>
                        </div>
                        <img alt="Phone image" class="img-fluid" src="{{ asset('templates') }}/assets/images/register.jpg">
                        {{-- @if ($errors->any())
                            <div class="pt-3">
                                <div class="alert alert-danger">
                                    <ul class="pt=10" style="list-style:none;">
                                        @foreach ($errors->all() as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif --}}
                        <form action="{{ route('register') }}" class="needs-validation" method="post">
                            @csrf
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-outline d-flex">
                                            <input class="form-control" id="nama_depan" name="nama_depan" placeholder="Nama depan" required type="text" value="{{ old('nama_depan') }}">
                                            <label class="form-label" for="nama_depan">Nama depan</label>
                                        </div>
                                        @error('nama_depan')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <div class="form-outline d-flex">
                                            <input class="form-control" id="nama_belakang" name="nama_belakang" placeholder="Nama belakang" required type="text" value="{{ old('nama_belakang') }}">
                                            <label class="form-label" for="nama_belakang">Nama Belakang</label>
                                        </div>
                                        @error('nama_belakang')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-outline d-flex">
                                    <input class="form-control bg-transparent" id="email" name="email" placeholder="Email" required type="email" value="{{ old('email') }}">
                                    <span class="input-group-text rounded-end cursor-pointer border-0 bg-white"><i class="fa fa-envelope"></i></span>
                                    <label class="form-label" for="email">Email</label>
                                </div>
                                @error('email')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-outline d-flex">
                                    <input class="form-control bg-transparent" id="phone" name="phone" placeholder="Nomor" required type="number" value="{{ old('phone') }}">
                                    <span class="input-group-text rounded-end cursor-pointer border-0 bg-white"><i class="fa fa-phone"></i></span>
                                    <label class="form-label" for="phone">No. Handphone</label>
                                </div>
                                @error('phone')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-outline d-flex">
                                    <input class="form-control bg-transparent" id="password" name="password" placeholder="Password" required type="password">
                                    <span class="input-group-text rounded-end password cursor-pointer border-0 bg-white">&nbsp<i class="fa fa-eye"></i>&nbsp</span>
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                @error('password')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-outline d-flex">
                                    <input class="form-control bg-transparent" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required type="password">
                                    <span class="input-group-text rounded-end password cursor-pointer border-0 bg-white">&nbsp<i class="fa fa-eye"></i>&nbsp</span>
                                    <label class="form-label" for="password_confirmation">Ulangi Password</label>
                                </div>
                                @error('password_confirmation')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="d-flex align-items-center buttons">
                                <button class="btn ms-auto text-capitalize" type="submit">
                                    Register <i class="bi bi-check2-square"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer border-0 py-3">
                        <div class="text-center">
                            Sudah Memiliki Akun? <a class="text-dark" href="{{ route('login') }}">Masuk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
