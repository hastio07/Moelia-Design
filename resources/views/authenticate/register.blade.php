@extends('authenticate.layouts.layouts')

@section('content')
    <section class="container h-100">
        <div class="row justify-content-sm-center h-100 align-items-center">
            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-8">
                <div class="card shadow-lg">
                    <div class="card-body p-4">
                        <h1 class="fs-4 text-center fw-bold mb-3">Register</h1>
                        <div class="back">
                            <a href="/login">
                                <i class="bi bi-arrow-left fs-4"></i>
                            </a>
                        </div>
                        <img alt="Phone image" class="img-fluid" src="{{ asset('templates') }}/assets/images/register.jpg">
                        <form action="{{ route('register') }}" class="needs-validation" method="post">
                            @csrf
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-outline d-flex">
                                            <input class="form-control" id="nama_depan" name="nama_depan" placeholder="Nama depan" required type="text">
                                            <label class="form-label" for="nama_depan">Nama depan</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-outline d-flex">
                                            <input class="form-control" id="nama_belakang" name="nama_belakang" placeholder="Nama belakang" required type="text">
                                            <label class="form-label" for="nama_belakang">Nama Belakang</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-outline d-flex">
                                    <input class="form-control bg-transparent" id="email" name="email" placeholder="Email" required type="email">
                                    <span class="input-group-text rounded-end cursor-pointer bg-white border-0"><i class="fa fa-envelope"></i></span>
                                    <label class="form-label" for="email">Email</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-outline d-flex">
                                    <input class="form-control bg-transparent" id="phone" name="phone" placeholder="Nomor" required type="text">
                                    <span class="input-group-text rounded-end cursor-pointer bg-white border-0"><i class="fa fa-phone"></i></span>
                                    <label class="form-label" for="phone">No. Hanphone</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-outline d-flex">
                                    <input class="form-control bg-transparent" id="password" name="password" placeholder="Password" required type="password">
                                    <span class="input-group-text rounded-end password cursor-pointer bg-white border-0">&nbsp<i class="fa fa-eye"></i>&nbsp</span>
                                    <label class="form-label" for="password">Password</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-outline d-flex">
                                    <input class="form-control bg-transparent" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required type="password">
                                    <span class="input-group-text rounded-end password cursor-pointer bg-white border-0">&nbsp<i class="fa fa-eye"></i>&nbsp</span>
                                    <label class="form-label" for="password_confirmation">Ulangi Password</label>
                                </div>
                            </div>

                            <div class="d-flex align-items-center buttons">
                                <button class="btn ms-auto text-capitalize" type="submit">
                                    Register <i class="bi bi-check2-square"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer py-3 border-0">
                        <div class="text-center">
                            Sudah Memiliki Akun? <a class="text-dark" href="{{ route('login') }}">Masuk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
