/**
 * Buat Layanan & Ubah Layanan
 */
const CUModal = document.getElementById('CUModal');
const CUForm = CUModal.querySelector('.modal-content form#CUForm');
const titleModal = CUModal.querySelector('.modal-content .modal-header h5#cuModalLabel.modal-title');
const tipeLayanan = CUModal.querySelector('.modal-content form#CUForm .modal-body input#tipe_layanan');
const deskripsiLayanan = CUModal.querySelector('.modal-content form#CUForm .modal-body textarea#deskripsi');
const csrfField = CUForm.querySelector('input[name="_token"]');
const oldImageField = CUModal.querySelector('.modal-content form#CUForm .modal-body input#oldImage');
const imgFile = CUModal.querySelector('.modal-content form#CUForm .modal-body input#gambar');
const output = CUModal.querySelector('.modal-content form#CUForm .modal-body output#result');

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

    if (btnID === 'btnUpdate') {
        // Extract info from data-bs-* attributes
        const rawData = button.getAttribute('data-bs-layanan');
        const parseData = JSON.parse(rawData);
        // The modal's content.
        CUForm.action = route;
        const createField = document.createElement('input');
        createField.type = 'hidden';
        createField.name = '_method';
        createField.value = 'PUT';
        csrfField.insertAdjacentElement('beforebegin', createField);
        titleModal.textContent = 'Ubah Layanan';
        tipeLayanan.value = parseData.tipe_layanan;
        deskripsiLayanan.value = parseData.deskripsi;
        if (parseData.gambar) {
            const picFile = parseData.gambar;
            let src = `/storage/compressed/${picFile}`;
            img.src = `${src}`;
            img.title = `${parseData.tipe_layanan}`;
            if (output.hasChildNodes()) {
                output.replaceChildren(img);
            } else {
                output.appendChild(img);
            }
            oldImageField.value = picFile;
        }
    }
    if (btnID === 'btnCreate') {
        CUForm.action = route;
        titleModal.textContent = 'Tambah Layanan';
    }
});

CUModal.addEventListener('hidden.bs.modal', () => {
    const methodField = CUForm.querySelector('input[name="_method"]');
    if (methodField !== null) {
        methodField.remove();
    }
    const url = `#`;
    CUForm.action = url;
    tipeLayanan.value = null;
    deskripsiLayanan.value = null;
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
