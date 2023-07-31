@extends('admin.layouts.layouts')
@section('title', 'Detail Pesanan')
@section('content')

    <div class="container">
        <div class="card p-3">
            <h4 class="text-center">Daftar Notifikasi <i class="bi bi-bell-fill"></i></h4>
            @if (auth()->user()->unreadNotifications->isEmpty())
                <div class="notifikasi d-flex flex-column justify-content-center align-items-center text-black-50 rounded border py-2" style="height: 60vh">
                    <i class="bi bi-bell-slash fs-3"></i>
                    <p>Saat Ini Tidak Ada Notifikasi!</p>
                </div>
            @else
                @foreach (auth()->user()->unreadNotifications as $notification)
                    <a class="text-decoration-none" href="{{ route('manage-pesanan-proses.detail', ['id_detail_pesanan' => $notification->data['pembayaran_id'], 'ntf' => $notification->id]) }}">
                        <div class="notifikasi mb-3 mt-3 rounded border px-3 py-2 shadow">
                            <h6 class="fw-bold text-dark">Arman Maulana</h6>
                            <div class="row">
                                <div class="col-md-6 d-flex align-items-center my-2">
                                    <i class="bi bi-exclamation-circle text-warning fs-4 me-3"></i>
                                    <p class="text-dark m-0">{{ $notification->data['messages'] }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-black-50 fst-italic fw-bold my-2 me-3 text-end" style="font-size: small">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif

        </div>
    </div>

@endsection
