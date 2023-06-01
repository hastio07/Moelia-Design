@extends('authenticate.layouts')

@section('content')
    <section class="container h-100">
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
                        <h1 class="fs-4 text-center fw-bold mb-4">Login</h1>
                        @if (session()->has('failed'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('failed') }}
                                <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"></button>
                            </div>
                        @endif
                        <form action="/login" class="needs-validation pt-5" enctype="multipart/form-data" method="POST" novalidate="">
                            @csrf
                            <div class="mb-3">
                                <div class="input-group input-group-join mb-3">
                                    <div class="form-outline">
                                        <input autofocus class="form-control @error('email')is-invalid @enderror" id="email" name="email" placeholder="name@example.com" required type="email" value="{{ old('email') }}">
                                        <label class="form-label" for="form3Example1">Email</label>
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback" id="email">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group input-group-join mb-3">
                                    <div class="form-outline d-flex">
                                        <input class="form-control bg-transparent" id="exampleInputPassword1" name="password" placeholder="Masukan password" required type="password">
                                        <span class="input-group-text rounded-end password cursor-pointer bg-white border-0">&nbsp<i class="fa fa-eye"></i>&nbsp</span>
                                        <label class="form-label" for="form3Example1">Password</label>
                                    </div>
                                    <div class="invalid-feedback">
                                        Password required
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center buttons">
                                <div class="">
                                    <a class="float-end text-danger" href="/forgot">
                                        Forgot Password?
                                    </a>
                                </div>
                                <button class="btn ms-auto text-capitalize" type="submit">
                                    Login <i class="bi bi-box-arrow-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer py-3 border-0">
                        <div class="text-center">
                            Tidak Punya Akun? <a href="/register">Buat Akun</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
