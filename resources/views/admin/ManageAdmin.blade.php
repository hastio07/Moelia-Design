@extends('admin.layouts.layouts')
@section('title', 'Manage Admin')
@push('styles')
    <link href="{{ asset('templates') }}/assets/css-modif/admin/ManageAkun.css" rel="stylesheet">
@endpush
@section('content')
    <section class="manage-akun">
        <div class="content-wrapper container">
            <div class="row same-height">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Tambah Akun Admin</h4>
                    </div>
                    @if (session()->has('success_add_account'))
                        <div class="alert alert-success">{{ session()->get('success_add_account') }}</div>
                    @elseif (session()->has('failed_add_account'))
                        <div class="alert alert-danger">{{ session()->get('failed_add_account') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="pt-3">
                            <div class="alert alert-danger text-capitalize">
                                <p>Lengkapi Data!</p>
                                <ul class="pt=10" style="list-style:none;">
                                    @foreach ($errors->all() as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    <div class="card-body">
                        <form action="{{ Route::is('manage-admin.edit') ? route('manage-admin.update', $hashids->encode($adminedit->id)) : route('manage-admin.store') }}" enctype='multipart/form-data' method="post">
                            @if (Route::is('manage-admin.edit'))
                                @method('put')
                            @endif
                            @csrf
                            <div class="login-form">
                                <!-- Nama Input-->
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label" for="nama_depan">Nama Depan</label>
                                        <input class="form-control bg-transparent" id="nama_depan" name="nama_depan" placeholder="Masukkan nama depan" required type="text" value="{{ old('nama_depan', isset($adminedit) ? $adminedit->nama_depan : '') }}">
                                    </div>
                                    <div class="col">
                                        <label class="form-label" for="nama_belakang">Nama Belakang</label>
                                        <input class="form-control bg-transparent" id="nama_belakang" name="nama_belakang" placeholder="Masukkan nama belakang" required type="text" value="{{ old('nama_belakang', isset($adminedit) ? $adminedit->nama_belakang : '') }}">
                                    </div>
                                </div>
                                <!-- Email Input-->
                                <label class="form-label" for="email">Email</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-transparent"><i class="bi bi-envelope"></i></span>
                                    <input class="form-control bg-transparent" id="email" name="email" placeholder="Masukkan email" required type="email" value="{{ old('email', isset($adminedit) ? $adminedit->email : '') }}">
                                </div>
                                <!-- No. Hp-->
                                <label class="form-label" for="nomor_telepon">Nomor Handphone</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-transparent"><i class="bi bi-phone"></i></span>
                                    <input class="form-control bg-transparent" id="nomor_telepon" name="phone_number" placeholder="Masukkan nomor handphone" required type="tel" value="{{ old('phone_number', isset($adminedit) ? $adminedit->phone_number : '') }}">
                                </div>
                                <!-- Pilih Role  -->
                                <labe class="form-label" for="role_select">Pilih Role</labe>
                                <select class="form-select form-select-sm" id="role_select" name="role_id" required>
                                    <option disabled selected value="">-- Pilih Role --</option>
                                    <option {{ isset($adminedit) && $adminedit->role_id == 2 ? 'selected' : '' }} value="2">Admin
                                    </option>
                                </select>
                                @if (!Route::is('manage-admin.edit'))
                                    <!-- Password Input-->
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label" for="password">Password</label>
                                            <input class="form-control bg-transparent" id="password" name="password" placeholder="Masukkan password" required type="password">
                                        </div>
                                        <div class="col">
                                            <label class="form-label" for="password_confirmation">Ulangi
                                                Password</label>
                                            <input class="form-control bg-transparent" id="password_confirmation" name="password_confirmation" placeholder="Masukkan ulang password" required type="password">
                                        </div>
                                    </div>
                                @endif
                                @if (Route::is('manage-admin.edit'))
                                    <div class="btn-add row justify-content-center align-content-center mt-3">
                                        <button class="btn icon-left btn-success mb-2" type="submit"><i class="ti-check"></i>update</i></button>
                                    </div>
                                @else
                                    <div class="btn-add row justify-content-center align-content-center mt-3">
                                        <button class="btn icon-left btn-success mb-2" type="submit"><i class="ti-check"></i>Simpan</i></button>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Akun Admin</h4>
                    </div>
                    <div class="card-body">
                        <table class="display table" id="table-admins">
                            <thead>
                                <tr>
                                    <th>Nama Admin</th>
                                    <th>E-Mail</th>
                                    <th>No. Handphone</th>
                                    <th>Role Akun</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama Admin</th>
                                    <th>E-Mail</th>
                                    <th>No. Handphone</th>
                                    <th>Role Akun</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Akun Masyarakat</h4>
                    </div>
                    @if (session()->has('msg-tb-user'))
                        <div class="alert alert-success">{{ session()->get('msg-tb-user') }}</div>
                    @endif
                    <div class="card-body">
                        <table class="display table" id="table-users">
                            <thead>
                                <tr>
                                    <th>Nama User</th>
                                    <th>E-Mail</th>
                                    <th>No. Handphone</th>
                                    <th>Role Akun</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Hastio Wahyu</td>
                                    <td>hastio@gmail.com</td>
                                    <td>081258666661</td>
                                    <td>Masyarakat</td>
                                    <td>
                                        <button class="btn btn-danger">Hapus</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama User</th>
                                    <th>E-Mail</th>
                                    <th>No. Handphone</th>
                                    <th>Role Akun</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table-admins').DataTable({
                processing: true,
                searching: true,
                serverSide: true,
                responsive: true,
                ordering: true,
                ajax: {
                    url: "{{ route('manage-admin.renderDataTableAdmins') }}",
                },
                columnDefs: [{
                    orderable: false,
                    searchable: false,
                    targets: 4
                }],
                columns: [{
                        data: 'nama_admin',
                        name: 'nama_admin'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number',
                    },
                    {
                        data: 'role_id',
                        name: 'role_id',
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ],
                order: [],
                drawCallback: function(settings) {
                    let buttonEdit = document.querySelectorAll('#edit-button');
                    buttonEdit.forEach((btn) => {
                        btn.addEventListener('click', function(e) {
                            e.preventDefault(); // Menghentikan aksi default dari tombol
                            let route = btn.getAttribute('data-route'); // Mengambil nilai data-route dari atribut data pada tombol
                            window.location.href = route; // Mengganti URL di browser dengan nilai data-route
                        })
                    })
                    let buttonDelete = document.querySelectorAll('#delete-button-admin');
                    buttonDelete.forEach((btn) => {
                        btn.addEventListener('click', function(e) {
                            e.preventDefault(); // Menghentikan aksi default dari tombol
                            let route = btn.getAttribute('data-route'); // Mengambil nilai data-route dari atribut data pada tombol

                            // Membuat elemen form baru
                            let form = document.createElement('form');
                            form.action = route;
                            form.method = 'POST';
                            // Menambahkan input _token dengan nilai token CSRF
                            csrfField = document.createElement('input');
                            csrfField.type = 'hidden';
                            csrfField.name = '_token';
                            csrfField.value = '{{ csrf_token() }}';
                            form.appendChild(csrfField);
                            // Menambahkan input _method dengan nilai 'DELETE'
                            const createField = document.createElement('input');
                            createField.type = 'hidden';
                            createField.name = '_method';
                            createField.value = 'DELETE';
                            csrfField.insertAdjacentElement('beforebegin', createField);
                            // Menambahkan form ke dalam dokumen
                            document.body.appendChild(form);

                            // Mengirimkan form secara otomatis
                            form.submit();
                        })
                    })
                }
            });
        });
    </script>

    <script>
        $('#table-users').DataTable({
            processing: true,
            searching: true,
            serverSide: true,
            responsive: true,
            ordering: true,
            ajax: {
                url: "{{ route('manage-admin.renderDataTableUsers') }}",
            },
            columnDefs: [{
                orderable: false,
                searchable: false,
                targets: 3
            }],
            columns: [{
                    data: 'nama_user',
                    name: 'nama_user'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'role_id',
                    name: 'role_id',
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                },
            ],
            order: [],
            drawCallback: function(settings) {
                let buttonDelete = document.querySelectorAll('#delete-button');
                buttonDelete.forEach((btn) => {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault(); // Menghentikan aksi default dari tombol
                        let route = btn.getAttribute('data-route'); // Mengambil nilai data-route dari atribut data pada tombol

                        // Membuat elemen form baru
                        let form = document.createElement('form');
                        form.action = route;
                        form.method = 'POST';
                        // Menambahkan input _token dengan nilai token CSRF
                        csrfField = document.createElement('input');
                        csrfField.type = 'hidden';
                        csrfField.name = '_token';
                        csrfField.value = '{{ csrf_token() }}';
                        form.appendChild(csrfField);
                        // Menambahkan input _method dengan nilai 'DELETE'
                        const createField = document.createElement('input');
                        createField.type = 'hidden';
                        createField.name = '_method';
                        createField.value = 'DELETE';
                        csrfField.insertAdjacentElement('beforebegin', createField);
                        // Menambahkan form ke dalam dokumen
                        document.body.appendChild(form);

                        // Mengirimkan form secara otomatis
                        form.submit();
                    })
                })
            }
        });
    </script>
@endpush
