@extends('dashboard.admin.layouts.layouts')
@section('title', 'Manage Akun')
@push('styles')
    <link href="{{ asset('templates') }}/assets/css-modif/admin/ManageAkun.css" rel="stylesheet">
@endpush
@section('content')
    <section class="manage-akun">
        <div class="content-wrapper">
            <div class="row same-height">
                <div>
                    <div class="card container">
                        <div class="card-header">
                            <h4 class="text-center">Tambah Akun</h4>
                        </div>
                        @if (session()->has('success_add_account'))
                            <div class="alert alert-success">{{ session()->get('success_add_account') }}</div>
                        @elseif (session()->has('failed_add_account'))
                            <div class="alert alert-danger">{{ session()->get('failed_add_account') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="pt-3">
                                <div class="alert alert-danger">
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
                            <form action="{{ Route::is('manage-akun.edit') ? route('manage-akun.update', $hashids->encode($adminedit->id)) : route('manage-akun.store') }}" enctype='multipart/form-data' method="post">
                                @if (Route::is('manage-akun.edit'))
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
                                    @if (!Route::is('manage-akun.edit'))
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
                                    @if (Route::is('manage-akun.edit'))
                                        <div class="mt-3 btn-add row justify-content-center align-content-center">
                                            <button class="btn mb-2 icon-left btn-success" type="submit"><i class="ti-check"></i>update</i></button>
                                        </div>
                                    @else
                                        <div class="mt-3 btn-add row justify-content-center align-content-center">
                                            <button class="btn mb-2 icon-left btn-success" type="submit"><i class="ti-check"></i>Simpan</i></button>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="card container">
                        <div class="card-header">
                            <h4>List Produk</h4>
                        </div>
                        <div class="card-body">
                            <table class="table display" id="table-admins">
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
                                    @foreach ($get_admins as $i => $admin)
                                        <tr>
                                            <td>{{ $admin->nama_depan }} {{ $admin->nama_belakang }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->phone_number }}</td>
                                            <td>{{ $admin->role->level }}</td>
                                            <td>
                                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                    <button class="btn btn-warning" data-route="{{ route('manage-akun.edit', $hashids->encode($admin->id)) }}" id="edit-button"><i class="bi bi-pencil-square"></i></button>
                                                    <button class="btn btn-danger" data-route="{{ route('manage-akun.destroy', $hashids->encode($admin->id)) }}" id="delete-button"><i class="bi bi-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
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

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table-admins').DataTable({
                responsive: true,
            });
        });
    </script>
    <script>
        let buttonEdit = document.querySelectorAll('#edit-button');
        buttonEdit.forEach((btn) => {
            btn.addEventListener('click', function(e) {
                e.preventDefault(); // Menghentikan aksi default dari tombol
                let route = btn.getAttribute('data-route'); // Mengambil nilai data-route dari atribut data pada tombol
                window.location.href = route; // Mengganti URL di browser dengan nilai data-route
            })
        })
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
    </script>
@endpush
