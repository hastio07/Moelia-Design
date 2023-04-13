// Script for upload multiple image
// document.querySelector("#gambar").addEventListener("change", (e) => {
//     if (window.File && window.FileReader && window.FileList && window.Blob) {
//         const files = e.target.files;
//         const output = document.querySelector("#result");

//         for (let i = 0; i < files.length; i++) {
//             if (!files[i].type.match("image")) continue;
//             const picReader = new FileReader();
//             picReader.addEventListener("load", function (events) {
//                 const picFile = events.target;
//                 const div = document.createElement("div");
//                 div.innerHTML = `<img class="thumbnail" src="${picFile.result}" title="${picFile.name}"/>`;
//                 output.appendChild(div);
//             });
//             picReader.readAsDataURL(files[i]);
//         }
//     } else {
//         alert("your browswer does not support the file API");
//     }
// });
