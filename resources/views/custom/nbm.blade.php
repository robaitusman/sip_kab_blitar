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


    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">NBM</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href={{ url('/') }}>Beranda</a></li>
                <li class="breadcrumb-item active text-primary">NBM</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->


    <!-- Blog Start -->
    <div class="container-fluid blog py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary">Data NBM</h4>
                <h1 class="display-4 mb-4">Infrormasi Terbaru NBM Kabupaten BLitar</h1>
                <p class="mb-0">Neraca Bahan Makan (NBM) Kabupaten Blitar menyajikan informasi terkini mengenai
                    ketersediaan, distribusi, dan konsumsi bahan pangan di wilayah ini. Sistem ini membantu pemantauan arus
                    masuk dan keluar bahan makanan, memastikan kecukupan pangan bagi masyarakat.
                </p>
            </div>
            <div class="">
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col comp-grid ">
                            <div class=" page-content table-responsive">

                                <table class="table table-hover table-striped text-left">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="td-id"> No</th>
                                            <th class="td-judul"> Judul</th>
                                            <th class="td-file"> File</th>
                                            <th class="td-tahun"> Tahun</th>
                                            <th class="td-nama"> Kecamatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($nbm as $index => $data)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $data->judul }}</td>
                                                <td>
                                                    @if ($data->file)
                                                        <a href="{{ asset($data->file) }}" target="_blank">Download</a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>{{ $data->tahun }}</td>
                                                <td>{{ $data->kecamatan->nama }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <div class="fadeInUp" data-wow-delay="0.2s"
                                    style="margin-top: 20px; display: flex; justify-content: space-between;">
                                    <div>
                                        @if ($nbm->onFirstPage())
                                            <span>&laquo; Sebelum</span>
                                        @else
                                            <a href="{{ $nbm->previousPageUrl() }}">&laquo; Sebelum</a>
                                        @endif
                                    </div>
                                    <div>
                                        @if ($nbm->hasMorePages())
                                            <a href="{{ $nbm->nextPageUrl() }}">Selanjutnya &raquo;</a>
                                        @else
                                            <span>Selanjutnya &raquo;</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row g-4 justify-content-center">
                <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="img/blog-1.png" class="img-fluid rounded-top w-100" alt="">
                            <div class="blog-categiry py-2 px-4">
                                <span>Business</span>
                            </div>
                        </div>
                        <div class="blog-content p-4">
                            <div class="blog-comment d-flex justify-content-between mb-3">
                                <div class="small"><span class="fa fa-user text-primary"></span> Martin.C</div>
                                <div class="small"><span class="fa fa-calendar text-primary"></span> 30 Dec 2025</div>
                                <div class="small"><span class="fa fa-comment-alt text-primary"></span> 6 Comments</div>
                            </div>
                            <a href="#" class="h4 d-inline-block mb-3">Which allows you to pay down insurance
                                bills</a>
                            <p class="mb-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius libero soluta
                                impedit eligendi? Quibusdam, laudantium.</p>
                            <a href="#" class="btn p-0">Read More <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="img/blog-2.png" class="img-fluid rounded-top w-100" alt="">
                            <div class="blog-categiry py-2 px-4">
                                <span>Business</span>
                            </div>
                        </div>
                        <div class="blog-content p-4">
                            <div class="blog-comment d-flex justify-content-between mb-3">
                                <div class="small"><span class="fa fa-user text-primary"></span> Martin.C</div>
                                <div class="small"><span class="fa fa-calendar text-primary"></span> 30 Dec 2025</div>
                                <div class="small"><span class="fa fa-comment-alt text-primary"></span> 6 Comments</div>
                            </div>
                            <a href="#" class="h4 d-inline-block mb-3">Leverage agile frameworks to provide</a>
                            <p class="mb-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius libero soluta
                                impedit eligendi? Quibusdam, laudantium.</p>
                            <a href="#" class="btn p-0">Read More <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.6s">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="img/blog-3.png" class="img-fluid rounded-top w-100" alt="">
                            <div class="blog-categiry py-2 px-4">
                                <span>Business</span>
                            </div>
                        </div>
                        <div class="blog-content p-4">
                            <div class="blog-comment d-flex justify-content-between mb-3">
                                <div class="small"><span class="fa fa-user text-primary"></span> Martin.C</div>
                                <div class="small"><span class="fa fa-calendar text-primary"></span> 30 Dec 2025</div>
                                <div class="small"><span class="fa fa-comment-alt text-primary"></span> 6 Comments</div>
                            </div>
                            <a href="#" class="h4 d-inline-block mb-3">Leverage agile frameworks to provide</a>
                            <p class="mb-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius libero soluta
                                impedit eligendi? Quibusdam, laudantium.</p>
                            <a href="#" class="btn p-0">Read More <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div> --}}
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
