<!--
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
$tahun_option_list = $comp_model->tahun_option_list();
$pageTitle = 'NBM'; // set dynamic page title
?>
@extends($front)
@section('title', $pageTitle)
@section('content')
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Tentang</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href={{ url('/') }}>Beranda</a></li>
                <li class="breadcrumb-item active text-primary">Tentang</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->


    <!-- Blog Start -->
    <div class="container-fluid contact bg-light py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary">Tentang Kami</h4>
                <h1 class="display-4 mb-4">Sistem Informasi Pangan Kabupaten Blitar</h1>
            </div>
            <div class="row g-5">
                <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="contact-img d-flex justify-content-center">
                        <div class="contact-img-inner">
                            <img src="img/marketbg.png" class="img-fluid w-100" alt="Image">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.4s">
                    <div>
                        <h4 class="text-primary">Tentang Aplikasi</h4>
                        <p class="mb-4">
                            SIP Kabupaten Blitar (Sistem Informasi Pangan) adalah sebuah aplikasi inovatif yang
                            dikembangkan oleh Dinas Ketahanan Pangan dan Pertanian Kabupaten Blitar untuk memberikan
                            informasi yang akurat dan terkini mengenai harga pangan kepada masyarakat. Aplikasi ini
                            bertujuan untuk memfasilitasi transparansi pasar dengan menampilkan harga konsumen dan
                            harga produsen secara real-time. Data harga ini diinput secara rutin oleh penyuluh
                            pertanian di Kabupaten Blitar, yang bertugas untuk memantau dan mengumpulkan informasi
                            harga pangan dari berbagai sumber. Dengan adanya aplikasi ini, diharapkan masyarakat
                            dapat membuat keputusan yang lebih baik dalam berbelanja dan memasarkan produk
                            pertanian.</p>
                        <p class="mb-4">
                            Melalui SIP Kabupaten Blitar, pengguna dapat mengakses informasi harga pangan dengan
                            mudah dan cepat, sehingga membantu mereka dalam memahami dinamika pasar yang terjadi di
                            wilayah tersebut. Aplikasi ini tidak hanya bermanfaat bagi konsumen, tetapi juga bagi
                            para produsen dan pedagang yang ingin mengetahui harga terkini untuk meningkatkan daya
                            saing produk mereka. Selain itu, aplikasi ini menjadi alat penting dalam mendukung
                            kebijakan pemerintah dalam menjaga stabilitas harga pangan dan meningkatkan
                            kesejahteraan petani serta masyarakat secara keseluruhan. Dengan implementasi teknologi
                            informasi yang efektif, SIP Kabupaten Blitar berperan dalam memajukan sektor pertanian
                            dan ketahanan pangan di Kabupaten Blitar.</p>

                    </div>
                </div>
                {{-- <div class="col-12">
                            <div>
                                <div class="row g-4">
                                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="contact-add-item">
                                            <div class="contact-icon text-primary mb-4">
                                                <i class="fas fa-map-marker-alt fa-2x"></i>
                                            </div>
                                            <div>
                                                <h4>Alamat</h4>
                                                <p class="mb-0">Bidang Ketahanan Pangan DKPP Kabupaten Blitar</p>
                                                <p class="mb-0">Jl. Ahmad Yani No.25, Sananwetan, Kec. Kepanjenkidul, Kota
                                                    Blitar, Jawa Timur 66137</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.4s">
                                        <div class="contact-add-item">
                                            <div class="contact-icon text-primary mb-4">
                                                <i class="fas fa-envelope fa-2x"></i>
                                            </div>
                                            <div>
                                                <h4>Email Kami</h4>
                                                <p class="mb-0">dkpp@blitarkab.go.id</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.6s">
                                        <div class="contact-add-item">
                                            <div class="contact-icon text-primary mb-4">
                                                <i class="fa fa-phone-alt fa-2x"></i>
                                            </div>
                                            <div>
                                                <h4>Telephone</h4>
                                                <p class="mb-0">(0342) 801592</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div> --}}
                <div class="col-12 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="rounded">
                        <iframe class="rounded w-100" style="height: 400px;"
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15018.315592859897!2d112.172417!3d-8.0991638!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78ec6fd7f51e77%3A0xecd8ec0951b3452b!2sDinas%20Ketahanan%20Pangan%20dan%20Pertanian%20Kabupaten%20Blitar!5e1!3m2!1sen!2sid!4v1729157339335!5m2!1sen!2sid"
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

@endsection
<!-- Page custom css -->
@section('pagecss')
    <style>
    </style>
@endsection
<!-- Page custom js -->
@section('pagejs')
    <script>
        $(document).ready(function() {
            // Add 'row' class to each 'card' within the form with class 'form'
            $('.form').addClass('row');
        });
    </script>
@endsection
