@extends('user.layouts.UserScreen')
@section('title', 'Wedding Calculator')

@push('styles')
<link href="{{ asset('templates') }}/assets/css-modif/user/UserWeddingCalculator.css" rel="stylesheet">
@endpush

@push('head-scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush

@section('konten')
<section class="container-fluid calculator">
    <div class="container shadow rounded-2 py-3 px-4">
        <div class="row">
            <div class="col-md-9">
                <h3 class="fw-bold"> Wedding Calculator </h3>
                <div class="row">
                    <div class="col-sm-6 col-md-8 mt-3">
                        <div class="left-call shadow p-3 rounded h-100">
                            <div class="All-In">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckAllin">
                                    <label class="form-check-label" for="flexSwitchCheckAllin">
                                        <h6 class="fw-bold">Paket All In</h6>
                                    </label>
                                </div>
                                <label for="selectMenuAllIn" class="toggle-label-allin" style="display: none;">Paket All In:</label>
                                <select id="selectMenuAllIn" class="form-select form-select-sm toggle-select-allin" aria-label=".form-select-sm example" style="display: none;">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="custom mt-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckCustom">
                                    <label class="form-check-label" for="flexSwitchCheckCustom">
                                        <h6 class="fw-bold">Custom Pesanan</h6>
                                    </label>
                                </div>
                                <label for="selectMenuCustom" class="toggle-label-custom" style="display: none;">Gedung:</label>
                                <select id="selectMenuCustom" class="form-select form-select-sm toggle-select-custom" aria-label=".form-select-sm example" style="display: none;">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label for="selectMenuCustom" class="toggle-label-custom mt-2" style="display: none;">Decoration:</label>
                                <select id="selectMenuCustom" class="form-select form-select-sm toggle-select-custom" aria-label=".form-select-sm example" style="display: none;">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label for="selectMenuCustom" class="toggle-label-custom mt-2" style="display: none;">Catering:</label>
                                <select id="selectMenuCustom" class="form-select form-select-sm toggle-select-custom" aria-label=".form-select-sm example" style="display: none;">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label for="selectMenuCustom" class="toggle-label-custom mt-2" style="display: none;">MUA:</label>
                                <select id="selectMenuCustom" class="form-select form-select-sm toggle-select-custom" aria-label=".form-select-sm example" style="display: none;">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label for="selectMenuCustom" class="toggle-label-custom mt-2" style="display: none;">Wedding Organizer:</label>
                                <select id="selectMenuCustom" class="form-select form-select-sm toggle-select-custom" aria-label=".form-select-sm example" style="display: none;">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label for="selectMenuCustom" class="toggle-label-custom mt-2" style="display: none;">Musik:</label>
                                <select id="selectMenuCustom" class="form-select form-select-sm toggle-select-custom" aria-label=".form-select-sm example" style="display: none;">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label for="selectMenuCustom" class="toggle-label-custom mt-2" style="display: none;">Photograph:</label>
                                <select id="selectMenuCustom" class="form-select form-select-sm toggle-select-custom" aria-label=".form-select-sm example" style="display: none;">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label for="selectMenuCustom" class="toggle-label-custom mt-2" style="display: none;">Master Of Cermony:</label>
                                <select id="selectMenuCustom" class="form-select form-select-sm toggle-select-custom" aria-label=".form-select-sm example" style="display: none;">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label for="selectMenuCustom" class="toggle-label-custom mt-2" style="display: none;">Tarian:</label>
                                <select id="selectMenuCustom" class="form-select form-select-sm toggle-select-custom" aria-label=".form-select-sm example" style="display: none;">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>

                            <div class="additional mt-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckAdditional">
                                    <label class="form-check-label" for="flexSwitchCheckAdditional">
                                        <h6 class="fw-bold">Additional Vendor</h6>
                                    </label>
                                </div>
                                <label for="selectMenu" class="toggle-label-additional" style="display: none;">Photography:</label>
                                <select id="selectMenu" class="form-select form-select-sm toggle-select-additional" aria-label=".form-select-sm example" style="display: none;">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label for="selectMenu" class="toggle-label-additional mt-2" style="display: none;">MUA:</label>
                                <select id="selectMenu" class="form-select form-select-sm toggle-select-additional" aria-label=".form-select-sm example" style="display: none;">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label for="selectMenu" class="toggle-label-additional mt-2" style="display: none;">MC:</label>
                                <select id="selectMenu" class="form-select form-select-sm toggle-select-additional" aria-label=".form-select-sm example" style="display: none;">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label for="selectMenu" class="toggle-label-additional mt-2" style="display: none;">Music:</label>
                                <select id="selectMenu" class="form-select form-select-sm toggle-select-additional" aria-label=".form-select-sm example" style="display: none;">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>

                            </div>
                            <button class="btn btn-primary mt-3">Kalkulasi Biaya<i class="bi bi-calculator ms-2"></i></button>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 mt-3">
                        <div class="right-call shadow p-3 rounded h-100">
                            <h5 class="fw-bold">Petunjuk Pengisian</h5>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 justify-content-center">
                        <div class="rincian shadow rounded text-center py-5 px-3">
                            <h6 class="fw-bold">Estimasi biaya yang harus anda keluarkan adalah sebesar:</h6>
                            <h3 class="fw-bold my-4">Rp.198.000.000</h3>
                            <p class="rounded">Biaya diatas hanya biaya perkiraan saja, harga masih bisa berubah sesuai kesepakatan antara vendor dan klien!</p>
                            <a href="#" class="btn btn-primary mt-2">Cetak Hasil Simulasi <i class="bi bi-printer-fill ms-2"></i></a>
                            <a href="#" class="btn btn-primary mt-2">Konsultasikan Hasil Simulasi <i class="bi bi-whatsapp ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                @foreach ($products as $key => $value)
                <div class="product-new d-flex justify-content-center">
                    <div class="card mt-3" style="max-width: 18rem;">
                        <img src="storage/post-images/{{ $value->gambar }}" class="card-img-top" alt="produk-{{ $key }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ Str::words($value->nama_produk) }}</h5>
                            <div class="category my-2">
                                <span><i class="bi bi-bookmark-fill"></i></span>
                                <span>{{ Str::words($value->category_products->nama_kategori) }}</span>
                            </div>
                            <p class="card-text">{!! Str::words($value->deskripsi, 10) !!}</p>
                            <a class="fst-italic" href={{ route('produk.show', $value->id) }}>Selengkapnya <i class="bi bi-arrow-right"></i></a>
                            <span class="badge bg-primary position-absolute top-0 end-0">Terbaru</span>
                        </div>
                    </div>
                </div>
                @endforeach
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
        });

        $('#flexSwitchCheckCustom').on('change', function() {
            $('.toggle-select-custom').toggle();
            $('.custom .toggle-label-custom').toggle();
        });

        $('#flexSwitchCheckAdditional').on('change', function() {
            $('.toggle-select-additional').toggle();
            $('.additional .toggle-label-additional').toggle();
        });
    });
</script>
@endpush
@endsection