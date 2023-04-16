@extends('dashboard.user.layouts.UserScreen')
@section('title', 'About Us')

@push('styles')
<link href="{{ asset('templates') }}/assets/css-modif/AboutUs.css" rel="stylesheet">
@endpush

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
        <div class="row same-height mt-3 p-3">
            <div class="col-md-7 text-center align-self-center" data-aos="fade-up">
                <div class="card bg-transparent border border-0 h-100" data-aos="flip-up">
                    <img alt="" class="left-image" src=" img/cover-2.jpg">
                </div>
            </div>
            <div class="col-md-5" data-aos="fade-down">
                <h5 class="text-center">Moelia Design</h5>
                <div class="line"></div><br>
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
    <div class="third-content mt-5">
        <h1 class="text-center head-ourt fw-bold">Our Team</h1>
        <div class="line"></div>
        <div class="owner-profile">
            <div class="card">
                <div class="imgBX">
                    <img alt="" src="img/cover-2.jpg">
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
    </div>

    <div class="body-ourt mt-5">
        <div class="our-team">
            <div class="div card">
                <div class="imgOT">
                    <img alt="" src="img/cover-1.jpg">
                </div>
                <div class="content-ourt">
                    <h2>sayid mufaqih</h2>
                    <p>Marketing</p>
                </div>
            </div>
            <div class="div card">
                <div class="imgOT">
                    <img alt="" src="img/cover-1.jpg">
                </div>
                <div class="content-ourt">
                    <h2>sayid mufaqih</h2>
                    <p>Marketing</p>
                </div>
            </div>
            <div class="div card">
                <div class="imgOT">
                    <img alt="" src="img/cover-1.jpg">
                </div>
                <div class="content-ourt">
                    <h2>sayid mufaqih</h2>
                    <p>dekorasi</p>
                </div>
            </div>
            <div class="div card">
                <div class="imgOT">
                    <img alt="" src="img/cover-1.jpg">
                </div>
                <div class="content-ourt">
                    <h2>sayid mufaqih</h2>
                    <p>make up</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end konten -->

    <!-- konten 5 -->
    <div class="container four-content mb-5" data-aos="fade-down">
        <div class="content">
            <div class="left-side">
                <div class="address details">
                    <i class="bi bi-geo-alt-fill"></i>
                    <div class="topic">Alamat</div>
                    <div class="text-one">Gg. Cinta Damai No.31, Tj. Baru, Kec. Sukabumi, Kota Bandar Lampung, Lampung 35122</div>
                </div>
                <div class="phone details">
                    <i class="bi bi-whatsapp"></i>
                    <div class="topic">Whatsapp</div>
                    <div class="text-one">+0098 9893 5647</div>
                    <div class="text-two">+0096 3434 5678</div>
                </div>
                <div class="email details">
                    <i class="fas fa-envelope"></i>
                    <div class="topic">Email</div>
                    <div class="text-one">codinglab@gmail.com</div>
                    <div class="text-two">info.codinglab@gmail.com</div>
                </div>
            </div>
            <div class="right-side">
                <div class="embed-responsive embed-responsive-16by9 location-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.0887962657775!2d105.27614897592059!3d-5.403442853988368!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40db089e2e79c7%3A0xe50920a8f777316e!2sMOELIA%20DESIGN%20%22Decoration%20and%20Catering%20Service%22!5e0!3m2!1sen!2sid!4v1681628051086!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- end konten -->
</section>

@endsection