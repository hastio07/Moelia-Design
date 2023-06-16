<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cetak Surat Kontrak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .line1 {
            border-top: 5px solid black;
        }

        .line2 {
            border-top: 1px solid black;
        }

        .btn {
            background-color: #a39300;
            color: white;
        }

        .btn:hover {
            background-color: gold;
        }

        @media print {
            .btn {
                display: none;
            }

            .content {
                margin-left: 30px;
            }
        }
    </style>
</head>

<body>
    <section class="container">
        <a href="/pembayaran" class="btn mt-4"><i class="bi bi-arrow-left"></i></a>
        <a href="#" onclick="printWindow(event)" class="btn mt-4">Cetak Struk<i class="bi bi-printer-fill ms-2"></i></a>
        <div class="header m-3 mt-5 d-flex justify-content-center">
            <div class="img">
                <img src="{{ asset('templates') }}/assets/images/header.jpg" alt="" style="width: 100px;" class="mb-3 me-3">
            </div>
            <div class="isi-header text-center justify-content-center">
                <h1>Moelia Design & Catering Service</h1>
                <p class="mb-0">Jl. Pulau Morotai Gg. Cinta Damai No. 31 Telp. (0721) 780168, Bandar Lampung</p>
                <p class="mb-0">Cp. Lucky : 0852 69 00 258, Yudhi : 0811 790 500</p>
            </div>
        </div>
        <div class="line1"></div>
        <div class="line2 mt-1"></div>
        <div class="content">
            <h4 class="text-center mt-2">Kontrak Pesanan</h4>
            <div class="mt-3">
                <h6 class="fw-bold">Data Pemesan:</h6>
                <ul>
                    <li>Nama Pemesan :</li>
                    <li>Telp/HP.</li>
                </ul>
            </div>
            <div class="mt-3">
                <h6 class="fw-bold">Akad & Resepsi:</h6>
                <ul>
                    <li>Hari/Tgl:</li>
                    <li>Tempat/Gedung</li>
                </ul>
            </div>
            <div class="mt-3">
                <h6 class="fw-bold">Materi Kerja</h6>
                <ol>
                    <li>4 meja penerima tamu</li>
                    <li>Buku tamu</li>
                    <li>Dekorasi Meja area akad</li>
                    <li>6 kursi akad</li>
                    <li>2 Kotak angpao (Gembok disiapkan tuan rumah)</li>
                    <li>Dekorasi Galeri Depan</li>
                    <li>Dekorasi Gazebo dengan lampu chandilier</li>
                    <li>Standing jalan dengan rangkaian bunga segar</li>
                    <li>Karpet jalan pengantin motif ilustrasi</li>
                    <li>Taman puade dengan rangkaian bunga segar</li>
                    <li>Dekorasi Puade dengan tema yang disepakati (Ready stock Moelia)</li>
                </ol>
            </div>
            <div class="mt-3">
                <h6 class="fw-bold">Optional</h6>
                <ol>
                    <li>Venue</li>
                    <li>MC untuk Akad & Resepsi</li>
                    <li>Baju pengantin untuk akad & resepsi (Ready)</li>
                    <li>Make Up</li>
                    <li>Aksesori Siger Palembang</li>
                    <li>Beskap Ayah</li>
                    <li>Kain ibu</li>
                    <li>Wedding Organizer (WO)</li>
                    <li>Musik</li>
                    <li>Tarian</li>
                </ol>
            </div>
            <br>
            <P class="fw-bold">Bonus :</P>

            <h6 class="fw-bold">TOTAL BIAYA AWAL :</h6>
            <h6 class="fw-bold fst-italic">Additional :</h6>
            <h6 class="fw-bold">TOTAL BIAYA SELURUH :</h6>
            <h6 class="fw-bold">DP1 :</h6>
            <div class="row mt-5">
                <p>Bandar Lampung, 13 Oktober 2023</p>
                <div class="col">
                    <p>Pemasan</p>
                    <br>
                    <br>
                    <br>
                    <br>
                    <p class="fw-bold">Elza & Thamrin</p>
                </div>
                <div class="col">
                    <p>Moelia Design</p>
                    <img src="{{ asset('templates') }}/assets/images/ttd.jpg" style="width: 100px;" class="mb-2">
                    <br>
                    <p class="fw-bold">
                        Lucky Hastianty & Yudhi Pranata
                    </p>
                </div>
            </div>
            <div class="mt-3">
                <h6>Note</h6>
                <ul>
                    <li>Gembok dan plastik angpao tidak disediakan.</li>
                    <li>Vendor yang telah dipilih tidak dapat diganti atau dibatalkan.</li>
                    <li class="text-danger">Booking tanggal minimal sebesar Rp 15.000.000.</li>
                    <li class="text-danger">Pelunasan H-14 Wedding.</li>
                    <li>Jika terjadi pembatalan, DP tidak dapat dikembalikan.</li>
                    <li>Mengingat kondisi pandemi Covid-19, jika terdapat perubahan peraturan pemerintah terkait penutupan izin keramaian, acara dapat dijadwalkan ulang dengan catatan bahwa informasi tersebut harus disampaikan pada H-14 sebelum acara pernikahan.</li>
                    <li>Jadwal ulang tanggal pernikahan harus disesuaikan dengan tanggal yang tersedia dari Moelia Design.</li>
                    <li>Jika terjadi perubahan bentuk catering dari prasmanan menjadi hampers, harga akan disesuaikan dengan paket hampers. Tidak ada layanan pondokan dalam bentuk hampers.</li>
                </ul>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        function printWindow(event) {
            event.preventDefault();
            window.print();
            window.location.reload();
        }
    </script>
</body>

</html>