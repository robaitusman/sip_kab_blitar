<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class DataPangan extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'data_pangan';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'judul','file','tahun','id_kecamatan'
	];
	public $timestamps = true;
	const CREATED_AT = 'date_created'; 
	const UPDATED_AT = 'date_updated'; 
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				data_pangan.id LIKE ?  OR 
				data_pangan.judul LIKE ?  OR 
				kecamatan.id LIKE ?  OR 
				kecamatan.nama LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%"
		];
		//setting search conditions
		$query->whereRaw($search_condition, $search_params);
	}
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"data_pangan.id AS id",
			"data_pangan.judul AS judul",
			"data_pangan.file AS file",
			"data_pangan.tahun AS tahun",
			"data_pangan.id_kecamatan AS id_kecamatan",
			"kecamatan.id AS kecamatan_id",
			"kecamatan.nama AS kecamatan_nama" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"data_pangan.id AS id",
			"data_pangan.judul AS judul",
			"data_pangan.file AS file",
			"data_pangan.tahun AS tahun",
			"data_pangan.id_kecamatan AS id_kecamatan",
			"kecamatan.id AS kecamatan_id",
			"kecamatan.nama AS kecamatan_nama" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"data_pangan.id AS id",
			"data_pangan.judul AS judul",
			"data_pangan.file AS file",
			"data_pangan.tahun AS tahun",
			"data_pangan.date_created AS date_created",
			"data_pangan.date_updated AS date_updated",
			"data_pangan.id_kecamatan AS id_kecamatan",
			"kecamatan.id AS kecamatan_id",
			"kecamatan.nama AS kecamatan_nama",
			"kecamatan.date_created AS kecamatan_date_created",
			"kecamatan.date_updated AS kecamatan_date_updated" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"data_pangan.id AS id",
			"data_pangan.judul AS judul",
			"data_pangan.file AS file",
			"data_pangan.tahun AS tahun",
			"data_pangan.date_created AS date_created",
			"data_pangan.date_updated AS date_updated",
			"data_pangan.id_kecamatan AS id_kecamatan",
			"kecamatan.id AS kecamatan_id",
			"kecamatan.nama AS kecamatan_nama",
			"kecamatan.date_created AS kecamatan_date_created",
			"kecamatan.date_updated AS kecamatan_date_updated" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"judul",
			"file",
			"tahun",
			"id_kecamatan",
			"id" 
		];
	}
	

	/**
     * return dataPanganSaya page fields of the model.
     * 
     * @return array
     */
	public static function dataPanganSayaFields(){
		return [ 
			"data_pangan.id AS id",
			"data_pangan.judul AS judul",
			"data_pangan.file AS file",
			"data_pangan.tahun AS tahun",
			"data_pangan.date_created AS date_created",
			"data_pangan.date_updated AS date_updated",
			"kecamatan.nama AS kecamatan_nama",
			"kecamatan.id AS kecamatan_id" 
		];
	}
	

	/**
     * return exportDataPanganSaya page fields of the model.
     * 
     * @return array
     */
	public static function exportDataPanganSayaFields(){
		return [ 
			"data_pangan.id AS id",
			"data_pangan.judul AS judul",
			"data_pangan.file AS file",
			"data_pangan.tahun AS tahun",
			"data_pangan.date_created AS date_created",
			"data_pangan.date_updated AS date_updated",
			"kecamatan.nama AS kecamatan_nama",
			"kecamatan.id AS kecamatan_id" 
		];
	}
	public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
    }
}
