<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Nbm extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'nbm';
	

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
				nbm.id LIKE ?  OR 
				nbm.judul LIKE ?  OR 
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
			"nbm.id AS id",
			"nbm.judul AS judul",
			"nbm.file AS file",
			"nbm.tahun AS tahun",
			"nbm.id_kecamatan AS id_kecamatan",
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
			"nbm.id AS id",
			"nbm.judul AS judul",
			"nbm.file AS file",
			"nbm.tahun AS tahun",
			"nbm.id_kecamatan AS id_kecamatan",
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
			"nbm.id AS id",
			"nbm.judul AS judul",
			"nbm.file AS file",
			"nbm.tahun AS tahun",
			"nbm.date_created AS date_created",
			"nbm.date_updated AS date_updated",
			"nbm.id_kecamatan AS id_kecamatan",
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
			"nbm.id AS id",
			"nbm.judul AS judul",
			"nbm.file AS file",
			"nbm.tahun AS tahun",
			"nbm.date_created AS date_created",
			"nbm.date_updated AS date_updated",
			"nbm.id_kecamatan AS id_kecamatan",
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
     * return nbmSaya page fields of the model.
     * 
     * @return array
     */
	public static function nbmSayaFields(){
		return [ 
			"nbm.id AS id",
			"nbm.judul AS judul",
			"nbm.file AS file",
			"nbm.tahun AS tahun",
			"kecamatan.nama AS kecamatan_nama",
			"kecamatan.id AS kecamatan_id" 
		];
	}
	

	/**
     * return exportNbmSaya page fields of the model.
     * 
     * @return array
     */
	public static function exportNbmSayaFields(){
		return [ 
			"nbm.id AS id",
			"nbm.judul AS judul",
			"nbm.file AS file",
			"nbm.tahun AS tahun",
			"kecamatan.nama AS kecamatan_nama",
			"kecamatan.id AS kecamatan_id" 
		];
	}
	public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
    }
}
