@extends('user.layouts.UserScreen')
@section('title', 'Pembayran')

@push('styles')
<link href="{{ asset('templates') }}/assets/css-modif/user/UserPembayaran.css" rel="stylesheet">
@endpush

@section('konten')
<section>
    <div class="breadcrumbs text-center align-self-center">
        <h1>Pembayaran</h1>
        <div class="d-flex justify-content-center">
        </div>
    </div>
    <div class="container content-payment">
        <marquee id="myMarquee" class="marquee mx-1" behavior="scroll" direction="left">
            <h6 class="fw-bold">Selamat Datang Muhammad Ardi !!</h6>
        </marquee>
        <div class="row">
            <div class=" mt-3 ">
                <div class="row shadow mx-1 py-2 justify-content-center h-100">
                    <div class="col-md-6 mt-1 order-lg-2">
                        <div class="p-3 shadow h-100 rounded">
                            <div class="instruction rounded p-2">
                                <h6 class="fw-bold ms-2">Petujuk Pembyaran</h6>
                                <ul class="">
                                    <li>buka menu bayar</li>
                                    <li>klik tombol bayar</li>
                                    <li>bayar menggunakan transfer virtual account</li>
                                </ul>
                            </div>
                            <div class="noted rounded p-2 mt-3">
                                <h6 class="fw-bold">Catatan!!</h6>
                                <p>Perlu diingat bahwa pembayaran yang dilakukan hanya untuk membayar uang muka(DP)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-1">
                        <div class="p-3 text-center shadow h-100 rounded virtual-payment">
                            <div class="pay-virtual py-2 rounded">
                                <div class="nominal mb-4">
                                    <h5 class="title fw-bold">Biaya Yang Harus Dibayarkan</h5>
                                    <p class="text text-success fw-bold mt-2">Rp. 189.000.000,00</p>
                                </div>
                                <h6 class="title fw-bold">Virtual Account Pembayaran</h6>
                                <div class="mt-1">
                                    <div id="alertSuccess" class="alert alert-success" role="alert">
                                        Virtual Account Berhasil Disalin
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <p id="copyText" class="text-success font-weight-bold">0777 8907 32</p>
                                        <a id="copyButton" onclick="copyText()"><i class="fa-regular fa-copy ms-2"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="warning-pay text-start p-2 rounded mt-3">
                                <h6 class="fw-bold">Penting!</h6>
                                <p>Pastikan kamu mentrasfer ke Virtual Account yang tertera diatas.</p>
                            </div>

                        </div>
                    </div>

                    <div class="row mt-3 order-md-3 order-sm-3 ">
                        <div class="shadow p-3 rounded details-order">
                            <div class="row">
                                <h4 class="title fw-bold">Rincian Pesanan</h4>
                                <div class="col-md-4">
                                    <div class="details-left mt-2">
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
                                        <p>Rp.189.000.0000,00</p>
                                        <hr>
                                        <h6 class="fw-bold">Uang Muka(DP) <i class="bi bi-cash-stack"></i></h6>
                                        <p>Rp.10.000.0000,00</p>
                                        <hr>
                                        <h6 class="fw-bold">Status Pembayaran(DP) <i class="bi bi-arrow-clockwise"></i></h6>
                                        <p class="text-success fw-bold">LUNAS</p>
                                        <hr>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="details-right mt-2">
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
                                </div>
                                <div class="col-md-4">
                                    <div class="feeoptional mt-2">
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
                                </div>
                                <div class="text-center">
                                    <a href="#" class="btn btn-primary mt-3">Request Perubahan<i class="bi bi-pencil-square ms-2"></i></a>
                                    <a href="/cetak-kontrak" class="btn btn-primary mt-2">Lihat Surat Kontrak</a>
                                    <a href="{{ route('struk') }}" class="btn btn-primary mt-4">lihat Struk</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-4 mt-3">
                <div class="shadow rounded text-center p-3">
                    <div class="text-start">
                        <div class="d-flex justify-content-center">
                            <div class="rounded-circle overflow-hidden">
                                <img src="{{ asset('templates') }}/assets/images/payment.png" class="img-fluid" alt="Phone image" style="width: 150px; height: 150px;">
                            </div>
                        </div>
                        <div class="text-center" style="font-size: smaller;">
                            <p class="mb-0 fw-bold">Moelia Design</p>
                            <p>-- Tlp. 081258655551 --</p>
                        </div>

                        <hr>
                        <div class="isi ps-2" style="font-size: small;">
                            <div class="row mt-2">
                                <div class="col-6">No. Referensi:</div>
                                <div class="col-6">571234568987655</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">Tgl Pembayaran:</div>
                                <div class="col-6">22/04/2024</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">Waktu Pembayaran:</div>
                                <div class="col-6">13:05:31 WIB</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">No. VA:</div>
                                <div class="col-6">0777 8907 32</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">Nama:</div>
                                <div class="col-6">Muhammad Ardi</div>
                            </div>
                            <hr>
                            <div class="row mt-2">
                                <div class="col-6">Total Bayar:</div>
                                <div class="col-6">Rp 10.000.000</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">Biaya Admin:</div>
                                <div class="col-6">Rp 5000</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">Total Bayar:</div>
                                <div class="col-6 fw-bold">Rp 10.00.5000</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">Rekening Debet:</div>
                                <div class="col-6">**** 1362</div>
                            </div>
                        </div>
                        <hr>
                        <p class="mb-0 text-center" style="font-size: smaller;">Terima kasih atas pembayaran Anda!</p>
                    </div>
                    <a href="{{ route('struk') }}" class="btn btn-primary mt-4">lihat Struk<i class="bi bi-printer-fill ms-2"></i></a>
                </div>
            </div> -->
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



<script>
    function copyText() {
        var text = document.getElementById("copyText").innerText;
        navigator.clipboard.writeText(text)
            .then(function() {
                var alertSuccess = document.getElementById("alertSuccess");
                alertSuccess.style.display = "block";
                setTimeout(function() {
                    alertSuccess.style.display = "none";
                }, 1000);
            })
            .catch(function(error) {
                console.error("Gagal menyalin teks:", error);
            });
    }
</script>
<script>
    setTimeout(function() {
        var marquee = document.getElementById("myMarquee");
        marquee.classList.add("marquee-hidden");

        setTimeout(function() {
            marquee.style.display = "none";
        }, 1000); // Menghapus marquee setelah animasi selesai (1 detik)
    }, 16000); // Menghentikan marquee setelah 10 detik
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
@endpush
@endsection