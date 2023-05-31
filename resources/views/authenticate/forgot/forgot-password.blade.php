@extends('authenticate.layouts')

@section('content')
<section class="container h-100">
    <div class="row justify-content-sm-center h-100 align-items-center">
        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-8">
            <div class="card shadow-lg">
                <div class="card-body p-4">
                    <h1 class="fs-4 text-center fw-bold mb-3">Reset Password</h1>
                    <div class="back">
                        <a href="/login">
                            <i class="bi bi-arrow-left fs-4"></i>
                        </a>
                    </div>
                    <img src="{{ asset('templates') }}/assets/images/reset.jpg" class="img-fluid mb-3" alt="Phone image">
                    <form method="GET" aria-label="abdul" data-id="abdul" class="needs-validation" novalidate="" autocomplete="off" action="/confirm">
                        <div class="mb-3">
                            @csrf
                            <div class="form-outline d-flex">
                                <input class="form-control bg-transparent" id="" name="" placeholder="name@example.com" required type="email">
                                <span class="input-group-text rounded-end cursor-pointer bg-white border-0"><i class="fa fa-envelope"></i></span>
                                <label class="form-label" for="form3Example1">Email</label>
                            </div>
                        </div>
                        <div class="d-flex align-items-center buttons">
                            <a href="/confirm">
                                <button type="submit" class="btn text-capitalize">
                                    Kirim Link Resset Password <i class="bi bi-envelope-check-fill"></i>
                                </button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection