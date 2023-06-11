<!DOCTYPE html>
<html>

<head>
    <title>Drag File Input</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        .drag-drop {
            border: 2px dashed rgb(153, 153, 153);
            width: 150px;
            height: 150px;
            align-items: center;
            position: relative;
        }

        .drag-drop img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .img-atribut {
            display: flex;
            align-items: center;
        }

        .img-preview {
            width: 150px;
            height: 150px;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="cover mt-3">
            Gambar Cover
            <div class="drag-drop text-center d-flex justify-content-center mt-3" id="dragDropArea1">
                <label for="fileInput1" class="upload-icon"><i class="bi bi-cloud-arrow-up-fill fs-1"></i><br>upload</label>
                <input id="fileInput1" accept="image/jpg, image/png, image/jpeg" type="file" style="display: none;">
                <div class="img-preview" id="imagePreview1"></div>
            </div>
        </div>
        <div class="img-atribut mt-3">
            Gambar Atribut
            <div class="drag-drop text-center d-flex justify-content-center mt-3" id="dragDropArea2">
                <label for="fileInput2" class="upload-icon"><i class="bi bi-cloud-arrow-up-fill fs-1"></i><br>upload</label>
                <input id="fileInput2" accept="image/jpg, image/png, image/jpeg" type="file" style="display: none;">
            </div>
            <div class="img-preview" id="imagePreview2"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.drag-drop').on('dragover', function(e) {
                e.preventDefault();
                $(this).addClass('drag-drop-active');
            });

            $('.drag-drop').on('dragleave', function(e) {
                e.preventDefault();
                $(this).removeClass('drag-drop-active');
            });

            $('.drag-drop').on('drop', function(e) {
                e.preventDefault();
                $(this).removeClass('drag-drop-active');
                var file = e.originalEvent.dataTransfer.files[0];
                displayImage(file, $(this));
            });

            $('input[type="file"]').on('change', function(e) {
                var file = e.target.files[0];
                displayImage(file, $(this).parent());
            });

            function displayImage(file, dragDropArea) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var imgPreview = $('<img>', {
                        src: e.target.result,
                        class: 'img-fluid'
                    });
                    dragDropArea.find('.img-preview').html('').append(imgPreview);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>