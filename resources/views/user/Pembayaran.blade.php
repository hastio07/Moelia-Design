@extends('user.layouts.UserScreen')
@section('title', 'Pembayran')

@push('styles')
    <link href="{{ asset('templates') }}/assets/css-modif/user/UserPembayaran.css" rel="stylesheet">
@endpush

@section('konten')
    <section>
        <div class="breadcrumbs align-self-center text-center">
            <h1>Pembayaran</h1>
            <div class="d-flex justify-content-center">
            </div>
        </div>
        <div class="content-payment container">
            <div class="mt-3">
                <div class="row">
                    <div class="col-md-4 order-md-2">
                        <div class="warning-payment bg-danger mb-3 rounded p-2 text-white">
                            <p class="fw-bold ms-3">Penting! <i class="bi bi-megaphone-fill"></i></p>
                            <ul>
                                <li>
                                    <p>Tahap 1 digunakan untuk melakukan pembayaran uang muka(DP)</p>
                                </li>
                                <li>
                                    <p>Tahap 2 digunakan untuk melakukan pelunasan</p>
                                </li>
                                <li>
                                    <p>Dalam melakukan pembayaran tahap 2 pastikan bahwa anda telah melakukan pembayaran tahap 1</p>
                                </li>
                                <li>
                                    <p>Setelah semua pembayaran dilakukan maka tidak dapat mengganti rincian pesanan</p>
                                </li>
                            </ul>
                        </div>
                        <div class="pay-virtual rounded p-3 shadow">
                            <div class="nominal mb-4">
                                <h5 class="fw-bold text-center">Pembayaran Tahap 1</h5>
                                <div class="row mt-4">
                                    <div class="col-6">
                                        <p class="fw-bold"> Uang Muka(DP) </p>
                                    </div>
                                    <div class="col-6">
                                        <p>Rp. 18.000.000,00</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="fw-bold">Total</p>
                                    </div>
                                    <div class="col-6">
                                        <p> RP. 18.000.000,00</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="fw-bold">Status</p>
                                    </div>
                                    <div class="col-6">
                                        <p class="fw-bold text-success">Lunas</p>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-info">Bayar</button>

                        </div>

                        <div class="pay-virtual mt-3 rounded p-3 shadow">
                            <div class="nominal mb-4">
                                <h5 class="fw-bold text-center">Pembayaran Tahap 2</h5>
                                <div class="row mt-3 pt-3">
                                    <div class="col-6">
                                        <p class="fw-bold">Biaya Seluruh</p>
                                    </div>
                                    <div class="col-6">
                                        <p> RP. 180.000.000,00</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="fw-bold">Uang Muka (DP)</p>
                                    </div>
                                    <div class="col-6">
                                        <p> RP. 18.000.000,00</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="fw-bold">Total</p>
                                    </div>
                                    <div class="col-6">
                                        <p> RP. 172.000.000,00</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="fw-bold">Status</p>
                                    </div>
                                    <div class="col-6">
                                        <p class="fw-bold text-danger">Belum Lunas</p>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-info">Bayar</button>
                        </div>
                        <div class="history-payment mt-3 rounded p-3 shadow">
                            <h5 class="fw-bold text-center">Riwayat Pembayaran</h5>
                            <div class="first-payment mt-4">
                                <h6 class="fw-bold">Tahap 1</h6>
                                <div class="row mt-2">
                                    <div class="col-6">Tgl Pembayaran:</div>
                                    <div class="col-6">22/04/2024</div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">Waktu Pembayaran:</div>
                                    <div class="col-6">13:05:31 WIB</div>
                                </div>
                            </div>
                            <hr>
                            <div class="second-payment mt-3">
                                <h6 class="fw-bold">Tahap 2</h6>
                                <div class="row mt-2">
                                    <div class="col-6">Tgl Pembayaran:</div>
                                    <div class="col-6">30/05/2024</div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">Waktu Pembayaran:</div>
                                    <div class="col-6">18:07:55 WIB</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 order-md-1">
                        <div class="details-order p-3 shadow">
                            <h4 class="title fw-bold text-center">Rincian Pesanan</h4>
                            <div class="details-left mt-2 rounded p-3 shadow">
                                <h6 class="fw-bold">Nama Pemesan <i class="bi bi-person-fill"></i></h6>
                                <p>Muhammad Ardi</p>
                                <hr>
                                <h6 class="fw-bold">Telp/HP <i class="bi bi-telephone-fill"></i></h6>
                                <p>081258655551</p>
                                <hr>
                                <h6 class="fw-bold">Tanggal Akad & Resepsi <i class="bi bi-calendar-fill"></i></h6>
                                <p>31 Januari 2024</p>
                                <hr>
                                <h6 class="fw-bold">Alamat Akad & Resepsi <i class="bi bi-geo-alt-fill"></i></h6>
                                <p>Gg. Cinta Damai No.31, Tj. Baru, Kec. Sukabumi, Kota Bandar Lampung, Lampung 35122</p>
                                <hr>
                                <h6 class="fw-bold">Total Biaya Awal <i class="bi bi-currency-dollar"></i></h6>
                                <p>Rp.200.000.0000,00</p>
                                <hr>
                                <h6 class="fw-bold">Additional <i class="bi bi-plus-circle"></i></h6>
                                <p>Rp.189.000.0000,00</p>
                                <hr>
                                <h6 class="fw-bold">Total Biaya Seluruh <i class="bi bi-cash-coin"></i></h6>
                                <p>Rp.189.000.0000,00 <span class="text-success fw-bold">Lunas</span></p>
                                <hr>
                                <h6 class="fw-bold">Uang Muka(DP) <i class="bi bi-cash-stack"></i></h6>
                                <p>Rp.10.000.0000,00 <span class="text-success fw-bold">Lunas</span></p>
                                <hr>
                            </div>
                            <div class="details-right mt-3 rounded p-3 shadow">
                                <h6 class="fw-bold">Nama Pesanan <i class="bi bi-box-seam-fill"></i></h6>
                                <P>Al-Furqon Wedding Package (Paket All In)</P>
                                <hr>
                                <h6 class="fw-bold">Materi Kerja <i class="bi bi-journal-bookmark-fill"></i></i></h6>
                                <ol class="list-group list-group-numbered">
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
                                </ol>
                            </div>
                            <div class="feeoptional mt-3 rounded p-3 shadow">
                                <h6 class="fw-bold">Bonus <i class="bi bi-award-fill"></i></i></h6>
                                <P>Al-Furqon Wedding Package (Paket All In)</P>
                                <hr>
                                <h6 class="fw-bold">Optional <i class="bi bi-list-columns-reverse"></i></h6>
                                <ol class="list-group list-group-numbered">
                                    <li class="list-group-item">Venue by Al-Furqon</li>
                                    <li class="list-group-item">Decoration by Moelia Design</li>
                                    <li class="list-group-item">Catering 1000 pax by Moelia Catering</li>
                                    <li class="list-group-item">MUA (Makeup Artist)</li>
                                    <li class="list-group-item">Wedding Organizer</li>
                                    <li class="list-group-item">Attire akad & resepsi:</li>
                                    <li class="list-group-item">2 Beskap ayah + kain + peci</li>
                                    <li class="list-group-item">2 kain ibu + selendang</li>
                                    <li class="list-group-item">Musik</li>
                                    <li class="list-group-item">Photography</li>
                                    <li class="list-group-item">Master of Ceremony</li>
                                    <li class="list-group-item">Tarian</li>
                                </ol>
                            </div>
                            <div class="text-center">
                                <a class="btn btn-primary mt-3" href="#">Request Perubahan<i class="bi bi-pencil-square ms-2"></i></a>
                                <a class="btn btn-primary mt-2" href="/cetak-kontrak">Lihat Surat Kontrak <i class="bi bi-journal-text"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>

    @push('scripts')
        <script>
            function tampilkanStruk() {
                // Membuat objek XMLHttpRequest
                var xhr = new XMLHttpRequest();

                // Mengirim permintaan GET ke rute 'cetak-struk'
                xhr.open('GET', '/cetak-struk', true);

                // Menangani respons saat permintaan selesai
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Membuka jendela baru dan menulis respons ke dalamnya
                        var newWindow = window.open('', '_blank');
                        newWindow.document.write(xhr.responseText);
                        newWindow.document.close();
                    }
                };

                // Mengirim permintaan
                xhr.send();
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    @endpush
@endsection
