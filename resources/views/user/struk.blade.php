<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        /* CSS lainnya */

        .print-button {
            display: block;
        }

        .btn {
            background-color: #a39300;
            color: white;
        }

        @media print {
            .btn {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class=" container p-3">
        <a href="/pembayaran" class="btn mt-4"><i class="bi bi-arrow-left"></i></a>
        <a href="#" onclick="printWindow(event)" class="btn mt-4">Cetak Struk<i class="bi bi-printer-fill ms-2"></i></a>
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        function printWindow(event) {
            event.preventDefault(); // Mencegah perilaku default tombol tautan
            window.print();
            window.location.reload(); // Me-refresh halaman setelah mencetak
        }
    </script>
</body>

</html>