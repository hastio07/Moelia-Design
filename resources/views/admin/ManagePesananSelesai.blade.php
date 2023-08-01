@extends('admin.layouts.layouts')
@section('title', 'Pesanan-Selesai')
@section('content')
    <div class="container">
        <div class="bg-danger mb-3 rounded p-3 text-white">
            <p class="fw-bold mb-0">Info <i class="bi bi-info-circle"></i></p>
            <p class="mb-0">Data yang terdapat didalam tabel dibawahadalah data yang sudah selesai dari proeses pembayaran</p>
        </div>
        <div class="card p-2">
            <table class="display table" id="table-pesanan">
                <thead>
                    <tr>
                        <th>Nama Pemesan</th>
                        <th>Telp/HP</th>
                        <th>Hari/Tgl Pemesanan</th>
                        <th>Status Pembayaran(DP)</th>
                        <th>Status Pelunasan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <th>Nama Pemesan</th>
                    <th>Telp/HP</th>
                    <th>Hari/Tgl Pemesanan</th>
                    <th>Status Pembayaran(DP)</th>
                    <th>Status Pelunasan</th>
                    <th class="text-center">Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- modal delete product dan category -->
    <div aria-hidden="true" aria-labelledby="deleteModalLabel" class="modal fade" id="DeleteModal" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="deleteModalLabel">Peringatan!</h5>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <div class="modal-body">
                    <h6>Yakin Ingin Menghapusnya?</h6>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" id="closeModal" type="button">Tutup</button>
                    <form method="post">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" type="submit">YA</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script src="{{ asset('templates') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('templates') }}/vendor/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js" charset="UTF-8"></script>
    <script>
        $('#table-pesanan').DataTable({
            processing: true,
            responsive: true,
            ajax: {
                url: "{{ route('manage-pesanan-selesai.index') }}",
            },
            columnDefs: [{
                targets: 3,
                className: "test-success"
            }, {
                targets: 4,
                className: "text-success"
            }, {
                targets: 5,
                orderable: false,
                searchable: false,
                className: "text-center"
            }],
            columns: [{
                    data: 'nama_pemesan',
                    name: 'nama_pemesan'
                },
                {
                    data: 'telepon_pemesan',
                    name: 'telepon_pemesan'
                },
                {
                    data: 'tanggal_akad_dan_resepsi',
                    name: 'tanggal_akad_dan_resepsi'
                },

                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'status_konfirmasi',
                    name: 'status_konfirmasi'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                },
            ],
            order: []
        });
    </script>
    <script>
        /**
         * Hapus Pesanan
         */
        const deleteModal = document.getElementById('DeleteModal');
        deleteModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget;
            const route = button.getAttribute('data-bs-route');
            deleteModal.querySelector('.modal-content .modal-footer form').setAttribute('action', route);
        });
    </script>
@endpush
