@extends('dashboard.user.layouts.UserScreen')
@section('title','About Us')

@section('konten')
<section>
    <!-- konten 1 about us -->
    <div class="first-content text-center align-self-center">
        <h1>Tentang Kami</h1>
        <p> Home/About Us</p>
    </div>
    <!-- end konten -->

    <!-- konten2 -->
    <div class="div second-contents container">
        <div class="row same-height mt-3 p-3 mb-5">
            <div class="col-md-7 text-center align-self-center" data-aos="fade-up">
                <div class="card bg-transparent border border-0 h-100 image-konten-dua cover-img-dua" data-aos="flip-up">
                    <img src=" img/cover-2.jpg" class="image-konten-dua" alt="">
                </div>
            </div>
            <div class="col-md-5" data-aos="fade-down">
                <h5 class="text-center">Moelia Design</h5>
                <h6 class="card-subtitle">
                    Apa saja yang akan anda dapatkan dari kami?
                </h6>
                <ol>
                    <li>Bride and Groom tidak perlu khawatir karena Mawar Wedding Service eksibel dan dapat menyesuaikan dengan budget dan kebutuhan kamu.</li>
                    <li>Bride and Groom tidak perlu khawatir karena Mawar Wedding Service eksibel dan dapat menyesuaikan dengan budget dan kebutuhan kamu.</li>
                    <li>Bride and Groom tidak perlu khawatir karena Mawar Wedding Service eksibel dan dapat menyesuaikan dengan budget dan kebutuhan kamu.</li>
                    <li>Bride and Groom tidak perlu khawatir karena Mawar Wedding Service eksibel dan dapat menyesuaikan dengan budget dan kebutuhan kamu.</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- end konten -->

    <!-- konten3 -->
    <h1 class="text-center head-ourt fw-bold">Our Team</h1>
    <div class="line"></div>
    <div class="owner-profile">
        <div class="card">
            <div class="imgBX">
                <img src="img/cover-2.jpg" alt="">
            </div>
            <div class="content">
                <div class="details">
                    <h2>hastio wahyu utomo <br><span>owner</span></h2>
                    <div class="data">
                        <p>
                            "Bride and Groom tidak perlu khawatir karena Mawar Wedding Service eksibel dan dapat menyesuaikan dengan budget dan kebutuhan kamu"
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="body-ourt">
        <div class="our-team">
            <div class="div card">
                <div class="imgOT">
                    <img src="img/cover-1.jpg" alt="">
                </div>
                <div class="content-ourt">
                    <h2>sayid mufaqih</h2>
                    <p>Marketing</p>
                </div>
            </div>
            <div class="div card">
                <div class="imgOT">
                    <img src="img/cover-1.jpg" alt="">
                </div>
                <div class="content-ourt">
                    <h2>sayid mufaqih</h2>
                    <p>Marketing</p>
                </div>
            </div>
            <div class="div card">
                <div class="imgOT">
                    <img src="img/cover-1.jpg" alt="">
                </div>
                <div class="content-ourt">
                    <h2>sayid mufaqih</h2>
                    <p>dekorasi</p>
                </div>
            </div>
            <div class="div card">
                <div class="imgOT">
                    <img src="img/cover-1.jpg" alt="">
                </div>
                <div class="content-ourt">
                    <h2>sayid mufaqih</h2>
                    <p>make up</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end konten -->
    <!-- konten 4 -->
    <div class="four-content">
        <div class="row text-center bg-danger">
            <div class="col-md-4 mx-auto">
                1
            </div>
            <div class="col-md-4 mx-auto">
                2
            </div>
            <div class="col-md-4 mx-auto">
                3
            </div>
        </div>

    </div>
    <!-- end konten -->
</section>

@endsection