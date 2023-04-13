@extends('authenticate.layouts')

@section('content')
    <section class="container register d-flex shadow-lg p-3 mb-5 bg-body rounded position-absolute top-50 start-50 translate-middle">
        <div class="w-100 h-100">
            <div class="row justify-content-center align-content-center h-100">
                <div class="col-sm-7 col-lg-5">

                    <div class="header">
                        <h1 class="text-center">Registrasi</h1>
                    </div>
                    <div class="in-form">
                        <!-- Nama Input-->
                        <div class="row">
                            <div class="col">
                                <label class="form-label" for="Name">Nama Depan</label>
                                <input aria-label="First name" class="form-control bg-transparent" placeholder="Nama Depan" type="text">
                            </div>
                            <div class="col">
                                <label class="form-label" for="Name">Nama Belakang</label>
                                <input aria-label="Last name" class="form-control bg-transparent" placeholder="Nama Belakang" type="text">
                            </div>
                        </div>
                        <!-- Email Input-->
                        <label class="form-label" for="email">Email</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-transparent"><i class="bi bi-envelope"></i></span>
                            <input class="form-control bg-transparent" id="email" placeholder="Masukan Email" required type="email">
                        </div>
                        <!-- No. Hp-->
                        <label class="NomorHp" for="NomorHp">Nomor Handphone</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-transparent"><i class="bi bi-phone"></i></span>
                            <input class="form-control bg-transparent" id="NomorHp" placeholder="Masukan Nomor HP" required type="NomorHp">
                        </div>

                        <!-- Password Input-->
                        <div class="row">
                            <div class="col">
                                <label class="form-label" for="Password">Password</label>
                                <input aria-label="First name" class="form-control bg-transparent" placeholder="Password" type="password">
                            </div>
                            <div class="col">
                                <label class="form-label" for="Password">Ulangi Password</label>
                                <input aria-label="Last name" class="form-control bg-transparent" placeholder="Password" type="password">
                            </div>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn center-block signin">Daftar Sekarang</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </section>
@endsection
