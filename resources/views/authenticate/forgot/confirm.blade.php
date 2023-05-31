@extends('authenticate.layouts')

@section('content')
<section class="container h-100">
    <div class="row justify-content-sm-center h-100 align-items-center">
        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-8">
            <div class="card shadow-lg">
                <div class="card-body p-4">
                    <h1 class="fs-4 text-center fw-bold mb-3">Confirm Password</h1>
                    <div class="back">
                        <a href="/login">
                            <i class="bi bi-arrow-left fs-4"></i>
                        </a>
                    </div>
                    <img src="{{ asset('templates') }}/assets/images/confirm.jpg" class="img-fluid" alt="Phone image">
                    <form method="POST" aria-label="abdul" data-id="abdul" class="needs-validation" novalidate="" autocomplete="off">
                        <div class="mb-3">
                            <div class="form-outline d-flex">
                                <input class="form-control bg-transparent" id="exampleInputPassword1" name="email" placeholder="name@example.com" required type="email">
                                <span class="input-group-text rounded-end cursor-pointer bg-white border-0"><i class="fa fa-envelope"></i></span>
                                <label class="form-label" for="form3Example1">Email</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-outline d-flex">
                                <input class="form-control bg-transparent" id="exampleInputPassword1" name="password" placeholder="Masukan password" required type="password">
                                <span class="input-group-text rounded-end password cursor-pointer bg-white border-0">&nbsp<i class="fa fa-eye"></i>&nbsp</span>
                                <label class="form-label" for="form3Example1">Password</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-outline d-flex">
                                <input class="form-control bg-transparent" id="exampleInputPassword1" name="password" placeholder="Masukan password" required type="password">
                                <span class="input-group-text rounded-end password cursor-pointer bg-white border-0">&nbsp<i class="fa fa-eye"></i>&nbsp</span>
                                <label class="form-label" for="form3Example1">Ulangi Password</label>
                            </div>
                        </div>

                        <div class="d-flex align-items-center buttons">
                            <button type="submit" class="btn ms-auto text-capitalize">
                                Reset Password <i class="bi bi-check-square"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer py-3 border-0">
                    <div class="text-center">
                        Sudah Memiliki Akun? <a href="/login" class="text-dark">Masuk</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection