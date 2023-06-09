<!DOCTYPE html>
<html>

<head>
    <style>
        .pegawai {
            position: relative;
            width: 50%;
        }

        .image-pegawai {
            display: block;
            width: 100%;
            height: auto;
        }

        .overlay-pegawai {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #008CBA;
            overflow: hidden;
            width: 100%;
            height: 0;
            transition: .5s ease;
        }

        .pegawai:hover .overlay-pegawai {
            height: 100%;
        }

        .text {
            white-space: nowrap;
            color: white;
            font-size: 20px;
            position: absolute;
            overflow: hidden;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
        }
    </style>
</head>

<body>

    <h2>Slide in Overlay from the Bottom</h2>

    <div class="pegawai">
        <img src="{{ asset('templates') }}/assets/images/time.jpg" alt="Avatar" class="image-pegawai">
        <div class="overlay-pegawai">
            <div class="text">Hello World</div>
        </div>
    </div>

</body>

</html>