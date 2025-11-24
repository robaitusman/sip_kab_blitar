<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PublikasiPanganAddRequest;
use App\Http\Requests\PublikasiPanganEditRequest;
use App\Models\PublikasiPangan;
use Illuminate\Http\Request;
use Exception;
class PublikasiPanganController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.publikasipangan.list";
		$query = PublikasiPangan::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			PublikasiPangan::search($query, $search); // search table records
		}
		$query->join("kecamatan", "publikasi_pangan.id_kecamatan", "=", "kecamatan.id");
		$orderby = $request->orderby ?? "publikasi_pangan.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, PublikasiPangan::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = PublikasiPangan::query();
		$query->join("kecamatan", "publikasi_pangan.id_kecamatan", "=", "kecamatan.id");
		$record = $query->findOrFail($rec_id, PublikasiPangan::viewFields());
		return $this->renderView("pages.publikasipangan.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.publikasipangan.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(PublikasiPanganAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("gambar", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['gambar'], "gambar");
			$modeldata['gambar'] = $fileInfo['filepath'];
		}
		$modeldata['id_kecamatan'] = auth()->user()->id_kecamatan;
		
		//save PublikasiPangan record
		$record = PublikasiPangan::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("publikasipangan/publikasi_pangan_saya", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(PublikasiPanganEditRequest $request, $rec_id = null){
		$query = PublikasiPangan::query();
		$record = $query->findOrFail($rec_id, PublikasiPangan::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("gambar", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['gambar'], "gambar");
			$modeldata['gambar'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("publikasipangan/publikasi_pangan_saya", "Record updated successfully");
		}
		return $this->renderView("pages.publikasipangan.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = PublikasiPangan::query();
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
	function publikasi_pangan_saya(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.publikasipangan.publikasi_pangan_saya";
		$query = PublikasiPangan::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			PublikasiPangan::search($query, $search); // search table records
		}
		$query->join("kecamatan", "publikasi_pangan.id_kecamatan", "=", "kecamatan.id");
		$orderby = $request->orderby ?? "publikasi_pangan.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("id_kecamatan", "=" , auth()->user()->id_kecamatan);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, PublikasiPangan::publikasiPanganSayaFields());
		return $this->renderView($view, compact("records"));
	}
}
