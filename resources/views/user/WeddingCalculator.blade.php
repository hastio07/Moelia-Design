@extends('user.layouts.UserScreen')
@section('title', 'Wedding Calculator')

@push('styles')
<link href="{{ asset('templates') }}/assets/css-modif/user/UserWeddingCalculator.css" rel="stylesheet">
@endpush

@push('head-scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
@endpush

@section('konten')
<section class="container-fluid calculator">
    <div class="rounded-2 container py-3 px-4 shadow">
        <div class="row">
            <div class="col-md-9">

                <div class="row">
                    <div class="col-12">
                        <div class="left-call h-100 rounded p-3 shadow">
                            <div class="header mb-4 text-center">
                                <h3 class="fw-bold"> Wedding Calculator </h3>
                                <p class="fw-bold text-secondary">Simulasikan Biaya pernikahan Anda Untuk Mendapatkan Biaya Sewa Terbaik</p>
                                <div class="line"></div>
                            </div>
                            <div class="All-In">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" id="flexSwitchCheckAllin" role="switch" type="checkbox">
                                    <label class="form-check-label" for="flexSwitchCheckAllin">
                                        <h6 class="fw-bold">Paket All In</h6>
                                    </label>
                                </div>
                                <label class="toggle-label-allin" for="selectMenuAllIn" style="display: none;">Paket All In:</label>
                                <select aria-label=".form-select-sm example" class="form-select form-select-sm toggle-select-allin" id="selectMenuAllIn" style="display: none;">
                                    <option selected>Open this select menu</option>
                                    @foreach ($calallin as $calallin)
                                    <option value="{{ $calallin->harga }}">
                                        <p>{{ $calallin->nama_paket }} - </p>
                                        <p>{{ 'Rp ' . number_format($calallin->harga, 0, ',', '.') }}</p>

                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="custom mt-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" id="flexSwitchCheckCustom" role="switch" type="checkbox">
                                    <label class="form-check-label" for="flexSwitchCheckCustom">
                                        <h6 class="fw-bold">Custom Pesanan</h6>
                                    </label>
                                </div>
                                @foreach ($categorycustomvenue as $categorycustomvenue)
                                <label class="toggle-label-custom" for="selectMenuCustom" style="display: none;">{{ $categorycustomvenue->nama }}:</label>
                                <select aria-label=".form-select-sm example" class="form-select form-select-sm toggle-select-custom" id="selectMenuCustom" style="display: none;">
                                    <option selected>Open this select menu</option>
                                    @foreach ($categorycustomvenue->customvenue as $customvenue)
                                    <option value="{{ $customvenue->harga }}">
                                        <p>{{ $customvenue->nama_paket }} - </p>
                                        <p>{{ 'Rp ' . number_format($customvenue->harga, 0, ',', '.') }}</p>
                                    </option>
                                    @endforeach
                                </select>
                                @endforeach
                            </div>

                            <div class="additional mt-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" id="flexSwitchCheckAdditional" role="switch" type="checkbox">
                                    <label class="form-check-label" for="flexSwitchCheckAdditional">
                                        <h6 class="fw-bold">Additional Vendor</h6>
                                    </label>
                                </div>
                                @foreach ($categoryadditionalvenue as $categoryadditionalvenue)
                                <label class="toggle-label-additional" for="selectMenu" style="display: none;">{{ $categoryadditionalvenue->nama }}</label>
                                <select aria-label=".form-select-sm example" class="form-select form-select-sm toggle-select-additional" id="selectMenu" style="display: none;">
                                    <option selected>Open this select menu</option>
                                    @foreach ($categoryadditionalvenue->additionalvenue as $additionalvenue)
                                    <option value="{{ $additionalvenue->harga }}">
                                        <p>{{ $additionalvenue->nama_paket }} - </p>
                                        <p>{{ 'Rp ' . number_format($additionalvenue->harga, 0, ',', '.') }}</p>
                                    </option>
                                    @endforeach
                                </select>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-6 justify-content-center mt-3">
                        <div class="rincian rounded py-5 px-3 text-center shadow">
                            <h6 class="fw-bold">Estimasi biaya yang harus anda keluarkan adalah sebesar:</h6>
                            <h3 class="fw-bold total-amount my-4">-----</h3>
                            <p class="disclaimer-text text-danger"></p>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <div class="right-call text-secondary rounded p-3 shadow">
                            <h6 class="fw-bold">Catatan!</h6>
                            <p class="mb-0">jika ingin melakukan konsultasi terkait hasil simulasi anda</p>
                            <ol>
                                <li>Screenshoot hasil simulasi anda</li>
                                <li>Chat admin menggunakan button whatsapp</li>
                                <li>Kirimkan hasil simulasi dan tunggu admin untuk membalas</li>
                            </ol>
                            <a class="btn btn-primary mt-3" href="https://wa.me/+62{{ $contact->whatsapp1_number }}?text=Harap Kirimkan Hasil Screenshoot anda!">Konsultasikan <i class="bi bi-whatsapp ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                @if ($products->isEmpty())
                <div class="d-flex justify-content-center align-items-center container" style="height: 50vh;">
                    <div class="text-center">
                        <div class="container">
                            <img alt="Phone image" class="img-fluid" src="{{ asset('templates') }}/assets/images/data-kosong.jpg" style="max-width: 200px; max-height: 200px;">
                        </div>
                        <h5 class="fw-bold text-secondary mt-2">Produk Terbaru Saat Ini Belum Tesedia!!</h5>
                    </div>
                </div>
                @else
                @foreach ($products as $key => $value)
                <div class="product-new d-flex justify-content-center">
                    <div class="card mt-3" style="max-width: 18rem;">
                        <img alt="produk-{{ $key }}" class="card-img-top" src="storage/post-images/{{ $value->gambar }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ Str::words($value->nama_produk) }}</h5>
                            <div class="category my-2">
                                <span><i class="bi bi-bookmark-fill"></i></span>
                                <span>{{ Str::words($value->category_products->nama_kategori) }}</span>
                            </div>
                            <p class="card-text">{!! Str::words($value->deskripsi, 10) !!}</p>
                            <a class="fst-italic" href={{ route('produk.show', $value->id) }}>Selengkapnya <i class="bi bi-arrow-right"></i></a>
                            <span class="badge bg-primary position-absolute end-0 top-0">Terbaru</span>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif

            </div>
        </div>
    </div>
</section>
@push('scripts')
<script>
    $(document).ready(function() {
        $('.toggle-select-allin, .toggle-select-custom, .toggle-select-additional').hide();

        $('#flexSwitchCheckAllin').on('change', function() {
            $('.toggle-select-allin').toggle();
            $('.All-In .toggle-label-allin').toggle();
            hitungTotal();
        });

        $('#flexSwitchCheckCustom').on('change', function() {
            $('.toggle-select-custom').toggle();
            $('.custom .toggle-label-custom').toggle();
            hitungTotal();
        });

        $('#flexSwitchCheckAdditional').on('change', function() {
            $('.toggle-select-additional').toggle();
            $('.additional .toggle-label-additional').toggle();
            hitungTotal();
        });

        $('select').on('change', function() {
            hitungTotal();
        });

        function hitungTotal() {
            var total = 0;

            $('.toggle-select-allin, .toggle-select-custom, .toggle-select-additional').each(function() {
                var selectedValue = parseInt($(this).val()) || 0;
                total += selectedValue;
            });

            var formattedTotal = formatNumber(total);
            $('.total-amount').text('Rp ' + formattedTotal);

            var disclaimerText = "Biaya di atas hanya biaya perkiraan saja, harga masih bisa berubah sesuai kesepakatan antara vendor dan klien!";
            $('.disclaimer-text').text(disclaimerText);

            if (total > 0) {
                $('.disclaimer-text').css('display', 'block');
            } else {
                $('.disclaimer-text').css('display', 'none');
            }
        }

        function formatNumber(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    });

</script>
@endpush
@endsection
