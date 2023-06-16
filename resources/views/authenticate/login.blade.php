@extends('authenticate.layouts.layouts')

@section('content')
    <section class="h-100 container">
        <div class="row justify-content-sm-center h-100 align-items-center">
            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-8">
                <div class="card shadow-lg">
                    <div class="card-body p-4">
                        <div class="back">
                            <a href="/">
                                <i class="bi bi-arrow-left fs-4"></i>
                            </a>
                        </div>
                        <img alt="Phone image" class="img-fluid" src="{{ asset('templates') }}/assets/images/login.jpg">
                        <h1 class="fs-4 fw-bold mb-4 text-center">Login</h1>
                        @if (session()->has('failed') || session()->has('status'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('failed') ?: session('status') }}
                                <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"></button>
                            </div>
                        @endif
                        @if ($errors->has('status'))
                            @foreach ($errors->get('status') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        @endif
                        <form action="{{ route('login') }}" class="needs-validation pt-5" method="post">
                            @csrf
                            <div class="mb-3">
                                <div class="input-group input-group-join mb-3">
                                    <div class="form-outline">
                                        <input autofocus class="form-control @error('email')is-invalid @enderror" id="email" name="email" placeholder="name@example.com" required type="email" value="{{ old('email') }}">
                                        <label class="form-label" for="email">Email</label>
                                    </div>
                                </div>
                                @error('email')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="input-group input-group-join mb-3">
                                    <div class="form-outline d-flex">
                                        <input autocomplete="current-password" class="form-control bg-transparent" id="password" name="password" placeholder="Masukan password" required type="password">
                                        <span class="input-group-text rounded-end password cursor-pointer border-0 bg-white">&nbsp<i class="fa fa-eye"></i>&nbsp</span>
                                        <label class="form-label" for="password">Password</label>
                                    </div>
                                </div>
                                @error('password')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="d-flex align-items-center buttons">
                                <div class="">
                                    <a class="float-end text-danger" href="{{ route('password.request') }}">
                                        Forgot Password?
                                    </a>
                                </div>
                                <button class="btn ms-auto text-capitalize" type="submit">
                                    Login <i class="bi bi-box-arrow-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer border-0 py-3">
                        <div class="text-center">
                            Tidak Punya Akun? <a href="{{ route('register') }}">Buat Akun</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
