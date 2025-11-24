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
    $id_kecamatan_option_list = $comp_model->id_kecamatan_option_list();
    $pageTitle = "Harga Produsen"; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="list" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3" >
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
<div  class="mb-3" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-12 comp-grid " >
                <form method="get" action="" class="form">
                    <div class="card m-5 p-3 col-md-5 ">
                        <div class="">
                            <div class="fw-bold">Filter Kecamatan</div>
                        </div>
                        <select   name="id_kecamatan" class="form-select custom " >
                        <option value="">Select a value ...</option>
                        <?php 
                            $options = $id_kecamatan_option_list ?? [];
                            foreach($options as $option){
                            $value = $option->value;
                            $label = $option->label ?? $value;
                            $selected = Html::get_field_selected('id_kecamatan', $value);
                        ?>
                        <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                        <?php echo $label; ?>
                        </option>
                        <?php
                            }
                        ?>
                        </select>
                    </div>
                    <div class="card m-5 p-3 col-md-5 ">
                        <div class="">
                            <div class="fw-bold">Filter Tanggal</div>
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
<div  class="" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col comp-grid " >
                <div  class=" page-content" >
                    <!-- Include PapaParse for CSV export -->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>
                    <!-- Include SheetJS for Excel export -->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
                    <div id="hargaprodusen-harga_produsen_saya-records">
                        <div id="page-main-content" class="table-responsive">
                            <?php Html::page_bread_crumb("/hargaprodusen/harga_produsen_saya", $field_name, $field_value); ?>
                            <?php Html::display_page_errors($errors); ?>
                            <div class="filter-tags mb-2">
                                <?php Html::filter_tag('search', __('Search')); ?>
                                <!-- Page filter list goes here -->
                            </div>
                            <a class="btn p-2 btn-sm btn-info has-tooltip" href="#" onclick="exportTableToCSV('hargaprodusen-data.csv')">Export CSV</a>
                            <a class="btn p-2 btn-sm btn-success has-tooltip" href="#" onclick="exportTableToExcel('hargaprodusen-data.xlsx')">Export Excel</a>
                            <?php if($total_records){ ?>
                           <table class="table table-hover table-striped table-sm text-left flip-table">
    <tbody>
        <?php if ($can_delete) { ?>
        <tr>
            <th class="td-checkbox">
                <label class="form-check-label">
                    <input class="toggle-check-all form-check-input" type="checkbox" />
                </label>
            </th>
            <?php foreach ($records as $data) { ?>
            <td class="td-checkbox">
                <label class="form-check-label">
                    <input class="optioncheck form-check-input" name="optioncheck[]" value="<?php echo $data['id'] ?>" type="checkbox" />
                </label>
            </td>
            <?php } ?>
            <th>Rerata</th>
        </tr>
        <?php } ?>
        <tr>
            <th class="td-id">Tanggal</th>
            <?php foreach ($records as $data) { ?>
            <td class="td-tanggal">
                <strong><?php echo date('d-m-Y', strtotime($data['tanggal'])); ?></strong>
            </td>
            <?php } ?>
            <td></td> <!-- Kolom kosong untuk "Rerata" -->
        </tr>
        <tr>
            <th class="td-id">Kecamatan</th>
            <?php foreach ($records as $data) { ?>
            <td class="td-tanggal">
                <strong><?php echo $data['kecamatan_nama']; ?><br></strong>
            </td>
            <?php } ?>
            <td></td> <!-- Kolom kosong untuk "Rerata" -->
        </tr>

        <?php 
        // Daftar kolom untuk dihitung reratanya
        $fields = [
            'gkp_petani', 
            'gkg_penggilingan', 
            'beras_premium', 
            'beras_medium', 
            'jagung_pipilan_kering', 
            'ubi_kayu', 
            'ubi_jalar', 
            'kedelai_lokal_kering', 
            'cabe_besar', 
            'cabe_rawit_merah', 
            'cabe_keriting', 
            'bawang_merah', 
            'daging_ayam', 
            'daging_sapi', 
            'telur_ayam_ras'
        ];

        foreach ($fields as $field) { ?>
        <tr>
            <th class="td-<?php echo $field; ?>"><?php echo ucwords(str_replace('_', ' ', $field)); ?></th>
            <?php 
            $total = 0;
            $count = 0;
            foreach ($records as $data) { 
                $value = $data[$field];
                if ($value > 0) { // Abaikan nilai 0
                    $total += $value;
                    $count++;
                }
            ?>
            <td class="td-<?php echo $field; ?>">
                <?php echo to_currency($value, 'en-ID'); ?>
            </td>
            <?php } ?>
            <td class="td-<?php echo $field; ?>-rerata">
                <strong>
                    <?php 
                    // Hitung rerata
                    echo $count > 0 ? to_currency($total / $count, 'en-ID') : '-';
                    ?>
                </strong>
            </td>
        </tr>
        <?php } ?>
        <tr>
            <th class="td-btn">Aksi</th>
            <?php foreach ($records as $data) { 
                $rec_id = ($data['id'] ? urlencode($data['id']) : null);
            ?>
            <td class="td-btn">
                <?php if ($can_view) { ?>
                <a class="btn btn-sm btn-primary has-tooltip" href="<?php print_link("hargaprodusen/view/$rec_id"); ?>">
                    <i class="material-icons">visibility</i> 
                </a>
                <?php } ?>
                <?php if ($can_edit) { ?>
                <a class="btn btn-sm btn-success has-tooltip" href="<?php print_link("hargaprodusen/edit/$rec_id"); ?>">
                    <i class="material-icons">edit</i> 
                </a>
                <?php } ?>
                <?php if ($can_delete) { ?>
                <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal" href="<?php print_link("hargaprodusen/delete/$rec_id"); ?>">
                    <i class="material-icons">delete_sweep</i> 
                </a>
                <?php } ?>
            </td>
            <?php } ?>
            <td></td> <!-- Kolom kosong untuk "Rerata" -->
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
</div>
</div>
</div>
</section>
<!-- Page custom js --><script>$(document).ready(function(){
	// custom javascript | jquery codes
});$(document).ready(function() {
    $("form.form[method='get']").addClass("row");
});
function exportTableToCSV(filename) {
    var rows = [];
    var table = document.querySelector(".table"); // Select the table

    // Loop through each row in the table
    table.querySelectorAll("tr").forEach(function(row) {
        var rowData = [];
        row.querySelectorAll("td, th").forEach(function(cell) {
            rowData.push(cell.textContent);
        });
        rows.push(rowData);
    });

    // Convert array to CSV string
    var csv = Papa.unparse(rows);

    // Create a download link and trigger the download
    var csvFile = new Blob([csv], { type: "text/csv" });
    var downloadLink = document.createElement("a");
    downloadLink.download = filename;
    downloadLink.href = window.URL.createObjectURL(csvFile);
    downloadLink.style.display = "none";
    document.body.appendChild(downloadLink);
    downloadLink.click();
}
function exportTableToExcel(filename) {
    var table = document.querySelector(".table");
    var ws = XLSX.utils.table_to_sheet(table); // Convert HTML table to worksheet
    var wb = XLSX.utils.book_new(); // Create a new workbook
    XLSX.utils.book_append_sheet(wb, ws, "Sheet1"); // Append sheet to workbook

    // Write workbook and trigger the download
    XLSX.writeFile(wb, filename);
}
</script>

@endsection
