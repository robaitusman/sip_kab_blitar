<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("hargaprodusen/add");
    $can_edit = $user->canAccess("hargaprodusen/edit");
    $can_view = $user->canAccess("hargaprodusen/view");
    $can_delete = $user->canAccess("hargaprodusen/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = "Harga Produsen"; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="list" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="mt-5 bg-light p-3 mb-3" >
        <div class="container-fluid">
            <div class="row justify-content-between align-items-center gap-3">
                <div class="col  " >
                    <div class="">
                        <div class="h5 font-weight-bold text-primary">Harga Produsen</div>
                    </div>
                </div>
                <div class="col-auto  " >
                    <?php if($can_add){ ?>
                    <a  class="btn btn-primary btn-block" href="<?php print_link("hargaprodusen/add", true) ?>" >
                    <i class="material-icons">add</i>                               
                    Add New Harga Produsen 
                </a>
                <?php } ?>
            </div>
            <div class="col-md-3  " >
                <!-- Page drop down search component -->
                <form  class="search" action="{{ url()->current() }}" method="get">
                    <input type="hidden" name="page" value="1" />
                    <div class="input-group">
                        <input value="<?php echo get_value('search'); ?>" class="form-control page-search" type="text" name="search"  placeholder="Search" />
                        <button class="btn btn-primary"><i class="material-icons">search</i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    }
?>
<div  class="" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col comp-grid " >
                <form method="get" action="" class="form">
                    <div class="card mb-3 p-3 ">
                        <div class="">
                            <div class="fw-bold">Filter by Tanggal</div>
                        </div>
                        <div class="">
                            <input class="form-control datepicker"  value="<?php echo get_value('tanggal') ?>" type="datetime"  name="tanggal" placeholder="Select date" data-enable-time="" data-date-format="Y-m-d" data-alt-format="M j, Y" data-inline="false" data-no-calendar="false" data-mode="range"  />
                        </div>
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
            <div class="col comp-grid " >
                <div  class=" page-content" >
                    <div id="hargaprodusen-harga_produsen_saya-records">
                        <div id="page-main-content" class="table-responsive">
                            <?php Html::page_bread_crumb("/hargaprodusen/harga_produsen_saya", $field_name, $field_value); ?>
                            <?php Html::display_page_errors($errors); ?>
                            <div class="filter-tags mb-2">
                                <?php Html::filter_tag('search', __('Search')); ?>
                                <!-- Page filter list goes here -->
                            </div>
                            <?php if($total_records){ ?>
                            <table class="table table-hover table-striped table-sm text-left flip-table">
                                <tbody>
                                    <?php if($can_delete){ ?>
                                    <tr>
                                        <th class="td-checkbox">
                                        <label class="form-check-label">
                                        <input class="toggle-check-all form-check-input" type="checkbox" />
                                        </label>
                                        </th>
                                        <?php foreach($records as $data) { ?>
                                        <td class="td-checkbox">
                                            <label class="form-check-label">
                                            <input class="optioncheck form-check-input" name="optioncheck[]" value="<?php echo $data['id'] ?>" type="checkbox" />
                                            </label>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <th class="td-id">Komoditas</th>
                                        <?php foreach($records as $data) { ?>
                                        <td class="td-tanggal">
                                            <strong>    <?php echo date('d-m-Y', strtotime($data['tanggal'])); ?></strong>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th class="td-gkp_petani">Gkp Petani</th>
                                        <?php foreach($records as $data) { ?>
                                        <td class="td-gkp_petani">
                                            <?php echo to_currency($data['gkp_petani'], 'en-ID'); ?>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th class="td-gkg_penggilingan">Gkg Penggilingan</th>
                                        <?php foreach($records as $data) { ?>
                                        <td class="td-gkg_penggilingan">
                                            <?php echo to_currency($data['gkg_penggilingan'], 'en-ID'); ?>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th class="td-beras_premium">Beras Premium</th>
                                        <?php foreach($records as $data) { ?>
                                        <td class="td-beras_premium">
                                            <?php echo to_currency($data['beras_premium'], 'en-ID'); ?>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th class="td-beras_medium">Beras Medium</th>
                                        <?php foreach($records as $data) { ?>
                                        <td class="td-beras_medium">
                                            <?php echo to_currency($data['beras_medium'], 'en-ID'); ?>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th class="td-jagung_pipilan_kering">Jagung Pipilan Kering</th>
                                        <?php foreach($records as $data) { ?>
                                        <td class="td-jagung_pipilan_kering">
                                            <?php echo to_currency($data['jagung_pipilan_kering'], 'en-ID'); ?>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th class="td-ubi_kayu">Ubi Kayu</th>
                                        <?php foreach($records as $data) { ?>
                                        <td class="td-ubi_kayu">
                                            <?php echo to_currency($data['ubi_kayu'], 'en-ID'); ?>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th class="td-ubi_jalar">Ubi Jalar</th>
                                        <?php foreach($records as $data) { ?>
                                        <td class="td-ubi_jalar">
                                            <?php echo to_currency($data['ubi_jalar'], 'en-ID'); ?>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th class="td-kedelai_lokal_kering">Kedelai Lokal Kering</th>
                                        <?php foreach($records as $data) { ?>
                                        <td class="td-kedelai_lokal_kering">
                                            <?php echo to_currency($data['kedelai_lokal_kering'], 'en-ID'); ?>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th class="td-cabe_besar">Cabe Besar</th>
                                        <?php foreach($records as $data) { ?>
                                        <td class="td-cabe_besar">
                                            <?php echo to_currency($data['cabe_besar'], 'en-ID'); ?>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th class="td-cabe_rawit_merah">Cabe Rawit Merah</th>
                                        <?php foreach($records as $data) { ?>
                                        <td class="td-cabe_rawit_merah">
                                            <?php echo to_currency($data['cabe_rawit_merah'], 'en-ID'); ?>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th class="td-cabe_keriting">Cabe Keriting</th>
                                        <?php foreach($records as $data) { ?>
                                        <td class="td-cabe_keriting">
                                            <?php echo to_currency($data['cabe_keriting'], 'en-ID'); ?>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th class="td-bawang_merah">Bawang Merah</th>
                                        <?php foreach($records as $data) { ?>
                                        <td class="td-bawang_merah">
                                            <?php echo to_currency($data['bawang_merah'], 'en-ID'); ?>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th class="td-daging_ayam">Daging Ayam</th>
                                        <?php foreach($records as $data) { ?>
                                        <td class="td-daging_ayam">
                                            <?php echo to_currency($data['daging_ayam'], 'en-ID'); ?>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th class="td-daging_sapi">Daging Sapi</th>
                                        <?php foreach($records as $data) { ?>
                                        <td class="td-daging_sapi">
                                            <?php echo to_currency($data['daging_sapi'], 'en-ID'); ?>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th class="td-telur_ayam_ras">Telur Ayam Ras</th>
                                        <?php foreach($records as $data) { ?>
                                        <td class="td-telur_ayam_ras">
                                            <?php echo to_currency($data['telur_ayam_ras'], 'en-ID'); ?>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th class="td-pisang">Pisang</th>
                                        <?php foreach($records as $data) { ?>
                                        <td class="td-pisang">
                                            <?php echo to_currency($data['pisang'], 'en-ID'); ?>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th class="td-jeruk">Jeruk</th>
                                        <?php foreach($records as $data) { ?>
                                        <td class="td-jeruk">
                                            <?php echo to_currency($data['jeruk'], 'en-ID'); ?>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th class="td-btn">Aksi</th>
                                        <?php foreach($records as $data) { 
                                            $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                                        ?>
                                        <td class="td-btn">
                                            <?php if($can_view) { ?>
                                            <a class="btn btn-sm btn-primary has-tooltip" href="<?php print_link("hargaprodusen/view/$rec_id"); ?>">
                                            <i class="material-icons">visibility</i> View
                                        </a>
                                        <?php } ?>
                                        <?php if($can_edit) { ?>
                                        <a class="btn btn-sm btn-success has-tooltip" href="<?php print_link("hargaprodusen/edit/$rec_id"); ?>">
                                        <i class="material-icons">edit</i> Edit
                                    </a>
                                    <?php } ?>
                                    <?php if($can_delete) { ?>
                                    <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal" href="<?php print_link("hargaprodusen/delete/$rec_id"); ?>">
                                    <i class="material-icons">delete_sweep</i> Delete
                                </a>
                                <?php } ?>
                            </td>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
                <?php } else { ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <td class="bg-light text-center text-muted animated bounce p-3" colspan="1000">
                                <i class="material-icons">block</i> No record found
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php } ?>
                <?php if($show_footer){ ?>
                <div class="mt-3">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-md-auto d-flex">
                            <?php if($can_delete){ ?>
                            <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("hargaprodusen/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                            <i class="material-icons">delete_sweep</i> Delete Selected
                            </button>
                            <?php } ?>
                        </div>
                        <div class="col">
                            <?php
                                if($show_pagination == true){
                                $pager = new Pagination($total_records, $record_count);
                                $pager->show_page_count = false;
                                $pager->show_record_count = true;
                                $pager->show_page_limit = false;
                                $pager->limit = $limit;
                                $pager->show_page_number_list = true;
                                $pager->pager_link_range = 5;
                                $pager->render();
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="col-12 comp-grid " >
    <div class="">
        <div class="h5 font-weight-bold">Tes</div>
    </div>
</div>
</div>
</div>
</div>
</section>
<!-- Page custom js --><script>$(document).ready(function(){
	// custom javascript | jquery codes
});$(document).ready(function(){
	// custom javascript | jquery codes
});</script>

@endsection
