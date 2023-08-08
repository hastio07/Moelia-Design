@extends('authenticate.layouts.layouts')

@section('content')
    <section class="container h-100">
        <div class="row justify-content-sm-center h-100 align-items-center">
            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-8">
                <div class="card shadow-lg">
                    <div class="card-body p-4">
                        <h1 class="fs-4 text-center fw-bold mb-3">Reset Password</h1>
                        <div class="back">
                            <a href="{{ route('login') }}">
                                <i class="bi bi-arrow-left fs-4"></i>
                            </a>
                        </div>
                        <img alt="Phone image" class="img-fluid mb-3" src="{{ asset('templates') }}/assets/images/reset.jpg">
                        @if (session()->has('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif
                        @error('email')
                            <div class="alert alert-success">
                                {{ $message }}
                            </div>
                        @enderror
                        <form action="{{ route('password.email') }}" class="needs-validation" method="post">
                            @csrf
                            <div class="mb-3">
                                <div class="form-outline d-flex">
                                    <input autofocus class="form-control bg-transparent  @error('email')is-invalid @enderror" id="email" name="email" placeholder="name@example.com" required type="email" value="{{ old('email') }}">
                                    <span class="input-group-text rounded-end cursor-pointer bg-white border-0"><i class="fa fa-envelope"></i></span>
                                    <label class="form-label" for="email">Email</label>
                                </div>
                            </div>

                            <div class="d-flex align-items-center buttons">
                                <button class="btn text-capitalize" type="submit">
                                    <i class="bi bi-envelope-check-fill"></i> Kirim Link Reset Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
