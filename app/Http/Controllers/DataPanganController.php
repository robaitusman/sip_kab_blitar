<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\DataPanganAddRequest;
use App\Http\Requests\DataPanganEditRequest;
use App\Models\DataPangan;
use Illuminate\Http\Request;
use Exception;
class DataPanganController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.datapangan.list";
		$query = DataPangan::query();
		$limit = $request->limit ?? 50;
		if($request->search){
			$search = trim($request->search);
			DataPangan::search($query, $search); // search table records
		}
		$query->join("kecamatan", "data_pangan.id_kecamatan", "=", "kecamatan.id");
		$orderby = $request->orderby ?? "data_pangan.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, DataPangan::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = DataPangan::query();
		$query->join("kecamatan", "data_pangan.id_kecamatan", "=", "kecamatan.id");
		$record = $query->findOrFail($rec_id, DataPangan::viewFields());
		return $this->renderView("pages.datapangan.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.datapangan.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(DataPanganAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("file", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['file'], "file");
			$modeldata['file'] = $fileInfo['filepath'];
		}
		$modeldata['id_kecamatan'] = auth()->user()->id_kecamatan;
		
		//save DataPangan record
		$record = DataPangan::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("datapangan/data_pangan_saya", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(DataPanganEditRequest $request, $rec_id = null){
		$query = DataPangan::query();
		$record = $query->findOrFail($rec_id, DataPangan::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("file", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['file'], "file");
			$modeldata['file'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("datapangan/data_pangan_saya", "Record updated successfully");
		}
		return $this->renderView("pages.datapangan.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
	

	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
	 * @param  \Illuminate\Http\Request
	 * @param string $rec_id //can be separated by comma 
     * @return \Illuminate\Http\Response
     */
	function delete(Request $request, $rec_id = null){
		$arr_id = explode(",", $rec_id);
		$query = DataPangan::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function data_pangan_saya(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.datapangan.data_pangan_saya";
		$query = DataPangan::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			DataPangan::search($query, $search); // search table records
		}
		$query->join("kecamatan", "data_pangan.id_kecamatan", "=", "kecamatan.id");
		$orderby = $request->orderby ?? "data_pangan.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("id_kecamatan", "=" , auth()->user()->id_kecamatan);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, DataPangan::dataPanganSayaFields());
		return $this->renderView($view, compact("records"));
	}
}
