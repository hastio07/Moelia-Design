const addBtns = document.querySelector(".add-input-update");
const inputs = document.querySelector(".inp-update-group");

let counters = 0;
counters++;
/** function for add and remove a input */

addBtns.addEventListener("click", () => {
    const JenisProduk = document.createElement("input");
    JenisProduk.type = "text";
    JenisProduk.placeholder = "Jenis Produk";
    JenisProduk.name = "rincianproduk[" + counters + "][namarincianproduk]";

    const nilai = document.createElement("input");
    nilai.type = "text";
    nilai.placeholder = "Masukan Jumlah/Nama";
    nilai.name = "rincianproduk[" + counters + "][jumlahnama]";

    const idRincian = document.createElement("input");
    idRincian.type = "hidden";
    idRincian.name = "rincianproduk[" + counters + "][id]";

    const btnRemove = document.createElement("button");
    btnRemove.className = "delete";
    btnRemove.innerHTML = "-";

    btnRemove.addEventListener("click", (event) => {
        let id = parseInt(event.currentTarget.getAttribute("data-id"));

        if (id) {
            const confirmation = confirm(
                `Are you sure you want to delete product with id ${id}?`
            );
            if (confirmation) {
                event.preventDefault();
                let token = document.querySelector(
                    '#UpdateModal input[name="_token"]'
                ).value;
                fetch("manage-produk/rincianproduk/" + id, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": token,
                    },
                })
                    .then((response) => {
                        if (response.status === 200) {
                            // Berhasil menghapus rincian produk, lakukan tindakan yang diperlukan
                            this.parentNode.remove();
                            return response.json();
                            //   console.log("Rincian produk berhasil dihapus");
                        } else {
                            // Gagal menghapus rincian produk, tampilkan pesan error
                            console.error("Gagal menghapus rincian produk");
                        }
                        // console.log(response.statusText);
                    })
                    .then((data) => {
                        console.log(data.message);
                    })
                    .catch((error) => console.error(error));
            } else {
                event.preventDefault();
            }
        } else {
            this.parentNode.remove();
        }
    });

    const flex = document.createElement("div");
    flex.className = "flex";

    inputs.appendChild(flex);
    flex.appendChild(JenisProduk);
    flex.appendChild(nilai);
    /** idRincian element only on update modal  */
    flex.appendChild(idRincian);
    /** end idRincian */
    flex.appendChild(btnRemove);
    counters++;
});

/** Show data on modal update by id*/
const updateModal = document.getElementById("UpdateModal");

updateModal.addEventListener("show.bs.modal", (event) => {
    let button = event.relatedTarget;

    // Extract info from data-bs-* attributes
    let rawData = button.getAttribute("data-bs-product");
    let parseData = JSON.parse(rawData);
    let route = button.getAttribute("data-bs-route");

    // Update the modal's content.
    updateModal
        .querySelector(".modal-content form")
        .setAttribute("action", route);
    updateModal.querySelector(
        ".modal-body .update-dataproduk input#namaproduk"
    ).value = parseData.nama_produk;
    updateModal.querySelector(
        ".modal-body .update-dataproduk select#kategori"
    ).value = parseData.kategori_id;
    updateModal.querySelector(
        ".modal-body .update-dataproduk input#hargasewa"
    ).value = parseData.harga_sewa;

    let inAdded = document.querySelectorAll(".inp-update-group .flex");
    if (inAdded.length > 0) {
        inAdded.forEach(function (element) {
            // tambahkan kode logika di sini
            element.remove();
        });
    }
    parseData.productdetail &&
        parseData.productdetail.map((detail) => {
            document.getElementsByClassName("add-input-update")[0].click();
            let inputsAdded = document.querySelectorAll(
                ".inp-update-group .flex:last-child input"
            );

            inputsAdded[0].value = detail.nama_rincian_produk;
            inputsAdded[1].value = detail.jumlah_nama;
            inputsAdded[2].value = detail.id;

            let attrAdded = document.querySelector(
                ".inp-update-group .flex:last-child button"
            );

            attrAdded.setAttribute("data-id", detail.id);
        });

    updateModal.querySelector(
        ".modal-body .update-dataproduk textarea#deskripsi"
    ).value = parseData.deskripsi;

    if (parseData.gambar) {
        const picFile = parseData.gambar;
        let src = `/storage/compressed${picFile}`;

        const div = document.createElement("div");
        div.innerHTML = `<img class="thumbnail" src="${src}" title="${parseData.nama_produk}" />`;
        const updateResult = updateModal.querySelector(
            ".modal-body .update-dataproduk #update-result"
        );
        if (updateResult.firstChild) {
            updateResult.replaceChild(div, updateResult.firstChild);
        } else {
            updateResult.appendChild(div);
        }

        const oldImage = document.querySelector(
            ".modal-body .update-dataproduk #oldImage"
        );
        oldImage.value = picFile;
    }
});
