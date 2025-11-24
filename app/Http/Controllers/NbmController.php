<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\NbmAddRequest;
use App\Http\Requests\NbmEditRequest;
use App\Models\Nbm;
use Illuminate\Http\Request;
use Exception;
class NbmController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.nbm.list";
		$query = Nbm::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Nbm::search($query, $search); // search table records
		}
		$query->join("kecamatan", "nbm.id_kecamatan", "=", "kecamatan.id");
		$orderby = $request->orderby ?? "nbm.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Nbm::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Nbm::query();
		$query->join("kecamatan", "nbm.id_kecamatan", "=", "kecamatan.id");
		$record = $query->findOrFail($rec_id, Nbm::viewFields());
		return $this->renderView("pages.nbm.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.nbm.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(NbmAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("file", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['file'], "file");
			$modeldata['file'] = $fileInfo['filepath'];
		}
		$modeldata['id_kecamatan'] = auth()->user()->id_kecamatan;
		
		//save Nbm record
		$record = Nbm::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("nbm/nbm_saya", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(NbmEditRequest $request, $rec_id = null){
		$query = Nbm::query();
		$record = $query->findOrFail($rec_id, Nbm::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("file", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['file'], "file");
			$modeldata['file'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("nbm/nbm_saya", "Record updated successfully");
		}
		return $this->renderView("pages.nbm.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Nbm::query();
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
	function nbm_saya(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.nbm.nbm_saya";
		$query = Nbm::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Nbm::search($query, $search); // search table records
		}
		$query->join("kecamatan", "nbm.id_kecamatan", "=", "kecamatan.id");
		$orderby = $request->orderby ?? "nbm.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("id_kecamatan", "=" , auth()->user()->id_kecamatan);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Nbm::nbmSayaFields());
		return $this->renderView($view, compact("records"));
	}
}
