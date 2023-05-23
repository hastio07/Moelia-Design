@extends('dashboard.admin.layouts.layouts')
@section('title', 'Manage Akun')
@section('content')
<section class="manage-akun">
    <div class="content-wrapper">
        <div class="row same-height">
            <div>
                <div class="card container">
                    <div class="card-header">
                        <h4 class="text-center">Tambah Akun</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ Request::is('dashboard/manage-akun/*/edit') ? route('manage-akun.update', $hashids->encode($adminedit->id)) : route('manage-akun.store') }}" enctype='multipart/form-data' method="post">
                            @if (request()->is('dashboard/manage-akun/*/edit'))
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
                                @if (!request()->is('dashboard/manage-akun/*/edit'))
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
                                @if (request()->is('dashboard/manage-akun/*/edit'))
                                <div class="mt-3 btn-add row justify-content-center align-content-center">
                                    <button class="btn mb-2 icon-left btn-success" type="submit"><i class="ti-check"></i>update</i></button>
                                </div>
                                @else
                                <div class="mt-3 btn-add row justify-content-center align-content-center">
                                    <button class="btn mb-2 icon-left btn-success" type="submit"><i class="ti-check"></i>Simpan</i></button>
                                </div>
                                @endif
                            </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="card container">
                    <div class="card-header">
                        <h4>List Produk</h4>
                    </div>
                    <div class="card-body">
                        <table class="table display" id="example2">
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
                                            <a class="href" href="{{ route('manage-akun.edit', $hashids->encode($admin->id)) }}">
                                                <button class="btn btn-warning" id="tombol-ubah-{{ ++$i }}" title="Edit {{ $admin->nama_depan }}" type="button"><i class="bi bi-pencil-square"></i></button>
                                            </a>
                                            <form action="{{ route('manage-akun.destroy', $hashids->encode($admin->id)) }}" class="d-inline" method="post">

                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger" id="tombol-hapus-{{ ++$i }}" title="Hapus {{ $admin->nama_depan }}" type="submit"><i class="bi bi-trash"></i></button>

                                            </form>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</section>
@endsection
