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
                {{ Breadcrumbs::render('pembayaran') }}
            </div>
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
                                <h5 class="fw-bold text-center">Uang Muka (DP)</h5>
                                <div class="row mt-4">
                                    <div class="col-6">
                                        <p class="fw-bold"> Uang Muka(DP) </p>
                                    </div>
                                    <div class="col-6">
                                        @if (empty($bayar_dp->uang_muka) || is_null($bayar_dp->uang_muka))
                                            <p>-</p>
                                        @else
                                            <p>{{ $bayar_dp->formatRupiah('uang_muka') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="fw-bold">Total</p>
                                    </div>
                                    <div class="col-6">
                                        @if (empty($bayar_dp->uang_muka) || is_null($bayar_dp->uang_muka))
                                            <p>-</p>
                                        @else
                                            <p>{{ $bayar_dp->formatRupiah('uang_muka') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="fw-bold">Status</p>
                                    </div>
                                    <div class="col-6">
                                        @if (!empty($bayar_dp))
                                            @if (($bayar_dp->status === 'unpaid' || $bayar_dp->status === 'pending' || $bayar_dp->status === 'cancel' || $bayar_dp->status === 'expire') && $bayar_dp->tanggal_konfirmasi == null)
                                                <p class="fw-bold text-danger">Belum Lunas</p>
                                            @elseif($bayar_dp->status === 'paid' && $bayar_dp->tanggal_konfirmasi != null)
                                                <p class="fw-bold text-success">Lunas</p>
                                            @endif
                                        @else
                                            <p class="fw-bold text-danger">Belum Lunas</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if (!empty($bayar_dp))
                                @if ($bayar_dp->snap_token == null || $bayar_dp->status === 'cancel' || $bayar_dp->status === 'expire')
                                    <a class="btn btn-info" href="{{ route('user-pembayaran.refreshMidtransToken', $bayar_dp->id_hash_format) }}" id="request-link-bayar">Minta tautan bayar Baru</a>
                                @else
                                    @if (($bayar_dp->status === 'unpaid' || $bayar_dp->waktu_pembayaran == null) && $bayar_dp->snap_token != null)
                                        <button class="btn btn-info" data-bs-token="{{ $bayar_dp->snap_token }}" id="bayar">Bayar</button>
                                        @if ($bayar_dp->status === 'pending')
                                            <a class="btn btn-info" href="{{ route('user-pembayaran.cancel', $bayar_dp->order_id) }}" id="cancel-link-bayar">Cancel</a>
                                        @endif
                                    @endif
                                @endif
                            @endif
                        </div>

                        <div class="pay-virtual mt-3 rounded p-3 shadow">
                            <div class="nominal mb-4">
                                <h5 class="fw-bold text-center">Pembayaran Tahap 2</h5>
                                <h5 class="fw-bold text-center">Pelunasan</h5>
                                <div class="row mt-3 pt-3">
                                    <div class="col-6">
                                        <p class="fw-bold">Biaya Seluruh</p>
                                    </div>
                                    <div class="col-6">
                                        @if (empty($bayar_dp->total_biaya_seluruh) || is_null($bayar_dp->total_biaya_seluruh))
                                            <p>-</p>
                                        @else
                                            <p>{{ $bayar_dp->formatRupiah('total_biaya_seluruh') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="fw-bold">Uang Muka (DP)</p>
                                    </div>
                                    <div class="col-6">
                                        @if (empty($bayar_dp->uang_muka) || is_null($bayar_dp->uang_muka))
                                            <p>-</p>
                                        @else
                                            <p>{{ $bayar_dp->formatRupiah('uang_muka') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="fw-bold">Total</p>
                                    </div>
                                    <div class="col-6">
                                        @if (empty($bayar_fp->total_biaya_seluruh) || is_null($bayar_fp->total_biaya_seluruh))
                                            <p>-</p>
                                        @else
                                            <p>{{ $bayar_fp->formatRupiah('total_biaya_seluruh') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="fw-bold">Status</p>
                                    </div>
                                    <div class="col-6">
                                        @if (!empty($bayar_fp))
                                            @if (($bayar_fp->status === 'unpaid' || $bayar_fp->status === 'pending' || $bayar_fp->status === 'cancel' || $bayar_fp->status === 'expire') && $bayar_fp->tanggal_konfirmasi == null)
                                                <p class="fw-bold text-danger">Belum Lunas</p>
                                            @elseif($bayar_fp->status === 'paid' && $bayar_fp->tanggal_konfirmasi != null)
                                                <p class="fw-bold text-success">Lunas</p>
                                            @endif
                                        @else
                                            <p class="fw-bold text-danger">Belum Lunas</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if (!empty($bayar_fp))
                                @if ($bayar_dp->status === 'paid')
                                    @if ($bayar_fp->snap_token == null || $bayar_fp->status === 'cancel' || $bayar_fp->status === 'expire')
                                        <a class="btn btn-info" href="{{ route('user-pembayaran.refreshMidtransToken', $bayar_fp->id_hash_format) }}" id="request-link-bayar">Minta tautan bayar Baru</a>
                                    @else
                                        @if (($bayar_fp->status === 'unpaid' || $bayar_fp->waktu_pembayaran == null) && $bayar_fp->snap_token != null)
                                            <button class="btn btn-info" data-bs-token="{{ $bayar_fp->snap_token }}" id="bayar">Bayar</button>
                                            @if ($bayar_dp->status === 'pending')
                                                <a class="btn btn-info" href="{{ route('user-pembayaran.cancel', $bayar_fp->order_id) }}" id="cancel-link-bayar">Cancel</a>
                                            @endif
                                        @endif
                                    @endif
                                @endif
                            @endif
                        </div>
                        <div class="history-payment mt-3 rounded p-3 shadow">
                            <h5 class="fw-bold text-center">Riwayat Pembayaran</h5>
                            <div class="first-payment mt-4">
                                <h6 class="fw-bold">Tahap 1 (DP)</h6>
                                <div class="row mt-2">
                                    <div class="col-6">Tgl Pembayaran:</div>
                                    <div class="col-6">
                                        @if (!empty($bayar_dp) && $bayar_dp->jenis_pembayaran === 'dp' && $bayar_dp->waktu_pembayaran)
                                            {{ \Carbon\Carbon::parse($bayar_dp->waktu_pembayaran)->translatedFormat('d F Y') }}
                                        @else
                                            <p class="fw-bold text-danger">-</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">Waktu Pembayaran:</div>
                                    <div class="col-6">
                                        @if (!empty($bayar_dp) && $bayar_dp->jenis_pembayaran === 'dp' && $bayar_dp->waktu_pembayaran)
                                            {{ \Carbon\Carbon::parse($bayar_dp->waktu_pembayaran)->setTimezone('Asia/Jakarta')->format('H:i') }} WIB
                                        @else
                                            <p class="fw-bold text-danger">-</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="second-payment mt-3">
                                <h6 class="fw-bold">Tahap 2 (Pelunasan)</h6>
                                <div class="row mt-2">
                                    <div class="col-6">Tgl Pembayaran:</div>
                                    <div class="col-6">
                                        @if (!empty($bayar_fp) && $bayar_fp->jenis_pembayaran === 'fp' && $bayar_fp->waktu_pembayaran)
                                            {{ \Carbon\Carbon::parse($bayar_fp->waktu_pembayaran)->translatedFormat('d F Y') }}
                                        @else
                                            <p class="fw-bold text-danger">-</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">Waktu Pembayaran:</div>
                                    <div class="col-6">
                                        @if (!empty($bayar_fp) && $bayar_fp->jenis_pembayaran === 'fp' && $bayar_fp->waktu_pembayaran)
                                            {{ \Carbon\Carbon::parse($bayar_fp->waktu_pembayaran)->setTimezone('Asia/Jakarta')->format('H:i') }} WIB
                                        @else
                                            <p class="fw-bold text-danger">-</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 order-md-1">
                        <div class="details-order p-3 shadow">
                            <h4 class="title fw-bold text-center">Rincian Pesanan</h4>
                            <div class="details-left mt-2 rounded p-3 shadow">
                                <h6 class="fw-bold">Nama Pemesan <i class="bi bi-person-fill"></i></h6>
                                @if (empty($bayar_dp->nama_pemesan) || is_null($bayar_dp->nama_pemesan))
                                    <p>-</p>
                                @else
                                    <p class="text-capitalize">{{ $bayar_dp->nama_pemesan }}</p>
                                @endif
                                <hr>
                                <h6 class="fw-bold">Telp/HP <i class="bi bi-telephone-fill"></i></h6>
                                @if (empty($bayar_dp->telepon_pemesan) || is_null($bayar_dp->telepon_pemesan))
                                    <p>-</p>
                                @else
                                    <p class="text-capitalize">{{ $bayar_dp->telepon_pemesan }}</p>
                                @endif
                                <hr>
                                <h6 class="fw-bold">Tanggal Akad & Resepsi <i class="bi bi-calendar-fill"></i></h6>
                                @if (empty($bayar_dp->tanggal_akad_dan_resepsi) || is_null($bayar_dp->tanggal_akad_dan_resepsi))
                                    <p>-</p>
                                @else
                                    <p class="text-capitalize">{{ \Carbon\Carbon::parse($bayar_dp->tanggal_akad_dan_resepsi)->translatedFormat('d F Y') }}</p>
                                @endif
                                <hr>
                                <h6 class="fw-bold">Alamat Akad & Resepsi <i class="bi bi-geo-alt-fill"></i></h6>
                                @if (empty($bayar_dp->alamat_akad_dan_resepsi) || is_null($bayar_dp->alamat_akad_dan_resepsi))
                                    <p>-</p>
                                @else
                                    <p class="text-capitalize">{{ $bayar_dp->alamat_akad_dan_resepsi }}</p>
                                @endif
                                <hr>
                                <h6 class="fw-bold">Total Biaya Awal <i class="bi bi-currency-dollar"></i></h6>
                                @if (empty($bayar_dp->total_biaya_awal) || is_null($bayar_dp->total_biaya_awal))
                                    <p>-</p>
                                @else
                                    <p class="text-capitalize">{{ $bayar_dp->formatRupiah('total_biaya_awal') }}</p>
                                @endif
                                <hr>
                                <h6 class="fw-bold">Additional <i class="bi bi-plus-circle"></i></h6>
                                @if (empty($bayar_dp->total_biaya_additional) || is_null($bayar_dp->total_biaya_additional))
                                    <p>-</p>
                                @else
                                    <p class="text-capitalize">{{ $bayar_dp->formatRupiah('total_biaya_additional') }}</p>
                                @endif
                                <hr>
                                <h6 class="fw-bold">Total Biaya Seluruh <i class="bi bi-cash-coin"></i></h6>
                                @if (empty($bayar_dp->total_biaya_seluruh) || is_null($bayar_dp->total_biaya_seluruh))
                                    <p>-</p>
                                @else
                                    <p class="text-capitalize">{{ $bayar_dp->formatRupiah('total_biaya_seluruh') }}</p>
                                @endif
                                <hr>
                                <h6 class="fw-bold">Uang Muka(DP) <i class="bi bi-cash-stack"></i></h6>
                                @if (empty($bayar_dp->uang_muka) || is_null($bayar_dp->uang_muka))
                                    <p>-</p>
                                @else
                                    <p class="text-capitalize">{{ $bayar_dp->formatRupiah('uang_muka') }}</p>
                                @endif
                                <hr>
                            </div>
                            <div class="details-right mt-3 rounded p-3 shadow">
                                <h6 class="fw-bold">Nama Pesanan <i class="bi bi-box-seam-fill"></i></h6>
                                @if (empty($bayar_dp->nama_pesanan) || is_null($bayar_dp->nama_pesanan))
                                    <p>-</p>
                                @else
                                    <p class="text-capitalize">{{ $bayar_dp->nama_pesanan }}</p>
                                @endif
                                <hr>
                                <h6 class="fw-bold">Materi Kerja <i class="bi bi-journal-bookmark-fill"></i></i></h6>
                                @if (empty($bayar_dp->materi_kerja) || is_null($bayar_dp->materi_kerja))
                                    <p>-</p>
                                @else
                                    <p class="text-capitalize"> {!! $bayar_dp->materi_kerja !!}</p>
                                @endif
                            </div>
                            <div class="feeoptional mt-3 rounded p-3 shadow">
                                <h6 class="fw-bold">Bonus <i class="bi bi-award-fill"></i></i></h6>
                                @if (empty($bayar_dp->bonus) || is_null($bayar_dp->bonus))
                                    <p>-</p>
                                @else
                                    <p class="text-capitalize">{!! $bayar_dp->bonus !!}</p>
                                @endif
                                <hr>
                                <h6 class="fw-bold">Additional <i class="bi bi-list-columns-reverse"></i></h6>
                                @if (empty($bayar_dp->additional) || is_null($bayar_dp->additional))
                                    <p>-</p>
                                @else
                                    <p class="text-capitalize">{!! $bayar_dp->additional !!}</p>
                                @endif
                            </div>
                            <div class="text-center">
                                @if (!empty($contact->whatsapp1_number))
                                    <a class="btn btn-primary mt-3" href="https://wa.me/+62{{ $contact->whatsapp1_number }}?text=Silahkan sebutkan nama dan perubahan yang ingin diajukan dibawah ini:">Request Perubahan<i class="bi bi-pencil-square ms-2"></i></a>
                                @endif
                                <a class="btn btn-primary mt-2" href="{{ route('CetakKontrak', auth()->user()->email) }}">Lihat Surat Kontrak <i class="bi bi-journal-text"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
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
        @if (!empty($bayar_dp) || !empty($bayar_fp))
            @if ((is_null($bayar_dp->snap_token) || is_null($bayar_fp->snap_token)) && ($bayar_dp->status === 'cancel' || $bayar_dp->status === 'unpaid' || $bayar_dp->status === 'expire' || $bayar_fp->status === 'cancel' || $bayar_fp->status === 'unpaid' || $bayar_fp->status === 'expire') && ($bayar_dp->waktu_pembayaran == null || $bayar_fp->waktu_pembayaran == null))
                <script>
                    // Cari elemen <a> dengan id 'request-link-bayar'
                    const linkElement = document.getElementById('request-link-bayar');

                    linkElement.addEventListener('click', (e) => {
                        e.preventDefault(); // Mencegah link berpindah ke halaman baru

                        // Ambil URL dari atribut 'href' pada elemen <a>
                        const url = linkElement.getAttribute('href');

                        // Buat form sementara secara dinamis
                        const form = document.createElement('form');
                        form.action = url;
                        form.method = 'POST';

                        // Tambahkan CSRF token ke dalam form
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        const csrfInput = document.createElement('input');
                        csrfInput.type = 'hidden';
                        csrfInput.name = '_token';
                        csrfInput.value = csrfToken;

                        // Tambahkan elemen input CSRF token ke dalam form
                        form.appendChild(csrfInput);

                        // Tambahkan form ke dalam body dokumen
                        document.body.appendChild(form);

                        // Kirimkan permintaan POST
                        form.submit();
                    });
                </script>

                {{-- <script>
                    const btnRequestPembayaran = document.getElementById('request-link-bayar');
                    btnRequestPembayaran.addEventListener('click', (e) => {
                        // Ganti {data} dengan data yang ingin Anda kirimkan dalam URL
                        const button = e.target;
                        console.log(button);
                        const url = button.getAttribute('data-bs-route');
                        console.log(url);
                        // Mendapatkan nilai CSRF token dari meta tag
                        const csrfToken = $('meta[name="csrf-token"]').attr('content');
                        // Konfigurasi untuk request POST
                        const requestOptions = {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json', // Sesuaikan dengan jenis konten yang ingin Anda kirimkan
                                'X-CSRF-TOKEN': csrfToken, // Menyertakan CSRF token di headers
                            },
                        };
                        // Lakukan request POST menggunakan fetch()
                        fetch(url, requestOptions)
                            .then(response => response.json()) // Handle response dari server jika ingin mengambil data JSON
                            .then(data => {
                                // Lakukan sesuatu dengan data response dari server (opsional)
                                location.reload();
                            })
                            .catch(error => {
                                // Tangani jika terjadi kesalahan selama permintaan (opsional)
                                console.error('Error:', error);
                            });
                    });
                </script> --}}
            @endif

            @if (($bayar_dp->snap_token !== null || $bayar_fp->snap_token !== null) && ($bayar_dp->waktu_pembayaran == null || $bayar_fp->waktu_pembayaran == null))
                <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.sb_client_key') }}"></script>

                @if ($bayar_dp->status === 'pending' || $bayar_fp->status === 'pending')
                    <script>
                        // Cari elemen <a> dengan id 'cancel-link-bayar'
                        const linkCancelElement = document.getElementById('cancel-link-bayar');

                        linkCancelElement.addEventListener('click', (e) => {
                            e.preventDefault(); // Mencegah link berpindah ke halaman baru

                            // Ambil URL dari atribut 'href' pada elemen <a>
                            const url = linkCancelElement.getAttribute('href');

                            // Buat form sementara secara dinamis
                            const form = document.createElement('form');
                            form.action = url;
                            form.method = 'POST';

                            // Tambahkan CSRF token ke dalam form
                            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                            const csrfInput = document.createElement('input');
                            csrfInput.type = 'hidden';
                            csrfInput.name = '_token';
                            csrfInput.value = csrfToken;

                            // Tambahkan elemen input CSRF token ke dalam form
                            form.appendChild(csrfInput);

                            // Tambahkan form ke dalam body dokumen
                            document.body.appendChild(form);

                            // Kirimkan permintaan POST
                            form.submit();
                        });
                    </script>
                @endif

                <script>
                    const payButton = document.getElementById('bayar');
                    payButton.addEventListener('click', function(e) {
                        const button = e.target;
                        const token = button.getAttribute('data-bs-token');
                        window.snap.pay(token, {
                            onSuccess: function(result) {
                                alert("Pembayaran sukses!");
                                location.reload();
                            },
                            onPending: function(result) {
                                alert("Menunggu pembayaran anda!");
                            },
                            onError: function(result) {
                                alert("pembayaran gagal!");
                                console.log(result);
                            },
                            onClose: function() {
                                alert('Anda menutup popup tanpa menyelesaikan pembayaran.');
                            }
                        })
                    });
                </script>
            @endif
        @endif
    @endpush
@endsection
