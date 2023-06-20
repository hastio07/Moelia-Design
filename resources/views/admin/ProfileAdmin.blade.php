@extends('admin.layouts.layouts')
@section('title', 'Profile')

@section('content')
    <div class="card container mb-4 p-4">
        <h5 class="fw-bold ms-3">Pengaturan Akun</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3">
                    <p class="mb-0">Nama Depan</p>
                </div>
                <div class="col-lg-8">
                    <p class="text-muted mb-0" id="nama-depan">{{ auth()->user()->nama_depan }}</p>
                </div>
                <div class="col-lg-1">
                    <button class="btn shadow-0" data-btn-id="btn-edit-nama-depan" data-status="edit" id="btn-edit-nama-depan" onclick="toggleEdit(this)"><i class="bi bi-pencil"></i></button>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-3">
                    <p class="mb-0">Nama Belakang</p>
                </div>
                <div class="col-lg-8">
                    <p class="text-muted mb-0" id="nama-belakang">{{ auth()->user()->nama_belakang }}</p>
                </div>
                <div class="col-lg-1">
                    <button class="btn shadow-0" data-btn-id="btn-edit-nama-belakang" data-status="edit" id="btn-edit-nama-belakang" onclick="toggleEdit(this)"><i class="bi bi-pencil"></i></button>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-3">
                    <p class="mb-0">Email</p>
                </div>
                <div class="col-lg-8">
                    <p class="text-muted mb-0" id="email">{{ auth()->user()->email }}</p>
                </div>
                <div class="col-lg-1">
                    <button class="btn shadow-0" data-btn-id="btn-edit-email" data-status="edit" id="btn-edit-email" onclick="toggleEdit(this)"><i class="bi bi-pencil"></i></button>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-3">
                    <p class="mb-0">No. Handphone</p>
                </div>
                <div class="col-lg-8">
                    <p class="text-muted mb-0" id="phone-number">{{ auth()->user()->phone_number }}</p>
                </div>
                <div class="col-lg-1">
                    <button class="btn shadow-0" data-btn-id="btn-edit-phone-number" data-status="edit" id="btn-edit-phone-number" onclick="toggleEdit(this)"><i class="bi bi-pencil"></i></button>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-3">
                    <p class="mb-0">Password</p>
                </div>
                <div class="col-lg-8">
                    <p class="text-muted mb-0" id="password">**********</p>
                </div>
                <div class="col-lg-1">
                    <button class="btn shadow-0" data-btn-id="btn-edit-password" data-status="edit" id="btn-edit-password" onclick="toggleEditPassword(this)"><i class="bi bi-pencil"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function toggleEdit(e) {
            const editButton = e.getAttribute('data-btn-id'); // misal btn-id-nama-depan
            const btnId = editButton.substring(9); // Menghapus kata "btn-id-"
            const status = e.getAttribute('data-status');
            const paragrafElement = document.querySelector(`.col-lg-8 p#${btnId}`);
            const inputElement = document.querySelector(`.col-lg-8 input[name="${btnId}"]`);
            console.log(btnId);
            if (status === 'edit') {
                e.innerHTML = '<i class="bi bi-x"></i>';
                e.setAttribute('data-status', 'cancel');
                const inputElement = document.createElement('input');
                inputElement.value = paragrafElement.innerText;
                if (btnId === 'phone-number') {
                    inputElement.type = 'number';
                } else {
                    inputElement.type = 'text';
                }
                inputElement.classList.add('border-0', 'w-100');
                inputElement.name = btnId;
                paragrafElement.replaceWith(inputElement);

                // Tambahkan tombol AJAX
                const ajaxButton = document.createElement('button');
                ajaxButton.id = 'ajax-button-nama-depan';
                ajaxButton.className = 'btn shadow-0 ajax-button';
                ajaxButton.innerHTML = '<i class="bi bi-save"></i>';
                ajaxButton.addEventListener('click', function() {
                    const value = inputElement.value;
                    const additionalData = btnId; // Ubah sesuai dengan data yang ingin Anda kirim
                    // Lakukan proses AJAX ke route di Laravel
                    // Gantikan URL_Route dengan URL route Anda
                    // Gantikan dataName dengan nama data yang ingin Anda gunakan di route tersebut
                    fetch('{{ route('profile-admin.save') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                "Accept": "application/json, text-plain, */*",
                                "X-Requested-With": "XMLHttpRequest",
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                userID: '{{ auth()->user()->id }}',
                                dataName: value,
                                additionalData: additionalData
                            })
                        })
                        .then(response => {
                            console.log(response);
                            if (!response.ok) {
                                throw new Error('Terjadi kesalahan saat memproses permintaan.');
                            }
                            return response.json()
                        })
                        .then(data => {
                            // Proses respons dari server (jika diperlukan)
                            console.info(data);
                            // Ubah tombol menjadi "Edit" setelah respons sukses
                            if (data.success) {
                                e.innerHTML = '<i class="bi bi-pencil"></i>';
                                e.setAttribute('data-status', 'edit');
                                e.classList.add('d-none');;
                                const pElement = document.createElement('p');
                                pElement.className = 'text-muted mb-0';
                                pElement.id = btnId;
                                pElement.innerText = inputElement.value;
                                inputElement.replaceWith(pElement);
                                const ajaxButton = document.querySelector('.col-lg-1 .ajax-button');
                                if (ajaxButton) {
                                    ajaxButton.remove();
                                }

                                const checkIcon = document.createElement('i');
                                checkIcon.className = 'bi bi-check-circle';
                                const checkSpan = document.createElement('span');
                                checkSpan.className = 'd-inline-block';
                                checkSpan.style.padding = '0.375rem 0.75rem';
                                checkSpan.appendChild(checkIcon);
                                // Sisipkan ikon sebelum tombol
                                e.parentNode.insertBefore(checkSpan, e);

                                setTimeout(function() {
                                    // Hapus ikon setelah tiga detik
                                    checkSpan.remove();
                                    // Hapus kelas d-none untuk menampilkan tombol
                                    e.classList.remove('d-none');
                                    setTimeout(function() {
                                        location.reload();
                                    }, 1000);
                                }, 3000);
                            }
                        })
                        .catch(error => {
                            // Tangani kesalahan (jika diperlukan)
                            console.error(error);
                            alert(error);
                        });
                });
                e.parentNode.insertBefore(ajaxButton, e);
            } else {
                e.innerHTML = '<i class="bi bi-pencil"></i>';
                e.setAttribute('data-status', 'edit');
                const pElement = document.createElement('p');
                pElement.className = 'text-muted mb-0';
                pElement.id = btnId;
                pElement.innerText = inputElement.value;
                inputElement.replaceWith(pElement);
                const ajaxButton = document.querySelector('.col-lg-1 .ajax-button');
                if (ajaxButton) {
                    ajaxButton.remove();
                }
            }
        }

        function toggleEditPassword(e) {
            const editButton = e.getAttribute('data-btn-id'); // misal btn-id-nama-depan
            const btnId = editButton.substring(9); // Menghapus kata "btn-id-"
            const status = e.getAttribute('data-status');


            const paragrafElement = document.querySelector(`.col-lg-8 p#${btnId}`);



            if (status === 'edit') {
                // Ubah icon dan text button
                e.innerHTML = '<i class="bi bi-x"></i>';
                e.setAttribute('data-status', 'cancel');
                // Buat 2 input
                const inputOldPassword = document.createElement('input');
                const inputNewPassword = document.createElement('input');
                // Buat style class
                inputOldPassword.classList.add('border-0', 'w-100');
                inputNewPassword.classList.add('border-0', 'w-100');
                // Buat name input
                inputOldPassword.name = 'old_password';
                inputNewPassword.name = 'new_password';
                // Buat input required
                inputOldPassword.required = true;
                inputNewPassword.required = true;
                // Buat placeholder
                inputOldPassword.placeholder = 'Password lama';
                inputNewPassword.placeholder = 'Password baru';
                // Buat wadah penampung
                const container = document.createElement('div');
                container.id = 'old-new-password';
                container.classList.add('d-flex');
                // Tambahkan input ke dalam container
                container.appendChild(inputOldPassword);
                container.appendChild(inputNewPassword);
                // Ganti paragraf dengan container
                paragrafElement.replaceWith(container);
                const inputOldPasswordElement = document.querySelector(`.col-lg-8 div#old-new-password input[name="old_password"]`);
                const inputNewPasswordElement = document.querySelector(`.col-lg-8 div#old-new-password input[name="new_password"]`);
                const passwordContainer = document.querySelector(`.col-lg-8 div#old-new-password`);
                // Tambahkan tombol AJAX
                const ajaxButton = document.createElement('button');
                ajaxButton.id = 'ajax-button-nama-depan';
                ajaxButton.className = 'btn shadow-0 ajax-button';
                ajaxButton.innerHTML = '<i class="bi bi-save"></i>';
                ajaxButton.addEventListener('click', function() {
                    const oldPassword = inputOldPasswordElement.value;
                    const newPassword = inputNewPasswordElement.value;

                    console.log(oldPassword);
                    const additionalData = 'password';
                    fetch('{{ route('profile-admin.save') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                "Accept": "application/json, text-plain, */*",
                                "X-Requested-With": "XMLHttpRequest",
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                userID: '{{ auth()->user()->id }}',
                                oldPassword: oldPassword,
                                newPassword: newPassword,
                                additionalData: additionalData
                            })
                        })
                        .then(response => {
                            console.log(response);
                            if (!response.ok) {
                                throw new Error(response.statusText);
                            }
                            return response.json()
                        })
                        .then(data => {
                            // Proses respons dari server (jika diperlukan)
                            console.info(data);
                            // Ubah tombol menjadi "Edit" setelah respons sukses
                            if (data.success) {
                                e.innerHTML = '<i class="bi bi-pencil"></i>';
                                e.setAttribute('data-status', 'edit');
                                const pElement = document.createElement('p');
                                pElement.className = 'text-muted mb-0';
                                pElement.id = 'password';
                                pElement.innerText = '**********';
                                passwordContainer.replaceWith(pElement);
                                const ajaxButton = document.querySelector('.col-lg-1 .ajax-button');
                                if (ajaxButton) {
                                    ajaxButton.remove();
                                }

                                const errorContainer = document.querySelector(`.col-lg-8 div#error-container`);
                                if (errorContainer) {
                                    errorContainer.remove();
                                }

                                const checkIcon = document.createElement('i');
                                checkIcon.className = 'bi bi-check-circle';
                                const checkSpan = document.createElement('span');
                                checkSpan.className = 'd-inline-block';
                                checkSpan.style.padding = '0.375rem 0.75rem';
                                checkSpan.appendChild(checkIcon);
                                // Sisipkan ikon sebelum tombol
                                e.parentNode.insertBefore(checkSpan, e);

                                setTimeout(function() {
                                    // Hapus ikon setelah tiga detik
                                    checkSpan.remove();
                                    // Hapus kelas d-none untuk menampilkan tombol
                                    e.classList.remove('d-none');
                                    setTimeout(function() {
                                        location.reload();
                                    }, 1000);
                                }, 2000);
                            } else {
                                const isErrorContainer = document.querySelector(`.col-lg-8 div#error-container`);
                                // Jika isErrorContainer tidak null
                                if (isErrorContainer) {
                                    isErrorContainer.remove();
                                }
                                const ErrorContainer = document.createElement('div');
                                ErrorContainer.id = 'error-container';
                                const ulElement = document.createElement('ul');
                                ulElement.className = 'list-unstyled';
                                const errors = data.errors;
                                if (errors) {
                                    for (const key in errors) {
                                        if (errors.hasOwnProperty(key)) {
                                            const errorMessages = errors[key];
                                            for (const errorMessage of errorMessages) {
                                                const liElement = document.createElement('li');
                                                liElement.textContent = errorMessage;
                                                ulElement.appendChild(liElement);
                                            }
                                        }
                                    }
                                }

                                ErrorContainer.appendChild(ulElement);
                                passwordContainer.insertAdjacentElement('afterend', ErrorContainer);
                            }
                        })
                        .catch(error => {
                            // Tangani kesalahan (jika diperlukan)
                            console.error(error);
                            alert(error);
                        });

                });
                e.parentNode.insertBefore(ajaxButton, e);
            } else {
                const passwordContainer = document.querySelector(`.col-lg-8 div#old-new-password`);
                e.innerHTML = '<i class="bi bi-pencil"></i>';
                e.setAttribute('data-status', 'edit');
                const pElement = document.createElement('p');
                pElement.className = 'text-muted mb-0';
                pElement.id = 'password';
                pElement.innerText = '**********';
                passwordContainer.replaceWith(pElement);
                const ajaxButton = document.querySelector('.col-lg-1 .ajax-button');
                if (ajaxButton) {
                    ajaxButton.remove();
                }
                const isErrorContainer = document.querySelector(`.col-lg-8 div#error-container`);
                if (isErrorContainer) {
                    isErrorContainer.remove();
                }
            }
        }
    </script>
@endpush
