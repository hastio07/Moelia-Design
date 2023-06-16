@extends('authenticate.layouts.layouts')

@section('content')
    <section class="h-100 container">
        <div class="row justify-content-sm-center h-100 align-items-center">
            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-8">
                <div class="card shadow-lg">
                    <div class="card-body p-4">
                        <h1 class="fs-4 fw-bold mb-3 text-center">Buat Password Baru</h1>
                        <div class="back">
                            <a href="{{ route('login') }}">
                                <i class="bi bi-arrow-left fs-4"></i>
                            </a>
                        </div>
                        <img alt="Phone image" class="img-fluid" src="{{ asset('templates') }}/assets/images/confirm.jpg">
                        @if (session()->has('failed'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('failed') }}
                                <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"></button>
                            </div>
                        @endif
                        @if ($errors->any() && !$errors->has('email') == 'email tidak ditemukan.')
                            <div class="alert alert-danger">
                                <ol class="list-group list-group-numbered">
                                    @foreach ($errors->all() as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ol>
                            </div>
                        @elseif($errors->has('email') == 'email tidak ditemukan')
                            <div class="alert alert-danger">
                                <ol class="list-group list-group-numbered">
                                    @error('email')
                                        <li>{{ $message }}</li>
                                    @enderror
                                </ol>
                            </div>
                        @endif
                        <form action="{{ route('password.store') }}" class="needs-validation mt-4" method="post">
                            @csrf
                            <input name="token" type="hidden" value="{{ $request->route('token') }}">
                            <div class="mb-3">
                                <div class="form-outline d-flex">
                                    <input autocomplete="username" autofocus class="form-control bg-light" id="email" name="email" placeholder="E-mail" readonly required type="email" value="{{ old('email', $request->email) }}">
                                    <span class="input-group-text rounded-end cursor-pointer border-0 bg-white"><i class="fa fa-envelope"></i></span>
                                    <label class="form-label" for="email">Email</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-outline d-flex">
                                    <input autocomplete="new-password" class="form-control bg-transparent" id="password" name="password" placeholder="Password" required type="password">
                                    <span class="input-group-text rounded-end password cursor-pointer border-0 bg-white">&nbsp<i class="fa fa-eye"></i>&nbsp</span>
                                    <label class="form-label" for="password">Password</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-outline d-flex">
                                    <input autocomplete="new-password" class="form-control bg-transparent" id="password_confirmation" name="password_confirmation" placeholder="Password konfirmasi" required type="password">
                                    <span class="input-group-text rounded-end password cursor-pointer border-0 bg-white">&nbsp<i class="fa fa-eye"></i>&nbsp</span>
                                    <label class="form-label" for="password_confirmation">Ulangi Password</label>
                                </div>
                            </div>
                            <div class="d-flex align-items-center buttons">
                                <button class="btn ms-auto text-capitalize" type="submit">
                                    Reset Password <i class="bi bi-check-square"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
