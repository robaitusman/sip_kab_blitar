<!--
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
$tahun_option_list = $comp_model->tahun_option_list();
$pageTitle = 'Grafik'; // set dynamic page title
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
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Grafik
                {{ ucfirst(str_replace('_', ' ', $commodity)) }}</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href={{ url('/') }}>Beranda</a></li>
                <li class="breadcrumb-item"><a href={{ url('datahargapublic') }}>Data Harga</a></li>
                <li class="breadcrumb-item active text-primary">{{ ucfirst(str_replace('_', ' ', $commodity)) }}</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->


    <!-- Blog Start -->
    <div class="container-fluid blog py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary">Data Rata-Rata Harga per Minggu</h4>
                <h1 class="display-4 mb-4">{{ ucfirst(str_replace('_', ' ', $commodity)) }}</h1>
            </div>
            <div>
                {!! $chart->container() !!}
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
