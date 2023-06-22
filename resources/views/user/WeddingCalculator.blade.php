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
                    <h3 class="fw-bold"> Wedding Calculator </h3>
                    <div class="row">
                        <div class="col-sm-6 col-md-8 mt-3">
                            <div class="left-call h-100 rounded p-3 shadow">
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
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="custom mt-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" id="flexSwitchCheckCustom" role="switch" type="checkbox">
                                        <label class="form-check-label" for="flexSwitchCheckCustom">
                                            <h6 class="fw-bold">Custom Pesanan</h6>
                                        </label>
                                    </div>
                                    <label class="toggle-label-custom" for="selectMenuCustom" style="display: none;">Gedung:</label>
                                    <select aria-label=".form-select-sm example" class="form-select form-select-sm toggle-select-custom" id="selectMenuCustom" style="display: none;">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    <label class="toggle-label-custom mt-2" for="selectMenuCustom" style="display: none;">Decoration:</label>
                                    <select aria-label=".form-select-sm example" class="form-select form-select-sm toggle-select-custom" id="selectMenuCustom" style="display: none;">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    <label class="toggle-label-custom mt-2" for="selectMenuCustom" style="display: none;">Catering:</label>
                                    <select aria-label=".form-select-sm example" class="form-select form-select-sm toggle-select-custom" id="selectMenuCustom" style="display: none;">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    <label class="toggle-label-custom mt-2" for="selectMenuCustom" style="display: none;">MUA:</label>
                                    <select aria-label=".form-select-sm example" class="form-select form-select-sm toggle-select-custom" id="selectMenuCustom" style="display: none;">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    <label class="toggle-label-custom mt-2" for="selectMenuCustom" style="display: none;">Wedding Organizer:</label>
                                    <select aria-label=".form-select-sm example" class="form-select form-select-sm toggle-select-custom" id="selectMenuCustom" style="display: none;">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    <label class="toggle-label-custom mt-2" for="selectMenuCustom" style="display: none;">Musik:</label>
                                    <select aria-label=".form-select-sm example" class="form-select form-select-sm toggle-select-custom" id="selectMenuCustom" style="display: none;">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    <label class="toggle-label-custom mt-2" for="selectMenuCustom" style="display: none;">Photograph:</label>
                                    <select aria-label=".form-select-sm example" class="form-select form-select-sm toggle-select-custom" id="selectMenuCustom" style="display: none;">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    <label class="toggle-label-custom mt-2" for="selectMenuCustom" style="display: none;">Master Of Cermony:</label>
                                    <select aria-label=".form-select-sm example" class="form-select form-select-sm toggle-select-custom" id="selectMenuCustom" style="display: none;">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    <label class="toggle-label-custom mt-2" for="selectMenuCustom" style="display: none;">Tarian:</label>
                                    <select aria-label=".form-select-sm example" class="form-select form-select-sm toggle-select-custom" id="selectMenuCustom" style="display: none;">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>

                                <div class="additional mt-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" id="flexSwitchCheckAdditional" role="switch" type="checkbox">
                                        <label class="form-check-label" for="flexSwitchCheckAdditional">
                                            <h6 class="fw-bold">Additional Vendor</h6>
                                        </label>
                                    </div>
                                    <label class="toggle-label-additional" for="selectMenu" style="display: none;">Photography:</label>
                                    <select aria-label=".form-select-sm example" class="form-select form-select-sm toggle-select-additional" id="selectMenu" style="display: none;">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    <label class="toggle-label-additional mt-2" for="selectMenu" style="display: none;">MUA:</label>
                                    <select aria-label=".form-select-sm example" class="form-select form-select-sm toggle-select-additional" id="selectMenu" style="display: none;">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    <label class="toggle-label-additional mt-2" for="selectMenu" style="display: none;">MC:</label>
                                    <select aria-label=".form-select-sm example" class="form-select form-select-sm toggle-select-additional" id="selectMenu" style="display: none;">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    <label class="toggle-label-additional mt-2" for="selectMenu" style="display: none;">Music:</label>
                                    <select aria-label=".form-select-sm example" class="form-select form-select-sm toggle-select-additional" id="selectMenu" style="display: none;">
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
                            <div class="right-call h-100 rounded p-3 shadow">
                                <h5 class="fw-bold">Petunjuk Pengisian</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 justify-content-center">
                            <div class="rincian rounded py-5 px-3 text-center shadow">
                                <h6 class="fw-bold">Estimasi biaya yang harus anda keluarkan adalah sebesar:</h6>
                                <h3 class="fw-bold my-4">Rp.198.000.000</h3>
                                <p class="rounded">Biaya diatas hanya biaya perkiraan saja, harga masih bisa berubah sesuai kesepakatan antara vendor dan klien!</p>
                                <a class="btn btn-primary mt-2" href="#">Cetak Hasil Simulasi <i class="bi bi-printer-fill ms-2"></i></a>
                                <a class="btn btn-primary mt-2" href="#">Konsultasikan Hasil Simulasi <i class="bi bi-whatsapp ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
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
