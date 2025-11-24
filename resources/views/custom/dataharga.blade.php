<!--
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
$tahun_option_list = $comp_model->tahun_option_list();
$pageTitle = 'Data Harga'; // set dynamic page title
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
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Data Harga</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href={{ url('/') }}>Beranda</a></li>
                <li class="breadcrumb-item active text-primary">Data Harga</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->


    <!-- Blog Start -->
    <div class="container-fluid blog py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary">Data Harga</h4>
                <h1 class="display-4 mb-4">Update Data Harga Pangan Kabupaten Blitar</h1>
                <p class="mb-0">Data Harga Pangan Kabupaten Blitar memberikan informasi terbaru mengenai harga berbagai
                    komoditas pangan yang tersedia di pasar lokal. Dengan pemantauan harga yang akurat dan terkini,
                    masyarakat dapat lebih mudah mengakses informasi tentang fluktuasi harga dan mengambil keputusan yang
                    tepat terkait pembelian atau penjualan bahan pangan.
                </p>
            </div>
            <form method="GET" action="{{ url('/datahargapublic') }}" class="mb-3 ">
                <label for="tanggal">Filter :</label>
                <input type="date" id="tanggal" name="tanggal" value="{{ $selectedDate }}">
                <button type="submit" class="rounded btn btn-primary">Filter</button>
            </form>
            
            @php
                function formatRupiah($value) {
                    return $value ? 'Rp ' . number_format($value, 0, ',', '.') : '-';
                }
            @endphp



            <table class="table table-hover table-striped text-left">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Harga Kemarin (Rp)</th>
                        <th>Harga Hari ini (Rp)</th>
                        <th>Selisih</th>
                        <th>Grafik</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>GKP Petani</td>
                        <td class="hargax">{{ formatRupiah($dataYesterday->avg_gkp_petani_kemaren) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_gkp_petani) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_gkp_petani - $dataYesterday->avg_gkp_petani_kemaren) }}</td>
                        <td><a href="/commodity-graph/gkp_petani">grafik</a></td>
                    </tr>
                    <tr>
                        <td>GKG Penggilingan</td>
                        <td class="hargax">{{ formatRupiah($dataYesterday->avg_gkg_penggilingan_kemaren) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_gkg_penggilingan) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_gkg_penggilingan - $dataYesterday->avg_gkg_penggilingan_kemaren) }}</td>
                        <td><a href="/commodity-graph/gkg_penggilingan">grafik</a></td>
                    </tr>
                    <tr>
                        <td>Beras Premium</td>
                        <td class="hargax">{{ formatRupiah($dataYesterday->avg_beras_premium_kemaren) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_beras_premium) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_beras_premium - $dataYesterday->avg_beras_premium_kemaren) }}</td>
                        <td><a href="/commodity-graph/beras_premium">grafik</a></td>
                    </tr>
                    <tr>
                        <td>Beras Medium</td>
                        <td class="hargax">{{ formatRupiah($dataYesterday->avg_beras_medium_kemaren) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_beras_medium) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_beras_medium - $dataYesterday->avg_beras_medium_kemaren) }}</td>
                        <td><a href="/commodity-graph/beras_medium">grafik</a></td>
                    </tr>
                    <tr>
                        <td>Jagung Pipilan Kering</td>
                        <td class="hargax">{{ formatRupiah($dataYesterday->avg_jagung_pipilan_kering_kemaren) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_jagung_pipilan_kering) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_jagung_pipilan_kering - $dataYesterday->avg_jagung_pipilan_kering_kemaren ) }}
                        </td>
                        <td><a href="/commodity-graph/jagung_pipilan_kering">grafik</a></td>
                    </tr>
                    <tr>
                        <td>Ubi Kayu</td>
                        <td class="hargax">{{ formatRupiah($dataYesterday->avg_ubi_kayu_kemaren) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_ubi_kayu) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_ubi_kayu - $dataYesterday->avg_ubi_kayu_kemaren) }}</td>
                        <td><a href="/commodity-graph/ubi_kayu">grafik</a></td>
                    </tr>
                    <tr>
                        <td>Ubi Jalar</td>
                        <td class="hargax">{{ formatRupiah($dataYesterday->avg_ubi_jalar_kemaren) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_ubi_jalar) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_ubi_jalar - $dataYesterday->avg_ubi_jalar_kemaren) }}</td>
                        <td><a href="/commodity-graph/ubi_jalar">grafik</a></td>
                    </tr>
                    <tr>
                        <td>Kedelai Lokal Kering</td>
                        <td class="hargax">{{ formatRupiah($dataYesterday->avg_kedelai_lokal_kering_kemaren) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_kedelai_lokal_kering) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_kedelai_lokal_kering - $dataYesterday->avg_kedelai_lokal_kering_kemaren ) }}
                        </td>
                        <td><a href="/commodity-graph/kedelai_lokal_kering">grafik</a></td>
                    </tr>
                    <tr>
                        <td>Cabe Besar</td>
                        <td class="hargax">{{ formatRupiah($dataYesterday->avg_cabe_besar_kemaren) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_cabe_besar) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_cabe_besar - $dataYesterday->avg_cabe_besar_kemaren) }}</td>
                        <td><a href="/commodity-graph/cabe_besar">grafik</a></td>
                    </tr>
                    <tr>
                        <td>Cabe Rawit Merah</td>
                        <td class="hargax">{{ formatRupiah($dataYesterday->avg_cabe_rawit_merah_kemaren) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_cabe_rawit_merah) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_cabe_rawit_merah - $dataYesterday->avg_cabe_rawit_merah_kemaren) }}</td>
                        <td><a href="/commodity-graph/cabe_rawit_merah">grafik</a></td>
                    </tr>
                    <tr>
                        <td>Cabe Keriting</td>
                        <td class="hargax">{{ formatRupiah($dataYesterday->avg_cabe_keriting_kemaren) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_cabe_keriting) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_cabe_keriting - $dataYesterday->avg_cabe_keriting_kemaren) }}</td>
                        <td><a href="/grafik/cabe_keriting">grafik</a></td>
                    </tr>
                    <tr>
                        <td>Bawang Merah</td>
                        <td class="hargax">{{ formatRupiah($dataYesterday->avg_bawang_merah_kemaren) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_bawang_merah) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_bawang_merah - $dataYesterday->avg_bawang_merah_kemaren) }}</td>
                        <td><a href="/commodity-graph/bawang_merah">grafik</a></td>
                    </tr>
                    <tr>
                        <td>Daging Ayam</td>
                        <td class="hargax">{{ formatRupiah($dataYesterday->avg_daging_ayam_kemaren) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_daging_ayam) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_daging_ayam - $dataYesterday->avg_daging_ayam_kemaren) }}</td>
                        <td><a href="/commodity-graph/daging_ayam">grafik</a></td>
                    </tr>
                    <tr>
                        <td>Daging Sapi</td>
                        <td class="hargax">{{ formatRupiah($dataYesterday->avg_daging_sapi_kemaren) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_daging_sapi) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_daging_sapi - $dataYesterday->avg_daging_sapi_kemaren) }}</td>
                        <td><a href="/commodity-graph/daging_sapi">grafik</a></td>
                    </tr>
                    <tr>
                        <td>Telur Ayam Ras</td>
                        <td class="hargax">{{ formatRupiah($dataYesterday->avg_telur_ayam_ras_kemaren) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_telur_ayam_ras) }}</td>
                        <td class="hargax">{{ formatRupiah($dataToday->avg_telur_ayam_ras - $dataYesterday->avg_telur_ayam_ras_kemaren) }}</td>
                        <td><a href="/commodity-graph/telur_ayam_ras">grafik</a></td>
                    </tr>
                   
                </tbody>
            </table>

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
