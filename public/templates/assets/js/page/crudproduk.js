/**
 * Buat Produk & Ubah Produk
 */
const CUModal = document.getElementById('CUModal');
const CUForm = CUModal.querySelector('.modal-content form#CUForm');
const titleModal = CUModal.querySelector('.modal-content .modal-header h5#cuModalLabel.modal-title');
const namaProduk = CUModal.querySelector('.modal-content .modal-body input#namaproduk');
const kategoriProduk = CUModal.querySelector('.modal-content .modal-body select#kategori');
const hargaSewaProduk = CUModal.querySelector('.modal-content .modal-body input#hargasewa');
const deskripsiProduk = CUModal.querySelector('.modal-content .modal-body textarea#deskripsi');
const csrfField = CUForm.querySelector('input[name="_token"]');
const oldImageField = document.querySelector('.modal-content .modal-body input#oldImage');
const imgFile = CUModal.querySelector('.modal-content .modal-body input#gambar');
const output = CUModal.querySelector('.modal-content .modal-body output#result');

CUModal.addEventListener('show.bs.modal', (event) => {
    const button = event.relatedTarget;
    const btnID = button.getAttribute('id');
    const route = button.getAttribute('data-bs-route');
    const img = document.createElement('img');
    img.className = 'thumbnail';
    img.height = 240;
    img.width = 320;
    imgFile.addEventListener('change', (e) => {
        if (window.File && window.FileReader && window.FileList && window.Blob) {
            const file = e.target.files;

            // if files is image
            if (file[0].type.match('image')) {
                const picReader = new FileReader();
                picReader.addEventListener('load', function (event) {
                    const picFile = event.target;
                    img.src = `${picFile.result}`;
                    img.title = `${picFile.name}`;
                    // cek apakah ada/belum child-nya
                    if (output.hasChildNodes()) {
                        output.replaceChildren(img);
                    } else {
                        output.appendChild(img);
                    }
                });
                picReader.readAsDataURL(file[0]);
            }
        } else {
            alert('your browswer does not support the file API');
        }
    });
    if (btnID === 'btnUpdateModal') {
        // Extract info from data-bs-* attributes
        const rawData = button.getAttribute('data-bs-product');
        const parseData = JSON.parse(rawData);
        // The modal's content.
        CUForm.action = route;
        const createField = document.createElement('input');
        createField.type = 'hidden';
        createField.name = '_method';
        createField.value = 'PUT';
        csrfField.insertAdjacentElement('beforebegin', createField);
        titleModal.textContent = 'Ubah Produk';
        namaProduk.value = parseData.nama_produk;
        kategoriProduk.value = parseData.kategori_id;
        hargaSewaProduk.value = parseData.harga_sewa;
        tinymce.get('rincianproduk').setContent(parseData.rincian_produk);
        deskripsiProduk.value = parseData.deskripsi;
        if (parseData.gambar) {
            const picFile = parseData.gambar;
            let src = `/storage/compressed${picFile}`;
            img.src = `${src}`;
            img.title = `${parseData.nama_produk}`;
            if (output.hasChildNodes()) {
                output.replaceChildren(img);
            } else {
                output.appendChild(img);
            }
            oldImageField.value = picFile;
        }
    }
    if (btnID === 'btnCreateModal') {
        CUForm.action = route;
        titleModal.textContent = 'Tambah Produk';
    }
});

CUModal.addEventListener('hidden.bs.modal', (event) => {
    const methodField = CUForm.querySelector('input[name="_method"]');
    if (methodField !== null) {
        methodField.remove();
    }
    const url = `#`;
    CUForm.action = url;
    namaProduk.value = null;
    kategoriProduk.value = '';
    hargaSewaProduk.value = null;
    tinymce.activeEditor.setContent('');
    deskripsiProduk.value = null;
    if (output.hasChildNodes()) {
        imgFile.value = null;
        output.removeChild(output.firstChild);
    }
});

/**
 * Hapus Produk
 */
const deleteModal = document.getElementById('DeleteModal');
deleteModal.addEventListener('show.bs.modal', (event) => {
    const button = event.relatedTarget;
    const route = button.getAttribute('data-bs-route');
    deleteModal.querySelector('.modal-content .modal-footer form').setAttribute('action', route);
});
