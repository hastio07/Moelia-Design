@extends('admin.layouts.layouts')
@section('title', 'Detail Pesanan')
@section('content')
<div class="container">
    <div class="card p-5">
        <div class="row">
            <h5 class="fw-bold mb-5 text-center">Rincian Pesanan</h5>
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
                </div>
            </div>
            <div class="col-md-4">
                <div class="details-right mt-2">
                     <h6 class="fw-bold">Nama Paket <i class="bi bi-box-seam"></i></h6>
                    {{ $data->nama_pesanan }}
                    <hr>
                    <h6 class="fw-bold">Materi Kerja <i class="bi bi-journal-text"></i></h6>
                    {!! $data->materi_kerja !!}
                    <hr>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feeoptional mt-2">
                    <h6 class="fw-bold">Bonus <i class="bi bi-award-fill"></i></i></h6>
                    {!! $data->bonus !!}
                    <hr>
                    <h6 class="fw-bold">Optional <i class="bi bi-list-columns-reverse"></i></h6>
                    {!! $data->additional !!}
                    <hr>
                    <div class="shadow rounded p-3">
                        <h6 class="fw-bold">Riwayat Pembayaran DP<i class="bi bi-arrow-clockwise"></i></h6>
                        <p>Tgl. Bayar: 12/10/2023</p>
                        <p>Status <span class="text-success">{{ $data->status_format }}</span></p>
                        <hr>
                        <h6 class="fw-bold">Riwayat Pelunasan<i class="bi bi-arrow-clockwise"></i></h6>
                        <p>Tgl. Bayar: 12/11/2023</p>
                        <p>Status <span class="text-success">{{ $data->status_format }}</span></p>
                    </div>
                </div>
            </div>
            <div class="mt-4 text-center">
                <a class="btn btn-success" href="/cetak-kontrak">Lihat Surat Kontrak <i class="bi bi-search"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection
