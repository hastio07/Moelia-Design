@extends('dashboard.admin.layouts.layouts')
@section('title', 'Manage Perusahaan')

@section('content')
    <section>
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div aria-labelledby="home-tab" class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" tabindex="0">
                            <div class="content-wrapper">
                                <div class="row same-height">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="wrapper-list">
                                                    <div class="flex-header text-center">
                                                        <h6>Manage Perusahaan</h5>
                                                    </div>
                                                    <div class="flex-container">
                                                        <div class="flex-item label">Foto & Nama Owner</div>
                                                        <form action="{{ route('manage-perusahaan.updateorcreateowner') }}" class="formstyle" enctype="multipart/form-data" id="formOwner" method="POST">
                                                            <div class="flex-item form">
                                                                @csrf
                                                                <input name="id_owner" type="hidden" value="{{ $owners->id ?? '' }}">
                                                                <input name="oldfoto_owner" type="hidden" value="{{ $owners->foto_owner ?? '' }}">
                                                                <label class="form-label" for="nama_owner">Nama Owner</label>
                                                                <input class="form-control" id="nama_owner" name="nama_owner" placeholder="Masukkan nama owner" type="text" value="{{ $owners->nama_owner ?? '' }}">
                                                                <label class="form-label" for="foto_owner">Foto Owner</label>
                                                                <input class="form-control" id="foto_owner" name="foto_owner" type="file">
                                                            </div>
                                                            <div class="flex-item button">
                                                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                                    <button class="btn btn-success" type="submit"><i class="bi bi-upload"></i></button>
                                                                    @if (!empty($owners) && ($owners->nama_owner || $owners->foto_owner))
                                                                        <button class="btn btn-danger" data-bs-route="{{ route('manage-perusahaan.deleteowner', $owners->id) }}" id="btnDelete" type="submit"><i class="bi bi-trash"></i></button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="flex-container">
                                                        <div class="flex-item label">Logo & Nama Perusahaan</div>
                                                        <form action="{{ route('manage-perusahaan.updateorcreatecompany') }}" class="formstyle" enctype="multipart/form-data" id="formCompany" method="POST">
                                                            <div class="flex-item form">
                                                                @csrf
                                                                <input name="id_perusahaan" type="hidden" value="{{ $companies->id ?? '' }}">
                                                                <input name="oldlogo_perusahaan" type="hidden" value="{{ $companies->logo_perusahaan ?? '' }}">
                                                                <label class="form-label" for="nama_perusahaan">Nama Perusahaan</label>
                                                                <input class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Masukkan nama perusahaan" type="text" value="{{ old('username', $companies->nama_perusahaan ?? '') }}">
                                                                <label class="form-label" for="logo">Logo Perusahaan</label>
                                                                <input accept="image/jpg, image/png, image/jpeg" class="form-control" id="logo" name="logo_perusahaan" type="file">
                                                            </div>
                                                            <div class="flex-item button">
                                                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                                    <button class="btn btn-success" type="submit"><i class="bi bi-upload"></i></button>
                                                                    @if (!empty($companies) && ($companies->nama_perusahaan || $companies->logo_perusahaan))
                                                                        <button class="btn btn-danger" data-bs-route="{{ route('manage-perusahaan.deletecompany', $companies->id) }}" id="btnDelete" type="submit"><i class="bi bi-trash"></i></button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="flex-container">
                                                        <div class="flex-item label">Alamat Perusahaan</div>
                                                        <form action="{{ route('manage-perusahaan.updateorcreateaddress') }}" class="formstyle" enctype="multipart/form-data" id="formAlamat" method="POST">
                                                            <div class="flex-item form">
                                                                @csrf
                                                                <input name="id_alamat" type="hidden" value="{{ $addresses->id ?? '' }}">
                                                                <input class="form-control" id="alamat_perusahaan" name="alamat_perusahaan" placeholder="Masukkan alamat perusahaan" type="text" value="{{ $addresses->alamat_perusahaan ?? '' }}">
                                                            </div>
                                                            <div class="flex-item button">
                                                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                                    <button class="btn btn-success" type="submit"><i class="bi bi-upload"></i></button>
                                                                    @if (!empty($addresses) && $addresses->alamat_perusahaan)
                                                                        <button class="btn btn-danger" data-bs-route="{{ route('manage-perusahaan.deleteaddress', $addresses->id) }}" id="btnDelete" type="submit"><i class="bi bi-trash"></i></button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="flex-container">
                                                        <div class="flex-item label">Kontak</div>
                                                        <form action="{{ route('manage-perusahaan.updateorcreatcontact') }}" class="formstyle" enctype="multipart/form-data" id="formContact" method="POST">
                                                            <div class="flex-item form">
                                                                @csrf
                                                                <input name="id_contact" type="hidden" value="{{ $contacts->id ?? '' }}">
                                                                <label class="form-label" for="telephone_1">Telephone 1</label>
                                                                <input class="form-control" id="telephone_1" name="telephone_1" placeholder="Masukkan nomor telephone 1" type="text" value="{{ $contacts->telephone_1 ?? '' }}">
                                                                <label class="form-label" for="telephone_2">Telephone 2</label>
                                                                <input class="form-control" id="telephone_2" name="telephone_2" placeholder="Masukkan nomor telephone 2" type="text" value="{{ $contacts->telephone_2 ?? '' }}">
                                                                <label class="form-label" for="whatsapp_1">Whatsapp 1</label>
                                                                <input class="form-control" id="whatsapp_1" name="whatsapp_1" placeholder="Masukkan nomor whatsapp 1" type="text" value="{{ $contacts->whatsapp_1 ?? '' }}">
                                                                <label class="form-label" for="whatsapp_2">whatsapp 2</label>
                                                                <input class="form-control" id="whatsapp_2" name="whatsapp_2" placeholder="Masukkan nomor whatsapp 2" type="text" value="{{ $contacts->whatsapp_2 ?? '' }}">
                                                                <label class="form-label" for="email">Email</label>
                                                                <input class="form-control" id="email" name="email" placeholder="Masukkan email" type="email" value="{{ $contacts->email ?? '' }}">
                                                            </div>
                                                            <div class="flex-item button">
                                                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                                    <button class="btn btn-success" type="submit"><i class="bi bi-upload"></i></button>
                                                                    @if (!empty($contacts) && ($contacts->telephone_1 || $contacts->telephone_2 || $contacts->whatsapp_1 || $contacts->whatsapp_2 || $contacts->email))
                                                                        <button class="btn btn-danger" data-bs-route="{{ route('manage-perusahaan.deletecontact', $contacts->id) }}" id="btnDelete" type="submit"><i class="bi bi-trash"></i></button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="flex-container">
                                                        <div class="flex-item label">Sosial Media</div>
                                                        <form action="{{ route('manage-perusahaan.updateorcreatsosmed') }}" class="formstyle" enctype="multipart/form-data" id="formSosmed" method="POST">
                                                            <div class="flex-item form">
                                                                @csrf
                                                                <input name="id_sosmed" type="hidden" value="{{ $sosmeds->id ?? '' }}">
                                                                <label class="form-label" for="instagram">Instagram</label>
                                                                <input class="form-control" id="instagram" name="instagram" placeholder="Masukkan username instagram" type="text" value="{{ $sosmeds->instagram ?? '' }}">
                                                                <label class="form-label" for="facebook">Facebook</label>
                                                                <input class="form-control" id="facebook" name="facebook" placeholder="Masukkan username facebook" type="text" value="{{ $sosmeds->facebook ?? '' }}">
                                                                <label class="form-label" for="twitter">Twitter</label>
                                                                <input class="form-control" id="twitter" name="twitter" placeholder="Masukkan username twitter" type="text" value="{{ $sosmeds->twitter ?? '' }}">
                                                                <label class="form-label" for="youtube">Youtube</label>
                                                                <input class="form-control" id="youtube" name="youtube" placeholder="Masukkan link channel youtube" type="text" value="{{ $sosmeds->youtube ?? '' }}">
                                                            </div>
                                                            <div class="flex-item button">
                                                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                                    <button class="btn btn-success" type="submit"><i class="bi bi-upload"></i></button>
                                                                    @if (!empty($sosmeds) && ($sosmeds->instagram || $sosmeds->facebook || $sosmeds->twitter || $sosmeds->youtube))
                                                                        <button class="btn btn-danger" data-bs-route="{{ route('manage-perusahaan.deletesosmed', $sosmeds->id) }}" id="btnDelete" type="submit"><i class="bi bi-trash"></i></button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Owner Perusahaan</h4>
                                                <hr>
                                                @if (!empty($owners))
                                                    <div class="text-center">
                                                        @if (!empty($owners->foto_owner))
                                                            <img alt="{{ $owners->nama_owner }}" class="rounded img-owner" src="/storage/{{ $owners->foto_owner }}">
                                                        @endif
                                                    </div>
                                                    <h6 class="fw-bolder">{{ $owners->nama_owner }}</h6>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Logo & Nama Perusahaan</h4>
                                                <hr>
                                                @if (!empty($companies))
                                                    <div class="text-center">
                                                        @if (!empty($companies->logo_perusahaan))
                                                            <img alt="{{ $companies->nama_perusahaan }}" class="rounded-circle" src="/storage/{{ $companies->logo_perusahaan }}">
                                                        @endif
                                                    </div>
                                                    <h6 class="fw-bolder">{{ $companies->nama_perusahaan }}</h6>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <h4 class="card-title">Alamat, Kontak & Sosial Media Perusahaan</h4>
                                                <hr>
                                                <i class="fa-sharp fa-solid fa-map-location-dot fa-2xl"></i>
                                                <p>{{ $addresses->alamat_perusahaan ?? '' }}</p>
                                                <hr>
                                                <i class="fa-solid fa-phone-volume fa-2xl"></i>
                                                <h4>{{ $contacts->telephone_1 ?? '' }}</h4>
                                                <h4>{{ $contacts->telephone_2 ?? '' }}</h4>
                                                <hr>
                                                <i class="fa-brands fa-whatsapp fa-2xl"></i>
                                                <h4>{{ $contacts->whatsapp_1 ?? '' }}</h4>
                                                <h4>{{ $contacts->whatsapp_2 ?? '' }}</h4>
                                                <hr>
                                                <i class="fa-brands fa-instagram fa-2xl"></i>
                                                <h4>{{ $sosmeds->instagram ?? '' }}</h4>
                                                <hr>
                                                <i class="fa-brands fa-facebook fa-2xl"></i>
                                                <h4>{{ $sosmeds->facebook ?? '' }}</h4>
                                                <hr>
                                                <i class="fa-brands fa-twitter fa-2xl"></i>
                                                <h4>{{ $sosmeds->twitter ?? '' }}</h4>
                                                <hr>
                                                <i class="fa-brands fa-youtube fa-2xl"></i>
                                                <h4>{{ $sosmeds->youtube ?? '' }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('manageperusahaan-scripts')
    <script>
        btnDelete = document.querySelectorAll('#btnDelete');
        btnDelete.forEach((btn) => {
            btn.addEventListener('click', function(e) {
                console.log(e.currentTarget);
                const formCompany = e.currentTarget.closest('form');
                console.log(formCompany);
                formCompany.action = e.currentTarget.getAttribute('data-bs-route');
                const createField = document.createElement('input');
                createField.type = 'hidden';
                createField.name = '_method';
                createField.value = 'delete';
                formCompany.appendChild(createField);
            })
        })
    </script>
@endpush
