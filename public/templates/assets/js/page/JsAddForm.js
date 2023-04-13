const addBtn = document.querySelector(".add");
const input = document.querySelector(".inp-group");
// let counter = document.querySelector(".flex").childElementCount;
let counter = 0;

function removeInput() {
    this.parentElement.remove();
}

function addInput() {
    const JenisProduk = document.createElement("input");
    JenisProduk.type = "text";
    JenisProduk.placeholder = "Jenis Produk";
    JenisProduk.name = "rincianproduk[" + counter + "][namarincianproduk]";

    const nilai = document.createElement("input");
    nilai.type = "text";
    nilai.placeholder = "Masukan Jumlah/Nama";
    nilai.name = "rincianproduk[" + counter + "][jumlahnama]";

    const btn = document.createElement("button");
    btn.className = "delete";
    btn.innerHTML = "-";

    btn.addEventListener("click", removeInput);

    const flex = document.createElement("div");
    flex.className = "flex";

    input.appendChild(flex);
    flex.appendChild(JenisProduk);
    flex.appendChild(nilai);
    flex.appendChild(btn);
    counter++;
}

addBtn.addEventListener("click", addInput);

// const updateModal = document.getElementById("UpdateModal");

// updateModal.addEventListener("show.bs.modal", (e) => {
//     let button = e.relatedTarget;
//     // Extract info from data-bs-* attributes
//     let id = button.getAttribute("data-bs-id");
//     let route = button.getAttribute("data-bs-route");
//     let namaproduk = button.getAttribute("data-bs-namaproduk");
//     // Update the modal's content.
//     // let modalBody = updateModal.querySelector(".update-dataproduk");
//     // modalBody.textContent = id;
//     let routeForm = updateModal.querySelector(".modal-content form");
//     routeForm.setAttribute("action", route);
//     let namaProdukInput = updateModal.querySelector(
//         ".modal-body .update-dataproduk input#namaproduk"
//     );
//     namaProdukInput.value = namaproduk;
// });
