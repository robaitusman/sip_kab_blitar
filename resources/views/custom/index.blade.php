<!--
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
$tahun_option_list = $comp_model->tahun_option_list();
$pageTitle = 'Beranda'; // set dynamic page title
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

    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center bg-primary">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords"
                            aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="btn bg-light border nput-group-text p-3"><i
                                class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->


    <!-- Carousel Start -->
    <div class="header-carousel owl-carousel">
        <div class="header-carousel-item bg-primary">
            <div class="carousel-caption">
                <div class="container">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-7 animated fadeInLeft">
                            <div class="text-sm-center text-md-start">
                                <h4 class="text-white text-uppercase fw-bold mb-4">Selamat Datang</h4>
                                <h3 class="display-3 text-white mb-4">Sistem Informasi Pangan</h3>
                                <h1 class="display-1 text-white mb-4"> Kabupaten Blitar</h1>
                                <p class="mb-5 fs-5">Dipersemmbahkan oleh dinas ketahanan pangan dan pertanian Kabupaten
                                    Blitar
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-5 animated fadeInRight">
                            <div class="calrousel-img" style="object-fit: cover;">
                                <img src="img/bn1.png" class="img-fluid w-100" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-carousel-item bg-primary">
            <div class="carousel-caption">
                <div class="container">
                    <div class="row gy-4 gy-lg-0 gx-0 gx-lg-5 align-items-center">
                        <div class="col-lg-5 animated fadeInLeft">
                            <div class="calrousel-img">
                                <img src="img/bn2.png" class="img-fluid w-100" alt="">
                            </div>
                        </div>
                        <div class="col-lg-7 animated fadeInRight">
                            <div class="text-sm-center text-md-end">
                                <h4 class="text-white text-uppercase fw-bold mb-4">Selamat Datang</h4>
                                <h3 class="display-3 text-white mb-4">Sistem Informasi Pangan</h3>
                                <h1 class="display-1 text-white mb-4">Kabupaten Blitar</h1>
                                <p class="mb-5 fs-5">Dipersembahkan oleh dinas ketahanan pangan dan pertanian Kabupaten
                                    Blitar
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->
    <!-- Testimonial Start -->
    <div class="container-fluid testimonial pb-5">
        <div class="container pb-5">
            <div class="text-center mx-auto mt-5 pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary">Data Harga Produsen per Tanggal
                    {{ \Carbon\Carbon::parse($dataharga->tanggal)->format('d-m-Y') }}</h4>
            </div>
           
            {{-- @foreach ($dataharga as $item) --}}
            <div class="owl-carousel testimonial-carousel wow fadeInUp mb-5" data-wow-delay="0.2s">
                <div class="testimonial-item bg-light rounded">
                    <div class="row g-0">
                        <div class="col-4  col-lg-4 col-xl-3">
                            <div class="h-100">
                                <img src="{{ asset('img/harga/gkp_petani.jpg') }}" class="img-fluid h-100 rounded"
                                    style="object-fit: cover;" alt="">
                            </div>
                        </div>
                        <div class="col-8 col-lg-8 col-xl-9">
                            <div class="d-flex flex-column my-auto text-start p-4">
                                <h4 class="text-dark mb-2">GKP PETANI</h4>
                                {{-- <p class="mb-2 text-primary">{{ $dataharga->tanggal }}</p> --}}
                                <h5 class="mb-0">Rp {{ number_format($dataharga->gkp_petani, 0, ',', '.') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded">
                    <div class="row g-0">
                        <div class="col-4  col-lg-4 col-xl-3">
                            <div class="h-100">
                                <img src="{{ asset('img/harga/gkg_penggilingan.jpeg') }}" class="img-fluid h-100 rounded"
                                    style="object-fit: cover;" alt="">
                            </div>
                        </div>
                        <div class="col-8 col-lg-8 col-xl-9">
                            <div class="d-flex flex-column my-auto text-start p-4">
                                <h5 class="text-dark mb-2">GKG Penggilingan</h5>
                                {{-- <p class="mb-2 text-primary">{{ $dataharga->tanggal }}</p> --}}
                                <h5 class="mb-0">Rp {{ number_format($dataharga->gkg_penggilingan, 0, ',', '.') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded">
                    <div class="row g-0">
                        <div class="col-4  col-lg-4 col-xl-3">
                            <div class="h-100">
                                <img src="{{ asset('img/harga/beras_premium.jpeg') }}" class="img-fluid h-100 rounded"
                                    style="object-fit: cover;" alt="">
                            </div>
                        </div>
                        <div class="col-8 col-lg-8 col-xl-9">
                            <div class="d-flex flex-column my-auto text-start p-4">
                                <h4 class="text-dark mb-2">Beras Premium</h4>
                                {{-- <p class="mb-2 text-primary">{{ $dataharga->tanggal }}</p> --}}
                                <h5 class="mb-0">Rp {{ number_format($dataharga->beras_premium, 0, ',', '.') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded">
                    <div class="row g-0">
                        <div class="col-4  col-lg-4 col-xl-3">
                            <div class="h-100">
                                <img src="{{ asset('img/harga/beras_medium.jpeg') }}" class="img-fluid h-100 rounded"
                                    style="object-fit: cover;" alt="">
                            </div>
                        </div>
                        <div class="col-8 col-lg-8 col-xl-9">
                            <div class="d-flex flex-column my-auto text-start p-4">
                                <h4 class="text-dark mb-2">Beras Medium</h4>
                                {{-- <p class="mb-2 text-primary">{{ $dataharga->tanggal }}</p> --}}
                                <h5 class="mb-0">Rp {{ number_format($dataharga->beras_medium, 0, ',', '.') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded">
                    <div class="row g-0">
                        <div class="col-4  col-lg-4 col-xl-3">
                            <div class="h-100">
                                <img src="{{ asset('img/harga/jagung_pipilan_kering.jpg') }}"
                                    class="img-fluid h-100 rounded" style="object-fit: cover;" alt="">
                            </div>
                        </div>
                        <div class="col-8 col-lg-8 col-xl-9">
                            <div class="d-flex flex-column my-auto text-start p-4">
                                <h5 class="text-dark mb-2">Jagung Pipilan Kering</h6>
                                    {{-- <p class="mb-2 text-primary">{{ $dataharga->tanggal }}</p> --}}
                                    <h5 class="mb-0">Rp
                                        {{ number_format($dataharga->jagung_pipilan_kering, 0, ',', '.') }}
                                    </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded">
                    <div class="row g-0">
                        <div class="col-4  col-lg-4 col-xl-3">
                            <div class="h-100">
                                <img src="{{ asset('img/harga/ubi_kayu.jpg') }}" class="img-fluid h-100 rounded"
                                    style="object-fit: cover;" alt="">
                            </div>
                        </div>
                        <div class="col-8 col-lg-8 col-xl-9">
                            <div class="d-flex flex-column my-auto text-start p-4">
                                <h4 class="text-dark mb-2">Ubi Kayu</h4>
                                {{-- <p class="mb-2 text-primary">{{ $dataharga->tanggal }}</p> --}}
                                <h5 class="mb-0">Rp {{ number_format($dataharga->ubi_kayu, 0, ',', '.') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded">
                    <div class="row g-0">
                        <div class="col-4  col-lg-4 col-xl-3">
                            <div class="h-100">
                                <img src="{{ asset('img/harga/ubi_jalar.jpg') }}" class="img-fluid h-100 rounded"
                                    style="object-fit: cover;" alt="">
                            </div>
                        </div>
                        <div class="col-8 col-lg-8 col-xl-9">
                            <div class="d-flex flex-column my-auto text-start p-4">
                                <h4 class="text-dark mb-2">Ubi Jalar</h4>
                                {{-- <p class="mb-2 text-primary">{{ $dataharga->tanggal }}</p> --}}
                                <h5 class="mb-0">Rp {{ number_format($dataharga->ubi_jalar, 0, ',', '.') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded">
                    <div class="row g-0">
                        <div class="col-4  col-lg-4 col-xl-3">
                            <div class="h-100">
                                <img src="{{ asset('img/harga/kedelai_lokal_kering.jpg') }}"
                                    class="img-fluid h-100 rounded" style="object-fit: cover;" alt="">
                            </div>
                        </div>
                        <div class="col-8 col-lg-8 col-xl-9">
                            <div class="d-flex flex-column my-auto text-start p-4">
                                <h5 class="text-dark mb-2">Kedelai Lokal Kering</h5>
                                {{-- <p class="mb-2 text-primary">{{ $dataharga->tanggal }}</p> --}}
                                <h5 class="mb-0">Rp {{ number_format($dataharga->kedelai_lokal_kering, 0, ',', '.') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded">
                    <div class="row g-0">
                        <div class="col-4  col-lg-4 col-xl-3">
                            <div class="h-100">
                                <img src="{{ asset('img/harga/cabe_besar.jpg') }}" class="img-fluid h-100 rounded"
                                    style="object-fit: cover;" alt="">
                            </div>
                        </div>
                        <div class="col-8 col-lg-8 col-xl-9">
                            <div class="d-flex flex-column my-auto text-start p-4">
                                <h4 class="text-dark mb-2">Cabe Besar</h4>
                                {{-- <p class="mb-2 text-primary">{{ $dataharga->tanggal }}</p> --}}
                                <h5 class="mb-0">Rp {{ number_format($dataharga->cabe_besar, 0, ',', '.') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded">
                    <div class="row g-0">
                        <div class="col-4  col-lg-4 col-xl-3">
                            <div class="h-100">
                                <img src="{{ asset('img/harga/cabe_rawit_merah.jpg') }}" class="img-fluid h-100 rounded"
                                    style="object-fit: cover;" alt="">
                            </div>
                        </div>
                        <div class="col-8 col-lg-8 col-xl-9">
                            <div class="d-flex flex-column my-auto text-start p-4">
                                <h5 class="text-dark mb-2">Cabe Rawit Merah</h5>
                                {{-- <p class="mb-2 text-primary">{{ $dataharga->tanggal }}</p> --}}
                                <h5 class="mb-0">Rp {{ number_format($dataharga->cabe_rawit_merah, 0, ',', '.') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded">
                    <div class="row g-0">
                        <div class="col-4  col-lg-4 col-xl-3">
                            <div class="h-100">
                                <img src="{{ asset('img/harga/cabe_keriting.jpg') }}" class="img-fluid h-100 rounded"
                                    style="object-fit: cover;" alt="">
                            </div>
                        </div>
                        <div class="col-8 col-lg-8 col-xl-9">
                            <div class="d-flex flex-column my-auto text-start p-4">
                                <h4 class="text-dark mb-2">Cabe Keriting</h4>
                                {{-- <p class="mb-2 text-primary">{{ $dataharga->tanggal }}</p> --}}
                                <h5 class="mb-0">Rp {{ number_format($dataharga->cabe_keriting, 0, ',', '.') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded">
                    <div class="row g-0">
                        <div class="col-4  col-lg-4 col-xl-3">
                            <div class="h-100">
                                <img src="{{ asset('img/harga/bawang_merah.jpg') }}" class="img-fluid h-100 rounded"
                                    style="object-fit: cover;" alt="">
                            </div>
                        </div>
                        <div class="col-8 col-lg-8 col-xl-9">
                            <div class="d-flex flex-column my-auto text-start p-4">
                                <h4 class="text-dark mb-2">Bawang Merah</h4>
                                {{-- <p class="mb-2 text-primary">{{ $dataharga->tanggal }}</p> --}}
                                <h5 class="mb-0">Rp {{ number_format($dataharga->bawang_merah, 0, ',', '.') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded">
                    <div class="row g-0">
                        <div class="col-4  col-lg-4 col-xl-3">
                            <div class="h-100">
                                <img src="{{ asset('img/harga/daging_ayam.jpg') }}" class="img-fluid h-100 rounded"
                                    style="object-fit: cover;" alt="">
                            </div>
                        </div>
                        <div class="col-8 col-lg-8 col-xl-9">
                            <div class="d-flex flex-column my-auto text-start p-4">
                                <h4 class="text-dark mb-2">Daging Ayam</h4>
                                {{-- <p class="mb-2 text-primary">{{ $dataharga->tanggal }}</p> --}}
                                <h5 class="mb-0">Rp {{ number_format($dataharga->daging_ayam, 0, ',', '.') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded">
                    <div class="row g-0">
                        <div class="col-4  col-lg-4 col-xl-3">
                            <div class="h-100">
                                <img src="{{ asset('img/harga/daging_sapi.jpg') }}" class="img-fluid h-100 rounded"
                                    style="object-fit: cover;" alt="">
                            </div>
                        </div>
                        <div class="col-8 col-lg-8 col-xl-9">
                            <div class="d-flex flex-column my-auto text-start p-4">
                                <h4 class="text-dark mb-2">Daging Sapi</h4>
                                {{-- <p class="mb-2 text-primary">{{ $dataharga->tanggal }}</p> --}}
                                <h5 class="mb-0">Rp {{ number_format($dataharga->daging_sapi, 0, ',', '.') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded">
                    <div class="row g-0">
                        <div class="col-4  col-lg-4 col-xl-3">
                            <div class="h-100">
                                <img src="{{ asset('img/harga/telur_ayam_ras.jpg') }}" class="img-fluid h-100 rounded"
                                    style="object-fit: cover;" alt="">
                            </div>
                        </div>
                        <div class="col-8 col-lg-8 col-xl-9">
                            <div class="d-flex flex-column my-auto text-start p-4">
                                <h5 class="text-dark mb-2">Telur Ayam Ras</h5>
                                {{-- <p class="mb-2 text-primary">{{ $dataharga->tanggal }}</p> --}}
                                <h5 class="mb-0">Rp {{ number_format($dataharga->telur_ayam_ras, 0, ',', '.') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
            
            @php
    use App\Services\KonsumenFetcher;
    $dataharga = KonsumenFetcher::fetch();
@endphp
<br><br>
<div class="text-center mx-auto mt-5 pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary mt-5">Data Harga Konsumen  per Tanggal
                  {{ \Carbon\Carbon::today()->format('d-m-Y') }}
                </h4>
            </div>
<div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.2s">
    @foreach ($dataharga as $item) 
    <div class="testimonial-item bg-light rounded">
        <div class="row g-0">
            <div class="col-12 col-lg-12 col-xl-12">
                <div class="d-flex flex-column my-auto text-start p-4">
                    <h5 class="text-dark mb-2">{{ $item['nama_bahan_pokok'] }}</h5>
                    <h6>Harga Hari ini <b>Rp {{$item['harga_sekarang'] }}</b></h6>                              
                    <h6>Harga Kemarin <b>Rp {{$item['harga_kemarin'] }}</b></h6>     
                </div>
            </div>
        </div>
    </div>
    @endforeach 
</div>

      
                
        </div>
    </div>
    <!-- Testimonial End -->
    <!-- Feature Start -->
    <div class="container-fluid feature bg-white py-2">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary">Kata Sambutan</h4>
                <h1 class="display-4 mb-4">Sistem Informasi Pangan Kabupaten Blitar</h1>
                <p class="mb-0">Sejalan dengan upaya untuk mewujudkan Visi dan Misi Kabupaten Blitar, Dinas Ketahanan Pangan dan Pertanian Kabupaten Blitar mereposisi untuk merespon tuntutan yang berkembang di bidang teknologi Informasi
                    dan keterbukaan informasi publik. Sistem informasi Pangan Kabupaten Blitar adalah sebuah sistem
                    informasi yang menyajikan informasi pangan yang penting dan akurat yang ada di Kabupaten Blitar. Sistem
                    informasi pangan ini berbasis web , sehingga setiap orang dapat mengakses kapanpun dimanapun
                </p>
            </div>
        </div>
    </div>
    <!-- Feature End -->

    <!-- About Start -->
    <div class="container-fluid bg-light about">
        <div class="container">
            <div class="wow fadeInRight" data-wow-delay="0.2s">
                <div class="bg-light p-5 h-100">
                    <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                        <h4 class="text-primary">Grafik Data Pangan</h4>
                        <h1 class="display-4 mb-4">Data dan Informasi Terkini</h1>
                        <p class="mb-0">Sistem Informasi Pangan Kabupaten Blitar merupakan platform digital yang
                            dirancang untuk menyediakan data dan informasi terkini terkait ketersediaan, distribusi, dan
                            publikasi pangan di Kabupaten Blitar.
                        </p>
                    </div>
                    <div class="p-4 m-20 bg-white rounded fadeInLeft">
                        {!! $chart->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- About End -->

    <!-- Service Start -->
    <div class="container-fluid service py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary">Fitur Aplikasi</h4>
                <h1 class="display-4 mb-4">Menyediakan Layanan Terbaik untuk Kebutuhan Anda</h1>
                <p class="mb-0">Kami berkomitmen untuk memberikan informasi yang akurat dan terbaru mengenai harga
                    pangan,
                    data nutrisi, dan publikasi terkait. Platform kami dirancang untuk memudahkan akses Anda terhadap sumber
                    daya penting, guna mendukung keamanan pangan dan pilihan yang lebih cerdas untuk kesehatan Anda
                </p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="img/dataharga2.png" class="img-fluid rounded-top w-100" alt="">
                            <div class="service-icon p-3">
                                <i class="fa fa-tags fa-2x"></i>
                            </div>
                        </div>
                        <div class="service-content p-4">
                            <div class="service-content-inner">
                                <a href="{{ url('datahargapublic') }}" class="d-inline-block h4 mb-4">Data Harga</a>
                                <p class="mb-4">Menyediakan informasi mengenai harga berbagai jenis bahan pangan di
                                    pasar.</p>
                                <a class="btn btn-primary rounded-pill py-2 px-4"
                                    href="{{ url('datahargapublic') }}">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="img/datapangan.jpg" class="img-fluid rounded-top w-100" alt="">
                            <div class="service-icon p-3">
                                <i class="fa fa-table fa-2x"></i>
                            </div>
                        </div>
                        <div class="service-content p-4">
                            <div class="service-content-inner">
                                <a href="{{ url('datapanganpublic') }}" class="d-inline-block h4 mb-4">Data Pangan</a>
                                <p class="mb-4">Menyajikan informasi tentang ketersediaan pangan, termasuk distribusi
                                    dari bank pangan.

                                </p>
                                <a class="btn btn-primary rounded-pill py-2 px-4"
                                    href="{{ url('datapanganpublic') }}">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="img/datanbm.jpg" class="img-fluid rounded-top w-100" alt="">
                            <div class="service-icon p-3">
                                <i class="fa fa-book fa-2x"></i>
                            </div>
                        </div>
                        <div class="service-content p-4">
                            <div class="service-content-inner">
                                <a href="{{ url('nbmpublic') }}" class="d-inline-block h4 mb-4">Data NBM</a>
                                <p class="mb-4">Mengumpulkan dan menampilkan data tentang distribusi serta keseimbangan
                                    bahan makanan.</p>
                                <a class="btn btn-primary rounded-pill py-2 px-4" href="{{ url('nbmpublic') }}">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="img/publikasipangan.jpg" class="img-fluid rounded-top w-100" alt="">
                            <div class="service-icon p-3">
                                <i class="fa fa-archive fa-2x"></i>
                            </div>
                        </div>
                        <div class="service-content p-4">
                            <div class="service-content-inner">
                                <a href="{{ url('publikasipanganpublic') }}" class="d-inline-block h4 mb-4">Publikasi
                                    Pangan</a>
                                <p class="mb-4">Menyediakan publikasi terkait kebijakan pangan dan informasi
                                    terbaru terkait kondisi pangan.
                                </p>
                                <a class="btn btn-primary rounded-pill py-2 px-4"
                                    href="{{ url('publikasipanganpublic') }}">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- FAQs Start -->
    <div class="container-fluid faq-section bg-light py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="h-100">
                        <div class="mb-5">
                            <h4 class="text-primary">Beberapa FAQ Penting</h4>
                            <h1 class="display-4 mb-0">Pertanyaan Umum yang Sering Diajukan</h1>
                        </div>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button border-0" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Q: Apa itu SIP Kabupaten Blitar?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show active"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body rounded">
                                        A: SIP Kabupaten Blitar (Sistem Informasi Pangan) adalah aplikasi inovatif yang
                                        dikembangkan oleh Dinas Ketahanan Pangan dan Pertanian Kabupaten Blitar. Aplikasi
                                        ini memberikan informasi yang akurat dan terkini mengenai harga pangan kepada
                                        masyarakat. SIP bertujuan untuk meningkatkan transparansi pasar dengan menampilkan
                                        harga konsumen dan produsen secara real-time, yang diperbarui oleh penyuluh
                                        pertanian setempat.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Q: Bagaimana cara kerja SIP Kabupaten Blitar?
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        A: Data harga pangan di SIP Kabupaten Blitar diinput secara rutin oleh para penyuluh
                                        pertanian yang bertugas memantau dan mengumpulkan informasi dari berbagai sumber.
                                        Informasi harga tersebut kemudian disajikan dalam aplikasi sehingga dapat diakses
                                        oleh masyarakat, termasuk konsumen, produsen, dan pedagang. Aplikasi ini membantu
                                        mereka memahami dinamika pasar dan membuat keputusan yang lebih baik dalam
                                        berbelanja atau memasarkan produk pertanian.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        Q: Apa manfaat SIP Kabupaten Blitar bagi masyarakat?
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        A: SIP Kabupaten Blitar memudahkan masyarakat dalam mengakses informasi harga pangan
                                        secara cepat dan mudah. Konsumen dapat memanfaatkan aplikasi ini untuk membandingkan
                                        harga dan mengelola anggaran belanja. Sementara itu, produsen dan pedagang bisa
                                        memantau harga terkini untuk meningkatkan daya saing produk mereka. Selain itu,
                                        aplikasi ini mendukung pemerintah dalam menjaga stabilitas harga pangan dan
                                        meningkatkan kesejahteraan petani.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.4s">
                    <img src="img/carousel-2.png" class="img-fluid w-100" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- FAQs End -->

    <!-- Blog Start -->
    <div class="container-fluid blog py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary">Publikasi Pangan</h4>
                <h1 class="display-4 mb-4">Berita Dan Pembaruan</h1>
                <p class="mb-0">Sistem Informasi Pangan ini dirancang untuk memastikan masyarakat memperoleh akses yang
                    mudah terhadap data dan perkembangan terkini mengenai distribusi pangan, ketersediaan stok, serta
                    berbagai kebijakan terkait ketahanan pangan.
                </p>
            </div>
            <div class="container">
                <div class="row g-4 justify-content-center">
                    @foreach ($publikasiPangan as $post)
                        <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="blog-item">
                                <div class="blog-img">
                                    <img src="{{ $post['gambar'] }}" class="img-fluid rounded-top w-100"
                                        alt="{{ $post['judul'] }}">
                                </div>
                                <div class="blog-content p-4">
                                    <div class="blog-comment d-flex justify-content-between mb-3">
                                        {{-- <div class="small"><span class="fa fa-user text-primary"></span>
                                            {{ $post->author ?? '-Data Kosong-' }}
                                        </div> --}}
                                        <div class="small"><span class="fa fa-calendar text-primary"></span>
                                            {{ $post['tahun'] }}</div>
                                    </div>
                                    <a href="#" class="h4 d-inline-block mb-3">{{ $post['judul'] }}</a>
                                    <p class="mb-3">Kecamatan : {{ $post->kecamatan->nama ?? '-Data Kosong-' }}</p>
                                    <a href="{{ $post['gambar'] }}" class="btn p-0">Read More <i
                                            class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="my-5 text-center wow fadeInUp" data-wow-delay="0.2s">
                    <a class="btn btn-primary rounded-pill py-3 px-5"
                        href="{{ url('publikasipanganpublic') }}">Selengkapnya</a>
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
    <script src="{{ $chart->cdn() }}"></script>

    {{ $chart->script() }}
    <script>
        $(document).ready(function() {
            // Add 'row' class to each 'card' within the form with class 'form'
            $('.form').addClass('row');
        });
    </script>
@endsection
