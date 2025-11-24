<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\HargaProdusenAddRequest;
use App\Http\Requests\HargaProdusenEditRequest;
use App\Models\HargaProdusen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
class HargaProdusenController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.hargaprodusen.list";
		$query = HargaProdusen::query();
		$limit = $request->limit ?? 50;
		if($request->search){
			$search = trim($request->search);
			HargaProdusen::search($query, $search); // search table records
		}
		$query->join("kecamatan", "harga_produsen.id_kecamatan", "=", "kecamatan.id");
		$orderby = $request->orderby ?? "harga_produsen.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->id_kecamatan){
			$val = $request->id_kecamatan;
			$query->where(DB::raw("harga_produsen.id_kecamatan"), "=", $val);
		}
		if($request->tanggal){
			$vals = explode("-to-",$request->tanggal);
			$fromDate = $vals[0] ?? null;
			$toDate = $vals[1] ?? null;
			if($fromDate && $toDate){
				$query->whereRaw("harga_produsen.tanggal BETWEEN ? AND ?", [$fromDate, $toDate]);
			}
			elseif($fromDate){
				$query->whereRaw("harga_produsen.tanggal >= ?", [$fromDate]);
			}
			elseif($toDate){
				$query->whereRaw("harga_produsen.tanggal <= ?", [$toDate]);
			}
		}
		$records = $query->paginate($limit, HargaProdusen::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = HargaProdusen::query();
		$query->join("kecamatan", "harga_produsen.id_kecamatan", "=", "kecamatan.id");
		$record = $query->findOrFail($rec_id, HargaProdusen::viewFields());
		return $this->renderView("pages.hargaprodusen.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.hargaprodusen.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(HargaProdusenAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		$modeldata['id_kecamatan'] = auth()->user()->id_kecamatan;
		
		//save HargaProdusen record
		$record = HargaProdusen::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("hargaprodusen/harga_produsen_saya", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(HargaProdusenEditRequest $request, $rec_id = null){
		$query = HargaProdusen::query();
		$record = $query->findOrFail($rec_id, HargaProdusen::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("hargaprodusen/harga_produsen_saya", "Record updated successfully");
		}
		return $this->renderView("pages.hargaprodusen.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = HargaProdusen::query();
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
	function harga_produsen_saya(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.hargaprodusen.harga_produsen_saya";
		$query = HargaProdusen::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			HargaProdusen::search($query, $search); // search table records
		}
		$query->join("kecamatan", "harga_produsen.id_kecamatan", "=", "kecamatan.id");
		$orderby = $request->orderby ?? "harga_produsen.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("id_kecamatan", "=" , auth()->user()->id_kecamatan);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->tanggal){
			$vals = explode("-to-",$request->tanggal);
			$fromDate = $vals[0] ?? null;
			$toDate = $vals[1] ?? null;
			if($fromDate && $toDate){
				$query->whereRaw("harga_produsen.tanggal BETWEEN ? AND ?", [$fromDate, $toDate]);
			}
			elseif($fromDate){
				$query->whereRaw("harga_produsen.tanggal >= ?", [$fromDate]);
			}
			elseif($toDate){
				$query->whereRaw("harga_produsen.tanggal <= ?", [$toDate]);
			}
		}
		$records = $query->paginate($limit, HargaProdusen::hargaProdusenSayaFields());
		return $this->renderView($view, compact("records"));
	}
}
