@extends('admin.layouts.layouts')
@section('title', 'Detail Pesanan')
@section('content')

<div class="container">
    <div class="card p-3">
        <h4 class="text-center">Daftar Notifikasi <i class="bi bi-bell-fill"></i></h4>
        @if(auth()->user()->unreadNotifications->isEmpty())
        <div class="notifikasi border rounded py-2 d-flex flex-column justify-content-center align-items-center text-black-50" style="height: 60vh">
            <i class="bi bi-bell-slash fs-3"></i>
            <p>Saat Ini Tidak Ada Notifikasi!</p>
        </div>

        @else
        @foreach(auth()->user()->unreadNotifications as $notification)
        <a href="{{ url($notification->data['url']) }}" class="text-decoration-none">
            <div class="notifikasi border rounded py-2 px-3 mt-3 shadow mb-3">
                <h6 class="fw-bold text-dark">Arman Maulana</h6>
                <div class="row">
                    <div class="col-md-6 my-2 d-flex align-items-center">
                        <i class="bi bi-exclamation-circle text-warning me-3 fs-4"></i>
                        <p class="m-0 text-dark">{{ $notification->data['messages'] }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-black-50 text-end my-2 fst-italic fw-bold me-3" style="font-size: small">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
        @endif

    </div>
</div>

@endsection
