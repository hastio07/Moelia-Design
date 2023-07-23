@extends('admin.layouts.layouts')
@section('title', 'Detail Pesanan')
@section('content')
    <div class="container">
        <div class="card p-5">
            <div class="row">
                <h5 class="fw-bold mb-4">Rincian Pesanan {{ $data->nama_pesanan }}</h5>
                <div class="col-md-4">
                    <div class="details-left mt-2">
                        <h6 class="fw-bold">Nama Pemesan <i class="bi bi-person-fill"></i></h6>
                        <p>{{ $data->nama_pemesan }}</p>
                        <hr>
                        <h6 class="fw-bold">E-mail Pemesan <i class="bi bi-telephone-fill"></i></h6>
                        <p>{{ $data->email_pemesan }}</p>
                        <hr>
                        <h6 class="fw-bold">Telp/HP <i class="bi bi-telephone-fill"></i></h6>
                        <p>{{ $data->telepon_pemesan }}</p>
                        <hr>
                        <h6 class="fw-bold">Tanggal Akad & Resepsi <i class="bi bi-calendar-fill"></i></h6>
                        <p>{{ $data->tanggal_akad_dan_resepsi }}</p>
                        <hr>
                        <h6 class="fw-bold">Alamat Akad & Resepsi <i class="bi bi-geo-alt-fill"></i></h6>
                        <p>{{ $data->alamat_akad_dan_resepsi }}</p>
                        <hr>
                        <h6 class="fw-bold">Total Biaya Awal <i class="bi bi-currency-dollar"></i></h6>
                        <p>{{ $data->formatRupiah('total_biaya_awal') }}</p>
                        <hr>
                        <h6 class="fw-bold">Total Biaya Additional <i class="bi bi-cash-coin"></i></h6>
                        <p>{{ $data->formatRupiah('total_biaya_additional') }}</p>
                        <hr>
                        <h6 class="fw-bold">Total Biaya Seluruh <i class="bi bi-cash-coin"></i></h6>
                        <p>{{ $data->formatRupiah('total_biaya_seluruh') }}</p>
                        <hr>
                        <h6 class="fw-bold">Uang Muka(DP) <i class="bi bi-cash-stack"></i></h6>
                        <p>{{ $data->formatRupiah('uang_muka') }}</p>
                        <hr>
                        <h6 class="fw-bold">Status Pembayaran(DP) <i class="bi bi-arrow-clockwise"></i></h6>
                        <p class="text-success fw-bold"> {{ $data->status_format }}</p>
                        <hr>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="details-right mt-2">
                        <h6 class="fw-bold">Nama Pesanan <i class="bi bi-box-seam-fill"></i></h6>
                        {{-- <p>Al-Furqon Wedding Package (Paket All In)</p> --}}
                        <p>{{ $data->nama_pesanan }}</p>
                        <hr>
                        <h6 class="fw-bold">Materi Kerja <i class="bi bi-journal-bookmark-fill"></i></i></h6>
                        {{-- <ol class="list-group list-group-numbered">
                            <li class="list-group-item">4 meja penerima tamu</li>
                            <li class="list-group-item">Buku tamu</li>
                            <li class="list-group-item">Dekorasi Meja area akad</li>
                            <li class="list-group-item">6 kursi akad</li>
                            <li class="list-group-item">2 Kotak angpao (Gembok disiapkan tuan rumah)</li>
                            <li class="list-group-item">Dekorasi Galeri Depan</li>
                            <li class="list-group-item">Dekorasi Gazebo dengan lampu chandilier</li>
                            <li class="list-group-item">Standing jalan dengan rangkaian bunga segar</li>
                            <li class="list-group-item">Karpet jalan pengantin motif ilustrasi</li>
                            <li class="list-group-item">Taman puade dengan rangkaian bunga segar</li>
                            <li class="list-group-item">Dekorasi Puade dengan tema yang disepakati (Ready stock Moelia)</li>
                        </ol> --}}
                        {!! $data->materi_kerja !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feeoptional mt-2">
                        <h6 class="fw-bold">Bonus <i class="bi bi-award-fill"></i></i></h6>
                        {!! $data->bonus !!}
                        <hr>
                        <h6 class="fw-bold">Optional <i class="bi bi-list-columns-reverse"></i></h6>
                        {!! $data->additional !!}
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <a class="btn btn-success" href="/cetak-struk">Cetak Surat kontrak <i class="bi bi-printer"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection
