@extends('user.layouts.UserScreen')
@section('title', 'Pembayran')

@push('styles')
    <link href="{{ asset('templates') }}/assets/css-modif/user/UserPembayaran.css" rel="stylesheet">
@endpush

@section('konten')
    <section>
        <div class="payment text-center align-self-center">
            <h1>Pembayaran</h1>
            <div class="d-flex justify-content-center">
            </div>
        </div>
        <div class="row mt-2 mx-3">
            <div class="col-sm-9">
                <div class="card shadow p-3">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="card">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-title">
                                    <h5>Petujuk Pembyaran</h5>
                                </div>
                                <ul>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 ">
                <div class="card p-3">
                    <div class="card-title">
                        <h4>Riwayat Pembayaran

                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
