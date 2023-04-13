document.querySelector('.modal-body .update-dataproduk input#update-gambar').addEventListener('change', (e) => {
    // console.log(e.target.files);
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        const files = e.target.files;
        const output = document.querySelector('.modal-body .update-dataproduk #update-result');

        const picReader = new FileReader();
        picReader.addEventListener('load', function (event) {
            const picFile = event.target;
            const div = document.createElement('div');
            div.innerHTML = `<img class="thumbnail" src="${picFile.result}" title"${picFile.name}"/>`;
            if (output.firstChild) {
                output.replaceChild(div, output.firstChild);
            } else {
                output.appendChild(div);
            }
        });
        picReader.readAsDataURL(files[0]);
    } else {
        alert('your browswer does not support the file API');
    }
});
