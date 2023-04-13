@extends('authenticate.layouts')

@section('content')
    <section class="container login d-flex shadow-lg p-3 mb-5 bg-body rounded position-absolute top-50 start-50 translate-middle">
        <div class="login-left w-50 h-100">
            <div class="row justify-content-center align-content-center h-100">
                <div class="col-sm-6">
                    <div class="header">
                        <h1 class="text-center">Selamat Datang!</h1>
                    </div>
                    @if (session()->has('failed'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('failed') }}
                            <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"></button>
                        </div>
                    @endif

                    <div class="in-form">
                        <form action="/login" enctype="multipart/form-data" method="POST">
                            @csrf
                            <label class="form-label mt-0" for="email">Email:</label>
                            <div class="input-group mb-3 has-validation">
                                <span class="input-group-text bg-transparent"><i class="bi bi-envelope"></i></span>
                                <input autofocus class="form-control text-decoration-none bg-transparent @error('email')is-invalid @enderror" id="email" name="email" placeholder="name@example.com" required type="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback" id="email">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <label class="form-label mt-0" for="email">Password:</label>
                            <div class="input-group mb-3 has-validation">
                                <span class="input-group-text bg-transparent"><i class="bi bi-key-fill"></i></span>
                                <input class="form-control bg-transparent" id="exampleInputPassword1" name="password" placeholder="Masukan password" required type="password">
                            </div>
                            <a class="text-decoration-none text-center" href="#">Lupa Password</a>
                            <button class="btn btn center-block signin" type="submit">LogIn</button>
                            <div class="text-center">
                                <span class="d-inline text-center">Tidak Punya Akun? <a class="d-inline text-decoration-none text-danger" href="#">Daftar Sekarang!</a></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="login-right w-50 h-100 position-absolute top-50 end-0 translate-middle-y">
            <div class="carousel slide h-100" id="carouselExampleIndicators">
                <div class="carousel-indicators">
                    <button aria-current="true" aria-label="Slide 1" class="active" data-bs-slide-to="0" data-bs-target="#carouselExampleIndicators" type="button"></button>
                    <button aria-label="Slide 2" data-bs-slide-to="1" data-bs-target="#carouselExampleIndicators" type="button"></button>
                    <button aria-label="Slide 3" data-bs-slide-to="2" data-bs-target="#carouselExampleIndicators" type="button"></button>
                </div>
                <div class="carousel-inner rounded-end h-100">
                    <div class="carousel-item active h-100">
                        <img alt="..." class="d-block w-100 h-100" src="https://raw.githubusercontent.com/hastio07/Project_WO/52e9acb396534a7b977fb931a009fce50ab719f1/public/img/img1.jpg">
                    </div>
                    <div class="carousel-item h-100">
                        <img alt="..." class="d-block w-100 h-100" src="https://raw.githubusercontent.com/hastio07/Project_WO/52e9acb396534a7b977fb931a009fce50ab719f1/public/img/img2.jpg">
                    </div>
                    <div class="carousel-item h-100">
                        <img alt="..." class="d-block w-100 h-100" src="https://raw.githubusercontent.com/hastio07/Project_WO/52e9acb396534a7b977fb931a009fce50ab719f1/public/img/img3.jpg">
                    </div>
                </div>
                <button class="carousel-control-prev" data-bs-slide="prev" data-bs-target="#carouselExampleIndicators" type="button">
                    <span aria-hidden="true" class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" data-bs-slide="next" data-bs-target="#carouselExampleIndicators" type="button">
                    <span aria-hidden="true" class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>
@endsection
