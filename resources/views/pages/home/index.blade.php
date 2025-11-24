<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php 
    $tahun_option_list = $comp_model->tahun_option_list();
    $pageTitle = "Home"; // set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<div>
    <div  class="bg-light p-3 mb-3" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col comp-grid " >
                    <div class="">
                        <div class="h5 font-weight-bold">Home</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  class="mb-3" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-12 comp-grid " >
                    <form method="get" action="" class="form">
                        <div class="card mb-3 p-3 col-md-5 m-2 ">
                            <div class="">
                                <div class="fw-bold">Filter by Bulan</div>
                            </div>
                            <select   name="bulan" class="form-select custom " >
                            <option value="">Select a value ...</option>
                            <?php
                                $options = Menu::bulan();
                                if(!empty($options)){
                                foreach($options as $option){
                                $value = $option['value'];
                                $label = $option['label'];
                                $selected = Html::get_field_selected('bulan', $value);
                            ?>
                            <option <?php echo $selected ?> value="<?php echo $value ?>">
                            <?php echo $label ?>
                            </option>                                   
                            <?php
                                }
                                }
                            ?>
                            </select>
                        </div>
                        <div class="card mb-3 p-3 col-md-5 m-2 ">
                            <div class="">
                                <div class="fw-bold">Filter by Tahun</div>
                            </div>
                            <select   name="tahun" class="form-select custom " >
                            <option value="">Select a value ...</option>
                            <?php 
                                $options = $tahun_option_list ?? [];
                                foreach($options as $option){
                                $value = $option->value;
                                $label = $option->label ?? $value;
                                $selected = Html::get_field_selected('tahun', $value);
                            ?>
                            <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                            <?php echo $label; ?>
                            </option>
                            <?php
                                }
                            ?>
                            </select>
                        </div>
                        <hr />
                        <div class="form-group text-center">
                            <button class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div  class="mb-3" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-4 comp-grid " >
                    <!--Include chart component-->
                    @include("pages.home-gkp-petani")
                </div>
                <div class="col-md-4 comp-grid " >
                    <!--Include chart component-->
                    @include("pages.home-gkg-penggilingan")
                </div>
                <div class="col-md-4 comp-grid " >
                    <!--Include chart component-->
                    @include("pages.home-beras-premium")
                </div>
            </div>
        </div>
    </div>
    <div  class="mb-3" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-4 comp-grid " >
                    <!--Include chart component-->
                    @include("pages.home-beras-medium")
                </div>
                <div class="col-md-4 comp-grid " >
                    <!--Include chart component-->
                    @include("pages.home-jagung-pipilan-kering")
                </div>
                <div class="col-md-4 comp-grid " >
                    <!--Include chart component-->
                    @include("pages.home-ubi-kayu")
                </div>
            </div>
        </div>
    </div>
    <div  class="mb-3" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-4 comp-grid " >
                    <!--Include chart component-->
                    @include("pages.home-ubi-jalar")
                </div>
                <div class="col-md-4 comp-grid " >
                    <!--Include chart component-->
                    @include("pages.home-kedelai-lokal-kering")
                </div>
                <div class="col-md-4 comp-grid " >
                    <!--Include chart component-->
                    @include("pages.home-cabe-besar")
                </div>
            </div>
        </div>
    </div>
    <div  class="mb-3" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-4 comp-grid " >
                    <!--Include chart component-->
                    @include("pages.home-cabe-rawit-merah")
                </div>
                <div class="col-md-4 comp-grid " >
                    <!--Include chart component-->
                    @include("pages.home-cabe-keriting")
                </div>
                <div class="col-md-4 comp-grid " >
                    <!--Include chart component-->
                    @include("pages.home-bawang-merah")
                </div>
            </div>
        </div>
    </div>
    <div  class="mb-3" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-4 comp-grid " >
                    <!--Include chart component-->
                    @include("pages.home-daging-ayam")
                </div>
                <div class="col-md-4 comp-grid " >
                    <!--Include chart component-->
                    @include("pages.home-daging-sapi")
                </div>
                <div class="col-md-4 comp-grid " >
                    <!--Include chart component-->
                    @include("pages.home-telur-ayam-ras")
                </div>
            </div>
        </div>
    </div>

</div>
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
